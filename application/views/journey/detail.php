<div class="journey-detail">
    <!-- Inline style margin-top dihapus agar gambar naik penuh ke atas -->
    <div class="detail-hero">
        <?php if ($package->main_image): ?>
            <img class="detail-hero-img" src="<?= base_url('assets/uploads/packages/' . $package->main_image) ?>" alt="<?= htmlspecialchars($package->name) ?>">
        <?php else: ?>
            <?php
            $bg_map = ['Classic' => 'pkg-bg-classic', 'Signature' => 'pkg-bg-signature', 'Private' => 'pkg-bg-private', 'Sacred' => 'pkg-bg-sacred'];
            $bg = isset($bg_map[$package->collection_type]) ? $bg_map[$package->collection_type] : 'pkg-bg-classic';
            ?>
            <div class="detail-hero-img <?= $bg ?>"></div>
        <?php endif; ?>
        <div class="detail-hero-overlay">
            <span class="detail-collection">Rindu <?= htmlspecialchars($package->collection_type) ?></span>
            <h1 class="detail-title"><?= htmlspecialchars($package->name) ?></h1>
        </div>
    </div>

    <div class="detail-body">
        <div class="detail-main">
            <?php if ($package->tagline): ?>
                <p style="font-family:var(--font-display); font-size:1.3rem; font-style:italic; color:var(--muted); margin-bottom:32px; line-height:1.5;">
                    "<?= htmlspecialchars($package->tagline) ?>"
                </p>
            <?php endif; ?>

            <!-- [DIPERBAIKI] Render HTML langsung untuk Tentang Perjalanan Ini -->
            <?php if (!empty(trim(strip_tags($package->itinerary)))): ?>
                <div style="background:linear-gradient(135deg, rgba(196,163,90,0.08) 0%, rgba(196,163,90,0.03) 100%); border-left:3px solid var(--gold); border-radius:0 8px 8px 0; padding:20px 24px; margin-bottom:36px;">
                    <h3 style="margin-top:0; margin-bottom:10px;">Tentang Perjalanan Ini</h3>
                    <div class="wysiwyg-content" style="margin:0; color:var(--muted); line-height:1.8; font-size:0.92rem;">
                        <!-- Langsung di-echo karena berasal dari Rich Text Editor (sudah mengandung <p>) -->
                        <?= $package->itinerary ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- [DIPERBAIKI] Render HTML bawaan CMS & Styling otomatis untuk List "Yang Kami Siapkan" -->
            <?php if (!empty(trim(strip_tags($package->hotel_details)))): ?>
                <h3>Yang Kami Siapkan</h3>

                <style>
                    /* Styling khusus untuk format List bawaan CMS agar menjadi 2 Kolom & Mewah */
                    .wysiwyg-content p:last-child {
                        margin-bottom: 0;
                    }

                    .detail-includes-content ul,
                    .detail-includes-content ol {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 16px 40px;
                        list-style-type: none;
                        /* Menghilangkan titik default bawaan CMS */
                        padding: 0;
                        margin: 0 0 12px 0;
                    }

                    .detail-includes-content ul li,
                    .detail-includes-content ol li {
                        position: relative;
                        padding-left: 20px;
                        font-size: 0.82rem;
                        color: var(--muted);
                        line-height: 1.6;
                    }

                    /* Custom Ikon Diamond/Bintang */
                    .detail-includes-content ul li::before,
                    .detail-includes-content ol li::before {
                        content: "✦";
                        position: absolute;
                        left: 0;
                        top: 0;
                        color: var(--gold);
                    }

                    /* Styling teks tebal (bold) dari CMS */
                    .detail-includes-content strong,
                    .detail-includes-content b {
                        color: var(--brown);
                        font-weight: 600;
                    }

                    @media (max-width: 768px) {

                        .detail-includes-content ul,
                        .detail-includes-content ol {
                            grid-template-columns: 1fr;
                            /* Jadi 1 kolom di HP */
                        }
                    }
                </style>

                <div class="detail-includes-content mb-4">
                    <!-- Echo struktur HTML bawaan CMS -->
                    <?= $package->hotel_details ?>
                </div>
            <?php endif; ?>

            <div style="margin-top:56px; padding-top:40px; border-top:1px solid rgba(196,163,90,0.15);">
                <a href="<?= base_url('journey') ?>" style="font-size:0.65rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); text-decoration:none;">
                    ← Kembali ke Journey
                </a>
            </div>
        </div>

        <div class="detail-sidebar">
            <div class="sidebar-card">
                <div class="sidebar-card-title">Mulai Perjalanan Anda</div>
                <?php if ($package->price_display): ?>
                    <div class="sidebar-price"><?= htmlspecialchars($package->price_display) ?></div>
                    <p class="sidebar-price-note">Harga per jamaah · belum termasuk visa</p>
                <?php endif; ?>

                <a href="<?= base_url('contact') ?>?package=<?= urlencode($package->name) ?>" class="sidebar-cta">
                    Konsultasi Sekarang
                </a>

                <?php
                $wa_num = '6281188889326';
                $wa_msg = urlencode("Assalamu'alaikum Nuansa Rindu, saya ingin mengetahui lebih lanjut mengenai detail perjalanan: *" . $package->name . "* (Koleksi Rindu " . $package->collection_type . ").");
                ?>
                <a href="https://wa.me/<?= $wa_num ?>?text=<?= $wa_msg ?>" class="sidebar-cta outline" target="_blank" rel="noopener">
                    WhatsApp Kami
                </a>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-card-title">Detail Perjalanan</div>
                <div style="display:flex; flex-direction:column; gap:14px;">
                    <?php
                    $details = [
                        ['Koleksi', 'Rindu ' . htmlspecialchars($package->collection_type)],
                        ['Durasi', !empty($package->duration) ? htmlspecialchars($package->duration) : '-'],
                        ['Keberangkatan', !empty($package->departure) ? htmlspecialchars($package->departure) : '-'],
                        ['Kapasitas', !empty($package->capacity) ? htmlspecialchars($package->capacity) . ' Jamaah' : '-'],
                    ];

                    foreach ($details as $d): ?>
                        <div style="display:flex; justify-content:space-between; align-items:baseline; padding-bottom:12px; border-bottom:1px solid rgba(196,163,90,0.1);">
                            <span style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted);"><?= $d[0] ?></span>
                            <span style="font-size:0.82rem; color:var(--brown); text-align:right; max-width:60%;"><?= $d[1] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>