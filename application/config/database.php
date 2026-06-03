<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

/*
| -------------------------------------------------------------------
| LOGIKA CERDAS: AUTO-SWITCH DATABASE BERDASARKAN ENVIRONMENT
| -------------------------------------------------------------------
*/

if (ENVIRONMENT === 'development') {
    // 1. KONFIGURASI UNTUK LOKAL (XAMPP / KOMPUTER ANDA)
    // Konfigurasi LOKAL -> REMOTE MYSQL HOSTINGER
    $db['default'] = array(
        'dsn'      => '',
        'hostname' => 'srv1866.hstgr.io',
        'username' => 'u930669699_nuansarindu',
        'password' => 'Q7m!4vP2#zL8sT9@kR6xN1$h',
        'database' => 'u930669699_nuansarindu',
        'dbdriver' => 'mysqli',
        'dbprefix' => '',
        'pconnect' => FALSE,
        'db_debug' => TRUE, // Error ditampilkan di lokal
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
    // 2. KONFIGURASI UNTUK SERVER LIVE (PRODUCTION / HOSTING)
    $db['default'] = array(
        'dsn'      => '',
        'hostname' => 'localhost',
        'username' => 'u930669699_nuansarindu',
        'password' => 'Q7m!4vP2#zL8sT9@kR6xN1$h',
        'database' => 'u930669699_nuansarindu',
        'dbdriver' => 'mysqli',
        'dbprefix' => '',
        'pconnect' => FALSE,
        'db_debug' => FALSE, // Error disembunyikan di server live
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
