document.addEventListener('DOMContentLoaded', function () {
    // Function to format numbers with commas
    function formatNumber(num) {
      return num.toString().replace(/\B(?=(\d{3})(\d{2})*(?!\d))/g, ",");
    }

    // Fetch quantities from localStorage
    const quantities = JSON.parse(localStorage.getItem('quantities'));
    if (quantities) {
      document.getElementById('cement-qty').textContent = formatNumber(quantities.cementQty);
      document.getElementById('sand-qty').textContent = formatNumber(quantities.sandQty);
      document.getElementById('aggregate-qty').textContent = formatNumber(quantities.aggregateQty);
      document.getElementById('steel-qty').textContent = formatNumber(quantities.steelQty);
      document.getElementById('paint-qty').textContent = formatNumber(quantities.paintQty);
      document.getElementById('bricks-qty').textContent = formatNumber(quantities.bricksQty);
    }

    // Fetch costs from localStorage
    const costs = JSON.parse(localStorage.getItem('costs'));
    if (costs) {
      document.getElementById('cement-cost').textContent = "₹ "+formatNumber(costs.cementCost);
      document.getElementById('sand-cost').textContent = "₹ "+formatNumber(costs.sandCost);
      document.getElementById('aggregate-cost').textContent = "₹ "+formatNumber(costs.aggregateCost);
      document.getElementById('steel-cost').textContent = "₹ "+formatNumber(costs.steelCost);
      document.getElementById('paint-cost').textContent = "₹ "+formatNumber(costs.paintCost);
      document.getElementById('bricks-cost').textContent = "₹ "+formatNumber(costs.bricksCost);
      document.getElementById('design-cost').textContent = "₹ "+formatNumber(costs.designCost);
      document.getElementById('labour-cost').textContent = "₹ "+formatNumber(costs.labourCost);
      document.getElementById('total-cost').textContent = "₹ "+formatNumber(costs.totalCost);
    }
  });