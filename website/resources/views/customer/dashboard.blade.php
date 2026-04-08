<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển khách hàng</title>
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
                    <span class="text-gray-600 border-l border-gray-300 pl-4">Xin chào</span>
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

    <div class="pt-16 w-full h-80 bg-gradient-to-r from-amber-600 via-amber-500 to-amber-600 flex items-center justify-center">
        <div class="text-center text-white">
            <h2 class="text-5xl font-bold mb-4">Nhà Hàng Golden Spoons</h2>
            <p class="text-xl text-amber-100">Nơi phục vụ ẩm thực chất lượng cao</p>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Danh Sách Các Bàn</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($tables as $table)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 hover:shadow-lg transition {{ $table->status === 'available' ? 'border-green-500' : ($table->status === 'reserved' ? 'border-yellow-500' : 'border-red-500') }}">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $table->name }}</h3>
                    <p class="text-gray-600 mb-4 text-sm">Sức chứa: <span class="font-semibold">{{ $table->capacity }} người</span></p>
                    <div class="flex justify-between items-center">
                        @if($table->status === 'available')
                        <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded font-semibold text-sm">Trống</span>
                        <a href="{{ route('customer.booking') }}" class="text-green-600 hover:text-green-700 font-medium text-sm">Đặt ngay →</a>
                        @elseif($table->status === 'reserved')
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded font-semibold text-sm">Đã đặt</span>
                        @else
                        <span class="inline-block bg-red-100 text-red-800 px-4 py-2 rounded font-semibold text-sm">Đang sử dụng</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Navigation Section -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('customer.booking') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Đặt Bàn Mới</h3>
                <p class="text-gray-600 text-sm">Chọn ngày, giờ và đặt bàn yêu thích của bạn</p>
                <div class="mt-4 text-blue-600 font-medium">Bắt đầu →</div>
            </a>

            <a href="{{ route('customer.bookings') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Lịch Sử Đặt Bàn</h3>
                <p class="text-gray-600 text-sm">Xem và quản lý các đặt bàn của bạn</p>
                <div class="mt-4 text-blue-600 font-medium">Xem chi tiết →</div>
            </a>

            <a href="{{ route('customer.menu') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Thực Đơn</h3>
                <p class="text-gray-600 text-sm">Khám phá các món ăn đặc biệt của nhà hàng</p>
                <div class="mt-4 text-blue-600 font-medium">Xem menu →</div>
            </a>
        </div>

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
                        <p class="text-sm">abc Hoàng Quốc Việt, Hà Nội</p>
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