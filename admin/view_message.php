<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ps5_store");

if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET["id"])) {
    die("Invalid request.");
}

$message_id = $_GET["id"];

// Fetch message details
$stmt = $conn->prepare("SELECT name, email, message, created_at FROM contact_messages WHERE id = ?");
$stmt->bind_param("i", $message_id);
$stmt->execute();
$stmt->bind_result($name, $email, $message, $created_at);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <link rel="stylesheet" href="css/admin_styles.css">
</head>
<body>

<header>
    <h1>Admin Panel</h1>
    <nav>
        <ul>
            <li><a href="admin_messages.php">Admin Contact</a></li>
            <li><a href="login/admin_page.php">Admin Purchase History</a></li>
        </ul>
    </nav>
</header>

<section class="message-container">
    <h2>Message Details</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Date Sent:</strong> <?= htmlspecialchars($created_at) ?></p>
    <p><strong>Message:</strong></p>
    <div class="message-box"><?= nl2br(htmlspecialchars($message)) ?></div>

    <a href="admin_messages.php" class="back-btn">Back to Messages</a>
</section>

</body>
</html>

<style>
    /* Message Container */
    .message-container {
        width: 60%;
        margin: 50px auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 162, 255, 0.5);
        text-align: left;
        color: white;
    }

    .message-container h2 {
        color: #00eaff;
        text-align: center;
    }

    .message-box {
        background: rgba(0, 162, 255, 0.2);
        padding: 15px;
        border-radius: 8px;
        font-size: 16px;
        line-height: 1.5;
    }

    /* Back Button */
    .back-btn {
        display: inline-block;
        background: gray;
        color: white;
        padding: 12px 18px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 6px;
        transition: 0.3s ease-in-out;
        border: 2px solid transparent;
        margin-top: 15px;
    }

    .back-btn:hover {
        background: darkgray;
        border-color: white;
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(169, 169, 169, 0.7);
    }
</style>

</html>
