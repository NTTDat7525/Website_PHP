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
            top: 0.5rem;
            right: 1rem;
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
        #userDropdown::before {
        content: "";
        position: absolute;
        top: -20px;
        left: 0;
        right: 0;
        height: 20px;
        background: transparent;
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
                    @if(session('error'))
                    <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{ route('customer.search') }}" method="GET" class="space-y-6">

                        <div>
                                <label class="text-sm font-semibold text-slate-300 mb-2 block">NGÀY</label>
                                <select name="date" id="date"
                                    class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">

                                    <option value="">-- Chọn ngày --</option>
                                </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-300 mb-2 block">GIỜ</label>

                            <select name="time" id="time"
                                class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">

                                <option value="">-- Chọn giờ --</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-300 mb-2 block">SỐ KHÁCH</label>
                                <select name="guest_count" class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">
                                    <option value="1">1 người</option>
                                    <option value="2">2 người</option>
                                    <option value="3">3 người</option>
                                    <option value="4">4 người</option>
                                    <option value="5">5+ người</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-slate-300 mb-2 block">KHU VỰC</label>
                                <select name="location" class="w-full px-4 py-3 bg-slate-900 text-slate-100 rounded-lg border border-slate-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500">
                                    <option value="Sảnh chính">Sảnh chính</option>
                                    <option value="Sân thượng">Sân thượng</option>
                                    <option value="Khu VIP">Khu VIP</option>
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

    <main class="pt-20 bg-white h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="flex justify-center mr-10 gap-8 items-start -ml-32">
                    <div class="w-56 h-96 bg-violet-500 rounded-2xl shadow-2xl mt-32"></div>
                    <div class="w-72 h-[560px] bg-red-500 rounded-2xl shadow-2xl mt-0"></div>
                    <div class="w-56 h-80 bg-blue-500 rounded-2xl shadow-2xl mt-40"></div>
                </div>

                <div>
                    <div class="mb-6">
                        <span class="text-sm font-bold text-violet-600 tracking-widest">CÂU CHUYỆN CỦA CHÚNG TÔI</span>
                    </div>

                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Tinh Hoa Hội Tụ Trong <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-purple-600">Từng Khoảnh Khắc</span>
                    </h2>

                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Tại Golden Spoons, việc đặt bàn không chỉ đơn thuần là lựa chọn chỗ ngồi, mà là bước khởi đầu cho một trải nghiệm tinh tế. Chúng tôi mang đến hệ thống đặt bàn thông minh, giúp bạn dễ dàng chọn lựa không gian phù hợp với từng khoảnh khắc – từ riêng tư đến sang trọng.
                    </p>

                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <p class="text-4xl font-bold text-gray-900">100%</p>
                            <p class="text-sm text-gray-600 font-semibold mt-2">TRẠNG THÁI BÀN CẬP NHẬT LIÊN TỤC</p>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-gray-900">24/7</p>
                            <p class="text-sm text-gray-600 font-semibold mt-2">ĐẶT BÀN NHANH CHÓNG MỌI LÚC</p>
                        </div>
                    </div>

                    <a href="{{ route('customer.booking.index') }}" class="inline-flex items-center gap-2 text-violet-600 hover:text-violet-700 font-semibold transition">
                        Đi đến trang đặt bàn
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
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

            document.addEventListener("DOMContentLoaded", function () {
                const timeSelect = document.getElementById("time");

                const bookedTimes = @json($bookedTimes ?? []);

                let start = 19 * 60;
                let end = 21 * 60;

                for (let minutes = start; minutes <= end; minutes += 30) {
                    let h = String(Math.floor(minutes / 60)).padStart(2, '0');
                    let m = String(minutes % 60).padStart(2, '0');

                    let time = `${h}:${m}`;

                    let option = document.createElement("option");
                    option.value = time;
                    option.textContent = time;

                    if (bookedTimes.includes(time)) {
                        option.disabled = true;
                        option.textContent += " (Đã đặt)";
                        option.style.color = "gray";
                    }

                    timeSelect.appendChild(option);
                }
            });

            document.addEventListener("DOMContentLoaded", function () {

                const dateSelect = document.getElementById("date");

                const today = new Date();

                for (let i = 0; i < 5; i++) {
                    let d = new Date();
                    d.setDate(today.getDate() + i);

                    let year = d.getFullYear();
                    let month = String(d.getMonth() + 1).padStart(2, '0');
                    let day = String(d.getDate()).padStart(2, '0');

                    let value = `${year}-${month}-${day}`;

                    let label = d.toLocaleDateString('vi-VN', {
                        weekday: 'short',
                        day: '2-digit',
                        month: '2-digit'
                    });

                    let option = document.createElement("option");
                    option.value = value;
                    option.textContent = label;

                    dateSelect.appendChild(option);
                }

            });
        </script>

</body>

</html>