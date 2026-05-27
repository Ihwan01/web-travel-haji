<?php
// Persiapan Variabel Dinamis dari tabel homepage_settings
$set = $site_settings;
$is_slideshow = $set->is_slideshow ?? 0;
?>

<?php if ($is_slideshow && count($hero_slides) > 1): ?>

    <section class="hero hero-carousel" data-autoplay="<?= $set->slideshow_autoplay ?? 1 ?>">
        <div class="swiper-wrapper">
            <?php foreach ($hero_slides as $slide):
                $is_link = (strpos($slide->media_url, 'http') === 0);
            ?>
                <div class="swiper-slide hero-slide-item" style="position: relative; width: 100%; height: 100vh;">
                    <div class="hero-video-wrap">
                        <?php if ($slide->media_type == 'Video'): ?>
                            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover;">
                                <source src="<?= $is_link ? $slide->media_url : base_url($slide->media_url) ?>" type="video/mp4">
                            </video>
                        <?php else: ?>
                            <img src="<?= $is_link ? $slide->media_url : base_url($slide->media_url) ?>" class="hero-img-bg" alt="Hero Banner" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>
                    </div>

                    <div class="hero-content">
                        <?php if (!empty($slide->tagline)): ?>
                            <p class="hero-tag"><?= htmlspecialchars($slide->tagline) ?></p>
                        <?php endif; ?>

                        <h1 class="hero-title"><?= $slide->title ?></h1>

                        <?php if (!empty($slide->desc_text)): ?>
                            <p class="hero-desc"><?= htmlspecialchars($slide->desc_text) ?></p>
                        <?php endif; ?>

                        <div class="hero-actions">
                            <?php if (!empty($slide->btn1_text)): ?>
                                <a href="<?= base_url($slide->btn1_url) ?>" class="arrow-link light"><?= htmlspecialchars($slide->btn1_text) ?></a>
                            <?php endif; ?>
                            <?php if (!empty($slide->btn2_text)): ?>
                                <a href="<?= base_url($slide->btn2_url) ?>" class="btn-outline light"><?= htmlspecialchars($slide->btn2_text) ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="hero-slider-nav">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <div class="hero-dots-wrap swiper-pagination"></div>

        <div class="hero-scroll">Scroll</div>
    </section>

<?php else: ?>

    <?php
    // Tarik 1 slide saja
    $slide = !empty($hero_slides) ? $hero_slides[0] : null;
    if ($slide):
        $is_link = (strpos($slide->media_url, 'http') === 0);
    ?>
        <section class="hero hero-static">
            <div class="hero-video-wrap" id="heroWrap">
                <?php if ($slide->media_type == 'Video'): ?>
                    <video id="heroVideo" autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover;">
                        <source src="<?= $is_link ? $slide->media_url : base_url($slide->media_url) ?>" type="video/mp4">
                    </video>
                <?php else: ?>
                    <img src="<?= $is_link ? $slide->media_url : base_url($slide->media_url) ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="Hero Banner">
                <?php endif; ?>
            </div>

            <div class="hero-content">
                <?php if (!empty($slide->tagline)): ?>
                    <p class="hero-tag"><?= htmlspecialchars($slide->tagline) ?></p>
                <?php endif; ?>

                <h1 class="hero-title"><?= $slide->title ?></h1>

                <?php if (!empty($slide->desc_text)): ?>
                    <p class="hero-desc"><?= htmlspecialchars($slide->desc_text) ?></p>
                <?php endif; ?>

                <div class="hero-actions">
                    <?php if (!empty($slide->btn1_text)): ?>
                        <a href="<?= base_url($slide->btn1_url) ?>" class="arrow-link light"><?= htmlspecialchars($slide->btn1_text) ?></a>
                    <?php endif; ?>
                    <?php if (!empty($slide->btn2_text)): ?>
                        <a href="<?= base_url($slide->btn2_url) ?>" class="btn-outline light"><?= htmlspecialchars($slide->btn2_text) ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="hero-scroll">Scroll</div>
        </section>
    <?php endif; ?>

<?php endif; ?>

<section class="why-section" id="about">
    <p class="section-label reveal">Mengapa Memilih Nuansa Rindu</p>

    <div class="why-grid">
        <div class="reveal">
            <h2 class="why-intro-heading">
                <?= $set->about_title ?? "Lebih dari perjalanan,<br>ini tentang<br><em style=\"font-style:italic; color:var(--gold);\">pulang.</em>" ?>
            </h2>
            <p class="why-intro-text mb-4">
                <?= htmlspecialchars($set->about_desc ?? 'Setiap detail kami rancang bukan untuk memenuhi itinerary, tetapi untuk merawat hati Anda sepanjang perjalanan.') ?>
            </p>

            <?php if (!empty($set->about_media)):
                $is_about_link = (strpos($set->about_media, 'http') === 0);
            ?>
                <?php if ($set->about_media_type == 'Video'): ?>
                    <div class="about-media-wrapper mt-4 position-relative" style="cursor: pointer;" data-lightbox data-type="Video" data-src="<?= $set->about_media ?>">
                        <?php if (!empty($set->about_video_thumbnail)): ?>
                            <img src="<?= base_url($set->about_video_thumbnail) ?>" alt="Video Cover" class="img-fluid rounded shadow" style="width:100%; height:auto; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-dark text-white rounded d-flex align-items-center justify-content-center" style="height:250px;"><i class="fas fa-play-circle fa-3x"></i></div>
                        <?php endif; ?>
                        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="white" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));">
                                <polygon points="5,3 19,12 5,21" />
                            </svg>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="about-media-wrapper mt-4">
                        <img src="<?= $is_about_link ? $set->about_media : base_url($set->about_media) ?>" alt="Tentang Nuansa Rindu" class="img-fluid rounded shadow" style="width:100%; height:auto;">
                    </div>
                <?php endif; ?>
            <?php endif; ?>
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

<?php if ($show_journey): ?>
    <section class="journey-section" id="journey">
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
                            <img class="j-card-img" src="<?= base_url('assets/uploads/packages/' . $pkg->main_image) ?>" alt="<?= htmlspecialchars($pkg->name) ?>">
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
<?php endif; ?>

<section class="visual-story" id="experience">
    <p class="section-label reveal">Visual Story</p>
    <h2 class="vs-heading reveal">Momen yang terasa,<br>bukan sekadar terlihat.</h2>

    <div class="vs-grid reveal">
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

<?php if ($show_fashion): ?>
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
            $fashion_bgs    = ['fs-bg-1', 'fs-bg-2', 'fs-bg-3', 'fs-bg-4', 'fs-bg-5'];
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
<?php endif; ?>

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
                    <?php if ($jn->image): ?>
                        <img class="jn-card-img" src="<?= base_url('assets/uploads/journals/' . $jn->image) ?>" alt="<?= htmlspecialchars($jn->title) ?>">
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