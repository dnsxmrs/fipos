<!-- Header -->
<header class="fixed top-0 left-0 z-50 w-full p-4 mb-4 bg-white rounded shadow-md">
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

<!-- Main Content Wrapper -->
<div class="mt-20"> <!-- Added margin to avoid overlap with fixed header -->
    <!-- Your other page content goes here -->
</div>
