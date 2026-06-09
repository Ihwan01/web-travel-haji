<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| NUANSA RINDU — Routes
|--------------------------------------------------------------------------
*/

$route['default_controller']   = 'Home';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;


/*
|--------------------------------------------------------------------------
| 1. RUTE CMS (BACKEND NUANSA RINDU)
|--------------------------------------------------------------------------
| Ini adalah URL bersih untuk modul yang berada di dalam folder controllers/cms/
*/

// Autentikasi
$route['login']  = 'cms/auth/login';
$route['logout'] = 'cms/auth/logout';

// Dasbor Utama CMS
$route['dashboard'] = 'cms/dashboard';

// Manajemen Pengguna
$route['users']               = 'cms/users';
$route['users/index']         = 'cms/users/index'; // [TAMBAHAN] Untuk Paginasi
$route['users/create']        = 'cms/users/create';
$route['users/edit/(:any)']   = 'cms/users/edit/$1';
$route['users/delete/(:any)'] = 'cms/users/delete/$1';

// Profil Pengguna
$route['profile']        = 'cms/profile/index';
$route['profile/update'] = 'cms/profile/update';

// Pengaturan Beranda (Homepage Settings)
$route['homepage_settings']        = 'cms/homepage_settings';
$route['homepage_settings/update'] = 'cms/homepage_settings/update';

// Manajemen Perjalanan (Journeys)
$route['journeys']               = 'cms/journeys';
$route['journeys/index']         = 'cms/journeys/index'; // [TAMBAHAN] Untuk Paginasi
$route['journeys/create']        = 'cms/journeys/create';
$route['journeys/edit/(:any)']   = 'cms/journeys/edit/$1';
$route['journeys/delete/(:any)'] = 'cms/journeys/delete/$1';

// Manajemen Perlengkapan (Fashions)
$route['fashions']               = 'cms/fashions';
$route['fashions/index']         = 'cms/fashions/index'; // [TAMBAHAN] Untuk Paginasi
$route['fashions/create']        = 'cms/fashions/create';
$route['fashions/edit/(:any)']   = 'cms/fashions/edit/$1';
$route['fashions/delete/(:any)'] = 'cms/fashions/delete/$1';

// Manajemen Jurnal (Journals)
$route['journals']               = 'cms/journals';
$route['journals/index']         = 'cms/journals/index'; // [TAMBAHAN] Untuk Paginasi
$route['journals/create']        = 'cms/journals/create';
$route['journals/edit/(:any)']   = 'cms/journals/edit/$1';
$route['journals/delete/(:any)'] = 'cms/journals/delete/$1';
$route['journals/all_comments'] = 'cms/journals/all_comments';

// --- RUTE MANAJEMEN KATEGORI JURNAL ---
$route['journals/categories']             = 'cms/journals/categories';
$route['journals/add_category']           = 'cms/journals/add_category';
$route['journals/delete_category/(:num)'] = 'cms/journals/delete_category/$1';

// [TAMBAHAN BARU: Rute Fitur Komentar Jurnal]
$route['journals/comments/(:any)']                       = 'cms/journals/comments/$1';
$route['journals/approve_comment/(:any)/(:any)/(:any)'] = 'cms/journals/approve_comment/$1/$2/$3';
$route['journals/reply_comment/(:any)']                  = 'cms/journals/reply_comment/$1';
$route['journals/delete_comment/(:any)/(:any)']          = 'cms/journals/delete_comment/$1/$2';

// Manajemen Konsultasi Masuk (Leads)
$route['leads']               = 'cms/leads';
$route['leads/index']         = 'cms/leads/index'; // [PERBAIKAN ERROR 404]
$route['leads/delete/(:any)'] = 'cms/leads/delete/$1';

// Manajemen Galeri (Galleries)
$route['galleries']               = 'cms/gallery';
$route['galleries/index']         = 'cms/gallery/index'; // [TAMBAHAN] Untuk Paginasi
$route['galleries/create']        = 'cms/gallery/create';
$route['galleries/delete/(:any)'] = 'cms/gallery/delete/$1';
$route['galleries/edit/(:any)']   = 'cms/gallery/edit/$1';

// Pengaturan SEO & Tracking
$route['seo']                 = 'cms/seo';
$route['seo/update_tracking'] = 'cms/seo/update_tracking';
$route['seo/save_meta']       = 'cms/seo/save_meta';

// // ROUTING MODUL PROFIL & KONTAK GLOBAL
// $route['company']        = 'cms/company';
// $route['company/update'] = 'cms/company/update';

// --- RUTE AUTENTIKASI BARU (FORGOT & RESET PASSWORD) ---
$route['auth/forgot_password']       = 'cms/auth/forgot_password';
$route['auth/reset_password/(:any)'] = 'cms/auth/reset_password/$1';

// --- RUTE AKSI SUPER ADMIN (FORCE RESET PASSWORD) ---
$route['users/force_reset_password/(:any)'] = 'cms/users/force_reset_password/$1';

/*
|--------------------------------------------------------------------------
| 2. RUTE HALAMAN PUBLIK (FRONTEND)
|--------------------------------------------------------------------------
*/
$route['']                      = 'Home/index';
$route['journey']               = 'Journey/index';
$route['journey/(:any)']        = 'Journey/detail/$1';
$route['about']                 = 'About/index';
$route['journal']               = 'Journal/index';
$route['journal/submit_comment'] = 'Journal/submit_comment'; // [TAMBAHAN BARU]
$route['journal/(:any)']        = 'Journal/detail/$1';
$route['gallery']               = 'Gallery/index';
$route['fashion']               = 'Fashion/index';
$route['fashion/(:any)']        = 'Fashion/detail/$1';
$route['contact']               = 'Contact/index';
$route['contact/send']          = 'Contact/send';
