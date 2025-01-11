// ELEMENTS
const addModal = document.getElementById("add-item");
const editModal = document.getElementById("edit-item");
const deleteModal = document.getElementById("delete-dialog-items");
const successAddModal = document.getElementById("success_item_add");
const successEditModal = document.getElementById("success_item_edit");
const successDeleteModal = document.getElementById("success_item_delete");


// Show add modal
function showAddItemModal() {
    addModal.classList.remove("hidden");
    setTimeout(() => addModal.classList.remove("opacity-0"), 0);
}

// Hide add modal
function hideAddItemModal() {
    addModal.classList.add("opacity-0");
    setTimeout(() => addModal.classList.add("hidden"), 300);
}

// Show edit modal
function showEditItemModal(button) {
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const category = button.getAttribute("data-category");
    const stock = button.getAttribute("data-stock");
    const unit = button.getAttribute("data-unit");
    const reorderLevel = button.getAttribute("data-reorder_level");
    const expiryDate = button.getAttribute("data-expiry_date");

    // Set values to the form fields
    document.getElementById("edit_item_id").value = id;
    document.getElementById("edit_item_name").value = name;
    document.getElementById("edit_category").value = category;
    document.getElementById("edit_stock").value = stock;
    document.getElementById("edit_unit").value = unit;
    document.getElementById("edit_reorder_level").value = reorderLevel;
    document.getElementById("edit_expiration_date").value = expiryDate;

    editModal.classList.remove("hidden");
    setTimeout(() => editModal.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}

// Hide edit modal
function hideEditItemModal() {
    editModal.classList.add("opacity-0");
    setTimeout(() => editModal.classList.add("hidden"), 300);
}

// Show delete modal
function showDeleteItemModal() {
    deleteModal.classList.remove("hidden");
    setTimeout(() => deleteModal.classList.remove("opacity-0"), 0);
}

// Hide delete modal
function hideDeleteItemModal() {
    deleteModal.classList.add("opacity-0");
    setTimeout(() => deleteModal.classList.add("hidden"), 300);
}

// Show add success modal
function showSuccessAddModal() {
    successAddModal.classList.remove("hidden");
    setTimeout(() => successAddModal.classList.remove("opacity-0"), 0);
}

// Hide add success modal
function hideSuccessAddModal() {
    successAddModal.classList.add("opacity-0");
    setTimeout(() => successAddModal.classList.add("hidden"), 300);
}

// Show edit success modal
function showSuccessEditModal() {
    successEditModal.classList.remove("hidden");
    setTimeout(() => successEditModal.classList.remove("opacity-0"), 0);
}

// Hide edit success modal
function hideSuccessEditModal() {
    successEditModal.classList.add("opacity-0");
    setTimeout(() => successEditModal.classList.add("hidden"), 300);
}

// Show delete success modal
function showSuccessDeleteModal() {
    successDeleteModal.classList.remove("hidden");
    setTimeout(() => successDeleteModal.classList.remove("opacity-0"), 0);
}

// Hide delete success modal
function hideSuccessDeleteModal() {
    successDeleteModal.classList.add("opacity-0");
    setTimeout(() => successDeleteModal.classList.add("hidden"), 300);
}

