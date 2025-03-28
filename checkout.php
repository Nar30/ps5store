<?php 
session_start();

// Redirect to register.php if user is not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login/register.php");
    exit();
}

// Check if cart exists
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// If cart is empty, redirect back to cart
if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

// Calculate total price
$totalPrice = 0;
foreach ($cart as $item) {
    $totalPrice += $item['price'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - PS5 Store</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script>
        function showPaymentField() {
            var paymentMethod = document.getElementById("payment").value;
            var paymentDetailsField = document.getElementById("payment-details");
            var checkoutBtn = document.getElementById("checkout-btn");

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

            // Enable checkout button only if payment method is selected
            checkoutBtn.disabled = paymentMethod === "";
        }
    </script>
</head>
<body>

<header>
    <div class="header-container">
        <!-- Logo -->
        <div class="logo">
            <a href="index.php">
                <img src="images/GYAT Logo.jpg" alt="PS5 Game Store Logo">
            </a>
        </div>

        <!-- Navigation -->
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="buy.php">Buy Games</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="support.php">The Creators</a></li>
            </ul>
        </nav>

        <!-- Login -->
        <div class="icon-container">
            <div class="login-icon">
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="login/userinfo.php"><i class="fas fa-user-circle"></i></a>
                <?php else: ?>
                    <a href="login/register.php"><i class="fas fa-user"></i></a>
            <?php endif; ?>
        </div>

        <!-- Shopping Cart -->
        <div class="cart-icon">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </div>
</header>

<section class="checkout-form-container">
<form method="post" action="success.php" class="checkout-form">
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required>

    <label for="payment">Payment Method:</label>
    <select id="payment" name="payment_mode" onchange="showPaymentField()" required>
        <option value="">Select Payment Method</option>
        <option value="Credit Card">Credit Card</option>
        <option value="PayPal">PayPal</option>
        <option value="Gcash">Gcash</option>
    </select>

    <!-- Payment Details Placeholder -->
    <div id="payment-details"></div>

    <p class="cart-total">Total: ₱<?php echo number_format($totalPrice, 2); ?></p>

    <!-- ✅ Hidden field to pass total amount to success.php -->
    <input type="hidden" name="amount_paid" value="<?php echo $totalPrice; ?>">

    <button type="submit" id="checkout-btn" class="checkout-btn" disabled>Complete Purchase</button>
</form>

</section>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="buy.php">Buy Games</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="support.php">The Creators</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: support@gyathub.com</p>
            <p>Phone: +63 912 345 6789</p>
        </div>

        <div class="footer-section">
            <h3>Why Choose GYAT HUB?</h3>
            <p class="tagline"><i>"Big Selection, Bigger Savings."</i></p>
        </div>
    </div>

    <p class="footer-bottom">&copy; 2025 GYAT HUB Store. All rights reserved.</p>
</footer>

<script src="script.js"></script>
</body>
</html>
