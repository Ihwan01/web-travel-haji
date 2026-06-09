<div class="fashion-page" style="padding-top: 0;">

    <section class="fashion-hero">
        <div class="fashion-hero-bg">
            <img src="<?= $assets_url ?>images/fashion-hero.png" alt="Fashion Identity">
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
                <img class="fi-img" src="<?= base_url('assets/images/Fashion_Identity_1.jpg') ?>" alt="Fashion Identity 1">
            </div>
            <div class="fi-cell">
                <img class="fi-img" src="<?= base_url('assets/images/Fashion_Identity_2.jpg') ?>" alt="Fashion Identity 2">
            </div>
            <div class="fi-cell">
                <img class="fi-img" src="<?= base_url('assets/images/Fashion_Identity_3.jpg') ?>" alt="Fashion Identity 3">
            </div>
        </div>
    </section>

    <section class="fashion-essentials">
        <div class="essentials-header reveal">
            <div>
                <p class="section-label">Travel Essentials</p>
                <h2>Detail kecil yang<br>membuat perjalanan terasa istimewa.</h2>
            </div>
            <div class="essentials-header-right">
                <p style="font-size:0.84rem; color:var(--muted); line-height:1.9; max-width:380px; margin-bottom: 20px;">
                    Setiap perlengkapan perjalanan kami kurasi dengan standar estetika yang tinggi — bukan hanya fungsional, tapi juga menjadi bagian dari pengalaman yang tak terlupakan.
                </p>
            </div>
        </div>

        <div class="essentials-slider-wrapper reveal">
            <button class="ess-btn prev-btn" id="essPrev" aria-label="Geser Kiri">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="ess-btn next-btn" id="essNext" aria-label="Geser Kanan">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="essentials-items" id="essSlider">
                <?php if (!empty($items)): ?>
                    <?php
                    $ess_bgs = ['ess-bg-1', 'ess-bg-2', 'ess-bg-3', 'ess-bg-4', 'ess-bg-5'];
                    foreach ($items as $idx => $item):
                        $images = [];
                        if (!empty($item->image_gallery)) {
                            $images = json_decode($item->image_gallery, true);
                        }
                        $main_img = !empty($images) ? $images[0] : null;
                    ?>
                        <div class="ess-item">
                            <?php if ($main_img): ?>
                                <img class="ess-img" src="<?= base_url($main_img) ?>" alt="<?= htmlspecialchars($item->name) ?>">
                            <?php else: ?>
                                <div class="ess-img <?= $ess_bgs[$idx % 5] ?>"></div>
                            <?php endif; ?>

                            <div class="ess-info">
                                <p class="ess-name"><?= htmlspecialchars($item->name) ?></p>
                                <p class="ess-detail"><?= htmlspecialchars($item->fabric_details ?? '') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: var(--muted);">Koleksi belum tersedia saat ini.</p>
                <?php endif; ?>
            </div>
        </div>

        <div style="margin-top:56px; text-align:center;">
            <p style="font-family:var(--font-display); font-size:1.2rem; font-style:italic; color:var(--muted); margin-bottom:28px; line-height:1.5;">
                "Karena setiap detail dalam perjalanan suci ini layak untuk diperhatikan."
            </p>
            <a href="<?= base_url('contact') ?>" class="btn-outline dark">Konsultasi Perlengkapan</a>
        </div>
    </section>

</div>

<script src="<?= $assets_url ?>js/fashion.js"></script>