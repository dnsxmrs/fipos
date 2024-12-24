<nav class="flex items-center justify-between w-full p-5 bg-white shadow fixed top-0 h-24 max-h-24">

    {{-- LOGO --}}
    <div class="flex items-center justify-start text-2xl">
        <div class="w-20"></div>
        <div class="block ">
            <span class="font-semibold">
                Caffeinated
                <span class=" text-green-700">POS</span>
            </span>
            <p class="text-sm">{{ now()->setTimezone('Asia/Manila')->format('l, g:i A') }}
            </p>
        </div>
    </div>

    {{-- SEARCH BAR --}}
    <div class="flex w-72 border border-green-700 p-2 rounded-lg ">
        <img class="w-[24px]" src="{{ asset('images/search.png') }}" alt="search icon">
        <input type="text" placeholder="Search for menu"
            class="ml-2 outline-none bg-transparent w-full focus:border-transparent">
    </div>

    {{-- PROFILE INFO --}}
    <div class="flex items-center justify-start space-x-2">
        <img class="cursor-pointer" src="{{ asset('Assets/notification.png') }}" alt="notification">
        <div class="bg-gray-300 rounded-lg p-2 flex items-center justify-start w-44 space-x-2 max-h-12">
            <img class="h-9" src="{{ asset('Assets/profile.png') }}" alt="profile icon">
            <div>
                <p class="text-sm font-medium text-black">
                    {{ Auth::user()->first_name }}
                </p>
                <p class="text-sm font-regular text-gray-500">
                    {{ ucfirst(Auth::user()->role) }}
                </p>
            </div>
        </div>
    </div>
</nav>
