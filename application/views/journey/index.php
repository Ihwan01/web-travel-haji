<div class="page-hero">
    <div class="page-hero-bg">
        <img src="<?= base_url('assets/images/Hero_Journey.jpg') ?>" alt="Journey Hero">
    </div>
    <div class="page-hero-content">
        <span class="page-hero-label">Signature Journey</span>
        <h1 class="page-hero-title">
            Pilih perjalanan yang<br>
            sesuai dengan hati Anda.
        </h1>
    </div>
</div>

<section class="journey-index">
    <div class="journey-intro reveal">
        <p class="section-label">Curated Experience</p>
        <h2 class="display-heading" style="font-size:clamp(1.8rem,3vw,2.6rem); line-height:1.2; margin-bottom:0;">
            Setiap perjalanan kami<br>rancang seperti sebuah karya.
        </h2>
        <p>Bukan paket wisata biasa. Ini adalah pengalaman spiritual yang dikurasi dengan penuh perhatian — dari akomodasi, pembimbingan, hingga momen-momen yang akan Anda kenang seumur hidup.</p>
    </div>

    <div class="journey-slider-wrapper reveal" style="margin-top: 64px;">

        <?php if (!empty($packages)): ?>
            
            <button class="slider-btn prev-btn" id="journeyPrev" aria-label="Geser Kiri">
                <svg viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="1.5" fill="none" />
                </svg>
            </button>

            <div class="pkg-grid" id="journeySlider">
                <?php foreach ($packages as $pkg): ?>
                    <a href="<?= base_url('journey/' . $pkg->slug) ?>" class="pkg-card">
                        <div class="pkg-card-visual">
                            <?php if (!empty($pkg->main_image)): ?>
                                <img class="pkg-card-img" src="<?= base_url('assets/uploads/packages/' . $pkg->main_image) ?>" alt="<?= htmlspecialchars($pkg->name) ?>">
                            <?php else: ?>
                                <div class="pkg-card-img pkg-bg-<?= strtolower($pkg->collection_type) ?>"></div>
                            <?php endif; ?>
                            <div class="pkg-card-visual-overlay"></div>
                        </div>
                        <div class="pkg-card-info">
                            <span class="pkg-card-collection">Rindu <?= htmlspecialchars($pkg->collection_type) ?></span>
                            <h2 class="pkg-card-name"><?= htmlspecialchars($pkg->name) ?></h2>
                            
                            <?php if (!empty($pkg->tagline)): ?>
                                <p class="pkg-card-tagline"><?= htmlspecialchars($pkg->tagline) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($pkg->price_display)): ?>
                                <div class="pkg-card-price">
                                    <?= htmlspecialchars($pkg->price_display) ?>
                                </div>
                            <?php endif; ?>
                            
                            <span class="detail-link">Lihat Detail</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <button class="slider-btn next-btn" id="journeyNext" aria-label="Geser Kanan">
                <svg viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="1.5" fill="none" />
                </svg>
            </button>

        <?php else: ?>
            <p style="color: rgba(122, 106, 86, 0.8); text-align: center; width: 100%; font-style: italic;">
                Belum ada koleksi perjalanan yang tersedia saat ini.
            </p>
        <?php endif; ?>

    </div>

    <?php if (!empty($packages)): ?>
    <script src="<?= base_url('assets/js/home.js?v=' . time()) ?>"></script>
    <?php endif; ?>
</section>