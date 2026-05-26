<nav class="navbar navbar-luxury d-flex justify-content-between align-items-center px-4 py-3">
    <div class="d-flex align-items-center gap-4">
        <div class="navbar-brand serif-font mb-0">Nuansa Rindu CMS</div>

        <div class="d-none d-md-flex gap-3" style="font-size: 0.9rem;">
            <a href="<?= base_url('dashboard') ?>" class="text-decoration-none" style="color: var(--text-dark);">Dasbor</a>

            <?php if (isset($role_id) && in_array($role_id, [1, 2])): ?>
                <a href="<?= base_url('journeys') ?>" class="text-decoration-none" style="color: var(--text-dark);">Kelola Paket</a>
                <a href="<?= base_url('journals') ?>" class="text-decoration-none" style="color: var(--text-dark);">Kelola Artikel</a>
                <a href="<?= base_url('galleries') ?>" class="text-decoration-none" style="color: var(--text-dark);">Kelola Galeri</a>
                <a href="<?= base_url('fashions') ?>" class="text-decoration-none" style="color: var(--text-dark);">Kelola Fashion</a>
                <a href="<?= base_url('leads') ?>" class="text-decoration-none" style="color: var(--text-dark);">Konsultasi Masuk</a>
            <?php endif; ?>

            <?php if (isset($role_id) && $role_id == 1): ?>
                <a href="#" class="text-decoration-none" style="color: var(--text-dark);">Pengaturan SEO</a>
                <a href="<?= base_url('users') ?>" class="text-decoration-none" style="color: var(--text-dark);">Manajemen Pengguna</a>
            <?php endif; ?>
        </div>
    </div>

    <a href="<?= base_url('logout') ?>" class="btn-outline-luxury" style="font-size: 0.85rem; letter-spacing: 1px;">KELUAR</a>
</nav>