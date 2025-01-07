// Check if the success message exists and hide it after 3 seconds
window.onload = function() {
    const successMessage = document.getElementById("success-message");

    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none'; // Hide the success message after 3 seconds
        }, 3000); // 3000 milliseconds = 3 seconds
    }
};

// Show the add dialog
function showAddDialog() {
    const dialog = document.getElementById("add-dialog-categories");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}


function hideAddModal() {

    const dialog = document.getElementById("add-dialog-categories");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration

}

// show edit dialog
function showEditDialog(button) {

    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const description = button.getAttribute("data-description");

    // Set values to the form fields
    document.getElementById("editCategoryId").value = id;
    document.getElementById("categoryName").value = name;
    document.getElementById("editDescription").value = description;

    const dialog = document.getElementById("edit-modal-categories");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition

}


// hide edit dialog
function hideEditDialog() {

    const dialog = document.getElementById("edit-modal-categories");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration

}
