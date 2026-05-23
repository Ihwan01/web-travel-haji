<!-- ══════════════════════════════════════════════════════
     JOURNAL — index.php
     ══════════════════════════════════════════════════════ -->

<div class="journal-page">

    <!-- ── PAGE HERO ──────────────────────────────────── -->
    <div class="journal-page-hero">
        <p class="section-label">Journal</p>
        <h1 class="journal-page-title">
            Catatan perjalanan,<br>
            cerita hati.
        </h1>
        <p class="journal-page-sub">
            Sebuah ruang editorial tempat kami berbagi refleksi, kisah spiritual, dan momen-momen yang membentuk makna di setiap perjalanan.
        </p>
    </div>

    <?php
    // Dummy data jika DB kosong
    if (empty($journals)) {
        $journals = [
            (object)['id'=>1,'title'=>'Ketika Rindu Menuntun Langkah','slug'=>'ketika-rindu-menuntun-langkah',
                'content'=>'Ada momen-momen dalam hidup ketika kita tidak tahu mengapa kaki ini begitu ingin melangkah ke suatu arah. Bukan karena ada yang memanggil, bukan karena ada yang mengundang. Hanya sebuah rindu yang dalam, yang tak bisa dijelaskan dengan kata-kata biasa. Itulah yang dirasakan ribuan jamaah yang setiap tahunnya memilih untuk kembali ke Baitullah — bukan karena kewajiban semata, tapi karena ada sesuatu di sana yang selalu membuat hati ingin pulang.',
                'main_image'=>null,'author_name'=>'Tim Nuansa Rindu','created_at'=>'2025-03-15 00:00:00','status'=>'Published'],
            (object)['id'=>2,'title'=>'Pulang Bukanlah Akhir, Tapi Awal','slug'=>'pulang-bukanlah-akhir-tapi-awal',
                'content'=>'Banyak yang mengira bahwa perjalanan umroh berakhir saat pesawat mendarat kembali di tanah air. Tapi sesungguhnya, itulah saat perjalanan yang sesungguhnya dimulai. Karena perubahan sejati tidak terjadi di sana — ia terjadi di sini, dalam keseharian kita, dalam cara kita memandang dunia dan orang-orang di sekitar kita.',
                'main_image'=>null,'author_name'=>'Ustadz Ahmad Fauzi','created_at'=>'2025-02-20 00:00:00','status'=>'Published'],
            (object)['id'=>3,'title'=>'Mengapa Perjalanan Ini Begitu Bermakna?','slug'=>'mengapa-perjalanan-ini-begitu-bermakna',
                'content'=>'Setiap kali kami menemani jamaah dalam perjalanan ke tanah suci, selalu ada momen yang membuat kami terdiam. Bukan karena tidak ada kata-kata, tapi karena ada yang jauh lebih bermakna dari kata-kata itu sendiri.',
                'main_image'=>null,'author_name'=>'Sarah Amalia','created_at'=>'2025-01-10 00:00:00','status'=>'Published'],
            (object)['id'=>4,'title'=>'Arsitektur Cahaya di Masjidil Haram','slug'=>'arsitektur-cahaya-di-masjidil-haram',
                'content'=>'Sebelum fajar, ketika bintang-bintang masih tergantung di langit Mekkah dan angin subuh membawa sejuk yang tak tertandingi, ada sebuah pemandangan yang tidak akan pernah terlupakan — cahaya Masjidil Haram yang memancar ke seluruh penjuru kota suci.',
                'main_image'=>null,'author_name'=>'Tim Nuansa Rindu','created_at'=>'2024-12-05 00:00:00','status'=>'Published'],
            (object)['id'=>5,'title'=>'Seragam Sebagai Identitas Spiritual','slug'=>'seragam-sebagai-identitas-spiritual',
                'content'=>'Ada yang bertanya kepada kami: mengapa Nuansa Rindu begitu memperhatikan seragam jamaah? Bukankah yang terpenting adalah ibadahnya? Pertanyaan yang sangat wajar, dan jawabannya justru ada di dalam pertanyaan itu sendiri.',
                'main_image'=>null,'author_name'=>'Fatima Al-Zahra','created_at'=>'2024-11-18 00:00:00','status'=>'Published'],
            (object)['id'=>6,'title'=>'Doa yang Terucap di Raudhah','slug'=>'doa-yang-terucap-di-raudhah',
                'content'=>'Di antara makam Rasulullah SAW dan mimbar beliau, ada sepotong tanah yang oleh hadits disebut sebagai taman surga. Di sinilah ribuan doa terucap setiap harinya, dalam berbagai bahasa, dari berbagai penjuru dunia.',
                'main_image'=>null,'author_name'=>'Tim Nuansa Rindu','created_at'=>'2024-10-22 00:00:00','status'=>'Published'],
        ];
    }
    $featured = $journals[0];
    $rest     = array_slice($journals, 1);
    $bg_arr   = ['jg-bg-1','jg-bg-2','jg-bg-3','jg-bg-4','jg-bg-5','jg-bg-6'];
    ?>

    <!-- ── FEATURED ────────────────────────────────────── -->
    <div class="journal-featured reveal">
        <a href="<?= base_url('journal/' . $featured->slug) ?>" class="jf-card">
            <div class="jf-visual">
                <?php if ($featured->main_image): ?>
                    <img class="jf-img" src="<?= base_url($featured->main_image) ?>" alt="<?= htmlspecialchars($featured->title) ?>">
                <?php else: ?>
                    <div class="jf-img jg-bg-1"></div>
                <?php endif; ?>
            </div>
            <div class="jf-info">
                <span class="jf-badge">Featured Story</span>
                <h2 class="jf-title"><?= htmlspecialchars($featured->title) ?></h2>
                <p class="jf-excerpt">
                    <?= htmlspecialchars(substr(strip_tags($featured->content), 0, 200)) ?>...
                </p>
                <p class="jf-meta">
                    <?= $featured->author_name ? htmlspecialchars($featured->author_name) . ' · ' : '' ?>
                    <?= date('d M Y', strtotime($featured->created_at)) ?>
                </p>
                <span class="arrow-link">Baca Selengkapnya</span>
            </div>
        </a>
    </div>

    <!-- ── GRID ───────────────────────────────────────── -->
    <?php if (!empty($rest)): ?>
    <section class="journal-grid-section">
        <div class="journal-grid">
            <?php foreach ($rest as $idx => $jn): ?>
            <a href="<?= base_url('journal/' . $jn->slug) ?>" class="jg-card reveal delay-<?= ($idx % 4) + 1 ?>">
                <div class="jg-visual">
                    <?php if ($jn->main_image): ?>
                        <img class="jg-img" src="<?= base_url($jn->main_image) ?>" alt="<?= htmlspecialchars($jn->title) ?>">
                    <?php else: ?>
                        <div class="jg-img <?= $bg_arr[$idx % count($bg_arr)] ?>"></div>
                    <?php endif; ?>
                </div>
                <div class="jg-date"><?= date('d M Y', strtotime($jn->created_at)) ?></div>
                <h3 class="jg-title"><?= htmlspecialchars($jn->title) ?></h3>
                <p class="jg-excerpt"><?= htmlspecialchars(substr(strip_tags($jn->content), 0, 120)) ?>...</p>
                <?php if ($jn->author_name): ?>
                <span class="jg-author"><?= htmlspecialchars($jn->author_name) ?></span>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

</div>
