<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen">
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
                <a href="{{ route('admin.revenue') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Doanh thu
                </a>
                <a href="{{ route('admin.reports') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Báo cáo
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Báo Cáo</h1>

            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Báo Cáo Tồn Kho</h3>
                    <p class="text-gray-600 mb-4">
                        Số bàn trống: {{ $emptyTables }},
                        Số bàn đã đặt: {{ $bookedTables }},
                        Số bàn đang sử dụng: {{ $usingTables }}
                    </p>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Xuất Báo Cáo</button>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Báo Cáo Hoạt Động</h3>
                    <p class="text-gray-600 mb-4">
                        Tổng đặt bàn: {{ $totalBookings }},
                        Tổng doanh thu: {{ number_format($totalRevenue) }} VND</p>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Xuất Báo Cáo</button>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Báo Cáo Khách Hàng</h3>
                    <p class="text-gray-600 mb-4">Tổng khách hàng: {{ $totalUsers }},
                        Khách hàng mới: {{ $newUsersToday }}</p>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Xuất Báo Cáo</button>
                </div>
            </div>
        </main>
    </div>

</body>

</html>