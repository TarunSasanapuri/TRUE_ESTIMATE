const citiesByState = {
  "Andhra Pradesh": ["Srikakulam", "Tekkali", "Pathapatnam"],
  "Odisha": ["Berhampur", "Bhubaneswar", "Paralakhemundi"],
  "Telangana": ["Hyderabad", "Warangal"]
};

// Function to update cities based on selected state
function updateCities() {
  const stateSelect = document.getElementById("state");
  const citySelect = document.getElementById("city");
  const selectedState = stateSelect.value;
  
  citySelect.innerHTML = "";

  if (selectedState in citiesByState) {
    citiesByState[selectedState].forEach(city => {
      let option = document.createElement("option");
      option.value = city;
      option.textContent = city;
      citySelect.appendChild(option);
    });
  }
}

// ** Default Prices (Fetched from Database) **
let defaultPrices = {}; // Initially empty, will be updated dynamically

// Fetch prices from the database based on selected state and city
function fetchPrices() {
  const state = document.getElementById("state").value;
  const city = document.getElementById("city").value;

  if (!state || !city) {
    alert("Please select both state and city.");
    return;
  }

  fetch(`fetch_prices.php?state=${state}&city=${city}`)
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        alert(data.error);
      } else {
        defaultPrices = data;
        console.log("Prices updated:", defaultPrices);
      }
    })
    .catch(error => console.error("Error fetching prices:", error));
}

// Global variables for wall height and thickness
let wh1 = 10; // Wall height multiplier
let wt1 = 5;  // Wall thickness multiplier

// Function to show a specific page and hide others
function showPage(pageId) {
  const pages = ["page-1", "page-2", "page-3-simple", "page-3-advanced"];
  pages.forEach((page) => {
    document.getElementById(page).style.display = page === pageId ? "block" : "none";
  });
}

// ** Event Listeners for Page Navigation **
document.getElementById("next-btn").addEventListener("click", function () {
  const state = document.getElementById("state").value;
  const city = document.getElementById("city").value;
  const area = parseFloat(document.getElementById("area").value);

  wh1 = parseFloat(document.getElementById("wh").value);
  wt1 = parseFloat(document.getElementById("wt").value);

  if (state && city && area && wh1 && wt1) {
    fetchPrices(); // Fetch updated prices before proceeding
    showPage("page-2");
  } else {
    alert("Please fill in all required fields.");
  }
});

document.getElementById("simple-mode").addEventListener("click", function () {
  showPage("page-3-simple");
});

document.getElementById("advanced-mode").addEventListener("click", function () {
  showPage("page-3-advanced");
});

document.getElementById("back-to-page-1").addEventListener("click", function () {
  showPage("page-1");
});
document.getElementById("back-to-page-2").addEventListener("click", function () {
  showPage("page-2");
});

// ** Calculation Functions **
function calculateCost(inputs, prices) {
  const { cement, sand, aggregate, steel, paint, bricks, design, labour, area } = inputs;
  const wt = wt1 / 5;
  const wh = wh1 / 10;

  const cementQty = area * 0.4 * wt * wh;
  const sandQty = area * 0.816 * wt * wh;
  const aggregateQty = area * 0.608 * wt * wh;
  const steelQty = area * 4 * wt * wh;
  const paintQty = area * 0.18 * wh;
  const bricksQty = area * 8;

  // Ensure prices exist before using them
  const cementCost = prices.cement?.[cement] * cementQty || 0;
  const sandCost = prices.sand?.[sand] * sandQty || 0;
  const aggregateCost = prices.aggregate?.[aggregate] * aggregateQty || 0;
  const steelCost = prices.steel?.[steel] * steelQty || 0;
  const paintCost = prices.paint?.[paint] * paintQty || 0;
  const bricksCost = prices.bricks?.[bricks] * bricksQty || 0;
  const designCost = prices.design?.[design] || 0;
  const labourCost = prices.labour?.[labour] * area || 0;

  const totalCost = cementCost + sandCost + aggregateCost + steelCost + paintCost + bricksCost + designCost + labourCost;

  return {
    quantities: {
      cementQty: Math.ceil(cementQty),
      sandQty: Math.ceil(sandQty),
      aggregateQty: Math.ceil(aggregateQty),
      steelQty: Math.ceil(steelQty),
      paintQty: Math.ceil(paintQty),
      bricksQty: Math.ceil(bricksQty),
    },
    costs: {
      cementCost: Math.round(cementCost),
      sandCost: Math.round(sandCost),
      aggregateCost: Math.round(aggregateCost),
      steelCost: Math.round(steelCost),
      paintCost: Math.round(paintCost),
      bricksCost: Math.round(bricksCost),
      designCost: Math.round(designCost),
      labourCost: Math.round(labourCost),
      totalCost: Math.round(totalCost),
    },
  };
}

function calculateCost1(inputs, prices) {
  const {area} = inputs;

  const wt = wt1 / 5;
  const wh = wh1 / 10;

  const cementQty = area * 0.4 * wt * wh;
  const sandQty = area * 0.816 * wt * wh;
  const aggregateQty = area * 0.608 * wt * wh;
  const steelQty = area * 4 * wt * wh;
  const paintQty = area * 0.18 * wh;
  const bricksQty = area * 8;

  const cementCost = prices.cement * cementQty;
  const sandCost = prices.sand * sandQty;
  const aggregateCost = prices.aggregate * aggregateQty;
  const steelCost = prices.steel * steelQty;
  const paintCost = prices.paint * paintQty;
  const bricksCost = prices.bricks * bricksQty;
  const designCost = prices.design;
  const labourCost = prices.labour * area;

  const totalCost =
    cementCost + sandCost + aggregateCost + steelCost + paintCost + bricksCost + designCost + labourCost;

  return {
    quantities: {
      cementQty: Math.ceil(cementQty),
      sandQty: Math.ceil(sandQty),
      aggregateQty: Math.ceil(aggregateQty),
      steelQty: Math.ceil(steelQty),
      paintQty: Math.ceil(paintQty),
      bricksQty: Math.ceil(bricksQty),
    },
    costs: {
      cementCost: Math.round(cementCost),
      sandCost: Math.round(sandCost),
      aggregateCost: Math.round(aggregateCost),
      steelCost: Math.round(steelCost),
      paintCost: Math.round(paintCost),
      bricksCost: Math.round(bricksCost),
      designCost: Math.round(designCost),
      labourCost: Math.round(labourCost),
      totalCost: Math.round(totalCost),
    },
  };
}

// ** Event Listener for Simple Calculation **
document.getElementById("calculate-simple").addEventListener("click", function () {
  const inputs = {
    cement: document.getElementById("cement").value,
    sand: document.getElementById("sand").value,
    aggregate: document.getElementById("aggregate").value,
    steel: document.getElementById("steel").value,
    paint: document.getElementById("paint").value,
    bricks: document.getElementById("bricks").value,
    design: document.getElementById("design").value,
    labour: document.querySelector('input[name="labour"]:checked')?.value,
    area: parseFloat(document.getElementById("area").value),
  };

  if (Object.values(inputs).some((val) => !val)) {
    alert("Please select all required options and ensure valid inputs.");
    return;
  }

  const results = calculateCost(inputs, defaultPrices);

  // Save results and redirect
  localStorage.setItem("quantities", JSON.stringify(results.quantities));
  localStorage.setItem("costs", JSON.stringify(results.costs));
  window.location.href = "calculator.php";
});

// ** Event Listener for Advanced Calculation **
document.getElementById("calculate-advanced").addEventListener("click", function (event) {
  event.preventDefault();
  const inputs = {
    area: parseFloat(document.getElementById("area").value),
  };
  if (Object.values(inputs).some((val) => !val)) {
    alert("Please select all required options and ensure valid inputs.");
    return;
  }

  const customPrices = {
    cement: parseFloat(document.getElementById("cement1").value),
    sand: parseFloat(document.getElementById("sand1").value),
    aggregate: parseFloat(document.getElementById("aggregate1").value),
    steel: parseFloat(document.getElementById("steel1").value),
    paint: parseFloat(document.getElementById("paint1").value),
    bricks: parseFloat(document.getElementById("brick1").value),
    design: parseFloat(document.getElementById("design1").value),
    labour: parseFloat(document.getElementById("labour1").value),
  };

  // Validate inputs
  if (Object.values(customPrices).some((value) => isNaN(value) || value <= 0)) {
    alert("Please ensure all custom prices are valid positive numbers.");
    return;
  }

  // Perform calculations
  const results = calculateCost1(inputs, customPrices);

  // Save results to localStorage
  localStorage.setItem("quantities", JSON.stringify(results.quantities));
  localStorage.setItem("costs", JSON.stringify(results.costs));

  // Redirect to calculator.html
  window.location.href = "calculator.php";
});
