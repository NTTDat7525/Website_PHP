<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-gray-900 text-white p-6">
            <div class="mb-8">
                <h2 class="text-xl font-bold">Quản Lý</h2>
            </div>

            <nav class="space-y-3">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Bảng điều khiển
                </a>
                <a href="{{ route('admin.bookings') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Quản lý đặt bàn
                </a>
                <a href="{{ route('admin.tables') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    Quản lý bàn
                </a>
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition font-medium">
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
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Quản Lý Người Dùng</h1>

            <div class="bg-white rounded-lg shadow-md p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2 font-bold">Tên Đăng Nhập</th>
                            <th class="pb-2 font-bold">Email</th>
                            <th class="pb-2 font-bold">Vai Trò</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">user1</td>
                            <td class="py-3">user1@example.com</td>
                            <td class="py-3"><span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm font-semibold">Khách hàng</span></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">user2</td>
                            <td class="py-3">user2@example.com</td>
                            <td class="py-3"><span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm font-semibold">Khách hàng</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>

</html>