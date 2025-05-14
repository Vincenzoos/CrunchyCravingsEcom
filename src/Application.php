<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App;

use App\Middleware\UnauthorizedHandler\RedirectedWhenDenied;
use App\Policy\AllowDebugKitPolicy;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Identifier\AbstractIdentifier;
use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Exception\ForbiddenException;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Middleware\RequestAuthorizationMiddleware;
use Authorization\Policy\MapResolver;
use Authorization\Policy\OrmResolver;
use Authorization\Policy\ResolverCollection;
use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\Middleware\HttpsEnforcerMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\Router;
use CakeDC\Auth\Policy\CollectionPolicy;
use CakeDC\Auth\Policy\RbacPolicy;
use CakeDC\Auth\Policy\SuperuserPolicy;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 *
 * @extends \Cake\Http\BaseApplication<\App\Application>
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface, AuthorizationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI !== 'cli') {
            FactoryLocator::add(
                'Table',
                (new TableLocator())->allowFallbackClass(false),
            );
        }

        // Add Authorization plugin
        if (!$this->getPlugins()->has('Authorization')) {
            $this->addPlugin('Authorization');
        }

        // Ensure Authorization plugin is loaded
        if (!class_exists(AuthorizationMiddleware::class)) {
            throw new RuntimeException('Authorization plugin is not loaded. Please install and load the Authorization plugin.');
        }

        // Add content blocks plugin
        // $this->addPlugin('ContentBlocks');
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance.
            // See https://github.com/CakeDC/cakephp-cached-routing
            ->add(new RoutingMiddleware($this))

            // Add Authentication support by plugin
            ->add(new AuthenticationMiddleware($this))

            // Add Authorization support by plugin
            ->add(new AuthorizationMiddleware(
                $this,
                [
                    'unauthorizedHandler' => [
                        'className' => RedirectedWhenDenied::class,
                        'url' => [
                            'controller' => 'Auth',
                            'action' => 'login',
                        ],
                        'queryParams' => 'redirect',
                        'exceptions' => [
                            ForbiddenException::class,
                        ],
                    ],
                ],
            ))

            // Add Request authorization
            ->add(new RequestAuthorizationMiddleware([
            'skipAuthorizationCheck' => function (ServerRequestInterface $request) {
                $controller = $request->getAttribute('controller');
                $action = $request->getAttribute('action');

                // Skip authorization for custom AJAX actions
                return ($controller === 'CartItems' && $action === 'updateQuantityAjax') || ($controller === 'faqs' && $action === 'updateClickCount');
            },
            'authorizeAll' => function (ServerRequestInterface $request) {
                $controller = $request->getAttribute('controller');
                $action = $request->getAttribute('action');

                // Allow all authorization checks to pass for AJAX requests
                return ($controller === 'CartItems' && $action === 'updateQuantityAjax') || ($controller === 'faqs' && $action === 'updateClickCount');
            },
            ]))

            // Add the HttpsEnforcerMiddleware to the middleware queue
            ->add(new HttpsEnforcerMiddleware(
                [
                    'redirect' => true,
                    'statusCode' => 302,
                ],
            ))

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            // https://book.cakephp.org/4/en/controllers/middleware.html#body-parser-middleware
            ->add(new BodyParserMiddleware())

            // Cross Site Request Forgery (CSRF) Protection Middleware
            // https://book.cakephp.org/4/en/security/csrf.html#cross-site-request-forgery-csrf-middleware
            ->add(new CsrfProtectionMiddleware([
            'httponly' => true,
            ]));

        return $middlewareQueue;
    }

    /**
     * Authentication plugin implementation
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $authenticationService = new AuthenticationService([
            'unauthenticatedRedirect' => Router::url([
                'controller' => 'Auth',
                'action' => 'login',
                'plugin' => null,
                'prefix' => null,
            ]),
            'queryParam' => 'redirect',
        ]);

        $authentication_fields = [
            AbstractIdentifier::CREDENTIAL_USERNAME => 'email',
            AbstractIdentifier::CREDENTIAL_PASSWORD => 'password',
        ];

        // Load identifiers, ensure we check email and password fields
        $authenticationService->loadIdentifier('Authentication.Password', ['fields' => $authentication_fields]);

        // Load the authenticators, you want session first
        $authenticationService->loadAuthenticator('Authentication.Session');
        // Configure form data check to pick email and password
        $authenticationService->loadAuthenticator('Authentication.Form', [
            'fields' => $authentication_fields,
            'loginUrl' => Router::url([
                'controller' => 'Auth',
                'action' => 'login',
                'plugin' => null,
                'prefix' => null,
            ]),
        ]);

        $authenticationService->setConfig('log', false);

        return $authenticationService;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/4/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
    }

    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $map = new MapResolver();
        $map->map(
            ServerRequest::class,
            new CollectionPolicy([
                AllowDebugKitPolicy::class,
                SuperuserPolicy::class,
                RbacPolicy::class,
            ]),
        );

        $orm = new OrmResolver();
        $resolver = new ResolverCollection([
            $map,
            $orm,
        ]);

        return new AuthorizationService($resolver);
    }
}
