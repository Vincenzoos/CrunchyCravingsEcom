<?php
/**
 * @var \App\View\AppView $this
 */

$this->assign('title', 'Forgot Password');
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>


    <?= $html->script('/libraries/jquery.min.js') ?>
</head>
<body>
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Forgot password" href="<?= $this->App->appUrl(['controller' => 'Auth', 'action' => 'forgetPassword']) ?>">Forgot Password</a></li>
            </ol>
        </div>
    </div>
    
    <!-- Forgot Password Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6">Forgot Password</h1>
            <p class="lead">Enter your email address to reset your password.</p>
        </div>
    </section>

    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Forgot Password Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="form-content" class="users-form-content">
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <?= $this->Flash->render() ?>
                                <div class="mb-4">
                                    <?= $this->Form->control('email', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Email</h3>', 'escape' => false],
                                        'placeholder' => 'Enter your email...',
                                        'type' => 'email',
                                        'required' => true,
                                    ]); ?>
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <?= $this->Form->button('Send Verification Email', ['class' => 'btn btn-primary btn-lg']) ?>
                            </div>
                            <?= $this->Form->end() ?>

                            <hr class="my-4">

                            <div class="text-center">
                                <?= $this->Html->link('Back to Login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'btn btn-link']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
</body>

</html>
