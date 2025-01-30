<!-- Receipt Modal -->
<div id="receiptModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-[400px]">
        <div id="receipt-content">
            <!-- Modal Header -->
            <div class="text-center p-4">
                <h2 class="text-lg font-bold text-gray-900">Caffeinated</h2>
                <p class="text-sm text-gray-700 text-center">Receipt</p>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <!-- Receipt Information -->
                <div class="text-xs text-gray-600 mb-4">
                    <p><strong>Date:</strong> <span id="orderDate">{{ now()->format('m/d/Y h:i A') }}</span></p>
                    <p><strong>Cashier Name:</strong> <span id="cashierName">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</span></p>
                </div>


                <!-- Separator -->
                <hr class="border-gray-400 mb-2">

                <!-- Receipt Items -->
                <div>
                    <div class="flex justify-between text-xs font-bold text-gray-700 mb-2">
                        <span>QUANTITY</span>
                        <span>ITEM</span>
                        <span>PRICE</span>
                    </div>
                    <div id="receipt-container" class="space-y-2">
                        <!-- Items will be dynamically added here -->
                    </div>
                </div>

                <!-- Separator -->
                <hr class="border-gray-400 my-2">

                <!-- Subtotal, Discount, and Total -->
                <div class="text-xs text-gray-600 space-y-1">
                    <div class="flex justify-between">
                        <span>CASH:</span>
                        <span id="cash">₱0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>SUB-TOTAL:</span>
                        <span id="subTotal">₱0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>TAX:</span>
                        <span id="taxReceipt">₱0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>DISCOUNT:</span>
                        <span id="discount">₱0.00</span>
                    </div>
                    <div class="flex justify-between font-bold text-gray-900">
                        <span>TOTAL:</span>
                        <span id="totalPrice">₱0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>CHANGE:</span>
                        <span id="change">₱0.00</span>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal Footer -->
        <!-- Print Button -->
        <div class="flex justify-center p-4">
            <button id="printReceipt" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Print
            </button>
        </div>

    </div>
</div>
