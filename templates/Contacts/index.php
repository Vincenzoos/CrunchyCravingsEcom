<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Contact> $contacts
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <?= $this->Html->css(['custom','table','login']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Banner -->
        <section id="heading-banner">
            <header id="heading-inner" class="text-center py-3">
                <?= $this->Html->image('cc_logo.png', ['class' => 'img-fluid', 'alt' => 'CrunchyCravings']) ?>
            </header>
        </section>

            <!-- Heading Section -->
            <section id="welcome-back" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Contacts List</h1>
                <p class="lead">Manage all contacts below.</p>
            </div>
        </section>

        <div id="wrapper">
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <div class="container-fluid">
                        <?= $this->Flash->render() ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover shadow mb-4">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th><?= $this->Paginator->sort('first_name', __('First Name')) ?></th>
                                        <th><?= $this->Paginator->sort('last_name', __('Last Name')) ?></th>
                                        <th><?= $this->Paginator->sort('email', __('Email')) ?></th>
                                        <th><?= $this->Paginator->sort('phone_number', __('Phone Number')) ?></th>
                                        <th><?= $this->Paginator->sort('replied', __('Replied')) ?></th>
                                        <th><?= $this->Paginator->sort('date_sent', __('Date Sent')) ?></th>
                                        <th class="text-center"><?= __('Actions') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($contacts as $contact) : ?>
                                        <tr>
                                            <td><?= h($contact->first_name) ?></td>
                                            <td><?= h($contact->last_name) ?></td>
                                            <td><?= $this->Html->link(h($contact->email), 'mailto:' . h($contact->email)) ?></td>
                                            <td><?= h($contact->phone_number) ?></td>
                                            <td><?= h($contact->reply_status) ?></td>
                                            <td><?= h($contact->date_sent->format('d/m/Y')) ?></td>
                                            <td class="text-center">
                                                <?= $this->Html->link(__('View'), ['action' => 'view', $contact->id], ['class' => 'btn btn-info btn-sm']) ?>
                                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                                <?= $this->Form->postLink(
                                                    __('Delete'),
                                                    ['action' => 'delete', $contact->id],
                                                    [
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'confirm' => __('Are you sure you want to delete {0}?', $contact->first_name . ' ' . $contact->last_name),
                                                    ]
                                                ) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mt-4">
                                <?= $this->Html->link('Add New Contact', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>

                        <!-- Paginator -->
                        <div class="d-flex justify-content-between align-items-center">
                            <ul class="pagination">
                                <?= $this->Paginator->first('<< ' . __('First')) ?>
                                <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('Next') . ' >') ?>
                                <?= $this->Paginator->last(__('Last') . ' >>') ?>
                            </ul>
                            <p class="text-muted">
                                <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total')) ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="text-center mt-4 py-3">
                <?= $this->Html->link('Back to Dashboard', '#', ['class' => 'btn btn-link']) ?>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
