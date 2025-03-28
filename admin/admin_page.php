<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

// Check if admin is logged in
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

// Retrieve all user orders and purchase history
$orders = [];
$result = $conn->query("SELECT o.order_id, o.user_id, u.full_name, u.username, o.total_paid, o.order_date, o.payment_mode, i.game_name 
                        FROM orders o 
                        LEFT JOIN order_items i ON o.order_id = i.order_id 
                        JOIN users u ON o.user_id = u.id
                        ORDER BY o.order_date DESC");

while ($row = $result->fetch_assoc()) {
    $order_id = $row['order_id'];

    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'user_id' => $row['user_id'],
            'full_name' => $row['full_name'],
            'username' => $row['username'],
            'total_paid' => $row['total_paid'],
            'order_date' => $row['order_date'],
            'payment_mode' => $row['payment_mode'],
            'games' => []
        ];
    }

    // Add game if exists
    if (!empty($row['game_name'])) {
        $orders[$order_id]['games'][] = $row['game_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Purchase History</title>
    <link rel="stylesheet" href="css/admin_styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <h1>Admin Panel</h1>
    <nav>
        <ul>
            <li><a href="admin_messages.php">Admin Contact</a></li>
            <li><a href="admin_page.php">Admin Purchase History</a></li>
        </ul>
    </nav>
</header>

<section class="purchase-history">
    <h2>Admin Panel - Purchase History</h2>
    <?php if (empty($orders)): ?>
        <p>No purchases recorded.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Buyer Name</th>
                    <th>Username</th>
                    <th>Games</th>
                    <th>Total Paid</th>
                    <th>Payment Method</th> 
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order_id => $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order_id); ?></td>
                        <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['username']); ?></td>
                        <td><?php echo !empty($order['games']) ? implode(", ", $order['games']) : "No Games"; ?></td>
                        <td>₱<?php echo number_format($order['total_paid'], 2); ?></td>
                        <td><?php echo htmlspecialchars($order['payment_mode']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="logout-container">
            <a href="admin_login.php" class="logout-btn">Logout</a>
        </div>
    <?php endif; ?>
</section>

</body>
</html>
