// FORM VALIDATION
const addForm = document.getElementById("add-form");
const editForm = document.getElementById("edit-form");
const categoryNameField = document.getElementById("category_name");
const editCategoryNameField = document.getElementById("categoryName");
const errorDisplay = document.getElementById("error-name");
const editErrorDisplay = document.getElementById("edit-error-name");

// MODALS

const editModal = document.getElementById("edit-modal-categories");
const deleteModal = document.getElementById("delete-dialog-categories");
const successAddModal = document.getElementById("success_category_add");
const successEditModal = document.getElementById("success_category_edit");
const successDeleteModal = document.getElementById("success_category_delete");
const confirmDeleteModal = document.getElementById("confirm_delete_category_modal");
let categoryIdToDelete = null;

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
    const errorMessage = document.getElementById("error-message");

    if (errorMessage) {
        setTimeout(function () {
            errorMessage.style.display = "none"; // Hide the success message after 3 seconds
        }, 3000); // 3000 milliseconds = 3 seconds
    }
};

// Show the add dialog
function showAddCategoryModal() {
    addModal.classList.remove("hidden");
    setTimeout(() => addModal.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}

function hideAddCategoryModal() {
    addModal.classList.add("opacity-0");
    setTimeout(() => {
        addModal.classList.add("hidden");
    }, 300); // Match the transition duration
}

// show edit dialog
function showEditCategoryModal(button) {
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const description = button.getAttribute("data-description");

    // Set values to the form fields
    document.getElementById("editCategoryId").value = id;
    document.getElementById("categoryName").value = name;
    document.getElementById("editDescription").value = description;

    editModal.classList.remove("hidden");
    setTimeout(() => editModal.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}

// hide edit dialog
function hideEditCategoryModal() {
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration
}

// Show delete modal
function showDeleteCategoryModal($categoryId) {
    categoryIdToDelete = $categoryId

    deleteModal.classList.remove("hidden");
    setTimeout(() => deleteModal.classList.remove("opacity-0"), 0);
}

// Hide delete modal
function hideDeleteCategoryModal() {
    deleteModal.classList.add("opacity-0");
    setTimeout(() => deleteModal.classList.add("hidden"), 300);
}

// Show add success modal
function showSuccessAddCategoryModal() {
    successAddModal.classList.remove("hidden");
    setTimeout(() => successAddModal.classList.remove("opacity-0"), 0);
}

// Hide add success modal
function hideSuccessAddCategoryModal() {
    successAddModal.classList.add("opacity-0");
    setTimeout(() => successAddModal.classList.add("hidden"), 300);
}

// Show edit success modal
function showSuccessEditCategoryModal() {
    successEditModal.classList.remove("hidden");
    setTimeout(() => successEditModal.classList.remove("opacity-0"), 0);
}

// Hide edit success modal
function hideSuccessEditCategoryModal() {
    successEditModal.classList.add("opacity-0");
    setTimeout(() => successEditModal.classList.add("hidden"), 300);
}

// Show delete success modal
function showSuccessDeleteCategoryModal() {
    successDeleteModal.classList.remove("hidden");
    setTimeout(() => successDeleteModal.classList.remove("opacity-0"), 0);
}

// Hide delete success modal
function hideSuccessDeleteCategoryModal() {
    successDeleteModal.classList.add("opacity-0");
    setTimeout(() => successDeleteModal.classList.add("hidden"), 300);
}

// Show confirm delete  modal
function showConfirmDeleteCategoryModal() {
    hideDeleteCategoryModal();
    document.getElementById('delete_category_id').value = categoryIdToDelete;
    confirmDeleteModal.classList.remove("hidden");
    setTimeout(() => confirmDeleteModal.classList.remove("opacity-0"), 100);
}

// Hide confirm delete  modal
function hideConfirmDeleteCategoryModal() {
    document.getElementById('password').value = "";
    confirmDeleteModal.classList.add("opacity-0");
    setTimeout(() => confirmDeleteModal.classList.add("hidden"), 300);
}

