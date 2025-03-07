<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pie Chart Visualization</title>
  <link href="img/ic_favicon.png" rel="icon">
  <link rel="stylesheet" href="chart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" />
</head>
<body>
  <!-- Navigation Bar -->
  <div class="navbar">
    <a href="calculator.php" class="navbar-item">
      <i class="fa-solid fa-calculator"></i><br>
      CALCULATION
    </a>
   
    <a href="chart.php" class="navbar-item">
      <i class="fa-solid fa-chart-simple"></i><br>
      PIE CHART
    </a>
  </div>

  <!-- Material Quantities Chart -->
  <div class="content">
    <h2 class="chart-heading">Material Quantities</h2>
    <div class="programming-stats">
      <div class="chart-container">
        <canvas class="quantity-chart"></canvas>
      </div>
      <div class="quantity-details">
        <ul></ul>
      </div>
    </div>

    <!-- Material Costs Chart -->
    <h2 class="chart-heading">Material Costs</h2>
    <div class="programming-stats">
      <div class="chart-container">
        <canvas class="cost-chart"></canvas>
      </div>
      <div class="cost-details">
        <ul></ul>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="chart.js"></script>
</body>
</html>