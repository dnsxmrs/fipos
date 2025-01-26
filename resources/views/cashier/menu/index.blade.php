@extends('layouts.cashier-layout')

@section('cashier_content')
    {{-- LEFT PANNEL --}}

    {{-- ALL ITEMS --}}
    <div class="w-2/3 ">
        <div class="my-5">
            <p class="text-xl font-medium text-gray-700">Menu</p>
            <p class="text-sm text-gray-500">A list of all available menu.</p>
        </div>

        <div class="flex flex-wrap items-center justify-start gap-2 my-5 mb-10 mr-10">
            {{-- all menu button (active by default) --}}
            <button
                class="p-4 border px-5 text-green-800 rounded-lg shadow w-[220px] h-[55px] text-center cursor-pointer hover:bg-green-100 active:bg-green-200 bg-green-200"
                onclick="filterItems('all', event)" id="all-menu-btn">
                All Menu
            </button>

            <!-- Category Buttons -->
            @foreach ($categories as $category)
                <span id="category-{{ $category->category_name }}" onclick="filterItems('{{ $category->category_name }}', event)"
                    class="category-button flex items-center justify-center border p-4 text-green-800 px-5 rounded-lg shadow-md w-[220px] h-[55px] text-center cursor-pointer hover:bg-green-100 active:bg-green-200 bg-white ">
                    <img class="inline object-cover p-1 mr-3 rounded-lg h-11" src="{{ $category->image }}"
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
                        <img src="{{ $item->image }}" alt="{{ $item->product_name }}"
                            class="rounded-lg w-[200px] h-[150px] object-cover mb-4">
                        <p class="text-lg font-semibold text-center"> {{ $item->product_name }} </p>
                        <p class="text-center text-gray-500"> {{ $item->product_price }} </p>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div
        class="flex flex-col fixed right-0 top-24 p-4 w-1/3 min-w-fit h-[calc(100vh-6rem)] border border-gray-300 rounded-lg bg-white justify-between">
        <!-- Header and Order Type -->
        <div class="h-auto">
            <h2 class="mt-3 mb-4 ml-3 text-xl font-semibold">Current Order</h2>
            <div class="mx-10">
                <select name="order-type" id="order-type"
                    class="p-2 border border-gray-300 rounded-lg shadow-md w-full h-[40px] text-xs cursor-pointer bg-white hover:bg-amber-900 hover:text-white active:bg-amber-600">
                    <option value="dine-in">Dine in</option>
                    <option value="take-out">Take out</option>
                </select>
            </div>

            <!-- Header row with underline and aligned text -->
            <div class="flex items-center justify-evenly text-sm font-medium mt-5 pb-3 text-gray-800 border-b">
                <p class="text-center w-1/4">Item</p>
                <p class="text-right w-1/4">Quantity</p>
                <p class="text-right w-1/4">Price</p>
                <p class="w-1/4"></p>
            </div>
        </div>

        <!-- Items List and Scrollable Container -->
        <div class="flex-1 overflow-y-auto bg-gray-50">
            <div id="order-items-container" class="m-3">
                <!-- Dynamically added items will appear here -->
            </div>
        </div>

        <!-- Total Calculation Section (Fixed at Bottom) -->
        <div class="sticky bottom-0 bg-white">
            <div class="py-5 px-5 space-y-3 border-t">
                <div class="flex justify-between text-sm font-medium text-gray-600">
                    <span class="text-center">Sub Total</span>
                    <span class="text-center" id="sub-total">₱ 0.00</span>
                </div>
                {{-- <div class="flex justify-between mt-5 ml-6 mr-8 text-sm font-semibold text-gray-600">
                    <span class="text-center">Discount</span>
                    <span class="text-center" id="discount">- ₱ 0.00</span>
                </div>
                <div class="flex justify-between mt-5 ml-6 mr-8 text-sm font-semibold text-gray-600">
                    <span class="text-center">Tax</span>
                    <span class="text-center" id="tax">₱ 0.00</span>
                </div> --}}

                <div class="flex justify-between font-bold text-black">
                    <span class="text-center">Payable Amount</span>
                    <span class="text-center" id="payable-amount">₱ 0.00</span>
                </div>
            </div>

            {{-- <div class="flex justify-between mt-8 ml-6 mr-8 text-sm">
                <p>Add a Discount: </p>
                <select
                    class="w-50 h-[40px] text-center font-regular text-green-500 bg-white border border-green-500 hover:bg-gray-100 px-4 py-2 rounded-lg focus:outline-none focus:ring-0 focus:ring-green-500"
                    id="discount-dropdown">
                    <option value="none" selected>None</option>
                    <option value="senior citizen">Senior Citizen</option>
                    <option value="pwd">PWD</option>
                </select>
            </div> --}}

            <div class="flex justify-between space-x-2 mx-6 text-base text-gray-200">
                <button class="bg-gray-200 border border-gray-400 text-gray-700 w-full rounded-lg">
                    Reset Order
                </button>
                <button id="openModal"  onclick="showPaymentModal()"
                    class="w-full px-4 py-3 text-center text-white bg-green-600 rounded-lg font-regular hover:bg-green-700">
                    Continue to Payment
                </button>

            </div>
        </div>
    </div>

    </div>


    @include("cashier.menu.payment-method-modal")
    @include('cashier.menu.receipt')
    @include('cashier.menu.cashPayment')


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

                    success();

                    setTimeout(() => {
                        // Redirect to menu page
                        window.location.href = data.redirect;
                    }, 3000);

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
                subTotal: subTotal,
                payableAmount: payableAmount,
                modeOfPayment: modeOfPayment
            };

            // return the payload
            return payload;
        }
    </script>
@endsection
