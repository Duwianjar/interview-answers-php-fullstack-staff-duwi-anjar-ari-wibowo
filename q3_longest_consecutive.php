<?php

// Aktifkan strict type agar tipe parameter/return lebih ketat.
declare(strict_types=1);

// Mencari urutan angka berurutan (consecutive) terpanjang dari array acak.
function longestConsecutiveSubarray(array $nums): array
{
    // Jika input kosong, tidak ada urutan yang bisa dicari.
    if (empty($nums)) {
        return [];
    }

    // Simpan angka ke set (key map) agar:
    // 1) duplikasi otomatis terabaikan
    // 2) pengecekan keberadaan angka jadi cepat
    $set = array_fill_keys($nums, true);

    // Menyimpan informasi urutan terbaik sejauh ini.
    $bestStart = null;
    $bestLength = 0;

    // Iterasi semua angka unik dalam set.
    foreach ($set as $num => $_) {
        $num = (int) $num;

        // Jika ada angka sebelumnya (num-1), berarti num bukan awal urutan.
        // Lewati agar kita hanya hitung dari "awal sequence".
        if (isset($set[$num - 1])) {
            continue;
        }

        // Mulai hitung panjang urutan dari angka awal ini.
        $current = $num;
        $length = 1;

        // Selama angka berikutnya ada di set, lanjutkan sequence.
        while (isset($set[$current + 1])) {
            $current++;
            $length++;
        }

        // Simpan jika sequence ini lebih panjang dari yang terbaik sebelumnya.
        if ($length > $bestLength) {
            $bestLength = $length;
            $bestStart = $num;
        }
    }

    // Safety check, meski secara normal pasti ada start saat input tidak kosong.
    if ($bestStart === null) {
        return [];
    }

    // Bangun array hasil berdasarkan start dan panjang sequence terbaik.
    $result = [];
    for ($i = 0; $i < $bestLength; $i++) {
        $result[] = $bestStart + $i;
    }

    return $result;
}

// Data contoh dari soal.
$input = [100, 4, 200, 1, 3, 2, 2, 5, 6];

// Jalankan fungsi untuk mencari urutan consecutive terpanjang.
$result = longestConsecutiveSubarray($input);

// Tampilkan input dan output.
echo "Input: [" . implode(", ", $input) . "]\n";
echo "Longest consecutive sequence: [" . implode(", ", $result) . "]\n";
