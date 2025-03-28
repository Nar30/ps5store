let index = 0;

function showSlide(i) {
    const slides = document.querySelectorAll(".slide");
    const container = document.querySelector(".carousel-container");

    if (i >= slides.length) {
        index = 0;
    } else if (i < 0) {
        index = slides.length - 1;
    } else {
        index = i;
    }

    container.style.transform = `translateX(-${index * 100}%)`;
}

function nextSlide() {
    showSlide(index + 1);
}

function prevSlide() {
    showSlide(index - 1);
}

// Auto-slide every 5 seconds
document.addEventListener("DOMContentLoaded", function () {
    setInterval(nextSlide, 5000);
});

// Update cart count
function updateCartCount() {
    fetch('cart_count.php')
        .then(response => response.text())
        .then(count => {
            document.querySelector('.cart-count').innerText = count;
        })
        .catch(error => console.error('Error:', error));
}

// Run updateCartCount() on page load
document.addEventListener('DOMContentLoaded', updateCartCount);

// Checkout Form Handling
document.addEventListener("DOMContentLoaded", function () {
    const paymentSelect = document.getElementById("payment");
    const paymentDetailsField = document.getElementById("payment-details");
    const amountPaidInput = document.getElementById("amount_paid");
    const errorMessage = document.getElementById("error-message");
    const checkoutButton = document.getElementById("checkout-btn");
    const checkoutForm = document.getElementById("checkout-form");

    // Show payment fields dynamically
    paymentSelect.addEventListener("change", function () {
        let paymentMethod = paymentSelect.value;
        if (paymentMethod === "Credit Card") {
            paymentDetailsField.innerHTML = `
                <label for="payment_details">Credit Card Number:</label>
                <input type="text" id="payment_details" name="payment_details" placeholder="1234-5678-9012-3456" required>
            `;
        } else if (paymentMethod === "PayPal") {
            paymentDetailsField.innerHTML = `
                <label for="payment_details">PayPal Email:</label>
                <input type="email" id="payment_details" name="payment_details" placeholder="your-email@example.com" required>
            `;
        } else if (paymentMethod === "Gcash") {
            paymentDetailsField.innerHTML = `
                <label for="payment_details">Gcash Number:</label>
                <input type="text" id="payment_details" name="payment_details" placeholder="09XXXXXXXXX" required>
            `;
        } else {
            paymentDetailsField.innerHTML = "";
        }
    });
});