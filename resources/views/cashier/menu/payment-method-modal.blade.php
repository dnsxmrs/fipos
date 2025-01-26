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
