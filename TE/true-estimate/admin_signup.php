<?php
session_start();

// Database connection (update with your credentials)
$host = "localhost";
$username = "root";
$password = "";
$database = "construction_estimates";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"]; // Storing plain text password

    $sql = "INSERT INTO admin (name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $phone, $password);

        if ($stmt->execute()) {
            header("Location: admin_login.php"); // Redirect to login page
            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }

        $stmt->close();
    } else {
        die("SQL Error: " . $conn->error); // Display SQL error
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="style.css">
    <link href="img/ic_favicon.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <header>
        <div class="nav container">
            <a href="index.php" class="logo"><i class='bx bx-home'></i>TRUE ESTIMATE (ADMIN)</a>
            <input type="checkbox" id="menu">
            <label for="menu"><i class='bx bx-menu' id="menu-icon"></i></label>
            <ul class="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="index.php#service">Subscribe</a></li>
                <li><a href="index.php#features">Features</a></li>
            </ul>
            <a href="admin_login.php" class="btn">Log In</a>
        </div>
    </header>
    <div class="login container">
        <div class="login-container">
            <h2>Welcome, Let's get started</h2>
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
            <form action="admin_signup.php" method="POST">
                <span>Full Name</span>
                <input type="text" name="name" placeholder="Your Name" required>
                <span>Enter your email address</span>
                <input type="email" name="email" placeholder="youremail@gmail.com" required>
                <span>Phone</span>
                <input type="tel" name="phone" placeholder="Enter your number" required>
                <span>Enter your password</span>
                <input type="password" name="password" placeholder="At least 8 characters" required>
                <input type="submit" value="Sign Up" class="button">
                <p style="font-size: 16px;">Already have an account? <a href="admin_login.php" style="color: rgb(0, 119, 255); font-weight: 500; font-size: 16px;">Log in</a></p>
            </form>
        </div>
        <div class="login-image">
            <img src="./signup project.jpg" alt="">
        </div>
    </div>
    <div class="footer wow fadeIn" data-wow-delay="0.3s">
        <div class="container copyright" style="margin-top:-80px; text-align:center;">
            <div class="col-lg-12">
                <p><a href="">TRUE ESTIMATE</a></p>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <p>© <a href="">Revolutionizing Construction Estimates</a>, All Right Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
