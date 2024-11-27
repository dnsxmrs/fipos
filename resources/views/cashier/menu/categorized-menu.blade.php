@extends('layouts.cashier-layout')

@section('cashier_content')
    <!-- Main Content Area -->
    <div class="flex-1 ml-20 w-[1460px]">

        <!-- Page Content -->
        <div class="ml-20 mt-5 text-2xl font-poppins">
            <p>Categories</p>
        </div>

        <div class="mt-3 ml-20 flex space-x-4">
            {{-- all menu button --}}
            <a href=" {{ route('menu.showAll')}} "
                class="p-4 border border-gray-300 rounded-lg shadow-md w-[138px] h-[55px] text-center cursor-pointer hover:bg-amber-100 active:bg-amber-200 bg-white hover:text-amber-500">
                All Menu
            </a>


            <!-- categories button -->
            @foreach ($categories as $category)
                <a href=" {{ route('menu.showPerCategory', ['id' => $category->category_id]) }} "
                    class="p-4 border border-gray-300 rounded-lg shadow-md w-[138px] h-[55px] text-center cursor-pointer hover:bg-amber-100 active:bg-amber-200 bg-white hover:text-amber-500">
                    {{ $category->category_name }}
                </a>
            @endforeach


        </div>

        <!--Coffee menu-->
        <div class="ml-20 mt-10 grid grid-cols-1 lg:grid-cols-8 gap-6">

            {{-- Display the menu --}}
            @foreach ($products as $product)
                <!-- Product Card 1 -->
                <button
                    class="block p-4 border border-gray-300 rounded-lg shadow-md bg-white w-[200px] hover:bg-amber-100 active:bg-amber-200 bg-white hover:text-amber-500">
                    <img src="https://via.placeholder.com/150" alt="Americano"
                        class="rounded-lg w-[200px] h-[150px] object-cover mb-4">
                    <p class="text-center text-lg font-semibold"> {{ $product->product_name }} </p>
                    <p class="text-center text-gray-500"> {{ $product->product_price }} </p>
                </button>
            @endforeach



        </div>


        <!--pos receipt-->
        <div class="absolute bottom-0 right-0 p-4 w-[504px] h-[790px] border border-gray-300 rounded-lg bg-white">
            <h2 class="text-xl font-semibold mb-4 ml-3 mt-3">Current Order</h2>
            <div class="mt-3 ml-10 flex space-x-4">

                <div
                    class="p-2 border border-gray-300 rounded-lg shadow-md w-[100px] h-[34px] text-center text-xs cursor-pointer hover:bg-amber-900 active:bg-amber-600 bg-white hover:text-white">
                    <p>Dine in</p>
                </div>

                <div
                    class="p-2 border border-gray-300 rounded-lg shadow-md w-[100px] h-[34px] text-center text-xs cursor-pointer hover:bg-amber-900 active:bg-amber-600 bg-white hover:text-white">
                    <p> Take out</p>
                </div>

                <div
                    class="p-2 border border-gray-300 rounded-lg shadow-md w-[100px] h-[34px] text-center text-xs cursor-pointer hover:bg-amber-900 active:bg-amber-600 bg-white hover:text-white">
                    <p>Delivery</p>
                </div>
            </div>

            <!--Column for items, qty, price-->
            <div class="mt-6">
                <!-- Header row with underline and aligned text -->
                <div class="flex justify-between text-sm font-semibold text-gray-600 border-b pb-2 ml-6 mr-8">
                    <span class=" text-center">Item</span>
                    <span class=" text-center">Quantity</span>
                    <span class="">Price</span>
                </div>

                <!-- Display the item details with consistent alignment -->
                <div class="flex justify-between mt-2 text-sm ml-6">
                    <span class="w-1/3 text-left">Americano</span>
                    <span class="w-1/3 text-center flex items-center justify-center space-x-2">
                        <button
                            class="flex items-center justify-center p-3 border border-gray-300 bg-amber-900 text-white rounded-md hover:bg-gray-200 hover:text-amber-900 w-[23px] h-[20px]">-</button>
                        <span>1</span>
                        <button
                            class="flex items-center justify-center p-3 border border-gray-300 bg-amber-900 text-white rounded-md hover:bg-gray-200 hover:text-amber-900 w-[23px] h-[20px]">+</button>
                    </span>
                    <span class="w-1/3 text-center">₱ 150.00</span>
                </div>


                <div class="flex justify-between mt-2 text-sm ml-6">
                    <span class="w-1/3 text-left">Latte</span>
                    <span class="w-1/3 text-center flex items-center justify-center space-x-2">
                        <button
                            class="flex items-center justify-center p-3 border border-gray-300 bg-amber-900 text-white rounded-md hover:bg-gray-100 hover:text-amber-900 w-[23px] h-[20px]">-</button>
                        <span>1</span>
                        <button
                            class="flex items-center justify-center p-3 border border-gray-300 bg-amber-900 text-white rounded-md hover:bg-gray-100 hover:text-amber-900 w-[23px] h-[20px]">+</button>
                    </span>
                    <span class="w-1/3 text-center">₱ 150.00</span>
                </div>

                <div class="flex justify-between mt-2 text-sm ml-6">
                    <span class="w-1/3 text-left">Cappucino</span>
                    <span class="w-1/3 text-center flex items-center justify-center space-x-2">
                        <button
                            class="flex items-center justify-center p-3 border border-gray-300 bg-amber-900 text-white rounded-md hover:bg-gray-200 hover:text-amber-900 w-[23px] h-[20px]">-</button>
                        <span>1</span>
                        <button
                            class="flex items-center justify-center p-3 border border-gray-300 bg-amber-900 rounded-md text-white hover:bg-gray-200 hover:text-amber-900 w-[23px] h-[20px]">+</button>
                    </span>
                    <span class="w-1/3 text-center">₱ 150.00</span>
                </div>
                <!--Calculations-->
                <div class="absolute bottom-0 right-0 p-4 w-[504px] h-[250px] border border-gray-300 rounded-lg bg-white">
                    <div class="flex justify-between text-sm font-semibold text-gray-600  ml-6 mr-8 mt-5">
                        <span class=" text-center">Sub Total</span>
                        <span class=" text-center">Php 110.00</span>
                    </div>

                    <div class="flex justify-between text-sm font-semibold text-gray-600  ml-6 mr-8 mt-5">
                        <span class=" text-center">Tax</span>
                        <span class=" text-center">Php 110.00</span>
                    </div>

                    <div class="flex justify-between text-l font-bold text-black ml-6 mr-8 mt-5">
                        <span class=" text-center">Payable Amount</span>
                        <span class=" text-center">Php 110.00</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-200 ml-6 mr-8 mt-8">
                        <button
                            class="w-[179px] h-[40px] text-center font-regular text-green-500 bg-white border border-green-500 hover:bg-gray-100 px-4 py-2 rounded-full">
                            Add discount
                        </button>
                        <button id="openModal"
                            class="text-center font-regular text-white bg-green-500 hover:bg-gray-300 px-4 py-2 rounded-full hover:text-black">
                            Continue to Payment
                        </button>

                        <!-- Modal -->
                        <div id="paymentModal"
                            class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-lg shadow-lg w-[400px] p-6">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Payment Details</h2>
                                <p class="mt-2 text-sm text-gray-600 text-center">Select payment method.</p>
                                <div class="mt-4 flex flex-col items-center space-y-4">
                                    <button id="openCashModal"
                                        class="w-[120px] px-4 py-2 bg-blue-200 text-black border border-blue-500 rounded-full hover:bg-gray-200 mt-4">
                                        Cash
                                    </button>
                                    <button
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

                        <!-- Cash Payment Modal -->
                        <div id="cashModal"
                            class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-lg shadow-lg w-[400px] p-6">
                                <h2 class="text-lg font-semibold text-gray-800 text-center">Cash Payment</h2>
                                <p class="mt-2 text-sm text-gray-600 text-center font-bold">Order Summary</p>

                                <!-- Order Summary Section -->
                                <div class="mt-4 border-t border-gray-300 pt-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>Burger</span>
                                        <span>Php 8.00</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>Fries</span>
                                        <span>Php 3.00</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>Soda</span>
                                        <span>Php 2.00</span>
                                    </div>
                                    <div
                                        class="flex justify-between text-sm font-bold text-gray-800 mt-4 border-t border-gray-300 pt-2">
                                        <span>Total</span>
                                        <span>Php 13.00</span>
                                    </div>
                                </div>

                                <p class="mt-6 text-sm text-gray-600 text-center">Enter the cash amount.</p>

                                <div class="mt-4">
                                    <input type="number" placeholder="Enter amount"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </div>
                                <div class="mt-6 flex justify-between">
                                    <button id="submitCash"
                                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                        Proceed to Payment
                                    </button>
                                    <button id="closeCashModal"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Successful Modal -->
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


                        <script>
                            // Get modal elements
                            const paymentModal = document.getElementById('paymentModal');
                            const cashModal = document.getElementById('cashModal');
                            const paymentSuccessModal = document.getElementById('paymentSuccessModal');

                            // Get button elements
                            const openCashModalBtn = document.getElementById('openCashModal');
                            const closePaymentModalBtn = document.getElementById('closeModal');
                            const closeCashModalBtn = document.getElementById('closeCashModal');
                            const submitCashBtn = document.getElementById('submitCash');
                            const closeSuccessModalBtn = document.getElementById('closeSuccessModal');

                            // Open Cash Modal
                            openCashModalBtn.addEventListener('click', () => {
                                cashModal.classList.remove('hidden');
                            });

                            // Close Payment Modal
                            closePaymentModalBtn.addEventListener('click', () => {
                                paymentModal.classList.add('hidden');
                            });

                            // Close Cash Modal
                            closeCashModalBtn.addEventListener('click', () => {
                                cashModal.classList.add('hidden');
                            });

                            // Show Payment Successful Modal
                            submitCashBtn.addEventListener('click', () => {
                                cashModal.classList.add('hidden'); // Hide cash modal
                                paymentSuccessModal.classList.remove('hidden'); // Show success modal
                            });

                            // Close Payment Successful Modal
                            closeSuccessModalBtn.addEventListener('click', () => {
                                paymentSuccessModal.classList.add('hidden');
                            });

                            // Open Payment Modal
                            document.getElementById('openModal').addEventListener('click', () => {
                                paymentModal.classList.remove('hidden');
                            });

                            // Close Payment Modal
                            document.getElementById('closeModal').addEventListener('click', () => {
                                paymentModal.classList.add('hidden');
                            });

                            // Optional: Close the modal when clicking outside of it
                            window.addEventListener('click', (event) => {
                                const modal = document.getElementById('paymentModal');
                                if (event.target === modal) {
                                    modal.classList.add('hidden');
                                }
                            });
                        </script>




                    </div> <!--tag for lower receipt box-->
                </div> <!--Item closingtag-->
            </div><!--POS Closingtag-->
        </div>
    </div>
@endsection
