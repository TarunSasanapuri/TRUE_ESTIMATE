// script.js

// Function to toggle sections
function showSection(sectionId) {
    document.querySelectorAll('section').forEach(section => {
      section.classList.add('hidden');
    });
    document.getElementById(sectionId).classList.remove('hidden');
  }
  
  // Default calculations
  const builtUpArea = 546; // Example data
  const costPerSqFt = 1641.67; // Example data
  
  // Calculations
  const houseCost = builtUpArea * costPerSqFt;
  const cementBags = builtUpArea * 0.4;
  const cementCost = (16.4 / 100) * houseCost;
  const sandQuantity = builtUpArea * 1.9;
  const sandCost = (12.3 / 100) * houseCost;
  
  // Update DOM
  document.getElementById('built-up-area').textContent = builtUpArea;
  document.getElementById('cost-per-sqft').textContent = costPerSqFt.toFixed(2);
  document.getElementById('house-cost').textContent = houseCost.toFixed(2);
  
  document.getElementById('built-up-area-cement').textContent = builtUpArea;
  document.getElementById('cement-bags').textContent = cementBags.toFixed(2);
  document.getElementById('total-cost').textContent = houseCost.toFixed(2);
  document.getElementById('cement-cost').textContent = cementCost.toFixed(2);
  
  document.getElementById('built-up-area-sand').textContent = builtUpArea;
  document.getElementById('sand-quantity').textContent = sandQuantity.toFixed(2);
  document.getElementById('total-cost-sand').textContent = houseCost.toFixed(2);
  document.getElementById('sand-cost').textContent = sandCost.toFixed(2);
  