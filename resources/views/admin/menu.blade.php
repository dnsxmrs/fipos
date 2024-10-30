<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin-layout')

@section('content')
        <!-- Header -->
    <div class="mb-2">
        <h1 class="font-barlow text-4xl font-bold mr-0">Caffeinated <span
                class="text-4xl font-bold font-barlow ml-0 text-amber-950">POS</span></h1>
        <p class="font-barlow text-lg mt-2">{{ now()->setTimezone('Asia/Manila')->format('l, F j, Y g:i A') }}</p>

    </div>

    <!-- Main Content -->
    <div class="flex space-x-6 h-[870px]">
        <!--Sub-Sidebar Frame-->
        <!-- Sub-Sidebar Options -->
        <div class="bg-white border rounded-md shadow-md w-[285px]">
            <button
                id="categoriesButton"
                {{-- if you will remove scripts below, make sure to replace toggleCategoryButton() with {{ route('admin.menu.categories') }} --}}
                onclick="toggleCategoryButton()"
                class="flex items-center text-left font-barlow text-xl mb-1 mt-9 w-[268px] h-[76px] text-black">
                <img src="{{ asset('Assets/category-icon.png') }}" alt="Category Icon" class="w-6 h-6 mr-2 ml-3">
                <span class="">Categories</span>
            </button>
            <button
                id="productsButton"
                {{-- if you will remove scripts below, make sure to replace toggleProductButton() with {{ route('admin.menu.products') }} --}}
                onclick="toggleProductButton()"
                class="flex items-center text-left rounded-lg font-barlow text-xl mb-4 ml-2 w-[268px] h-[76px] text-black"
                style="background-color: #E8C9B2;">
                <img src="{{ asset('Assets/product-icon.png') }}" alt="Product Icon" class="w-6 h-6 mr-2 ml-2">
                <span class="">Products</span>
            </button>
            <div class="grid grid-cols-2 gap-4">
            </div>
        </div>

        <!-- Sub-Sidebar Content -->
        <div class="bg-white border rounded-md shadow-md p-6 w-[1450px]">
            @yield('main-content')

        </div>
    </div>

    <script>
        // this is just a draft for toggling the buttons
        // you can remove this script and replace the onclick event with the route


        // Initialize the toggle state
        let isProductsActive = true; // Default to Products being active

        function toggleCategoryButton() {
            isProductsActive = false; // Set state to false for Products
            localStorage.setItem('activeButton', 'categories'); // Store state
            setButtonStates();

            // this is route to categories
            navigateTo('{{ route('admin.menu.categories') }}');
        }

        function toggleProductButton() {
            isProductsActive = true; // Set state to true for Products
            localStorage.setItem('activeButton', 'products'); // Store state
            setButtonStates();

            // this is route to products
            navigateTo('{{ route('admin.menu.products') }}');
        }

        window.onload = function() {
            const activeButton = localStorage.getItem('activeButton');
            isProductsActive = (activeButton === 'products');
            setButtonStates();
        };

        function setButtonStates() {
            const categoriesButton = document.getElementById('categoriesButton');
            const productsButton = document.getElementById('productsButton');

            if (isProductsActive) {
                productsButton.style.backgroundColor = '#E8C9B2'; // Active color
                productsButton.style.color = 'black'; // Active text color
                categoriesButton.style.backgroundColor = 'transparent'; // Inactive color
                categoriesButton.style.color = 'black'; // Inactive text color
            } else {
                categoriesButton.style.backgroundColor = '#E8C9B2'; // Active color
                categoriesButton.style.color = 'black'; // Active text color
                productsButton.style.backgroundColor = 'transparent'; // Inactive color
                productsButton.style.color = 'black'; // Inactive text color
            }
        }
    </script>


@endsection
