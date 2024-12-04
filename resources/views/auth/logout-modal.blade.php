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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Logout Modal */
        .modal {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            visibility: hidden; /* Initially hidden */
            opacity: 0; /* Fade effect */
            transition: visibility 0s, opacity 0.5s linear;
        }

        .modal.active {
            visibility: visible;
            opacity: 1;
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
            justify-content: space-between;
        }

        .yes-button {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 14px;
        }

        .no-button {
            background-color: #f3f3f3;
            color: #5a341a;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #5a341a;
            font-size: 14px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="modal" id="logoutModal" aria-hidden="true">
        <div class="modal-content">
            <h3>Confirm Logout</h3>
            <p>Are you sure you want to log out?</p>
            <div class="modal-buttons">
                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="yes-button">Yes</button>
                    </form>
                </div>
                <div>
                    <button class="no-button" onclick="closeModal()">No</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show the modal
        function showModal() {
            const logoutModal = document.getElementById('logoutModal');
            logoutModal.classList.add('active');
            logoutModal.setAttribute('aria-hidden', 'false');
        }

        // Function to close the modal
        function closeModal() {
            const logoutModal = document.getElementById('logoutModal');
            logoutModal.classList.remove('active');
            logoutModal.setAttribute('aria-hidden', 'true');
            // Redirect back to the referring page
            window.location.href = document.referrer; // Fallback to cashier page if referrer is not available
        }

        // Call showModal to display it (or implement a button click to trigger it)
        showModal();
    </script>
</body>

</html>
