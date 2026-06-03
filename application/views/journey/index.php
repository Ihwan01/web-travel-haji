<!-- ══════════════════════════════════════════════════════
     JOURNEY — index.php
     ══════════════════════════════════════════════════════ -->

<!-- ── PAGE HERO ──────────────────────────────────────── -->
<div class="page-hero">
    <div class="page-hero-bg">
        <img src="<?= $assets_url ?>uploads/journals/70396676c20915fc9ab5f92c99deaebb.jpg" alt="Journey Hero">
    </div>
    <div class="page-hero-content">
        <span class="page-hero-label">Signature Journey</span>
        <h1 class="page-hero-title">
            Pilih perjalanan yang<br>
            sesuai dengan hati Anda.
        </h1>
    </div>
</div>

<!-- ── JOURNEY LISTING ────────────────────────────────── -->
<section class="journey-index">
    <div class="journey-intro reveal">
        <p class="section-label">Curated Experience</p>
        <h2 class="display-heading" style="font-size:clamp(1.8rem,3vw,2.6rem); line-height:1.2; margin-bottom:0;">
            Setiap perjalanan kami<br>rancang seperti sebuah karya.
        </h2>
        <p>Bukan paket wisata biasa. Ini adalah pengalaman spiritual yang dikurasi dengan penuh perhatian — dari akomodasi, pembimbingan, hingga momen-momen yang akan Anda kenang seumur hidup.</p>
    </div>

    <?php
    // Group packages by collection type
    $collections = ['Classic' => [], 'Signature' => [], 'Private' => [], 'Sacred' => []];
    if (!empty($packages)) {
        foreach ($packages as $pkg) {
            $type = $pkg->collection_type;
            if (isset($collections[$type])) {
                $collections[$type][] = $pkg;
            }
        }
    }

    // Deskripsi statis per koleksi (pengganti field description yang tidak ada)
    $collection_desc = [
        'Classic'   => 'Paket umroh reguler yang dirancang dengan penuh perhatian untuk memberikan ketenangan dan kenyamanan dalam setiap langkah perjalanan menuju Baitullah.',
        'Signature' => 'Pengalaman umroh premium dengan akomodasi bintang 5 pilihan, pembimbingan personal, dan dokumentasi sinematik eksklusif yang tak terlupakan.',
        'Private'   => 'Perjalanan umroh privat yang sepenuhnya disesuaikan dengan kebutuhan Anda. Jadwal fleksibel, layanan concierge personal, dan pengalaman tak tertandingi.',
        'Sacred'    => 'Program haji kami dirancang untuk memastikan setiap jamaah menjalani ibadah dengan khusyuk, nyaman, dan penuh makna spiritual yang mendalam.',
    ];

    // Placeholder data jika DB kosong
    if (empty($packages)) {
        $placeholders = [
            (object)['id'=>1,'name'=>'Rindu Classic','slug'=>'rindu-classic','collection_type'=>'Classic',
                'tagline'=>'Perjalanan penuh ketenangan','price_display'=>'Hubungi Kami','main_image'=>null],
            (object)['id'=>2,'name'=>'Rindu Signature','slug'=>'rindu-signature','collection_type'=>'Signature',
                'tagline'=>'Pengalaman premium tak terlupakan','price_display'=>'Hubungi Kami','main_image'=>null],
            (object)['id'=>3,'name'=>'Rindu Private','slug'=>'rindu-private','collection_type'=>'Private',
                'tagline'=>'Dirancang khusus untuk Anda','price_display'=>'Custom','main_image'=>null],
            (object)['id'=>4,'name'=>'Sacred Journey','slug'=>'sacred-journey','collection_type'=>'Sacred',
                'tagline'=>'Perjalanan haji yang bermakna','price_display'=>'Hubungi Kami','main_image'=>null],
        ];
        foreach ($placeholders as $ph) {
            $collections[$ph->collection_type][] = $ph;
        }
    }

    $collection_names = [
        'Classic'   => 'Rindu Classic',
        'Signature' => 'Rindu Signature',
        'Private'   => 'Rindu Private',
        'Sacred'    => 'Sacred Journey',
    ];
    $bg_map = [
        'Classic'   => 'pkg-bg-classic',
        'Signature' => 'pkg-bg-signature',
        'Private'   => 'pkg-bg-private',
        'Sacred'    => 'pkg-bg-sacred',
    ];

    foreach ($collections as $type => $items):
        if (empty($items)) continue;
    ?>
    <div class="collection-group reveal">
        <div class="collection-label"><?= $collection_names[$type] ?></div>
        <?php foreach ($items as $pkg): ?>
        <a href="<?= base_url('journey/' . $pkg->slug) ?>" class="pkg-card">
            <!-- Visual -->
            <div class="pkg-card-visual">
                <?php if ($pkg->main_image): ?>
                    <img class="pkg-card-img" src="<?= base_url('assets/uploads/packages/' . $pkg->main_image) ?>" alt="<?= htmlspecialchars($pkg->name) ?>">
                <?php else: ?>
                    <div class="pkg-card-img <?= $bg_map[$type] ?>"></div>
                <?php endif; ?>
                <div class="pkg-card-visual-overlay"></div>
            </div>
            <!-- Info -->
            <div class="pkg-card-info">
                <span class="pkg-card-collection">Rindu <?= htmlspecialchars($type) ?></span>
                <h2 class="pkg-card-name"><?= htmlspecialchars($pkg->name) ?></h2>
                <?php if ($pkg->tagline): ?>
                <p class="pkg-card-tagline"><?= htmlspecialchars($pkg->tagline) ?></p>
                <?php endif; ?>
                <!-- Deskripsi statis per koleksi, tidak bergantung field DB -->
                <p class="pkg-card-desc"><?= $collection_desc[$type] ?></p>
                <?php if ($pkg->price_display): ?>
                <div class="pkg-card-price">
                    <?= htmlspecialchars($pkg->price_display) ?>
                    <small>/ jamaah</small>
                </div>
                <?php endif; ?>
                <span class="arrow-link">Lihat Detail</span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</section>