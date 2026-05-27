<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Nuansa Rindu CMS'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/cms-style.css?v=' . time()); ?>">

    <style>
        body {
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        /* WRAPPER UTAMA */
        #cms-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* SIDEBAR KIRI (Terkunci / Fixed) */
        #cms-sidebar {
            width: 260px;
            background-color: #1a1c24;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        /* NAV LINKS DI SIDEBAR */
        #cms-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            margin-bottom: 4px;
            padding: 12px 16px;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        #cms-sidebar .nav-link:hover,
        #cms-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        #cms-sidebar .nav-link.active {
            border-left: 4px solid var(--gold, #d4af37);
            font-weight: 600;
        }

        /* KONTEN KANAN (Dinamis) */
        #cms-content-wrapper {
            flex-grow: 1;
            margin-left: 260px;
            /* Lebar sidebar */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - 260px);
        }

        /* TOPBAR (Header Putih di Atas Konten) */
        #cms-topbar {
            height: 70px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            z-index: 999;
        }

        /* AREA KONTEN UTAMA HALAMAN */
        #cms-main {
            padding: 30px;
            flex-grow: 1;
        }
    </style>
</head>

<body>

    <div id="cms-wrapper">

        <?php $this->load->view('cms/layout/navbar'); ?>

        <div id="cms-content-wrapper">

            <div id="cms-topbar">
                <span class="fw-bold text-secondary">
                    <i class="fas fa-user-circle me-2 fs-5 align-middle"></i>
                    <span class="align-middle">Halo, <?= htmlspecialchars($admin_user ?? 'Admin') ?></span>
                </span>
            </div>

            <div id="cms-main">
                <div class="container-fluid px-0">