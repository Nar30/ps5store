<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    
    if ($new_password !== $confirm_password) {
        echo "<p class='error'>Passwords do not match.</p>";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashed_password, $token);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Password successfully reset. Redirecting to login...'); window.location.href='login.php';</script>";
        } else {
            echo "<p class='error'>Invalid or expired token.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
</head>

<style>
    /*Reset_Password*/
    body {
        font-family: 'Chakra Petch', sans-serif;
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
        font-size: 32px;
        color: #00eaff;
        text-transform: uppercase;
        margin-bottom: 25px;
    }

    form {
        background: rgba(255, 255, 255, 0.1);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        width: 350px;
        backdrop-filter: blur(10px);
    }

    input[type="text"],
    input[type="password"] {
        width: 95%;
        padding: 14px;
        margin: 12px 0;
        border: none;
        border-radius: 6px;
        background: rgb(255, 255, 255);
        color: black;
        font-size: 18px;
        transition: all 0.3s;
    }

    input::placeholder {
        color: gray;
        font-size: 16px;
    }

    input:focus {
      outline: none;
      box-shadow: 0 0 10px rgba(0, 162, 255, 0.8);
      transform: scale(1.02);
    }

    button {
        width: 100%;
        padding: 14px;
        margin-top: 20px;
        background: #00eaff;
        color: black;
        font-size: 20px;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s ease-in-out, transform 0.2s, box-shadow 0.3s;
    }

    button:hover {
        background: #009dcf;
        transform: scale(1.08);
        box-shadow: 0 0 20px rgba(0, 157, 255, 0.8);
    }

    .error {
        color: red;
        margin-top: 12px;
        font-size: 16px;
    }

    p {
        margin-top: 18px;
        color: white;
        font-size: 16px;
    }

    a {
        color: #00eaff;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        transition: color 0.3s, box-shadow 0.3s;
    }

    a:hover {
        color: white;
        box-shadow: 0 0 12px rgba(0, 162, 255, 0.8);
        padding: 6px;
        border-radius: 6px;
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
    <h2>Reset Password</h2>
    <form method="POST">
        <input type="hidden" name="token" value="<?php echo $_GET['token'] ?? ''; ?>">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>