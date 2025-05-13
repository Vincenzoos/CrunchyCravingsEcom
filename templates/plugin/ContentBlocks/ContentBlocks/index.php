<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\ContentBlocks\Model\Entity\ContentBlock> $contentBlocksGrouped
 */

$this->assign('title', 'Content Blocks');

$this->Html->css(['utilities', 'table', 'form', 'ContentBlocks.content-blocks'], ['block' => true]);

$slugify = function ($text) {
    return preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
}

?>
<body>
<!-- Page Container -->
<div class="page-container mx-auto my-5">

    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6">Content Blocks</h1>
            <p class="lead">Manage content blocks grouped by categories below.</p>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="container" id="shop-container">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid" id="table-content" style="max-width: 800px;">
                <!-- Quick Links -->
<!--                <div>-->
<!--                    Quick links-->
<!--                    --><?php //foreach (array_keys($contentBlocksGrouped) as $parent) { ?>
<!--                        :: <a href="#--><?php //= $slugify($parent) ?><!--">--><?php //= $parent ?><!--</a>-->
<!--                    --><?php //} ?>
<!--                </div>-->

                <!-- Content Block Groups -->
                <?php foreach ($contentBlocksGrouped as $parent => $contentBlocks) { ?>
                    <h4 class="content-blocks--list-subheading">
                        <a href="#<?= $slugify($parent)?>" id="<?= $slugify($parent)?>">
                            <?= $parent ?>
                        </a>
                    </h4>

                    <ul class="list-group">
                        <?php foreach ($contentBlocks as $contentBlock) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <!-- Content Block Name and Description -->
                                <div class="content-blocks--text d-flex flex-column">
                                    <div class="content-blocks--display-name mr-3">
                                        <?= $contentBlock['label'] ?>
                                    </div>
                                    <div class="content-blocks--description">
                                        <?= $contentBlock['description'] ?>
                                    </div>
                                </div>

                                <!-- Actions on the Right -->
                                <div class="content-blocks--actions d-flex">
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contentBlock->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                    <?php if (!empty($contentBlock->previous_value)) {
                                        echo ' :: ' . $this->Form->postLink(__('Restore'), ['action' => 'restore', $contentBlock->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __("Are you sure you want to restore the previous version for this item?\n{0}/{1}\nNote: You cannot cancel this action!", $contentBlock->parent, $contentBlock->slug)]);
                                    } ?>
                                </div>
                            </li>

                        <?php } ?>
                    </ul>

                <?php } ?>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
</body>
