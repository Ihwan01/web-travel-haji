<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800" style="font-family: 'Playfair Display', serif;">Selamat Datang, <?= htmlspecialchars($admin_user) ?>!</h1>
        <p class="text-muted mt-1">Ini adalah ringkasan aktivitas dan data pada website Nuansa Rindu.</p>
    </div>
</div>

<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-left: 4px solid #dc3545 !important;">
        <i class="fas fa-exclamation-circle me-2"></i> <?= $this->session->flashdata('error_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">

    <?php if (isset($total_journeys)): ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2" style="border-left: 4px solid var(--gold) !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--gold); letter-spacing: 1px;">Paket Perjalanan</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_journeys ?></div>
                        </div>
                        <div class="col-auto text-muted opacity-50">
                            <i class="fas fa-route fa-2x"></i>
                        </div>
                    </div>
                    <a href="<?= base_url('journeys') ?>" class="text-decoration-none mt-3 d-block small text-muted">Kelola Paket &rarr;</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($total_leads)): ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2" style="border-left: 4px solid #1cc88a !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="letter-spacing: 1px;">Konsultasi Masuk</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_leads ?></div>
                        </div>
                        <div class="col-auto text-muted opacity-50">
                            <i class="fas fa-envelope fa-2x"></i>
                        </div>
                    </div>
                    <a href="<?= base_url('leads') ?>" class="text-decoration-none mt-3 d-block small text-muted">Lihat Pesan &rarr;</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($total_journals)): ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2" style="border-left: 4px solid #36b9cc !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="letter-spacing: 1px;">Artikel / Jurnal Tayang</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_journals ?></div>
                        </div>
                        <div class="col-auto text-muted opacity-50">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>
                    </div>
                    <a href="<?= base_url('journals') ?>" class="text-decoration-none mt-3 d-block small text-muted">Kelola Artikel &rarr;</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($total_galleries)): ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2" style="border-left: 4px solid #f6c23e !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="letter-spacing: 1px;">Media Galeri</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_galleries ?></div>
                        </div>
                        <div class="col-auto text-muted opacity-50">
                            <i class="fas fa-images fa-2x"></i>
                        </div>
                    </div>
                    <a href="<?= base_url('galleries') ?>" class="text-decoration-none mt-3 d-block small text-muted">Kelola Galeri &rarr;</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5 text-center">
                <i class="fas fa-mosque fa-4x mb-4" style="color: var(--gold); opacity: 0.8;"></i>
                <h4 class="mb-3" style="font-family: 'Playfair Display', serif;">Panel Kontrol Utama Nuansa Rindu</h4>
                <p class="text-muted w-75 mx-auto">
                    Gunakan bilah navigasi di sebelah kiri untuk mengelola konten website Anda. Sistem ini telah dilengkapi dengan proteksi hak akses, sehingga Anda hanya dapat melihat dan memodifikasi modul yang telah diizinkan untuk peran akun Anda.
                </p>
                <?php if ($role_id == 1): ?>
                    <div class="mt-4 pt-3 border-top w-50 mx-auto">
                        <a href="<?= base_url('homepage_settings') ?>" class="btn btn-outline-dark btn-sm mx-1"><i class="fas fa-cog me-1"></i> Pengaturan Web</a>
                        <a href="<?= base_url('seo') ?>" class="btn btn-outline-dark btn-sm mx-1"><i class="fas fa-search me-1"></i> Pengaturan SEO</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>