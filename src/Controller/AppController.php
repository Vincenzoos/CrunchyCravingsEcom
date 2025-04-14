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
        $this->set(compact('categories', 'products'));
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }


//    public function beforeRender(\Cake\Event\EventInterface $event)
//    {
//        parent::beforeRender($event);
//
//        // Check if the Identity object is available
//        $isAdmin = false;
//        if ($this->Authentication->getIdentity()) {
//            $isAdmin = $this->Authentication->getIdentity()->get('role') === 'admin';
//        }
//
//        // Pass the variable to the view
//        $this->set('isAdmin', $isAdmin);
//    }
}
