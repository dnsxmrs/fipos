@extends('layout.main-layout')

@section("content")
<div>
    @include('product.product-header')
</div>
<div>
    <div class="container"
@include('navigation.product-category-sidebar')
</div>

 <!-- Container for Menu Products -->
 <div class="bg-white border rounded-md shadow-md p-6 m-8  ">
    <div class="mt-5 space-y-10">

      <!-- Menu Category -->
      <div class="flex space-x-3 flex-wrap">
        <span class="text-xs text-white bg-amber-950 rounded-md h-10 w-20 flex justify-center items-center hover:bg-gray-400 transition-colors cursor-pointer">All Menu</span>
        <span class="text-xs text-white bg-amber-950 rounded-md h-10 w-20 flex justify-center items-center hover:bg-gray-400 transition-colors cursor-pointer">Coffee</span>
        <span class="text-xs text-white bg-amber-950 rounded-md h-10 w-20 flex justify-center items-center hover:bg-gray-400 transition-colors cursor-pointer">Non-Coffee</span>
        <span class="text-xs text-white bg-amber-950 rounded-md h-10 w-20 flex justify-center items-center hover:bg-gray-400 transition-colors cursor-pointer">Meal</span>
        <span class="text-xs text-white bg-amber-950 rounded-md h-10 w-20 flex justify-center items-center hover:bg-gray-400 transition-colors cursor-pointer">Snack</span>
        <span class="text-xs text-white bg-amber-950 rounded-md h-10 w-20 flex justify-center items-center hover:bg-gray-400 transition-colors cursor-pointer">Dessert</span>
      </div>
    </div>
 </div>
</div>

@endsection
