<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| NUANSA RINDU — Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Halaman Depan Publik 
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// --- RUTE KUSTOM NUANSA RINDU ---
// Menyembunyikan cms/auth/login menjadi /login
$route['login'] = 'cms/auth/login';

// Menyembunyikan cms/auth/logout menjadi /logout
$route['logout'] = 'cms/auth/logout';

// Rute Manajemen Pengguna (Menyembunyikan map cms/)
$route['dashboard']           = 'cms/dashboard';
$route['users']               = 'cms/users';
$route['users/create']        = 'cms/users/create';
$route['users/edit/(:any)']   = 'cms/users/edit/$1';
$route['users/delete/(:any)'] = 'cms/users/delete/$1';

$route['default_controller'] = 'Home';
$route['404_override']       = '';
$route['translate_uri_dashes'] = FALSE;

// ── PUBLIC PAGES ──────────────────────────────────────────────────────────
$route['']                      = 'Home/index';
$route['journey']               = 'Journey/index';
$route['journey/(:any)']        = 'Journey/detail/$1';
$route['about']                 = 'About/index';
$route['journal']               = 'Journal/index';
$route['journal/(:any)']        = 'Journal/detail/$1';
$route['gallery']               = 'Gallery/index';
$route['fashion']               = 'Fashion/index';
$route['contact']               = 'Contact/index';
$route['contact/send']          = 'Contact/send';

// ── ADMIN ─────────────────────────────────────────────────────────────────
$route['admin']                         = 'Admin/dashboard';
$route['admin/login']                   = 'Admin/login';
$route['admin/logout']                  = 'Admin/logout';
$route['admin/dashboard']               = 'Admin/dashboard';

// Journey CMS
$route['admin/journey']                 = 'Admin_Journey/index';
$route['admin/journey/create']          = 'Admin_Journey/create';
$route['admin/journey/store']           = 'Admin_Journey/store';
$route['admin/journey/edit/(:num)']     = 'Admin_Journey/edit/$1';
$route['admin/journey/update/(:num)']   = 'Admin_Journey/update/$1';
$route['admin/journey/delete/(:num)']   = 'Admin_Journey/delete/$1';

// Journal CMS
$route['admin/journal']                 = 'Admin_Journal/index';
$route['admin/journal/create']          = 'Admin_Journal/create';
$route['admin/journal/store']           = 'Admin_Journal/store';
$route['admin/journal/edit/(:num)']     = 'Admin_Journal/edit/$1';
$route['admin/journal/update/(:num)']   = 'Admin_Journal/update/$1';
$route['admin/journal/delete/(:num)']   = 'Admin_Journal/delete/$1';

// Fashion CMS
$route['admin/fashion']                 = 'Admin_Fashion/index';
$route['admin/fashion/create']          = 'Admin_Fashion/create';
$route['admin/fashion/store']           = 'Admin_Fashion/store';
$route['admin/fashion/edit/(:num)']     = 'Admin_Fashion/edit/$1';
$route['admin/fashion/update/(:num)']   = 'Admin_Fashion/update/$1';
$route['admin/fashion/delete/(:num)']   = 'Admin_Fashion/delete/$1';

// Gallery CMS
$route['admin/gallery']                 = 'Admin_Gallery/index';
$route['admin/gallery/create']          = 'Admin_Gallery/create';
$route['admin/gallery/store']           = 'Admin_Gallery/store';
$route['admin/gallery/delete/(:num)']   = 'Admin_Gallery/delete/$1';

// Leads
$route['admin/leads']                   = 'Admin_Leads/index';
$route['admin/leads/delete/(:num)']     = 'Admin_Leads/delete/$1';

// SEO
$route['admin/seo']                     = 'Admin_Seo/index';
$route['admin/seo/update']              = 'Admin_Seo/update';
