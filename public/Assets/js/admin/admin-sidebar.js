// Toggle the dropdown menu visibility
function toggleDropdown() {
    const dropdown = document.getElementById('menuDropdown');
    const dropdownIconDefault = document.getElementById('dropdown-right');
    const dropdownIconDown = document.getElementById('dropdown-down');

    const isHidden = dropdown.classList.toggle('hidden');
    dropdownIconDefault.classList.toggle('hidden', !isHidden);
    dropdownIconDown.classList.toggle('hidden', isHidden);

    // Save the current state to localStorage
    localStorage.setItem('dropdownState', isHidden ? 'hidden' : 'visible');
}

// Load and apply the dropdown state on page load
document.addEventListener('DOMContentLoaded', () => {
    const dropdown = document.getElementById('menuDropdown');
    const dropdownIconDefault = document.getElementById('dropdown-right');
    const dropdownIconDown = document.getElementById('dropdown-down');

    const savedState = localStorage.getItem('dropdownState');
    const isHidden = savedState === 'hidden';

    dropdown.classList.toggle('hidden', isHidden);
    dropdownIconDefault.classList.toggle('hidden', !isHidden);
    dropdownIconDown.classList.toggle('hidden', isHidden);

    const links = document.querySelectorAll('.sidebar-link');
    const currentURL = window.location.href;

    links.forEach(link => {
        // Match the link href with the current URL
        if (link.href === currentURL) {
            link.classList.remove('opacity-70'); // Remove the default opacity
            link.classList.add('bg-green-900'); // Highlight the active link
            link.classList.add('bg-green-900'); // Ensure text and icon are also fully visible
        }
    });
});


