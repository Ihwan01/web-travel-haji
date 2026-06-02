<nav id="cms-sidebar" class="d-flex flex-column">
    <div class="p-4 border-bottom border-secondary border-opacity-25 text-center">
        <span class="fs-4 serif-font fw-bold" style="color: #d4af37; letter-spacing:1px;">CMS RINDU</span>
    </div>

    <ul class="nav flex-column mb-auto mt-3">
        <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'active' : '' ?>">
                <i class="fas fa-fw fa-tachometer-alt me-3"></i> Dasbor
            </a>
        </li>

        <li class="nav-item mt-4 mb-2 px-3 text-uppercase text-white-50" style="font-size: 0.7rem; letter-spacing: 2px;">Menu Utama</li>

        <?php
        $menus = [
            'journeys'  => ['icon' => 'fa-route', 'label' => 'Paket Perjalanan'],
            'journals'  => ['icon' => 'fa-book-open', 'label' => 'Artikel Jurnal'],
            'galleries' => ['icon' => 'fa-images', 'label' => 'Galeri Media'],
            'fashions'  => ['icon' => 'fa-tshirt', 'label' => 'Perlengkapan'],
            'leads'     => ['icon' => 'fa-envelope', 'label' => 'Konsultasi']
        ];

        // Loop menu dan cek apakah allowed_modules mengandung key menu tersebut
        foreach ($menus as $mod_key => $mod_data):
            if (isset($allowed_modules) && in_array($mod_key, $allowed_modules)):
        ?>
                <li class="nav-item">
                    <a href="<?= base_url($mod_key) ?>" class="nav-link <?= ($this->uri->segment(1) == $mod_key) ? 'active' : '' ?>">
                        <i class="fas fa-fw <?= $mod_data['icon'] ?> me-3"></i> <?= $mod_data['label'] ?>
                    </a>
                </li>
        <?php endif;
        endforeach; ?>

        <li class="nav-item mt-4 mb-2 px-3 text-uppercase text-white-50" style="font-size: 0.7rem; letter-spacing: 2px;">Akun Saya</li>
        <li class="nav-item">
            <a href="<?= base_url('profile') ?>" class="nav-link <?= ($this->uri->segment(1) == 'profile') ? 'active' : '' ?>">
                <i class="fas fa-fw fa-user-circle me-3"></i> Profil Saya
            </a>
        </li>

        <?php if (isset($role_id) && $role_id == 1): ?>
            <li class="nav-item mt-4 mb-2 px-3 text-uppercase text-white-50" style="font-size: 0.7rem; letter-spacing: 2px;">Sistem Web</li>
            <li class="nav-item">
                <a href="<?= base_url('homepage_settings') ?>" class="nav-link <?= ($this->uri->segment(1) == 'homepage_settings') ? 'active' : '' ?>">
                    <i class="fas fa-fw fa-home me-3"></i> Setelan Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('seo') ?>" class="nav-link <?= ($this->uri->segment(1) == 'seo') ? 'active' : '' ?>">
                    <i class="fas fa-fw fa-search me-3"></i> Setelan SEO
                </a>
            </li>

            <?php /* --- [MODIFIKASI] MENU KONTAK DISEMBUNYIKAN SEMENTARA --- ?>
            <li class="nav-item">
                <a href="<?= base_url('company') ?>" class="nav-link <?= ($this->uri->segment(1) == 'company') ? 'active' : '' ?>">
                    <i class="fas fa-fw fa-building me-3"></i> Profil & Kontak
                </a>
            </li>
            <?php -------------------------------------------------------- */ ?>

            <li class="nav-item">
                <a href="<?= base_url('users') ?>" class="nav-link <?= ($this->uri->segment(1) == 'users') ? 'active' : '' ?>">
                    <i class="fas fa-fw fa-users me-3"></i> Pengguna
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>