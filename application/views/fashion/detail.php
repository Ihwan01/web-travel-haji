<div class="fashion-detail-page">

    <div class="fd-back-nav reveal">
        <a href="<?= base_url('fashion') ?>" class="arrow-link back-arrow">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Koleksi
        </a>
    </div>

    <div class="fd-container">

        <div class="fd-gallery reveal delay-1">
            <?php
            $images = [];
            if (!empty($item->image_gallery)) {
                $images = json_decode($item->image_gallery, true);
            }

            if (!empty($images)):
                foreach ($images as $img): ?>
                    <a href="<?= base_url($img) ?>" class="fd-img-wrap glightbox" data-gallery="fashion-item">
                        <img src="<?= base_url($img) ?>" alt="<?= htmlspecialchars($item->name) ?>" class="fd-img">
                    </a>
                <?php endforeach;
            else: ?>
                <div class="fd-img-wrap" style="background: linear-gradient(160deg,#C8B090,#8A7058,#4A3820); aspect-ratio: 3/4;"></div>
            <?php endif; ?>
        </div>

        <div class="fd-info-wrapper reveal delay-2">
            <div class="fd-info">
                <span class="fd-category">Exclusive Collection</span>
                <h1 class="fd-title"><?= htmlspecialchars($item->name) ?></h1>

                <?php if (!empty($item->fabric_details)): ?>
                    <p class="fd-fabric"><?= htmlspecialchars($item->fabric_details) ?></p>
                <?php endif; ?>

                <div class="fd-divider"></div>

                <div class="fd-desc">
                    <?= !empty($item->description) ? nl2br(htmlspecialchars($item->description)) : 'Deskripsi belum tersedia.' ?>
                </div>

                <div class="fd-actions">
                    <?php
                    $wa_msg = urlencode("Halo Nuansa Rindu, saya tertarik dengan koleksi fashion: *" . $item->name . "*. Boleh informasikan ketersediaan dan detail ukurannya?");
                    ?>
                    <a href="https://wa.me/6281188889326?text=<?= $wa_msg ?>" target="_blank" rel="noopener" class="fd-btn-primary">
                        Tanya Ketersediaan
                    </a>
                    <p class="fd-notes">Konsultasikan kebutuhan ukuran dan personalisasi seragam Anda secara eksklusif bersama tim kami.</p>
                </div>

            </div>
        </div>

    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>

<script src="<?= $assets_url ?>js/fashion-detail.js"></script>