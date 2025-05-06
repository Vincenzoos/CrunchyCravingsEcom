// Function to initialize the sort dropdown
function initializeSortDropdown(sortButtonId, sortOptionsId) {
    document.addEventListener('DOMContentLoaded', function () {
        const sortButton = document.getElementById(sortButtonId);
        const sortOptions = document.getElementById(sortOptionsId);

        // Toggle the visibility of the dropdown menu
        sortButton.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the click from propagating to the document
            sortOptions.classList.toggle('show');
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', function (event) {
            if (!sortButton.contains(event.target) && !sortOptions.contains(event.target)) {
                sortOptions.classList.remove('show');
            }
        });
    });
}

// Function to initialize the filter sidebar
function initializeFilterSidebar(toggleButtonId, sidebarId, formSelector, filterFields) {
    document.addEventListener('DOMContentLoaded', function () {
        const toggleFiltersButton = document.getElementById(toggleButtonId);
        const filterSidebar = document.getElementById(sidebarId);
        const filterForm = filterSidebar.querySelector(formSelector);
        const body = document.body;

        // Function to check if the mode is mobile
        function isMobile() {
            return window.matchMedia('(max-width: 768px)').matches;
        }

        // Function to check if actual filters are being applied
        function hasFilters() {
            const urlParams = new URLSearchParams(window.location.search);

            return filterFields.some(field => {
                // Check for exact matches (e.g., "product_name")
                if (urlParams.has(field) && urlParams.get(field).trim() !== "") {
                    return true;
                }

                // Check for array-like parameters (e.g., "categories%5B_ids%5D")
                for (const [key, value] of urlParams.entries()) {
                    if (key.startsWith(field) && value.trim() !== "") {
                        return true;
                    }
                }

                return false;
            });
        }

        // Check if there are any query parameters in the URL
        if (hasFilters() && !isMobile()) {
            // Open the sidebar if there are filters in the URL and it's not mobile
            filterSidebar.classList.add('open');
            filterSidebar.classList.remove('closed');
            body.classList.add('sidebar-open');
            toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
        }

        // Toggle the sidebar when the button is clicked
        toggleFiltersButton.addEventListener('click', function () {
            if (!filterSidebar.classList.contains('open')) {
                // Show the sidebar
                filterSidebar.classList.add('open');
                filterSidebar.classList.remove('closed');
                body.classList.add('sidebar-open');
                toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
            } else {
                // Hide the sidebar
                filterSidebar.classList.remove('open');
                filterSidebar.classList.add('closed');
                body.classList.remove('sidebar-open');
                toggleFiltersButton.innerHTML = 'Show Filters <i class="fa fa-sliders"></i>';
            }
        });

        // Hide the sidebar when the filter form is submitted
        filterForm.addEventListener('submit', function () {
            filterSidebar.classList.remove('open');
            filterSidebar.classList.add('closed');
            body.classList.remove('sidebar-open');
            toggleFiltersButton.innerHTML = 'Show Filters <i class="fa fa-sliders"></i>';
        });
    });
}
