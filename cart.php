<?php
session_start();

// Check if cart exists
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Remove item from cart
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
    header("Location: cart.php"); 
    exit();
}

// Clear cart
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
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
    <title>Shopping Cart - PS5 Store</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

<section class="cart-welcome">
    <h2>Your Shopping Cart</h2>
    <p>Review your selected games and proceed to checkout.</p>
</section>

<section class="cart-list">
    <?php if (empty($cart)): ?>
        <p class="empty-cart">Your cart is empty.</p>
        <a href="buy.php" class="buy-back">Go back</a>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $index => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['game']); ?></td>
                        <td>₱<?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <a href="cart.php?remove=<?php echo $index; ?>" class="remove-btn" onclick="setTimeout(updateCartCount, 500);">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="cart-total">Total: ₱<?php echo number_format($totalPrice, 2); ?></p>

        <div class="cart-actions">
            <a href="cart.php?clear=true" class="clear-btn" onclick="setTimeout(updateCartCount, 500);">Clear Cart</a>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            <a href="buy.php" class="buy-back">Go back</a>
        </div>
    <?php endif; ?>
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
