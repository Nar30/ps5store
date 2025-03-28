<?php
session_start();

// Return the count of cart items
echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
