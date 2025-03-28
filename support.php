<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ps5_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='support.php';</script>";
    } else {
        echo "<script>alert('Failed to send message.'); window.location.href='support.php';</script>";
    }

    $stmt->close();
}
$conn->close();
// Team Members
$creators = [
    [
        "name" => "Aryon",
        "image" => "images/aryon.png",
        "desc" => "Website Maker",
        "social" => [
            "github" => "https://github.com/Nar30",
            "instagram" => "https://instagram.com/yonar30",
            "spotify" => "https://open.spotify.com/user/31ygmenrgtz537rqut4e2zghawlq?si=2b0c65b499ae4cd7",
            "youtube" => "https://youtube.com/@yonar3098"
        ]
    ],
    [
        "name" => "Yuan",
        "image" => "images/yuan.png",
        "desc" => "Website Maker",
        "social" => [
            "github" => "https://github.com/Peperoni-coder",
            "instagram" => "https://instagram.com/yutwooo_",
            "spotify" => "https://open.spotify.com/user/31tvdzukthniwmu3ifztfhbrxelu?si=db8362c70c1a4c47",
            "youtube" => "https://youtube.com/@b13.chinyuancarlo23"
        ]
    ],
    [
        "name" => "Gab",
        "image" => "images/gab.jpg",
        "desc" => "Website Maker & Database",
        "social" => [
            "instagram" => "https://instagram.com/gabedwrd",
            "ps4" => "https://profile.playstation.com/Tracer1of1"
        ]
    ],
    [
        "name" => "Tim",
        "image" => "images/tim.jpg",
        "desc" => "Website Maker & Database",
        "social" => [
            "github" => "https://github.com/TRIVINOTMTHY",
            "instagram" => "https://instagram.com/dnltmthytrvn",
            "youtube" => "https://youtube.com/@dainieltimothytrivino1412"
        ]
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support the Creators - PS5 Store</title>
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
    </div>
</header>

<section class="support-welcome">
    <h2>Meet the Team</h2>
    <p>Our team is passionate about bringing you the best PlayStation 5 gaming experience. Meet the creators behind the magic!</p>
</section>

<section class="creator-list">
    <?php foreach ($creators as $creator): ?>
        <div class="creator">
            <div class="creator-img-box">
                <img src="<?php echo $creator['image']; ?>" alt="<?php echo $creator['name']; ?>">
            </div>
            <h3><?php echo $creator['name']; ?></h3>
            <p><?php echo $creator['desc']; ?></p>
            <div class="social-links">
                <a href="<?php echo $creator['social']['instagram']; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                <?php if (isset($creator['social']['ps4'])): ?>
                    <a href="<?php echo $creator['social']['ps4']; ?>" target="_blank"><i class="fas fa-gamepad"></i></a>
                <?php endif; ?>
                <?php if (isset($creator['social']['github'])): ?>
                    <a href="<?php echo $creator['social']['github']; ?>" target="_blank"><i class="fab fa-github"></i></a>
                <?php endif; ?>
                <?php if (isset($creator['social']['spotify'])): ?>
                    <a href="<?php echo $creator['social']['spotify']; ?>" target="_blank"><i class="fab fa-spotify"></i></a>
                <?php endif; ?>
                <?php if (isset($creator['social']['youtube'])): ?>
                    <a href="<?php echo $creator['social']['youtube']; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<!-- Contact Us Section -->
<section class="contact-us">
    <h2>Contact Us</h2>
    <p>Have any questions or feedback? Send us a message!</p>
    <form action="support.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
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
