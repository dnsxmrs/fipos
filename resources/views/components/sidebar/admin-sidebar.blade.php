<!-- Sidebar -->
<div class="fixed top-0 left-0 z-50 flex flex-col items-start w-16 h-screen px-10 py-10 bg-white border-r md:w-24 lg:w-64" style="background-color: #066543; z-index: 60;">
    <!-- Caffeinated Logo -->
    <div class="flex justify-center w-full mb-10">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
    </div>

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-start w-full p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/dashboard.png') }}" alt="dashboard Icon" class="w-6 h-6 mr-2">
        <span class="text-sm text-white">Dashboard</span>
    </a>

    <!-- Menu Dropdown -->
    <div class="relative w-full">
        <a href="javascript:void(0);" class="flex items-center justify-start w-full p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white group" onclick="toggleDropdown()">
            <img src="{{ asset('Assets/menu.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
            <span class="text-sm text-white">Menu</span>
        </a>
        <div id="menuDropdown" class="absolute left-0 hidden w-full mt-2 bg-white border rounded-lg shadow-md">
            <a href="{{ route('admin.menu.categories') }}" class="block p-2 text-sm text-gray-800 hover:bg-green-500 hover:text-white">Categories</a>
            <a href="{{ route('admin.menu.products') }}" class="block p-2 text-sm text-gray-800 hover:bg-green-500 hover:text-white">Products</a>
        </div>
    </div>

    {{-- Inventory Labels --}}
    <a href="{{ route('admin.inventory.show') }}" class="flex items-center justify-start w-full p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/inventory.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-sm text-white">Inventory</span>
    </a>

    <!-- ReportModule -->
    <a href="{{ route('admin.reports') }}" class="flex items-center justify-start w-full p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/report.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Reports</span>
    </a>

    <!-- OnlineOrders Module -->
    <a href="{{ route('admin.staff-management') }}" class="flex items-center justify-start w-full p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/staff.png') }}" alt="Staff Icon" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Staff</span>
        <span class="text-sm text-white">Management</span>
    </a>

    <!-- Order Tracking Module -->
    <a href="{{ route('admin.order-tracking') }}" class="flex items-center justify-start w-full p-2 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/order-track.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-30">
        <div class="text-sm text-white">Order</div>
        <div class="text-sm text-white">Tracking</div>
    </a>

    <!-- Settings -->
    <a href="{{ route('admin.settings') }}" class="flex items-center justify-start w-full p-2 mt-auto mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/settings.png') }}" alt="Settings Icon" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Settings</span>
    </a>

    <!-- Log out -->
    <a href="{{ route('logout.confirm') }}" class="flex items-center justify-start w-full p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/logout.png') }}" alt="log-out.png" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Log out</span>
    </a>
</div>

<script>
    // Toggle the dropdown menu visibility
    function toggleDropdown() {
        const dropdown = document.getElementById('menuDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Set the default active button if none is stored
    document.addEventListener('DOMContentLoaded', function () {
        const defaultButton = 'dashboard';
        const storedButton = localStorage.getItem('adminButton');

        // If no button is stored, default to 'dashboard'
        if (!storedButton) {
            localStorage.setItem('adminButton', defaultButton);
        }

        // Add click event listeners to all sidebar buttons
        const buttons = document.querySelectorAll('.flex.flex-col.items-center');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const buttonName = this.querySelector('span').textContent.trim(); // Get the button name
                setActiveButton(buttonName);
            });
        });
    });

    // Function to store the active button in localStorage
    function setActiveButton(buttonName) {
        localStorage.setItem('adminButton', buttonName.toLowerCase());

        if (buttonName === 'Menu') {
            localStorage.setItem('activeButton', 'categories');
        }
    }
</script>
