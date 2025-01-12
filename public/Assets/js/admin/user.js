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

// Show edit dialog
function showEditUserModal(button) {

    const id = button.getAttribute("data-id");
    const lastName = button.getAttribute("data-lastName");
    const firstName = button.getAttribute("data-firstName");
    const email = button.getAttribute("data-email");
    const role = button.getAttribute("data-role");

    // Set values to the form fields
    document.getElementById("user_id").value = id;
    document.getElementById("edit_firstname").value = firstName;
    document.getElementById("edit_lastname").value = lastName;
    document.getElementById("edit_email").value = email;
    document.getElementById("edit_role").value = role;

    const dialog = document.getElementById("edit-dialog-user");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition

}

// Hide the edit dialog
function hideEditUserModal() {
    const dialog = document.getElementById("edit-dialog-user");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration
}
