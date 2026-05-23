<!-- ══════════════════════════════════════════════════════
     ABOUT — index.php
     ══════════════════════════════════════════════════════ -->

<!-- ── ABOUT HERO ─────────────────────────────────────── -->
<section class="about-hero">
    <div class="about-hero-bg">
        <img src="<?= $assets_url ?>images/hero/about-hero.jpg" alt="Tentang Nuansa Rindu">
    </div>
    <div class="about-hero-content">
        <span class="about-hero-label">Tentang Nuansa Rindu</span>
        <h1 class="about-hero-title">
            Kami percaya setiap langkah<br>
            menuju Baitullah adalah<br>
            <em style="font-style:italic; color:var(--gold);">rindu yang menemukan jalan pulang.</em>
        </h1>
        <p class="about-hero-sub">
            Nuansa Rindu bukan sekadar perjalanan. Ini adalah pengalaman spiritual yang dirancang untuk menenangkan hati dan memperkaya jiwa.
        </p>
    </div>
</section>

<!-- ── STORY SECTION ──────────────────────────────────── -->
<section class="about-story">

    <!-- Block 1: Asal cerita -->
    <div class="story-grid reveal">
        <div class="story-visual">
            <div class="story-img story-bg-1"></div>
            <div class="story-visual-deco"></div>
        </div>
        <div class="story-text">
            <p class="section-label">Cerita Kami</p>
            <h2>Dari sebuah rindu<br>yang mendalam.</h2>
            <p>
                Nuansa Rindu lahir dari sebuah kerinduan yang sederhana namun dalam — rindu untuk pulang ke Baitullah, rindu untuk bersujud di tanah yang paling dicintai, rindu untuk merasakan kedekatan yang sesungguhnya dengan Sang Pencipta.
            </p>
            <p>
                Kami memulai perjalanan ini bukan sebagai perusahaan perjalanan biasa, tetapi sebagai teman yang memahami betapa berharganya setiap langkah menuju tanah suci. Setiap detail kami rancang dengan hati — dari akomodasi yang menenangkan hingga momen-momen yang akan terukir selamanya dalam kenangan.
            </p>
            <blockquote>
                "Bukan seberapa jauh perjalanannya,<br>
                tapi seberapa dalam maknanya."
            </blockquote>
        </div>
    </div>

    <!-- Block 2: Filosofi -->
    <div class="story-grid reverse reveal">
        <div class="story-visual">
            <div class="story-img story-bg-2"></div>
            <div class="story-visual-deco" style="bottom:auto; top:-24px; right:auto; left:-24px;"></div>
        </div>
        <div class="story-text">
            <p class="section-label">Filosofi Rindu</p>
            <h2>Rindu adalah<br>arah yang paling jujur.</h2>
            <p>
                Kami percaya bahwa rindu adalah perasaan paling jujur yang bisa manusia rasakan. Rindu kepada Tuhan, rindu kepada jati diri, rindu kepada ketenangan yang hakiki.
            </p>
            <p>
                Itulah mengapa kami menamai diri Nuansa Rindu — karena di setiap perjalanan yang kami rancang, ada nuansa rindu yang kami jaga agar tetap hidup dan terawat. Bukan hanya perjalanan fisik, tapi perjalanan batin yang membawa Anda kembali kepada yang paling esensi.
            </p>
            <p>
                Setiap sentuhan dalam perjalanan Anda — dari aroma seragam yang kami pilih hingga musik yang menemani perjalanan — semuanya kami rancang untuk menjaga nuansa rindu itu tetap menyala.
            </p>
        </div>
    </div>

    <!-- Block 3: Pendekatan visual -->
    <div class="story-grid reveal">
        <div class="story-visual">
            <div class="story-img story-bg-3"></div>
            <div class="story-visual-deco"></div>
        </div>
        <div class="story-text">
            <p class="section-label">Konsep Visual & Fashion</p>
            <h2>Identitas yang<br>memancarkan kemuliaan.</h2>
            <p>
                Di Nuansa Rindu, penampilan adalah bagian dari ibadah. Seragam jamaah kami dirancang bukan sekadar untuk keseragaman, tapi untuk memancarkan keanggunan, kesederhanaan, dan kemuliaan seorang tamu Allah.
            </p>
            <p>
                Kami berkolaborasi dengan desainer modest fashion terpilih untuk menciptakan travel essentials yang fungsional sekaligus estetis — passport holder, tote bag, luggage tag, dan outfit yang akan membuat Anda merasa seperti sedang dalam fashion campaign, bukan perjalanan biasa.
            </p>
            <p>
                Karena kami percaya: ketika Anda tampil dengan penuh kesadaran dan kemuliaan, ibadah pun terasa lebih khusyuk dan bermakna.
            </p>
        </div>
    </div>

</section>

<!-- ── VALUES SECTION ──────────────────────────────────── -->
<section class="about-values">
    <p class="section-label reveal">Nilai-Nilai Kami</p>
    <h2 class="values-heading reveal">Prinsip yang mendasari<br>setiap langkah kami.</h2>

    <div class="values-grid">
        <?php
        $values = [
            ['Ketulusan', 'Kami melayani bukan karena kewajiban, tapi karena kami sungguh peduli pada setiap perjalanan hati Anda.'],
            ['Keindahan', 'Setiap detail dirancang dengan estetika yang tinggi — karena keindahan adalah bentuk syukur kepada Tuhan.'],
            ['Ketenangan', 'Kami hadir untuk menghilangkan kekhawatiran, sehingga Anda bisa fokus sepenuhnya pada ibadah dan makna.'],
            ['Keaslian', 'Kami tidak menjual mimpi. Kami merancang pengalaman nyata yang akan Anda kenang seumur hidup.'],
            ['Kedekatan', 'Setiap jamaah adalah individu unik. Kami mengenal Anda, bukan sekadar melayani Anda.'],
            ['Kebermaknaan', 'Di akhir perjalanan, yang paling penting bukan foto yang Anda bawa pulang, tapi perubahan yang terjadi di dalam hati.'],
        ];
        foreach ($values as $i => $v): ?>
        <div class="value-item reveal delay-<?= ($i % 4) + 1 ?>">
            <div class="value-num">0<?= $i + 1 ?></div>
            <h3 class="value-title"><?= $v[0] ?></h3>
            <p class="value-desc"><?= $v[1] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ── APPROACH SECTION ────────────────────────────────── -->
<section class="about-approach">
    <p class="section-label reveal" style="justify-content:center;">Pendekatan Kami</p>
    <blockquote class="approach-quote reveal">
        "Kami tidak sekadar mengantarkan Anda ke Baitullah. Kami menemani setiap langkah hati Anda dalam perjalanan pulang yang paling bermakna."
    </blockquote>
    <p class="approach-sub reveal">
        Tim Nuansa Rindu terdiri dari para profesional yang tidak hanya berpengalaman di industri perjalanan, tapi juga memiliki kecintaan mendalam terhadap nilai-nilai spiritual dan estetika yang kami perjuangkan bersama.
    </p>
    <a href="<?= base_url('contact') ?>" class="btn-outline dark reveal">Mulai Percakapan</a>
</section>
