<!-- Sidebar -->
<div class="fixed top-0 left-0 z-50 flex flex-col items-start w-64 h-screen px-3 py-5 bg-[#1C3D34] border-r">
    <!-- Caffeinated Logo -->
    <div class="flex items-center justify-center w-full mb-10">
        <img src="{{ asset('Assets/logo.png') }}" alt="Caffeinated Logo" class="h-10">
        <span class="flex items-center justify-start ml-2">
            <p class="text-white font-medium text-base">Caffeinated</p>
            <p class="text-[#e0c2aa] font-bold ml-1 text-xl">POS</p>
        </span>
    </div>

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}"
        class="sidebar-link flex items-center justify-start text-sm text-white w-full p-2 mb-2 transition rounded-lg hover:bg-green-900">
        <img src="{{ asset('Assets/dashboard.png') }}" alt="dashboard Icon" class="h-6 mr-4">
        Dashboard
    </a>

    <!-- Menu Dropdown -->
    <div class="relative w-full">
        <a href="javascript:void(0);"
            class="flex items-center justify-between text-sm text-white w-full p-2 mb-2 transition rounded-lg hover:bg-green-900"
            onclick="toggleDropdown()">
            <span class="flex items-center justify-start">
                <img src="{{ asset('Assets/menu.png') }}" alt="Menu Icon" class="h-6 mr-4">
                <span >Menu Management</span>
            </span>
            <img id="dropdown-down" class="hidden h-4 opacity-70 object-cover"
                src="{{ asset('Assets/dropdown-white.png') }}" alt="dropdown-icon">
            <img id="dropdown-right" class="h-5 object-cover " src="{{ asset('Assets/dropdown-right.png') }}"
                alt="dropdown-icon">
        </a>
        <div id="menuDropdown" class=" left-0 hidden w-full mt-2 mb-4  rounded-lg z-50">
            <div>
                <a href="{{ route('admin.menu.categories') }}"
                    class="sidebar-link hover:bg-green-900 rounded-lg block pl-10 p-2 text-sm text-white mb-1">Categories</a>
            </div>
            <div>
                <a href="{{ route('admin.menu.products') }}"
                    class="sidebar-link hover:bg-green-900 rounded-lg block pl-10 p-2 text-sm text-white">Products</a>
            </div>
        </div>
    </div>

    {{-- Inventory Labels --}}
    <a href="{{ route('admin.inventory.show') }}"
        class="sidebar-link flex items-center justify-start text-sm text-white w-full p-2 mb-2 transition rounded-lg hover:bg-green-900">
        <img src="{{ asset('Assets/inventory.png') }}" alt="Menu Icon" class="h-6 mr-4">
        Inventory
    </a>

    <!-- ReportModule -->
    <a href="{{ route('admin.reports') }}"
        class="sidebar-link flex items-center justify-start text-sm text-white w-full p-2 mb-2 transition rounded-lg hover:bg-green-900">
        <img src="{{ asset('Assets/report.png') }}" alt="Reports Icon" class="h-6 mr-4">
        Reports
    </a>

    <!-- OnlineOrders Module -->
    <a href="{{ route('admin.staffs.show') }}"
        class="sidebar-link flex items-center justify-start text-sm text-white w-full p-2 mb-2 transition rounded-lg hover:bg-green-900">
        <img src="{{ asset('Assets/staff.png') }}" alt="Staff Icon" class="h-6 mr-4">
        Staff Management
    </a>

    <!-- Order Tracking Module -->
    <a href="{{ route('admin.order-tracking') }}"
        class="sidebar-link flex items-center justify-start text-sm text-white w-full p-2 mb-2 transition rounded-lg hover:bg-green-900">
        <img src="{{ asset('Assets/order-track.png') }}" alt="Order Tracking Icon" class="h-6 mr-4">
        Order Tracking
    </a>

    <!-- Settings -->
    <a href="{{ route('admin.settings') }}"
        class="sidebar-link flex items-center justify-start text-sm text-white w-full p-2 mt-auto mb-4 space-x-2 transition rounded-lg hover:bg-green-900">
        <img src="{{ asset('Assets/settings.png') }}" alt="Settings Icon" class="h-6 mr-4">
        Settings
    </a>

</div>
