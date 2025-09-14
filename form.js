document.getElementById("contactForm").addEventListener("submit", function (e) {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();
  
    // Prosta walidacja
    if (name === "" || email === "" || message === "") {
      e.preventDefault();
      alert("Proszę wypełnić wszystkie pola.");
      return;
    }
  
    // Walidacja e-maila
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      e.preventDefault();
      alert("Proszę podać poprawny adres e-mail.");
      return;
    }
  });
  