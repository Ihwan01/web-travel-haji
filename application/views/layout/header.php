<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? $title : 'Nuansa Rindu – Perjalanan Hati' ?></title>

    <?php if (isset($seo_meta) && !empty($seo_meta->meta_description)): ?>
        <meta name="description" content="<?= htmlspecialchars($seo_meta->meta_description) ?>">
    <?php endif; ?>

    <?php if (isset($seo_meta) && !empty($seo_meta->meta_keywords)): ?>
        <meta name="keywords" content="<?= htmlspecialchars($seo_meta->meta_keywords) ?>">
    <?php endif; ?>

    <?php if (isset($seo_tracking)): ?>
        <?php if (!empty($seo_tracking->gsc_code)): ?>
            <?= $seo_tracking->gsc_code ?>
        <?php endif; ?>

        <?php if (!empty($seo_tracking->ga4_code)): ?>
            <?= $seo_tracking->ga4_code ?>
        <?php endif; ?>

        <?php if (!empty($seo_tracking->meta_pixel_code)): ?>
            <?= $seo_tracking->meta_pixel_code ?>
        <?php endif; ?>
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=' . time()); ?>">
</head>

<body>

    <nav id="main-navbar">
        <a href="<?= base_url(); ?>" class="nav-logo">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="svg-path-1" d="M16 4C16 4 8 10 8 20C8 24.4 11.6 28 16 28C20.4 28 24 24.4 24 20C24 10 16 4 16 4Z" stroke-width="1.2" fill="none" />
                <path class="svg-path-2" d="M12 16C14 12 18 10 22 12" stroke-width="0.8" fill="none" opacity="0.5" />
                <circle class="svg-circle" cx="16" cy="6" r="1.5" opacity="0.6" />
            </svg>
            NUANSA RINDU
        </a>
        <ul class="nav-links">
            <?php if (isset($show_journey) && $show_journey): ?>
                <li><a href="<?= base_url('#journey'); ?>">Journey</a></li>
            <?php endif; ?>

            <li><a href="<?= base_url('#experience'); ?>">Experience</a></li>
            <li><a href="<?= base_url('#about'); ?>">About</a></li>
            <li><a href="<?= base_url('journal'); ?>">Journal</a></li>
            <li><a href="<?= base_url('#footer-cta'); ?>">Contact</a></li>
        </ul>
        <button class="nav-cta">Inquire</button>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById("main-navbar");
            if (navbar) {
                window.addEventListener("scroll", function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add("scrolled");
                    } else {
                        navbar.classList.remove("scrolled");
                    }
                });
            }
        });
    </script>