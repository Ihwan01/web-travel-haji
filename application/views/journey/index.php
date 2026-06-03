<div class="page-hero">
    <div class="page-hero-bg">
        <img src="<?= $assets_url ?>images/70396676c20915fc9ab5f92c99deaebb.jpg" alt="Journey Hero">
    </div>
    <div class="page-hero-content">
        <span class="page-hero-label">Signature Journey</span>
        <h1 class="page-hero-title">
            Pilih perjalanan yang<br>
            sesuai dengan hati Anda.
        </h1>
    </div>
</div>

<section class="journey-index">
    <div class="journey-intro reveal">
        <p class="section-label">Curated Experience</p>
        <h2 class="display-heading" style="font-size:clamp(1.8rem,3vw,2.6rem); line-height:1.2; margin-bottom:0;">
            Setiap perjalanan kami<br>rancang seperti sebuah karya.
        </h2>
        <p>Bukan paket wisata biasa. Ini adalah pengalaman spiritual yang dikurasi dengan penuh perhatian — dari akomodasi, pembimbingan, hingga momen-momen yang akan Anda kenang seumur hidup.</p>
    </div>

    <?php
    // Deskripsi Statis Per Koleksi
    $collection_desc = [
        'Classic'   => 'Paket umroh reguler yang dirancang dengan penuh perhatian untuk memberikan ketenangan dan kenyamanan.',
        'Signature' => 'Pengalaman umroh premium dengan akomodasi bintang 5 pilihan, pembimbingan personal, dan dokumentasi sinematik.',
        'Private'   => 'Perjalanan umroh privat yang sepenuhnya disesuaikan dengan kebutuhan Anda. Jadwal fleksibel, layanan concierge personal.',
        'Sacred'    => 'Program haji kami dirancang untuk memastikan setiap jamaah menjalani ibadah dengan khusyuk dan nyaman.'
    ];

    $bg_map = [
        'Classic'   => 'pkg-bg-classic',
        'Signature' => 'pkg-bg-signature',
        'Private'   => 'pkg-bg-private',
        'Sacred'    => 'pkg-bg-sacred'
    ];

    // Jika database kosong, gunakan placeholder ini
    $all_packages = [];
    if (!empty($packages)) {
        $all_packages = $packages;
    } else {
        $all_packages = [
            (object)['id'=>1,'name'=>'Rindu Classic','slug'=>'rindu-classic','collection_type'=>'Classic','tagline'=>'Perjalanan penuh ketenangan','price_display'=>'Hubungi Kami','main_image'=>null],
            (object)['id'=>2,'name'=>'Rindu Signature','slug'=>'rindu-signature','collection_type'=>'Signature','tagline'=>'Pengalaman premium tak terlupakan','price_display'=>'Hubungi Kami','main_image'=>null],
            (object)['id'=>3,'name'=>'Rindu Private','slug'=>'rindu-private','collection_type'=>'Private','tagline'=>'Dirancang khusus untuk Anda','price_display'=>'Custom','main_image'=>null],
            (object)['id'=>4,'name'=>'Sacred Journey','slug'=>'sacred-journey','collection_type'=>'Sacred','tagline'=>'Perjalanan haji yang bermakna','price_display'=>'Hubungi Kami','main_image'=>null],
        ];
    }
    ?>

    <div class="journey-slider-wrapper reveal" style="margin-top: 64px;">
        
        <button class="slider-btn prev-btn" id="journeyPrev" aria-label="Geser Kiri">
            <svg viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>
        </button>

        <div class="pkg-grid" id="journeySlider">
            <?php 
            foreach ($all_packages as $pkg): 
                $type = $pkg->collection_type;
                $desc = isset($collection_desc[$type]) ? $collection_desc[$type] : '';
                $bg   = isset($bg_map[$type]) ? $bg_map[$type] : 'pkg-bg-classic';
            ?>
            <a href="<?= base_url('journey/' . $pkg->slug) ?>" class="pkg-card">
                <div class="pkg-card-visual">
                    <?php if ($pkg->main_image): ?>
                        <img class="pkg-card-img" src="<?= base_url('assets/uploads/packages/' . $pkg->main_image) ?>" alt="<?= htmlspecialchars($pkg->name) ?>">
                    <?php else: ?>
                        <div class="pkg-card-img <?= $bg ?>"></div>
                    <?php endif; ?>
                    <div class="pkg-card-visual-overlay"></div>
                </div>
                <div class="pkg-card-info">
                    <span class="pkg-card-collection">Rindu <?= htmlspecialchars($type) ?></span>
                    <h2 class="pkg-card-name"><?= htmlspecialchars($pkg->name) ?></h2>
                    <?php if ($pkg->tagline): ?>
                    <p class="pkg-card-tagline"><?= htmlspecialchars($pkg->tagline) ?></p>
                    <?php endif; ?>
                    
                    <p class="pkg-card-desc"><?= $desc ?></p>
                    
                    <?php if ($pkg->price_display): ?>
                    <div class="pkg-card-price">
                        <?= htmlspecialchars($pkg->price_display) ?>
                        <small>/ jamaah</small>
                    </div>
                    <?php endif; ?>
                    <span class="detail-link">Lihat Detail</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <button class="slider-btn next-btn" id="journeyNext" aria-label="Geser Kanan">
            <svg viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('journeySlider');
            const prevBtn = document.getElementById('journeyPrev');
            const nextBtn = document.getElementById('journeyNext');

            if (slider && prevBtn && nextBtn) {
                // Sembunyikan panah jika kartu kurang dari 3 (karena layar muat 2 kartu, butuh minimal 3 untuk infinite loop)
                if (slider.children.length <= 2) {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                    return;
                }

                slider.style.overflowAnchor = 'none';
                let isAnimating = false;

                // ── FUNGSI PENDETEKSI ANIMASI BERHENTI ──
                // Menjamin pemindahan DOM terjadi TEPAT saat animasi selembut sutra selesai
                const smoothScrollTo = (amount) => {
                    return new Promise(resolve => {
                        slider.scrollBy({ left: amount, behavior: 'smooth' });
                        
                        let scrollTimeout;
                        const scrollHandler = () => {
                            clearTimeout(scrollTimeout);
                            scrollTimeout = setTimeout(() => {
                                slider.removeEventListener('scroll', scrollHandler);
                                resolve();
                            }, 40); // Jika selama 40ms tidak ada pergerakan, berarti geseran mulus sudah selesai
                        };
                        slider.addEventListener('scroll', scrollHandler);
                        
                        // Fallback keamanan jika browser sedang lag
                        setTimeout(() => {
                            slider.removeEventListener('scroll', scrollHandler);
                            resolve();
                        }, 700); 
                    });
                };

                // ── LOGIKA TOMBOL KANAN ──
                nextBtn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    if (isAnimating) return;
                    isAnimating = true;

                    const firstCard = slider.firstElementChild;
                    const cardWidth = firstCard.offsetWidth + 32; // 32px adalah gap CSS

                    // 1. Matikan fitur "magnet" sementara agar geseran tidak bergetar
                    slider.style.scrollSnapType = 'none';

                    // 2. Animasikan geser super mulus
                    await smoothScrollTo(cardWidth);

                    // 3. Pindahkan kartu pertama ke belakang secara "diam-diam"
                    slider.style.scrollBehavior = 'auto'; // Matikan smooth sementara agar tidak melompat
                    slider.appendChild(firstCard);
                    slider.scrollLeft -= cardWidth; // Sesuaikan posisi kamera seketika

                    // 4. Kembalikan kondisi normal
                    requestAnimationFrame(() => {
                        slider.style.scrollSnapType = 'x mandatory';
                        slider.style.scrollBehavior = '';
                        isAnimating = false;
                    });
                });

                // ── LOGIKA TOMBOL KIRI ──
                prevBtn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    if (isAnimating) return;
                    isAnimating = true;

                    const lastCard = slider.lastElementChild;
                    const cardWidth = lastCard.offsetWidth + 32;

                    // 1. Matikan fitur "magnet" dan animasi
                    slider.style.scrollSnapType = 'none';
                    slider.style.scrollBehavior = 'auto';

                    // 2. Pindahkan kartu terakhir ke depan secara "diam-diam" seketika
                    slider.prepend(lastCard);
                    slider.scrollLeft += cardWidth;

                    // 3. Paksa browser membaca formasi baru
                    void slider.offsetWidth;

                    // 4. Animasikan geser mundur dengan mulus
                    await smoothScrollTo(-cardWidth);

                    // 5. Kembalikan kondisi normal
                    requestAnimationFrame(() => {
                        slider.style.scrollSnapType = 'x mandatory';
                        slider.style.scrollBehavior = '';
                        isAnimating = false;
                    });
                });
            }
        });
    </script>
</section>