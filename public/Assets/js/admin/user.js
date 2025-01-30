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
    const status = button.getAttribute("data-status");

    // Set values to the form fields
    document.getElementById("user_id").value = id;
    document.getElementById("edit_firstname").value = firstName;
    document.getElementById("edit_lastname").value = lastName;
    document.getElementById("edit_email").value = email;
    document.getElementById("edit_role").value = role;

    // Set value to radio buttons for 'is_activated'
    if (status === "active") {
        document.getElementById("status_active").checked = true;
    } else if (status === "deactivated") {
        document.getElementById("status_deactivated").checked = true;
    }

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

let userId = null;

function showDeleteDialogUsers(userIdToDelete) {
    userId = userIdToDelete; // Store the ID of the product to delete
    document
        .getElementById("delete-dialog-users")
        .classList.remove("hidden", "opacity-0");
    document.getElementById("delete-dialog-users").classList.add("opacity-100");
}

function hideDeleteDialogUsers() {
    document
        .getElementById("delete-dialog-users")
        .classList.add("hidden", "opacity-0");
}

// button sa first delete modal- confirm
function showConfirmDeleteModalUsers() {
    console.log(userId);
    document.getElementById('delete_user_id').value = userId;
    hideDeleteDialogUsers();
    document.getElementById("confirm-delete-modal-user").classList.remove("hidden");
}


// button  sa confirm delete pagka input ng password
function hideConfirmDeleteModalUsers() {
    document.getElementById('password').value = "";
    document.getElementById("confirm-delete-modal-user").classList.add("hidden");
}

function showConfirmAddModalUsers() {
    document.getElementById("confirm-add-modal-user").classList.remove("hidden");
}

function hideConfirmAddModalUsers() {
    document.getElementById('password').value = "";
    document.getElementById("confirm-add-modal-user").classList.add("hidden");
}

