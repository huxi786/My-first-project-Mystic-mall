// File: /js/cart-ajax.js

// Wait for the document to be fully loaded
$(document).ready(function() {

    /**
     * Updates the cart count badge in the header by fetching the count from the server.
     */
    function updateCartCount() {
        $.ajax({
            url: './Php/api_get_cart_count.php', // The API endpoint we created in Step 1
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.cartCount > 0) {
                    $('#cart-item-count').text(response.cartCount).show();
                } else {
                    $('#cart-item-count').hide();
                }
            },
            error: function() {
                console.error("Error: Could not fetch the cart count from the server.");
            }
        });
    }

    /**
     * Intercepts the submission of any form with the class 'add-to-cart-form'.
     * Instead of a normal page reload, it sends the form data via AJAX.
     */
    $(document).on('submit', '.add-to-cart-form', function(e) {
        e.preventDefault(); // This is crucial to stop the form from reloading the page

        var form = $(this);
        var formData = form.serialize(); // Gathers all form input data

        $.ajax({
            url: form.attr('action'), // Gets the URL from the form's 'action' attribute (e.g., add_to_cart.php)
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Update the cart count badge with the new count from the server's response
                if (response.cartCount > 0) {
                    $('#cart-item-count').text(response.cartCount).show();
                } else {
                    $('#cart-item-count').hide();
                }

                // Show a user-friendly notification message
                showCustomAlert(response.message, response.success);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                showCustomAlert('An error occurred while communicating with the server.', false);
            }
        });
    });

    /**
     * Displays a temporary, non-blocking alert message to the user.
     * @param {string} message - The message to display.
     * @param {boolean} isSuccess - Determines the color (true for green, false for red).
     */
    function showCustomAlert(message, isSuccess) {
        // Remove any alert that might already be visible
        $('.custom-alert').remove();

        var alertClass = isSuccess ? 'alert-success' : 'alert-danger';
        var alertHTML = `
            <div class="alert ${alertClass} custom-alert alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        // Add the new alert to our container div
        $('#alert-container').append(alertHTML);

        // Make the alert fade out after 5 seconds
        setTimeout(function() {
            $('.custom-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 5000);
    }

    // Call the function once on page load to get the initial cart count
    updateCartCount();
});
