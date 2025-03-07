<?php
session_start();

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "construction_estimates";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // Check if the email is already registered
    $check_email = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Email is already registered!";
    } else {
        // Insert user into database
        $sql = "INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $full_name, $email, $phone, $password);
        
        if ($stmt->execute()) {
            header("Location: user_login.php"); // Redirect to login page
            exit();
        } else {
            $error = "Error registering user!";
        }
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <div class="nav container">
            <a href="index.php" class="logo"><i class='bx bx-home'></i>TRUE ESTIMATE (USER)</a>
            <input type="checkbox" id="menu">
            <label for="menu"><i class='bx bx-menu' id="menu-icon"></i></label>
            <ul class="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="index.php#service">Subscribe</a></li>
                <li><a href="index.php#features">Features</a></li>
            </ul>
            <a href="user_login.php" class="btn">Log In</a>
        </div>
    </header>

    <div class="login container">
        <div class="login-container">
            <h2>Welcome, Let's get started</h2>
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
            <form action="user_signup.php" method="POST">
                <span>Full Name</span>
                <input type="text" name="full_name" placeholder="Your Name" required>
                <span>Email Address</span>
                <input type="email" name="email" placeholder="youremail@gmail.com" required>
                <span>Phone</span>
                <input type="tel" name="phone" placeholder="Enter your number" required>
                <span>Password</span>
                <input type="password" name="password" placeholder="At least 8 characters" required>
                <input type="submit" value="Sign Up" class="button">
            </form>
            <p>Already have an account? <a href="user_login.php">Log in</a></p>
        </div>
        <div class="login-image">
            <img src="./signup project.jpg" alt="">
        </div>
    </div>
</body>
</html>
