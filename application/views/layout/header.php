<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuansa Rindu – Perjalanan Hati</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>
<body>

<nav>
    <a href="<?= base_url(); ?>" class="nav-logo">
        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 4C16 4 8 10 8 20C8 24.4 11.6 28 16 28C20.4 28 24 24.4 24 20C24 10 16 4 16 4Z" stroke="#C4A35A" stroke-width="1.2" fill="none"/>
            <path d="M12 16C14 12 18 10 22 12" stroke="#C4A35A" stroke-width="0.8" fill="none" opacity="0.5"/>
            <circle cx="16" cy="6" r="1.5" fill="#C4A35A" opacity="0.6"/>
        </svg>
        NUANSA RINDU
    </a>
    <ul class="nav-links">
        <li><a href="<?= base_url('#journey'); ?>">Journey</a></li>
        <li><a href="<?= base_url('#experience'); ?>">Experience</a></li>
        <li><a href="<?= base_url('#about'); ?>">About</a></li>
        <li><a href="<?= base_url('journal'); ?>">Journal</a></li>
        <li><a href="<?= base_url('#footer-cta'); ?>">Contact</a></li>
    </ul>
    <button class="nav-cta">Inquire</button>
</nav>