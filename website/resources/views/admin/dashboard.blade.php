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
        <aside class="w-64 bg-gray-900 text-white min-h-screen p-6">
            <div class="mb-8">
                <h2 class="text-xl font-bold">Quản Lý</h2>
            </div>

            <nav class="space-y-3">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition font-medium">
                    Bảng điều khiển
                </a>
                <a href="{{ route('admin.bookings') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Quản lý đặt bàn
                </a>
                <a href="{{ route('admin.tables') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Quản lý bàn
                </a>
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Quản lý người dùng
                </a>
                <a href="{{ route('admin.revenue') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Doanh thu
                </a>
                <a href="{{ route('admin.reports') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Báo cáo
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <div class="mb-8 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Chào mừng trở lại!</h2>
                    <p class="text-lg text-blue-100">Quản lý nhà hàng và xem các chỉ số hoạt động</p>
                </div>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Đăng xuất
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Đặt bàn hôm nay</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">24</p>
                            <p class="text-green-600 text-sm font-medium mt-2">↑ 15% so với hôm qua</p>
                        </div>
                        <div class="text-4xl text-blue-500"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Bàn trống</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">8/24</p><!-- lấy dữ liệu từ cơ sở dữ liệu -->
                            <p class="text-yellow-600 text-sm font-medium mt-2">33% sức chứa</p>
                        </div>
                        <div class="text-4xl text-yellow-500"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Doanh thu (tháng)</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">89.5M</p><!-- lấy dữ liệu từ cơ sở dữ liệu -->
                            <p class="text-green-600 text-sm font-medium mt-2">↑ 22% so với tháng trước</p>
                        </div>
                        <div class="text-4xl text-green-500"></div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Tổng người dùng</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">1,245</p><!-- lấy dữ liệu từ cơ sở dữ liệu -->
                            <p class="text-blue-600 text-sm font-medium mt-2">↑ 8% người mới</p>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Đặt bàn gần đây</h3>
                    <div class="space-y-4">
                        <div class="border-l-4 border-green-500 pl-4 py-2">
                            <p class="font-medium text-gray-900">Nguyễn Văn A - Bàn A1</p>
                            <p class="text-sm text-gray-600">4 người - 19:00 hôm nay</p>
                        </div>
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <p class="font-medium text-gray-900">Trần Thị B - Bàn B2</p>
                            <p class="text-sm text-gray-600">6 người - 12:30 hôm nay</p>
                        </div>
                        <div class="border-l-4 border-yellow-500 pl-4 py-2">
                            <p class="font-medium text-gray-900">Lê Minh C - Bàn C1</p>
                            <p class="text-sm text-gray-600">2 người - 18:00 hôm nay</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="/admin/bookings" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Xem tất cả →</a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Giờ cao điểm</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">11:00-12:00</span>
                                <span class="text-sm font-bold text-gray-700">92%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">18:00-19:00</span>
                                <span class="text-sm font-bold text-gray-700">88%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: 88%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">19:00-20:00</span>
                                <span class="text-sm font-bold text-gray-700">85%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Thao tác nhanh</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                        Thêm đặt bàn
                    </button>
                    <button class="px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium text-sm">
                        Thêm bàn
                    </button>
                    <button class="px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium text-sm">
                        Gửi thông báo
                    </button>
                    <button class="px-4 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium text-sm">
                        Xuất báo cáo
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script>
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                datasets: [{
                    label: 'Doanh thu (Triệu)',
                    data: [12.5, 14.2, 11.8, 15.6, 13.2, 16.4, 14.1], //lấy dữ liệu từ cơ sở dữ liệu
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
                    data: [850, 280, 115], //lấy dữ liệu từ cơ sở dữ liệu
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