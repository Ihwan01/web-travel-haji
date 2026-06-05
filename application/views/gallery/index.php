<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<div class="gallery-page">

    <div class="gallery-hero">
        <p class="section-label">Experience</p>
        <div class="gallery-hero-inner">
            <h1 class="gallery-hero-title">
                Momen yang terasa,<br>bukan sekadar terlihat.
            </h1>
            <p class="gallery-hero-sub">
                Dokumentasi sinematik perjalanan spiritual — setiap frame dirancang untuk membawa Anda kembali ke momen yang paling bermakna.
            </p>
        </div>
    </div>

    <div class="gallery-filter">
        <button class="filter-tab active" data-filter="all">Semua Experience</button>
        <button class="filter-tab" data-filter="Video">Cinematic Film</button>
        <button class="filter-tab" data-filter="Photo">Photography</button>
    </div>

    <?php
    if (empty($media)) {
        $media = [
            (object)['id' => 1, 'title' => 'Nuansa Rindu Film', 'media_type' => 'Video', 'file_url' => 'https://www.youtube.com/watch?v=D6FRezJF3rU', 'thumbnail_url' => 'assets/images/gallery/vs-1.jpg'],
            (object)['id' => 2, 'title' => 'Visual Story 1', 'media_type' => 'Photo', 'file_url' => 'assets/images/gallery/vs-2.jpg', 'thumbnail_url' => null],
            (object)['id' => 3, 'title' => 'Visual Story 2', 'media_type' => 'Photo', 'file_url' => 'assets/images/gallery/vs-3.jpg', 'thumbnail_url' => null],
            (object)['id' => 4, 'title' => 'Perjalanan Hati', 'media_type' => 'Video', 'file_url' => 'https://www.youtube.com/watch?v=D6FRezJF3rU', 'thumbnail_url' => 'assets/images/gallery/vs-4.jpg'],
            (object)['id' => 5, 'title' => 'Visual Story 3', 'media_type' => 'Photo', 'file_url' => 'assets/images/gallery/vs-5.jpg', 'thumbnail_url' => null],
        ];
    }
    ?>

    <div class="luxury-gallery-container reveal">
        <div class="luxury-masonry" id="luxuryMasonry">

            <?php foreach ($media as $m): ?>

                <?php if ($m->media_type === 'Video'): ?>
                    <div id="embed-vid-<?= $m->id ?>" style="display: none;">
                        <?= function_exists('generate_video_embed') ? generate_video_embed($m->file_url) : '' ?>
                    </div>

                    <a href="#embed-vid-<?= $m->id ?>" class="luxury-item glightbox" data-category="Video" data-glightbox="title: <?= htmlspecialchars($m->title) ?>; type: inline;">
                        <img src="<?= base_url($m->thumbnail_url ?: 'assets/images/nuansa-rindu-about-thumbnail.webp') ?>" alt="<?= htmlspecialchars($m->title) ?>" class="luxury-img">
                        <div class="luxury-overlay">
                            <div class="luxury-play-btn">
                                <svg viewBox="0 0 24 24">
                                    <polygon points="7,4 19,12 7,20" />
                                </svg>
                            </div>
                        </div>
                        <div class="luxury-title-overlay">
                            <span class="luxury-item-badge">Film</span>
                            <h3 class="luxury-item-title"><?= htmlspecialchars($m->title) ?></h3>
                        </div>
                    </a>

                <?php else: ?>
                    <a href="<?= base_url($m->file_url) ?>" class="luxury-item glightbox" data-category="Photo" data-glightbox="title: <?= htmlspecialchars($m->title) ?>; type: image;">
                        <img src="<?= base_url($m->file_url) ?>" alt="<?= htmlspecialchars($m->title) ?>" class="luxury-img">
                        <div class="luxury-overlay"></div>
                        <div class="luxury-title-overlay">
                            <h3 class="luxury-item-title"><?= htmlspecialchars($m->title) ?></h3>
                        </div>
                    </a>
                <?php endif; ?>

            <?php endforeach; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const luxuryLightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
            zoomable: true,
            descPosition: 'bottom',
            openEffect: 'zoom',
            closeEffect: 'fade',
            cssEfects: {
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

        // [BUG FIX] Solusi Cerdas & Aman Zombie Audio GLightbox
        luxuryLightbox.on('close', () => {
            setTimeout(() => {
                // Hanya target elemen yang sedang aktif di pop-up, bukan data aslinya
                const activeContent = document.querySelector('.gslide.current .ginner-container');
                if (activeContent) {
                    const vids = activeContent.querySelectorAll('video');
                    vids.forEach(v => {
                        v.pause();
                        v.currentTime = 0;
                    });

                    const iframes = activeContent.querySelectorAll('iframe');
                    iframes.forEach(iframe => {
                        let src = iframe.src;
                        iframe.src = 'about:blank';
                        setTimeout(() => {
                            iframe.src = src; // Kembalikan nilai source-nya untuk memori
                        }, 50);
                    });
                }
            }, 400); // Eksekusi setelah transisi CSS fade-out selesai
        });

        const filterTabs = document.querySelectorAll('.filter-tab');
        const masonryItems = document.querySelectorAll('.luxury-item');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                filterTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                masonryItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        item.style.animation = 'fadeUp 0.5s ease forwards';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

    });
</script>