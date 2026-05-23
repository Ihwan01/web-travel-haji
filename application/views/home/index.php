<!-- ══════════════════════════════════════════════════════
     HOME — index.php
     ══════════════════════════════════════════════════════ -->

<!-- ── HERO ───────────────────────────────────────────── -->
<section class="hero">
    <div class="hero-video-wrap" id="heroWrap">
        <!--
            Letakkan file video di assets/images/hero/hero.mp4
            Gunakan slow-motion: desert light, flowing fabric, jamaah berjalan
        -->
        <video id="heroVideo" autoplay muted loop playsinline poster="<?= $assets_url ?>images/hero/hero-poster.jpg">
            <source src="<?= $assets_url ?>images/hero/hero.mp4" type="video/mp4">
        </video>
    </div>

    <div class="hero-content">
        <p class="hero-tag">Nuansa Rindu · Umrah & Spiritual Journey</p>
        <h1 class="hero-title">
            Perjalanan hati,<br>
            pulang membawa<br>
            <em>makna.</em>
        </h1>
        <p class="hero-desc">
            Nuansa Rindu hadir untuk menemani perjalanan spiritual Anda dengan ketenangan, kenyamanan, dan makna yang mendalam.
        </p>
        <div class="hero-actions">
            <a href="<?= base_url('journey') ?>" class="arrow-link light">Explore Journey</a>
            <a href="<?= base_url('contact') ?>" class="btn-outline light">Begin The Journey</a>
        </div>
    </div>

    <div class="hero-scroll">Scroll</div>

    <div class="hero-dots-wrap">
        <span class="hero-dot active"></span>
        <span class="hero-dot"></span>
        <span class="hero-dot"></span>
    </div>
</section>

<!-- ── MENGAPA NUANSA RINDU ────────────────────────────── -->
<section class="why-section">
    <p class="section-label reveal">Mengapa Memilih Nuansa Rindu</p>

    <div class="why-grid">
        <div class="reveal">
            <h2 class="why-intro-heading">
                Lebih dari perjalanan,<br>
                ini tentang<br>
                <em style="font-style:italic; color:var(--gold);">pulang.</em>
            </h2>
            <p class="why-intro-text">
                Setiap detail kami rancang bukan untuk memenuhi itinerary, tetapi untuk merawat hati Anda sepanjang perjalanan.
            </p>
        </div>

        <div class="why-items">
            <div class="why-item reveal delay-1">
                <div class="why-item-number">01</div>
                <h3 class="why-item-title">Kenyamanan Perjalanan</h3>
                <p class="why-item-desc">Akomodasi eksklusif, transportasi nyaman, dan layanan concierge yang merawat setiap kebutuhan Anda.</p>
            </div>
            <div class="why-item reveal delay-2">
                <div class="why-item-number">02</div>
                <h3 class="why-item-title">Emotional Experience</h3>
                <p class="why-item-desc">Setiap momen dirancang untuk menyentuh hati — bukan sekadar mengunjungi, tapi merasakan dan menghayati.</p>
            </div>
            <div class="why-item reveal delay-3">
                <div class="why-item-number">03</div>
                <h3 class="why-item-title">Cinematic Documentation</h3>
                <p class="why-item-desc">Perjalanan Anda diabadikan dengan pendekatan sinematik — sebuah kenangan yang layak untuk dirasakan ulang.</p>
            </div>
            <div class="why-item reveal delay-4">
                <div class="why-item-number">04</div>
                <h3 class="why-item-title">Fashion Identity</h3>
                <p class="why-item-desc">Seragam jamaah yang kami rancang bukan hanya soal penampilan, tapi tentang identitas dan keanggunan spiritual.</p>
            </div>
            <div class="why-item reveal delay-1">
                <div class="why-item-number">05</div>
                <h3 class="why-item-title">Ketenangan Ibadah</h3>
                <p class="why-item-desc">Pembimbing profesional dan jadwal yang terstruktur memberi Anda ruang untuk fokus sepenuhnya pada ibadah.</p>
            </div>
        </div>
    </div>
</section>

<!-- ── SIGNATURE JOURNEY ───────────────────────────────── -->
<section class="journey-section">
    <div class="journey-header">
        <div class="reveal">
            <p class="section-label">Signature Journey</p>
            <h2 class="display-heading" style="font-size:clamp(2rem,3.5vw,3rem); max-width:320px; line-height:1.2;">
                Pilih perjalanan yang<br>sesuai dengan hati Anda.
            </h2>
        </div>
        <a href="<?= base_url('journey') ?>" class="arrow-link reveal">View All Journey</a>
    </div>

    <div class="journey-cards reveal">
        <?php if (!empty($packages)): ?>
            <?php foreach ($packages as $pkg): ?>
            <a href="<?= base_url('journey/' . $pkg->slug) ?>" class="j-card">
                <?php if ($pkg->main_image): ?>
                    <img class="j-card-img" src="<?= base_url($pkg->main_image) ?>" alt="<?= htmlspecialchars($pkg->name) ?>">
                <?php else: ?>
                    <div class="j-card-img j-card-bg-<?= strtolower($pkg->collection_type) ?>"></div>
                <?php endif; ?>
                <div class="j-card-overlay">
                    <span class="j-card-collection">Rindu <?= htmlspecialchars($pkg->collection_type) ?></span>
                    <h3 class="j-card-name"><?= htmlspecialchars($pkg->name) ?></h3>
                    <?php if ($pkg->tagline): ?>
                    <p class="j-card-tagline"><?= htmlspecialchars($pkg->tagline) ?></p>
                    <?php endif; ?>
                    <span class="j-card-arrow"></span>
                </div>
            </a>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Placeholder cards jika DB masih kosong -->
            <?php
            $placeholders = [
                ['Classic',   'Rindu Classic',   'Umrah Regular — Perjalanan penuh ketenangan'],
                ['Signature', 'Rindu Signature', 'Umrah Premium — Pengalaman yang tak terlupakan'],
                ['Private',   'Rindu Private',   'Umrah Private — Dirancang khusus untuk Anda'],
                ['Sacred',    'Sacred Journey',  'Perjalanan Haji yang Bermakna'],
            ];
            foreach ($placeholders as $p): ?>
            <div class="j-card">
                <div class="j-card-img j-card-bg-<?= strtolower($p[0]) ?>"></div>
                <div class="j-card-overlay">
                    <span class="j-card-collection">Rindu <?= $p[0] ?></span>
                    <h3 class="j-card-name"><?= $p[1] ?></h3>
                    <p class="j-card-tagline"><?= $p[2] ?></p>
                    <span class="j-card-arrow"></span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- ── VISUAL STORY ────────────────────────────────────── -->
<section class="visual-story">
    <p class="section-label reveal">Visual Story</p>
    <h2 class="vs-heading reveal">Momen yang terasa,<br>bukan sekadar terlihat.</h2>

    <div class="vs-grid reveal">
        <!-- Item besar kiri -->
        <div class="vs-item" data-lightbox data-type="Photo" data-src="<?= $assets_url ?>images/gallery/vs-1.jpg">
            <div class="vs-img vs-bg-1"></div>
        </div>
        <div class="vs-item" data-lightbox data-type="Photo" data-src="<?= $assets_url ?>images/gallery/vs-2.jpg">
            <div class="vs-img vs-bg-2"></div>
        </div>
        <div class="vs-item" data-lightbox data-type="Photo" data-src="<?= $assets_url ?>images/gallery/vs-3.jpg">
            <div class="vs-img vs-bg-3"></div>
        </div>
        <div class="vs-item" data-lightbox data-type="Photo" data-src="<?= $assets_url ?>images/gallery/vs-4.jpg">
            <div class="vs-img vs-bg-4"></div>
        </div>
        <div class="vs-item" data-lightbox data-type="Photo" data-src="<?= $assets_url ?>images/gallery/vs-5.jpg">
            <div class="vs-img vs-bg-5"></div>
        </div>
    </div>

    <div style="margin-top:48px; text-align:center;">
        <a href="<?= base_url('gallery') ?>" class="arrow-link light" style="margin:0 auto;">Lihat Semua Film & Gallery</a>
    </div>
</section>

<!-- ── FASHION IDENTITY ────────────────────────────────── -->
<section class="fashion-section">
    <div class="fashion-header">
        <div class="reveal">
            <p class="section-label">Fashion Identity</p>
            <h2 class="display-heading" style="font-size:clamp(2rem,3.5vw,3rem); line-height:1.2;">
                Berpakaian dengan<br>makna dan keanggunan.
            </h2>
        </div>
        <a href="<?= base_url('fashion') ?>" class="arrow-link reveal">Lihat Koleksi</a>
    </div>

    <div class="fashion-strip reveal">
        <?php
        $fashion_labels = ['Seragam Jamaah', 'Travel Essentials', 'Passport Holder', 'Tote Bag', 'Outfit Details'];
        $fashion_bgs    = ['fs-bg-1','fs-bg-2','fs-bg-3','fs-bg-4','fs-bg-5'];
        for ($i = 0; $i < 5; $i++): ?>
        <div class="fs-item">
            <div class="fs-img <?= $fashion_bgs[$i] ?>"></div>
            <div class="fs-overlay">
                <p class="fs-name"><?= $fashion_labels[$i] ?></p>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</section>

<!-- ── JOURNAL ─────────────────────────────────────────── -->
<section class="journal-section">
    <div class="journal-header">
        <div class="reveal">
            <p class="section-label">Journal</p>
            <h2 class="display-heading" style="font-size:clamp(2rem,3.5vw,3rem); line-height:1.2;">
                Catatan perjalanan,<br>cerita hati.
            </h2>
        </div>
        <a href="<?= base_url('journal') ?>" class="arrow-link reveal">Explore Journal</a>
    </div>

    <div class="journal-cards reveal">
        <?php if (!empty($journals)): ?>
            <?php foreach ($journals as $idx => $jn): ?>
            <a href="<?= base_url('journal/' . $jn->slug) ?>" class="jn-card">
                <?php if ($jn->main_image): ?>
                    <img class="jn-card-img" src="<?= base_url($jn->main_image) ?>" alt="<?= htmlspecialchars($jn->title) ?>">
                <?php else: ?>
                    <div class="jn-card-img jn-bg-<?= ($idx % 3) + 1 ?>"></div>
                <?php endif; ?>
                <div class="jn-card-overlay">
                    <span class="jn-card-date"><?= date('d M Y', strtotime($jn->created_at)) ?></span>
                    <h3 class="jn-card-title"><?= htmlspecialchars($jn->title) ?></h3>
                    <span class="arrow-link light" style="font-size:0.6rem;">Baca Selengkapnya</span>
                </div>
            </a>
            <?php endforeach; ?>
        <?php else: ?>
            <?php
            $dummy_journals = [
                ['Ketika rindu menuntun langkah', 'jn-bg-1'],
                ['Pulang bukanlah akhir, tapi awal', 'jn-bg-2'],
                ['Mengapa perjalanan ini begitu bermakna?', 'jn-bg-3'],
            ];
            foreach ($dummy_journals as $dj): ?>
            <div class="jn-card">
                <div class="jn-card-img <?= $dj[1] ?>"></div>
                <div class="jn-card-overlay">
                    <h3 class="jn-card-title"><?= $dj[0] ?></h3>
                    <span class="arrow-link light" style="font-size:0.6rem;">Baca Selengkapnya</span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
