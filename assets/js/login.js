document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("register-form");

  form.addEventListener("submit", function (e) {
    const email = document.getElementById("email").value.trim();
    const confirmEmail = document.getElementById("confirm-email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    const errors = [];

    // Email confirmation
    if (email !== confirmEmail) {
      errors.push("Les adresses email ne correspondent pas.");
    }

    // Password validation
    const passwordRegex = /^(?=.*[A-Z])(?=(?:.*\d){2,})(?=.*[^A-Za-z0-9]).{8,32}$/;
    if (!passwordRegex.test(password)) {
      errors.push("Le mot de passe doit contenir entre 8 et 32 caractères, au moins une majuscule, deux chiffres et un caractère spécial.");
    }

    // Password confirmation
    if (password !== confirmPassword) {
      errors.push("Les mots de passe ne correspondent pas.");
    }

    // Block form if errors
    if (errors.length > 0) {
      e.preventDefault();
      alert(errors.join("\n"));
    }
  });
});
