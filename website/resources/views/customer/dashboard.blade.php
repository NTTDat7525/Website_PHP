<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Spoons - Đặt bàn nhà hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-bg {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 41, 59, 0.85) 100%),
                url('https://images.unsplash.com/photo-1552566626-52f8b828add9?w=1200') center/cover;
            background-attachment: fixed;
        }

        .table-card {
            transition: all 0.3s ease;
        }

        .table-card:hover {
            transform: translateY(-4px);
        }

        .status-badge {
            position: absolute;
            top-4;
            right-4;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-available {
            background-color: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .status-reserved {
            background-color: rgba(234, 179, 8, 0.2);
            color: #eab308;
        }

        .status-occupied {
            background-color: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100">

    <nav class="fixed top-0 left-0 right-0 bg-slate-900/95 backdrop-blur-md z-50 border-b border-slate-800">
        <div class="w-full px-4">
            <div class="flex justify-between items-center h-24">

                <div class="flex items-center gap-6 ml-4">
                    <a href="{{ route('customer.dashboard') }}"
                        class="text-4xl font-bold bg-gradient-to-r from-[#4647D3] to-[#8126CF] text-transparent bg-clip-text">
                        Golden Spoons
                    </a>

                    <div class="hidden md:block w-96 ml-10">
                        <div class="relative">
                            <input type="text" placeholder="Tìm kiếm bàn..."
                                class="w-full px-4 py-2 bg-slate-800 text-slate-100 rounded-lg border border-slate-700 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-6 mr-4">

                    <a href="#" class="text-slate-300 hover:text-white transition">
                        Khám phá
                    </a>

                    <a href="{{ route('customer.booking.index') }}"
                        class="text-slate-300 hover:text-white transition">
                        Đặt bàn
                    </a>

                    <a href="#" class="text-slate-300 hover:text-white transition">
                        Lịch sử
                    </a>

                    <div class="relative group">
                        <button class="p-2 hover:bg-slate-800 rounded-lg transition text-slate-400 hover:text-slate-200">
                            <i class="fas fa-user-circle text-3xl"></i>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-slate-800 rounded-lg shadow-lg hidden group-hover:block z-50 border border-slate-700">
                            <a href="{{ route('customer.profile') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-t-lg">
                                Tài khoản
                            </a>
                            <a href=""
                                class="block px-4 py-2 hover:bg-slate-700">
                                Tìm kiếm
                            </a>
                            <form method="POST" action="">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-slate-700 rounded-b-lg text-red-400">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <section class="pt-28 pb-12 hero-bg h-screen flex items-center relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="z-10">
                    <div class="inline-block mb-4 px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full text-sm font-semibold">
                        <i class="fas fa-circle text-emerald-400 mr-2"></i>TÌM BÀN TRỰC TIẾP
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Trải nghiệm <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-purple-400">Ẩm Thực Đỉnh Cao</span>
                    </h1>

                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                        Khám phá sự kết hợp giữa công nghệ hiện đại và nghệ thuật ẩm thực. Đặt bàn theo thời gian thực dành cho những khách hàng tinh tế.
                    </p>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-8 border border-slate-700 z-10">
                    <form action="{{ route('customer.tables.index') }}" method="GET" class="space-y-6">

                        <div>
                            <label class="text-sm font-semibold text-slate-300 mb-2 block">NGÀY</label>
                            <input type="date"
                                class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-300 mb-2 block">GIỜ</label>
                            <input type="time"
                                class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-300 mb-2 block">SỐ KHÁCH</label>
                                <select class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">
                                    <option value="1">1 người</option>
                                    <option value="2">2 người</option>
                                    <option value="3">3 người</option>
                                    <option value="4">4 người</option>
                                    <option value="5">5+ người</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-slate-300 mb-2 block">KHU VỰC</label>
                                <select class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">
                                    <option value="">Sảnh chính</option>
                                    <option value="">Sân thượng</option>
                                    <option value="">Khu VIP</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-700 hover:to-purple-700 text-white font-semibold py-3 rounded-lg transition transform hover:scale-105">
                            Kiểm tra tình trạng bàn
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <aside class="lg:col-span-1">
                <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 sticky top-24">
                    <h3 class="text-lg font-bold mb-6">BỘ LỌC</h3>

                    <form method="GET" action="{{ route('customer.tables.index') }}" class="space-y-6">
                        <div class="mb-8">
                            <h4 class="text-sm font-semibold text-slate-300 mb-4">Khu vực</h4>
                            <div class="space-y-3">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="location" value="main" class="w-4 h-4">
                                    <span class="ml-3 text-sm">Sảnh chính</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="location" value="terrace" class="w-4 h-4">
                                    <span class="ml-3 text-sm">Sân thượng</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="location" value="vip" class="w-4 h-4">
                                    <span class="ml-3 text-sm">Khu VIP</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-violet-600 hover:bg-violet-700 text-white py-2 rounded-lg transition">
                            Áp dụng bộ lọc
                        </button>
                    </form>
                </div>
            </aside>

            <main class="lg:col-span-3">
                <section>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold mb-2">Sơ đồ bàn trực tiếp</h2>
                        <p class="text-slate-400">Trạng thái bàn được cập nhật theo thời gian thực.</p>
                    </div>

                    <div class="flex gap-6 mb-8">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                            <span class="text-sm text-slate-300">CÒN TRỐNG</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <span class="text-sm text-slate-300">ĐÃ ĐẶT</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-sm text-slate-300">ĐANG SỬ DỤNG</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tables as $table)
                        <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
                            <div class="h-48 flex items-center justify-center">
                                <i class="fas fa-chair text-5xl text-slate-500"></i>
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $table->name }}</h3>
                                <p class="text-sm text-slate-400 mb-2">
                                    {{ $table->capacity }} người
                                </p>

                                <p class="text-sm mb-4">
                                    Khu vực: {{ $table->location ?? 'Sảnh chính' }}
                                </p>

                                @if($table->status === 'available')
                                <a href="{{ route('customer.booking.create', ['id' => $table->id]) }}"
                                    class="block text-center bg-green-600 hover:bg-green-700 py-2 rounded transition font-medium">
                                    Đặt ngay
                                </a>
                                @elseif($table->status === 'reserved')
                                <button disabled class="w-full bg-yellow-600 py-2 rounded cursor-not-allowed text-slate-300">
                                    Đã đặt
                                </button>
                                @else
                                <button disabled class="w-full bg-red-600 py-2 rounded cursor-not-allowed text-slate-300">
                                    Đang sử dụng
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Thêm nút chuyển trang nếu có nhiều hơn 9 bàn (thêm sau) -->
                </section>
            </main>
        </div>
    </div>


    <footer class="bg-slate-900 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-bold text-white mb-4">Golden Spoons</h4>
                    <p class="text-sm text-slate-400">© 2026 Golden Spoons. Technological Luxury.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-300 mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="" class="hover:text-violet-400 transition">Make Reservation</a></li>
                        <li><a href="" class="hover:text-violet-400 transition">Search Tables</a></li>
                        <li><a href="" class="hover:text-violet-400 transition">My Bookings</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-300 mb-4">Information</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-violet-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-violet-400 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-violet-400 transition">Contact Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-300 mb-4">Get In Touch</h4>
                    <p class="text-sm text-slate-400 mb-2"><i class="fas fa-phone mr-2"></i>(555) 123-4567</p>
                    <p class="text-sm text-slate-400"><i class="fas fa-envelope mr-2"></i>reservations@goldspoons.com</p>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 text-center text-sm text-slate-500">
                <p>&copy; 2026 Golden Spoons Restaurant. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>