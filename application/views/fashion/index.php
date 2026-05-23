<!-- ══════════════════════════════════════════════════════
     FASHION & ESSENTIALS — index.php
     ══════════════════════════════════════════════════════ -->

<div class="fashion-page">

    <!-- ── HERO ───────────────────────────────────────── -->
    <section class="fashion-hero">
        <div class="fashion-hero-bg">
            <img src="<?= $assets_url ?>images/fashion/fashion-hero.jpg" alt="Fashion Identity">
        </div>
        <div class="fashion-hero-content">
            <span class="fashion-hero-label">Fashion & Essentials</span>
            <h1 class="fashion-hero-title">
                Berpakaian dengan<br>
                <em>makna dan keanggunan.</em>
            </h1>
            <p class="fashion-hero-desc">
                Setiap helai kain yang kami pilih bukan hanya soal penampilan. Ini tentang identitas, kesadaran, dan rasa syukur seorang tamu Allah.
            </p>
        </div>
    </section>

    <!-- ── INTRO ───────────────────────────────────────── -->
    <section class="fashion-intro">
        <div class="fashion-intro-text reveal">
            <p class="section-label">Fashion Identity</p>
            <h2>Seragam bukan sekadar<br>seragam.</h2>
            <p>
                Di Nuansa Rindu, kami percaya bahwa penampilan adalah bagian dari ibadah. Setiap detail seragam jamaah kami dirancang dengan penuh perhatian — dari pemilihan kain, potongan, warna, hingga aksesoris yang melengkapi.
            </p>
            <p>
                Kami berkolaborasi dengan desainer modest fashion terpilih untuk memastikan bahwa setiap jamaah tampil dengan anggun, nyaman, dan penuh makna sepanjang perjalanan suci mereka.
            </p>
            <a href="<?= base_url('contact') ?>" class="arrow-link" style="margin-top:12px;">Tanya Ketersediaan</a>
        </div>
        <div class="fashion-intro-visual reveal delay-2">
            <div class="fi-cell">
                <div class="fi-img fi-bg-1"></div>
            </div>
            <div class="fi-cell">
                <div class="fi-img fi-bg-2"></div>
            </div>
            <div class="fi-cell">
                <div class="fi-img fi-bg-3"></div>
            </div>
        </div>
    </section>

    <!-- ── COLLECTION ──────────────────────────────────── -->
    <section class="fashion-collection">
        <div class="collection-header reveal">
            <div>
                <p class="section-label">Koleksi Seragam</p>
                <h2>Dirancang untuk<br>perjalanan yang bermakna.</h2>
            </div>
            <a href="<?= base_url('contact') ?>" class="arrow-link">Pesan Sekarang</a>
        </div>

        <?php
        // Data items
        if (!empty($items)) {
            $campaign_items = $items;
        } else {
            $campaign_items = [
                (object)['name'=>'Outer Premium','description'=>'Kain premium linen campuran','slug'=>'outer-premium','image_gallery'=>null],
                (object)['name'=>'Set Muslimah','description'=>'Potongan elegan & nyaman','slug'=>'set-muslimah','image_gallery'=>null],
                (object)['name'=>'Set Ikhwan','description'=>'Bahan breathable anti-wrinkle','slug'=>'set-ikhwan','image_gallery'=>null],
            ];
        }
        $fc_bgs = ['fc-bg-1','fc-bg-2','fc-bg-3','fc-bg-4','fc-bg-5','fc-bg-6','fc-bg-7'];
        ?>

        <!-- Campaign grid row 1 -->
        <div class="fashion-campaign reveal">
            <?php foreach (array_slice($campaign_items, 0, 3) as $idx => $item):
                $images = [];
                if ($item->image_gallery) $images = json_decode($item->image_gallery, true);
                $main_img = !empty($images) ? $images[0] : null;
            ?>
            <div class="fc-item">
                <?php if ($main_img): ?>
                    <img class="fc-img" src="<?= base_url($main_img) ?>" alt="<?= htmlspecialchars($item->name) ?>">
                <?php else: ?>
                    <div class="fc-img <?= $fc_bgs[$idx] ?>"></div>
                <?php endif; ?>
                <div class="fc-overlay">
                    <p class="fc-item-name"><?= htmlspecialchars($item->name) ?></p>
                    <?php if ($item->description): ?>
                    <p class="fc-item-detail"><?= htmlspecialchars($item->description) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Campaign grid row 2 (squares) -->
        <?php if (count($campaign_items) > 3): ?>
        <div class="fc-item-row2 reveal">
            <?php foreach (array_slice($campaign_items, 3, 4) as $idx => $item):
                $images = [];
                if ($item->image_gallery) $images = json_decode($item->image_gallery, true);
                $main_img = !empty($images) ? $images[0] : null;
            ?>
            <div class="fc-item">
                <?php if ($main_img): ?>
                    <img class="fc-img" src="<?= base_url($main_img) ?>" alt="<?= htmlspecialchars($item->name) ?>">
                <?php else: ?>
                    <div class="fc-img <?= $fc_bgs[($idx + 3) % count($fc_bgs)] ?>"></div>
                <?php endif; ?>
                <div class="fc-overlay">
                    <p class="fc-item-name"><?= htmlspecialchars($item->name) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- Filler jika kurang dari 4 item di row 2 -->
            <?php
            $row2_count = min(count($campaign_items) - 3, 4);
            for ($f = $row2_count; $f < 4; $f++):
            ?>
            <div class="fc-item">
                <div class="fc-img <?= $fc_bgs[($f + 3) % count($fc_bgs)] ?>"></div>
            </div>
            <?php endfor; ?>
        </div>
        <?php else: ?>
        <!-- Placeholder row 2 jika items < 4 -->
        <div class="fc-item-row2 reveal">
            <?php for ($f = 0; $f < 4; $f++): ?>
            <div class="fc-item">
                <div class="fc-img <?= $fc_bgs[($f + 3) % count($fc_bgs)] ?>"></div>
            </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </section>

    <!-- ── TRAVEL ESSENTIALS ───────────────────────────── -->
    <section class="fashion-essentials">
        <div class="essentials-header reveal">
            <div>
                <p class="section-label">Travel Essentials</p>
                <h2>Detail kecil yang<br>membuat perjalanan terasa istimewa.</h2>
            </div>
            <p style="font-size:0.84rem; color:var(--muted); line-height:1.9; max-width:380px;">
                Setiap perlengkapan perjalanan kami kurasi dengan standar estetika yang tinggi — bukan hanya fungsional, tapi juga menjadi bagian dari pengalaman yang tak terlupakan.
            </p>
        </div>

        <div class="essentials-items reveal">
            <?php
            $essentials = [
                ['Passport Holder',  'Kulit premium hand-stitched',  'ess-bg-1'],
                ['Luggage Tag',      'Brass & genuine leather',      'ess-bg-2'],
                ['Tote Bag',         'Kanvas tebal, sablon eksklusif','ess-bg-3'],
                ['Prayer Pouch',     'Linen premium dengan bordir',   'ess-bg-4'],
                ['Airport Outfit',   'Travel wear full set',          'ess-bg-5'],
            ];
            foreach ($essentials as $ess): ?>
            <div class="ess-item">
                <div class="ess-img <?= $ess[2] ?>"></div>
                <div class="ess-info">
                    <p class="ess-name"><?= $ess[0] ?></p>
                    <p class="ess-detail"><?= $ess[1] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top:56px; text-align:center;">
            <p style="font-family:var(--font-display); font-size:1.2rem; font-style:italic; color:var(--muted); margin-bottom:28px; line-height:1.5;">
                "Karena setiap detail dalam perjalanan suci ini layak untuk diperhatikan."
            </p>
            <a href="<?= base_url('contact') ?>" class="btn-outline dark">Konsultasi Perlengkapan</a>
        </div>
    </section>

</div>
