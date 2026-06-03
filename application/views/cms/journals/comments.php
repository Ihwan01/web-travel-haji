<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thread Komentar: <?= htmlspecialchars($journal->title) ?></h1>
    <a href="<?= base_url('journals') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali</a>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body bg-light">
        <?php
        // ==============================================================
        // FUNGSI REKURSIF UNTUK MENAMPILKAN PERCAKAPAN MENGALIR (THREAD)
        // ==============================================================
        if (!function_exists('render_comment_tree')) {
            function render_comment_tree($comments, $journal_id, $parent_id = NULL, $level = 0)
            {
                // Konfigurasi indentasi margin kiri (max menjorok 5 level agar tidak terlalu sempit)
                $margin_left = $level > 0 ? min($level * 3, 15) . 'rem' : '0';

                $has_children = false;

                foreach ($comments as $c):
                    if ($c->parent_id == $parent_id):
                        $has_children = true;

                        // Gaya visual (Warna border & latar) untuk membedakan Admin dan Klien
                        $bg_class = $c->is_admin_reply ? 'bg-white border-info' : 'bg-white border-secondary';
                        $text_color = $c->is_admin_reply ? 'text-info' : 'text-primary';
                        $icon = $c->is_admin_reply ? '<i class="fas fa-user-shield me-1"></i> ' : '';
        ?>

                        <div class="border rounded p-3 mb-3 shadow-sm <?= $bg_class ?>" style="margin-left: <?= $margin_left ?>; border-left-width: 4px !important;">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong class="<?= $text_color ?>"><?= $icon . htmlspecialchars($c->name) ?></strong>
                                    <small class="text-muted ml-2"><i class="far fa-clock"></i> <?= date('d M Y H:i', strtotime($c->created_at)) ?></small>
                                </div>
                                <div>
                                    <?php if ($c->status == 'Pending'): ?>
                                        <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                                    <?php elseif ($c->status == 'Approved'): ?>
                                        <span class="badge bg-success">Tayang</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <p class="mb-2 text-dark" style="font-size: 0.95rem;"><?= nl2br(htmlspecialchars($c->comment)) ?></p>

                            <div class="mt-3">
                                <?php if ($c->status == 'Pending' || $c->status == 'Rejected'): ?>
                                    <a href="<?= base_url('journals/approve_comment/' . $c->id . '/' . $journal_id . '/Approved') ?>" class="btn btn-sm btn-success">Setujui & Tayangkan</a>
                                <?php endif; ?>
                                <?php if ($c->status == 'Pending' || $c->status == 'Approved'): ?>
                                    <a href="<?= base_url('journals/approve_comment/' . $c->id . '/' . $journal_id . '/Rejected') ?>" class="btn btn-sm btn-warning">Sembunyikan (Tolak)</a>
                                <?php endif; ?>

                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#replyBox<?= $c->id ?>">Balas</button>
                                <a href="<?= base_url('journals/delete_comment/' . $c->id . '/' . $journal_id) ?>" class="btn btn-sm btn-outline-danger float-end" onclick="return confirm('Hapus permanen komentar ini dan seluruh balasan di bawahnya?');">Hapus</a>
                            </div>

                            <div class="collapse mt-3" id="replyBox<?= $c->id ?>">
                                <form action="<?= base_url('journals/reply_comment/' . $journal_id) ?>" method="POST">
                                    <input type="hidden" name="parent_id" value="<?= $c->id ?>">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="reply_message" placeholder="Ketik balasan Anda..." required>
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>

        <?php
                        // !!! [INTI REKURSIF] Panggil kembali fungsi ini untuk mencari anak dari komentar ini !!!
                        render_comment_tree($comments, $journal_id, $c->id, $level + 1);

                    endif;
                endforeach;

                return $has_children;
            }
        }

        // ==============================================================
        // MULAI EKSEKUSI PEMANGGILAN DARI ROOT (parent_id = NULL)
        // ==============================================================
        if (!empty($comments)) {
            render_comment_tree($comments, $journal->id, NULL, 0);
        } else {
            echo '<div class="text-center py-5 text-muted"><i class="fas fa-comment-slash fa-3x mb-3 text-gray-300"></i><br>Belum ada komentar pada artikel ini.</div>';
        }
        ?>
    </div>
</div>