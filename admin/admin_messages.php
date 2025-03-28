<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ps5_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect to login if not authenticated
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch messages securely
$stmt = $conn->prepare("SELECT id, name, email, message, created_at FROM contact_messages ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messages</title>
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
<h2>Admin Panel - Contact Messages</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row["id"]) ?></td>
        <td><?= htmlspecialchars($row["name"]) ?></td>
        <td><?= htmlspecialchars($row["email"]) ?></td>
        <td><?= nl2br(htmlspecialchars(substr($row["message"], 0, 50))) ?>...</td>
        <td><?= htmlspecialchars($row["created_at"]) ?></td>
        <td>
            <a href="view_message.php?id=<?= $row['id'] ?>" class="view-btn">View Message</a>
            <a href="delete_message.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<div class="logout-container">
    <a href="admin_login.php" class="logout-btn">Logout</a>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>