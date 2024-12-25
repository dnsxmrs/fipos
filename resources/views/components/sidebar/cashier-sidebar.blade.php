<!-- Sidebar -->
<nav class="bg-[#1C3D34] h-screen w-24 max-w-24 flex flex-col items-center justify-start py-4 text-white">

    <div>
        <a href="{{ route('menu.show') }}" class="flex items-center justify-center">
            <img class="h-10 cursor-pointer" src="{{ asset('Assets/logo.png') }}" alt="logo">
        </a>
        <!-- Menu buttons -->
        <a href="{{ route('menu.show') }}" aria-label="Menu"
            class="flex flex-col items-center p-3 w-full mt-8 hover:bg-green-300 rounded-lg ">
            <img class="h-8 mb-2 object-cover " src="{{ asset('Assets/menu.png') }}" alt="Menu Icon">
            <span class="text-xs">Menu</span>
        </a>
        <a href="{{ route('orders.show') }}" aria-label="Order tracking"
            class="flex flex-col items-center p-3 mt-2 hover:bg-green-300 rounded-lg ">
            <img class="h-8 mb-2 object-cover " src="{{ asset('Assets/order-track.png') }}" alt="Order Tracking Icon">
            <span class="text-xs">Order</span>
            <span class="text-xs">Tracking</span>
        </a>
        <a href="{{ route('online.orders.show') }}" aria-label="Online Orders"
            class="flex flex-col items-center p-3 mt-2 hover:bg-green-300 rounded-lg ">
            <img class="h-8 mb-2 object-cover " src="{{ asset('Assets/online-order.png') }}" alt="Online Icon">
            <span class="text-xs">Online</span>
            <span class="text-xs">Order</span>
        </a>
    </div>

</nav>
