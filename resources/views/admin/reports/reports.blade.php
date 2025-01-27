<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Invoice</p>
            <p class="text-sm text-gray-500">Receipts and record for payments</p>
        </div>
    </div>

    <div class="h-auto py-5 mb-10 bg-white rounded-lg shadow-sm px-7 ">
        <div class="flex items-center justify-between">
            <form autocomplete="off">
                <input type="text" placeholder="Search for category..."
                    class="w-64 h-10 p-3 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                    id="category_search" onkeyup="filterCategories()" />
            </form>
            <!-- Export Csv button -->
            <a href="{{ route('admin.payments.export') }}"
                class="block text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <i class="fa-solid fa-download mr-2"></i>
                Export CSV
            </a>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start justify-center w-full rounded-lg my-7">
            <div class="w-full ">
                {{-- <table id="category_table" class="w-full rounded-lg shadow table-auto category_table"> --}}
                <table id="category_table" class="w-full rounded-lg shadow table-auto category_table">
                    <thead class="border-b-2 rounded-lg bg-slate-100">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Order Number</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Amount</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Description</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Issued By</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Mode of Payment </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($payments as $payment)
                            <tr class="text-center">
                                <td class="p-3 text-sm tracking-wide">{{ $payment->order->order_number }}</td>
                                <td class="p-3 text-sm tracking-wide">{{ $payment->amount }}</td>
                                <td class="p-3 text-sm tracking-wide">{{ $payment->description }}</td>
                                <td class="p-3 text-sm tracking-wide">
                                    {{ $payment->order->user->first_name }} {{ $payment->order->user->last_name }}
                                </td>
                                <td class="p-3 text-sm tracking-wide">{{ $payment->mode_of_payment }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div id="no-products-message" class="hidden mt-4 text-center text-red-500">
                    No payments found matching your search criteria.
                </div>

                <div class="mt-5">
                    {{ $payments->links() }}
                </div>


            </div>
        </div>
    </div>


    <!-- INCLUDE MODALS -->
    @include('admin.menu.modals.category.add-category')
    @include('admin.menu.modals.category.confirm-delete')
    @include('admin.menu.modals.category.delete-category')
    @include('admin.menu.modals.category.edit-category')
    @include('admin.menu.modals.category.success-add')
    @include('admin.menu.modals.category.success-delete')
    @include('admin.menu.modals.category.success-edit')

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // success add modal
            @if (session('status_add'))
                showAddedDialogCategories();
            @endif


            @if (session('status_edit'))
                showEditedDialogCategories();
            @endif


            @if (session('status_deleted'))
                showDeletedDialogCategories();
            @endif

        });
    </script>
@endsection
