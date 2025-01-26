<div id="paymentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-[400px] p-6">
        <h2 class="text-lg font-semibold text-center text-gray-800">Payment Details</h2>
        <p class="mt-2 text-sm text-center text-gray-600">Select payment method</p>
        <div class="flex flex-col items-center mt-4 space-y-3">
            <button id="openCashModal" value="cash"
                class="w-full px-4 py-2 bg-blue-200 text-black border border-blue-500 rounded-full hover:bg-gray-200 mt-4">
                Cash
            </button>
            <button id="cashlessButton" value="cashless" onclick="payCashless()"
                class="w-full px-4 py-2 bg-blue-200 text-black border border-blue-500 rounded-full hover:bg-gray-200">
                Cashless
            </button>
        </div>
        <div class="flex justify-center mt-4">
            <button id="closeModal"
                class="w-[160px] mt-6 px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600">
                Cancel
            </button>
        </div>
    </div>
</div>
