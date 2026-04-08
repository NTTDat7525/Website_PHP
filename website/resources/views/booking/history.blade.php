<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đặt Bàn - Golden Spoons</title>
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

    <main class="pt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Lịch Sử Đặt Bàn</h1>

        <div class="space-y-4">
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Bàn A1 - 4 người</h3>
                        <p class="text-gray-600 mt-2">08/04/2026 - 19:00</p>
                        <p class="text-sm text-gray-500 mt-1">Mã đặt: #12345</p>
                    </div>
                    <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded font-semibold text-sm">Đã xác nhận</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition border-l-4 border-yellow-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Bàn B2 - 6 người</h3>
                        <p class="text-gray-600 mt-2">10/04/2026 - 12:00</p>
                        <p class="text-sm text-gray-500 mt-1">Mã đặt: #12346</p>
                    </div>
                    <span class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded font-semibold text-sm">Chờ xác nhận</span>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-amber-900 text-amber-50 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <h4 class="font-bold mb-2">Liên hệ</h4>
                    <p class="text-sm">0123 456 789</p>
                    <p class="text-sm">info@restaurant.com</p>
                </div>
                <div>
                    <h4 class="font-bold mb-2">Giờ mở cửa</h4>
                    <p class="text-sm">11:00 - 23:00 hàng ngày</p>
                    <p class="text-sm">Hỗ trợ 24/7 qua chat</p>
                </div>
                <div>
                    <h4 class="font-bold mb-2">Địa chỉ</h4>
                    <p class="text-sm">123 Đường Lê Lợi, Quận 1</p>
                    <p class="text-sm">TP. Hồ Chí Minh</p>
                </div>
            </div>
            <div class="border-t border-amber-800 mt-6 pt-6 text-center text-sm">
                <p>&copy; 2026 Golden Spoons Restaurant. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

</body>

</html>