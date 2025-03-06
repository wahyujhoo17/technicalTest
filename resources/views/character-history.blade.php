@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">History Check Karakter</h2>
    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
        <table id="history-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Input 1</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Input 2</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Percentage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @foreach ($history as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->input1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->input2 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->percentage }}%</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            <button class="delete-btn px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700" data-id="{{ $item->id }}">
                                <i class="fas fa-trash"></i> Hapus <!-- Ikon tong sampah -->
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#history-table').DataTable({
            order: [[3, 'desc']],
            initComplete: function() {
                // Tambahkan class Tailwind CSS ke elemen DataTables
                $('.dataTables_wrapper').addClass('dark:bg-gray-800 dark:text-gray-200');

                // Tombol pagination
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-1 mx-1 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-primary text-white dark:bg-primary dark:text-white');

                // Input pencarian
                $('.dataTables_filter input').addClass('px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600');

                // Dropdown panjang halaman
                $('.dataTables_length select').addClass('px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600');

                // Tombol ekspor
                $('.dt-buttons button').addClass('px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600');
            }
        });
    });
 // Tangani klik tombol hapus
 $(document).on('click', '.delete-btn', function() {
            const itemId = $(this).data('id'); // Ambil ID dari atribut data-id
            const row = $(this).closest('tr'); // Ambil baris yang akan dihapus

            // Tampilkan modal konfirmasi SweetAlert2
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning', // Ikon peringatan
                showCancelButton: true, // Tombol batal
                confirmButtonColor: '#d33', // Warna tombol konfirmasi
                cancelButtonColor: '#3085d6', // Warna tombol batal
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan AJAX ke backend
                    $.ajax({
                        url: `/history/${itemId}`, // Endpoint untuk menghapus data
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function(response) {
                            // Hapus baris dari tabel jika sukses
                            row.fadeOut(300, function() {
                                $(this).remove();
                            });

                            // Tampilkan notifikasi sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success', // Ikon sukses
                                confirmButtonColor: '#3085d6' // Warna tombol konfirmasi
                            });
                        },
                        error: function(xhr) {
                            // Tampilkan notifikasi error
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan. Data gagal dihapus.',
                                icon: 'error', // Ikon error
                                confirmButtonColor: '#d33' // Warna tombol konfirmasi
                            });
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
</script>
@endsection