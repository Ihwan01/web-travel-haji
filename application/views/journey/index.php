<!-- ══════════════════════════════════════════════════════
     JOURNEY — index.php
     ══════════════════════════════════════════════════════ -->

<!-- ── PAGE HERO ──────────────────────────────────────── -->
<div class="page-hero">
    <div class="page-hero-bg">
        <img src="<?= $assets_url ?>images/hero/journey-hero.jpg" alt="Journey Hero">
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

    // Placeholder data jika DB kosong
    if (empty($packages)) {
        $placeholders = [
            (object)['id'=>1,'name'=>'Rindu Classic','slug'=>'rindu-classic','collection_type'=>'Classic',
                'tagline'=>'Perjalanan penuh ketenangan','description'=>'Paket umroh reguler yang dirancang dengan penuh perhatian untuk memberikan ketenangan dan kenyamanan dalam setiap langkah perjalanan Anda menuju Baitullah.','price_display'=>'Hubungi Kami','main_image'=>null],
            (object)['id'=>2,'name'=>'Rindu Signature','slug'=>'rindu-signature','collection_type'=>'Signature',
                'tagline'=>'Pengalaman premium tak terlupakan','description'=>'Paket umroh premium dengan akomodasi bintang 5 pilihan, pembimbingan personal, dan dokumentasi sinematik eksklusif untuk setiap jamaah.','price_display'=>'Hubungi Kami','main_image'=>null],
            (object)['id'=>3,'name'=>'Rindu Private','slug'=>'rindu-private','collection_type'=>'Private',
                'tagline'=>'Dirancang khusus untuk Anda','description'=>'Perjalanan umroh privat yang sepenuhnya disesuaikan dengan kebutuhan dan keinginan Anda. Jadwal fleksibel, layanan concierge personal, dan pengalaman tak tertandingi.','price_display'=>'Custom','main_image'=>null],
            (object)['id'=>4,'name'=>'Sacred Journey','slug'=>'sacred-journey','collection_type'=>'Sacred',
                'tagline'=>'Perjalanan haji yang bermakna','description'=>'Program haji kami dirancang untuk memastikan setiap jamaah menjalani ibadah haji dengan khusyuk, nyaman, dan penuh makna spiritual yang mendalam.','price_display'=>'Hubungi Kami','main_image'=>null],
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
                    <img class="pkg-card-img" src="<?= base_url($pkg->main_image) ?>" alt="<?= htmlspecialchars($pkg->name) ?>">
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
                <?php if ($pkg->description): ?>
                <p class="pkg-card-desc"><?= htmlspecialchars(substr($pkg->description, 0, 220)) ?>...</p>
                <?php endif; ?>
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
