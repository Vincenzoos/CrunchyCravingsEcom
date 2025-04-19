/**
 * Limits the length of a textarea's input and updates the label with the current length.
 * @param {HTMLTextAreaElement} textarea - The textarea element to monitor.
 */
function limitInputLength(textarea, labelId, labelName, maxLength = 150) {
    // if (!textarea) return; // Ensure textarea is defined
    let currentLength = textarea.value.length;

    // Limit the length of the input
    if (currentLength > maxLength) {
        textarea.value = textarea.value.substring(0, maxLength);
        currentLength = maxLength;
    }

    // Update the label with the current length
    const label = document.getElementById(labelId);
    if (label) {
        label.innerHTML = `${labelName} (${currentLength}/${maxLength})`;
    }
}

/**
 * This function is triggered on the input event.
 * It removes all non-digit characters and formats the number.
 * @param {HTMLInputElement} input - The input element containing the phone number.
 */
function formatPhoneNumber(value) {
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
function removeScriptTags(input) {
    // Remove any <script> tags from the input
    input.value = input.value.replace(/<[^>]*>/g, '');
}

