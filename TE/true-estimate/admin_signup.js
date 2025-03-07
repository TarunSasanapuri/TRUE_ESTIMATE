document.querySelector("form").addEventListener("submit", async (e) => {
    e.preventDefault();
  
    const name = document.querySelector('input[placeholder="Your Name"]').value;
    const email = document.querySelector('input[type="email"]').value;
    const phone = document.querySelector('input[type="tel"]').value;
    const password = document.querySelector('input[type="password"]').value;
  
    const response = await fetch("http://localhost:3000/signup", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name, email, phone, password }),
    });
  
    const result = await response.text();
    alert(result);
  });
  