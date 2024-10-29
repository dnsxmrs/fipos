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
        body, html {
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
        .most-ordered, .order-type {
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
        .most-ordered h3, .order-type h3 {
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
    </style>
</head>
<body>

<div class="main-frame">
    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h1>Dashboard</h1>
            <p>Sunday, October 20, 2024</p>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="big-button">Audit Trails</button>
            <button class="big-button">Order Management</button>
        </div>

        <!-- Sales Summary -->
        <div class="sales-summary">
            <h2>Sales Summary</h2>
            <canvas id="salesChart" width="600" height="400"></canvas>
        </div>

        <!-- Summary Cards -->
        <div class="summary">
            <div class="card">
                <h3>Total Revenue</h3>
                <p>PHP 10,243.00</p>
            </div>
            <div class="card">
                <h3>Total Dishes Ordered</h3>
                <p>23,456</p>
            </div>
            <div class="card">
                <h3>Total Customers</h3>
                <p>1,234</p>
            </div>
        </div>

        <!-- Most Ordered and Order Type Sections -->
        <div class="summary">
            <div class="most-ordered">
                <div class="most-ordered-header">
                    <h3>Most Ordered</h3>
                    <select class="dropdown" id="mostOrderedFilter">
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>
                <div class="most-ordered-items">
                    <!-- Items will be dynamically inserted here -->
                </div>
            </div>

            <div class="order-type">
                <div class="most-ordered-header">
                    <h3>Most Type of Order</h3>
                    <select class="dropdown" id="orderTypeFilter">
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>
                <div class="order-type-chart">
                    <canvas id="orderTypeChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="modal">
    <div class="modal-content">
        <h3>Confirm Logout</h3>
        <p>Are you sure you want to log out?</p>
        <div class="modal-buttons">
            <button class="modal-button" onclick="confirmLogout()">Yes</button>
            <button class="modal-button" onclick="closeModal()">No</button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Modal functionality
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');

    function closeModal() {
        logoutModal.style.display = 'none';
    }

    function confirmLogout() {
        // Here, you would add your logout logic (e.g., redirect or clear session)
        alert('Logged out!');
        closeModal();
    }

    // Close modal if clicked outside content
    window.onclick = function(event) {
        if (event.target === logoutModal) {
            closeModal();
        }
    }

    // Data for 'Most Ordered' items
    const mostOrderedData = {
        'today': [
            { name: 'Americano', orders: 20, img: 'https://via.placeholder.com/40' },
            { name: 'Mocha', orders: 17, img: 'https://via.placeholder.com/40' },
            { name: 'Spanish Latte', orders: 14, img: 'https://via.placeholder.com/40' },
        ],
        'week': [
            { name: 'Cappuccino', orders: 150, img: 'https://via.placeholder.com/40' },
            { name: 'Espresso', orders: 120, img: 'https://via.placeholder.com/40' },
            { name: 'Latte', orders: 110, img: 'https://via.placeholder.com/40' },
        ],
        'month': [
            { name: 'Mocha', orders: 600, img: 'https://via.placeholder.com/40' },
            { name: 'Americano', orders: 550, img: 'https://via.placeholder.com/40' },
            { name: 'Espresso', orders: 500, img: 'https://via.placeholder.com/40' },
        ],
    };

    // Data for 'Order Type' chart
    const orderTypeData = {
        'today': [200, 122, 264],
        'week': [1400, 980, 1848],
        'month': [6000, 4500, 5500],
    };

    // Order Type Chart
    const ctx = document.getElementById('orderTypeChart').getContext('2d');
    const orderTypeChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Dine In', 'To Go', 'Delivery'],
            datasets: [{
                data: orderTypeData['today'],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });

    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                label: 'Monthly Sales',
                data: [1200, 1900, 3000, 5000, 2300, 2900, 4500, 3200, 4100, 5300],
                borderColor: '#5a341a',
                backgroundColor: 'rgba(90, 52, 26, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                },
            }
        }
    });

    const mostOrderedFilter = document.getElementById('mostOrderedFilter');
    const orderTypeFilter = document.getElementById('orderTypeFilter');

    mostOrderedFilter.addEventListener('change', updateMostOrdered);
    orderTypeFilter.addEventListener('change', updateOrderTypeChart);

    function updateMostOrdered() {
        const selectedPeriod = mostOrderedFilter.value;
        const data = mostOrderedData[selectedPeriod];

        const container = document.querySelector('.most-ordered-items');

        // Remove existing items
        container.innerHTML = '';

        // Add new items
        data.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.classList.add('most-ordered-item');

            const img = document.createElement('img');
            img.src = item.img;
            img.alt = item.name;

            const span = document.createElement('span');
            span.textContent = `${item.name} - ${item.orders} cups ordered`;

            itemDiv.appendChild(img);
            itemDiv.appendChild(span);

            container.appendChild(itemDiv);
        });
    }

    function updateOrderTypeChart() {
        const selectedPeriod = orderTypeFilter.value;
        const data = orderTypeData[selectedPeriod];

        orderTypeChart.data.datasets[0].data = data;
        orderTypeChart.update();
    }

    // Initial load
    updateMostOrdered();
    updateOrderTypeChart();

</script>

</body>
</html>
