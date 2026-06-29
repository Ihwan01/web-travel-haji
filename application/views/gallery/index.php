<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<div class="gallery-page">

    <div class="gallery-hero">
        <p class="section-label">Experience</p>
        <div class="gallery-hero-inner">
            <h1 class="gallery-hero-title">
                Momen yang terasa,<br>bukan sekadar terlihat.
            </h1>
            <p class="gallery-hero-sub">
                Dokumentasi sinematik perjalanan spiritual — setiap frame dirancang untuk membawa Anda kembali ke momen yang paling bermakna.
            </p>
        </div>
    </div>

    <?php
    // [PERBAIKAN] Deteksi ketersediaan jenis media
    $has_video = false;
    $has_photo = false;

    if (!empty($media)) {
        foreach ($media as $m) {
            if ($m->media_type === 'Video') $has_video = true;
            if ($m->media_type === 'Photo') $has_photo = true;

            // Hentikan loop lebih awal jika keduanya sudah ditemukan (Optimasi performa)
            if ($has_video && $has_photo) break;
        }
    }
    ?>
    <!-- [PERBAIKAN] Sembunyikan seluruh filter jika tidak ada media sama sekali -->
    <?php if (!empty($media)): ?>
        <div class="gallery-filter">
            <!-- Tab 'Semua' akan selalu muncul jika ada minimal 1 media -->
            <button class="filter-tab active" data-filter="all">Semua Experience</button>

            <!-- Tab Videography hanya muncul jika $has_video bernilai true -->
            <?php if ($has_video): ?>
                <button class="filter-tab" data-filter="Video">Videography</button>
            <?php endif; ?>

            <!-- Tab Photography hanya muncul jika $has_photo bernilai true -->
            <?php if ($has_photo): ?>
                <button class="filter-tab" data-filter="Photo">Photography</button>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="luxury-gallery-container reveal">
        <div class="luxury-masonry" id="luxuryMasonry">

            <?php if (!empty($media)): ?>
                <?php foreach ($media as $m): ?>

                    <?php if ($m->media_type === 'Video'): ?>
                        <div id="embed-vid-<?= $m->id ?>" style="display: none;">
                            <?= function_exists('generate_video_embed') ? generate_video_embed($m->file_url) : '' ?>
                        </div>

                        <a href="#embed-vid-<?= $m->id ?>" class="luxury-item glightbox" data-category="Video" data-glightbox="title: <?= htmlspecialchars($m->title) ?>; type: inline;">
                            <img src="<?= base_url($m->thumbnail_url ?: 'assets/images/nuansa-rindu-about-thumbnail.webp') ?>" alt="<?= htmlspecialchars($m->title) ?>" class="luxury-img">
                            <div class="luxury-overlay">
                                <div class="luxury-play-btn">
                                    <svg viewBox="0 0 24 24">
                                        <polygon points="7,4 19,12 7,20" />
                                    </svg>
                                </div>
                            </div>
                            <div class="luxury-title-overlay">
                                <span class="luxury-item-badge">Film</span>
                                <h3 class="luxury-item-title"><?= htmlspecialchars($m->title) ?></h3>
                            </div>
                        </a>

                    <?php else: ?>
                        <a href="<?= base_url($m->file_url) ?>" class="luxury-item glightbox" data-category="Photo" data-glightbox="title: <?= htmlspecialchars($m->title) ?>; type: image;">
                            <img src="<?= base_url($m->file_url) ?>" alt="<?= htmlspecialchars($m->title) ?>" class="luxury-img">
                            <div class="luxury-overlay"></div>
                            <div class="luxury-title-overlay">
                                <h3 class="luxury-item-title"><?= htmlspecialchars($m->title) ?></h3>
                            </div>
                        </a>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: #f5f0e8; text-align: center; width: 100%; grid-column: 1 / -1; margin-top: 40px; opacity: 0.6;">
                    Belum ada experience yang ditambahkan.
                </p>
            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script src="<?= base_url('assets/js/gallery.js?v=' . time()) ?>"></script>