<!-- Receipt Modal -->
<div id="receiptModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Receipt</h2>
            <button id="closeReceiptModal" class="text-gray-400 hover:text-gray-900">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-4">
            <div class="space-y-4">
                <!-- Receipt Items -->
                <div>
                    <h3 class="text-gray-700 font-medium">Items</h3>
                    <ul id="receiptItems" class="mt-2 space-y-2">
                        <!-- Items will be dynamically added here -->
                    </ul>
                </div>

                <!-- Total Price -->
                <div class="border-t pt-4">
                    <div class="flex justify-between text-gray-900 font-semibold">
                        <span>Total</span>
                        <span id="totalPrice">$0.00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end p-4 border-t">
            <button id="printReceipt" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Print
            </button>
            <button id="closeModalButton" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Close
            </button>
        </div>
    </div>
</div>
