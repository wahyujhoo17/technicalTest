@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-light">Check Karakter</h2>
    <form id="character-check-form" class="bg-white dark:bg-dark p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="input1" class="block text-sm font-medium text-gray-700 dark:text-light">Input 1</label>
            <input type="text" id="input1" name="input1" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-dark dark:text-light" required>
        </div>
        <div class="mb-4">
            <label for="input2" class="block text-sm font-medium text-gray-700 dark:text-light">Input 2</label>
            <input type="text" id="input2" name="input2" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-dark dark:text-light" required>
        </div>
        <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-darkPrimary transition-colors duration-300">Check</button>
    </form>

    <!-- Tempat untuk menampilkan hasil -->
    <div id="result" class="mt-6">
        <!-- Hasil akan dimasukkan di sini -->
    </div>

    <!-- Tempat untuk menampilkan loading spinner -->
    <div id="loading-spinner" class="mt-6 text-center hidden">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<script>
document.getElementById('character-check-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Mencegah form submit biasa

    // Tampilkan loading spinner
    document.getElementById('loading-spinner').classList.remove('hidden');

    // Ambil data dari form
    const formData = new FormData(this);

    // Ambil CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Kirim data menggunakan Fetch API
    fetch('/character-check', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        // Tampilkan hasil dalam tabel
        document.getElementById('result').innerHTML = `
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Hasil Perhitungan</h4>
                <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 dark:bg-gray-600">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Metrik</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Hasil</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Persentase Kecocokan</td>
                            <td class="px-4 py-2 text-sm font-semibold text-green-600 dark:text-green-400">${data.percentage}%</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Total Karakter Unik di Input 1</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">${data.total_unique_chars}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Karakter Unik yang Cocok</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">${data.matched_chars.join(', ')}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Tombol Clear -->
                <button id="clear-button" class="mt-4 w-full bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 py-2 px-4 rounded-md hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors duration-300">
                    Clear
                </button>
            </div>
        `;

        // Tambahkan event listener untuk tombol Clear
        document.getElementById('clear-button').addEventListener('click', function () {
            // Kosongkan form
            document.getElementById('character-check-form').reset();
            // Kosongkan hasil
            document.getElementById('result').innerHTML = '';
        });
    })
    .catch(error => {
        // Tampilkan pesan error
        document.getElementById('result').innerHTML = `
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md dark:bg-red-800 dark:border-red-600 dark:text-red-100">
                ${error.message || 'Terjadi kesalahan. Silakan coba lagi.'}
            </div>
        `;
        console.error(error);
    })
    .finally(() => {
        // Sembunyikan loading spinner
        document.getElementById('loading-spinner').classList.add('hidden');
    });
});
</script>
@endsection