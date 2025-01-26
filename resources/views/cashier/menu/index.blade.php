@extends('layouts.cashier-layout')

@section('cashier_content')
    {{-- LEFT PANNEL --}}

    {{-- ALL ITEMS --}}
    <div class="mr-[550px] ">
        <div class="my-5">
            <p class="text-xl font-medium text-gray-700">Menu</p>
            <p class="text-sm text-gray-500">A list of all available menu.</p>
        </div>

        <div class="my-5 gap-2 flex flex-wrap items-center justify-start mr-10 mb-10">
            {{-- all menu button (active by default) --}}
            <button
                class="p-4 border px-5 text-green-800 rounded-lg shadow h-[55px] text-center cursor-pointer hover:bg-green-100 active:bg-green-200 bg-green-200"
                onclick="filterItems('all', event)" id="all-menu-btn">
                All Menu
            </button>

            <!-- Category Buttons -->
            @foreach ($categories as $category)
                <span id="category-{{ $category->category_name }}" onclick="filterItems('{{ $category->category_name }}', event)"
                    class="category-button flex items-center justify-center border p-4 text-green-800 px-5 rounded-lg shadow-md h-[55px] text-center cursor-pointer hover:bg-green-100 active:bg-green-200 bg-white ">
                    <img class="rounded-lg h-11 inline object-cover mr-3 p-1" src="{{ asset($category->image) }}"
                        alt="{{ $category->category_name }}">
                    <span>{{ $category->category_name }}</span>
                </span>
            @endforeach
        </div>

        <div>
            <div id="all-items" class="flex flex-wrap gap-3">

                {{-- Display the menu --}}
                @foreach ($items as $item)
                    <button
                        class="item-button block p-4 border border-gray-300 rounded-lg shadow-md w-[200px] hover:bg-green-100 bg-white hover:text-green-700 product-card"
                        data-category="{{ $item->category->category_name }}" data-name="{{ $item->product_name }}"
                        data-price="{{ $item->product_price }}" onclick="addItemToOrder(this)">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->product_name }}"
                            class="rounded-lg w-[200px] h-[150px] object-cover mb-4">
                        <p class="text-center text-lg font-semibold"> {{ $item->product_name }} </p>
                        <p class="text-center text-gray-500"> {{ $item->product_price }} </p>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div
        class="flex flex-col fixed right-0 top-24 p-4 w-[550px] h-[calc(100vh-6rem)] border border-gray-300 rounded-lg bg-white justify-between">
        <!-- Header and Order Type -->
        <div class="h-1/4">
            <h2 class="text-xl font-semibold mb-4 ml-3 mt-3">Current Order</h2>
            <div class="mx-10">
                <select name="order-type" id="order-type"
                    class="p-2 border border-gray-300 rounded-lg shadow-md w-full h-[40px] text-xs cursor-pointer bg-white hover:bg-amber-900 hover:text-white active:bg-amber-600">
                    <option value="dine-in">Dine in</option>
                    <option value="take-out">Take out</option>
                </select>
            </div>

            <!-- Header row with underline and aligned text -->
            <div class="flex mt-10 text-sm space-x-4 font-medium text-gray-800 border-b pb-2 mx-3">
                <p class="w-1/4 text-left">Item</p>
                <p class="w-1/4 text-center">Quantity</p>
                <p class="w-1/4 text-center">Price</p>
                <p class=""></p>
            </div>
        </div>

        <!-- Items List and Scrollable Container -->
        <div class="flex-1 mt-6 overflow-y-auto">
            <div id="order-items-container" class="mx-4">
                <!-- Dynamically added items will appear here -->
            </div>
        </div>

        <!-- Total Calculation Section (Fixed at Bottom) -->
        <div class="sticky bottom-0 bg-white">
            <div class="border-t mt-2">
                <div class="flex justify-between text-sm font-semibold text-gray-600 ml-6 mr-8 mt-5">
                    <span class="text-center">Sub Total</span>
                    <span class="text-center" id="sub-total">₱ 0.00</span>
                </div>
                <div class="flex justify-between text-sm font-semibold text-gray-600 ml-6 mr-8 mt-5">
                    <span class="text-center">Discount</span>
                    <span class="text-center" id="discount">- ₱ 0.00</span>
                </div>
                <div class="flex justify-between text-sm font-semibold text-gray-600 ml-6 mr-8 mt-5">
                    <span class="text-center">Tax</span>
                    <span class="text-center" id="tax">₱ 0.00</span>
                </div>

                <div class="flex justify-between text-l font-bold text-black ml-6 mr-8 mt-5">
                    <span class="text-center">Payable Amount</span>
                    <span class="text-center" id="payable-amount">₱ 0.00</span>
                </div>
            </div>

<<<<<<< HEAD
        
            <div class="flex justify-between mt-8 ml-6 mr-8 text-sm text-gray-200">
=======
            <div class="flex justify-between text-sm ml-6 mr-8 mt-8">
                <p>Add a Discount: </p>
                <select
                    class="w-50 h-[40px] text-center font-regular text-green-500 bg-white border border-green-500 hover:bg-gray-100 px-4 py-2 rounded-lg focus:outline-none focus:ring-0 focus:ring-green-500"
                    id="discount-dropdown">
                    <option value="none" selected>None</option>
                    <option value="senior citizen">Senior Citizen</option>
                    <option value="pwd">PWD</option>
                </select>
            </div>

            <div class="flex justify-between text-sm text-gray-200 ml-6 mr-8 mt-8">
>>>>>>> 5b1dc92d4694d914b8bbeb2eb3c15e73553726d4
                <button id="openModal"
                    class="text-center w-full font-regular text-white bg-green-900 hover:bg-green-600 px-4 py-2 mb-5 rounded-full">
                    Continue to Payment
                </button>
            </div>
        </div>
    </div>

    </div>


    <!-- PAYMENT MODE MODAL -->
    <div id="paymentModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-[400px] p-6">
            <h2 class="text-lg font-semibold text-gray-800 text-center">Payment Details</h2>
            <p class="mt-2 text-sm text-gray-600 text-center">Select payment method.</p>
            <div class="mt-4 flex flex-col items-center space-y-4">
                <button id="openCashModal" value="cash"
                    class="w-[120px] px-4 py-2 bg-blue-200 text-black border border-blue-500 rounded-full hover:bg-gray-200 mt-4">
                    Cash
                </button>
                <button id="cashlessButton" value="cashless" onclick="payCashless()"
                    class="w-[120px] px-4 py-2 bg-blue-200 text-black border border-blue-500 rounded-full hover:bg-gray-200">
                    Cashless
                </button>
            </div>
            <div class="mt-4 flex justify-center">
                <button id="closeModal"
                    class="w-[160px] mt-6 px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- CASH PAYMENT MODAL -->
    <div id="cashModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-[400px] p-6">
            <h2 class="text-lg font-semibold text-gray-800 text-center">Cash Payment</h2>
            <p class="mt-2 text-sm text-gray-600 text-center font-bold">Order Summary</p>

            <!-- Header row with underline and aligned text -->
            <div class="flex justify-between text-sm font-semibold text-gray-600 mt-5 pb-2 ml-6 mr-8">
                <span class=" text-center">Quantity</span>
                <span class=" text-center">Item</span>
                <span class="">Price</span>
            </div>

            <!-- Dynamic Order Summary Section -->
            <div class="mt-4 border-t border-gray-300 pt-4" id="cash-order-summary">
                <!-- Items will be appended here dynamically -->
            </div>

            <div class="flex justify-between text-sm font-bold text-gray-800 mt-4 border-t border-gray-300 pt-2">
                <span>Sub Total</span>
                <span id="cash-subtotal">₱ 0.00</span>
            </div>
            <div class="flex justify-between text-sm font-bold text-gray-800 mt-4  pt-2">
                <span>Discount</span>
                <span id="cash-discount">₱ 0.00</span>
            </div>
            <div class="flex justify-between text-sm font-bold text-gray-800 mt-4  pt-2">
                <span>Tax</span>
                <span id="cash-tax">₱ 0.00</span>
            </div>
            <div class="flex justify-between text-sm font-bold text-gray-800 mt-4  pt-2">
                <span>Payable Amount</span>
                <span id="cash-total">₱ 0.00</span>
            </div>

            {{-- <div class="flex justify-between text-sm font-bold text-gray-800 mt-4  pt-2">
                    <span>Cash Amount</span>
                    <span id="cash-amount-text">₱ 0.00</span>
                </div>
                <div class="flex justify-between text-sm font-bold text-gray-800 mt-4  pt-2">
                    <span>Change</span>
                    <span id="cash-change">₱ 0.00</span>
                </div> --}}

            <p class="mt-6 text-sm text-gray-600 text-center">Enter the cash amount.</p>

            <div class="mt-4">
                <input id="cash-amount" type="number" required placeholder="Enter amount"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="mt-6 flex justify-between">
                <button id="closeCashModal" onclick="backToPaymentMethod()"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                    Back
                </button>
                <button id="submitCash" onclick="processCashPayment()"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                    Proceed to Payment
                </button>
            </div>

        </div>
    </div>


    <!-- PAYMENT SUCCESSFUL MODAL -->
    <div id="paymentSuccessModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-[600px] h-[400px] p-6">
            <!-- Image Section -->
            <div class="flex justify-center">
                <img src="Assets/icon-success.png" alt="Success Icon" class="w-32 h-33" />
            </div>

            <!-- Text Section -->
            <h2 class="mt-4 text-lg font-semibold text-green-600 text-center">Payment Successful!
            </h2>
            <p class="mt-4 text-sm text-gray-600 text-center">
                Thank you for your payment. Your transaction has been completed.
            </p>

            <!-- Button Section -->
            <div class="mt-10 flex justify-center">
                <button id="closeSuccessModal"
                    class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-blue-600 w-[120px]">
                    Close
                </button>
            </div>
        </div>
    </div>
    </div>

    @include('cashier.menu.receipt')
    @include('cashier.menu.online-receipt')

    <script>
        // HANDLES CASH PAYMENT - BACKEND
        function payCash() {
            // call the submit order function to get the payload
            const payload = submitOrder();

            // Send the data to the PaymentController
            fetch('{{ route('pay.cash') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(payload),
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Failed to submit order');
                    }
                })
                .then(data => {
                    console.log('Order submitted successfully:', data);


                    // success();

                    // showReceipt();

                    // setTimeout(() => {
                    //     // Redirect to menu page
                    //     window.location.href = data.redirect;
                    // }, 3000);

                    // Optionally clear the order
                    // clearOrder();
                })
                .catch(error => {
                    console.error('Error submitting order:', error);
                });
        }


        /*
            HANDLES CASHLESS PAYMENT - BACKEND
        */
        function payCashless() {
            // call the submit order function to get the payload
            const payload = submitOrder();

            // get the mode of payment
            payload.modeOfPayment = document.getElementById('cashlessButton').value;

            // Send the data to the server
            fetch('{{ route('pay.cashless') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(payload),
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Failed to submit order');
                    }
                })
                .then(data => {
                    console.log('Order submitted successfully:', data);

                    // success();

                    // showOnlineReceipt();

                    setTimeout(() => {
                        // Redirect to menu page
                        window.location.href = data.redirect;
                    });

                })
                .catch(error => {
                    console.error('Error submitting order:', error);
                });
        }


        /*
            SUBMITS THE ORDER
        */
        function submitOrder() {
            // get the data from the ui element
            subTotal = parseFloat(document.getElementById("sub-total").textContent.replace('₱ ', '').replace(',', ''));
            payableAmount = parseFloat(document.getElementById("payable-amount").textContent.replace('₱ ', '').replace(',',
                ''));
            const orderType = document.getElementById("order-type").value;

            // Transform orderItems into array of objects
            const transformedOrderItems = Object.entries(orderItems).map(([name, details]) => {
                return {
                    name: name,
                    quantity: details.quantity,
                    price: details.price
                };
            });

            // Prepare the data to send
            const payload = {
                orderItems: transformedOrderItems,
                orderType: orderType,
                taxAmount: taxAmount,
                discountType: discountType,
                discountAmount: discountAmount,
                subTotal: subTotal,
                payableAmount: payableAmount,
                modeOfPayment: modeOfPayment
            };

            // return the payload
            return payload;
        }
    </script>
@endsection
