<section class="about-hero">
    <div class="about-hero-bg">
        <img src="<?= $assets_url ?>images/about-hero.png" alt="Tentang Nuansa Rindu">
    </div>
    <div class="about-hero-content">
        <span class="about-hero-label">The Preamble</span>
        <h1 class="about-hero-title">
            Bukan tentang seberapa jauh<br>melangkah, melainkan seberapa<br>dalam kita <em style="font-style:italic; color:var(--gold, #C7A570);">menunduk.</em>
        </h1>
        <p class="about-hero-sub">
            Banyak yang mengira perjalanan ke Tanah Suci adalah pencapaian. Bagi kami, ia adalah sebuah kepulangan. Sebuah jeda dari riuhnya dunia untuk kembali menyapa bagian paling murni dalam diri kita.
        </p>
    </div>
</section>

<section class="about-story">

    <div class="story-grid reveal">
        <div class="story-visual">
            <img src="<?= $assets_url ?>images/about-origin.png" alt="The Origin Nuansa Rindu" class="story-img">
            <div class="story-visual-deco"></div>
        </div>
        <div class="story-text">
            <p class="section-label">The Origin</p>
            <h2>Lahir dari keresahan<br>akan ruang yang hilang.</h2>
            <p>
                Seringkali, perjalanan spiritual terjebak dalam ritme yang terburu-buru, jadwal yang padat, dan kelelahan fisik yang mendistraksi jiwa. Nuansa Rindu lahir dari sebuah kesadaran bahwa ibadah tertinggi membutuhkan ketenangan mutlak.
            </p>
            <p>
                Kami tidak merancang "paket wisata". Kami merancang sebuah kanvas kosong tempat Anda bisa melukiskan rindu dan doa dengan leluasa. Dengan pendekatan <em>Quiet Luxury</em>, kami menyingkirkan segala bentuk kerepotan teknis, memberikan Anda privasi, dan menghadirkan standar pelayanan eksklusif tanpa kompromi.
            </p>
        </div>
    </div>

    <div class="story-grid reverse reveal">
        <div class="story-visual">
            <img src="<?= $assets_url ?>images/about-Philosophy.png" alt="Filosofi Nuansa Rindu" class="story-img">
            <div class="story-visual-deco" style="bottom:auto; top:-24px; right:auto; left:-24px;"></div>
        </div>
        <div class="story-text">
            <p class="section-label">The Core Philosophy</p>
            <h2>Mengapa kami menamainya<br>Nuansa Rindu?</h2>
            <p>
                Karena Baitullah tidak pernah sekadar dikunjungi; ia selalu dirindukan. Ada panggilan tak bersuara yang membuat jutaan manusia selalu ingin kembali, mengulang air mata yang sama, di pelataran yang sama.
            </p>
            <p>
                Kami ingin menjadi bagian dari nuansa kepulangan itu — merawat rindu Anda dengan takzim, sejak niat diucapkan hingga kaki kembali memijak tanah air. Setiap sentuhan dalam perjalanan Anda dirancang untuk menjaga nuansa rindu itu tetap menyala.
            </p>
        </div>
    </div>

    <div class="story-grid reveal">
        <div class="story-visual">
            <img src="<?= $assets_url ?>images/about-identity.png" alt="Identitas Visual Nuansa Rindu" class="story-img">
            <div class="story-visual-deco"></div>
        </div>
        <div class="story-text">
            <p class="section-label">Our Identity</p>
            <h2>Keanggunan dalam<br>kesederhanaan.</h2>
            <p>
                Kami percaya bahwa persiapan fisik yang paripurna adalah bentuk penghormatan tertinggi sebelum menghadap Yang Maha Kuasa. Nuansa Rindu adalah pelopor yang memadukan kedalaman spiritual dengan identitas gaya hidup yang elegan.
            </p>
            <p>
                Melalui kurasi <em>modest travel attire</em> berbahan serat premium, palet warna <em>earthy tones</em> yang membumi, hingga detail aksesori perjalanan yang estetik, kami memastikan Anda melangkah dengan rasa hormat, nyaman, dan tenang, tanpa sedikit pun kehilangan fokus pada esensi ibadah.
            </p>
        </div>
    </div>

</section>

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

<section class="about-approach">
    <p class="section-label reveal" style="justify-content:center;">Sebuah Undangan</p>
    <blockquote class="approach-quote reveal">
        "Biarkan kami menjaga perjalanan Anda,<br>agar Anda dapat sepenuhnya menjaga hati."
    </blockquote>
    <p class="approach-sub reveal">
        Tim Nuansa Rindu terdiri dari para profesional yang tidak hanya berpengalaman di industri perjalanan, tapi juga memiliki kecintaan mendalam terhadap nilai-nilai spiritual dan estetika yang kami perjuangkan bersama.
    </p>
    <a href="<?= base_url('contact') ?>" class="btn-outline dark reveal">Mulai Percakapan</a>
</section>