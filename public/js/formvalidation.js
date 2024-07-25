console.log("hello");

document.addEventListener("DOMContentLoaded", function () {
  const usernameInput = document.getElementById("password");
  const submitBtn = document.getElementById("submitBtn");
  const usernamevalidation = document.getElementById("username");

  function validateUsername() {
    const username = usernamevalidation.value;
    let isValid = true;

    // Error messages elements
    const lengthError = document.getElementById("usernamelengthError");
    const numberError = document.getElementById("usernamenumberError");
    // Length validation
    if (username.length < 6) {
      lengthError.classList.remove("valid");
      isValid = false;
    } else {
      lengthError.classList.add("valid");
    }

    // Number validation
    if (!/[0-9]/.test(username)) {
      numberError.classList.remove("valid");
      isValid = false;
    } else {
      numberError.classList.add("valid");
    }

    return isValid;

  }

  function validatepassword() {
    const username = usernameInput.value;
    let isValid = true;

    // Error messages elements
    const lengthError = document.getElementById("lengthError");
    const uppercaseError = document.getElementById("uppercaseError");
    const lowercaseError = document.getElementById("lowercaseError");
    const numberError = document.getElementById("numberError");
    // Length validation
    if (username.length < 6) {
      lengthError.classList.remove("valid");
      isValid = false;
    } else {
      lengthError.classList.add("valid");
    }

    // Uppercase validation
    if (!/[A-Z]/.test(username)) {
      uppercaseError.classList.remove("valid");
      isValid = false;
    } else {
      uppercaseError.classList.add("valid");
    }

    // Lowercase validation
    if (!/[a-z]/.test(username)) {
      lowercaseError.classList.remove("valid");
      isValid = false;
    } else {
      lowercaseError.classList.add("valid");
    }

    // Number validation
    if (!/[0-9]/.test(username)) {
      numberError.classList.remove("valid");
      isValid = false;
    } else {
      numberError.classList.add("valid");
    }

    return isValid;
  }

  function validateForm() {
    const isUsernameValid = validateUsername();
    const ispasswordValid = validatepassword();
    submitBtn.disabled = (!isUsernameValid || !ispasswordValid);
  }

  usernameInput.addEventListener("input", validatepassword);
  usernamevalidation.addEventListener("input", validateUsername);
  usernameInput.addEventListener("input", validateForm);
  usernamevalidation.addEventListener("input", validateForm);
});

