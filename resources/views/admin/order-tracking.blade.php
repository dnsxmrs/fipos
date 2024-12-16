<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
<style>
    /* Remove bold styling from table headers */
    table th {
        font-weight: normal;
    }
</style>

    <div class="flex flex-col block min-h-screen ml-16 lg:ml-64"> <!-- Added left margin for responsive sidebar space -->

        <div class="main-frame">
            <!-- Main Content -->
            <div class="content">
                <div class="header">
                    <div>
                        <h1>Order Tracking</h1>
                    </div>
                </div>

                <!-- Error Message Display -->
                <div class="error-message" id="errorMessage"></div>

                {{-- Comment out daw kasi wala dapat form sa order tracking --}}
                <!-- Order Form -->
                {{-- <div class="order-form">
                    <h2>Add / Edit Order</h2>
                    <div class="form-group">
                        <label for="orderId">Order ID</label>
                        <input type="text" id="orderId" placeholder="Auto-generated" disabled>
                    </div>
                    <div class="form-group">
                        <label for="customerName">Customer Name</label>
                        <input type="text" id="customerName" placeholder="Enter customer name">
                    </div>
                    <div class="form-group">
                        <label for="orderItems">Order Items</label>
                        <input type="text" id="orderItems" placeholder="Enter items ordered">
                    </div>
                    <div class="form-group">
                        <label for="orderTotal">Total Amount</label>
                        <input type="number" id="orderTotal" placeholder="Enter total amount">
                    </div>
                    <div class="form-group">
                        <label for="orderStatus">Order Status</label>
                        <select id="orderStatus">
                            <option value="Pending">Pending</option>
                            <option value="Preparing">Preparing</option>
                            <option value="Ready">Ready</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <button id="addOrderButton">Add Order</button>
                    <button id="updateOrderButton" style="display: none;">Update Order</button>
                    <button id="cancelEditButton" style="display: none;">Cancel</button>
                </div> --}}

                <!-- Orders Table -->
                <div class="orders-table">
                    <h2>Current Orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Items Ordered</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTableBody">
                            <!-- Orders will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>

                <!-- Orders History Table -->
                <div class="orders-table">
                    <h2>Orders History</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Items Ordered</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTableBodyHistory">
                            <!-- Orders will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

