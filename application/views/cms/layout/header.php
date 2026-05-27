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
        /* CSS LAYOUT INTI - Flexbox Sidebar & Main Content */
        html,
        body {
            height: 100%;
            margin: 0;
            overflow-x: hidden;
            background-color: var(--soft-cream, #f9f8f6);
        }

        #cms-app {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* SIDEBAR KIRI */
        #cms-sidebar {
            width: 260px;
            min-width: 260px;
            background-color: #1a1c24;
            color: #fff;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            z-index: 1050;
            transition: all 0.3s;
        }

        #cms-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            padding: 12px 20px;
            border-radius: 0;
            margin-bottom: 2px;
        }

        #cms-sidebar .nav-link:hover,
        #cms-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left: 4px solid var(--gold, #d4af37);
        }

        /* AREA KONTEN KANAN */
        #cms-content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* TOPBAR / HEADER ATAS */
        #cms-topbar {
            height: 70px;
            background-color: #fff;
            border-bottom: 1px solid var(--border-light, #e5e5e5);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 999;
        }

        /* TAMPILAN PROFIL DI TOPBAR */
        .profile-btn {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
        }

        .profile-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-light);
            margin-right: 12px;
        }

        .logout-icon {
            color: #dc3545;
            font-size: 1.3rem;
            transition: 0.3s;
        }

        .logout-icon:hover {
            color: #a71d2a;
            transform: scale(1.1);
        }

        /* KONTROL RESPONSIVE MOBILE */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
        }

        #sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        @media (max-width: 992px) {
            #cms-sidebar {
                position: fixed;
                transform: translateX(-100%);
            }

            /* Sembunyikan ke kiri */
            #cms-sidebar.active {
                transform: translateX(0);
            }

            /* Muncul saat diklik */
            .mobile-toggle {
                display: block;
            }

            #sidebar-overlay.active {
                display: block;
            }

            #cms-topbar {
                padding: 0 1rem;
            }
        }
    </style>
</head>

<body>

    <div id="cms-app">

        <?php $this->load->view('cms/layout/navbar'); ?>
        <div id="sidebar-overlay"></div>

        <div id="cms-content-area">

            <header id="cms-topbar">
                <div>
                    <button class="mobile-toggle" id="btn-toggle-sidebar"><i class="fas fa-bars"></i></button>
                </div>

                <div class="d-flex align-items-center gap-4">
                    <a href="<?= base_url('profile') ?>" class="profile-btn" title="Kelola Profil Saya">
                        <?php if (!empty($profile_picture)): ?>
                            <img src="<?= base_url($profile_picture) ?>" class="profile-img" alt="Profil">
                        <?php else: ?>
                            <i class="fas fa-user-circle fs-3 me-2" style="color:var(--border-light);"></i>
                        <?php endif; ?>
                        <span class="d-none d-md-inline">Halo, <?= htmlspecialchars($admin_user) ?></span>
                    </a>

                    <a href="<?= base_url('logout') ?>" class="logout-icon" title="Keluar dari Sistem">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </header>

            <main class="p-4 flex-grow-1">