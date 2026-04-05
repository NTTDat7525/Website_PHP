<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Đăng ký</h2>
        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Tên đăng nhập</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" required>
            </div>
            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" required>
            </div>
            <div>
                <label class="block text-gray-700">Mật khẩu</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" required>
            </div>
            <div>
                <label class="block text-gray-700">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">Đăng ký</button>
        </form>
        <p class="text-center mt-4 text-gray-600">
            Đã có tài khoản?
            <a href="{{ route('login') }}" class="text-green-600 hover:underline">Đăng nhập</a>
        </p>
    </div>
</body>
</html>