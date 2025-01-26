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
