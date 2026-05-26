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
    $db['default'] = array(
        'dsn'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'nuansa_rindu',
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
        'username' => 'u711561307_nuansa',
        'password' => 'N3w!v8Qp7#L2xS9m',
        'database' => 'u711561307_nuansa',
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
