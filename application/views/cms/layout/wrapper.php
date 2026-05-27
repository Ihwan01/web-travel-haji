<?php
// 1. Memuat komponen header (Membuka HTML, CSS Flexbox, Sidebar, & membuka div Konten)
$this->load->view('cms/layout/header');

// 2. Memuat konten inti halaman secara dinamis (Tampil di area kanan)
$this->load->view($content_view);

// 3. Memuat komponen footer (Menutup div Konten, HTML, dan memuat script JS)
$this->load->view('cms/layout/footer');
