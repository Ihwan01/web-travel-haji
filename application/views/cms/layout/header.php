<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Nuansa Rindu CMS'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/cms-style.css'); ?>">
</head>

<body>

    <nav class="navbar navbar-luxury d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-4">
            <div class="navbar-brand serif-font mb-0">Nuansa Rindu CMS</div>

            <div class="d-none d-md-flex gap-3" style="font-size: 0.9rem;">
                <a href="<?= base_url('cms/dashboard') ?>" class="text-decoration-none" style="color: var(--text-dark);">Dasbor</a>

                <?php if (isset($role_id) && in_array($role_id, [1, 2])): ?>
                    <a href="#" class="text-decoration-none" style="color: var(--text-dark);">Kelola Paket</a>
                <?php endif; ?>

                <?php if (isset($role_id) && $role_id == 1): ?>
                    <a href="#" class="text-decoration-none" style="color: var(--text-dark);">Pengaturan SEO</a>
                <?php endif; ?>
            </div>
        </div>

        <a href="<?= base_url('logout') ?>" class="btn-outline-luxury" style="font-size: 0.85rem; letter-spacing: 1px;">KELUAR</a>
    </nav>