<?php
session_start();
$conn = new mysqli("localhost", "root", "", "user_system");

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $full_name = $_POST["full_name"];

    // Check if username or email already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>alert('Username or Email already taken. Please choose another.'); window.location.href='register.php';</script>";
    } else {
        $sql = "INSERT INTO users (username, email, password, full_name) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $username, $email, $password, $full_name);
            $stmt->execute();
            $stmt->close();
            header("Location: login.php"); // Redirect after successful registration
            exit();
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    }
    $check_stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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

    /* Register Form Container */
    .container {
      width: 400px;
      margin: 50px auto;
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
    input[type="email"],
    input[type="password"] {
      width: 90%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      background: rgba(255, 255, 255, 0.9);
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

    /* Register Button */
    button {
      width: 95%;
      padding: 12px;
      margin-top: 15px;
      background: #00cc00;
      color: white;
      font-size: 18px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s;
    }

    button:hover {
      background: #009900;
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(0, 255, 0, 0.8);
    }

    /* Error Message */
    .error {
      color: red;
      margin-top: 10px;
    }

    p {
      margin-top: 15px;
      color: rgba(29, 202, 225, 0.84);
    }

    /* Login Link */
    a {
      color: white;
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

  <!-- Logo -->
  <div class="logo-container">
      <a href="../index.php">
        <img src="../images/GYAT Logo.jpg" alt="PS5 Game Store Logo">
      </a>
  </div>

  <!-- Register Form -->
  <div class="container">
    <h2>Register</h2>
    <form action="register.php" method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="text" name="full_name" placeholder="Full Name" required><br>
      <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>

</body>
</html>