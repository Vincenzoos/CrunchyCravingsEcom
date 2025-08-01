<?php

return [
    'CakeDC/Auth.permissions' => [

        // Public access for authentication-related actions
        [
            'role' => '*',
            'controller' => 'Auth',
            'action' => [
                'login',
                'logout',
                'register',
                'forgetPassword',
                'resetPassword',
                'changePassword',
            ],
            'bypassAuth' => true,
        ],

        // Public access to customer product pages
        [
            'role' => '*',
            'controller' => 'Products',
            'action' => [
                'customerIndex',
                'customerView',
            ],
            'bypassAuth' => true,
        ],
         // Public access to the Cart functionalities
         [
             'role' => '*',
             'controller' => 'CartItems',
             'action' => [
                 'customerView',
                 'customerAdd',
                 'updateQuantity',
                 'updateQuantityAjax',
                 'delete',
                 'authenticatedCheckout',
                 'unauthenticatedCheckout',
                 'success',
             ],
             'bypassAuth' => true,
         ],

         // Public access to the Categories functionalities
         [
             'role' => '*',
             'controller' => 'Categories',
             'action' => [
                 'customerIndex',
                 ],
             'bypassAuth' => true,
         ],
        // Public access to the Faqs functionalities
        [
            'role' => '*',
            'controller' => 'Faqs',
            'action' => [
                'customerIndex',
                'updateClickCount',
            ],
            'bypassAuth' => true,
        ],

        // Public access to the Orders functionalities
        [
            'role' => '*',
            'controller' => 'Orders',
            'action' => [
                'customerIndex',
                'orders',
            ],
            'bypassAuth' => true,
        ],

        // Restrict access to Orders index for admin only
        [
            'role' => 'admin',
            'controller' => 'Orders',
            'action' => 'index',
        ],

        // Public access to Pages controller (e.g. homepage/landing page)
        [
            'role' => '*',
            'controller' => 'Pages',
            'action' => '*',
            'bypassAuth' => true,
        ],

        // Public access to contact form
        [
            'role' => '*',
            'controller' => 'Contacts',
            'action' => 'contactUs',
            'bypassAuth' => true,
        ],

        // Admins can access everything
        [
            'role' => 'admin',
            'controller' => '*',
            'action' => '*',
        ],
    ],
];
