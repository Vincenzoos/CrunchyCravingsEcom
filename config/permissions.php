<?php

return [
    'CakeDC/Auth.permissions' => [
        [
            'role' => '*',
            'controller' => 'Auth',
            'action' => ['login', 'logout', 'register', 'forgetPassword', 'resetPassword', 'changePassword'],
            'bypassAuth' => true,
        ],

        [
            'role' => '*',
            'controller' => 'Pages',
            'action' => '*',
            'bypassAuth' => true,
        ],
        [
            'role' => '*',
            'controller' => 'Contacts',
            'action' => 'contactUs',
            'bypassAuth' => true,
        ],

        [
            'role' => 'admin',
            'controller' => '*',
            'action' => '*',
        ],

        [
            'role' => 'customer',
            'controller' => 'Products',
            'action' => ['customerIndex', 'view'],
        ],

    ],

];
