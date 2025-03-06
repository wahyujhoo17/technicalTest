<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CharacterCheck;

class CharacterCheckController extends Controller
{
    // Menampilkan form check karakter
    public function showCheckForm()
    {
        return view('character-check');
    }

    // Menangani submit form check karakter
    public function checkCharacters(Request $request)
    {
        // Validasi input
        $request->validate([
            'input1' => 'required|string',
            'input2' => 'required|string',
        ]);

        // Ambil input
        $input1 = $request->input('input1');
        $input2 = $request->input('input2');

        // Hitung persentase dan detail perhitungan
        $result = $this->calculatePercentage($input1, $input2);

        // Simpan data ke database
        CharacterCheck::create([
            'user_id' => auth()->id(), // Ambil ID user yang sedang login
            'input1' => $input1,
            'input2' => $input2,
            'percentage' => $result['percentage'],
        ]);

        // Kembalikan response JSON dengan detail perhitungan
        return response()->json($result);
    }


    // Menampilkan history check karakter
    public function showHistory()
    {
        $history = CharacterCheck::where('user_id', auth()->id())->get();
        return view('character-history', compact('history'));
    }

    // Fungsi untuk menghitung persentase
    private function calculatePercentage($input1, $input2)
    {
        // Ubah ke huruf besar agar case-insensitive
        $input1 = strtoupper($input1);
        $input2 = strtoupper($input2);

        // Hapus spasi dari kedua input
        $input1 = str_replace(' ', '', $input1);
        $input2 = str_replace(' ', '', $input2);

        // Hitung total karakter dalam Input 1
        $totalChars = strlen($input1);

        // Jika tidak ada karakter di Input 1, langsung return 0%
        if ($totalChars === 0) {
            return 0;
        }

        // Simpan karakter yang sudah ditemukan agar tidak dihitung dua kali
        $checkedChars = [];
        $matchedChars = 0;

        for ($i = 0; $i < $totalChars; $i++) {
            $char = $input1[$i];

            // Pastikan karakter hanya dihitung sekali
            if (!in_array($char, $checkedChars) && strpos($input2, $char) !== false) {
                $matchedChars++;
                $checkedChars[] = $char; // Tandai karakter sebagai sudah dicek
            }
        }

        // Hitung persentase kecocokan
        $percentage = ($matchedChars / $totalChars) * 100;

        // Kembalikan hasil perhitungan
        return [
            'percentage' => round($percentage, 2), // Persentase dibulatkan ke 2 desimal
            'total_unique_chars' => $matchedChars, // Total karakter unik di Input 1
            'matched_chars' => $checkedChars, // Karakter unik yang cocok
        ];
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $history = CharacterCheck::find($id);

        // Jika data tidak ditemukan
        if (!$history) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Hapus data
        $history->delete();

        // Beri respons sukses
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
