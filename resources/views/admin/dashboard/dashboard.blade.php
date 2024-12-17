@extends('layouts.admin-layout')

@section('admin_content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Main Content -->
<div class="flex flex-col block min-h-screen ml-16 lg:ml-64"> <!-- Added left margin for responsive sidebar space -->

    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-3xl font-bold text-green-700">Dashboard</h3>
            <p class="text-sm text-gray-500">Welcome, {{ Auth::user()->first_name }}</p>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="flex flex-col flex-1 gap-8 p-5 overflow-auto lg:flex-row">

        <!-- Left Side: Statistics -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 border-green-700">

            <div class="p-5 text-center bg-white rounded-lg shadow-md border-2 border-solid border-green-700">
                <h3 class="font-medium mb-2.5 text-base">Total Revenue</h3>
                <p class="text-sm text-[#555]">PHP 10,243.00</p>
            </div>

            
            <div class="p-5 text-center bg-white rounded-lg shadow-md border-2 border-transparent hover:border-green-700">
                <h3 class="font-medium mb-2.5 text-base">Total Dishes Ordered</h3>
                <p class="text-sm text-[#555]">23,456</p>
            </div>
            <div class="p-5 text-center bg-white rounded-lg shadow-md border-2 border-transparent hover:border-green-700">
                <h3 class="font-medium mb-2.5 text-base">Total Customers</h3>
                <p class="text-sm text-[#555]">1,234</p>
            </div>
        </div>

            <!-- Sales Summary Chart -->
            <div class="p-5 bg-white rounded-lg shadow-md">
                <h2 class="mb-5 text-lg font-semibold">Sales Summary</h2>
                <canvas id="salesChart" class="w-full h-[300px] lg:h-[400px]"></canvas>
                <script>
                    // Sales Chart
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
                            datasets: [{
                                label: 'Sales',
                                data: [30, 50, 70, 40, 90, 100, 80, 60],
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 2,
                                fill: false
                            }]
                        },
                        options: {
                            responsive: false,
                            maintainAspectRatio: true,
                            scales: {
                                x: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- Right Side: Most Ordered & Order Type -->
        <div class="w-full lg:w-[520px] space-y-5">

            <!-- Most Ordered Section -->
            <div class="p-5 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-semibold">Most Ordered</h3>
                    <select class="px-4 py-2 text-white bg-green-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 hover:bg-green-700" id="mostOrderedFilter">
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>

                <div class="overflow-auto bg-white rounded-lg shadow-md most-ordered-items">
                    <hr class="my-2 border-t-2 border-gray-300">
                    <div class="w-full p-4 overflow-x-auto bg-white rounded-lg shadow-md">
                        <table class="w-full mt-2 border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-sm font-semibold text-left text-gray-700 border-b">Item</th>
                                    <th class="px-4 py-2 text-sm font-semibold text-left text-gray-700 border-b">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">Americano</td>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">200</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">Caramel Macchiato</td>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">600</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">Siomai</td>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">12</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">Waffle</td>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">7</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Most Type of Order Section -->
            <div class="p-5 bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-semibold">Most Type of Order</h3>
                    <select class="px-4 py-2 text-white bg-green-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 hover:bg-green-700" id="orderTypeFilter">
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>
                <div class="order-type-chart">
                    <canvas id="orderTypeChart" class="w-full h-[300px] lg:h-[400px]"></canvas>
                </div>
            </div>

            <script>
                const orderTypeData = {
                    'today': [200, 122, 264],
                    'week': [1400, 980, 1848],
                    'month': [6000, 4500, 5500],
                };

                const ctxOrderType = document.getElementById('orderTypeChart').getContext('2d');
                let orderTypeChart = new Chart(ctxOrderType, {
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
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        }
                    }
                });

                document.getElementById('orderTypeFilter').addEventListener('change', function() {
                    const selectedPeriod = this.value;
                    const data = orderTypeData[selectedPeriod];
                    orderTypeChart.data.datasets[0].data = data;
                    orderTypeChart.update();
                });
            </script>
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
            alert('Logged out!');
            closeModal();
        }

        // Close modal if clicked outside content
        window.onclick = function(event) {
            if (event.target === logoutModal) {
                closeModal();
            }
        };
    </script>
</div>
@endsection
