<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */

// For local testing
use Cake\Mailer\Transport\DebugTransport;

// For cpanel testing
//use Cake\Mailer\Transport\SmtpTransport;
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', 'a382223da106ba164f8991d4edfc94c9cb0bba79d9cb95acb4fb66e96f00a3c1'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',

            'username' => 'cake_landing_page',
            'password' => 'YES',

            'database' => 'cake_landing_page',
            /*
             * If not using the default 'public' schema with the PostgreSQL driver
             * set it here.
             */
            //'schema' => 'myapp',

            /*
             * You can use a DSN string to set the entire configuration
             */
            'url' => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/tmp/tests.sqlite'),
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    // Testing on cpanel
//    'EmailTransport' => [
//        'default' => [
//            'className' => SmtpTransport::class,
//            'host' => 'localhost',
//            'port' => 25,
//            'username' => 'crunchy_cravings@u25s1068.iedev.org',
//            'password' => 'fit3047_',
//            'tls' => false,
//            'client' => null,
//            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
//        ],
//    ],

    // Testing on local machine
    'EmailTransport' => [
        'default' => [
            'className' => DebugTransport::class,
        ],
    ],

    // Disable warning for web hosting only (not in local)
//    'Error' => [
//        'errorLevel' => E_ALL & ~E_USER_DEPRECATED,
//        'exceptionRenderer' => '\Cake\Error\Renderer\HtmlExceptionRenderer::class',
//        'log' => true,
//        'skipLog' => [],
//        'trace' => true,
//    ],

    'Stripe' => [
        'public_key' => 'pk_test_51RNkiwGh0CrOTyG9cCo0D8EvBhNgIq3R5fxTOHU3QnA6b8DHu76sKY8bUoE3G9o3UiMkkNihPEF5Nt5pfcrI8Zu600M61FXE8Z',
        'secret_key' => 'sk_test_51RNkiwGh0CrOTyG9BeyhFwr4Ox8ga6lr8QKP5XUhJkAs7XvdbZ4Fzp5maJh1ZsBOjSXwr7w8tjz9ER7m821vE5DP00drqgKAre',
    ],
];
