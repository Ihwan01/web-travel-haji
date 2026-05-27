<?php
// 1. Buka HTML, Muat CSS, Sidebar Kiri, dan Topbar
$this->load->view('cms/layout/header');

// 2. Muat Konten Halaman (Dinamis)
$this->load->view($content_view);

// 3. Tutup Div Konten, Muat JS, dan Tutup HTML
$this->load->view('cms/layout/footer');
