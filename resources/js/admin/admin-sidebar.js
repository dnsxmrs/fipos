// Toggle the dropdown menu visibility
function toggleDropdown() {
    const dropdown = document.getElementById('menuDropdown');

    const isHidden = dropdown.classList.toggle('hidden');

    // Save the current state to localStorage
    localStorage.setItem('dropdownState', isHidden ? 'hidden' : 'visible');
}

// Load and apply the dropdown state on page load
document.addEventListener('DOMContentLoaded', () => {
    const dropdown = document.getElementById('menuDropdown');

    const savedState = localStorage.getItem('dropdownState');
    const isHidden = savedState === 'hidden';

    dropdown.classList.toggle('hidden', isHidden);

});


