<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đặt Bàn - Luminous Epicure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-100 text-slate-800">

        <nav class="fixed top-0 left-0 right-0 bg-slate-900/95 backdrop-blur-md z-50 border-b border-slate-800">
        <div class="w-full px-4">
            <div class="flex justify-between items-center h-24">

                <div class="flex items-center gap-6 ml-4">
                    <a href="{{ route('customer.dashboard') }}"
                        class="text-4xl font-bold bg-gradient-to-r from-[#4647D3] to-[#8126CF] text-transparent bg-clip-text">
                        Golden Spoons
                    </a>
                </div>

                <div class="flex items-center gap-6 mr-4">

                    <a href="#" class="text-slate-300 hover:text-white transition">
                        Khám phá
                    </a>

                    <a href="{{ route('customer.booking.index') }}"
                        class="text-slate-300 hover:text-white transition">
                        Đặt bàn
                    </a>

                    <a href="{{ route('customer.history') }}" class="text-slate-300 hover:text-white transition">
                        Lịch sử
                    </a>

                    <div class="relative group" id="userMenuContainer">
                        <button id="userMenuButton" type="button"
                            class="p-2 hover:bg-slate-800 rounded-lg transition text-slate-400 hover:text-slate-200">
                            <i class="fas fa-user-circle text-3xl"></i>
                        </button>

                        <div id="userDropdown"
                            class="hidden group-hover:block absolute right-0 top-full mt-0 pt-2 w-48 bg-slate-800 rounded-lg shadow-lg border border-slate-700 z-[9999]">
                            
                            <div class="py-1 bg-slate-800 rounded-lg">
                                <a href="{{ route('customer.profile') }}"
                                    class="block px-4 py-2 hover:bg-slate-700 transition">
                                    Tài khoản
                                </a>

                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 hover:bg-slate-700 text-red-400 transition">
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-28 max-w-7xl mx-auto px-4 py-10">
        <!-- Breadcrumb & Title -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold text-gray-500 tracking-wider">
                        <i class="fas fa-bookmark text-blue-600 mr-2"></i>GRIF-2024-X91
                    </span>
                    <span class="text-xs font-bold tracking-wider
                        {{ $booking->status == 'pending' ? 'text-yellow-600' : '' }}
                        {{ $booking->status == 'confirmed' ? 'text-green-600' : '' }}
                        {{ $booking->status == 'cancelled' ? 'text-red-600' : '' }}">
                        
                        <i class="fas fa-check-circle mr-2"></i>

                        @if($booking->status == 'pending')
                            SẮP TỚI
                        @elseif($booking->status == 'confirmed')
                            HOÀN THÀNH
                        @else
                            ĐÃ HỦY
                        @endif
                    </span>
                </div>
                <div class="flex gap-3">
                    <button class="flex items-center gap-2 px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-edit text-gray-600"></i>
                        <span>Chỉnh sửa đặt bàn</span>
                    </button>
                    <button class="flex items-center gap-2 px-4 py-2 bg-white text-red-600 border border-red-300 rounded-lg hover:bg-red-50 transition">
                        <i class="fas fa-times-circle text-red-600"></i>
                        <span>Hủy đặt bàn</span>
                    </button>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-gray-900">Chi tiết đặt bàn</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Restaurant Info Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex gap-4 mb-6">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100&h=100&fit=crop"
                            alt="Restaurant" class="w-20 h-20 rounded-full object-cover">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $booking->table->name ?? 'The Luminous Epicure – Downtown' }}</h2>
                            <p class="text-sm text-gray-600 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt text-red-600"></i>
                                {{ $booking->table->location ?? '123 Lê Lợi, Phường Bến Thành, Quận 1, TP. Hồ Chí Minh' }}
                            <p class="text-xs text-gray-500 font-semibold mb-1">NGÀY</p>
                            <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->time)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold mb-1">GIỜ</p>
                            <p class="text-lg font-bold text-gray-900">
                                {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}-{{ \Carbon\Carbon::parse($booking->time)->addHour()->format('H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Guest & Table Info -->
                <div class="grid grid-cols-2 gap-6">
                    <!-- Guest Count -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="text-center">
                            <p class="text-xs text-gray-500 font-semibold mb-2 tracking-widest">KHÁCH HÀNG</p>
                            <p class="text-4xl font-bold text-blue-600 mb-2">{{ $booking->guest_count ?? '4' }}</p>
                            <p class="text-sm text-gray-600">Người</p>
                        </div>
                    </div>

                    <!-- Table Info -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <p class="text-xs text-gray-500 font-semibold mb-3 tracking-widest">VỊ TRÍ BÀN</p>
                        <div class="flex items-center gap-2 mb-3">
                            <i class="fas fa-armchair text-blue-600 text-lg"></i>
                            <p class="text-2xl font-bold text-gray-900">{{ $booking->table->name ?? 'Bàn T04' }}</p>
                        </div>
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">{{ $booking->table->location ?? 'Window View' }}</span> - {{ $booking->table->capacity ?? '4' }} chỗ ngồi
                        </p>
                    </div>
                </div>

                <!-- Special Requests -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-comments text-blue-600"></i>
                        GHI CHÚ & YÊU CẦU ĐẶC BIỆT
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-4 italic text-gray-700">
                        <p>{{ $booking->special_requests ?? '"Vui lòng chuẩn bị một bàn yên tĩnh gần của sổ. Chúng tôi sẽ tổ chức kỷ niệm ngày cưới nên nếu có thể trang trí nhẹ với cánh hoa hồng sẽ tuyệt vời. Cảm ơn!"' }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Floor Plan -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">SƠ ĐỒ VỊ TRÍ</h3>

                    <div class="bg-gray-100 rounded-lg p-4 mb-4 grid grid-cols-4 gap-2 text-center">
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T01</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T02</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T03</span>
                        </div>
                        <div class="bg-blue-500 rounded p-2 ring-2 ring-blue-300">
                            <span class="text-xs font-bold text-white">T04</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T05</span>
                        </div>
                        <div class="col-span-2 bg-gray-300 rounded p-2 flex items-center justify-center">
                            <span class="text-xs font-bold text-gray-700">Khu vực Bar</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T06</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T07</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T08</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T09</span>
                        </div>
                        <div class="bg-gray-300 rounded p-2">
                            <span class="text-xs font-bold text-gray-700">T10</span>
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 text-center">Bàn của bạn được tô sáng xanh dương cùng</p>
                </div>

                <!-- Payment Summary -->
                <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-lg font-bold mb-6 tracking-wider">THÔNG TIN THANH TOÁN</h3>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center border-b border-white/20 pb-3">
                            <span class="text-sm">Tổng tiền dự kiến</span>
                            <span class="font-bold text-xl">{{ number_format($booking->total_price ?? 2450000, 0, ',', '.') }}đ</span>
                        </div>

                        <div class="flex justify-between items-center border-b border-white/20 pb-3">
                            <span class="text-sm">Đã thanh toán cọc</span>
                            <span class="inline-block bg-white/20 text-xs font-bold px-3 py-1 rounded-full">{{ number_format($booking->total_price * 0.2 ?? 500000, 0, ',', '.') }}đ</span>
                        </div>

                        <div class="flex justify-between items-center border-b border-white/20 pb-3">
                            <span class="text-sm">Trạng thái</span>
                            <span class="flex items-center gap-1">
                                <i class="fas fa-{{ $booking->payment_status === 'paid' ? 'check-circle text-green-300' : 'clock text-yellow-300' }}"></i>
                                <span class="text-xs font-bold">{{ $booking->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</span>
                            </span>
                        </div>

                        <div class="flex justify-between items-center pt-3">
                            <span class="text-sm">Phương thức</span>
                            <span class="flex items-center gap-1 text-sm">
                                <i class="fas fa-credit-card"></i>
                                <span>{{ $booking->payment_method === 'vnpay' ? 'VNPay' : 'Tiền mặt' }}</span>
                            </span>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <button class="w-full bg-white text-blue-600 font-bold py-3 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-download mr-2"></i>
                        Tải vé booking
                    </button>
                </div>

                <!-- Contact Support -->
                <div class="bg-gray-50 rounded-xl p-6 text-center">
                    <p class="text-sm text-gray-600 mb-4">Cần hỗ trợ?</p>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center justify-center gap-2">
                        <i class="fas fa-headset"></i>
                        Liên hệ bộ phận hỗ trợ
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-bold mb-4">Grafit Lumina</h4>
                    <p class="text-sm text-gray-400">© 2026 Grafit Lumina. The Luminous Epicure.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-300 mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition">Make Reservation</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Search Tables</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">My Bookings</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-300 mb-4">Information</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Contact Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-300 mb-4">Get In Touch</h4>
                    <p class="text-sm text-gray-400 mb-2"><i class="fas fa-phone mr-2"></i>(555) 123-4567</p>
                    <p class="text-sm text-gray-400"><i class="fas fa-envelope mr-2"></i>reservations@grafit.com</p>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
                <p>&copy; 2026 Grafit Lumina. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
            document.addEventListener("DOMContentLoaded", function () {
                const container = document.getElementById("userMenuContainer");
                const dropdown = document.getElementById("userDropdown");
                let timeout;

                container.addEventListener("mouseenter", function () {
                    clearTimeout(timeout);
                    dropdown.classList.remove("hidden");
                });

                container.addEventListener("mouseleave", function () {
                    timeout = setTimeout(() => {
                        dropdown.classList.add("hidden");
                    }, 200);
                });
                
                const button = document.getElementById("userMenuButton");
                button.addEventListener("click", function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle("hidden");
                });
            });
        </script>
</body>

</html>