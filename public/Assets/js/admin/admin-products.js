// dynamic table for searching
function filterProducts() {
    // Get the value of the search bar
    const input = document.getElementById("product_search");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("products_table");
    const rows = table.getElementsByClassName("product_row");
    const noProductsMessage = document.getElementById("no-products-message");
    let hasVisibleRows = false;

    // Loop through all table rows and hide those that don't match the search query
    for (let i = 0; i < rows.length; i++) {
        const productName = rows[i]
            .getElementsByTagName("td")[1]
            .textContent.toLowerCase();

        if (productName.includes(filter)) {
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
function showAddDialogProducts() {
    const dialog = document.getElementById("add-dialog-products");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}
// Show the Item Successfully Added Modal
function handleSaveChangesProducts() {
    // Show the "added-dialog-products" modal
    const addedDialog = document.getElementById("added-dialog-products");
    addedDialog.classList.remove("hidden");
    setTimeout(() => addedDialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}
// Hide the Add Dialog
function hideAddDialogProducts() {
    const dialog = document.getElementById("add-dialog-products");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration
}
// Hide the Item Successfully Added Modal
function hideAddedDialogProducts() {
    const addedDialog = document.getElementById("added-dialog-products");
    addedDialog.classList.add("hidden");
}

function showEditDialogProducts(button) {
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

    const dialog = document.getElementById("edit-dialog-products");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

function hideEditDialogProducts() {
    const dialog = document.getElementById("edit-dialog-products");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}

function showItemUpdatedDialogProducts() {
    // Hide the Add Dialog
    hideAddDialogProducts();
    // Show the Item Updated Dialog
    const dialog = document.getElementById("updated-dialog-products");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

function hideItemUpdatedDialogProducts() {
    const dialog = document.getElementById("updated-dialog-products");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}

let productIdToDelete = null;

function showDeleteDialogProducts(productId) {
    productIdToDelete = productId; // Store the ID of the product to delete
    document
        .getElementById("delete-dialog-products")
        .classList.remove("hidden", "opacity-0");
    document.getElementById("delete-dialog-products").classList.add("opacity-100");
}

function hideDeleteDialogProducts() {
    document
        .getElementById("delete-dialog-products")
        .classList.add("hidden", "opacity-0");
}

// button sa first delete modal- confirm
function showConfirmDeleteModalProducts() {
    hideDeleteDialogProducts();
    document.getElementById("confirm-delete-modal-products").classList.remove("hidden");
}

// button  sa confirm delete pagka input ng password
function hideConfirmDeleteModalProducts() {
    document.getElementById("confirm-delete-modal-products").classList.add("hidden");
}

// if product is deleted show this
function showSuccessMessage() {
    hideConfirmDeleteModalProducts();
    document.getElementById("item-deleted-modal-products").classList.remove("hidden");
}

function hideSuccessMessage() {
    document.getElementById("item-deleted-modal-products").classList.add("hidden");
    window.location.reload(); // Reload the page to reflect deletion
}

document.getElementById("confirmButtonProduct").addEventListener("click", function () {
    // Assuming the password is always correct, directly call the delete function
    deleteItemProduct();
});

function deleteItemProduct() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/admin/menu/products/${productIdToDelete}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json",
        },
    })
        .then((response) => {
            if (response.status === 204) {
                // No Content response, deletion successful
                showSuccessMessage(); // Show success modal
            } else if (response.status === 200) {
                showSuccessMessage(); // Show success modal
            } else {
                alert(`Failed to delete product. Please try again. Status Code: ${response.status}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error.message);
            alert(error.message || "catch An unexpected error occurred. Please try again.");
            alert(`An unexpected error occurred. Please try again. Status Code: ${response.status}`);
            hideConfirmDeleteModalProducts(); // Hide confirmation dialog
        });
}

// // Function to hide the confirmation modal and show success modal
// document.getElementById("confirmButton").addEventListener("click", function () {
//     // Close the confirmation modal
//     document.getElementById("confirm-delete-modal-products").classList.add("hidden");
//     // Show the success modal
//     document.getElementById("item-deleted-modal-products").classList.remove("hidden");
// });

// // Function to hide the success message modal
// function hideSuccessMessage() {
//     document.getElementById("item-deleted-modal-products").classList.add("hidden"); // Hide success modal
// }
