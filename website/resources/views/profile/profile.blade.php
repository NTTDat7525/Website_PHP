<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Tài Khoản - Golden Spoons</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('customer.dashboard') }}" class="text-2xl font-bold text-amber-700">Golden Spoons</a>
                <div class="flex items-center gap-6">
                    <a href="{{ route('customer.booking') }}" class="text-gray-700 hover:text-amber-700 transition font-medium">Đặt bàn</a>
                    <a href="{{ route('customer.menu') }}" class="text-gray-700 hover:text-amber-700 transition font-medium">Thực đơn</a>
                    <a href="{{ route('customer.bookings') }}" class="text-gray-700 hover:text-amber-700 transition font-medium">Đặt bàn của tôi</a>
                    <a href="{{ route('customer.profile') }}" class="text-gray-700 hover:text-amber-700 transition font-medium">Tài khoản</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-20 max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold mb-8 italic">Quản lý tài khoản</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <div class="relative w-32 h-32 mx-auto mb-4">
                        <img src="https://ui-avatars.com/api/?name=User&background=random" alt="Avatar" class="rounded-full w-full h-full object-cover border-4 border-indigo-50">
                        <button class="absolute bottom-1 right-1 bg-white p-2 rounded-full shadow-md hover:bg-gray-50 transition">
                            <i class="fas fa-camera text-indigo-600"></i>
                        </button>
                    </div>
                    <h2 class="font-semibold text-lg">Người dùng</h2>
                    <p class="text-sm text-gray-500 mb-4">Thành viên từ tháng 4, 2026</p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-8">

                <section class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-user-circle text-indigo-500 mr-3 text-xl"></i>
                        <h3 class="text-lg font-semibold">Thông tin cá nhân</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Họ và tên</label>
                            <input type="text" placeholder="Nhập họ tên" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Email</label>
                            <input type="email" value="user@example.com" disabled class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Số điện thoại</label>
                            <input type="text" placeholder="0123 456 789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Địa chỉ</label>
                            <input type="text" placeholder="Thành phố, Quốc gia" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition duration-200">
                            Lưu thay đổi
                        </button>
                    </div>
                </section>

                <section class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-shield-alt text-red-500 mr-3 text-xl"></i>
                        <h3 class="text-lg font-semibold">Đổi mật khẩu</h3>
                    </div>

                    <div class="space-y-4 max-w-md">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Mật khẩu hiện tại</label>
                            <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Mật khẩu mới</label>
                            <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</label>
                            <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button class="bg-gray-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-black transition duration-200">
                            Cập nhật mật khẩu
                        </button>
                    </div>
                </section>

            </div>
        </div>
    </div>

</body>

</html>