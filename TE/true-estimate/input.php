<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Construction Cost Estimator</title>
  <link href="img/ic_favicon.png" rel="icon">
  <link rel="stylesheet" href="input.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- Page 1: User Input -->
  <div id="page-1">
    <div class="top-controls">
      <div class="icon">
          <i class="fa-solid fa-bell"></i>
      </div>
      <button class="top-button" onclick="window.location.href='index.php#service'">Go Pro</button>
    </div>
    <form id="input-form">
      <table>
        <tr>
          <th>Construction Cost Estimator</th>
        </tr>
      </table>
      <table>
        <tr>
          <td><label for="state">Select State:</label></td>
          <td colspan="2">
            <select id="state" name="state" onchange="updateCities()">
              <option value="">--Select State--</option>
              <option value="Andhra Pradesh">Andhra Pradesh</option>
              <option value="Odisha">Odisha</option>
              <option value="Telangana">Telangana</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><label for="city">Select City:</label></td>
          <td colspan="2">
            <select id="city" name="city">
              <option value="">--Select City--</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><label for="area">Area:</label></td>
          <td style="display: flex; align-items: center;">
            <input type="number" id="area" placeholder="Eg: 2048" required>
          </td>
          <td>
            <select id="area-unit">
              <option value="sqft">Sq.ft</option>
              <option value="sqm">Sq.m</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><label for="wh">Wall Height:</label></td>
          <td style="display: flex; align-items: center;">
            <input type="number" id="wh" placeholder="Eg: 10" required>
          </td>
          <td>
            <select id="wh-unit">
              <option value="feet">Feet</option>
              <option value="meters">Meters</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><label for="wt">Wall Thickness:</label></td>
          <td style="display: flex; align-items: center;">
            <input type="number" id="wt" placeholder="Eg: 5" required>
          </td>
          <td>
            <select id="wt-unit">
              <option value="inches">Inches</option>
              <option value="cm">Cm</option>
            </select>
          </td>
        </tr>
      </table>
      <button type="button" id="next-btn">Next</button>
    </form>
    <button class="bottom-button" style="color: #2C5375; font-size: 30px; background-color: #ffffff; border-radius: 50%;" onclick="window.location.href='https://image-extraction-translation.streamlit.app/'">
      <i class='bx bxs-conversation'></i>
    </button>
  </div>

  <!-- Page 2: Calculation Mode Selection -->
  <div id="page-2" style="display: none;">
    <h1>Select Calculation Mode</h1>
    <div>
      <button type="button" id="simple-mode">Simple Calculation</button>
      <button type="button" id="advanced-mode">Advanced Calculation</button>
    </div>
    <button type="button" id="back-to-page-1">Back</button>
  </div>

  <!-- Page 3: Simple Calculation Form -->
  <div class="calc" id="page-3-simple" style="display: none;">
    <h1 style="text-align: center">Simple Calculation</h1>
    <form id="simple-form">
      <div>
        <label for="cement">Cement:</label>
        <select id="cement">
          <option value="ultratech">Ultratech</option>
          <option value="maha">Maha</option>
          <option value="penna">Penna</option>
          <option value="priya">Priya</option>
        </select>
        <span id="cement-price"></span>
      </div>
<!-- Sand Section -->
     <div>
       <label for="sand">Sand:</label>
       <select id="sand">
         <option value="river">River Sand</option>
         <option value="m-sand">M-Sand</option>
       </select>
       <span id="sand-price"></span>
     </div>
     <!-- Aggregate Section -->
     <div>
       <label for="aggregate">Aggregate:</label>
       <select id="aggregate">
         <option value="20mm">20mm</option>
         <option value="40mm">40mm</option>
       </select>
       <span id="aggregate-price"></span>
     </div>
     <!-- Steel Section -->
     <div>
       <label for="steel">Steel:</label>
       <select id="steel">
         <option value="basic">Basic Grade</option>
         <option value="medium">Medium Grade</option>
         <option value="premium">Premium Grade</option>
       </select>
       <span id="steel-price"></span>
     </div>
     <!-- Paint Section -->
     <div>
       <label for="paint">Paint:</label>
       <select id="paint">
         <option value="standard">Standard</option>
         <option value="premium">Premium</option>
       </select>
       <span id="paint-price"></span>
     </div>
     <!-- Bricks Section -->
     <div>
       <label for="bricks">Bricks:</label>
       <select id="bricks">
         <option value="chamber">Chamber Bricks</option>
         <option value="flyash">Fly Ash Bricks</option>
       </select>
       <span id="bricks-price"></span>
     </div>
     <!-- Design and Engineering Section -->
     <div>
       <label for="design">Design and Engineering:</label>
       <select id="design">
         <option value="basic">Basic</option>
         <option value="standard">Standard</option>
         <option value="premium">Premium</option>
       </select>
       <span id="design-price"></span>
     </div>
     <!-- Labour Section -->
     <div>
       <label>Labour:</label>
       <input type="radio" name="labour" value="basic" id="labour-basic">
       <label for="labour-basic">Basic</label>
       <input type="radio" name="labour" value="standard" id="labour-standard">
       <label for="labour-standard">Standard</label>
       <input type="radio" name="labour" value="premium" id="labour-premium">
       <label for="labour-premium">Premium</label>
     </div>
      <!-- More form fields here -->
      <button type="button" id="calculate-simple">Calculate</button>
      <button type="button" id="back-to-page-2">Back</button>
    </form>
  </div>

  <!-- Page 3: Advanced Calculation Form -->
  <div class="calc" id="page-3-advanced" style="display: none;">
    <h1 style="text-align: center">Advanced Calculation</h1>
    <form id="advanced-form">
      <div>
        <label for="cement1">Cement:</label>
        <input type="number" id="cement1" placeholder="per bag" required>
        <span id="cement-price"></span>
      </div>
<!-- Sand Section -->
      <div class="adv">
        <label for="sand1">Sand:</label>
        <input type="number" id="sand1" placeholder="per ton" required>
        <span id="sand-price"></span>
      </div>
      <!-- Aggregate Section -->
      <div>
        <label for="aggregate1">Aggregate:</label>
        <input type="number" id="aggregate1" placeholder="per ton" required>
        <span id="aggregate-price"></span>
      </div>
      <!-- Steel Section -->
      <div>
        <label for="steel1">Steel:</label>
        <input type="number" id="steel1" placeholder="per Kg" required>
        <span id="steel-price"></span>
      </div>
      <!-- Paint Section -->
      <div>
        <label for="paint1">Paint:</label>
        <input type="number" id="paint1" placeholder="per lt" required>
        <span id="paint-price"></span>
      </div>
      <!-- Bricks Section -->
      <div>
        <label for="brick1">Bricks:</label>
        <input type="number" id="brick1" placeholder="per pc" required>
        <span id="bricks-price"></span>
      </div>
      <!-- Design and Engineering Section -->
      <div>
        <label for="design1">Design and Engineering:</label>
        <input type="number" id="design1" placeholder="total cost" required>
        <span id="design-price"></span>
      </div>
      <!-- Labour Section -->
      <div>
        <label>Labour:</label>
        <input type="number" id="labour1" placeholder="per sqft" required>
      </div>
      <button id="calculate-advanced">Calculate</button>
      <button type="button" id="back-to-page2">Back</button>
    </form>
  </div>

  <script>
    <?php include 'script.js'; ?>
  </script>
</body>
</html>
