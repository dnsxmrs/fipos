<!-- Sidebar -->
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>


<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidenav">
    <div
        class="h-screen px-3 py-5 overflow-y-auto bg-gray-800 border-r border-gray-700">
        <!-- Caffeinated Logo -->
        <div class="flex items-center justify-center w-full mb-10">
            <img src="{{ asset('Assets/logo.png') }}" alt="Caffeinated Logo" class="h-10">
            <span class="flex items-center justify-start ml-2">
                <p class="text-base font-medium text-white">Caffeinated</p>
                <p class="text-[#e0c2aa] font-bold ml-1 text-xl">POS</p>
            </span>
        </div>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link flex items-center p-2 text-sm font-normal rounded-lg {{ Route::is('admin.dashboard') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white hover:bg-gray-700 group">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <button type="button" onclick="toggleDropdown()"
                    class="flex items-center w-full p-2 text-sm font-normal text-white transition duration-75 rounded-lg group hover:bg-gray-700"
                    aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                    <svg aria-hidden="true"
                        class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Menu Management</span>
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="menuDropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.menu.categories') }}"
                            class="sidebar-link flex items-center p-2 pl-11 w-full text-sm font-normal rounded-lg transition duration-75 group {{ Route::is('admin.menu.categories') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }}  text-white hover:bg-gray-700">Categories</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.menu.products') }}"
                            class="sidebar-link flex items-center p-2 pl-11 w-full text-sm font-normal rounded-lg transition duration-75 group {{ Route::is('admin.menu.products') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white hover:bg-gray-700">Products</a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a href="{{ route('admin.inventory.show') }}"
                    class="sidebar-link flex items-center p-2 text-sm font-normal rounded-lg {{ Route::is('admin.inventory.show') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} {{ Route::is('admin.inventory.categories') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white  hover:bg-gray-700 group">
                    <img src="{{ asset('Assets/inventory.png') }}" alt="Menu Icon" class="w-5 opacity-60 hover:opacity-100">
                    <span class="ml-3">Inventory</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('admin.orders.all') }}"
                    class="sidebar-link flex items-center p-2 text-sm font-normal  rounded-lg {{ Route::is('admin.orders.all') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} {{ Route::is('admin.orders.walk-in') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} {{ Route::is('admin.orders.online-orders') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white hover:bg-gray-700 group">
                    <img src="{{ asset('Assets/order-track.png') }}" alt="Order Tracking Icon" class="h-5 opacity-60 hover:opacity-100">
                    <span class="ml-3">Order Tracking</span>
                </a>
            </li>


            <li>
                <a href="{{ route('admin.payments') }}"
                    class="sidebar-link flex items-center p-2 text-sm font-normal rounded-lg {{ Route::is('admin.reports') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white hover:bg-gray-700 group">
                    <img src="{{ asset('Assets/report.png') }}" alt="Order Tracking Icon" class="h-5 opacity-60 hover:opacity-100">
                    <span class="ml-3">Payments</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('admin.staffs.show') }}"
                    class="sidebar-link flex items-center p-2 text-sm font-normal rounded-lg {{ Route::is('admin.staffs.show') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white hover:bg-gray-700 group">
                    <img src="{{ asset('Assets/staff-management.png') }}" alt="Order Tracking Icon" class="h-5 opacity-60 hover:opacity-100">
                    <span class="ml-3">Staff Management</span>
                    <span class="ml-3">Invoice</span>
                </a>
            </li> --}}

        </ul>
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-700">
            <li>
                <a href="{{ route('admin.users.show') }}"
                    class="sidebar-link flex items-center p-2 text-sm font-normal rounded-lg {{ Route::is('admin.users.show') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white hover:bg-gray-700 group">
                    <img src="{{ asset('Assets/user.png') }}" alt="user" class="h-5 opacity-60 hover:opacity-100">
                    <span class="ml-3">User Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.audit-trails') }}"
                    class="sidebar-link flex items-center p-2 text-sm font-normal rounded-lg {{ Route::is('admin.audit-trails') ? 'bg-gray-700' : 'text-white hover:bg-gray-700' }} text-white hover:bg-gray-700 group">
                    <img src="{{ asset('Assets/logs.png') }}" alt="Order Tracking Icon" class="h-5 opacity-60 hover:opacity-100">
                    <span class="ml-3">Audit Logs</span>
                </a>
            </li>
        </ul>
    </div>

    <div
        class="absolute bottom-0 left-0 z-20 justify-start hidden w-full p-4 bg-gray-800 border-r border-gray-700 lg:flex">
        <a href="{{ route('admin.settings') }}"
            class="flex items-center p-2 text-sm font-normal text-white rounded-lg sidebar-link hover:bg-gray-700 group">
            <img src="{{ asset('Assets/settings.png') }}" alt="Order Tracking Icon" class="h-5 opacity-60 hover:opacity-100">
            <span class="ml-3">Settings</span>
        </a>
    </div>
</aside>
