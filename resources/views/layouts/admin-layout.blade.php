<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Caffeinated</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            width: 100%;
            max-width: 1440px;
            margin: auto;
            background-color: #f3f3f3;
        }
        /* Adjusted Content Layout to Full Width */
        .content {
            padding: 20px;
            width: 100%;
        }

        .content-staff {
            flex-grow: 1;
            display: flex;
            padding: 40px;
            margin-left: 20px;
            /* Adjusted margin for centering */
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

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }
        .big-button {
            background-color: #5a341a;
            color: #fff;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        /* Sales Summary */
        .sales-summary {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .sales-summary h2 {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 20px;
        }
        /* Cards for Summary */
        .summary {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .summary .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: calc(33.333% - 13.33px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }
        .card h3 {
            font-weight: 600;
            margin: 0 0 10px 0;
            font-size: 16px;
        }
        .card p {
            font-size: 14px;
            color: #555;
        }
        /* Most Ordered and Order Type Sections */
        .most-ordered,
        .order-type {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: calc(50% - 10px);
        }
        .most-ordered-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .most-ordered h3,
        .order-type h3 {
            font-weight: 600;
            font-size: 16px;
            margin: 0 0 10px 0;
        }
        /* Logout Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            height: 200px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .modal h3 {
            margin: 0;
            color: #333;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            justify-content: center;
            align-items: center;
        }
        .modal p {
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }
        .modal-buttons {
            display: flex;
            justify-content: space-around;
        }
        .modal-button {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 14px;
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
            margin: 2% 0; /* Top and bottom only */
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

        .content-staff .left-panel {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-right: 20px;
        }

        /* Highlight User Management section */
        .highlight {
            background-color: #F7D9BF;
            padding: 10px;
            border-radius: 8px;
            color: #5a341a;
            margin-bottom: 20px;
        }

        .content-staff .left-panel h2 {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .content-staff .left-panel p {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }

        .content-staff .right-panel {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        .content-staff .right-panel h1 {
            font-weight: 600;
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .user-table th,
        .user-table td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .user-table th {
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        .status-active {
            color: #00C29A;
            font-weight: 600;
        }

        .button-add-user {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
        }

        .icon-edit,
        .icon-delete {
            width: 16px;
            height: 16px;
            display: inline-block;
            cursor: pointer;
        }

        .icon-edit {
            background: url('https://cdn-icons-png.flaticon.com/512/1159/1159633.png') no-repeat center;
            background-size: contain;
            margin-right: 8px;
        }

        .icon-delete {
            background: url('https://cdn-icons-png.flaticon.com/512/1214/1214428.png') no-repeat center;
            background-size: contain;
        }

        .user-table select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            font-size: 14px;
        }

        .close-button {
            margin-top: 15px;
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        function showConfirmationModal() {
            document.getElementById("confirmation-modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("confirmation-modal").style.display = "none";
        }

        function handleFormSubmission(event) {
            event.preventDefault(); // Prevent actual form submission
            showConfirmationModal(); // Show confirmation modal
        }
    </script>
</head>

<body>
    <!--mainframe-->
    <div class="flex h-screen bg-[rgb(243,243,243)]">
        @include('navigation-sidebar.admin-sidebar')

        <!--main content-->
        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>

    </div>
</body>

</html>
