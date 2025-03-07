// Fetch data from localStorage
const quantities = JSON.parse(localStorage.getItem('quantities'));
const costs = JSON.parse(localStorage.getItem('costs'));

// Redirect if data is missing
if (!quantities || !costs) {
  alert('No data available for visualization. Please perform the calculation first.');
  window.location.href = "calculator.php"; // Redirect back if no data
}

// Prepare data for the charts
const chartData = {
  quantityLabels: ["Cement", "Sand", "Aggregate", "Steel", "Paint", "Bricks"], // Quantities labels
  costLabels: ["Cement", "Sand", "Aggregate", "Steel", "Paint", "Bricks", "Labour", "Design and Engineering"], // Costs labels
  quantities: [
    quantities.cementQty,
    quantities.sandQty,
    quantities.aggregateQty,
    quantities.steelQty,
    quantities.paintQty,
    quantities.bricksQty,
  ],
  costs: [
    costs.cementCost,
    costs.sandCost,
    costs.aggregateCost,
    costs.steelCost,
    costs.paintCost,
    costs.bricksCost,
    costs.labourCost, // Added Labour Cost
    costs.designCost, // Added Design and Engineering Cost
  ],
};

// Create Pie Chart for Quantities
const quantityChart = document.querySelector(".quantity-chart");
new Chart(quantityChart, {
  type: "doughnut",
  data: {
    labels: chartData.quantityLabels, // Only Material Labels
    datasets: [
      {
        label: "Material Quantities",
        data: chartData.quantities,
        backgroundColor: [
          "#FF6384",
          "#36A2EB",
          "#FFCE56",
          "#4BC0C0",
          "#9966FF",
          "#FF9F40",
        ],
        hoverOffset: 4,
      },
    ],
  },
  options: {
    plugins: {
      legend: {
        position: "bottom",
      },
    },
  },
});

// Populate List with Quantities
const quantityList = document.querySelector(".quantity-details ul");
chartData.quantityLabels.forEach((label, index) => {
  const li = document.createElement("li");
  li.innerHTML = `${label}: <span class='percentage'>${chartData.quantities[index]} units</span>`;
  quantityList.appendChild(li);
});

// Create Pie Chart for Costs
const costChart = document.querySelector(".cost-chart");
new Chart(costChart, {
  type: "doughnut",
  data: {
    labels: chartData.costLabels, // All Labels including Labour and Design
    datasets: [
      {
        label: "Material Costs",
        data: chartData.costs,
        backgroundColor: [
          "#FF6384",
          "#36A2EB",
          "#FFCE56",
          "#4BC0C0",
          "#9966FF",
          "#FF9F40",
          "#FF7F50", // New color for Labour
          "#87CEFA", // New color for Design
        ],
        hoverOffset: 4,
      },
    ],
  },
  options: {
    plugins: {
      legend: {
        position: "bottom",
      },
    },
  },
});

// Populate List with Costs
const costList = document.querySelector(".cost-details ul");
chartData.costLabels.forEach((label, index) => {
  const li = document.createElement("li");
  li.innerHTML = `${label}: <span class='percentage'>₹${chartData.costs[index]}</span>`;
  costList.appendChild(li);
});
