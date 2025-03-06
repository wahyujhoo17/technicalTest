<x-guest-layout>
    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" id="password-reset-form">
        @csrf
    
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    
        <div class="flex items-center justify-end mt-4">
            <x-primary-button id="submit-button">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
    
    <!-- Script untuk SweetAlert2 -->
    <script>
        document.getElementById('password-reset-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dikirim
    
            // Tampilkan alert
            Swal.fire({
                title: 'Informasi',
                text: 'Lupa password belum tersedia.',
                icon: 'info', // Ikon info
                confirmButtonColor: '#3085d6', // Warna tombol konfirmasi
                confirmButtonText: 'OK'
            });
        });
    </script>
</x-guest-layout>
