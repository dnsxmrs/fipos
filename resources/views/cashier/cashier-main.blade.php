<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta and Title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Fonts and Chart.js -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .modal h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
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

        .title {
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="main-frame">
        <!-- Main Content -->
        <div class="content">
            <div class="header">
                <h1>Dashboard</h1>
                <div>
                    <p>Welcome, {{ Auth::user()->first_name }}</p>
                    <p>Sunday, October 20, 2024</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <div>
                    <h1 class="title">Cashier Page</h1>
                </div>
                <div>
                    {{-- sample button for logout --}}
                    <a href="{{ route('logout.confirm') }}" class="big-button">Logout</a>
                </div>
            </div>

</body>

</html>
