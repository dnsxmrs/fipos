<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Main Content -->
    <div class="block">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg">Dashboard</h3>
                <p class="text-sm text-gray-500">Welcome, {{ Auth::user()->first_name }}</p>
                <p class="text-sm text-gray-500">{{ now()->setTimezone('Asia/Manila')->format('l, g:i A') }}</p>

            </div>
            <div class="flex justify-between gap-5 mb-5">
                <div>
                </div>
                <div>
                    {{-- sample button for logout --}}
                    <a href="{{ route('logout.confirm') }}" class="big-button">Logout</a>
                </div>
            </div>
        </div>
        <div class="flex mt-8">
            <div class="block">
                <div class="flex space-x-4 mb-3 flex-wrap ">
                    <div class="bg-white rounded-lg p-5 w-[calc(33.333%-13.33px)] shadow-md text-center mb-5">
                        <h3 class=" text-left font-medium mb-2.5 text-base">Total Revenue</h3>
                        <p class="text-left  text-sm text-[#555]">PHP 10,243.00</p>
                    </div>
                    <div class="bg-white rounded-lg p-5 w-[calc(33.333%-13.33px)] shadow-md text-center mb-5">
                        <h3 class="text-left font-medium mb-2.5 text-base">Total Dishes Ordered</h3>
                        <p class=" text-left text-sm text-[#555]">23,456</p>
                    </div>
                    <div class="bg-white rounded-lg p-5 w-[calc(33.333%-13.33px)] shadow-md text-center mb-5">
                        <h3 class="text-left font-medium mb-2.5 text-base">Total Customers</h3>
                        <p class="text-left text-sm text-[#555]">1,234</p>
                    </div>

                </div>
                <!-- Sales Summary -->
                <div class="bg-white rounded-lg p-5 shadow-md mb-5">
                    <h2 class="font-semibold text-lg mb-5">Sales Summary</h2>
                    <canvas id="salesChart" width="600" height="400"></canvas>
                </div>
            </div>


            <div class="block ml-5">
                <div class="bg-white rounded-lg p-5 shadow-md mb-5 w-full">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-base mb-2.5">Most Ordered</h3>
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
                <div class="bg-white rounded-lg p-5 shadow-md mb-5 w-full">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-base mb-2.5">Most Type of Order</h3>
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
            'today': [{
                    name: 'Americano',
                    orders: 20,
                    img: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Mocha',
                    orders: 17,
                    img: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Spanish Latte',
                    orders: 14,
                    img: 'https://via.placeholder.com/40'
                },
            ],
            'week': [{
                    name: 'Cappuccino',
                    orders: 150,
                    img: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Espresso',
                    orders: 120,
                    img: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Latte',
                    orders: 110,
                    img: 'https://via.placeholder.com/40'
                },
            ],
            'month': [{
                    name: 'Mocha',
                    orders: 600,
                    img: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Americano',
                    orders: 550,
                    img: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Espresso',
                    orders: 500,
                    img: 'https://via.placeholder.com/40'
                },
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
@endsection
