{{-- <nav class="flex items-center justify-between w-full px-5 py-3 bg-white shadow fixed top-0 min-h-16">

    {{-- SEARCH BAR --}}
{{-- <div class="flex items-center justify-center">
        <span class="flex w-72 h-9 bg-gray-100 px-3 py-2 rounded-sm ml-24 items-center justify-center">
            <img class="h-4 opacity-50" src="{{ asset('images/search.png') }}" alt="search icon">
            <input type="text" placeholder="Search..."
                class=" border-none focus:ring-0 focus:outline-none text-gray-500 text-xs bg-transparent w-full ">
        </span>
        <button class="px-3 bg-green-500 hover:bg-green-600 h-9 text-white text-xs font-normal rounded-e-sm">
            Search
        </button>
    </div> --}}

{{-- PROFILE --}}


{{-- PROFILE INFO --}}

{{-- </nav> --}}







<nav class="fixed top-0 z-50 w-full bg-white shadow">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
                    Icon when menu is closed.

                    Menu open: "hidden", Menu closed: "block"
                  -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                    Icon when menu is open.

                    Menu open: "block", Menu closed: "hidden"
                  -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <img class="h-10 w-auto mr-3" src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated">
                    <div class="flex flex-col items-start justify-center">
                        <h3 class="font-bold text-xl">
                            CAFFEINATED
                        </h3>
                        <p class="font-normal text-sm text-gray-500">
                            Point of Sale System
                        </p>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4 h-full items-center justify-start ml-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="{{ route('menu.show') }}"
                            class="px-3 py-2 text-sm font-bold {{ Route::is('menu.show') ? 'border-b-2 border-green-600 text-green-600' : 'text-gray-500 hover:border-b-2 hover:border-green-600 hover:text-green-600' }}"
                            aria-current="page">Menu</a>
                        <a href="{{ route('orders.show') }}"
                            class="px-3 py-2 text-sm font-bold {{ Route::is('orders.show') ? 'border-b-2 border-green-600 text-green-600' : 'text-gray-500 hover:border-b-2 hover:border-green-600 hover:text-green-600' }}">Orders</a>
                        <a href="{{ route('online.orders.show') }}"
                            class="px-3 py-2 text-sm font-bold {{ Route::is('online.orders.show') ? 'border-b-2 border-green-600 text-green-600' : 'text-gray-500 hover:border-b-2 hover:border-green-600 hover:text-green-600' }}">Online
                            Orders</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


                <div class="relative hidden md:block">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <input type="text" id="search-navbar"
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search...">
                </div>

                <img class="rounded-full cursor-pointer mr-3 ml-3 h-9 object-cover hover:bg-gray-100 p-2"
                    src="{{ asset('Assets/notification.png') }}" alt="notification">

                <!-- Profile dropdown -->
                <div class="relative">
                    <div>
                        <button type="button" onclick="showDropdown()"
                            class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-400"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="size-8 rounded-full" src="{{ asset('Assets/avatar.png') }}" alt="profile icon">
                        </button>
                    </div>

                    <div id="profile-dropdown"
                        class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                        <a onclick="showLogoutModal()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            {{-- Search Bar --}}
            <div class="relative mt-3 mb-2">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search icon</span>
                </div>
                <input type="text" id="search-navbar"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search...">
            </div>

            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="{{ route('menu.show') }}"
                class="block rounded-md px-3 py-2 text-base font-medium {{ Route::is('menu.show') ? 'bg-green-700 text-white' : 'text-gray-500 hover:bg-green-700 hover:text-white' }} "
                aria-current="page">Menu</a>
            <a href="{{ route('orders.show') }}"
                class="block rounded-md px-3 py-2 text-base font-medium {{ Route::is('orders.show') ? 'bg-green-700 text-white' : 'text-gray-500 hover:bg-green-700 hover:text-white' }}">Orders</a>
            <a href="{{ route('online.orders.show') }}"
                class="block rounded-md px-3 py-2 text-base font-medium {{ Route::is('online.orders.show') ? 'bg-green-700 text-white' : 'text-gray-500 hover:bg-green-700 hover:text-white' }}">Online
                Orders</a>

        </div>
    </div>
</nav>



{{-- LOGOUT MODAL --}}
<div id="logout-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" onclick="hideLogoutModal()"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Logout modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to logout?
                </h3>

                <div class="flex items-center justify-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Logout
                        </button>
                    </form>
                    <button id="logout-no" onclick="hideLogoutModal()" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
