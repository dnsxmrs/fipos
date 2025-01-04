document.addEventListener("DOMContentLoaded", function () {
    filterCategories();
});

// dynamic table for searching
function filterCategories() {
    // Get the value of the search bar
    const input = document.getElementById("category_search");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("category_table");
    const rows = table.getElementsByClassName("category-row");
    const noCategoriesMessage = document.getElementById(
        "no-categories-message"
    );
    let hasVisibleRows = false;

    // Loop through all table rows and hide those that don't match the search query
    for (let i = 0; i < rows.length; i++) {
        const categoryName = rows[i]
            .getElementsByTagName("td")[1]
            .textContent.toLowerCase();

        if (categoryName.includes(filter)) {
            rows[i].style.display = ""; // Show the row
            hasVisibleRows = true; // There are visible rows
        } else {
            rows[i].style.display = "none"; // Hide the row
        }
    }

    // Show or hide the no categories message based on whether any rows are visible
    noCategoriesMessage.style.display = hasVisibleRows ? "none" : "block";
}

// Show the add dialog
function showAddDialog() {
    const dialog = document.getElementById("add-dialog");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}

// Hide the add dialog
function hideAddDialog() {
    const dialog = document.getElementById("add-dialog");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration
}

// Show the added item dialog
function showAddedDialog() {
    // Hide the Add Dialog
    hideAddDialog();
    // Show the Item Updated Dialog
    const dialog = document.getElementById("added-dialog");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

// Hide the added item dialog
function hideAddedDialog() {
    const dialog = document.getElementById("added-dialog");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}

// Show Edit Dialog
function showEditDialog(button) {
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const imagePath = button.getAttribute("data-image");

    // Debugging: Check values in the console
    console.log({
        id,
        name,
        imagePath,
    });

    document.getElementById("editCategoryId").value = id;
    document.getElementById("editCategoryName").value = name;

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

// Hide the edit dialog
function hideEditDialog() {
    const dialog = document.getElementById("edit-dialog");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}

function showEditedDialog() {
    // Hide the Edit Dialog
    hideEditDialog();
    // Show the Item Updated Dialog
    const dialog = document.getElementById("edited-dialog");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

function hideEditedDialog() {
    const dialog = document.getElementById("edited-dialog");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}

let categoryIdToDelete = null;

function showDeleteDialog(cateogryId) {
    categoryIdToDelete = cateogryId; // Store the ID of the product to delete
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

function showConfirmDelete() {
    hideDeleteDialog();
    document.getElementById("confirm-delete-dialog").classList.remove("hidden");
}

function hideConfirmDelete() {
    document.getElementById("confirm-delete-dialog").classList.add("hidden");
}

function showDeletedDialog() {
    hideConfirmDelete();
    document.getElementById("deleted-dialog").classList.remove("hidden");
}

function hideDeletedDialog() {
    document.getElementById("deleted-dialog").classList.add("hidden");
    window.location.reload(); // Reload the page to reflect deletion
}
document.getElementById("confirmButton").addEventListener("click", function () {
    // Assuming the password is always correct, directly call the delete function
    deleteItem();
});



function deleteItem() {
    fetch(`/admin/menu/categories/${categoryIdToDelete}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
    })
        .then((response) => {
            if (response.ok || response.status === 204) {
                showDeletedDialog(); // Show success modal if deletion was successful
            } else if (response.status === 400) {
                // Parse the JSON response to extract the error message
                response.json().then((data) => {
                    alert(
                        data.message ||
                            "A product is linked in the category; cannot delete the category."
                    );
                });
                hideConfirmDelete(); // Hide the confirm delete dialog
            } else {
                response.json().then((data) => {
                    alert(
                        data.message ||
                            "Failed to delete the category. Please try again."
                    );
                });
                hideConfirmDelete(); // Hide the confirm delete dialog
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An unexpected error occurred. Please try again.");
            hideConfirmDelete();
        });
}
