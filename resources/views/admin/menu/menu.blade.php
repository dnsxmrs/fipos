<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Main Content -->
    <div class="flex space-x-6 h-[870px]">
        <!-- Sub-Sidebar Frame -->
        <!-- Sub-Sidebar Options -->
      
        <!-- Sub-Sidebar Content -->
        <div class="bg-white border rounded-md shadow-md p-6 w-full ml-[285px]"> <!-- Adjust width here -->
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
