<!-- Sidebar -->
<nav class="w-20 bg-white border-r h-[1031px] flex flex-col items-center py-6">
    <div class="mb-1">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
    </div>

    <!-- Menu buttons -->
    <a href="{{ route('menu.show') }}" aria-label="Menu" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/order.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-xs">Menu</span>
    </a>
    <a href="{{ route('orders.show') }}" aria-label="Order tracking" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Order</span>
        <span class="text-xs">Tracking</span>
    </a>
    <a href="{{ route('online.orders.show') }}" aria-label="Reports" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/online-order.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Online</span>
        <span class="text-xs">Order</span>
    </a>

    <div class="mt-20 bg-orange-200 h-10">
        {{-- sample button for logout --}}
        <a href="{{ route('logout.confirm') }}" class="big-button">Logout</a>
    </div>

</nav>
