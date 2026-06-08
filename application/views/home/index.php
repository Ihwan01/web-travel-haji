<?php
/* ================================================================================
KODE LAMA (DYNAMIC SLIDESHOW DARI DATABASE) DISEMBUNYIKAN SEBAGAI COMMENT
================================================================================
$set = $site_settings;
$is_slideshow = $set->is_slideshow ?? 0;
$use_slider = ($is_slideshow == 1 && count($hero_slides) > 1);
$display_slides = $use_slider ? $hero_slides : (!empty($hero_slides) ? [$hero_slides[0]] : []);
... (looping slide dari db) ...
================================================================================
*/
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<section class="hero-custom-slider" id="homeHero">

    <div class="custom-slide active">
        <div class="hero-video-wrap">
            <img src="<?= base_url('assets/images/slide1_Hero_Homepage.png') ?>" alt="Perjalanan hati, pulang membawa makna." style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="hero-content">
            <h1 class="hero-title">Perjalanan hati,<br>pulang membawa <em>makna.</em></h1>
            <p class="hero-desc">Nuansa Rindu hadir untuk menemani perjalanan spiritual Anda dengan ketenangan, kenyamanan, dan makna yang mendalam.</p>
            <div class="hero-actions">
                <a href="<?= base_url('journey') ?>" class="arrow-link light">EXPLORE JOURNEY</a>
            </div>
        </div>
    </div>

    <div class="custom-slide">
        <div class="hero-video-wrap">
            <img src="<?= base_url('assets/images/slide2_Hero_Homepage.png') ?>" alt="Lebih dari perjalanan, ini tentang pulang." style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="hero-content">
            <h1 class="hero-title">Lebih dari perjalanan,<br>ini tentang <em>pulang.</em></h1>
            <p class="hero-desc">Kami believe setiap langkah menuju Baitullah adalah rindu yang menemukan jalan pulang. Sebuah pengalaman spiritual yang dirancang untuk menenangkan hati dan memperkaya jiwa.</p>
            <div class="hero-actions">
                <a href="<?= base_url('about') ?>" class="arrow-link light">ABOUT US</a>
            </div>
        </div>
    </div>

    <div class="custom-slide">
        <div class="hero-video-wrap">
            <img src="<?= base_url('assets/images/slide3_Hero_Homepage.png') ?>" alt="Menyentuh tanah suci, merengkuh ketenangan." style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="hero-content">
            <h1 class="hero-title">Menyentuh tanah suci,<br>merengkuh <em>ketenangan.</em></h1>
            <p class="hero-desc">Setiap detail perjalanan Anda dikurasi secara personal. Memadukan keanggunan gaya hidup spiritual dengan pelayanan eksklusif, membiarkan Anda luruh sepenuhnya dalam khusyuk ibadah.</p>
            <div class="hero-actions">
                <?php $wa_msg = urlencode("Halo Nuansa Rindu, saya tertarik untuk memulai perjalanan spiritual (Begin The Journey) dan ingin berkonsultasi lebih lanjut."); ?>
                <a href="https://wa.me/6281188889326?text=<?= $wa_msg ?>" target="_blank" rel="noopener" class="arrow-link light">BEGIN THE JOURNEY</a>
            </div>
        </div>
    </div>

    <div class="hero-fraction-pagination">
        <span id="currSlide" class="nav-trigger" title="Geser ke Slide Sebelumnya">01</span>
        <span class="pagination-line"></span>
        <span id="totalSlide" class="nav-trigger" title="Geser ke Slide Selanjutnya">03</span>
    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderContainer = document.getElementById('homeHero');
        const slides = document.querySelectorAll('.custom-slide');
        const currSlideText = document.getElementById('currSlide');
        const totalSlideText = document.getElementById('totalSlide');

        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            slides[index].classList.add('active');
            currentSlide = index;

            if (currSlideText) {
                currSlideText.innerText = '0' + (index + 1);
            }
        }

        function nextSlide() {
            let next = (currentSlide + 1) % slides.length;
            showSlide(next);
        }

        function prevSlide() {
            let prev = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prev);
        }

        function startSlideShow() {
            slideInterval = setInterval(nextSlide, 8000);
        }

        function resetSlideShow() {
            clearInterval(slideInterval);
            startSlideShow();
        }

        if (currSlideText && totalSlideText) {
            currSlideText.addEventListener('click', function() {
                prevSlide();
                resetSlideShow();
            });

            totalSlideText.addEventListener('click', function() {
                nextSlide();
                resetSlideShow();
            });
        }

        let touchStartX = 0;
        let touchEndX = 0;

        sliderContainer.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, {
            passive: true
        });

        sliderContainer.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, {
            passive: true
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                nextSlide();
                resetSlideShow();
            }
            if (touchEndX > touchStartX + swipeThreshold) {
                prevSlide();
                resetSlideShow();
            }
        }

        startSlideShow();
    });
</script>

<section class="about-section" id="about">
    <div class="about-grid">

        <div class="about-text-side reveal">
            <div class="about-subtitle">
                TENTANG NUANSA RINDU <span class="subtitle-line"></span>
            </div>

            <h2 class="about-title">
                <?= $site_settings->about_title ?? "Lebih dari perjalanan,<br>ini tentang pulang." ?>
            </h2>

            <div class="about-desc">
                <p>Kami percaya setiap langkah menuju Baitullah adalah rindu yang menemukan jalan pulang.</p>
                <p>Nuansa Rindu bukan sekadar perjalanan, tapi pengalaman spiritual yang dirancang untuk menenangkan hati dan memperkaya jiwa.</p>
            </div>

            <a href="<?= base_url('about') ?>" class="about-link">
                ABOUT US
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="1" fill="none">
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <polyline points="14 6 20 12 14 18"></polyline>
                </svg>
            </a>
        </div>

        <div class="about-visual-side reveal delay-1">
            <?php
            $video_link = !empty($site_settings->about_media) ? $site_settings->about_media : 'https://youtu.be/D6FRezJF3rU?si=Pb4_jlicHrHTLQOU';
            $thumbnail = !empty($site_settings->about_video_thumbnail) ? base_url($site_settings->about_video_thumbnail) : base_url('assets/images/nuansa-rindu-about-thumbnail.webp');
            ?>

            <div id="embed-about-vid" style="display: none;">
                <?= function_exists('generate_video_embed') ? generate_video_embed($video_link) : '' ?>
            </div>

            <div class="about-video-wrap glightbox" data-href="#embed-about-vid" data-gallery="about-video" data-glightbox="title: Tentang Nuansa Rindu; type: inline;">
                <?php if ($thumbnail): ?>
                    <img src="<?= $thumbnail ?>" alt="Tentang Nuansa Rindu" class="about-video-img">
                <?php else: ?>
                    <div class="about-video-img fallback-bg"></div>
                <?php endif; ?>

                <div class="play-btn-overlay">
                    <div class="play-btn-circle">
                        <svg viewBox="0 0 24 24">
                            <polygon points="9,6 18,12 9,18" />
                        </svg>
                    </div>
                    <span class="play-btn-text">PLAY OUR STORY</span>
                </div>
            </div>
        </div>

    </div>
</section>

<?php if (isset($show_journey) && $show_journey): ?>
    <section class="journey-section" id="journey">
        <div class="journey-header">
            <div class="reveal">
                <p class="section-label">Signature Journey</p>
                <h2 class="display-heading" style="font-size:clamp(2rem,3.5vw,3rem); max-width:320px; line-height:1.2;">
                    Pilih perjalanan yang<br>sesuai dengan hati Anda.
                </h2>
            </div>
            <div class="journey-nav-wrapper reveal">
                <a href="<?= base_url('journey') ?>" class="arrow-link">View All Journey</a>
            </div>
        </div>

        <div class="journey-slider-wrapper reveal">
            <button class="slider-btn prev-btn" id="journeyPrev" aria-label="Geser Kiri">
                <svg viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="1.5" fill="none" />
                </svg>
            </button>

            <div class="journey-cards" id="journeySlider">
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
                <?php endif; ?>
            </div>

            <button class="slider-btn next-btn" id="journeyNext" aria-label="Geser Kanan">
                <svg viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="1.5" fill="none" />
                </svg>
            </button>
        </div>
    </section>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('journeySlider');
        const prevBtn = document.getElementById('journeyPrev');
        const nextBtn = document.getElementById('journeyNext');

        if (slider && prevBtn && nextBtn) {
            slider.style.overflowAnchor = 'none';
            let isAnimating = false;

            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (isAnimating || slider.scrollWidth <= slider.clientWidth + 10) return;
                isAnimating = true;

                const firstCard = slider.firstElementChild;
                const cardWidth = firstCard.offsetWidth + 3;

                slider.scrollBy({
                    left: cardWidth,
                    behavior: 'smooth'
                });

                setTimeout(() => {
                    slider.appendChild(firstCard);
                    slider.scrollLeft -= cardWidth;
                    isAnimating = false;
                }, 450);
            });

            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (isAnimating || slider.scrollWidth <= slider.clientWidth + 10) return;
                isAnimating = true;

                const lastCard = slider.lastElementChild;
                const firstCard = slider.firstElementChild;
                const cardWidth = firstCard.offsetWidth + 3;

                slider.prepend(lastCard);
                slider.scrollLeft += cardWidth;
                slider.getBoundingClientRect();

                slider.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });

                setTimeout(() => {
                    isAnimating = false;
                }, 450);
            });
        }
    });
</script>

<section class="visual-story" id="experience">
    <p class="section-label reveal">Visual Story</p>
    <h2 class="vs-heading reveal">Momen yang terasa,<br>bukan sekadar terlihat.</h2>

    <div class="vs-masonry-container reveal">
        <div class="vs-masonry">
            <?php if (!empty($latest_media)): ?>
                <?php
                // Memastikan maksimal hanya 5 item yang dirender untuk tata letak Homepage
                $media_list = array_slice($latest_media, 0, 5);
                $item_count = 0;
                ?>

                <?php foreach ($media_list as $m): ?>
                    <?php
                    $item_count++;
                    // Jika item adalah urutan ke-4 atau ke-5, berikan class khusus agar disembunyikan di layar HP
                    $mobile_hide_class = ($item_count > 3) ? 'hide-on-mobile' : '';
                    ?>

                    <?php if ($m->media_type === 'Video'): ?>
                        <div id="embed-home-<?= $m->id ?>" style="display: none;">
                            <?= function_exists('generate_video_embed') ? generate_video_embed($m->file_url) : '' ?>
                        </div>

                        <a href="#embed-home-<?= $m->id ?>" class="vs-item glightbox <?= $mobile_hide_class ?>" data-gallery="visual-story" data-glightbox="title: <?= htmlspecialchars($m->title) ?>; type: inline;">
                            <img src="<?= base_url($m->thumbnail_url ?: 'assets/images/nuansa-rindu-about-thumbnail.webp') ?>" alt="<?= htmlspecialchars($m->title) ?>" class="vs-img">
                            <div class="vs-overlay">
                                <div class="vs-play-btn">
                                    <svg viewBox="0 0 24 24">
                                        <polygon points="7,4 19,12 7,20" />
                                    </svg>
                                </div>
                            </div>
                            <div class="vs-title-overlay">
                                <span class="vs-item-badge">Film</span>
                                <h3 class="vs-item-title"><?= htmlspecialchars($m->title) ?></h3>
                            </div>
                        </a>

                    <?php else: ?>
                        <a href="<?= base_url($m->file_url) ?>" class="vs-item glightbox <?= $mobile_hide_class ?>" data-gallery="visual-story" data-glightbox="title: <?= htmlspecialchars($m->title) ?>; type: image;">
                            <img src="<?= base_url($m->file_url) ?>" alt="<?= htmlspecialchars($m->title) ?>" class="vs-img">
                            <div class="vs-overlay"></div>
                            <div class="vs-title-overlay">
                                <h3 class="vs-item-title"><?= htmlspecialchars($m->title) ?></h3>
                            </div>
                        </a>
                    <?php endif; ?>
                    
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: var(--muted); grid-column: 1 / -1; text-align: center; font-style: italic; width: 100%;">
                    Belum ada visual story yang ditambahkan.
                </p>
            <?php endif; ?>
        </div>
    </div>

    <div style="margin-top:48px; text-align:center;">
        <a href="<?= base_url('gallery') ?>" class="arrow-link light" style="margin:0 auto; color: var(--gold-lt);">Lihat Semua Experience</a>
    </div>
</section>

<?php if (isset($show_fashion) && $show_fashion): ?>
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

<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof GLightbox !== 'undefined') {
            const homeLightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                zoomable: true,
                preload: false,
                descPosition: 'bottom',
                openEffect: 'zoom',
                closeEffect: 'fade',
                cssEffects: {
                    fade: {
                        in: 'fadeIn',
                        out: 'fadeOut'
                    },
                    zoom: {
                        in: 'zoomIn',
                        out: 'zoomOut'
                    }
                }
            });

            function playSlideVideo(slideNode) {
                if (!slideNode) return;
                const iframes = slideNode.querySelectorAll('iframe.nr-lazy-iframe');
                iframes.forEach(iframe => {
                    const realSrc = iframe.getAttribute('data-src');
                    if (realSrc && iframe.getAttribute('src') !== realSrc) {
                        iframe.setAttribute('src', realSrc);
                    }
                });

                const localVideos = slideNode.querySelectorAll('video');
                localVideos.forEach(vid => {
                    vid.play().catch(e => console.log("Autoplay tertahan browser"));
                });

                if (slideNode.querySelector('.tiktok-embed') || slideNode.innerHTML.includes('tiktok.com')) {
                    const oldScript = document.getElementById('tiktok-script-dinamis');
                    if (oldScript) oldScript.remove();

                    const script = document.createElement('script');
                    script.id = 'tiktok-script-dinamis';
                    script.src = 'https://www.tiktok.com/embed.js';
                    script.async = true;
                    document.body.appendChild(script);
                }
            }

            function stopSlideVideo(slideNode) {
                if (!slideNode) return;
                const iframes = slideNode.querySelectorAll('iframe.nr-lazy-iframe');
                iframes.forEach(iframe => {
                    iframe.removeAttribute('src');
                });

                const localVideos = slideNode.querySelectorAll('video');
                localVideos.forEach(vid => {
                    vid.pause();
                    vid.currentTime = 0;
                });
            }

            homeLightbox.on('slide_after_load', (data) => {
                const slide = data.slideNode || data.slide;
                if (slide && slide.classList.contains('current')) {
                    playSlideVideo(slide);
                }
            });

            homeLightbox.on('slide_changed', ({
                prev,
                current
            }) => {
                if (prev) {
                    const prevSlide = prev.slideNode || prev.slide;
                    stopSlideVideo(prevSlide);
                }
                if (current) {
                    const currentSlide = current.slideNode || current.slide;
                    playSlideVideo(currentSlide);
                }
            });

            homeLightbox.on('slide_before_close', (data) => {
                const slide = data.slideNode || data.slide;
                stopSlideVideo(slide);
            });
        }
    });
</script>