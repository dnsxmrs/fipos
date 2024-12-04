<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Main Content -->
    <div class="flex space-x-6 h-[870px]">
        <!--Sub-Sidebar Frame-->
        <!-- Sub-Sidebar Options -->
        <div class="bg-white border rounded-md shadow-md w-[285px]">
            <div class="mt-12">
                <button id="categoriesButton" onclick="toggleCategoryButton()"
                    class="flex flex-col items-start text-left rounded-lg font-barlow text-xl mb-4 ml-2 w-[268px] h-auto p-4 text-black"
                    style="background-color: transparent;">
                    <div class="flex items-center">
                        <img src="{{ asset('Assets/category-icon.png') }}" alt="Category Icon" class="w-6 h-6 mr-2 ml-3">
                        <span>Categories</span>
                    </div>
                    <p class="text-sm text-gray-800 mt-1 ml-9">Management of categories</p>
                </button>
                <button id="productsButton" onclick="toggleProductButton()"
                    class="flex flex-col items-start text-left rounded-lg font-barlow text-xl mb-4 ml-2 w-[268px] h-auto p-4 text-black"
                    style="background-color: transparent;">
                    <div class="flex items-center">
                        <img src="{{ asset('Assets/product-icon.png') }}" alt="Product Icon" class="w-6 h-6 mr-2 ml-3">
                        <span>Products</span>
                    </div>
                    <p class="text-sm text-gray-800 mt-1 ml-8">Management of products</p>
                </button>
            </div>
        </div>
        <!-- Sub-Sidebar Content -->
        <div class="bg-white border rounded-md shadow-md p-6 w-[1450px]">
            @yield('main-content')
        </div>
    </div>

    <script>
        // Function to toggle the active button
        document.addEventListener('DOMContentLoaded', function() {
            const categoriesButton = document.getElementById('categoriesButton');
            const productsButton = document.getElementById('productsButton');

            // Check the initial active button from localStorage
            const activeButton = localStorage.getItem('activeButton');
            let isCategoriesActive = (activeButton === 'categories');
            setButtonStates();

            // Add click event listeners for buttons
            categoriesButton.addEventListener('click', function() {
                isCategoriesActive = true;
                localStorage.setItem('activeButton', 'categories');
                window.location.href = '{{ route('admin.menu.categories') }}';
            });
            productsButton.addEventListener('click', function() {
                isCategoriesActive = false;
                localStorage.setItem('activeButton', 'products');
                window.location.href = '{{ route('admin.menu.products') }}';
            });

            // Function to update button states
            function setButtonStates() {
                if (isCategoriesActive) {
                    categoriesButton.style.backgroundColor = '#E8C9B2'; // Active color
                    productsButton.style.backgroundColor = 'transparent'; // Inactive color
                } else {
                    productsButton.style.backgroundColor = '#E8C9B2'; // Active color
                    categoriesButton.style.backgroundColor = 'transparent'; // Inactive color
                }
            }
        });
    </script>
@endsection
