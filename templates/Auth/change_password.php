<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Change User Password - Users');

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

    <div class="row">
        <div class="column">
            <div class="users form content">

                <?= $this->Form->create($user) ?>

                <fieldset>

                    <legend>Change Password for <u><?= h($user->first_name) ?> <?= h($user->last_name) ?></u></legend>

                    <div class="row">
                        <?php
                        echo $this->Form->control('password', [
                            'label' => 'New Password',
                            'value' => '',  // Ensure password is not sending back to the client side
                            'templateVars' => ['container_class' => 'column']
                        ]);
                        // Validate password by repeating it
                        echo $this->Form->control('password_confirm', [
                            'type' => 'password',
                            'value' => '',  // Ensure password is not sending back to the client side
                            'label' => 'Retype New Password',
                            'templateVars' => ['container_class' => 'column']
                        ]);
                        ?>
                    </div>

                </fieldset>

                <?= $this->Form->button('Submit') ?>
                <?= $this->Form->end() ?>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body>

</html>
