<?php
declare(strict_types=1);

namespace App\Middleware\UnauthorizedHandler;

use Authorization\Exception\Exception;
use Authorization\Middleware\UnauthorizedHandler\CakeRedirectHandler;
use Cake\Http\FlashMessage;
use Cake\Http\Response;
use Cake\Routing\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Custom Unauthorized Handler: RedirectedWhenDenied
 *
 * This handler customizes what happens when an authorization check fails.
 * - If the user is not logged in, redirect to the default unauthorized URL.
 * - If the user is logged in but lacks permissions, redirect back to the referer
 *   and flash an error message.
 */
class RedirectedWhenDenied extends CakeRedirectHandler
{
    /**
     * Handle unauthorized access attempt.
     *
     * @param \Authorization\Exception\Exception $exception The authorization exception that was thrown.
     * @param \Psr\Http\Message\ServerRequestInterface $request The server request.
     * @param array $options Additional options like `exceptions` and `statusCode`.
     * @return \Psr\Http\Message\ResponseInterface A response with redirect headers.
     * @throws \Authorization\Exception\Exception If the exception type isn't handled.
     */
    public function handle(
        Exception $exception,
        ServerRequestInterface $request,
        array $options = [],
    ): ResponseInterface {
        $options += $this->defaultOptions;
        if (!$this->checkException($exception, $options['exceptions'])) {
            throw $exception;
        }

        if ($request->getAttribute('identity') === null) {
            // If not log in yet, redirect to
            $url = $this->getUrl($request, $options);
        } else {
            // Set url to referer (false params allow to get full url path) or fallback to home page
            $referer = $request->referer(false);
            if ($referer === null || $referer === false) {
                // Fallback location as an array needs to be converted to a URL string.
                $fallbackLocation = ['controller' => 'Pages', 'action' => 'display'];
                $url = Router::url($fallbackLocation, true);
            } else {
                $url = $referer;
            }
            // Get current page (safe fallback)
            $page = $request->getParam('controller');
            $action = $request->getParam('action');

            // Flash error message with page name
            (new FlashMessage($request->getSession()))
                ->error("You do not have permission to access '$page/$action' page.'");
        }

        $response = new Response();

        return $response
            ->withHeader('Location', $url)
            ->withStatus($options['statusCode']);
    }
}
