// dynamic table for searching
function filterProducts() {
    // Get the value of the search bar
    const input = document.getElementById("product_search");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("products_table");
    const rows = table.getElementsByClassName("product-row");
    const noProductsMessage = document.getElementById("no-products-message");
    let hasVisibleRows = false;

    // Loop through all table rows and hide those that don't match the search query
    for (let i = 0; i < rows.length; i++) {
        const productName = rows[i]
            .getElementsByTagName("td")[1]
            .textContent.toLowerCase();
        const categoryName = rows[i]
            .getElementsByTagName("td")[2]
            .textContent.toLowerCase();

        if (productName.includes(filter) || categoryName.includes(filter)) {
            rows[i].style.display = ""; // Show the row
            hasVisibleRows = true; // There are visible rows
        } else {
            rows[i].style.display = "none"; // Hide the row
        }
    }

    // Show or hide the no products message based on whether any rows are visible
    noProductsMessage.style.display = hasVisibleRows ? "none" : "block";
}

// Show the Add Dialog
function showAddDialog() {
    const dialog = document.getElementById("add-dialog");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}
// Show the Item Successfully Added Modal
function handleSaveChanges() {
    // Show the "added-dialog" modal
    const addedDialog = document.getElementById("added-dialog");
    addedDialog.classList.remove("hidden");
    setTimeout(() => addedDialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}
// Hide the Add Dialog
function hideAddDialog() {
    const dialog = document.getElementById("add-dialog");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration
}
// Hide the Item Successfully Added Modal
function hideAddedDialog() {
    const addedDialog = document.getElementById("added-dialog");
    addedDialog.classList.add("hidden");
}

function showEditDialog(button) {
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const description = button.getAttribute("data-description");
    const price = button.getAttribute("data-price");
    const category = button.getAttribute("data-category");
    const availability = button.getAttribute("data-availability") === "1";
    const imagePath = button.getAttribute("data-image");

    // Debugging: Check values in the console
    console.log({
        id,
        name,
        description,
        price,
        category,
        availability,
        imagePath,
    });

    document.getElementById("editProductId").value = id;
    document.getElementById("editProductName").value = name;
    document.getElementById("editProductDescription").value = description;
    document.getElementById("editProductPrice").value = price;
    document.getElementById("editCategoryId").value = category;
    document.getElementById("editIsAvailable").checked = availability;

    // Set the image if it exists
    const imageLabel = document.getElementById("editImageLabel");
    const imgElement = imageLabel.querySelector("img"); // Select the image element

    if (imagePath) {
        console.log("Image Path:", imagePath); // Check what this logs

        imgElement.src = imagePath; // Set the source of the image
        imgElement.alt = "Product Image"; // Set an alt text if needed
        imgElement.classList.remove("hidden"); // Make sure the image is visible

        // Hide the "+" and upload message
        const uploadMessage = imageLabel.querySelector(".upload-message");
        if (uploadMessage) {
            uploadMessage.classList.add("hidden"); // Hide the upload message
        }
    } else {
        imgElement.src = ""; // Clear the image source if no image path
        imgElement.classList.add("hidden"); // Hide the image if there's no path

        // Show the "+" and upload message if needed
        const uploadMessage = imageLabel.querySelector(".upload-message");
        if (uploadMessage) {
            uploadMessage.classList.remove("hidden"); // Show the upload message
        }
    }

    const dialog = document.getElementById("edit-dialog");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

function hideEditDialog() {
    const dialog = document.getElementById("edit-dialog");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}

function showItemUpdatedDialog() {
    // Hide the Add Dialog
    hideAddDialog();
    // Show the Item Updated Dialog
    const dialog = document.getElementById("updated-dialog");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

function hideItemUpdatedDialog() {
    const dialog = document.getElementById("updated-dialog");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}

let productIdToDelete = null;

function showDeleteDialog(productId) {
    productIdToDelete = productId; // Store the ID of the product to delete
    document
        .getElementById("delete-dialog")
        .classList.remove("hidden", "opacity-0");
    document.getElementById("delete-dialog").classList.add("opacity-100");
}

function hideDeleteDialog() {
    document
        .getElementById("delete-dialog")
        .classList.add("hidden", "opacity-0");
}

function showConfirmDeleteModal() {
    hideDeleteDialog();
    document.getElementById("confirm-delete-modal").classList.remove("hidden");
}

function hideConfirmDeleteModal() {
    document.getElementById("confirm-delete-modal").classList.add("hidden");
}

function showSuccessMessage() {
    hideConfirmDeleteModal();
    document.getElementById("item-deleted-modal").classList.remove("hidden");
}

function hideSuccessMessage() {
    document.getElementById("item-deleted-modal").classList.add("hidden");
    window.location.reload(); // Reload the page to reflect deletion
}

document.getElementById("confirmButton").addEventListener("click", function () {
    // Assuming the password is always correct, directly call the delete function
    deleteItem();
});

function deleteItem() {
    fetch(`/admin/menu/products/${productIdToDelete}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
    })
        .then((response) => {
            if (response.ok || response.status === 204) {
                // Include check for 204 status
                showSuccessMessage(); // Show success modal if deletion was successful
            } else {
                console.error("Error:", response);
                alert("Failed to delete the product. Please try again."); // Error handling
                console.error("Error:", response);
            }
        })
        .catch((error) => console.error("Error:", error));
}

// Function to hide the confirmation modal and show success modal
document.getElementById("confirmButton").addEventListener("click", function () {
    // Close the confirmation modal
    document.getElementById("confirm-delete-modal").classList.add("hidden");
    // Show the success modal
    document.getElementById("item-deleted-modal").classList.remove("hidden");
});

// Function to hide the success message modal
function hideSuccessMessage() {
    document.getElementById("item-deleted-modal").classList.add("hidden"); // Hide success modal
}
