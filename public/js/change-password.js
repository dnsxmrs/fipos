// Toggle password visibility and icons for both password and confirm password
function togglePasswordVisibility(inputId, eyeShowIconId, eyeSlashIconId) {
    const passwordField = document.getElementById(inputId);
    const eyeShowIcon = document.getElementById(eyeShowIconId);
    const eyeSlashIcon = document.getElementById(eyeSlashIconId);

    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;

    if (type === 'password') {
        // Password is hidden, show eye-slash icon
        eyeShowIcon.style.display = 'none';
        eyeSlashIcon.style.display = 'block';
    } else {
        // Password is visible, show eye icon
        eyeShowIcon.style.display = 'block';
        eyeSlashIcon.style.display = 'none';
    }
}

// Event listeners for password field and confirm password field
document.getElementById('icon-current-password').addEventListener('click', function() {
    togglePasswordVisibility('current_password', 'eye-show-icon-current', 'eye-slash-icon-current');
});

document.getElementById('icon-new-password').addEventListener('click', function() {
    togglePasswordVisibility('password', 'eye-show-icon', 'eye-slash-icon');
});


document.getElementById('icon-confirm-password').addEventListener('click', function() {
    togglePasswordVisibility('password_confirmation', 'eye-show-icon-confirm', 'eye-slash-icon-confirm');
});

