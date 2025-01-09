const togglePassword = document.getElementById("toggle-password");
const passwordField = document.getElementById("password");
const eyeShowIcon = document.getElementById("eye-show-icon");
const eyeSlashIcon = document.getElementById("eye-slash-icon");
const emailField = document.getElementById("email");
const form = document.getElementById("login-form");

/**
 *  PASSWORD VISIBILITY
 */
togglePassword.addEventListener("click", function () {
    // Toggle the type attribute
    const type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;

    // Toggle the icons visibility
    if (type === "password") {
        // Password is hidden, show eye-slash icon
        eyeShowIcon.style.display = "none";
        eyeSlashIcon.style.display = "block";
    } else {
        // Password is visible, show eye icon
        eyeShowIcon.style.display = "block";
        eyeSlashIcon.style.display = "none";
    }
});

/***
 *  FORM VALIDATION
 */
form.addEventListener("submit", (e) => {
    e.preventDefault();
    const isValid = validateInputs();

    if (isValid) {
        form.submit();
    }
});

// Validate inputs if form is submitted
function validateInputs() {

    let valid = true;

    if (!validateEmail()) {
        valid = false;
    }

    if (!validatePassword()) {
        valid = false;
    }

    return valid;
}


// Add event listeners to trigger validation on input change
emailField.addEventListener("input", () => validateEmail());
passwordField.addEventListener("input", () => validatePassword());

function validateEmail() {
    const emailValue = emailField.value.trim();
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/;

    console.log("Validating email:", emailValue); // Debugging log

    const errorDisplay = document.getElementById("email-error"); // Get the error message div

    if (emailValue === "") {
        errorDisplay.innerText = "Email field is required"; // Populate error message
        emailField.classList.add("border-red-500");
        emailField.classList.remove("focus:border-blue-400");
        return false;
    } else if (!emailRegex.test(emailValue)) {
        errorDisplay.innerText = "Provide a valid email address"; // Populate error message
        emailField.classList.add("border-red-500");
        emailField.classList.remove("focus:border-blue-400");
        return false;
    } else {
        errorDisplay.innerText = ""; // Clear error message
        emailField.classList.remove("border-red-500");
        emailField.classList.remove("focus:border-blue-400");
        emailField.classList.add("focus:border-green-500");
        return true;
    }
}


function validatePassword() {
    const passwordValue = passwordField.value.trim();

    console.log("Validating password:", passwordValue); // Debugging log

    const errorDisplay = document.getElementById("password-error"); // Get the error message div

    if (passwordValue === "") {
        errorDisplay.innerText = "Password field is required"; // Populate error message
        passwordField.classList.add("border-red-500");
        passwordField.classList.remove("focus:border-blue-400");
        return false;
    } else {
        errorDisplay.innerText = ""; // Clear error message
        passwordField.classList.remove("border-red-500");
        passwordField.classList.remove("focus:border-blue-400");
        passwordField.classList.add("focus:border-green-500");
        return true;
    }
}
