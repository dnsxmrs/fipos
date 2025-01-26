// function activeButton(buttonId, event) {
//     // Prevent default link behavior
//     event.preventDefault();

//     // Get all order buttons
//     const orderButtons = document.querySelectorAll('.order-button');
//     const allOrdersButton = document.getElementById('all-orders');

//     // Remove 'active' class from all buttons and reset background
//     orderButtons.forEach(button => {
//         button.classList.remove('bg-orange-200', 'text-orange-600');
//         button.classList.add('bg-white', 'text-orange-600');
//     });

//     // Add 'active' class based on the selected button id using if-else
//     const clickedButton = document.getElementById(buttonId);

//     // Set background for the clicked button
//     clickedButton.classList.add('bg-orange-200', 'text-orange-600');
//     clickedButton.classList.remove('bg-white');

//     // Manually navigate to the link after styling the active button
//     window.location.href = clickedButton.href;
// }

// document.addEventListener("DOMContentLoaded", function() {
//     // Set the "All Orders" button as active by default when no other button is clicked
//     const currentUrl = window.location.href;
//     const orderButtons = document.querySelectorAll('.order-button');
//     const allOrdersButton = document.getElementById('all-orders');

//     // Loop through all buttons to find the one that matches the current URL
//     orderButtons.forEach(button => {
//         if (currentUrl.includes(button.href)) {
//             // If the current URL matches the button's href, set it as active
//             button.classList.add('bg-orange-200', 'text-orange-600');
//             button.classList.remove('bg-white');
//         }
//     });
// });
