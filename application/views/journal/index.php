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

    <!-- ── FILTER KATEGORI ────────────────────────────── -->
    <div class="journal-category-nav reveal">
        <ul class="jc-list">
            <li>
                <a href="<?= base_url('journal') ?>" class="jc-link <?= empty($active_category) ? 'active' : '' ?>">Semua Jurnal</a>
            </li>
            <?php if (!empty($categories)): foreach ($categories as $cat): ?>
                    <li>
                        <a href="<?= base_url('journal?category=' . $cat->slug) ?>" class="jc-link <?= ($active_category == $cat->slug) ? 'active' : '' ?>">
                            <?= htmlspecialchars($cat->name) ?>
                        </a>
                    </li>
            <?php endforeach;
            endif; ?>
        </ul>
    </div>

    <?php
    if (empty($journals)) {
        $featured = null;
        $rest = [];
    } else {
        $featured = $journals[0];
        $rest     = array_slice($journals, 1);
    }
    $bg_arr = ['jg-bg-1', 'jg-bg-2', 'jg-bg-3', 'jg-bg-4', 'jg-bg-5', 'jg-bg-6'];
    ?>

    <!-- ── FEATURED ────────────────────────────────────── -->
    <?php if ($featured): ?>
        <div class="journal-featured reveal">
            <a href="<?= base_url('journal/' . $featured->slug) ?>" class="jf-card">
                <div class="jf-visual">
                    <!-- PERBAIKAN: Menggunakan properti 'image' bukan 'main_image' -->
                    <?php if (!empty($featured->image)): ?>
                        <img class="jf-img" src="<?= base_url('assets/uploads/journals/' . $featured->image) ?>" alt="<?= htmlspecialchars($featured->title) ?>">
                    <?php else: ?>
                        <div class="jf-img jg-bg-1"></div>
                    <?php endif; ?>
                </div>
                <div class="jf-info">
                    <span class="jf-badge"><?= !empty($featured->category_name) ? htmlspecialchars($featured->category_name) : 'Featured Story' ?></span>
                    <h2 class="jf-title"><?= htmlspecialchars($featured->title) ?></h2>
                    <p class="jf-excerpt">
                        <?= htmlspecialchars(substr(strip_tags($featured->content), 0, 200)) ?>...
                    </p>
                    <p class="jf-meta">
                        <?= isset($featured->author_name) && !empty($featured->author_name) ? htmlspecialchars($featured->author_name) . ' · ' : '' ?>
                        <?= date('d M Y', strtotime($featured->created_at)) ?>
                    </p>
                    <span class="arrow-link">Baca Selengkapnya</span>
                </div>
            </a>
        </div>
    <?php else: ?>
        <div class="text-center py-5 my-5 reveal" style="color: var(--muted);">
            Belum ada artikel yang dipublikasikan pada kategori ini.
        </div>
    <?php endif; ?>

    <!-- ── GRID ───────────────────────────────────────── -->
    <?php if (!empty($rest)): ?>
        <section class="journal-grid-section">
            <div class="journal-grid">
                <?php foreach ($rest as $idx => $jn): ?>
                    <a href="<?= base_url('journal/' . $jn->slug) ?>" class="jg-card reveal delay-<?= ($idx % 4) + 1 ?>">
                        <div class="jg-visual">
                            <!-- PERBAIKAN: Menggunakan properti 'image' bukan 'main_image' -->
                            <?php if (!empty($jn->image)): ?>
                                <img class="jg-img" src="<?= base_url('assets/uploads/journals/' . $jn->image) ?>" alt="<?= htmlspecialchars($jn->title) ?>">
                            <?php else: ?>
                                <div class="jg-img <?= $bg_arr[$idx % count($bg_arr)] ?>"></div>
                            <?php endif; ?>
                        </div>
                        <div class="jg-date">
                            <?= !empty($jn->category_name) ? htmlspecialchars($jn->category_name) . ' · ' : '' ?>
                            <?= date('d M Y', strtotime($jn->created_at)) ?>
                        </div>
                        <h3 class="jg-title"><?= htmlspecialchars($jn->title) ?></h3>
                        <p class="jg-excerpt"><?= htmlspecialchars(substr(strip_tags($jn->content), 0, 120)) ?>...</p>
                        <?php if (isset($jn->author_name) && !empty($jn->author_name)): ?>
                            <span class="jg-author"><?= htmlspecialchars($jn->author_name) ?></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

</div>