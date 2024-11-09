

<!--MainFrame-->
<div >

    <!-- Sidebar -->
    <div class="w-20 bg-white border-r flex flex-col items-center py-6">

      <!-- Caffeinated Logo -->
      <div class="mb-1">
        <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
      </div>

      <!-- Menu Labels -->
      <button aria-label="Menu" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/food menu icon 1.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
        <span class="text-xs">Menu</span>
      </button>

      <!--ReportModule-->
      <button aria-label="Reports" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/Graph.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Reports</span>
      </button>

       <!--OnlineOrders Module-->
      <button aria-label="Online Orders" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="path-to-online-icon" alt="Online Orders Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Online</span>
        <span class="text-xs">Orders</span>
      </button>

      <!--Order Tracking Module-->
      <button aria-label="Order Tracking" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
        <div class="text-xs">Order</div>
        <div class="text-xs">Tracking</div>
      </button>

      <!--Settings-->
      <button aria-label="Settings" class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-lg mb-2"></div>
        <img src="{{ asset('Assets/Setting.png') }}" alt="Settings Icon" class="w-6 h-6 mb-2">
        <span class="text-xs">Settings</span>
      </button>
    </div>
