<!--TODO: Enable this for local dev environment for debugging -->
<?php
/**
 * @var \App\View\AppView $this
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.php');

    $this->start('file');
    echo $this->element('auto_table_warning');
    $this->end();
endif;
?>
<h2><?= h($message) ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
</p>

<!--TODO: Use this for error template for cpanel version to avoid crashes -->
<?php
///**
// * Custom Missing Controller Error Page
// * Styled like the Weekly Report page.
// *
// * @var \App\View\AppView $this
// */
//$this->assign('title', 'Page Not Found');
//?>
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    --><?php //= $this->Html->css(['utilities']) ?>
<!--</head>-->
<!--<body>-->
<!--<div class="page-container mx-auto p-5">-->
<!--    <section id="heading" class="text-center py-5">-->
<!--        <div class="container">-->
<!--            <h1 class="display-3 fw-bold text-danger">Oops! Page Not Found</h1>-->
<!--            <p class="lead my-4">-->
<!--                The page you are trying to access does not exist.<br>-->
<!--                Please check the URL or go back to the homepage.-->
<!--            </p>-->
<!--            <a href="--><?php //= $this->Url->build('/') ?><!--" class="btn btn-primary btn-lg mt-3">Return to Homepage</a>-->
<!--        </div>-->
<!--    </section>-->
<!--    <div class="row justify-content-center">-->
<!--        <div class="col-md-5 text-center">-->
<!--            --><?php //= $this->Html->image('crackers.png', [
//                'class' => 'img-fluid',
//                'alt' => 'Lavosh Crackers',
//                'style' => 'width: 100%;',
//            ]) ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</body>-->
