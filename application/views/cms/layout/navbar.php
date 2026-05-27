<div id="cms-sidebar" class="d-flex flex-column p-3">
    <a href="<?= base_url('dashboard') ?>" class="d-flex align-items-center mb-4 mt-2 text-white text-decoration-none px-2">
        <span class="fs-4 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--gold, #d4af37);">Nuansa Rindu</span>
    </a>

    <hr class="text-secondary mt-0">

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'active' : '' ?>">
                <i class="fas fa-fw fa-tachometer-alt me-2"></i> Dasbor
            </a>
        </li>
        <li class="nav-item mt-3 mb-1 px-3 text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Menu Konten</li>

        <?php
        $menus = [
            'journeys'  => ['icon' => 'fa-route', 'label' => 'Kelola Paket'],
            'journals'  => ['icon' => 'fa-book-open', 'label' => 'Kelola Artikel'],
            'galleries' => ['icon' => 'fa-images', 'label' => 'Kelola Galeri'],
            'fashions'  => ['icon' => 'fa-tshirt', 'label' => 'Kelola Fashion'],
            'leads'     => ['icon' => 'fa-envelope', 'label' => 'Konsultasi Masuk']
        ];
        foreach ($menus as $mod_key => $mod_data):
            if (isset($allowed_modules) && in_array($mod_key, $allowed_modules)):
        ?>
                <li class="nav-item">
                    <a href="<?= base_url($mod_key) ?>" class="nav-link <?= ($this->uri->segment(1) == $mod_key) ? 'active' : '' ?>">
                        <i class="fas fa-fw <?= $mod_data['icon'] ?> me-2"></i> <?= $mod_data['label'] ?>
                    </a>
                </li>
        <?php endif;
        endforeach; ?>

        <?php if (isset($role_id) && $role_id == 1): ?>
            <li class="nav-item mt-4 mb-1 px-3 text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Sistem & Web</li>
            <li class="nav-item">
                <a href="<?= base_url('homepage_settings') ?>" class="nav-link <?= ($this->uri->segment(1) == 'homepage_settings') ? 'active' : '' ?>">
                    <i class="fas fa-fw fa-home me-2"></i> Setelan Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('seo') ?>" class="nav-link <?= ($this->uri->segment(1) == 'seo') ? 'active' : '' ?>">
                    <i class="fas fa-fw fa-search me-2"></i> Pengaturan SEO
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('users') ?>" class="nav-link <?= ($this->uri->segment(1) == 'users') ? 'active' : '' ?>">
                    <i class="fas fa-fw fa-users me-2"></i> Manajemen Pengguna
                </a>
            </li>
        <?php endif; ?>
    </ul>

    <hr class="text-secondary mt-4">
    <div class="px-2 pb-2">
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-light w-100 btn-sm py-2" style="border-radius: 8px;">
            <i class="fas fa-sign-out-alt me-2"></i> KELUAR
        </a>
    </div>
</div>