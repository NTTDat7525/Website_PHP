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
                                    class="block px-4 py-2 hover:bg-slate-700 transition text-slate-400 hover:text-slate-200">
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
            <button class="filter-btn px-4 py-2 bg-indigo-100 text-indigo-600 rounded-lg font-medium hover:bg-indigo-200 transition" data-type="all" onclick="filterBookings('all', this)">
                Tất cả
            </button>
            <button class="filter-btn px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition" data-type="upcoming" onclick="filterBookings('upcoming', this)">
                Sắp tới
            </button>
            <button class="filter-btn px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition" data-type="completed" onclick="filterBookings('completed', this)">
                Đã hoàn thành
            </button>
            <button class="filter-btn px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition" data-type="cancelled" onclick="filterBookings('cancelled', this)">
                Đã hủy
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2">
                @foreach($bookings as $booking)
                <div class="booking-item bg-white rounded-2xl shadow-lg overflow-hidden mb-4 transition duration-300 transform hover:scale-[1.01]"
                    data-status="{{ $booking->status }}"
                    data-time="{{ $booking->time }}">

                    <div class="flex flex-col md:flex-row gap-6 p-6">

                        <div class="md:w-48 flex-shrink-0">
                            @php
                                $image = $booking->table->image;
                            @endphp

                            <img src="{{ ($image && file_exists(public_path('storage/'.$image))) 
                                    ? asset('storage/'.$image) 
                                    : asset('images/default.png') }}"
                                class="w-full h-48 object-cover rounded-xl">
                        </div>

                        <div class="flex-1">

                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <span class="inline-block text-xs font-bold px-3 py-1 rounded-full mb-2
                                        {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ strtoupper($booking->status) }}
                                    </span>

                                    <h2 class="text-2xl font-bold text-gray-900">
                                        {{ $booking->table->name ?? 'Không có tên bàn' }}
                                    </h2>
                                </div>
                            </div>

                            <div class="space-y-2 mb-2">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-calendar text-indigo-600"></i>
                                    <span>{{ \Carbon\Carbon::parse($booking->time)->format('H:i, d/m/Y') }}</span>
                                </div>

                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-users text-indigo-600"></i>
                                    <span>{{ $booking->guest_count }} người</span>
                                </div>
                            </div>

                            <div class="flex gap-3 mt-4">

                            <a href="{{ route('customer.booking.show', $booking->id) }}"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition inline-block text-center">
                                Xem chi tiết
                            </a>

                            @if($booking->status == 'pending' && \Carbon\Carbon::parse($booking->time)->gt(now()))
                            <form method="POST"
                                action="{{ route('customer.booking.cancel', $booking->id) }}"
                                onsubmit="return confirm('Bạn chắc chắn muốn hủy booking này?')">

                                @csrf
                                <button type="submit"
                                    class="px-6 py-3 text-red-600 border border-red-300 rounded-lg hover:bg-red-50 transition font-semibold">
                                    Hủy đặt bàn
                                </button>
                            </form>
                            @endif

                        </div>

                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            <div class="space-y-6">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200 text-center">
                    <p class="text-sm text-gray-600 font-semibold mb-4">TỔNG QUAN</p>
                    <div class="flex justify-center gap-4 mb-6">
                        <div>
                            <p class="text-3xl font-bold text-indigo-600">{{ $bookings->count() }}</p>
                            <p class="text-xs text-gray-600 mt-1">Lượt đặt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Lịch sử gần đây</h2>

            <div class="space-y-4">
                @foreach($bookings as $booking)
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition flex items-center justify-between">

                    <div class="flex items-center gap-4">

                        @php
                            $image = $booking->table->image;
                        @endphp

                        <img src="{{ ($image && file_exists(public_path('storage/'.$image))) 
                                ? asset('storage/'.$image)
                                : asset('images/default.png') }}"
                            class="w-full h-48 object-cover rounded-xl">

                        <div>
                            <h3 class="font-bold text-gray-900">
                                {{ $booking->table->name ?? 'Bàn' }}
                            </h3>

                            <p class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($booking->time)->format('d/m/Y H:i') }}
                                • {{ $booking->guest_count }} người
                            </p>

                            @if($booking->status == 'confirmed' && \Carbon\Carbon::parse($booking->time)->lt(now()))
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-2 py-1 mt-2 rounded">
                                    ĐÃ HOÀN THÀNH
                                </span>
                            @elseif($booking->status == 'cancelled')
                                <span class="inline-block bg-red-100 text-red-700 text-xs font-bold px-2 py-1 mt-2 rounded">
                                    ĐÃ HỦY
                                </span>
                            @elseif($booking->status == 'pending' || ($booking->status == 'confirmed' && \Carbon\Carbon::parse($booking->time)->gt(now())))
                                <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 mt-2 rounded">
                                    SẮP TỚI
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3">

                        <span class="text-xs font-bold">
                            {{ strtoupper($booking->status) }}
                        </span>

                    </div>

                </div>
                @endforeach

            </div>
        </div>
    </main>

    <footer class="bg-slate-900 border-t border-slate-800">
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
            function filterBookings(type, element) {
                const items = document.querySelectorAll('.booking-item');
                const buttons = document.querySelectorAll('.filter-btn');
                const now = new Date();

                buttons.forEach(btn => {
                    btn.classList.remove(
                        'bg-indigo-100',
                        'text-indigo-600',
                        'ring-2',
                        'ring-indigo-400',
                        'scale-105'
                    );

                    btn.classList.add('text-gray-600');
                });

                element.classList.add(
                    'bg-indigo-100',
                    'text-indigo-600',
                    'ring-2',
                    'ring-indigo-400',
                    'scale-105'
                );

                element.classList.remove('text-gray-600');

                let firstVisible = null;

                items.forEach(item => {
                    const status = item.dataset.status;
                    const time = new Date(item.dataset.time);

                    let show = false;

                    if (type === 'all') {
                        show = true;
                    } else if (type === 'upcoming') {
                        show = (status === 'pending') || (status === 'confirmed' && time > now);
                    } else if (type === 'completed') {
                        show = (status === 'confirmed' && time < now);
                    } else if (type === 'cancelled') {
                        show = (status === 'cancelled');
                    }

                    if (show) {
                        item.style.display = 'block';
                        if (!firstVisible) firstVisible = item;
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
    </script>
</body>

</html>