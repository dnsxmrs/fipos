<!-- Sidebar -->
<div class="flex flex-col items-center h-screen py-6 bg-white border-r">

    <!-- Caffeinated Logo -->
    <div class="mb-1">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
    </div>

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 mb-2 rounded-lg"></div>
        <img src="{{ asset('Assets/Graph.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Dashboard</span>
    </a>

    <!-- Menu Labels -->
    <a href="{{ route('admin.menu.categories') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 mb-2 rounded-lg"></div>
        <img src="{{ asset('Assets/food menu icon 1.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-xs">Menu</span>
    </a>

    <!-- Inventory Labels -->
    <a href="{{ route('admin.inventory.show') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="" alt="Inventory Icon" class="w-6 h-6 mb-1">
        <span class="text-xs">Inventory</span>
    </a>

    <!--ReportModule-->
    <a href="{{ route('admin.reports') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 mb-2 rounded-lg"></div>
        <img src="{{ asset('Assets/Graph.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Reports</span>
    </a>

    <!--OnlineOrders Module-->
    <a href="{{ route('admin.staff-management') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 mb-2 rounded-lg"></div>
        <img src="path-to-online-icon" alt="Online Orders Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Staff</span>
        <span class="text-xs">Management</span>
    </a>

    <!--Order Tracking Module-->
    <a href="{{ route('admin.order-tracking') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 mb-2 rounded-lg"></div>
        <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
        <div class="text-xs">Order</div>
        <div class="text-xs">Tracking</div>
    </a>

    <!--Settings-->
    <a href="{{ route('admin.settings') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 mb-2 rounded-lg"></div>
        <img src="{{ asset('Assets/Setting.png') }}" alt="Settings Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Settings</span>
    </a>

    <a href="{{ route('logout.confirm') }}" class="flex flex-col items-center">
        <div class="w-10 h-10 mb-2 rounded-lg"></div>
        <img src="{{ asset('Assets/log-out.png') }}" alt="log-out.png" class="w-6 h-6 mb-2">
        <span class="text-xs">Log out</span>
    </a>
</div>

<script>
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
