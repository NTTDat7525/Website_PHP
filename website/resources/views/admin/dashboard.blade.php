<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body class="bg-gray-50">

    <div class="flex">
        @include('admin.sidebar')
        <main class="flex-1 p-8">
            <div class="mb-8 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Chào mừng trở lại!</h2>
                    <p class="text-lg text-blue-100">Quản lý nhà hàng và xem các chỉ số hoạt động</p>
                </div>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Đăng xuất
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Đặt bàn hôm nay</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todayBookings }}</p>
                        </div>
                        <div class="text-4xl text-blue-500"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Bàn trống</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $availableTables }}/{{ $totalTables }}</p>
                        </div>
                        <div class="text-4xl text-yellow-500"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Doanh thu (tháng)</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($monthlyRevenue, 1) }}M</p>
                        </div>
                        <div class="text-4xl text-green-500"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Tổng người dùng</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                        </div>
                        <div class="text-4xl text-purple-500"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Doanh thu 7 ngày gần nhất</h3>
                    <div class="h-64">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Trạng thái đặt bàn</h3>
                    <div class="h-64">
                        <canvas id="bookingsChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Doanh thu (Triệu)',
                    data: @json($revenues),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
        new Chart(bookingsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Đã xác nhận', 'Chờ xác nhận', 'Đã hủy'],
                datasets: [{
                    data: [
                        {{ $confirmed }},
                        {{ $pending }},
                        {{ $cancelled }}
                    ],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>

</html>