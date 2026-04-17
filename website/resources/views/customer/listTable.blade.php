<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Chọn bàn - Luminous Epicure</title>
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

                    <a href="#"
                        class="text-slate-300 hover:text-white transition">
                        Đặt bàn
                    </a>

                    <a href="{{ route('customer.history') }}" class="text-slate-300 hover:text-white transition">
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
                            <form method="POST">
                                @csrf
                                <button type="submit" action="{{ route('auth.logout') }}"
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 mt-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <aside class="lg:col-span-1">
                <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 sticky top-24">
                    <h3 class="text-lg font-bold mb-6">BỘ LỌC</h3>

                    <form method="GET" action="" class="space-y-6">
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

                        <div class="mb-8">
                            <h4 class="text-sm font-semibold text-slate-300 mb-4">Số khách</h4>
                            <div class="space-y-3">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="guests" value="1" class="w-4 h-4">
                                    <span class="ml-3 text-sm">1 người</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="guests" value="2" class="w-4 h-4">
                                    <span class="ml-3 text-sm">2 người</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="guests" value="3" class="w-4 h-4">
                                    <span class="ml-3 text-sm">3 người</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="guests" value="4" class="w-4 h-4">
                                    <span class="ml-3 text-sm">4 người</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="guests" value="5" class="w-4 h-4">
                                    <span class="ml-3 text-sm">5+ người</span>
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
                                    {{ $table->location ?? 'Sảnh chính' }}
                                </p>

                                @if($table->status === 'available')
                                <a href="{{ route('customer.booking.create', ['id' => $table->id]) }}"
                                    class="block text-center bg-green-600 hover:bg-violet-600 py-2 rounded transition font-medium">
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

    <script>
        function selectTable(tableId, tableName) {
            console.log('Selected table:', tableName);
        }
    </script>
</body>

</html>