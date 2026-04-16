<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Tài Khoản - Golden Spoons</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-100 text-slate-800 ">

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

    <div class="pt-20 max-w-6xl mx-auto py-10 px-4 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="md:col-span-2 space-y-6">

                <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-6">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username ?? 'User' }}&background=random"
                        class="w-20 h-20 rounded-full border-4 border-indigo-100">

                    <div>
                        <h2 class="text-xl font-bold">
                            {{ auth()->user()->username ?? 'Người dùng' }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            Thành viên từ {{ auth()->user()->created_at->format('M Y') }}
                        </p>
                    </div>

                    <button onclick="openModal()"
                        class="ml-auto px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Chỉnh sửa
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-white rounded-2xl shadow-lg p-4 flex items-center gap-4">
                        <i class="fas fa-envelope text-indigo-600"></i>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-4 flex items-center gap-4">
                        <i class="fas fa-phone text-indigo-600"></i>
                        <div>
                            <p class="text-sm text-gray-500">Số điện thoại</p>
                            <p class="font-medium">
                                {{ auth()->user()->phone ?? 'Chưa cập nhật' }}
                            </p>
                        </div>
                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 ">
                    <p class="text-sm text-gray-500 mb-2">Tiểu sử</p>
                    <p class="text-gray-700 italic">
                        {{ auth()->user()->bio ?? 'Chưa có thông tin' }}
                    </p>
                </div>

            </div>

            <div class="space-y-6">

                <div class="bg-white rounded-2xl shadow-lg p-6 text-center border-2">
                    <i class="fas fa-check-circle text-600 text-3xl mb-3"></i>
                    <p class="text-sm text-gray-600">ĐƠN HOÀN THÀNH</p>
                    <p class="text-3xl font-bold text-600">LẤY DB</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 text-center border-2">
                    <i class="fas fa-calendar-check text-500 text-3xl mb-3"></i>
                    <p class="text-sm text-gray-600">SẮP ĐẾN HẸN</p>
                    <p class="text-3xl font-bold text-500">LẤY DB</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 text-center border-2">
                    <i class="fas fa-wallet text-600 text-3xl mb-3"></i>
                    <p class="text-sm text-gray-600">CHI TIÊU</p>
                    <p class="text-3xl font-bold text-600">LẤY DB</p>
                </div>

            </div>

        </div>
    </div>

    <div id="profileModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-2xl p-6 relative">

            <h2 class="text-xl font-bold mb-4">Cập nhật thông tin</h2>

            <form id="updateForm">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="username" value="{{ auth()->user()->name ?? '' }}"
                        class="border p-2 rounded" placeholder="Họ và tên">

                    <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}"
                        class="border p-2 rounded" placeholder="Số điện thoại">
                </div>

                <textarea name="bio" class="border p-2 rounded w-full mt-4 h-32"
                    placeholder="Bio">{{ auth()->user()->bio ?? '' }}</textarea>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded">
                        Hủy
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">
                        Lưu
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('profileModal').classList.remove('hidden');
            document.getElementById('profileModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('profileModal').classList.add('hidden');
            document.getElementById('profileModal').classList.remove('flex');
        }

        document.getElementById('profileModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.getElementById('updateForm').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
        });
    </script>

</body>

</html>