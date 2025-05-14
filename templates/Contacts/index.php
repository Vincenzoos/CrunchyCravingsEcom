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
    <?= $this->Html->css(['utilities','table','form','filter']) ?>

</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <!-- <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Enquiries</h1>
                <p class="lead">Manage all enquiries below.</p>
            </div>
        </section> -->

        <!-- Shop container -->
        <div class="container" id="shop-container">
            <!-- Top Bar -->
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h4 class="mb-0">Enquiries (<?= count($contacts) ?>)</h4>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <!-- Show/Hide Filters Button -->
                    <button id="filters-button" class="btn btn-outline-primary">
                        Show Filters <i class="fa fa-sliders"></i>
                    </button>

                    <!-- Sort By Dropdown -->
                    <div id="sort-dropdown">
                    <button id="sort-button" class="btn btn-outline-secondary">
                        Sort By
                    </button>
                    <div id="sort-options" class="dropdown-menu">
                        <ul style="list-style-type: none; padding: 0; margin: 0;">
                            <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'first_name_asc'])]) ?>">Name (A-Z)</a></li>
                            <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'first_name_desc'])]) ?>">Name (Z-A)</a></li>
                            <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'email_asc'])]) ?>">Email (A-Z)</a></li>
                            <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'email_desc'])]) ?>">Email (Z-A)</a></li>
                            <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'sent_asc'])]) ?>">Sent (Oldest First)</a></li>
                            <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'sent_desc'])]) ?>">Sent (Newest First)</a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="d-flex" id="filter-container">
                <div id="filter-sidebar" class="closed">
                    <h5>Filters</h5>
                    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

                    <div class="mb-4">
                        <!-- First Name Field -->
                        <div class="mb-3">
                            <?= $this->Form->control('first_name', [
                                'label' => 'Contact First Name',
                                'placeholder' => 'First name contains...',
                                'value' => $this->request->getQuery('first_name'),
                                'class' => 'form-control',
                            ]) ?>
                        </div>

                        <!-- Last Name Field -->
                        <div class="mb-3">
                            <?= $this->Form->control('last_name', [
                                'label' => 'Contact Last Name',
                                'placeholder' => 'Last name contains...',
                                'value' => $this->request->getQuery('last_name'),
                                'class' => 'form-control',
                            ]) ?>
                        </div>

                        <!-- Date Sent Field -->
                        <div class="mb-3">
                            <?= $this->Form->control('date_sent', [
                                'label' => 'Date Sent',
                                'placeholder' => 'Select a date to filter earlier records...',
                                'type' => 'date',
                                'dateFormat' => 'YMD',
                                'class' => 'form-control',
                            ]) ?>
                        </div>

                        <!-- Reply Status Field -->
                        <div class="mb-3">
                            <?= $this->Form->control('reply_status', [
                                'label' => 'Reply Status',
                                'options' => [
                                    '' => 'All',
                                    1 => 'Replied',
                                    0 => 'Not Replied',
                                ],
                                'class' => 'form-select',
                                'empty' => false,
                                'default' => '',
                            ]) ?>
                        </div>

                        <!-- Filter Button -->
                        <div class="text-center">
                            <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-success']) ?>
                            <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
                        </div>

                    </div>

                    <?= $this->Form->end() ?>
                </div>

                <!-- Main Content -->
                <div id="filter-content">    
                    <?= $this->Flash->render() ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
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
                                        <td class="text-center">
                                            <?= $contact->reply_status=="Yes" ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' ?>
                                        </td></td>
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
                    
                </div>
                <!-- Paginator -->
                <?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()): ?>
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <ul class="pagination">
                            <?= $this->Paginator->first(__('<< First'), ['url' => $this->request->getQuery()]) ?>
                            <?= $this->Paginator->prev(__('< Previous'), ['url' => $this->request->getQuery()]) ?>
                            <p class="text-muted mx-3 mb-0">
                                <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total')) ?>
                            </p>
                            <?= $this->Paginator->next(__('Next >'), ['url' => $this->request->getQuery()]) ?>
                            <?= $this->Paginator->last(__('Last >>'), ['url' => $this->request->getQuery()]) ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?= $this->Html->script('filter_utils.js') ?>
    <script>
        // Initialize the sort dropdown
        initializeSortDropdown('sort-button', 'sort-options');

        // Initialize the filter fields
        const filterFields = ['first_name', 'last_name', 'date_sent', 'reply_status'];

        // Initialize the filter sidebar
        initializeFilterSidebar('filters-button', 'filter-sidebar', 'form', filterFields);
    </script>


</body>

</html>
