<!-- Sidebar -->
<div class="fixed top-0 left-0 z-50 flex flex-col items-start w-16 h-screen px-10 py-10 bg-white border-r md:w-24 lg:w-64" style="background-color: #066543; z-index: 60;">
    <!-- Caffeinated Logo -->
    <div class="flex justify-center w-full mb-10">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
    </div>

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}" class="flex flex-row items-center justify-start p-2 mb-6 mr-2 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/dashboard.png') }}" alt="dashboard Icon" class="w-6 h-6 mr-2">
        <span class="text-sm text-white">Dashboard</span>
    </a>

    <!-- Menu Dropdown -->
    <div class="relative">
        <a href="javascript:void(0);" class="flex flex-row items-center justify-start p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white group" onclick="toggleDropdown()">
            <img src="{{ asset('Assets/menu.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
            <span class="text-sm text-white">Menu</span>
        </a>
        <div id="menuDropdown" class="absolute left-0 hidden w-full mt-2 bg-white border rounded-lg shadow-md">
            <a href="{{ route('admin.menu.categories') }}" class="block p-2 text-sm text-gray-800 hover:bg-green-500 hover:text-white">Categories</a>
            <a href="{{ route('admin.menu.products') }}" class="block p-2 text-sm text-gray-800 hover:bg-green-500 hover:text-white">Products</a>
        </div>
    </div>

    {{-- Inventory Labels --}}
    <a href="{{ route('admin.inventory.show') }}" class="flex flex-row items-center justify-start p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/inventory.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-sm text-white">Inventory</span>
    </a>

    <!-- ReportModule -->
    <a href="{{ route('admin.reports') }}" class="flex flex-row items-center justify-start p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/report.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Reports</span>
    </a>

    <!-- OnlineOrders Module -->
    <a href="{{ route('admin.staff-management') }}" class="flex flex-row items-center justify-start p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/staff.png') }}" alt="Staff Icon" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Staff</span>
        <span class="text-sm text-white">Management</span>
    </a>

    <!-- Order Tracking Module -->
    <a href="{{ route('admin.order-tracking') }}" class="flex flex-row items-center justify-start p-2 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/order-track.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-30">
        <div class="text-sm text-white">Order</div>
        <div class="text-sm text-white">Tracking</div>
    </a>

    <!-- Settings -->
    <a href="{{ route('admin.settings') }}" class="flex flex-row items-center justify-start p-2 mt-auto mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/settings.png') }}" alt="Settings Icon" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Settings</span>
    </a>

    <!-- Log out -->
    <a href="{{ route('logout.confirm') }}" class="flex flex-row items-center justify-start p-2 mb-6 space-x-2 transition rounded-lg hover:bg-green-500 hover:text-white">
        <img src="{{ asset('Assets/logout.png') }}" alt="log-out.png" class="w-6 h-6 mb-2">
        <span class="text-sm text-white">Log out</span>
    </a>
</div>

<!-- Header -->
<header class="fixed top-0 left-0 z-40 w-full p-4 mb-4 bg-white rounded shadow-md" style="z-index: 50;">
    <div class="flex items-center justify-between w-full lg:w-[1095px] mx-auto"> <!-- Adjusted width to be more flexible -->

        <!-- Title Section -->
        <div class="flex-1">
            <h1 class="text-xl font-bold font-barlow">
                <span class="mr-0">Caffeinated</span>
                <span class="text-amber-700">POS</span>
            </h1>
            <p class="mt-2 text-sm font-barlow">{{ now()->setTimezone('Asia/Manila')->format('l, g:i A') }}</p>
        </div>

        <!-- Profile and Notification Icons -->
        <div class="flex items-center space-x-6 md:space-x-10">
            <!-- Notification Icon -->
            <button class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6 text-gray-700 hover:text-amber-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 22c1.105 0 2-.895 2-2H10c0 1.105.895 2 2 2zM19 17H5v-6c0-4.418 3.582-8 8-8s8 3.582 8 8v6z" />
                </svg>
                <!-- Notification Badge -->
                <span class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 text-xs text-white bg-red-600 rounded-full">3</span>
            </button>

            <!-- Profile Icon -->
            <button class="relative">
                <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y" alt="Profile"
                    class="w-8 h-8 border-2 border-gray-300 rounded-full hover:border-amber-700">
            </button>
        </div>
    </div>
</header>

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
