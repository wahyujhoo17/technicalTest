<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Character Check</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .loading-spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #ffffff;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-purple-500 to-indigo-600 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
        <h2 class="text-3xl font-bold text-indigo-600 mb-6">Login</h2>

        <!-- Menampilkan Flash Message Error -->
        @if(session('status'))
            <div class="mb-4 text-red-600 bg-red-100 p-3 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Input -->
            <div class="mb-4 text-left">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4 text-left">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    Remember me
                </label>
                <a href="{{ route('password.request') }}" class="text-indigo-500 hover:underline">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-500 text-white py-3 rounded-lg font-semibold hover:bg-indigo-600 transition">
                Login
            </button>

            <!-- Register Link -->
            <p class="text-gray-600 text-sm mt-4">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-500 font-semibold hover:underline">Sign Up</a>
            </p>
        </form>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner"></div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            // Tampilkan loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
        });
    </script>
</body>
</html>