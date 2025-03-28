<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get data from AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['game']) && isset($_POST['price'])) {
    $game = $_POST['game'];
    $price = $_POST['price'];

    // Add game to session cart
    $_SESSION['cart'][] = ["game" => $game, "price" => $price];

    // Return updated cart count
    echo count($_SESSION['cart']);
}
?>
