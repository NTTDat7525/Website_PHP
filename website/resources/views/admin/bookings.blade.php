<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đặt Bàn</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen">
        @include('admin.sidebar')

        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Quản Lý Đặt Bàn</h1>

            <div class="bg-white rounded-lg shadow-md p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2 font-bold">Mã Đặt</th>
                            <th class="pb-2 font-bold">Bàn</th>
                            <th class="pb-2 font-bold">Khách Hàng</th>
                            <th class="pb-2 font-bold">Số điện thoại</th>
                            <th class="pb-2 font-bold">Ngày Đặt</th>
                            <th class="pb-2 font-bold">Giờ Đặt</th>
                            <th class="pb-2 font-bold">Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                    <tr class="border-b hover:bg-gray-50">
                        <td>#{{ $booking->id }}</td>
                        <td>{{ $booking->table->name ?? '' }}</td>
                        <td>{{ $booking->user->username ?? '' }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}</td>
                        <td>
                            @switch($booking->status)
                                @case('confirmed')
                                    <span class="text-green-600">Đã xác nhận</span>
                                    @break
                                @case('pending')
                                    <span class="text-yellow-600">Chờ xử lý</span>
                                    @break
                                @case('cancelled')
                                    <span class="text-red-600">Đã hủy</span>
                                    @break
                                @case('completed')
                                    <span class="text-blue-600">Hoàn thành</span>
                                    @break
                                @default
                                    <span>{{ $booking->status }}</span>
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>

</html>