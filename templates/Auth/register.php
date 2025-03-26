<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->layout = 'login';
$this->assign('title', 'Register new user');
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

        
    <div class="container register">
        <div class="users form content">

            <?= $this->Form->create($user) ?>

            <fieldset>
                <legend>Register new user</legend>

                <?= $this->Flash->render() ?>

                <?= $this->Form->control('email'); ?>

                <div class="row">
                    <?php
                    echo $this->Form->control('password', [
                        'value' => '',  // Ensure password is not sending back to the client side
                        'templateVars' => ['container_class' => 'column']
                    ]);
                    // Validate password by repeating it
                    echo $this->Form->control('password_confirm', [
                        'type' => 'password',
                        'value' => '',  // Ensure password is not sending back to the client side
                        'label' => 'Retype Password',
                        'templateVars' => ['container_class' => 'column']
                    ]);
                    ?>
                </div>
            </fieldset>

            <?= $this->Form->button('Register') ?>
            <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline float-right']) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body>

</html>