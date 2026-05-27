<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Komentar: <?= htmlspecialchars($journal->title) ?></h1>
    <a href="<?= base_url('journals') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali</a>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php if (!empty($comments)): foreach ($comments as $c): ?>

                <?php if ($c->is_admin_reply == 0): ?>
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong class="text-primary"><?= htmlspecialchars($c->name) ?></strong>
                                <small class="text-muted ml-2"><?= date('d M Y H:i', strtotime($c->created_at)) ?></small>
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
                        <p class="mb-2"><?= nl2br(htmlspecialchars($c->comment)) ?></p>

                        <div class="mt-3">
                            <?php if ($c->status == 'Pending' || $c->status == 'Rejected'): ?>
                                <a href="<?= base_url('journals/approve_comment/' . $c->id . '/' . $journal->id . '/Approved') ?>" class="btn btn-sm btn-success">Setujui & Tayangkan</a>
                            <?php endif; ?>
                            <?php if ($c->status == 'Pending' || $c->status == 'Approved'): ?>
                                <a href="<?= base_url('journals/approve_comment/' . $c->id . '/' . $journal->id . '/Rejected') ?>" class="btn btn-sm btn-warning">Sembunyikan (Tolak)</a>
                            <?php endif; ?>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#replyBox<?= $c->id ?>">Balas Komentar</button>
                            <a href="<?= base_url('journals/delete_comment/' . $c->id . '/' . $journal->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus permanen komentar ini?');">Hapus</a>
                        </div>

                        <div class="collapse mt-3" id="replyBox<?= $c->id ?>">
                            <form action="<?= base_url('journals/reply_comment/' . $journal->id) ?>" method="POST">
                                <input type="hidden" name="parent_id" value="<?= $c->id ?>">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="reply_message" placeholder="Ketik balasan Anda..." required>
                                    <button class="btn btn-primary" type="submit">Kirim Balasan</button>
                                </div>
                            </form>
                        </div>

                        <?php foreach ($comments as $reply): ?>
                            <?php if ($reply->parent_id == $c->id): ?>
                                <div class="mt-3 ml-4 p-2 pl-3 border-left border-primary" style="background: #fff;">
                                    <strong class="text-success"><i class="fas fa-reply mr-1"></i> <?= htmlspecialchars($reply->name) ?></strong>
                                    <small class="text-muted ml-2"><?= date('d M Y H:i', strtotime($reply->created_at)) ?></small>
                                    <p class="mb-1 mt-1"><?= nl2br(htmlspecialchars($reply->comment)) ?></p>
                                    <a href="<?= base_url('journals/delete_comment/' . $reply->id . '/' . $journal->id) ?>" class="text-danger small" onclick="return confirm('Hapus balasan ini?');">Hapus Balasan</a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

            <?php endforeach;
        else: ?>
            <div class="text-center py-4 text-muted">Belum ada komentar pada artikel ini.</div>
        <?php endif; ?>
    </div>
</div>