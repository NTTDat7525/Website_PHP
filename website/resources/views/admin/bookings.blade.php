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
                            <th class="pb-2 font-bold">Thời Gian</th>
                            <th class="pb-2 font-bold">Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>#{{ $booking->id }}</td>
                        <td>{{ $booking->table->name ?? '' }}</td>
                        <td>{{ $booking->user->username ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->time)->format('d/m/Y H:i') }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>

</html>