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

</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Enquiries</h1>
                <p class="lead">Manage all enquiries below.</p>
            </div>
        </section>

        <!-- Filter Toggle Button -->
        <div class="text-center mb-3">
            <button class="btn btn-outline-secondary" type="button" id="toggle-filters" data-bs-toggle="collapse" data-bs-target="#filter-form" aria-expanded="false" aria-controls="filter-form">
                Show Filters <i class="fa fa-sliders"></i>
            </button>
        </div>
        
        <!-- Filter Form -->
        <div id="filter-form" class="collapse">
            <div id="form-content" class="col-md-2 mx-auto mb-4 p-3">
            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

            <!-- First name Field -->
            <div class="col-12">
                <?= $this->Form->control('first_name', [
                'label' => 'Contact First Name',
                'placeholder' => 'First name contains...',
                'value' => $this->request->getQuery('first_name'),
                'class' => 'form-control',
                ]) ?>
            </div>

            <!-- Last name Field -->
            <div class="col-12">
                <?= $this->Form->control('last_name', [
                'label' => 'Contact Last Name',
                'placeholder' => 'Last name contains...',
                'value' => $this->request->getQuery('last_name'),
                'class' => 'form-control',
                ]) ?>
            </div>

            <!-- Sent Date field -->
            <div class="col-12">
                <?= $this->Form->control('date_sent', [
                'label' => 'Date Sent',
                'placeholder' => 'Select a date to filter earlier records...',
                'type' => 'date',
                'dateFormat' => 'YMD',
                'class' => 'form-control',
                ]) ?>
            </div>

            <!-- Reply Status field -->
            <div class="col-12">
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
            <div class="col-12 text-center">
                <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
            </div>

            <?= $this->Form->end() ?>
            </div>
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
                                    <td><?= h($contact->date_sent ? $contact->date_sent->format('d/m/Y') : 'N/A') ?></td>
                                    <td class="text-center">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $contact->id], ['class' => 'btn btn-info btn-sm']) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                        <?= $this->Form->postLink(
                                            __('Delete'),
                                            ['action' => 'delete', $contact->id],
                                            [
                                                'class' => 'btn btn-danger btn-sm',
                                                'confirm' => __('Are you sure you want to delete this contact: {0} ({1})?', $contact->full_name, $contact->email),
                                            ],
                                        ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-4">
                        <?= $this->Html->link('Add New Enquiry', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>

                <!-- Paginator -->
                <?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()): ?>
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
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Filter form toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filter-form');
            const toggleFiltersButton = document.getElementById('toggle-filters');

            // Check if there are any query parameters in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.toString()) {
                // Open the filter form if there are filters in the URL
                filterForm.classList.add('show');
                toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
            }

            // Listen for Bootstrap collapse events
            filterForm.addEventListener('shown.bs.collapse', function () {
                console.log('Filters are now visible');
                toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
            });

            filterForm.addEventListener('hidden.bs.collapse', function () {
                console.log('Filters are now hidden');
                toggleFiltersButton.innerHTML = 'Show Filters <i class="fa fa-sliders"></i>';
            });
        });
    </script>
</body>

</html>
