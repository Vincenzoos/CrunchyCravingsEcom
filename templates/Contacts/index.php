<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Contact> $contacts
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities','table','form']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Contacts List</h1>
                <p class="lead">Manage all contacts below.</p>
            </div>
        </section>
        
        <!-- Content Wrapper -->
        <div id="form-section" class="d-flex flex-column">
            <!-- Contacts Filter Form -->
            <div id="form-content" class="col-md-8 mx-auto mb-4 p-3 rounded shadow-sm bg-light">
                <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

                <!-- First name Field -->
                <div class="col-md-6">
                    <?= $this->Form->control('first_name', [
                        'label' => 'Contact First Name',
                        'placeholder' => 'First name contains...',
                        'value' => $this->request->getQuery('first_name'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <!-- Last name Field -->
                <div class="col-md-6">
                    <?= $this->Form->control('last_name', [
                        'label' => 'Contact Last Name',
                        'placeholder' => 'Last name contains...',
                        'value' => $this->request->getQuery('last_name'),
                        'class' => 'form-control',
                    ]) ?>
                </div>
                <!-- Sent Date field -->
                <div class="col-md-6">
                    <?= $this->Form->control('date_sent', [
                        'label' => 'Date Sent',
                        'placeholder' => 'Select a date to filter earlier records...',
                        'type' => 'date',
                        'dateFormat' => 'YMD',
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <!-- Reply Status field -->
                <div class="col-md-6">
                    <?= $this->Form->control('reply_status', [
                        'label' => 'Reply Status',
                        'options' => [
                            '' => 'All',
                            1 => 'Replied',
                            0 => 'Not Replied',
                        ],
                        'class' => 'form-select select2', // use select2
                        'empty' => false, // Disable the empty option
                        'default' => '',
                    ]) ?>
                </div>

                <!-- Filter Button -->
                <div class="col-md-6 offset-md-6 text-end align-self-center">
                    <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-success']) ?>
                    <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>

            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid" id="table-content">
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
                                                ],
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
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <ul class="pagination">
                            <?= $this->Paginator->first(__('<< First')) ?>
                            <?= $this->Paginator->prev(__('< Previous')) ?>
                            <p class="text-muted mx-3 mb-0">
                                <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total')) ?>
                            </p>
                            <?= $this->Paginator->next(__('Next >')) ?>
                            <?= $this->Paginator->last(__('Last >>')) ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
