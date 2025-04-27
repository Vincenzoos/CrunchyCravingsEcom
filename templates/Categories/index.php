<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Category> $categories
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Categories</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Categories Table</h1>
                <p class="lead">Manage all categories below.</p>
            </div>
        </section>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid" id="table-content">
                    <?= $this->Flash->render() ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                                    <th><?= $this->Paginator->sort('description', __('Description')) ?></th>
                                    <th class="text-center"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?= h($category->name) ?></td>
                                        <td><?= h($category->description) ?></td>
                                        <td class="text-center">
                                            <?= $this->Html->link(__('View'), ['action' => 'view', $category->id], ['class' => 'btn btn-info btn-sm']) ?>
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                            <?= $this->Form->postLink(
                                                __('Delete'),
                                                ['action' => 'delete', $category->id],
                                                [
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'confirm' => __('Are you sure you want to delete this category: {0}?', $category->name),
                                                ]
                                            ) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-4">
                        <?= $this->Html->link('Add New Category', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
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

    <!-- Bootstrap JS -->
    
</body>
