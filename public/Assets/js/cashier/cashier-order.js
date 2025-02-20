// Get modal elements
const paymentModal = document.getElementById("paymentModal");
const cashModal = document.getElementById("cashModal");
const paymentSuccessModal = document.getElementById("paymentSuccessModal");

// Get button elements
const openCashModalBtn = document.getElementById("openCashModal");
const closePaymentModalBtn = document.getElementById("closeModal");
const closeCashModalBtn = document.getElementById("closeCashModal");
const submitCashBtn = document.getElementById("submitCash");
const closeSuccessModalBtn = document.getElementById("closeSuccessModal");
const cashAmountInput = document.getElementById("cash-amount");

// for computations
let subTotal = 0.0;
let payableAmount = 0.0;
const orderItems = {};
const tax = 0.12;
let discountType;
let discountAmount = 0.0;
let modeOfPayment = null;
let change = 0.0;

/**
 *  ADD ORDERS TO THE RIGHT PANEL
 */
function addItemToOrder(button) {
    const name = button.getAttribute("data-name");
    const price = parseFloat(button.getAttribute("data-price"));

    // Check if the item is already in the order
    if (orderItems[name]) {
        // If item exists, increase the quantity
        orderItems[name].quantity++;
        orderItems[name].price += price;

        // Update the quantity and price in the DOM
        const itemRow = document.getElementById("item-" + name);
        itemRow.querySelector(".item-qty").textContent =
            orderItems[name].quantity;
        itemRow.querySelector(".item-price").textContent = `₱ ${orderItems[
            name
        ].price.toFixed(2)}`;
    } else {
        // If item does not exist, add it to the order
        orderItems[name] = {
            quantity: 1,
            price: price,
        };

        // Add the item to the right panel
        const orderItem = `
                    <div class="flex mt-2 text-sm space-x-3" id="item-${name}">
                        <span class="w-1/4 text-left">${name}</span>
                        <span class="w-1/4 text-center flex items-center justify-center space-x-2">
                            <button class="decrease-qty p-3 flex items-center justify-center border border-gray-300 bg-amber-900 text-white rounded-md w-[23px] h-[20px]" onclick="changeQuantity('${name}', -1)">-</button>
                            <span class="item-qty">${
                                orderItems[name].quantity
                            }</span>
                            <button class="increase-qty p-3 flex items-center justify-center border border-gray-300 bg-amber-900 text-white rounded-md w-[23px] h-[20px]" onclick="changeQuantity('${name}', 1)">+</button>
                        </span>
                        <span class="w-1/4 text-center item-price">₱ ${orderItems[
                            name
                        ].price.toFixed(2)}</span>
                        <button class="remove-item text-red-700" onclick="removeItem('${name}')">Remove</button>
                    </div>
                `;

        // Append the new item to the order list
        document
            .getElementById("order-items-container")
            .insertAdjacentHTML("beforeend", orderItem);
    }

    // Update the total
    updateTotal(price);
}

/**
 * UPDATE THE TOTAL PRICE CALCULATION
 */
function updateTotal(priceChange) {
    subTotal += priceChange; // Update the global total variable
    taxAmount = subTotal * tax; // Calculate tax

    // Check if a discount is applied
    discountType = document.getElementById("discount-dropdown").value;
    discountAmount = 0;

    // Apply discount based on type
    if (discountType === "senior citizen" || discountType === "pwd") {
        discountAmount = subTotal * 0.2; // 20% discount
    }

    payableAmount = subTotal - discountAmount + taxAmount; // Update global payableAmount

    // Update the display values
    document.getElementById("sub-total").textContent = `₱ ${subTotal.toFixed(
        2
    )}`;
    document.getElementById("tax").textContent = `₱ ${taxAmount.toFixed(2)}`;
    document.getElementById(
        "discount"
    ).textContent = `- ₱ ${discountAmount.toFixed(2)}`;
    document.getElementById(
        "payable-amount"
    ).textContent = `₱ ${payableAmount.toFixed(2)}`;
}

// Add event listener to the discount dropdown
document
    .getElementById("discount-dropdown")
    .addEventListener("change", function () {
        updateTotal(0); // Call updateTotal to recalculate with the updated discount
    });

/**
 *  UPDATE THE QUANTITY AND PRICE
 */
function changeQuantity(name, change) {
    if (orderItems[name]) {
        const pricePerItem = orderItems[name].price / orderItems[name].quantity; // Price per item

        if (change < 0 && orderItems[name].quantity === 1) {
            // If the quantity is already 1, do not allow to decrease below 0, remove item instead
            removeItem(name);
        } else {
            orderItems[name].quantity += change;

            // Update price after quantity change
            orderItems[name].price = pricePerItem * orderItems[name].quantity;

            // Update the quantity and price in the DOM
            const itemRow = document.getElementById("item-" + name);
            itemRow.querySelector(".item-qty").textContent =
                orderItems[name].quantity;
            itemRow.querySelector(".item-price").textContent = `₱ ${orderItems[
                name
            ].price.toFixed(2)}`;

            // Update the total after the change
            updateTotal(change * pricePerItem);
        }
    }
}

/**
 *  REMOVE THE ITEM FROM THE LIST OF ORDERS
 */
function removeItem(name) {
    if (orderItems[name]) {
        const pricePerItem = orderItems[name].price / orderItems[name].quantity;
        subTotal -= orderItems[name].price; // Subtract the full price of the item from the total
        payableAmount = subTotal - discountAmount + taxAmount; // Update global payableAmount
        delete orderItems[name];

        document.getElementById(
            "sub-total"
        ).textContent = `₱ ${subTotal.toFixed(2)}`;
        document.getElementById(
            "payable-amount"
        ).textContent = `₱ ${payableAmount.toFixed(2)}`;
        document.getElementById("item-" + name).remove();

        // If no items are left, reset totals
        if (Object.keys(orderItems).length === 0) {
            resetOrder();
        } else {
            // Update the total after removal
            updateTotal(-orderItems[name].price); // Ensure total isn't negative
        }
    }
}

/**
 * RESET ORDER LIST AND TOTALS
 */
function resetOrder() {
    // reset the value
    subTotal = 0;
    taxAmount = 0;
    discountAmount = 0;
    payableAmount = 0;

    // display the reset value
    document.getElementById("sub-total").textContent = `₱ ${subTotal.toFixed(
        2
    )}`;
    document.getElementById("tax").textContent = `₱ ${taxAmount.toFixed(2)}`;
    document.getElementById(
        "discount"
    ).textContent = `₱ ${discountAmount.toFixed(2)}`;
    document.getElementById(
        "payable-amount"
    ).textContent = `₱ ${payableAmount.toFixed(2)}`;
}

/**
 * PROCESS CASH PAYMENT
 */
function processCashPayment() {
    try {
        // assign value to the mode of payment
        modeOfPayment = document.getElementById("openCashModal").value;
        // get the cash amount input
        const cashAmount = parseFloat(cashAmountInput.value.trim());
        // assign value to the mode of payment
        modeOfPayment = document.getElementById("openCashModal").value;

        if (!cashAmount) {
            // Notify the user about the missing input
            alert("Please enter the cash amount before proceeding.");
            cashAmountInput.focus();
            return;
        }

        if (cashAmount >= payableAmount) {
            // subtract the payable to the cash amount
            change = cashAmount - payableAmount;
            // document.getElementById("cash-amount-text").textContent = `₱ ${cashAmount.toFixed(2)}`;
            // document.getElementById("cash-change").textContent = `₱ ${change.toFixed(2)}`;

            // submit the order
            payCash();
        } else {
            alert("Insufficient amount. Please enter the correct amount");
            cashAmountInput.focus();
            return;
        }

        // compare if
    } catch (error) {
        alert("Please enter a valid number");
        console.log(error);
        // cashAmountInput.focus();
        return;
    }
}

function showReceipt() {
    // hide cashmodal
    cashModal.classList.add("hidden");
    // populate the receipt
    populateReceipt();
    document.getElementById("receiptModal").classList.remove("hidden");
}

function populateReceipt() {
    // Get the receipt container
    const cashvalue = parseFloat(cashAmountInput.value.trim());
    const receiptContainer = document.getElementById("receipt-container");
    receiptContainer.innerHTML = ""; // Clear the previous receipt

    // Add the receipt items
    Object.keys(orderItems).forEach((name) => {
        const item = orderItems[name];
        const itemRow = `
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>${item.quantity}</span>
                <span>${name}</span>
                <span>₱ ${item.price.toFixed(2)}</span>
            </div>`;
        receiptContainer.insertAdjacentHTML("beforeend", itemRow);
    });

    // Update the subtotal, discount, and total prices
    document.getElementById("subTotal").textContent = `₱ ${subTotal.toFixed(2)}`;
    document.getElementById("taxReceipt").textContent = `₱ ${taxAmount.toFixed(2)}`;
    document.getElementById("discount").textContent = `₱ ${discountAmount.toFixed(2)}`;
    document.getElementById("totalPrice").textContent = `₱ ${payableAmount.toFixed(2)}`;
    document.getElementById("cash").textContent = `₱ ${cashvalue.toFixed(2)}`;
    document.getElementById("change").textContent = `₱ ${change.toFixed(2)}`;
}

// Add event listener to the Print button
document.getElementById("printReceipt").addEventListener("click", function () {
    printReceipt();
    reloadPage();
});
// Add event listener to the Print button
document.getElementById("printOnlineReceipt").addEventListener("click", function () {
    printReceipt();
    reloadPage();
});

function printReceipt() {
    // Select the receipt modal content
    const receiptContent = document.getElementById("receipt-content").innerHTML;

    // Open a new window for printing
    const printWindow = window.open("", "_blank");
    printWindow.document.open();

    // Write receipt content to the new window
    printWindow.document.write(`
        <html>
        <head>
            <title>Receipt</title>
            <style>
                body {
                    font-family: Poppins, sans-serif;
                    margin: 20px;
                }
                h2, p {
                    text-align: center;
                }

                .receipt {
                    border: 1px solid #ddd;
                    padding: 10px;
                    margin: 10px auto;
                    max-width: 400px;
                }
                .flex {
                    display: flex;
                    justify-content: space-between;
                }
                .bold {
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="receipt">
                ${receiptContent}
            </div>
        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.focus();

    // Trigger the print dialog
    printWindow.print();

    // Close the print window after printing
    printWindow.onafterprint = () => printWindow.close();
}


function showOnlineReceipt() {
    // hide cashmodal
    cashModal.classList.add("hidden");
    // populate the receipt
    populateOnlineReceipt();
    document.getElementById("onlineReceiptModal").classList.remove("hidden");
}

function populateOnlineReceipt() {
    // Get the receipt container
    const cashvalue = parseFloat(cashAmountInput.value.trim());
    const receiptContainer = document.getElementById("online-receipt-container");
    receiptContainer.innerHTML = ""; // Clear the previous receipt

    // Add the receipt items
    Object.keys(orderItems).forEach((name) => {
        const item = orderItems[name];
        const itemRow = `
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>${item.quantity}</span>
                <span>${name}</span>
                <span>₱ ${item.price.toFixed(2)}</span>
            </div>`;
        receiptContainer.insertAdjacentHTML("beforeend", itemRow);
    });

    // Update the subtotal, discount, and total prices
    document.getElementById("onlineSubTotal").textContent = `₱ ${subTotal.toFixed(2)}`;
    document.getElementById("onlineDiscount").textContent = `₱ ${discountAmount.toFixed(2)}`;
    document.getElementById("onlineTotalPrice").textContent = `₱ ${payableAmount.toFixed(2)}`;
}


/***
 *  Filter Menu
 */
function filterItems(category, event) {

    // Remove 'active' class from all categories
    const categoryButtons = document.querySelectorAll('.category-button');
    categoryButtons.forEach(button => {
        button.classList.remove('bg-green-200', 'text-green-800' );
        button.classList.add('bg-white', 'text-green-800');
    });

    // Remove active class from "All Menu" button
    const allMenuBtn = document.getElementById('all-menu-btn');
    allMenuBtn.classList.remove('bg-green-200');
    allMenuBtn.classList.add('bg-white');

    // Add 'active' class to the clicked category
    const clickedButton = document.getElementById('category-' + category);
    if (category === 'all') {
        // If "All Menu" is clicked, make it active
        allMenuBtn.classList.add('bg-green-200');
        allMenuBtn.classList.remove('bg-white');
    } else {
        clickedButton.classList.add('bg-green-200');
        clickedButton.classList.remove('bg-white');
    }

    // Filter items based on the category
    const items = document.querySelectorAll('.item-button');
    items.forEach(item => {
        if (category === 'all' || item.getAttribute('data-category') === category) {
            item.style.display = 'block';  // Show item
        } else {
            item.style.display = 'none';   // Hide item
        }
    });
}

/**
 * POPULATE THE CASH MODAL
 */
function populateCashModal() {
    console.log("Payable Amount:", payableAmount);
    console.log("Sub Total:", subTotal);
    console.log("Tax Amount:", taxAmount);
    console.log("Discount Amount:", discountAmount);

    const orderSummaryContainer = document.getElementById("cash-order-summary");
    const cashTotal = document.getElementById("cash-total");
    const cashSubTotal = document.getElementById("cash-subtotal");
    const cashDiscount = document.getElementById("cash-discount");
    const cashTax = document.getElementById("cash-tax");

    // Clear the previous summary
    orderSummaryContainer.innerHTML = "";

    // Populate order items
    Object.keys(orderItems).forEach((name) => {
        const item = orderItems[name];
        const itemRow = `
        <div class="flex justify-between text-sm text-gray-600 mb-2">
            <span>${item.quantity}   ${name}</span>
            <span>₱ ${item.price.toFixed(2)}</span>
        </div>`;
        orderSummaryContainer.insertAdjacentHTML("beforeend", itemRow);
    });

    // Update total in cash modal
    cashTotal.textContent = `₱ ${payableAmount.toFixed(2)}`;
    cashSubTotal.textContent = `₱ ${subTotal.toFixed(2)}`;
    cashDiscount.textContent = `- ₱ ${discountAmount.toFixed(2)}`;
    cashTax.textContent = `₱ ${taxAmount.toFixed(2)}`;
}

/**
 * Success Message
 */
function success() {
    Swal.fire({
        title: "Successful Payment!",
        text: "Successfully processed the payment and placed the order.",
        icon: "success"
    }).then(() => {
        showReceipt();
        // reloadPage(); // Reload the page after the Swal alert
    });

    // cashModal.classList.add("hidden"); // Hide cash modal
    // paymentSuccessModal.classList.remove("hidden"); // Show success modal
    // reloadPage();
}

/**
 * Reload the page
 */
function reloadPage(forceReload = false) {
    resetOrder();
    location.reload(forceReload);
}

// back to payment method modal
function backToPaymentMethod() {
    cashModal.classList.add("hidden");
    paymentModal.classList.remove("hidden");
}

/**
 * MODALS
 */

// Modify the event listener for opening the cash modal
openCashModalBtn.addEventListener("click", () => {
    populateCashModal(); // Call this function to populate data
    cashModal.classList.remove("hidden");
});

// Open Cash Modal
openCashModalBtn.addEventListener("click", () => {
    cashModal.classList.remove("hidden");
    paymentModal.classList.add("hidden");
});

// Close Payment Modal
closePaymentModalBtn.addEventListener("click", () => {
    paymentModal.classList.add("hidden");
});

// // Close Cash Modal
// closeCashModalBtn.addEventListener("click", () => {
//     cashModal.classList.add("hidden");
// });

// Show Payment Successful Modal
// submitCashBtn.addEventListener("click", () => {
//     cashModal.classList.add("hidden"); // Hide cash modal
//     paymentSuccessModal.classList.remove("hidden"); // Show success modal
// });

// Close Payment Successful Modal
closeSuccessModalBtn.addEventListener("click", () => {
    paymentSuccessModal.classList.add("hidden");
    reloadPage();
});

// Close Payment Modal
document.getElementById("closeModal").addEventListener("click", () => {
    paymentModal.classList.add("hidden");
});

// // Optional: Close the modal when clicking outside of it
// window.addEventListener("click", (event) => {
//     const modal = document.getElementById("paymentModal");
//     if (event.target === modal) {
//         modal.classList.add("hidden");
//     }
// });

// Open Payment Modal
document.getElementById("openModal").addEventListener("click", () => {
    // check if there are items in the order
    if (Object.keys(orderItems).length === 0) {
        alert("Please add items to the order first.");
        return;
    }

    paymentModal.classList.remove("hidden");
});
