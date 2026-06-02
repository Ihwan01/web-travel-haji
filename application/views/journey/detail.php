<div class="journey-detail">
    <div class="detail-hero" style="margin-top:var(--nav-h);">
        <?php if ($package->main_image): ?>
            <img class="detail-hero-img" src="<?= base_url($package->main_image) ?>" alt="<?= htmlspecialchars($package->name) ?>">
        <?php else: ?>
            <?php
            $bg_map = ['Classic'=>'pkg-bg-classic','Signature'=>'pkg-bg-signature','Private'=>'pkg-bg-private','Sacred'=>'pkg-bg-sacred'];
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

            <?php
            $collection_desc = [
                'Classic'   => 'Paket umroh reguler yang dirancang dengan penuh perhatian — memberikan ketenangan dan kenyamanan dalam setiap langkah perjalanan Anda menuju Baitullah.',
                'Signature' => 'Pengalaman umroh premium dengan akomodasi bintang 5 pilihan, pembimbingan personal, dan dokumentasi sinematik eksklusif yang tak terlupakan.',
                'Private'   => 'Perjalanan umroh privat yang sepenuhnya disesuaikan dengan kebutuhan Anda. Jadwal fleksibel, layanan concierge personal, dan pengalaman tak tertandingi.',
                'Sacred'    => 'Program haji kami dirancang untuk memastikan setiap jamaah menjalani ibadah haji dengan khusyuk, nyaman, dan penuh makna spiritual yang mendalam.',
            ];
            $desc = isset($collection_desc[$package->collection_type]) ? $collection_desc[$package->collection_type] : '';
            ?>
            <?php if ($desc): ?>
            <div style="background:linear-gradient(135deg, rgba(196,163,90,0.08) 0%, rgba(196,163,90,0.03) 100%); border-left:3px solid var(--gold); border-radius:0 8px 8px 0; padding:20px 24px; margin-bottom:36px;">
                <h3 style="margin-top:0; margin-bottom:10px;">Tentang Perjalanan Ini</h3>
                <p style="margin:0; color:var(--muted); line-height:1.8; font-size:0.92rem;"><?= htmlspecialchars($desc) ?></p>
            </div>
            <?php endif; ?>

            <?php if ($package->itinerary): ?>
            <h3>Itinerary</h3>
            <div class="detail-itinerary">
                <?php
                $lines = explode("\n", trim($package->itinerary));
                foreach ($lines as $line):
                    $line = trim($line);
                    if ($line): ?>
                    <p><?= strip_tags($line) ?></p>
                <?php endif; endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($package->hotel_details): ?>
            <h3>Akomodasi & Hotel</h3>
            <?php
            $lines = explode("\n", trim($package->hotel_details));
            foreach ($lines as $line):
                $line = trim($line);
                if ($line): ?>
                <p><?= strip_tags($line) ?></p>
            <?php endif; endforeach; ?>
            <?php endif; ?>

            <h3>Yang Kami Siapkan</h3>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px 40px; margin-bottom:12px;">
                <?php
                $includes = [
                    'Akomodasi eksklusif di Mekkah & Madinah',
                    'Transportasi AC full selama perjalanan',
                    'Pembimbing ibadah profesional bersertifikat',
                    'Konsumsi 3x sehari berkualitas',
                    'Seragam jamaah Nuansa Rindu',
                    'Dokumentasi sinematik perjalanan',
                    'Perlengkapan travel essentials eksklusif',
                    'Handling bagasi & airport assistance',
                ];
                foreach ($includes as $inc): ?>
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <span style="color:var(--gold); margin-top:2px; flex-shrink:0;">✦</span>
                    <span style="font-size:0.82rem; color:var(--muted); line-height:1.6;"><?= $inc ?></span>
                </div>
                <?php endforeach; ?>
            </div>

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
                $wa_num = '628xxxxxxxxxx'; // Silakan ganti dengan nomor WhatsApp aktif Anda
                $wa_msg = urlencode('Assalamu\'alaikum, saya ingin mengetahui lebih lanjut tentang ' . $package->name . ' dari Nuansa Rindu.');
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
                        ['Koleksi', 'Rindu ' . $package->collection_type],
                        ['Durasi', '10 – 14 Hari'],
                        ['Keberangkatan', 'Tersedia sepanjang tahun'],
                        ['Kapasitas', 'Terbatas per keberangkatan'],
                    ];
                    foreach ($details as $d): ?>
                    <div style="display:flex; justify-content:space-between; align-items:baseline; padding-bottom:12px; border-bottom:1px solid rgba(196,163,90,0.1);">
                        <span style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted);"><?= $d[0] ?></span>
                        <span style="font-size:0.82rem; color:var(--brown);"><?= $d[1] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>