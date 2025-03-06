@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">Dashboard</h2>
    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Selamat datang di aplikasi Check Karakter!</p>

    <!-- Grid untuk Fitur -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1: Check Karakter -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-blue-100 dark:bg-blue-800 rounded-full">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 ml-4">Check Karakter</h3>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Periksa kesamaan karakter antara dua teks dengan mudah.</p>
            <a href="{{ route('character.check') }}" class="mt-4 inline-flex items-center text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-400">
                Mulai Sekarang
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <!-- Card 2: History -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-green-100 dark:bg-green-800 rounded-full">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 ml-4">History</h3>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Lihat riwayat pengecekan karakter yang telah Anda lakukan.</p>
            <a href="{{ route('character.history') }}" class="mt-4 inline-flex items-center text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-400">
                Lihat History
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <!-- Card 3: Profile -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-purple-100 dark:bg-purple-800 rounded-full">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 ml-4">Profile</h3>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Kelola informasi profil dan keamanan akun Anda.</p>
            <a href="{{ route('profile.edit') }}" class="mt-4 inline-flex items-center text-purple-600 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-400">
                Edit Profile
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection