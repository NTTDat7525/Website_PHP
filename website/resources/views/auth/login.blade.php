<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Đăng nhập</h2>

        @if ($errors->has('login'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ $errors->first('login') }}
        </div>
        @endif

        @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('auth.login.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-2">Tên đăng nhập</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500" required value="{{ old('username') }}">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Mật khẩu</label>

                <div class="relative">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full px-4 py-2 pr-12 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500"
                        required
                        value="{{ old('password') }}"
                    >

                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-500"
                    >
                        👁
                    </button>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                Đăng nhập
            </button>
            <a href="{{ route('auth.google') }}"
            class="w-full flex items-center justify-center gap-3 bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition font-medium mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5 bg-white rounded-full p-1">
                    <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.7 32.7 29.3 36 24 36c-6.6 0-12-5.4-12-12S17.4 12 24 12c3 0 5.8 1.1 7.9 3l5.7-5.7C34.1 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z"/>
                    <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 16 19 12 24 12c3 0 5.8 1.1 7.9 3l5.7-5.7C34.1 6.1 29.3 4 24 4c-7.7 0-14.3 4.3-17.7 10.7z"/>
                    <path fill="#4CAF50" d="M24 44c5.2 0 10-2 13.6-5.2l-6.3-5.2c-2.1 1.5-4.7 2.4-7.3 2.4-5.3 0-9.8-3.3-11.4-8l-6.5 5C9.5 39.5 16.2 44 24 44z"/>
                    <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-1.1 3-3.3 5.3-6 6.8l6.3 5.2C39.7 36.4 44 30.8 44 24c0-1.3-.1-2.4-.4-3.5z"/>
                </svg>
                Đăng nhập bằng Google
            </a>
        </form>
        <p class="text-center mt-4 text-gray-600">
            Chưa có tài khoản?
            <a href="{{ route('auth.register') }}" class="text-blue-600 hover:underline font-medium">Đăng ký</a>
        </p>
    </div>
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const button = event.currentTarget;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            button.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            button.textContent = '👁';
        }
    }
</script>
</body>

</html>