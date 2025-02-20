document.addEventListener("DOMContentLoaded", function () {
    filterCategories();
});

// dynamic table for searching
function filterCategories() {
    // Get the value of the search bar
    const input = document.getElementById("category_search");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("category_table");
    const rows = table.getElementsByClassName("category_row");
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
function showAddDialogCategories() {
    const dialog = document.getElementById("add-dialog-categories");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
}

// Hide the add dialog
function hideAddDialogCategories() {
    const dialog = document.getElementById("add-dialog-categories");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300); // Match the transition duration
}

// Show the added item dialog
function showAddedDialogCategories() {
    // Hide the Add Dialog
    hideAddDialogCategories();
    // Show the Item Updated Dialog
    const dialog = document.getElementById("added-dialog-categories");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

// Hide the added item dialog
function hideAddedDialogCategories() {
    const dialog = document.getElementById("added-dialog-categories");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}


// Show Edit Dialog
function showEditDialogCategories(button) {
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const description = button.getAttribute("data-description");
    const imagePath = button.getAttribute("data-image");
    const type = button.getAttribute("data-type");
    const beverageType = button.getAttribute("data-beverageType");

    // Debugging: Check values in the console
    console.log({
        id,
        name,
        description,
        imagePath,
        type,
        beverageType,
    });

    // Set values to the form fields
    document.getElementById("editCategoryId").value = id;
    document.getElementById("editCategoryName").value = name;
    document.getElementById("editType").value = type;
    document.getElementById("edit_beverage_type").value = beverageType;
    document.getElementById("editCategoryDescription").value = description;


    // Set the image if it exists
    const imageLabel = document.getElementById("editImageLabel");
    const imgElement = imageLabel.querySelector("img"); // Select the image element

    if (imagePath && imgElement) {
        imgElement.src = imagePath; // Set the source of the image
        imgElement.alt = "Category Image"; // Set an alt text if needed
        imgElement.classList.remove("hidden"); // Make sure the image is visible

        // Hide the "+" and upload message
        const uploadMessage = imageLabel.querySelector(".upload-message");
        if (uploadMessage) {
            uploadMessage.classList.add("hidden"); // Hide the upload message
        }
    } else {
        if (imgElement) {
            imgElement.src = ""; // Clear the image source if no image path
            imgElement.classList.add("hidden"); // Hide the image if there's no path
        }

        // Show the "+" and upload message if needed
        const uploadMessage = imageLabel.querySelector(".upload-message");
        if (uploadMessage) {
            uploadMessage.classList.remove("hidden"); // Show the upload message
        }
    }

    // Show the modal
    const dialog = document.getElementById("edit-dialog-categories");
    if (dialog) {
        dialog.classList.remove("hidden");
        setTimeout(() => dialog.classList.remove("opacity-0"), 0);
    } else {
        console.error("Dialog 'edit-dialog-categories' not found");
    }
}



// Hide the edit dialog
function hideEditDialogCategories() {
    const dialog = document.getElementById("edit-dialog-categories");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
}


function showEditedDialogCategories() {
    // Hide the Edit Dialog
    hideEditDialogCategories();
    // Show the Item Updated Dialog
    const dialog = document.getElementById("edited-dialog-categories");
    dialog.classList.remove("hidden");
    setTimeout(() => dialog.classList.remove("opacity-0"), 0);
}

function hideEditedDialogCategories() {
    const dialog = document.getElementById("edited-dialog-categories");
    dialog.classList.add("opacity-0");
    setTimeout(() => {
        dialog.classList.add("hidden");
    }, 300);
    window.location.reload();
}

let categoryIdToDelete = null;

function showDeleteDialogCategories(cateogryId) {
    categoryIdToDelete = cateogryId; // Store the ID of the product to delete
    document
        .getElementById("delete-dialog-categories")
        .classList.remove("hidden", "opacity-0");
    document.getElementById("delete-dialog-categories").classList.add("opacity-100");
}

function hideDeleteDialogCategories() {
    document
        .getElementById("delete-dialog-categories")
        .classList.add("hidden", "opacity-0");
}


//button sa first delete modal- confirm
function showConfirmDeleteCategories() {
    document.getElementById('delete_category_id').value = categoryIdToDelete;
    hideDeleteDialogCategories();
    document.getElementById("confirm-delete-dialog-categories").classList.remove("hidden");
}

// button sa confirm delete pagka input ng password - confirm
function hideConfirmDeleteCategories() {
    document.getElementById('password').value = "";
    document.getElementById("confirm-delete-dialog-categories").classList.add("hidden");
}

// shows success popup kapag category is deleted
function showDeletedDialogCategories() {
    hideConfirmDeleteCategories();
    document.getElementById("deleted-dialog-categories").classList.remove("hidden");
}

// button sa popup na success
function hideDeletedDialogCategories() {
    document.getElementById("deleted-dialog-categories").classList.add("hidden");
    window.location.reload(); // Reload the page to reflect deletion
}

// document.getElementById("confirmButtonCategory").addEventListener("click", function () {
//     // Assuming the password is always correct, directly call the delete function
//     deleteItemCategory();
// });


// function deleteItemCategory() {
//     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//     fetch(`/admin/menu/categories/${categoryIdToDelete}`, {
//         method: "DELETE",
//         headers: {
//             "X-CSRF-TOKEN": csrfToken,
//             "Content-Type": "application/json",
//         },
//     })
//         .then((response) => {
//             if (response.status === 204) {
//                 // No Content response, deletion successful
//                 showDeletedDialogCategories(); // Show success modal
//             } else if (response.status === 200) {
//                 showDeletedDialogCategories(); // Show success modal
//             } else {
//                 alert(`Failed to delete category. Please try again. Status Code: ${response.status}`);
//             }
//         })
//         .catch((error) => {
//             console.error("Error:", error.message);
//             alert(error.message || "catch An unexpected error occurred. Please try again.");
//             alert(`An unexpected error occurred. Please try again. Status Code: ${response.status}`);
//             hideConfirmDeleteCategories(); // Hide confirmation dialog
//         });
// }


function toggleBeverageType(selectElement) {
    // Get the selected value
    const selectedValue = selectElement.value;

    // Get the beverage type radio buttons
    const beverageTypeDropdown = document.getElementById('beverage_type');

    // Enable or disable the radio buttons based on the selected value
    if (selectedValue === 'beverage') {
        beverageTypeDropdown.disabled = false;
    } else {
        beverageTypeDropdown.disabled = true;
        beverageTypeDropdown.value = ""
    }
}

// Toggle for edit
function editToggleBeverageType(selectElement) {
    // Get the selected value
    const selectedValue = selectElement.value;

    // Get the beverage type dropdown
    const beverageTypeDropdown = document.getElementById('edit_beverage_type');

    // Enable or disable the dropdown based on the selected value
    if (selectedValue === 'beverage') {
        beverageTypeDropdown.disabled = false;
    } else {
        beverageTypeDropdown.disabled = true;
        // If it’s not beverage, clear the value
        beverageTypeDropdown.value = ""; // or set to the default option if desired
    }
}
