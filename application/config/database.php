<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

if (ENVIRONMENT === 'development') {
    // 1. KONFIGURASI PROJEK LOKAL
    $db['default'] = array(
        'dsn'      => '',
        // // Pakai DB lokal
        // 'hostname' => 'localhost',
        // 'username' => 'root',
        // 'password' => '',
        // 'database' => 'nuansa_rindu',

        // pakai remote DB Hostinger
        'hostname' => 'srv1866.hstgr.io', // Hostname tetap srv1866.hstgr.io karena diakses dari luar server Hostinger
        'username' => 'u930669699_nuansarindu',
        'password' => 'Q7m!4vP2#zL8sT9@kR6xN1$h',
        'database' => 'u930669699_nuansarindu',

        'dbdriver' => 'mysqli',
        'dbprefix' => '',
        'pconnect' => FALSE,
        'db_debug' => TRUE,
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt'  => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
    );
} else {
    // 2. KONFIGURASI SERVER LIVE (Produksi di Hostinger)
    $db['default'] = array(
        'dsn'      => '',
        'hostname' => 'localhost', // Tetap localhost karena diakses dari dalam server Hostinger itu sendiri
        'username' => 'u930669699_nuansarindu',
        'password' => 'Q7m!4vP2#zL8sT9@kR6xN1$h',
        'database' => 'u930669699_nuansarindu',
        'dbdriver' => 'mysqli',
        'dbprefix' => '',
        'pconnect' => FALSE,
        'db_debug' => FALSE, // Error DB dimatikan agar aman dari hacker
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt'  => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => FALSE
    );
}
