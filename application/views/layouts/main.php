<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // --- LOGIKA FALLBACK METADATA ---
    $final_title = !empty($seo_meta->meta_title) ? $seo_meta->meta_title : (isset($title) ? $title : 'Nuansa Rindu — Perjalanan Hati');
    $final_desc = !empty($seo_meta->meta_description) ? $seo_meta->meta_description : 'Nuansa Rindu — Perjalanan spiritual Umroh yang dirancang untuk menenangkan hati dan memperkaya jiwa.';
    $final_keywords = !empty($seo_meta->meta_keywords) ? $seo_meta->meta_keywords : 'umroh premium, travel umroh jakarta, haji furoda, nuansa rindu, umroh luxury';
    ?>

    <title><?= htmlspecialchars($final_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($final_desc) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($final_keywords) ?>">

    <meta property="og:title" content="<?= htmlspecialchars($final_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($final_desc) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:site_name" content="Nuansa Rindu">

    <?php if (!empty($tracking->gsc_code)): ?>
        <meta name="google-site-verification" content="<?= htmlspecialchars($tracking->gsc_code) ?>" />
    <?php endif; ?>

    <?php if (!empty($tracking->ga4_code)): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($tracking->ga4_code) ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '<?= htmlspecialchars($tracking->ga4_code) ?>');
        </script>
    <?php endif; ?>

    <?php if (!empty($tracking->meta_pixel_code)): ?>
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '<?= htmlspecialchars($tracking->meta_pixel_code) ?>');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= htmlspecialchars($tracking->meta_pixel_code) ?>&ev=PageView&noscript=1" /></noscript>
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= $assets_url ?>css/global.css">
    <link rel="stylesheet" href="<?= $assets_url ?>css/navbar.css">
    <link rel="stylesheet" href="<?= $assets_url ?>css/footer.css">
    <link rel="stylesheet" href="<?= $assets_url ?>css/<?= isset($page) ? $page : 'home' ?>.css">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/Logo.png') ?>" />
</head>

<body class="page-<?= isset($page) ? $page : 'home' ?>">

    <?php $this->load->view('partials/navbar'); ?>

    <main>
        <?php $this->load->view($content_view); ?>
    </main>

    <?php $this->load->view('partials/footer'); ?>

    <script src="<?= $assets_url ?>js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById("navbar");
            const toggle = document.getElementById("navToggle");
            const navList = document.querySelector(".nav-links");

            if (toggle && navList && navbar) {
                // Menyamakan transisi tombol hamburger dengan gaya background gelap
                toggle.addEventListener("click", function() {
                    // Beri class "active" pada toggle untuk animasi ikon "X"
                    toggle.classList.toggle("active");

                    // Beri class tambahan untuk mengubah background navbar jadi seragam saat menu turun
                    if (navList.classList.contains("open")) {
                        navbar.classList.add("menu-open");
                    } else {
                        navbar.classList.remove("menu-open");
                    }
                });
            }
        });
    </script>
</body>

</html>