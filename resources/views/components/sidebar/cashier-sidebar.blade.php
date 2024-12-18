<!-- Sidebar -->
<nav class="max-w-20 w-20 bg-[#066543] border-r flex flex-col items-center justify-center py-6 text-white">

    <div>
        <div class="flex items-center justify-center">
            <img class="h-10 cursor-pointer" src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="logo">
        </div>
        <!-- Menu buttons -->
        <a href="{{ route('menu.show') }}" aria-label="Menu" class="flex flex-col items-center">
            <div class="h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/menu.png') }}" alt="Menu Icon" class="h-8 mb-2">
            <span class="text-xs">Menu</span>
        </a>
        <a href="{{ route('orders.show') }}" aria-label="Order tracking" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/order-track.png') }}" alt="Order Tracking Icon" class="h-8 mb-2">
            <span class="text-xs">Order</span>
            <span class="text-xs">Tracking</span>
        </a>
        <a href="{{ route('online.orders.show') }}" aria-label="Reports" class="flex flex-col items-center">
            <div class="h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/online-order.png') }}" alt="Online Icon" class="h-9 mb-2">
            <span class="text-xs">Online</span>
            <span class="text-xs">Order</span>
        </a>
    </div>

    <div class=" bg-orange-200 h-10">
        {{-- sample button for logout --}}
        <a href="{{ route('logout.confirm') }}" class="big-button">Logout</a>
    </div>

</nav>
