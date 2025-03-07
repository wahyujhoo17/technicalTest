<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Character Check</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        #lottie-container {
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-purple-500 to-indigo-600 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
        <h2 class="text-3xl font-bold text-indigo-600 mb-6">Create an Account</h2>

        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf

            <div class="mb-4 text-left">
                <label for="name" class="block text-gray-700 font-semibold">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 text-left">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 text-left">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 text-left">
                <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit" class="w-full bg-indigo-500 text-white py-3 rounded-lg font-semibold hover:bg-indigo-600 transition">
                Register
            </button>

            <p class="text-gray-600 text-sm mt-4">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-indigo-500 font-semibold hover:underline">Login</a>
            </p>
        </form>
    </div>

    <div id="loadingOverlay" class="loading-overlay">
        <div id="lottie-container"></div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('loadingOverlay').classList.add('active');
            
            lottie.loadAnimation({
                container: document.getElementById('lottie-container'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: 'https://assets7.lottiefiles.com/packages/lf20_j1adxtyb.json' 
            });

            setTimeout(() => {
                event.target.submit();
            }, 2000);
        });
    </script>
</body>
</html>