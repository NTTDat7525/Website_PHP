<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Bàn</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen">
        @include('admin.sidebar')

        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Quản Lý Bàn</h1>
            <button onclick="openModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Thêm Bàn Mới
            </button>
            <div class="bg-white rounded-lg shadow-md p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2 font-bold">Tên Bàn</th>
                            <th class="pb-2 font-bold">Sức Chứa</th>
                            <th class="pb-2 font-bold">Trạng Thái</th>
                            <th class="pb-2 font-bold">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tables as $table)
                    {{-- PROPOSE: Thêm cột "Số booking hôm nay" để admin biết người dùng nào đã đặt bàn này hôm nay.
                         Hoặc thêm nút xem lịch (“Xem booking”) để admin xem toàn bộ khung giờ đã bị đặt theo từng ngày. --}}
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3">
                            {{ $table->name }}
                        </td>

                        <td class="py-3">
                            {{ $table->capacity }} người
                        </td>

                        <td class="py-3">
                            @if($table->status === 'available')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm font-semibold">
                                    Trống
                                </span>
                            @elseif($table->status === 'reserved')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm font-semibold">
                                    Đã đặt
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm font-semibold">
                                    Không hoạt động
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <button onclick="openEditModal(
                                {{ $table->id }},
                                '{{ $table->name }}',
                                '{{ $table->location }}',
                                {{ $table->capacity }},
                                {{ $table->price }})"
                            class="text-blue-600 hover:underline">Sửa</button>
                            <form action="{{ route('admin.tables.destroy', $table->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa bàn này?');"
                                    class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-4">Xóa</button>
                            </form>

                            @if($table->status === 'reserved')
                                <form action="{{ route('admin.tables.occupy', $table->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-orange-600 hover:underline ml-4">Đang dùng</button>
                                </form>
                            @elseif($table->status === 'occupied')
                                <form action="{{ route('admin.tables.release', $table->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline ml-4">Giải phóng</button>
                                </form>
                            @endif

                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div id="modal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

        <div class="bg-white w-[520px] p-6 rounded-xl shadow-lg">

            <h2 class="text-xl font-bold mb-6 text-gray-800">
                Thêm bàn mới
            </h2>

            <form id="tableForm"
                action="{{ route('admin.tables.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Tên bàn</label>
                    <input name="name" id="name"
                        class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200"
                        placeholder="Nhập tên bàn">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Khu vực</label>
                    <select name="location" id="location"
                            class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200">
                        <option value="">-- Chọn khu vực --</option>
                        <option value="Sảnh chính">Sảnh chính</option>
                        <option value="Sân thượng">Sân thượng</option>
                        <option value="Khu VIP">Khu VIP</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Số người</label>
                    <input type="number" name="capacity" id="capacity"
                        min="1"
                        class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200"
                        placeholder="Nhập số người">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Giá bàn</label>
                    <input type="number" 
                        name="price" 
                        id="price"
                        min="1000"
                        required
                        class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200"
                        placeholder="Nhập giá bàn">
                </div>

                <div class="mb-5">
                    <label class="block mb-1 font-medium text-gray-700">
                        Ảnh bàn (không bắt buộc)
                    </label>
                    <input type="file" name="image"
                        class="w-full border rounded-lg p-3">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button"
                            onclick="closeModal()"
                            class="px-4 py-2 bg-gray-400 text-white rounded-lg">
                        Hủy
                    </button>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Lưu
                    </button>
                </div>

            </form>
            <p id="errorMsg"
            class="text-red-600 mt-3 hidden font-medium">
                Vui lòng nhập đầy đủ thông tin hợp lệ!
            </p>

        </div>
    </div>

    <div id="editModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

        <div class="bg-white w-[520px] p-6 rounded-xl shadow-lg">

            <h2 class="text-xl font-bold mb-6 text-gray-800">
                Chỉnh sửa bàn
            </h2>

            <form id="editTableForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Tên bàn</label>
                    <input name="name" id="edit_name"
                        class="w-full border rounded-lg p-3">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Khu vực</label>
                    <select name="location" id="edit_location"
                        class="w-full border rounded-lg p-3">
                        <option value="Sảnh chính">Sảnh chính</option>
                        <option value="Sân thượng">Sân thượng</option>
                        <option value="Khu VIP">Khu VIP</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Số người</label>
                    <input type="number" name="capacity" id="edit_capacity"
                        class="w-full border rounded-lg p-3">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Giá bàn</label>
                    <input type="number" name="price" id="edit_price"
                        class="w-full border rounded-lg p-3">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg">
                        Hủy
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('modal').classList.remove('flex');
        }

        document.getElementById("tableForm").addEventListener("submit", function (e) {
        let name = document.getElementById("name").value.trim();
        let location = document.getElementById("location").value;
        let capacity = document.getElementById("capacity").value;
        let price = document.getElementById("price").value;

        let errorMsg = document.getElementById("errorMsg");

        if (!name || !location || !capacity || price === "") {
            e.preventDefault();
            errorMsg.classList.remove("hidden");
            return;
        }

        if (capacity <= 0 || price < 0) {
            e.preventDefault();
            errorMsg.textContent = "Số người phải > 0 và giá không được âm!";
            errorMsg.classList.remove("hidden");
            return;
        }

        if (!price || price < 1000) {
            e.preventDefault();
            alert("Giá bàn phải lớn hơn hoặc bằng 1000 VND!");
            return;
        }

        errorMsg.classList.add("hidden");
    });

        function openEditModal(id, name, location, capacity, price) {
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_location').value = location;
        document.getElementById('edit_capacity').value = capacity;
        document.getElementById('edit_price').value = price;

        document.getElementById('editTableForm').action = `/admin/tables/${id}`;

        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
        }
    </script>
</body>

</html>