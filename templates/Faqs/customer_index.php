<?php
/**
 * @var \App\View\AppView $this
* @var iterable<\App\Model\Entity\Faq> $faqs
 */
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

$this->assign('title', 'FAQ');

?>

<?php
$html = new HtmlHelper(new View());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrunchyCravings</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="FAQ" href="<?= $this->Url->build(['controller' => 'Faqs', 'action' => 'customer_index']) ?>">FAQ</a></li>
            </ol>
        </div>
    </div>
    <!-- Page Breadcrumb /- -->

    
    <!-- Heading section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h3 class="display-6">Frequently Asked Questions</h3>
            <p class="lead">
                Below are some of the most frequently asked questions by our customers.
                If you have any other questions, feel free to <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'ContactUs']) ?>">Contact Us</a>.
            </p>
        </div>
    </section>
    
    <!-- Admin Manage FAQs button -->
    <?php if ($this->Identity->isLoggedIn() && $this->Identity->get('role') === 'admin'): ?>
        <div class="text-center my-3">
            <a href="<?= $this->Url->build(['controller' => 'Faqs', 'action' => 'index']) ?>" class="btn btn-danger">
                Manage FAQs
            </a>
        </div>
    <?php endif; ?>

    <!-- Page Container -->
    <div class="page-container">

        <div class="container my-5">
            <div class="d-flex justify-content-center mb-4">
                <div style="max-width: 500px; width: 100%; position: relative;">
                    <input type="text" id="faq-search" class="form-control" placeholder="Search FAQs..." style="padding-right: 2.5rem;">
                    <button id="clear-search" class="btn btn-outline-secondary" type="button" style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); display: none;">
                        &times;
                    </button>
                </div>
            </div>
            <div class="accordion" id="faqAccordion">
                <?php foreach ($faqs as $index => $faq): ?>
                    <div class="accordion-item" data-title="<?= h($faq->title) ?>" data-answer="<?= strip_tags($faq->answer) ?>" data-id="<?= h($faq->id) ?>">
                        <h2 class="accordion-header" id="heading<?= $index ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="true" aria-controls="collapse<?= $index ?>">
                                <?= h($faq->title) ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?= $faq->answer ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Client side search script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('faq-search');
            const clearButton = document.getElementById('clear-search');
            const faqItems = document.querySelectorAll('.accordion-item');

            // Show or hide the clear button based on input value
            searchInput.addEventListener('input', function () {
                const query = searchInput.value.trim().toLowerCase();

                // Show the clear button if there's input, otherwise hide it
                clearButton.style.display = query ? 'block' : 'none';

                // Filter and highlight FAQs
                faqItems.forEach(item => {
                    const titleElement = item.querySelector('.accordion-button');
                    const answerElement = item.querySelector('.accordion-body');
                    const title = item.getAttribute('data-title');
                    const answer = item.getAttribute('data-answer');

                    // Reset the content to remove previous highlights
                    titleElement.innerHTML = title;
                    answerElement.innerHTML = answer;

                    // Highlight matches in the title and answer
                    if (query) {
                        const regex = new RegExp(`(${query})`, 'gi'); // Case-insensitive regex for the query
                        const highlightedTitle = title.replace(regex, '<mark>$1</mark>');
                        const highlightedAnswer = answer.replace(regex, '<mark>$1</mark>');

                        titleElement.innerHTML = highlightedTitle;
                        answerElement.innerHTML = highlightedAnswer;
                    }

                    // Show or hide the item based on the search query
                    if (title.toLowerCase().includes(query) || answer.toLowerCase().includes(query)) {
                        item.style.display = ''; // Show the item
                    } else {
                        item.style.display = 'none'; // Hide the item
                    }
                });
            });

            // Clear the search field and reset the FAQ list when the clear button is clicked
            clearButton.addEventListener('click', function () {
                searchInput.value = '';
                clearButton.style.display = 'none';

                // Reset all FAQ items
                faqItems.forEach(item => {
                    const titleElement = item.querySelector('.accordion-button');
                    const answerElement = item.querySelector('.accordion-body');
                    const title = item.getAttribute('data-title');
                    const answer = item.getAttribute('data-answer');

                    // Reset the content
                    titleElement.innerHTML = title;
                    answerElement.innerHTML = answer;

                    // Show all items
                    item.style.display = '';
                });
            });

            // Update FAQ click count when opened
            const faqAccordion = document.getElementById('faqAccordion');
            faqAccordion.addEventListener('click', function (event) {
                const button = event.target.closest('.accordion-button');
                if (button && !button.classList.contains('collapsed')) {
                    const faqItem = button.closest('.accordion-item');
                    const faqId = faqItem.getAttribute('data-id');

                    // Check if the user is not an admin before updating the click count
                    const isAdmin = <?= json_encode($this->Identity->isLoggedIn() && $this->Identity->get('role') === 'admin') ?>;
                    if (!isAdmin && faqId) {
                        fetch('<?= $this->Url->build(['controller' => 'Faqs', 'action' => 'updateClickCount']) ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': '<?= $this->request->getAttribute("csrfToken") ?>'
                            },
                            body: JSON.stringify({ id: faqId })
                        })
                        .then(response => response.json())
                        .then(data => console.log('FAQ click count updated:', data))
                        .catch(error => console.error('Error updating FAQ click count:', error));
                    }
                }
            });
        });
    </script>

    </body>

</html>
