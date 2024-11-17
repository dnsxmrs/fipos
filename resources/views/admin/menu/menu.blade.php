<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')

    <!-- Main Content -->
    <div class="flex space-x-6 h-[870px]">
        <!--Sub-Sidebar Frame-->
        <!-- Sub-Sidebar Options -->
        <div class="bg-white border rounded-md shadow-md w-[285px]">

            <div class="mt-12">
                <button
                    id="categoriesButton"
                    onclick="toggleCategoryButton()"
                    class="flex flex-col items-start text-left rounded-lg font-barlow text-xl mb-4 ml-2 w-[268px] h-auto p-4 text-black"
                    style="background-color: #E8C9B2;">
                    <div class="flex items-center">
                        <img src="{{ asset('Assets/category-icon.png') }}" alt="Category Icon" class="w-6 h-6 mr-2 ml-3">
                        <span>Categories</span>
                    </div>
                    <p class="text-sm text-gray-800 mt-1 ml-9">Management of categories</p>
                </button>
            </div>


        <button
                id="productsButton"
                onclick="toggleProductButton()"
                class="flex flex-col items-start text-left rounded-lg font-barlow text-xl mb-4 ml-2 w-[268px] h-auto p-4 text-black"
                style="background-color: #E8C9B2;">
                <div class="flex items-center">
                    <img src="{{ asset('Assets/product-icon.png') }}" alt="Product Icon" class="w-6 h-6 mr-2">
                    <span>Products</span>
                </div>
                <p class="text-sm text-gray-800 mt-1 ml-8">Management of products</p>
        </button>

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
        let isCategoriesActive = true; // Default to Products being active

        function toggleCategoryButton() {
            isCategoriesActive   = true; // Set state to false for Products
            localStorage.setItem('activeButton', 'categories'); // Store state
            setButtonStates();

            // this is route to categories
            navigateTo('{{ route('admin.menu.categories') }}');
        }

        function toggleProductButton() {
            isCategoriesActive = false; // Set state to true for Products
            localStorage.setItem('activeButton', 'products'); // Store state
            setButtonStates();

            // this is route to products
            navigateTo('{{ route('admin.menu.products') }}');
        }

        window.onload = function() {
            const activeButton = localStorage.getItem('activeButton');
            isCategoriesActive = (activeButton === 'categories');
            setButtonStates();
        };

        function setButtonStates() {
            const categoriesButton = document.getElementById('categoriesButton');
            const productsButton = document.getElementById('productsButton');

            if (isCategoriesActive) {
                categoriesButton.style.backgroundColor = '#E8C9B2'; // Active color
                categoriesButton.style.color = 'black'; // Active text color
                productsButton.style.backgroundColor = 'transparent'; // Inactive color
                productsButton.style.color = 'black'; // Inactive text color

            } else {

                productsButton.style.backgroundColor = '#E8C9B2'; // Active color
                productsButton.style.color = 'black'; // Active text color
                categoriesButton.style.backgroundColor = 'transparent'; // Inactive color
                categoriesButton.style.color = 'black'; // Inactive text color
            }
        }
    </script>


@endsection
