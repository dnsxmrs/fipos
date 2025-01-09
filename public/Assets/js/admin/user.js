// Show the add dialog
function showAddUserModal() {
    const dialog = document.getElementById("add-dialog-user");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}

// Hide the add dialog
function hideAddUserModal() {
    const dialog = document.getElementById("add-dialog-user");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration
}
