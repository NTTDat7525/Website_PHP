<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm bàn - Restaurant Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800">

    <header class="bg-indigo-700 py-12 px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Golden Spoon</h1>
        <p class="text-indigo-100">Tìm kiếm không gian phù hợp cho bữa tiệc của bạn</p>
    </header>

    <div class="max-w-7xl mx-auto px-4 -mt-10 pb-20">
        
        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-600 flex items-center">
                        <i class="fas fa-couch mr-2"></i> Loại bàn
                    </label>
                    <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="">Tất cả các loại</option>
                        <option value="vip">Phòng VIP</option>
                        <option value="outdoor">Ngoài trời</option>
                        <option value="window">Cạnh cửa sổ</option>
                        <option value="standard">Tiêu chuẩn</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-600 flex items-center">
                        <i class="fas fa-users mr-2"></i> Số lượng khách
                    </label>
                    <input type="number" min="1" placeholder="Ví dụ: 4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-600 flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i> Thời gian đặt bàn
                    </label>
                    <input type="datetime-local" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div class="flex items-end">
                    <button class="w-full bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-3 px-6 rounded-xl transition duration-300 shadow-lg flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i> Tìm bàn trống
                    </button>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Kết quả tìm kiếm <span class="text-gray-400 font-normal text-base">(12 bàn khả dụng)</span></h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-white border border-gray-200 rounded-lg text-sm hover:bg-gray-50">Giá thấp đến cao</button>
                <button class="px-3 py-1 bg-white border border-gray-200 rounded-lg text-sm hover:bg-gray-50 text-indigo-600 font-medium">Phổ biến nhất</button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&q=80&w=800" alt="Bàn VIP" class="w-full h-full object-cover">
                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">VIP</span>
                </div>
                <div class="p-5 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold">Phòng Hoàng Gia V01</h3>
                        <p class="text-indigo-600 font-bold">$25/h</p>
                    </div>
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-user-friends w-5"></i> <span>Sức chứa: 6 - 8 người</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt w-5"></i> <span>Vị trí: Tầng 2 - Riêng tư</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-check-circle text-green-500 w-5"></i> <span>Sẵn sàng: 18:00 hôm nay</span>
                        </div>
                    </div>
                    <button class="w-full border-2 border-indigo-600 text-indigo-600 font-bold py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200">
                        Xem chi tiết
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&q=80&w=800" alt="Bàn ngoài trời" class="w-full h-full object-cover">
                    <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">Gần gũi thiên nhiên</span>
                </div>
                <div class="p-5 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold">Bàn Sân Vườn G12</h3>
                        <p class="text-indigo-600 font-bold">$10/h</p>
                    </div>
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-user-friends w-5"></i> <span>Sức chứa: 2 - 4 người</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-wind w-5"></i> <span>Tiện ích: Thoáng mát, không hút thuốc</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-check-circle text-green-500 w-5"></i> <span>Sẵn sàng: 19:30 hôm nay</span>
                        </div>
                    </div>
                    <button class="w-full border-2 border-indigo-600 text-indigo-600 font-bold py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200">
                        Xem chi tiết
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1550966841-3ee7adac1661?auto=format&fit=crop&q=80&w=800" alt="Bàn Window" class="w-full h-full object-cover">
                    <span class="absolute top-3 right-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">Phổ biến</span>
                </div>
                <div class="p-5 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold">Bàn Cửa Sổ W04</h3>
                        <p class="text-indigo-600 font-bold">$15/h</p>
                    </div>
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-user-friends w-5"></i> <span>Sức chứa: 2 người</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-city w-5"></i> <span>Tầm nhìn: Phố đi bộ</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock text-yellow-500 w-5"></i> <span>Sẵn sàng: Sau 30 phút</span>
                        </div>
                    </div>
                    <button class="w-full border-2 border-indigo-600 text-indigo-600 font-bold py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200">
                        Xem chi tiết
                    </button>
                </div>
            </div>

        </div>

        <div class="mt-12 flex justify-center space-x-2">
            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-indigo-50 hover:border-indigo-500"><i class="fas fa-chevron-left"></i></button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-indigo-600 text-white">1</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-indigo-50">2</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-indigo-50">3</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-indigo-50"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

</body>
</html>