<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    
    // Check if the user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        
        // Store token in the database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE username = ?");
        $stmt->bind_param("ss", $token, $username);
        $stmt->execute();
        
        // Redirect to reset password page
        header("Location: reset_password.php?token=$token");
        exit();
    } else {
        echo "<p class='error'>Username not found.</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
</head>
<style>
    /*Forget_Password*/
    body {
    background-image: url("image/bg3.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    text-align: center;
    color: white;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    }

    h2 {
        font-size: 28px;
        color: #00eaff;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    form {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        width: 300px;
        backdrop-filter: blur(10px);
    }

    input[type="text"] {
        width: 90%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        background: rgb(255, 255, 255);
        color: black;
        font-size: 16px;
        transition: all 0.3s;
    }

    input::placeholder {
        color: gray;
    }

    input:focus {
      outline: none;
      box-shadow: 0 0 10px rgba(0, 162, 255, 0.8);
      transform: scale(1.02);
    }

    button {
        width: 95%;
        padding: 12px;
        margin-top: 15px;
        background: #00eaff;
        color: black;
        font-size: 18px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease-in-out, transform 0.2s, box-shadow 0.3s;
    }

    button:hover {
        background: #009dcf;
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(0, 157, 255, 0.8);
    }

    .error {
        color: red;
        margin-top: 10px;
    }

    p {
        margin-top: 15px;
        color: white;
    }

    a {
        color: #00eaff;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s, box-shadow 0.3s;
    }

    a:hover {
        color: white;
        box-shadow: 0 0 10px rgba(0, 162, 255, 0.8);
        padding: 5px;
        border-radius: 5px;
    }

    /*Logo Styling*/
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: -150px;
    }

    .logo-container a {
        display: inline-flex;
        text-decoration: none;
        padding: 0;
        background: transparent;
        border: none;
    }

    .logo-container img {
        display: block;
        width: 150px;
        height: auto;
        transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
        filter: drop-shadow(0 0 10px rgba(0, 162, 255, 0.8));
    }

    .logo-container a:hover img {
        transform: scale(1.1);
        filter: drop-shadow(0 0 15px rgba(0, 162, 255, 1));
    }

    .logo-container a:hover, .logo-container a:focus {
        outline: none;
        border: none;
        background: none;
        box-shadow: none;
    }
</style>

<div class="logo-container">
    <a href="../index.php">
        <img src="../images/GYAT Logo.jpg" alt="PS5 Game Store Logo">
    </a>
</div>

<body>
    <h2>Forgot Password</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter your username" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>