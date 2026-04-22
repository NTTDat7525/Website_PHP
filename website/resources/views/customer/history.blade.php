<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đặt Bàn - Luminous Epicure</title>
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
                                class="block px-4 py-2 text-white hover:bg-slate-700 transition">
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

    <main class="pt-20 max-w-7xl mx-auto px-4 py-10 mt-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Lịch sử đặt bàn</h1>
            <p class="text-gray-600">Quản lý các hình trình ẩm thực của bạn. Xem chi tiết, thay đổi hoặc đặt lại những trải nghiệm yêu thích.</p>
        </div>

        <div class="flex gap-3 mb-8 pb-4 border-b border-gray-200">
            <button class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-lg font-medium hover:bg-indigo-200 transition" onclick="filterBookings('all')">
                Tất cả
            </button>
            <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition" onclick="filterBookings('upcoming')">
                Sắp tới
            </button>
            <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition" onclick="filterBookings('completed')">
                Đã hoàn thành
            </button>
            <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition" onclick="filterBookings('cancelled')">
                Đã hủy
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row gap-6 p-6">
                        <div class="md:w-48 flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=300&h=300&fit=crop"
                                alt="Restaurant" class="w-full h-48 object-cover rounded-xl">
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <span class="inline-block bg-indigo-100 text-indigo-600 text-xs font-bold px-3 py-1 rounded-full mb-2">
                                        SẮP TỚI
                                    </span>
                                    <h2 class="text-2xl font-bold text-gray-900">L'Arpège - Tinh hoa Pháp</h2>
                                </div>
                            </div>

                            <div class="space-y-2 mb-2">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-calendar text-indigo-600"></i>
                                    <span>20:00, Thứ bảy, 24 Tháng 12</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-users text-indigo-600"></i>
                                    <span>4 người</span>
                                </div>
                            </div>
                            <a href="#" class="w-full md:w-auto px-8 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition inline-block text-center">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200 text-center">
                    <p class="text-sm text-gray-600 font-semibold mb-4">TỔNG QUAN</p>
                    <div class="flex justify-center gap-4 mb-6">
                        <div>
                            <p class="text-3xl font-bold text-indigo-600">12</p>
                            <p class="text-xs text-gray-600 mt-1">Lượt đặt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Lịch sử gần đây</h2>

            <div class="space-y-4">
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=80&h=80&fit=crop"
                            alt="Restaurant" class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <h3 class="font-bold text-gray-900">
                            </h3>
                            <p class="text-sm text-gray-600">
                                
                            </p>
                            <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-2 py-1 mt-2 rounded">
                                ĐÃ HOÀN THÀNH
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-green-600 text-xs font-bold">ĐÃ HOÀN THÀNH</span>
                        <button class="px-4 py-2 text-indigo-600 border border-indigo-300 rounded-lg hover:bg-indigo-50 transition text-sm font-medium">
                            Đặt lại
                        </button>
                        <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition text-sm">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="https://images.unsplash.com/photo-1563109556-06b3fe565c0b?w=80&h=80&fit=crop"
                            alt="Restaurant" class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <h3 class="font-bold text-gray-900">Maison Marou Saigon</h3>
                            <p class="text-sm text-gray-600">02 Tháng 11, 2024 • 14:00 • 3 Người</p>
                            <span class="inline-block bg-red-100 text-red-700 text-xs font-bold px-2 py-1 mt-2 rounded">
                                ĐÃ HỦY
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-red-600 text-xs font-bold">ĐÃ HỦY</span>
                        <button class="px-4 py-2 text-indigo-600 border border-indigo-300 rounded-lg hover:bg-indigo-50 transition text-sm font-medium">
                            Đặt lại
                        </button>
                        <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition text-sm">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=80&h=80&fit=crop"
                            alt="Restaurant" class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <h3 class="font-bold text-gray-900">Sushi Rei</h3>
                            <p class="text-sm text-gray-600">28 Tháng 10, 2024 • 21:00 • 2 Người</p>
                            <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-2 py-1 mt-2 rounded">
                                ĐÃ HOÀN THÀNH
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-green-600 text-xs font-bold">ĐÃ HOÀN THÀNH</span>
                        <button class="px-4 py-2 text-indigo-600 border border-indigo-300 rounded-lg hover:bg-indigo-50 transition text-sm font-medium">
                            Đặt lại
                        </button>
                        <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition text-sm">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-slate-300 mt-20 py-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="font-bold text-white mb-3">VỀ CHÚNG TÔI</h3>
                    <p class="text-sm text-slate-400">Nền tảng đặt bàn nhà hàng hàng đầu tại Việt Nam</p>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-3">ĐIỀU KHOẢN</h3>
                    <p class="text-sm text-slate-400">Chính sách & Điều kiện</p>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-3">LIÊN HỆ</h3>
                    <p class="text-sm text-slate-400">Hỗ trợ khách hàng</p>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-3">CẢU HỎI THƯỜNG GẶP</h3>
                    <p class="text-sm text-slate-400">Giải đáp thắc mắc</p>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-6 text-center text-sm text-slate-400">
                <p>&copy; 2024 Luminous Epicure. Tính hóa ẩm thực Việt.</p>
            </div>
        </div>
    </footer>

    <script>
        function filterBookings(type) {
            console.log('Filter bookings by:', type);
        }
    </script>
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