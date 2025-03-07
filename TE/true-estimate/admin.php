<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

$admin_name = $_SESSION["admin_name"]; // Retrieve admin name

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "construction_estimates";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $state = $_POST["state"];
    $city = $_POST["city"];
    
    // Collect input values
    $cement_ultratech = $_POST["cement_ultratech"];
    $cement_maha = $_POST["cement_maha"];
    $cement_penna = $_POST["cement_penna"];
    $cement_priya = $_POST["cement_priya"];

    $sand_river = $_POST["sand_river"];
    $sand_m = $_POST["sand_m"];

    $aggregate_20mm = $_POST["aggregate_20mm"];
    $aggregate_40mm = $_POST["aggregate_40mm"];

    $steel_basic = $_POST["steel_basic"];
    $steel_medium = $_POST["steel_medium"];
    $steel_premium = $_POST["steel_premium"];

    $paint_standard = $_POST["paint_standard"];
    $paint_premium = $_POST["paint_premium"];

    $bricks_chamber = $_POST["bricks_chamber"];
    $bricks_flyash = $_POST["bricks_flyash"];

    $design_basic = $_POST["design_basic"];
    $design_standard = $_POST["design_standard"];
    $design_premium = $_POST["design_premium"];

    $labour_basic = $_POST["labour_basic"];
    $labour_standard = $_POST["labour_standard"];
    $labour_premium = $_POST["labour_premium"];

    // Insert data into database
    $sql = "INSERT INTO estimates (state, city, cement_ultratech, cement_maha, cement_penna, cement_priya, sand_river, sand_m, aggregate_20mm, aggregate_40mm, steel_basic, steel_medium, steel_premium, paint_standard, paint_premium, bricks_chamber, bricks_flyash, design_basic, design_standard, design_premium, labour_basic, labour_standard, labour_premium) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssssss", $state, $city, $cement_ultratech, $cement_maha, $cement_penna, $cement_priya, $sand_river, $sand_m, $aggregate_20mm, $aggregate_40mm, $steel_basic, $steel_medium, $steel_premium, $paint_standard, $paint_premium, $bricks_chamber, $bricks_flyash, $design_basic, $design_standard, $design_premium, $labour_basic, $labour_standard, $labour_premium);

    if ($stmt->execute()) {
        echo "<script>alert('Data saved successfully!');</script>";
    } else {
        echo "<script>alert('Error saving data: " . $stmt->error . "');</script>";
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
    <title>Admin Dashboard</title>
    <link href="img/ic_favicon.png" rel="icon">
    <link rel="stylesheet" href="admin.css">
    <script>
        const citiesByState = {
            "Andhra Pradesh": ["Srikakulam", "Tekkali", "Pathapatnam"],
            "Odisha": ["Berhampur", "Bhubaneswar", "Paralakhemundi"],
            "Telangana": ["Hyderabad", "Warangal"]
        };

        function updateCities() {
            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");
            const selectedState = stateSelect.value;

            citySelect.innerHTML = "<option value=''>--Select City--</option>";

            if (selectedState in citiesByState) {
                citiesByState[selectedState].forEach(city => {
                    let option = document.createElement("option");
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
            }
        }
    </script>
</head>
<body>
    <div class="overlay">
    <p style="float: right;">Hello, <?php echo htmlspecialchars($admin_name); ?> | 
    <a href="admin_login.php" style="color: #d9534f; font-weight: bold; padding: 5px 10px; background: #ffe6e6; border-radius: 5px; text-decoration: none;">Logout</a>
</p>

        <h2>Construction Estimation</h2>
        <form method="POST">
            <table>
                <tr>
                    <td><label for="state">State:</label></td>
                    <td><label for="city">City:</label></td>
                </tr>
                <tr>
                    <td>
                        <select id="state" name="state" onchange="updateCities()">
                            <option value="">--Select State--</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Telangana">Telangana</option>
                        </select>
                    </td>
                    <td>
                        <select id="city" name="city">
                            <option value="">--Select City--</option>
                        </select>
                    </td>
                </tr>
                <div class="grid">
                    <tr><td><label>Cement:</label></td></tr>
                    <tr>
                        <td><input type="number" name="cement_ultratech" placeholder="Ultratech"></td>
                        <td><input type="number" name="cement_maha" placeholder="Maha"></td>
                        <td><input type="number" name="cement_penna" placeholder="Penna"></td>
                        <td><input type="number" name="cement_priya" placeholder="Priya"></td>
                    </tr>
                    <tr><td><label>Sand:</label></td></tr>
                    <tr>
                        <td><input type="number" name="sand_river" placeholder="River Sand"></td>
                        <td><input type="number" name="sand_m" placeholder="M Sand"></td>
                    </tr>
                    
                    <tr><td><label>Aggregate:</label></td></tr>
                    <tr>
                        <td><input type="number" name="aggregate_20mm" placeholder="20mm"></td>
                        <td><input type="number" name="aggregate_40mm" placeholder="40mm"></td>
                    </tr>
                    
                    <tr><td><label>Steel:</label></td></tr>
                    <tr>
                        <td><input type="number" name="steel_basic" placeholder="Basic Grade"></td>
                        <td><input type="number" name="steel_medium" placeholder="Medium Grade"></td>
                        <td><input type="number" name="steel_premium" placeholder="Premium Grade"></td>
                    </tr>
                
                    <tr><td><label>Paint:</label></td></tr>
                    <tr>
                        <td><input type="number" name="paint_standard" placeholder="Standard"></td>
                        <td><input type="number" name="paint_premium" placeholder="Premium"></td>
                    </tr>
                    
                    <tr><td><label>Bricks:</label></td></tr>
                    <tr>
                        <td><input type="number" name="bricks_chamber" placeholder="Chamber Bricks"></td>
                        <td><input type="number" name="bricks_flyash" placeholder="Fly Ash Bricks"></td>
                    </tr>
                    
                    <tr><td><label>Design:</label></td></tr>
                    <tr>
                        <td><input type="number" name="design_basic" placeholder="Basic Design"></td>
                        <td><input type="number" name="design_standard" placeholder="Standard Design"></td>
                        <td><input type="number" name="design_premium" placeholder="Premium Design"></td>
                    </tr>

                    <tr><td><label>Labour:</label></td></tr>
                    <tr>
                        <td><input type="number" name="labour_basic" placeholder="Basic"></td>
                        <td><input type="number" name="labour_standard" placeholder="Standard"></td>
                        <td><input type="number" name="labour_premium" placeholder="Premium"></td>
                    </tr>
                </div>
            </table>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
</body>
</html>
