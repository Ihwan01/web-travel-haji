<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Fungsi $this->check_authentication() dari Admin_Controller otomatis bekerja di sini
    }

    public function index()
    {
        $data['title'] = 'Dasbor Eksekutif | Nuansa Rindu';

        // Tidak perlu lagi mengambil session manual di sini karena sudah 
        // diinjeksi secara otomatis oleh MY_Controller ke dalam $this->data

        // [DIUBAH] Menggunakan fungsi render untuk memanggil layout terpusat
        $this->render('cms/dashboard/index', $data);
    }
}
