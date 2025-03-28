<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PS5 Game Store</title>
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

<section class="carousel">
    <div class="carousel-container">
        <div class="slide active">
            <img src="images/rdr2.jpg" alt="Red Dead Redemption 2">
            <h2>Red Dead Redemption 2</h2>
        </div>
        <div class="slide">
            <img src="images/gta.jpg" alt="GTA 5">
            <h2>GTA 5</h2>
        </div>
        <div class="slide">
            <img src="images/nba2k25.jpeg" alt="NBA 2K25">
            <h2>NBA 2K25</h2>
        </div>
        <div class="slide">
            <img src="images/ACS.jpeg" alt="Assassin's Creed Shadows">
            <h2>Assassin's Creed Shadows</h2>
        </div>
        <div class="slide">
            <img src="images/Gowr.jpg" alt="God Of War">
            <h2>God Of War Ragnarok</h2>
        </div>
        <div class="slide">
            <img src="images/MHW.jpg" alt="MH Wilds">
            <h2>Monster Hunter Wilds</h2>
        </div>
        <div class="slide">
            <img src="images/MC.jpg" alt="Minecraft">
            <h2>Minecraft</h2>
        </div>
        <div class="slide">
            <img src="images/SPDM.jpg" alt="SpiderMan">
            <h2>Spider Man 2</h2>
        </div>
        <div class="slide">
            <img src="images/elden.jpg" alt="Night Reign">
            <h2>Elden Ring Night Reign</h2>
        </div>
        <div class="slide">
            <img src="images/Forza5.jpg" alt="Forza Horizon 5">
            <h2>Forza Horizon 5</h2>
        </div>
    </div>
    <button class="prev" onclick="prevSlide()">&#10094;</button>
    <button class="next" onclick="nextSlide()">&#10095;</button>
</section>

<!-- Welcome Section -->
<section class="welcome-section">
    <h2>Welcome to GYAT HUB your Ultimate PS5 Game Store</h2>
    <p>We offer your all-encompassing platform for gaming on PlayStation 5 devices. At GYAT HUB customers can find all their desired PlayStation 5 gaming titles regardless of release type.</p>
    <p>Experience a superior shopping adventure at GYAT HUB where you can access a broad game selection for PS5 while securing your transactions through instant digital access. Accessing gaming at GYAT HUB is more than an activity since it forms the core essence of our community life.</p>

    <h2> About </h2>
    <p>GYAT HUB presents itself as the final PlayStation 5 gaming hub that exists today. Our company dedicates itself to delivering the newest PS5 games including both next-gen exclusive titles and iconic franchises which appeal to millions of fans. Everyone will discover games they love at GYAT HUB regardless of their preferences which span from action-adventure to sports and role-playing genres.</p>

    <p>GYAT HUB remains dedicated to providing customers with top game deals and steep discount opportunities for their game purchases. Users can have a trouble-free shopping process that includes speedy and safe transactions along with instant access and global reach of purchases. Every purchase through GYAT HUB guarantees secure and fast transactions along with hassle-free convenience in the world of gaming.</p>

    <p>Discover our games collection and launch into dynamic gaming right now.</p>


    <a href="buy.php" class="explore-btn">Explore Games</a>
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