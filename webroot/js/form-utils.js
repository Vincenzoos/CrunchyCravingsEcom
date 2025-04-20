/**
 * Limits the length of a textarea's input and updates the span with the current character count.
 * @param {HTMLTextAreaElement} textarea - The textarea element to monitor.
 * @param {string} spanId - The ID of the <span> element to update.
 * @param {number} maxLength - The maximum allowed number of characters.
 */
function limitInputLength(textarea , spanId, maxLength)
{
    let currentLength = textarea.value.length;

    // Limit the length of the input
    if (currentLength > maxLength) {
        textarea.value = textarea.value.substring(0, maxLength);
        currentLength = maxLength;
    }

    // Update the <span> with the current character count
    const span = document.getElementById(spanId); // Locate the <span> by its ID
    if (span) {
        span.textContent = currentLength; // Update the character count inside the span
    }
}

/**
 * This function is triggered on the input event.
 * It removes all non-digit characters and formats the number.
 * @param {HTMLInputElement} input - The input element containing the phone number.
 */
function formatPhoneNumber(value)
{
    console.log("Formatting phone number:", value);
    // Remove all non-digit characters
    value = value.replace(/\D/g, '');
    // Format as 0XXX XXX XXX
    return value.replace(/^(\d{1})(\d{3})(\d{3})(\d{3})$/, '$1$2 $3 $4');
}

/**
 * This function is triggered on the input event.
 * It removes all script tags from the input value.
 * @param {HTMLInputElement} input - The input element containing the phone number.
 */
function removeScriptTags(input)
{
    // Remove any <script> tags from the input
    input.value = input.value.replace(/<[^>]*>/g, '');
}

/**
 * Updates the initial character count in the header based on the existing content.
 * @param {string} textareaId - The ID of the textarea element.
 * @param {string} spanId - The ID of the <span> element to update.
 * @param {number} maxLength - The maximum allowed number of characters.
 */
function initializeCharacterCount(textareaId, spanId)
{
    const textarea = document.getElementById(textareaId); // Find the textarea
    const span = document.getElementById(spanId); // Find the span for the character count

    if (textarea && span) {
        const currentLength = textarea.value.length; // Get the character count
        span.textContent = currentLength; // Update the span with the current count
    }
}

// Call this function once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    initializeCharacterCount('description', 'character-count', maxLength); // Update on page load
});

