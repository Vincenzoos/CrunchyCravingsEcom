// Function to download the report as a PDF
function downloadReportAsPdf(buttonId, containerSelector, filename) {
    document.getElementById(buttonId).addEventListener('click', function () {
        const element = document.querySelector(containerSelector);

        // Get the element's width and height
        const elementWidth = element.offsetWidth;
        const elementHeight = element.offsetHeight;

        // Convert dimensions to inches (1 inch = 96px)
        const pdfWidth = elementWidth / 96;
        const pdfHeight = elementHeight / 96;

        // Configure html2pdf options
        const options = {
            margin: 0,
            filename: filename,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2, // Higher scale for better quality
                ignoreElements: (el) => el.classList.contains('ignore-for-pdf') // Ignore elements with this class
            },
            jsPDF: { unit: 'in', format: [pdfWidth, pdfHeight] } // Match content dimensions
        };

        // Generate and download the PDF
        html2pdf().set(options).from(element).save();
    });
}

// Function to create a bar chart
function createBarChart(canvasId, labels, data, label, backgroundColor, borderColor) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


function initializeReportPage(config) {
    const { downloadButtonId, containerSelector, filename, chartConfig } = config;

    // Initialize the download button
    if (downloadButtonId && containerSelector && filename) {
        downloadReportAsPdf(downloadButtonId, containerSelector, filename);
    }

    // Initialize the chart
    if (chartConfig) {
        const { canvasId, labels, data, label, backgroundColor, borderColor } = chartConfig;
        createBarChart(canvasId, labels, data, label, backgroundColor, borderColor);
    }
}
