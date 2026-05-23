<!-- ══════════════════════════════════════════════════════
     JOURNAL — detail.php
     ══════════════════════════════════════════════════════ -->

<div class="journal-detail-page">

    <!-- ── HERO ───────────────────────────────────────── -->
    <div class="jd-hero">
        <?php if ($journal->main_image): ?>
            <img class="jd-hero-img" src="<?= base_url($journal->main_image) ?>" alt="<?= htmlspecialchars($journal->title) ?>">
        <?php else: ?>
            <div class="jd-hero-img jg-bg-1" style="background:linear-gradient(160deg,#8BA8B0,#2A4A55,#1A2A30);"></div>
        <?php endif; ?>
        <div class="jd-hero-overlay">
            <span class="jd-hero-date"><?= date('d M Y', strtotime($journal->created_at)) ?></span>
            <h1 class="jd-hero-title"><?= htmlspecialchars($journal->title) ?></h1>
            <?php if ($journal->author_name): ?>
            <span class="jd-hero-author">Oleh <?= htmlspecialchars($journal->author_name) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <!-- ── BODY ───────────────────────────────────────── -->
    <div class="jd-body">

        <!-- Main content -->
        <article class="jd-content">
            <?php
            // Render content — bisa HTML atau plain text
            $content = $journal->content;
            // Jika plain text (tidak ada tag HTML), wrap tiap paragraf
            if (strip_tags($content) === $content) {
                $paragraphs = preg_split('/\n\s*\n/', trim($content));
                foreach ($paragraphs as $para) {
                    $para = trim($para);
                    if ($para) {
                        echo '<p>' . nl2br(htmlspecialchars($para)) . '</p>';
                    }
                }
            } else {
                // Sudah HTML dari CMS
                echo $content;
            }
            ?>

            <!-- Back + share -->
            <div style="margin-top:64px; padding-top:40px; border-top:1px solid rgba(196,163,90,0.15); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px;">
                <a href="<?= base_url('journal') ?>" style="font-size:0.65rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted);">
                    ← Kembali ke Journal
                </a>
                <?php
                $wa_msg = urlencode('Baca tulisan indah ini dari Nuansa Rindu: ' . $journal->title . ' — ' . current_url());
                ?>
                <a href="https://wa.me/?text=<?= $wa_msg ?>" target="_blank" rel="noopener"
                   style="font-size:0.65rem; letter-spacing:0.14em; color:var(--gold); display:flex; align-items:center; gap:8px;">
                    Bagikan ✦
                </a>
            </div>
        </article>

        <!-- Sidebar: tulisan lain -->
        <aside class="jd-sidebar">
            <div class="jd-sidebar-title">Tulisan Lainnya</div>
            <?php
            $bg_arr = ['jg-bg-1','jg-bg-2','jg-bg-3'];
            foreach ($recents as $idx => $rec):
                if ($rec->slug === $journal->slug) continue;
            ?>
            <a href="<?= base_url('journal/' . $rec->slug) ?>" class="jd-recent-item">
                <div class="jd-recent-img">
                    <?php if ($rec->main_image): ?>
                        <img src="<?= base_url($rec->main_image) ?>" alt="<?= htmlspecialchars($rec->title) ?>">
                    <?php else: ?>
                        <div style="width:100%;height:100%;<?php
                            $bgs = [
                                'background:linear-gradient(160deg,#8BA8B0,#2A4A55);',
                                'background:linear-gradient(160deg,#7A9070,#2A3820);',
                                'background:linear-gradient(160deg,#C4A87A,#5A3820);',
                            ];
                            echo $bgs[$idx % 3];
                        ?>"></div>
                    <?php endif; ?>
                </div>
                <div>
                    <div class="jd-recent-title"><?= htmlspecialchars($rec->title) ?></div>
                    <div class="jd-recent-date"><?= date('d M Y', strtotime($rec->created_at)) ?></div>
                </div>
            </a>
            <?php endforeach; ?>

            <!-- CTA sidebar -->
            <div style="margin-top:40px; padding:32px 28px; background:var(--warm);">
                <p style="font-family:var(--font-display); font-size:1.1rem; font-weight:400; color:var(--brown); margin-bottom:12px; line-height:1.4;">
                    Siap memulai perjalanan Anda?
                </p>
                <p style="font-size:0.78rem; color:var(--muted); margin-bottom:24px; line-height:1.7;">
                    Biarkan kami merancang perjalanan spiritual yang paling bermakna untuk Anda.
                </p>
                <a href="<?= base_url('contact') ?>" class="btn-outline dark" style="font-size:0.6rem; padding:11px 22px;">
                    Konsultasi Gratis
                </a>
            </div>
        </aside>

    </div>
</div>
