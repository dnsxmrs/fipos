<!-- Sidebar Frame -->
<div class="w-20 bg-white border-r flex flex-col items-center py-6">

    <!-- Caffeinated Logo -->
    <div class="mb-1">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
    </div>
    <!-- Menu buttons -->
    <button onclick="navigateTo('{{ route('admin.menu') }}')" aria-label="Menu" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/food menu icon 1.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-xs">Menu</span>
    </button>
    <button onclick="navigateTo('{{ route('admin.reports') }}')" aria-label="Reports"
        class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/Graph.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Reports</span>
    </button>
    <button onclick="navigateTo('{{ route('admin.order-tracking') }}')" aria-label="Order tracking" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Order</span>
        <span class="text-xs">Tracking</span>
    </button>
    <button onclick="navigateTo('{{ route('admin.staff-management') }}')" aria-label="Staff Management" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/staff-icon.png') }}" alt="Staff Management Icon" class="w-6 h-6 mb-2">
        <div class="text-xs">Staff</div>
        <div class="text-xs">Management</div>
    </button>
    <button onclick="navigateTo('{{ route('admin.audit-trails') }}')" aria-label="Audit Trails" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/audit-icon.png') }}" alt="Audit Trails Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Audit</span>
        <div class="text-xs">Trails</div>
    </button>
    <button onclick="navigateTo('{{ route('admin.settings') }}')" aria-label="Settings" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/Setting.png') }}" alt="Settings Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Settings</span>
    </button>
</div>

<!-- JavaScript for navigation -->
<script>
    function navigateTo(route) {
        window.location.href = route;
    }
</script>
