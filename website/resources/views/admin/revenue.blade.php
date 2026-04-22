<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doanh Thu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen">
        @include('admin.sidebar')

        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Doanh Thu</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-gray-600 text-sm font-medium">Tổng doanh thu</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ number_format($monthlyRevenue) }} VND
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Chi Tiết Doanh Thu</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2 font-bold">Ngày</th>
                            <th class="pb-2 font-bold">Doanh Thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($revenuesByDate as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                <td class="py-3">{{ number_format($item->total) }} VND</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-3 text-center">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>

</html>