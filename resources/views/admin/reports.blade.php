<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin-layout')

@section('content')
    <div class="main-frame">
        <!-- Main Content -->
        <div class="content">
            <div class="header">
                <h1>Reports</h1>
                <div>
                    <p>Welcome, {{ Auth::user()->first_name }}</p>
                    <p class="font-barlow text-lg mt-2">{{ now()->setTimezone('Asia/Manila')->format('l, F j, Y g:i A') }}</p>
                </div>
            </div>

            {{-- success message in center --}}
            @if (session('success'))
                <p class="text-green text-center">{{ session('success') }}</p>
            @endif

            <!-- Action Buttons -->
            <div class="action-buttons">
                <div>
                    <a class="big-button">Audit Trails</a>
                    <a href="{{ route('admin.reports') }}" class="big-button">Order Tracking</a>
                    {{-- add user button --}}
                    <a href="{{ route('admin.users.index') }}" class="big-button">Staff Management</a>
                    {{-- edit profile --}}
                    <a href="{{ route('admin.update.profile') }}" class="big-button">Edit Profile</a>
                    {{-- change password --}}
                    <a href="{{ route('admin.change.password') }}" class="big-button">Change Password</a>

                </div>
                <div>
                    {{-- sample button for logout --}}
                    <a href="{{ route('logout.confirm') }}" class="big-button">Logout</a>
                </div>
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
