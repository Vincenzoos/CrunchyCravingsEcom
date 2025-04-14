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
        // // Public access to the Cart controller
        // [
        //     'role' => '*',
        //     'controller' => 'Cart',
        //     'action' => '*',
        //     'bypassAuth' => true,
        // ],
        // // Public access to the Orders controller
        // [
        //     'role' => '*',
        //     'controller' => 'Orders',
        //     'action' => '*',
        //     'bypassAuth' => true,
        // ],

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
