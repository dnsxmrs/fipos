        <!--Product&Category sidebar-->
        <div class="bg-gray-200 w-full">
            <h1 class="font-barlow text-4xl mb-1 mt-10 mx-8">
            Product<span class="ml-1">Management</span>
            </h1>

            <!-- Date and Time -->
            <div class="mb-1 mt-1 mx-8">
            <p class="font-barlow text-lg">current-date</p>
            </div>

            <!-- Search Bar -->
            <div class="flex items-center border border-gray-300 rounded-full w-[314px] p-2 mt-2 mb-4">
                <img src="{{ asset('Assets/search-icon.png') }}" alt="Search Icon" class="w-6 h-6 mr-2 ml-2">
                <input
                    type="text"
                    placeholder="Search for coffee, food.."
                    class="w-full focus:outline-none focus:border-gray-500 rounded-lg"
                />
            </div>
        </div>
