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
    $email = $_POST["email"];
    $password = $_POST["password"];  // No password verification here, we assume plain text check

    // Directly query the users table for email and password
    $sql = "SELECT id, password FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $stored_password);
        $stmt->fetch();
        
        // Start a session for the logged-in user
        $_SESSION["user_id"] = $id;
        header("Location: input.php"); // Redirect to user dashboard
        exit();
    } else {
        $error = "Invalid email or password.";
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
    <title>User Login</title>
    <link href="img/ic_favicon.png" rel="icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <header>
        <div class="nav container">
            <a href="index.php" class="logo" ><i class='bx bx-home'></i>TRUE ESTIMATE (USER)</a>
            <input type="checkbox" id="menu">
            <label for="menu" ><i class='bx bx-menu' id="menu-icon"></i></label>
            <ul class="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="index.php#service">Subscribe</a></li>
                <li><a href="index.php#features">Features</a></li>
            </ul>
            <a href="user_signup.php" class="btn">Sign Up</a>
        </div>
    </header>
    <div class="login container">
        <div class="login-container-wrapper">
            <div class="login-container">
                <h2>Login To Continue</h2>
                <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
                <form action="user_login.php" method="POST">
                    <span>Enter your email address</span>
                    <input type="email" name="email" placeholder="youremail@gmail.com" required>
                    <span>Enter your password</span>
                    <input type="password" name="password" placeholder="password" required>
                    <input type="submit" value="Log In" class="button">
                    <a href="#">Forget Password?</a>
                </form>
                <a href="user_signup.php" class="btn">Sign Up</a>
            </div>
        </div>
        <div class="login-image">
            <img src="./login new project.jpg" alt="">
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
