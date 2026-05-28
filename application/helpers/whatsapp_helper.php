<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('normalize_whatsapp')) {
    /**
     * Mengubah format apapun menjadi murni angka berawalan 628
     * Contoh: "0812-3456 (ext 1)" -> "6281234561"
     */
    function normalize_whatsapp($phone)
    {
        if (empty($phone)) return '';

        // 1. Hapus SEMUA karakter selain angka (spasi, strip, tanda kurung, huruf, dll hilang)
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // 2. Cek dan paksa awalan menjadi 62
        if (substr($phone, 0, 2) == '08') {
            $phone = '62' . substr($phone, 1); // 08 diubah jadi 628
        } elseif (substr($phone, 0, 1) == '8') {
            $phone = '62' . $phone;            // awalan 8 langsung ditambah 62
        } elseif (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1); // jaga-jaga format 021 dst
        }

        return $phone; // Output: 6281234567890
    }
}

if (!function_exists('format_whatsapp')) {
    /**
     * Mempercantik nomor yang sudah normal untuk ditampilkan di layar (View)
     * Contoh: "6281234567890" -> "+62 812-3456-7890"
     */
    function format_whatsapp($phone)
    {
        $phone = normalize_whatsapp($phone); // Pastikan normal dulu

        // Jika nomor terlalu pendek/kosong, kembalikan aslinya
        if (empty($phone) || strlen($phone) < 9) return $phone;

        // Pemecahan string untuk format standar ID: +62 8xx-xxxx-xxxx
        $cc = '+62';
        $b1 = substr($phone, 2, 3); // 3 digit pertama setelah kode negara (misal: 812)
        $b2 = substr($phone, 5, 4); // 4 digit tengah (misal: 3456)
        $b3 = substr($phone, 9);    // Sisa digit belakang (misal: 7890)

        // Gabungkan kembali dengan hiasan
        $formatted = "$cc $b1-$b2";
        if (!empty($b3)) {
            $formatted .= "-$b3";
        }

        return $formatted;
    }
}
