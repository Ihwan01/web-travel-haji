<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// KONFIGURASI DATABASE FINAL DENGAN FITUR AUTORESOLVE (FAILOVER)
$db['default'] = array(
    'dsn'      => '',
    // KONEKSI UTAMA: Mencoba akses dari dalam Server (Lokal Hostinger)
    'hostname' => 'localhost',
    'username' => 'u930669699_nuansarindu',
    'password' => 'Q7m!4vP2#zL8sT9@kR6xN1$h',
    'database' => 'u930669699_nuansarindu',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE, // Error DB dimatikan agar aman dari eksploitasi
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,

    // KONEKSI CADANGAN: Otomatis digunakan jika koneksi utama (localhost) gagal/ditolak
    'failover' => array(
        array(
            'hostname' => 'srv1866.hstgr.io:3306', // Remote Akses Hostinger
            'username' => 'u930669699_nuansarindu',
            'password' => 'Q7m!4vP2#zL8sT9@kR6xN1$h',
            'database' => 'u930669699_nuansarindu',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => FALSE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt'  => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE
        )
    ),
    'save_queries' => FALSE
);
