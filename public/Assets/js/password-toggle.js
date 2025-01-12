const togglePassword = document.getElementById("toggle-password");
const passwordField = document.getElementById("password");
const eyeShowIcon = document.getElementById("eye-show-icon");
const eyeSlashIcon = document.getElementById("eye-slash-icon");

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
