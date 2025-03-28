<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$total = isset($_POST['amount_paid']) ? floatval($_POST['amount_paid']) : 0.00;
$payment_mode = isset($_POST['payment_mode']) ? $_POST['payment_mode'] : 'Unknown';
$orderId = strtoupper(substr(md5(uniqid()), 0, 5));

$conn->begin_transaction();

try {
    // Insert order details into 'orders' table
    $stmt = $conn->prepare("INSERT INTO orders (order_id, user_id, total_paid, payment_mode) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sids", $orderId, $user_id, $total, $payment_mode);
    $stmt->execute();
    $stmt->close();

    // Insert purchased games into 'order_items' table (No activation codes stored)
    if (isset($_SESSION['cart'])) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, game_name, price) VALUES (?, ?, ?)");

        foreach ($_SESSION['cart'] as $item) {
            $game_name = $item['game'];
            $price = $item['price'];
            $stmt->bind_param("ssd", $orderId, $game_name, $price);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Commit transaction
    $conn->commit();

    // Store order details in session for display (activation codes generated dynamically)
    $_SESSION['last_order'] = [
        "order_id" => $orderId,
        "total_paid" => $total,
        "games" => $_SESSION['cart']
    ];

    // Clear cart after successful order
    unset($_SESSION['cart']);

} catch (Exception $e) {
    $conn->rollback();
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - PS5 Store</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo">
            <img src="images/GYAT Logo.jpg" alt="PS5 Game Store Logo">
        </div>
    </div>
</header>

<section class="success-container">
    <h2>Thank You!</h2>
    <p>Your order has been placed successfully.</p>
    
    <p class="cart-total">Total Paid: ₱<?php echo number_format($total, 2, '.', ''); ?></p>
    <p class="order-id">Order ID: <strong><?php echo $orderId; ?></strong></p>

    <h3>Your Purchased Games & Activation Codes</h3>

    <div class="purchased-items">
    <?php
        if (!empty($_SESSION['last_order']['games'])) {
            foreach ($_SESSION['last_order']['games'] as $item) {
                $game_name = htmlspecialchars($item['game']);
                $activation_code = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4)) . '-' . 
                                   strtoupper(substr(md5(uniqid(mt_rand(), true)), 4, 4)) . '-' . 
                                   strtoupper(substr(md5(uniqid(mt_rand(), true)), 8, 4));

                echo "<div class='game-item'>
                        <p><strong>{$game_name}</strong></p>
                        <p>Activation Code: <span class='activation-code'>{$activation_code}</span></p>
                        <hr>
                      </div>";
            }
        } else {
            echo "<p>No games found.</p>";
        }
    ?>
    </div>

    <p>Enter these codes on your PlayStation 5 to redeem your games.</p>
    <a href="index.php" class="return-home">Return to Home</a>
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

</body>
</html>
