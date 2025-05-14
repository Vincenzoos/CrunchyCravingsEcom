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
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Stripe\Stripe;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        // Added Authentication component
        $this->loadComponent('Authentication.Authentication');

        // Added Authorization component
        $this->loadComponent('Authorization.Authorization');

        $categories = $this->fetchTable('Categories')->find('all');
        $products = $this->fetchTable('Products')->find('all');
        $categoriesList = $this->fetchTable('Categories')->find('list')->all();
        $productsList = $this->fetchTable('Products')->find('list')->all();
        $this->set(compact('categories', 'products', 'categoriesList', 'productsList'));
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
//        disable form protection to prevent Missing field "field_name" in POST data
            // since error handling implemented in server-side and client-side
        $this->loadComponent('FormProtection', [
            'unlockedFields' => [],
        ]);

        // Enable order status auto update
        $this->loadComponent('OrderStatus');

        // Stripe API key
        Stripe::setApiKey(Configure::read('Stripe.secret_key'));
    }

    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);

        // Periodically update order status (Update once daily)
        $lastRunDate = Cache::read('order_status_last_run');

        // If not set or older than today, run it
        if ($lastRunDate !== date('Y-m-d')) {
            $this->OrderStatus->updateStatuses();
            Cache::write('order_status_last_run', date('Y-m-d'));
        }

        $cartCount = 0;

        // Safe check: Only access Authentication if the component is loaded
        if ($this->components()->has('Authentication')) {
            $identity = $this->Authentication->getIdentity();
            if ($identity) {
                $userId = $identity->get('id');

                // Fetch cart count from the database for authenticated users
                $cartCount = $this->fetchTable('CartItems')->find()
                    ->where(['user_id' => $userId])
                    ->select(['total_quantity' => 'SUM(quantity)'])
                    ->first()
                    ->total_quantity ?? 0;
            } else {
                // Session-based cart for guests
                $session = $this->getRequest()->getSession();
                $cart = $session->read('Cart') ?? [];
                $cartCount = array_sum(array_column($cart, 'quantity'));
            }
        }

        $this->set(compact('cartCount'));
    }
}
