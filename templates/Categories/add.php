<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Add Category</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>

    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Add Category</h1>
                <p class="lead">Fill out the form below to add a new category.</p>
            </div>
        </section>

        <!-- Add Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content" class="bg-light p-4 rounded">
                            <?= $this->Form->create($category, ['class' => 'form']) ?>

                            <div class="mb-4">
                                <?= $this->Form->control('name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Category Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the category name...',
                                    'required' => true,
                                ]) ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('description', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Description</h4>', 'escape' => false],
                                    'placeholder' => 'Enter a brief description...',
                                    'type' => 'textarea',
                                    'rows' => 4,
                                    'required' => true,
                                ]) ?>
                            </div>
                            <div class="mb-4">
                                <h4>Products</h4>
                                <ul class="list-unstyled row">
                                    <?php foreach ($products as $id => $name): ?>
                                        <li class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check">
                                                <?= $this->Form->checkbox("products._ids.$id", [
                                                    'value' => $id,
                                                    'class' => 'form-check-input',
                                                ]) ?>
                                                <?= $this->Form->label("products._ids.$id", h($name), ['class' => 'form-check-label']) ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="text-center">
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']) ?>
                                <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-link']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>