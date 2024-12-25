function showDropdown() {
    const dropdown = document.getElementById('profile-dropdown');

    // Ensure the dropdown exists
    if (dropdown) {
        dropdown.classList.toggle('hidden'); // Toggle visibility
        dropdown.classList.toggle('block');  // Ensure it's displayed when visible
    } else {
        console.error('Dropdown element not found');
    }
}


function showLogoutModal() {

    const logoutModal = document.getElementById('logout-modal');

    if (logoutModal) {

        logoutModal.classList.toggle('hidden');

    }
    else {
        console.error('Modal not found.');
    }

}


function hideLogoutModal() {

    const logoutModal = document.getElementById('logout-modal');

    if (logoutModal) {

        logoutModal.classList.toggle('hidden');
        showDropdown();

    }

}
