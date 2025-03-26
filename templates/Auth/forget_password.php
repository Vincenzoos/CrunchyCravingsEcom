<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'login';
$this->assign('title', 'Forget Password');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <?= $this->Html->css(['style','login']) ?>
</head>

<body>
    <!-- Heading Banner -->
    <section id="heading-banner">
        <header id="heading-inner" class="text-center py-3">
            <!-- <h1>CrunchyCravings</h1> -->
            <?= $this->Html->image('CC Logo.png', ['class' => 'img-fluid', 'alt' => 'CrunchyCravings']) ?>
        </header>
    </section>

            
    <div class="container login">
        <div class="row">
            <div class="column column-50 column-offset-25">

                <div class="users form content">

                    <?= $this->Form->create() ?>

                    <fieldset>

                        <legend>Forget Password</legend>

                        <?= $this->Flash->render() ?>

                        <p>Enter your email address registered with our system below to reset your password: </p>

                        <?php
                        echo $this->Form->control('email', [
                            'type' => 'email',
                            'required' => true,
                            'autofocus' => true,
                            'label' => false,
                        ]);
                        ?>

                    </fieldset>

                    <?= $this->Form->button('Send verification email') ?>
                    <?= $this->Form->end() ?>

                    <hr class="hr-between-buttons">

                    <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline']) ?>

                </div>
            </div>
        </div>
    </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <body>

</html>