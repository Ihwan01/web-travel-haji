<?php
// 1. Memuat komponen header (otomatis membawa data $title, $role_id, dll)
// Memanggil Header yang berisi navigasi/sidebar
$this->load->view('cms/layout/header');

// 2. Memuat konten inti halaman secara dinamis
// Memanggil konten utama (TIDAK PERLU lagi menuliskan $data)
$this->load->view($content_view);

// 3. Memuat komponen footer (termasuk skrip CKEditor)
// Memanggil Footer untuk menutup layout dan memuat script (CKEditor)
$this->load->view('cms/layout/footer');
