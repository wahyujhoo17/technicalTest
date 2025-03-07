<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Aktifkan dark mode berbasis class
            theme: {
                extend: {
                    colors: {
                        primary: '#6D28D9',  /* Purple */
                        darkPrimary: '#4C1D95', /* Darker Purple */
                        secondary: '#9333EA',
                        dark: '#1E1E2E',
                        light: '#F8FAFC'
                    },
                    transitionProperty: {
                        'colors': 'background-color, color, border-color',
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="h-screen flex bg-gray-100 dark:bg-dark transition-colors duration-300">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed lg:relative flex flex-col top-0 left-0 w-64 bg-white dark:bg-dark h-full border-r dark:border-gray-700 transition-transform duration-300 transform -translate-x-full lg:translate-x-0 z-50">
        <!-- Header Sidebar -->
        <div class="flex items-center justify-between h-14 border-b dark:border-gray-700 px-4">
            <div class="text-lg font-semibold text-gray-800 dark:text-light">Character Check</div>
            <button id="close-sidebar" class="lg:hidden text-gray-600 dark:text-light">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Menu Sidebar -->
        <div class="overflow-y-auto overflow-x-hidden flex-grow">
            <ul class="flex flex-col py-4 space-y-1">
                <!-- Menu Utama -->
                <li class="px-5">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-500 dark:text-gray-400">Menu</div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 dark:hover:bg-darkPrimary text-gray-600 dark:text-light hover:text-gray-800 dark:hover:text-light border-l-4 border-transparent hover:border-primary dark:hover:border-primary pr-6 transition-colors duration-300 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-darkPrimary border-primary' : '' }}">
                        <span class="inline-flex justify-center items-center ml-4">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('character.check') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 dark:hover:bg-darkPrimary text-gray-600 dark:text-light hover:text-gray-800 dark:hover:text-light border-l-4 border-transparent hover:border-primary dark:hover:border-primary pr-6 transition-colors duration-300 {{ request()->routeIs('character.check') ? 'bg-gray-100 dark:bg-darkPrimary border-primary' : '' }}">
                        <span class="inline-flex justify-center items-center ml-4">
                            <i class="fas fa-search"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Check Karakter</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('character.history') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 dark:hover:bg-darkPrimary text-gray-600 dark:text-light hover:text-gray-800 dark:hover:text-light border-l-4 border-transparent hover:border-primary dark:hover:border-primary pr-6 transition-colors duration-300 {{ request()->routeIs('character.history') ? 'bg-gray-100 dark:bg-darkPrimary border-primary' : '' }}">
                        <span class="inline-flex justify-center items-center ml-4">
                            <i class="fas fa-history"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">History Check</span>
                    </a>
                </li>
            </ul>
        </div>

        
        <div class="px-5 py-4 border-t dark:border-gray-700">
            <div class="relative">
                <!-- Tombol Profile -->
                <button id="profile-dropdown" class="w-full flex items-center justify-between p-2 hover:bg-gray-50 dark:hover:bg-darkPrimary rounded-lg transition-colors duration-300">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary text-light flex items-center justify-center rounded-full">
                            {{ substr(Auth::user()->name, 0, 1) }} <!-- Inisial nama user -->
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-light">{{ Auth::user()->name }}</span>
                    </div>
                    <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400"></i>
                </button>

                
                <div id="dropdown-menu" class="absolute bottom-full left-0 w-full bg-white dark:bg-dark border dark:border-gray-700 rounded-lg shadow-lg mt-2 hidden transition-opacity duration-300">
                    <ul class="py-2">
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-light hover:bg-gray-50 dark:hover:bg-darkPrimary transition-colors duration-300">
                                <i class="fas fa-user-edit mr-3"></i>
                                Edit Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-light hover:bg-gray-50 dark:hover:bg-darkPrimary transition-colors duration-300">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 transition-colors duration-300">
        <!-- Tombol Toggle Sidebar untuk Mobile -->
        <button id="toggle-sidebar" class="lg:hidden p-2 rounded-lg mb-4">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Konten Utama -->
        <div class="bg-white dark:bg-dark p-6 rounded-lg shadow-md transition-colors duration-300">
            @yield('content')
        </div>

        <!-- Tombol Dark Mode -->
        <button id="dark-mode-toggle" class="fixed bottom-4 right-4 p-3 bg-primary text-light rounded-full shadow-lg hover:bg-darkPrimary transition-colors duration-300">
            <i class="fas fa-moon"></i>
        </button>
    </div>

    <script>
        // Toggle Sidebar di Mobile
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });

        // Dark mode toggle dengan animasi
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const body = document.body;

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            const isDarkMode = body.classList.contains('dark');
            localStorage.setItem('dark-mode', isDarkMode);

            // Ganti ikon tombol dark mode
            const icon = darkModeToggle.querySelector('i');
            if (isDarkMode) {
                icon.classList.replace('fa-moon', 'fa-sun');
            } else {
                icon.classList.replace('fa-sun', 'fa-moon');
            }
        });

        // Set dark mode dari localStorage
        if (localStorage.getItem('dark-mode') === 'true') {
            body.classList.add('dark');
            const icon = darkModeToggle.querySelector('i');
            icon.classList.replace('fa-moon', 'fa-sun');
        }

        // Dropdown Profile
        const profileDropdown = document.getElementById('profile-dropdown');
        const dropdownMenu = document.getElementById('dropdown-menu');

        profileDropdown.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', (event) => {
            if (!profileDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://datatables.net/legacy/v1/media/js/jquery.dataTables.js"></script>
<script src="https://datatables.net/legacy/v1/media/js/dataTables.tailwindcss.js"></script>
<link rel="stylesheet" href="https://datatables.net/legacy/v1/media/css/dataTables.tailwindcss.css">
    @yield('scripts')
</body>
</html>