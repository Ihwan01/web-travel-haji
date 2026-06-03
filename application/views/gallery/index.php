<!-- ══════════════════════════════════════════════════════
     GALLERY / FILM — index.php
     ══════════════════════════════════════════════════════ -->

<div class="gallery-page">

    <!-- ── HERO ───────────────────────────────────────── -->
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

    <!-- ── FILTER ──────────────────────────────────────── -->
    <div class="gallery-filter">
        <button class="filter-tab active" data-filter="all">Semua</button>
        <button class="filter-tab" data-filter="video">Film & Video</button>
        <button class="filter-tab" data-filter="photo">Photography</button>
    </div>

    <?php
    // Pisah media berdasarkan tipe
    $videos = [];
    $photos = [];
    if (!empty($media)) {
        foreach ($media as $m) {
            if ($m->media_type === 'Video') $videos[] = $m;
            else $photos[] = $m;
        }
    }

    // Dummy videos jika kosong
    if (empty($videos)) {
        $videos = [
            (object)['id'=>1,'title'=>'Nuansa Rindu — The Film','media_type'=>'Video','file_url'=>'','thumbnail_url'=>null,'aspect_ratio'=>'Landscape'],
            (object)['id'=>2,'title'=>'Perjalanan Hati','media_type'=>'Video','file_url'=>'','thumbnail_url'=>null,'aspect_ratio'=>'Landscape'],
            (object)['id'=>3,'title'=>'Rindu Classic 2024','media_type'=>'Video','file_url'=>'','thumbnail_url'=>null,'aspect_ratio'=>'Landscape'],
            (object)['id'=>4,'title'=>'Sacred Moments','media_type'=>'Video','file_url'=>'','thumbnail_url'=>null,'aspect_ratio'=>'Landscape'],
            (object)['id'=>5,'title'=>'Fashion Identity','media_type'=>'Video','file_url'=>'','thumbnail_url'=>null,'aspect_ratio'=>'Landscape'],
            (object)['id'=>6,'title'=>'Behind The Journey','media_type'=>'Video','file_url'=>'','thumbnail_url'=>null,'aspect_ratio'=>'Landscape'],
        ];
    }

    // Dummy photos jika kosong
    if (empty($photos)) {
        for ($i = 1; $i <= 9; $i++) {
            $photos[] = (object)['id'=>$i,'title'=>'Visual Story '.$i,'media_type'=>'Photo',
                'file_url'=>'','thumbnail_url'=>null,'aspect_ratio'=> $i%3===0 ? 'Portrait' : 'Landscape'];
        }
    }

    $film_bgs = ['film-bg-1','film-bg-2','film-bg-3','film-bg-4','film-bg-5','film-bg-6'];
    $photo_bgs= ['photo-bg-1','photo-bg-2','photo-bg-3','photo-bg-4','photo-bg-5','photo-bg-6','photo-bg-7','photo-bg-8','photo-bg-9'];
    $featured_video = $videos[0];
    $other_videos   = array_slice($videos, 1);
    ?>

    <!-- ── FILM SECTION ────────────────────────────────── -->
    <section class="gallery-films" id="sectionVideo">
        <div class="gallery-section-title">Cinematic Films</div>

        <!-- Featured film -->
        <div class="film-featured reveal"
             <?php if ($featured_video->file_url): ?>
             data-lightbox data-type="Video" data-src="<?= base_url($featured_video->file_url) ?>"
             <?php endif; ?>>
            <?php if ($featured_video->thumbnail_url): ?>
                <img class="film-featured-img" src="<?= base_url($featured_video->thumbnail_url) ?>" alt="<?= htmlspecialchars($featured_video->title) ?>">
            <?php else: ?>
                <div class="film-featured-img film-bg-1"></div>
            <?php endif; ?>
            <div class="film-featured-overlay">
                <div class="play-circle">
                    <svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg>
                </div>
                <h2 class="film-featured-title"><?= htmlspecialchars($featured_video->title) ?></h2>
            </div>
            <span class="film-featured-meta">Play Film ✦</span>
        </div>

        <!-- Film grid -->
        <?php if (!empty($other_videos)): ?>
        <div class="film-grid reveal">
            <?php foreach ($other_videos as $idx => $vid): ?>
            <div class="film-item"
                 <?php if ($vid->file_url): ?>
                 data-lightbox data-type="Video" data-src="<?= base_url($vid->file_url) ?>"
                 <?php endif; ?>>
                <?php if ($vid->thumbnail_url): ?>
                    <img class="film-item-img" src="<?= base_url($vid->thumbnail_url) ?>" alt="<?= htmlspecialchars($vid->title) ?>">
                <?php else: ?>
                    <div class="film-item-img <?= $film_bgs[($idx + 1) % count($film_bgs)] ?>"></div>
                <?php endif; ?>
                <div class="film-item-overlay">
                    <div class="play-sm">
                        <svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg>
                    </div>
                    <span class="film-item-title"><?= htmlspecialchars($vid->title) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>

    <!-- ── PHOTO SECTION ───────────────────────────────── -->
    <section class="gallery-photos" id="sectionPhoto">
        <div class="gallery-section-title">Photography</div>

        <div class="photo-masonry reveal">
            <?php foreach ($photos as $idx => $ph): ?>
            <div class="photo-item"
                 <?php if ($ph->file_url): ?>
                 data-lightbox data-type="Photo" data-src="<?= base_url($ph->file_url) ?>"
                 <?php endif; ?>>
                <?php if ($ph->file_url): ?>
                    <img src="<?= base_url($ph->file_url) ?>" alt="<?= htmlspecialchars($ph->title) ?>">
                <?php else: ?>
                    <div class="photo-bg <?= $photo_bgs[$idx % count($photo_bgs)] ?>"></div>
                <?php endif; ?>
                <div class="photo-overlay">
                    <div class="photo-zoom">
                        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

</div>

<script>
// Filter tabs
document.querySelectorAll('.filter-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.filter-tab').forEach(function(t) { t.classList.remove('active'); });
        tab.classList.add('active');
        var filter = tab.getAttribute('data-filter');
        var secVideo = document.getElementById('sectionVideo');
        var secPhoto = document.getElementById('sectionPhoto');
        if (filter === 'all') {
            secVideo.style.display = ''; secPhoto.style.display = '';
        } else if (filter === 'video') {
            secVideo.style.display = ''; secPhoto.style.display = 'none';
        } else {
            secVideo.style.display = 'none'; secPhoto.style.display = '';
        }
    });
});
</script>
