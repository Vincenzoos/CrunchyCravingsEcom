<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - User Details</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">View User</h1>
                <p class="lead">Details of the selected user are shown below.</p>
            </div>
        </section>

        <!-- User Details Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="form-content" class="text-center">
                            <h3><?= h($user->email) ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th><?= __('Email') ?></th>
                                    <td><?= h($user->email) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Role') ?></th>
                                    <td><?= h($user->role) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Created') ?></th>
                                    <td><?= $user->created ? h($user->created->format('d/m/Y h:i a')) : 'N/A' ?></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Actions -->
                        <div class="text-center mt-4">
                            <?= $this->Html->link('Edit User', ['action' => 'edit', $user->id], ['class' => 'btn btn-warning']) ?>
                            <?= $this->Form->postLink(
                                'Delete User',
                                ['action' => 'delete', $user->id],
                                [
                                    'class' => 'btn btn-danger',
                                    'confirm' => __('Are you sure you want to delete {0}?', $user->email),
                                ]
                            ) ?>
                        </div>
                        <div class="text-center mt-4">
                            <?= $this->Html->link('Back to Users', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->

</body>
