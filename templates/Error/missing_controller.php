<?php
/**
 * Custom Missing Controller Error Page
 * Styled like the Weekly Report page.
 *
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Page Not Found');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css(['utilities']) ?>
</head>
<body>
<div class="page-container mx-auto p-5">
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-3 fw-bold text-danger">Oops! Page Not Found</h1>
            <p class="lead my-4">
                The page you are trying to access does not exist.<br>
                Please check the URL or go back to the homepage.
            </p>
            <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary btn-lg mt-3">Return to Homepage</a>
        </div>
    </section>
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <?= $this->Html->image('crackers.png', [
                'class' => 'img-fluid',
                'alt' => 'Lavosh Crackers',
                'style' => 'width: 100%;',
            ]) ?>
        </div>
    </div>
</div>
</body>
