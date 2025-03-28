<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password, full_name FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $full_name);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["full_name"] = $full_name;
            header("Location: ../index.php");
            exit();
        } else {
            echo "<p class='error'>Invalid password.</p>";
        }
    } else {
        echo "<p class='error'>No user found.</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PS5 Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            background-image: url("image/bg3.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Chakra Petch', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            color: white;
        }

        /* Logo Styling - FIXED */
        .logo-container {
          display: flex;
          justify-content: center;
          align-items: center;
          margin-top: 20px;
        }

        /* Remove any unexpected box */
        .logo-container a {
          display: inline-flex; /* Ensures no extra space is taken */
          text-decoration: none;
          padding: 0; /* No extra spacing */
          background: transparent; /* Prevents unwanted background */
          border: none;
        }

        .logo-container img {
          display: block;
          width: 150px;
          height: auto;
          transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
          filter: drop-shadow(0 0 10px rgba(0, 162, 255, 0.8));
        }

        /* Hover effect */
        .logo-container a:hover img {
          transform: scale(1.1);
          filter: drop-shadow(0 0 15px rgba(0, 162, 255, 1));
        }

      /* Ensure NO background/borders on hover */
        .logo-container a:hover, .logo-container a:focus {
          outline: none;
          border: none;
          background: none;
          box-shadow: none;
        }

        /* Login Box */
        .container {
            width: 400px;
            margin: 0 auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        h2 {
            color: #00eaff;
            margin-bottom: 20px;
        }

        /* Input Fields */
        input[type="text"],
        input[type="password"] {
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

        /* Login Button */
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

        /* Error Message */
        .error {
            color: red;
            margin-top: 10px;
        }

        /* Login Link */
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
    </style>
</head>
<body>

<!-- ✅ Logo is now OUTSIDE the Login Box -->
<div class="logo-container">
    <a href="../index.php">
        <img src="../images/GYAT Logo.jpg" alt="PS5 Game Store Logo">
    </a>
</div>

<!-- Login Box -->
<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p><a href="forgot_password.php">Forgot Password?</a></p> <!-- Added Forgot Password link -->
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</body>
</html>
