<nav class="fixed top-0 flex items-center justify-end w-full px-5 py-3 bg-white shadow min-h-16">


    {{-- PROFILE INFO --}}

        <span onclick="showDropdown()">
            <img class="object-cover h-8 border border-green-700 rounded-full cursor-pointer " src="{{ asset('Assets/avatar.png') }}"
                alt="profile icon">
        </span>
    </div>
</nav>

<div id="profile-dropdown" class="absolute right-0 z-10 hidden w-48 py-1 mt-16 mr-5 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none"
    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
    <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
        id="user-menu-item-0">Your Profile</a>
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
        id="user-menu-item-1">Settings</a>
    <a onclick="showLogoutModal()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
        id="user-menu-item-2">Sign out</a>
</div>


{{-- LOGOUT MODAL --}}
<div id="logout-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
    <div class="relative w-full max-w-md max-h-full p-4">
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <button type="button" onclick="hideLogoutModal()"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Logout modal</span>
            </button>
            <div class="p-4 text-center md:p-5">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to logout?
                </h3>

                <div class="flex items-center justify-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
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
