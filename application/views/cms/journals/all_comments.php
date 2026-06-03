<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Semua Komentar (Global)</h1>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4 border-top-primary">
    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white border-bottom">
        <h6 class="m-0 font-weight-bold text-primary">Total: <?= $total_rows ?> Komentar</h6>

        <form action="<?= base_url('journals/all_comments') ?>" method="GET" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="all" <?= $current_status == 'all' ? 'selected' : '' ?>>Semua Status</option>
                <option value="Pending" <?= $current_status == 'Pending' ? 'selected' : '' ?>>Menunggu Persetujuan</option>
                <option value="Approved" <?= $current_status == 'Approved' ? 'selected' : '' ?>>Ditayangkan</option>
                <option value="Rejected" <?= $current_status == 'Rejected' ? 'selected' : '' ?>>Ditolak</option>
            </select>

            <select name="limit" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 100px;">
                <option value="10" <?= $current_limit == 10 ? 'selected' : '' ?>>10 / hal</option>
                <option value="25" <?= $current_limit == 25 ? 'selected' : '' ?>>25 / hal</option>
                <option value="50" <?= $current_limit == 50 ? 'selected' : '' ?>>50 / hal</option>
                <option value="100" <?= $current_limit == 100 ? 'selected' : '' ?>>100 / hal</option>
            </select>
        </form>
    </div>

    <div class="card-body bg-light">
        <?php if (!empty($comments)): foreach ($comments as $c): ?>

                <div class="border rounded p-3 mb-4 bg-white shadow-sm position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                        <div>
                            <strong class="<?= $c->is_admin_reply ? 'text-info' : 'text-primary' ?> fs-5">
                                <?= $c->is_admin_reply ? '<i class="fas fa-user-shield me-1"></i>' : '' ?>
                                <?= htmlspecialchars($c->name) ?>
                            </strong>
                            <small class="text-muted ml-2"><i class="far fa-clock"></i> <?= date('d M Y, H:i', strtotime($c->created_at)) ?></small>
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

                    <div class="mb-3 text-muted small">
                        Mengomentari Artikel: <a href="<?= base_url('journals/edit/' . $c->journal_id) ?>" class="text-info font-weight-bold text-decoration-none" target="_blank">"<?= htmlspecialchars($c->journal_title ?? 'Artikel Dihapus') ?>"</a>

                        <?php if (!empty($c->replied_to_name)): ?>
                            <span class="mx-2">|</span> <span class="bg-light p-1 rounded"><i class="fas fa-reply text-secondary"></i> Membalas: <strong><?= htmlspecialchars($c->replied_to_name) ?></strong></span>
                        <?php endif; ?>
                    </div>

                    <p class="mb-3 text-dark"><?= nl2br(htmlspecialchars($c->comment)) ?></p>

                    <div class="mt-3 bg-light p-2 rounded">
                        <?php if ($c->status == 'Pending' || $c->status == 'Rejected'): ?>
                            <a href="<?= base_url('journals/approve_comment/' . $c->id . '/' . $c->journal_id . '/Approved?ref=all') ?>" class="btn btn-sm btn-success shadow-sm">Setujui & Tayangkan</a>
                        <?php endif; ?>
                        <?php if ($c->status == 'Pending' || $c->status == 'Approved'): ?>
                            <a href="<?= base_url('journals/approve_comment/' . $c->id . '/' . $c->journal_id . '/Rejected?ref=all') ?>" class="btn btn-sm btn-warning shadow-sm">Sembunyikan (Tolak)</a>
                        <?php endif; ?>

                        <button class="btn btn-sm btn-outline-primary shadow-sm" data-bs-toggle="collapse" data-bs-target="#replyBox<?= $c->id ?>">Balas Komentar Ini</button>
                        <a href="<?= base_url('journals/delete_comment/' . $c->id . '/' . $c->journal_id . '?ref=all') ?>" class="btn btn-sm btn-outline-danger shadow-sm float-end" onclick="return confirm('Hapus permanen komentar beserta balasan di bawahnya?');"><i class="fas fa-trash"></i> Hapus</a>
                    </div>

                    <div class="collapse mt-3" id="replyBox<?= $c->id ?>">
                        <form action="<?= base_url('journals/reply_comment/' . $c->journal_id) ?>" method="POST">
                            <input type="hidden" name="parent_id" value="<?= $c->id ?>">
                            <input type="hidden" name="ref" value="all">
                            <div class="input-group">
                                <input type="text" class="form-control border-primary" name="reply_message" placeholder="Ketik balasan Anda selaku Admin..." required>
                                <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endforeach;
        else: ?>
            <div class="text-center py-5 text-muted">
                <i class="fas fa-comments fa-3x mb-3 text-gray-300"></i><br>
                Tidak ada komentar yang ditemukan sesuai kriteria tersebut.
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($pagination) && !empty($pagination)): ?>
        <div class="card-footer bg-white py-3">
            <?= $pagination ?>
        </div>
    <?php endif; ?>
</div>