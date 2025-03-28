<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ps5_store");

if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET["id"])) {
    $message_id = $_GET["id"];

    // Delete the message
    $stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Message deleted successfully!'); window.location.href='admin_messages.php';</script>";
} else {
    echo "<script>alert('Invalid request.'); window.location.href='admin_messages.php';</script>";
}

$conn->close();
?>
