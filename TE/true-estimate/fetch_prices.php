<?php
require 'db_connection.php'; // Ensure this connects to your DB

$state = $_GET['state'] ?? '';
$city = $_GET['city'] ?? '';

if ($state && $city) {
    $query = "SELECT * FROM estimates WHERE state = ? AND city = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $state, $city);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            "cement" => [
                "ultratech" => $row["cement_ultratech"],
                "maha" => $row["cement_maha"],
                "penna" => $row["cement_penna"],
                "priya" => $row["cement_priya"]
            ],
            "sand" => [
                "river" => $row["sand_river"],
                "m-sand" => $row["sand_m"]
            ],
            "aggregate" => [
                "20mm" => $row["aggregate_20mm"],
                "40mm" => $row["aggregate_40mm"]
            ],
            "steel" => [
                "basic" => $row["steel_basic"],
                "medium" => $row["steel_medium"],
                "premium" => $row["steel_premium"]
            ],
            "paint" => [
                "standard" => $row["paint_standard"],
                "premium" => $row["paint_premium"]
            ],
            "bricks" => [
                "chamber" => $row["bricks_chamber"],
                "flyash" => $row["bricks_flyash"]
            ],
            "design" => [
                "basic" => $row["design_basic"],
                "standard" => $row["design_standard"],
                "premium" => $row["design_premium"]
            ],
            "labour" => [
                "basic" => $row["labour_basic"],
                "standard" => $row["labour_standard"],
                "premium" => $row["labour_premium"]
            ]
        ]);
    } else {
        echo json_encode(["error" => "No data found"]);
    }
} else {
    echo json_encode(["error" => "Invalid parameters"]);
}

$stmt->close();
$conn->close();
?>
