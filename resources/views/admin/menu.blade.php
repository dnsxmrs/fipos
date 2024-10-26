<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin-layout')

@section('content')
        <!-- Header -->
    <div class="mb-2">
        <h1 class="font-barlow text-4xl font-bold mr-0">Caffeinated <span
                class="text-4xl font-bold font-barlow ml-0 text-amber-950">POS</span></h1>
            <p class="font-barlow text-lg mt-2">{{ now()->format('l, F j, Y') }}</p>
    </div>

    <!-- Main Content -->
    <div class="flex space-x-6 h-[870px]">
        <!--Sub-Sidebar Frame-->
        <!-- Sub-Sidebar Options -->
        <div class="bg-white border rounded-md shadow-md w-[285px]">
            <button
                onclick="navigateTo('{{ route('admin.menu.categories') }}')" class="flex items-center text-left font-barlow text-xl mb-1 mt-9 w-[268px] h-[76px] text-black">
                <img src="{{ asset('Assets/category-icon.png') }}" alt="Category Icon" class="w-6 h-6 mr-2 ml-3">
                <span class="">Categories</span>
            </button>
            <button
                onclick="navigateTo('{{ route('admin.menu.products') }}')" class="flex items-center text-left rounded-lg font-barlow text-xl mb-4 ml-2 w-[268px] h-[76px] text-black"
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
@endsection
