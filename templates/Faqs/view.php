<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

$html = new HtmlHelper(new View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - FAQ Details</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">View FAQ</h1>
                <p class="lead">Details of the selected FAQ are shown below.</p>
            </div>
        </section>

        <!-- FAQ Details Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div id="form-content" class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Title') ?></th>
                                <td><?= h($faq->title) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <td><?= h($faq->created->format('d/m/Y H:i a')) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Modified') ?></th>
                                <td><?= h($faq->modified->format('d/m/Y H:i a')) ?></td>
                            </tr>
                        </table>

                        <!-- Answer Section -->
                        <div id="answer-content" class="mt-4">
                            <h3><?= __('Answer') ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td style="word-break: break-word; overflow-wrap: break-word; white-space: normal; max-width: 100%;">
                                        <?= $this->Text->autoParagraph(h($faq->answer)); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Actions -->
        <div class="text-center mt-4">
            <?= $this->Html->link('Edit FAQ', ['action' => 'edit', $faq->id], ['class' => 'btn btn-warning']) ?>
            <?= $this->Form->postLink(
                'Delete FAQ',
                ['action' => 'delete', $faq->id],
                [
                    'class' => 'btn btn-danger',
                    'confirm' => __('Are you sure you want to delete this FAQ: "{0}"?', $faq->title),
                ]
            ) ?>
        </div>
        <div class="text-center mt-4">
            <?= $this->Html->link('Back to FAQs List', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</body>