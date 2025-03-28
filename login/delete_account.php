<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

if (!isset($_SESSION["user_id"])) {
    header("Location: register.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Delete user's orders first to maintain database integrity (if applicable)
$conn->query("DELETE FROM orders WHERE user_id = $user_id");

// Delete user account
$conn->query("DELETE FROM users WHERE id = $user_id");

// Destroy session and redirect to home page
session_destroy();
header("Location: register.php");
exit();
?>