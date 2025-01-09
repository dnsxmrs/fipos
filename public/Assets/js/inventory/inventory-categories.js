// FORM VALIDATION

const addForm = document.getElementById("add-form");
const editForm = document.getElementById("edit-form");
const categoryNameField = document.getElementById("itemName");
const editCategoryNameField = document.getElementById("categoryName");
const errorDisplay = document.getElementById("error-name");
const editErrorDisplay = document.getElementById("edit-error-name");

// Real-time Validation
categoryNameField.addEventListener("input", () => validateAddCategoryInputs());
editCategoryNameField.addEventListener("input", () => validateEditCategoryInputs());

// Prevent Default Submission if Validation Fails -- ADD FORM
addForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const isValid = validateAddCategoryInputs();

    if (isValid) {
        addForm.submit();
    }
});

// Prevent Default Submission if Validation Fails -- EDIT FORM
editForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const isValid = validateEditCategoryInputs();

    if (isValid) {
        editForm.submit();
    }
});

// Validation Function for adding category
function validateAddCategoryInputs() {
    const categoryNameValue = categoryNameField.value.trim();
    let valid = true;

    if (categoryNameValue === "") {
        errorDisplay.innerText = "Category name field is required.";
        categoryNameField.classList.add("border-red-500");
        categoryNameField.classList.add("focus:ring-red-300");
        categoryNameField.classList.remove("border-green-500");
        valid = false;
    } else if (!isNaN(categoryNameValue)) {
        errorDisplay.innerText = "Category name cannot contain only numbers.";
        categoryNameField.classList.add("border-red-500");
        categoryNameField.classList.add("focus:ring-red-300");
        categoryNameField.classList.remove("border-green-500");
        valid = false;
    } else {
        errorDisplay.innerText = "";
        categoryNameField.classList.remove("border-red-500");
        categoryNameField.classList.remove("focus:ring-red-300");
        categoryNameField.classList.add("border-green-500");
    }

    return valid;
}


// Validation Function for editing category
function validateEditCategoryInputs() {
    const editCategoryNameValue = editCategoryNameField.value.trim();
    let valid = true;

    if (editCategoryNameValue === "") {
        editErrorDisplay.innerText = "Category name field is required.";
        editCategoryNameField.classList.add("border-red-500");
        editCategoryNameField.classList.add("focus:ring-red-300");
        editCategoryNameField.classList.remove("border-green-500");
        valid = false;
    } else if (!isNaN(editCategoryNameValue)) {
        editErrorDisplay.innerText = "Category name cannot contain only numbers.";
        editCategoryNameField.classList.add("border-red-500");
        editCategoryNameField.classList.add("focus:ring-red-300");
        editCategoryNameField.classList.remove("border-green-500");
        valid = false;
    } else {
        editErrorDisplay.innerText = "";
        editCategoryNameField.classList.remove("border-red-500");
        editCategoryNameField.classList.remove("focus:ring-red-300");
        editCategoryNameField.classList.add("border-green-500");
    }

    return valid;
}


// Check if the success message exists and hide it after 3 seconds
window.onload = function () {
    const successMessage = document.getElementById("success-message");

    if (successMessage) {
        setTimeout(function () {
            successMessage.style.display = "none"; // Hide the success message after 3 seconds
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
