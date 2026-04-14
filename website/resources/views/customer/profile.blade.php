<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Tài Khoản - Golden Spoons</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                        Yêu thích
                    </a>

                    <div class="relative group">
                        <button class="p-2 hover:bg-slate-800 rounded-lg transition text-slate-400 hover:text-slate-200">
                            <i class="fas fa-user-circle text-3xl"></i>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-slate-800 rounded-lg shadow-lg hidden group-hover:block z-50 border border-slate-700">
                            <a href=""
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

    <div class="pt-20 max-w-4xl h-screen mx-auto py-10 px-4 mt-8">
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