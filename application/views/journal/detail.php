<!-- ══════════════════════════════════════════════════════
     JOURNAL — detail.php
     ══════════════════════════════════════════════════════ -->

<div class="journal-detail-page">

    <!-- ── HERO ───────────────────────────────────────── -->
    <div class="jd-hero">
        <!-- PERBAIKAN: Menggunakan properti 'image' -->
        <?php if (!empty($journal->image)): ?>
            <img class="jd-hero-img" src="<?= base_url('assets/uploads/journals/' . $journal->image) ?>" alt="<?= htmlspecialchars($journal->title) ?>">
        <?php else: ?>
            <div class="jd-hero-img jg-bg-1" style="background:linear-gradient(160deg,#8BA8B0,#2A4A55,#1A2A30);"></div>
        <?php endif; ?>
        <div class="jd-hero-overlay">
            <span class="jd-hero-date">
                <?= !empty($journal->category_name) ? htmlspecialchars($journal->category_name) . ' · ' : '' ?>
                <?= date('d M Y', strtotime($journal->created_at)) ?>
            </span>
            <h1 class="jd-hero-title"><?= htmlspecialchars($journal->title) ?></h1>
        </div>
    </div>

    <!-- ── BODY ───────────────────────────────────────── -->
    <div class="jd-body">

        <!-- Main content -->
        <article class="jd-content">

            <!-- [BARU] Bungkus konten artikel di dalam div article-body -->
            <div class="article-body">
                <?php
                $content = $journal->content;
                if (strip_tags($content) === $content) {
                    $paragraphs = preg_split('/\n\s*\n/', trim($content));
                    foreach ($paragraphs as $para) {
                        $para = trim($para);
                        if ($para) {
                            echo '<p>' . nl2br(htmlspecialchars($para)) . '</p>';
                        }
                    }
                } else {
                    echo $content;
                }
                ?>
            </div>
            <!-- [Akhir dari article-body] -->

            <!-- TAGS SECTION -->
            <?php if (!empty($journal->tags)):
                $tag_list = explode(',', $journal->tags);
            ?>
                <div class="article-tags">
                    <?php foreach ($tag_list as $t): if (trim($t)): ?>
                            <span class="tag-item">#<?= htmlspecialchars(trim($t)) ?></span>
                    <?php endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Share & Back -->
            <div style="margin-top:40px; padding-top:40px; border-top:1px solid rgba(196,163,90,0.15); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px;">
                <a href="<?= base_url('journal') ?>" style="font-size:0.65rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); text-decoration:none;">
                    ← Kembali ke Journal
                </a>
                <?php $wa_msg = urlencode('Baca tulisan indah ini dari Nuansa Rindu: ' . $journal->title . ' — ' . current_url()); ?>
                <a href="https://wa.me/?text=<?= $wa_msg ?>" target="_blank" rel="noopener"
                    style="font-size:0.65rem; letter-spacing:0.14em; color:var(--gold); display:flex; align-items:center; gap:8px; text-decoration:none;">
                    Bagikan ✦
                </a>
            </div>

            <!-- ── COMMENTS SECTION ───────────────────────────────── -->
            <div id="comments-section" class="comments-section mt-5 pt-5">
                <h3 class="comments-title">Komentar</h3>

                <?php if ($this->session->flashdata('success_msg')): ?>
                    <div class="comment-alert success"><?= $this->session->flashdata('success_msg') ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error_msg')): ?>
                    <div class="comment-alert error"><?= $this->session->flashdata('error_msg') ?></div>
                <?php endif; ?>

                <div class="comments-list">
                    <?php
                    if (!function_exists('render_fe_comments')) {
                        function render_fe_comments($comments, $parent_id = NULL, $level = 0)
                        {
                            $margin_left = $level > 0 ? min($level * 2, 6) . 'rem' : '0';

                            foreach ($comments as $c):
                                if ($c->parent_id == $parent_id):
                                    $is_admin = $c->is_admin_reply == 1;
                    ?>
                                    <div class="comment-item <?= $is_admin ? 'admin-reply' : '' ?>" style="margin-left: <?= $margin_left ?>;">
                                        <div class="comment-header">
                                            <div class="comment-meta">
                                                <strong><?= htmlspecialchars($c->name) ?></strong>
                                                <?php if ($is_admin): ?><span class="admin-badge">Admin</span><?php endif; ?>
                                                <span class="date"><?= date('d M Y, H:i', strtotime($c->created_at)) ?></span>
                                            </div>
                                            <button type="button" class="btn-reply" onclick="replyTo('<?= $c->id ?>', '<?= htmlspecialchars(addslashes($c->name)) ?>')">Balas</button>
                                        </div>
                                        <div class="comment-body">
                                            <?= nl2br(htmlspecialchars($c->comment)) ?>
                                        </div>
                                    </div>
                    <?php
                                    render_fe_comments($comments, $c->id, $level + 1);
                                endif;
                            endforeach;
                        }
                    }

                    if (!empty($comments)) {
                        render_fe_comments($comments, NULL, 0);
                    } else {
                        echo '<p style="color:var(--muted); font-size:0.85rem;">Belum ada komentar. Jadilah yang pertama membagikan kesan Anda.</p>';
                    }
                    ?>
                </div>

                <!-- Form Tambah Komentar -->
                <div class="comment-form-wrap">
                    <h4 class="comment-form-title">Tinggalkan Pesan</h4>
                    <div id="reply-indicator" class="reply-indicator" style="display: none;">
                        <span>Membalas: <strong id="reply-to-name"></strong></span>
                        <button type="button" onclick="cancelReply()">Batal</button>
                    </div>

                    <form action="<?= base_url('journal/submit_comment') ?>" method="POST" class="comment-form">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" name="journal_id" value="<?= $journal->id ?>">
                        <input type="hidden" name="slug" value="<?= $journal->slug ?>">
                        <input type="hidden" id="parent_id" name="parent_id" value="">

                        <div class="form-row">
                            <input type="text" name="name" placeholder="Nama Lengkap *" required>
                            <input type="email" name="email" placeholder="Email (Tidak dipublikasikan) *" required>
                        </div>
                        <textarea name="comment" rows="5" placeholder="Tulis komentar Anda di sini..." required></textarea>
                        <button type="submit" class="btn-submit-comment">Kirim Komentar</button>
                    </form>
                </div>

            </div>
        </article>

        <!-- Sidebar: tulisan lain -->
        <aside class="jd-sidebar">
            <div class="jd-sidebar-title">Tulisan Lainnya</div>
            <?php
            $bg_arr = ['jg-bg-1', 'jg-bg-2', 'jg-bg-3'];
            foreach ($recents as $idx => $rec):
                if ($rec->slug === $journal->slug) continue;
            ?>
                <a href="<?= base_url('journal/' . $rec->slug) ?>" class="jd-recent-item">
                    <div class="jd-recent-img">
                        <!-- PERBAIKAN: Menggunakan properti 'image' -->
                        <?php if (!empty($rec->image)): ?>
                            <img src="<?= base_url('assets/uploads/journals/' . $rec->image) ?>" alt="<?= htmlspecialchars($rec->title) ?>">
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

<script>
    function replyTo(commentId, authorName) {
        document.getElementById('parent_id').value = commentId;
        document.getElementById('reply-to-name').innerText = authorName;
        document.getElementById('reply-indicator').style.display = 'flex';
        document.querySelector('.comment-form-wrap').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    function cancelReply() {
        document.getElementById('parent_id').value = '';
        document.getElementById('reply-indicator').style.display = 'none';
    }
</script>