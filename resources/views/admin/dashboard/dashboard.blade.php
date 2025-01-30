@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Main Content -->
    <div class="flex flex-col min-h-screen">

        <!-- Top Header -->
        <div class="flex items-center justify-between">
            <div class="my-3 mb-7">
                <p class="text-xl font-medium text-black">Dashboard</p>
            </div>
        </div>

        <!-- Main Dashboard Content (Column layout with 3 rows) -->
        <div class="flex flex-1 flex-col gap-8 p-5 overflow-auto">

            <!-- Row 1: Statistics (4 boxes) -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 w-full">
                <div class="w-full p-4 text-center bg-white border-2 border-solid rounded-lg shadow-md">
                    <h3 class="mb-2 text-sm font-medium">Total Revenue</h3>
                    <p class="text-xs text-[#555]">PHP {{ number_format($totalRevenue, 2) }}</p>
                </div>

                <div class="w-full p-4 text-center bg-white border-2 border-solid rounded-lg shadow-md">
                    <h3 class="mb-2 text-sm font-medium">Total Dishes Ordered</h3>
                    <p class="text-xs text-[#555]">{{ $totalDishesOrdered }}</p>
                </div>

                <div class="w-full p-4 text-center bg-white border-2 border-solid rounded-lg shadow-md">
                    <h3 class="mb-2 text-sm font-medium">Total Customers</h3>
                    <p class="text-xs text-[#555]">{{ $totalCustomers }}</p>
                </div>
            </div>

            <!-- Row 2: Sales Summary Chart -->
            <div class="w-full p-5 bg-white rounded-lg shadow-md">
                <h2 class="mb-5 text-lg font-semibold">Sales Summary</h2>
                <canvas id="salesChart" class="w-full h-[300px] lg:h-[400px]"></canvas>
                <script>
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    let salesChart;

                    function fetchSalesData() {
                        fetch('/api/sales-data')
                            .then(response => response.json())
                            .then(data => {
                                // Log the response to check the data structure
                                console.log("Sales Data:", data);

                                // Update chart with new data
                                if (salesChart) {
                                    salesChart.destroy(); // Destroy the previous chart instance if it exists
                                }

                                salesChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                                            'September',
                                            'October', 'November', 'December'
                                        ],
                                        datasets: [{
                                            label: 'Sales',
                                            data: data.data, // Use the sales data received from the API
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 2,
                                            fill: false
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: true,
                                        scales: {
                                            x: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching sales data:', error);
                            });
                    }

                    // Call the function to fetch the sales data and update the chart
                    fetchSalesData();
                </script>
            </div>

            <!-- Row 3: Most Ordered & Most Type of Order -->
            <div class="flex flex-col lg:flex-row gap-8 w-full">

                <!-- Most Ordered Section -->
                <div class="flex-1 p-5 bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-base font-semibold">Most Ordered</h3>
                        <select
                            class="px-4 py-2 text-white bg-green-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 hover:bg-green-700"
                            id="mostOrderedFilter">
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
                                        <th class="px-4 py-2 text-sm font-semibold text-left text-gray-700 border-b">Item
                                        </th>
                                        <th class="px-4 py-2 text-sm font-semibold text-left text-gray-700 border-b">
                                            Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="mostOrderedBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Most Type of Order Section -->
                <div class="flex-1 p-5 bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-base font-semibold">Most Type of Order</h3>
                        <select
                            class="px-4 py-2 text-white bg-green-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 hover:bg-green-700"
                            id="orderTypeFilter">
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                    </div>
                    <div class="order-type-chart">
                        <canvas id="orderTypeChart" class="w-full h-[300px] lg:h-[400px]"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const orderTypeData = {
            'today': [0, 0, 0],
            'week': [0, 0, 0],
            'month': [0, 0, 0],
        };

        const ctxOrderType = document.getElementById('orderTypeChart').getContext('2d');
        let orderTypeChart = new Chart(ctxOrderType, {
            type: 'pie',
            data: {
                labels: ['Dine In', 'To Go', 'Online'],
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

        // Function to fetch order type data
        function fetchOrderTypeData(period) {
            fetch(`{{ route('dashboard.mostOrderTypes') }}?filter=${period}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken, // CSRF token
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Order Type Data:", data);
                    // Update the chart data
                    orderTypeChart.data.datasets[0].data = [
                        data['dine-in'],
                        data['take-out'],
                        data['online']
                    ];
                    orderTypeChart.update();
                })
                .catch(error => console.error("Error fetching order types:", error));
        }

        // Listen for changes on the filter select
        document.getElementById('orderTypeFilter').addEventListener('change', function() {
            const selectedPeriod = this.value;
            fetchOrderTypeData(selectedPeriod);
        });


        document.addEventListener("DOMContentLoaded", function() {
            // Fetch initial data for "today"
            fetchOrderTypeData('today');
            const filterSelect = document.getElementById("mostOrderedFilter");
            const mostOrderedBody = document.getElementById("mostOrderedBody");

            // Function to fetch and display the most ordered items based on filter
            function fetchMostOrderedItems(filter) {
                fetch("{{ route('dashboard.mostOrdered') }}?filter=" + filter, {
                        method: 'GET',
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            "Content-Type": "application/json",
                        },
                    })
                    .then(response => {
                        // Check for a successful response (status code 200)
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        mostOrderedBody.innerHTML = ''; // Clear existing table rows

                        // Log the data to check its structure
                        console.log("Most Ordered Items:", data);

                        // Check if data is an array and contains the expected structure
                        if (Array.isArray(data) && data.length > 0) {
                            // There are items to display
                            data.forEach(item => {
                                if (item.name && item.quantity) {
                                    const row = document.createElement('tr');
                                    row.innerHTML = `
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">${item.name}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">${item.quantity}</td>
                                `;
                                    mostOrderedBody.appendChild(row);
                                } else {
                                    console.error("Unexpected item structure:", item);
                                }
                            });
                        } else {
                            // Handle the case where no items are returned (or the data is empty)
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td class="px-4 py-2 text-sm text-gray-700 border-b" colspan="2">No data available</td>
                        `;
                            mostOrderedBody.appendChild(row);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching most ordered items:", error);
                    });
            }

            // Initial fetch for "Today" data
            fetchMostOrderedItems('today');

            // Listen for changes in the filter
            filterSelect.addEventListener("change", function() {
                const selectedFilter = filterSelect.value;
                fetchMostOrderedItems(selectedFilter);
            });
        });
    </script>
@endsection
