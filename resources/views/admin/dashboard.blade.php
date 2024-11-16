<!-- resources/views/admin/products.blade.php -->
@extends('layouts.admin_layout')

@section('content')
    <!-- Main Content -->
    <div class="">
        <div class="">
        </div>
        <div class="">

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
