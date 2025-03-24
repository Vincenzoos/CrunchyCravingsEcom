<?php


return [
    /**
     * Recaptcha configuration.
     */
    'Recaptcha' => [
        'enable' => true,
        'sitekey' => env('RECAPTCHA_SITE_KEY'),
        'secret' => env('RECAPTCHA_SECRET_KEY'),
        'type' => 'image',
        'theme' => 'light',
        'lang' => 'es',
        'size' => 'normal',
    ],
];
