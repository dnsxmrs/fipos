<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta and Title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Barlow', sans-serif;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
            height: 100%;
        }

        .main-frame {
            display: flex;
            height: 100vh;
            width: 1440px;
            margin: auto;
            background-color: #f3f3f3;
        }

        /* Content Layout */
        .content {
            padding: 20px;
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }

        .header h1 {
            font-weight: 600;
            font-size: 24px;
        }

        .header p {
            font-size: 16px;
            color: #555;
        }

        /* Error Message */
        .error-message {
            color: #ff4d4f;
            font-size: 14px;
            margin-bottom: 15px;
            display: none;
        }

        /* Form Styles */
        .order-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .order-form h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .order-form .form-group {
            margin-bottom: 15px;
        }

        .order-form label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .order-form input,
        .order-form select {
            width: 100%;
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .order-form button {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Orders Table */
        .orders-table {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .orders-table h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .orders-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th,
        .orders-table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }

        .orders-table th {
            background-color: #f9f9f9;
            font-weight: 600;
        }

        .orders-table td {
            font-size: 14px;
        }

        .orders-table .action-buttons {
            display: flex;
            gap: 10px;
        }

        .orders-table .action-buttons button {
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .orders-table .edit-button {
            background-color: #36A2EB;
            color: #fff;
        }

        .orders-table .delete-button {
            background-color: #FF6384;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="main-frame">
        <!-- Main Content -->
        <div class="content">
            <div class="header">
                <div>
                    <a href="{{route('dashboard')}}">Back to Dashboard</a>
                    <h1>Order Management</h1>
                </div>
                <p>Sunday, October 20, 2024</p>
            </div>

            <!-- Error Message Display -->
            <div class="error-message" id="errorMessage"></div>

            <!-- Order Form -->
            <div class="order-form">
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
            </div>

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
        </div>
    </div>
</body>

</html>
