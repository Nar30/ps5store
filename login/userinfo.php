<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Retrieve user details
$stmt = $conn->prepare("SELECT full_name, username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($fullName, $username);
$stmt->fetch();
$stmt->close();

// Retrieve user's orders and purchase history
$orders = [];
$result = $conn->query("SELECT o.order_id, o.total_paid, o.order_date, i.game_name 
                        FROM orders o 
                        JOIN order_items i ON o.order_id = i.order_id 
                        WHERE o.user_id = $user_id 
                        ORDER BY o.order_date DESC");

while ($row = $result->fetch_assoc()) {
    $orders[$row['order_id']]['total_paid'] = $row['total_paid'];
    $orders[$row['order_id']]['order_date'] = $row['order_date'];
    $orders[$row['order_id']]['games'][] = $row['game_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info - PS5 Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Logo Styling */
        .logo img {
            height: 150px; /* Adjust logo size */
            width: auto;   /* Maintains aspect ratio */
            transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out; /* Smooth transition on hover */
            filter: drop-shadow(0 0 10px rgba(0, 162, 255, 0.8)); /* Initial glow effect */
        }

        /* Hover Effect */
        .logo img:hover {
            transform: scale(1.1); /* Slightly enlarge the logo on hover */
            filter: drop-shadow(0 0 15px rgba(0, 162, 255, 1)); /* Stronger glow effect on hover */
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.9);
            padding: 30px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            z-index: 1000;
        }

        .footer-container {
            width: 100%;
            max-width: 1200px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            text-align: left;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .footer-section {
            flex: 1;
            min-width: 200px;
            margin: 10px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #00eaff;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin: 8px 0;
        }

        .footer-section ul li a {
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-section ul li a:hover {
            color: #00eaff;
        }

        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icons a {
            color: white;
            font-size: 20px;
            transition: 0.3s;
        }

        .social-icons a:hover {
            color: #00eaff;
        }

        .footer-bottom {
            margin-top: 20px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .tagline {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: left;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<header>
    <div class="header-container">
        <!-- Logo -->
        <div class="logo">
            <a href="../index.php">
                <img src="../images/GYAT Logo.jpg" alt="PS5 Game Store Logo">
            </a>
        </div>

        <!-- Login -->
        <div class="icon-container">
            <div class="login-icon">
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="../login/userinfo.php"><i class="fas fa-user-circle"></i></a>
                <?php else: ?>
                    <a href="../login/register.php"><i class="fas fa-user"></i></a>
            <?php endif; ?>
        </div>

        <!-- Shopping Cart -->
        <div class="cart-icon">
            <a href="../cart.php">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </div>
</header>

<section class="user-container">
<div class="user-info">
        <h2>User Information</h2>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($fullName); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        
        <!-- Logout Button -->
        <div class="button-container">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <!-- Delete Account Button -->
        <div class="button-container">
            <form action="delete_account.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                <button type="submit" class="delete-btn">Delete Account</button>
            </form>
        </div>
    </div>
    </div>

    <div class="purchase-history">
        <h2>Purchase History</h2>
        <?php if (empty($orders)): ?>
            <p>No purchases yet.</p>
            <a href="../buy.php" class="buy-back">Buy Games</a>
        <?php else: ?>
            <table class="purchase-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Games</th>
                        <th>Total Paid</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order_id => $order): ?>
                        <tr>
                            <td><?php echo $order_id; ?></td>
                            <td><?php echo implode(", ", $order['games']); ?></td>
                            <td>₱<?php echo number_format($order['total_paid'], 2); ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="../buy.php" class="buy-back">Go Back</a>
        <?php endif; ?>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../buy.php">Buy Games</a></li>
                <li><a href="../checkout.php">Checkout</a></li>
                <li><a href="../support.php">The Creators</a></li>
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