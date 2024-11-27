<!-- Sidebar -->
<nav class="w-20 bg-white border-r h-[1031px] flex flex-col items-center py-6">
    <div class="mb-1">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
    </div>

    <!-- Menu buttons -->
    <button aria-label="Menu" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/order.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-xs">Order</span>
    </button>
    <button aria-label="Reports" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/online-order.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Online</span>
        <span class="text-xs">Order</span>
    </button>
    <button aria-label="Order tracking" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Order</span>
        <span class="text-xs">Tracking</span>
    </button>
</nav>
