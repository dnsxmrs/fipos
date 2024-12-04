<!-- Sidebar -->
<div class=" h-screen bg-white border-r flex flex-col items-center py-6">

    <!-- Caffeinated Logo -->
    <div class="mb-1">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
    </div>

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/Graph.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Dashboard</span>
    </a>

    <!-- Menu Labels -->
    <a href="{{ route('admin.menu.categories') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/food menu icon 1.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-xs">Menu</span>
    </a>

    <!--ReportModule-->
    <a href="{{ route('admin.reports') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/Graph.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Reports</span>
    </a>

    <!--OnlineOrders Module-->
    <a href="{{ route('admin.staff-management') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="path-to-online-icon" alt="Online Orders Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Staff</span>
        <span class="text-xs">Management</span>
    </a>

    <!--Order Tracking Module-->
    <a href="{{ route('admin.order-tracking') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
        <div class="text-xs">Order</div>
        <div class="text-xs">Tracking</div>
    </a>

    <!--Settings-->
    <a href="{{ route('admin.settings') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/Setting.png') }}" alt="Settings Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Settings</span>
    </a>

    <div class="mt-20 bg-orange-200 h-10">
        {{-- sample button for logout --}}
        <a href="{{ route('logout.confirm') }}" class="big-button">Logout</a>
    </div>
</div>
