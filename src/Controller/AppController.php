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

        Stripe::setApiKey(Configure::read('Stripe.secret_key'));
    }

    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);

        $cartCount = 0;

        // Check if the user is logged in
        if ($this->Authentication->getIdentity()) {
            $userId = $this->Authentication->getIdentity()->get('id');

            // Fetch cart count from the database for authenticated users
            $cartCount = $this->fetchTable('CartItems')->find()
                ->where(['user_id' => $userId])
                ->select(['total_quantity' => 'SUM(quantity)'])
                ->first()
                ->total_quantity ?? 0; // Use 0 as a fallback if no items are found
        } else {
            // Fetch cart count from the session for unauthenticated users
            $session = $this->getRequest()->getSession();
            $cart = $session->read('Cart') ?? [];
            $cartCount = array_sum(array_column($cart, 'quantity'));
        }

        // Pass the cart count to the view
        $this->set(compact('cartCount'));
    }
}
