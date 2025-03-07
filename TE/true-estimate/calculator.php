<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/ic_favicon.png" rel="icon">
    <title>Material Quantity and Work Cost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="calc.css">
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="#calculation" class="navbar-item">
            <i class="fa-solid fa-calculator"></i><br>
            CALCULATION
        </a>
       
        
        <a href="chart.php" class="navbar-item">
            <i class="fa-solid fa-chart-simple"></i><br>
            PIE CHART
        </a>
    </div>

    <!-- Main Content -->
    <div class="container" id="calculation">
        <h1>Material Quantity</h1>
        <table id="quantity-table">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Cement</td><td id="cement-qty"></td><td>Bags</td></tr>
                <tr><td>Sand</td><td id="sand-qty"></td><td>Tons</td></tr>
                <tr><td>Aggregate</td><td id="aggregate-qty"></td><td>Tons</td></tr>
                <tr><td>Steel</td><td id="steel-qty"></td><td>Kg</td></tr>
                <tr><td>Paint</td><td id="paint-qty"></td><td>Litres</td></tr>
                <tr><td>Bricks</td><td id="bricks-qty"></td><td>No's</td></tr>
            </tbody>
        </table>

        <h1>Material Cost</h1>
        <table id="cost-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Cost (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Cement</td><td id="cement-cost"></td></tr>
                <tr><td>Sand</td><td id="sand-cost"></td></tr>
                <tr><td>Aggregate</td><td id="aggregate-cost"></td></tr>
                <tr><td>Steel</td><td id="steel-cost"></td></tr>
                <tr><td>Paint</td><td id="paint-cost"></td></tr>
                <tr><td>Bricks</td><td id="bricks-cost"></td></tr>
                <tr><td>Design and Engineering</td><td id="design-cost"></td></tr>
                <tr><td>Labour</td><td id="labour-cost"></td></tr>
                <tr><th>Total Cost</th><th id="total-cost"></th></tr>
            </tbody>
        </table>
    </div>

    <!-- Include external JavaScript files -->
    <script src="script.js"></script>
    <script src="calc.js"></script>
</body>
</html>