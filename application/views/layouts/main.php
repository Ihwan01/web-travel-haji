<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Nuansa Rindu' ?></title>

    <!-- SEO Meta -->
    <meta name="description" content="Nuansa Rindu — Perjalanan spiritual Umroh yang dirancang untuk menenangkan hati dan memperkaya jiwa.">
    <meta property="og:title" content="<?= isset($title) ? htmlspecialchars($title) : 'Nuansa Rindu' ?>">
    <meta property="og:type" content="website">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= $assets_url ?>css/global.css">
    <link rel="stylesheet" href="<?= $assets_url ?>css/navbar.css">
    <link rel="stylesheet" href="<?= $assets_url ?>css/footer.css">
    <link rel="stylesheet" href="<?= $assets_url ?>css/<?= isset($page) ? $page : 'home' ?>.css">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/Logo.png') ?>" />
</head>
<body class="page-<?= isset($page) ? $page : 'home' ?>">

    <!-- NAVBAR -->
    <?php $this->load->view('partials/navbar'); ?>

    <!-- MAIN CONTENT -->
    <main>
        <?php $this->load->view($content_view); ?>
    </main>

    <!-- FOOTER -->
    <?php $this->load->view('partials/footer'); ?>

    <!-- Global JS -->
    <script src="<?= $assets_url ?>js/main.js"></script>

</body>
</html>