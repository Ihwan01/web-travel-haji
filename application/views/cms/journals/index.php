<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Manajemen Artikel' ?></h1>
    <a href="<?= base_url('journals/create') ?>" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tulis Artikel Baru
    </a>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Publikasi & Artikel</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%" class="text-center">Sampul</th>
                        <th>Judul Artikel</th>
                        <th width="15%" class="text-center">Tanggal Dibuat</th>
                        <th width="10%" class="text-center">Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($journals)): ?>
                        <?php $no = 1;
                        foreach ($journals as $j): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center">
                                    <?php if ($j->image): ?>
                                        <img src="<?= base_url('assets/uploads/journals/' . $j->image) ?>" alt="Sampul" class="img-thumbnail" style="max-height: 60px;">
                                    <?php else: ?>
                                        <span class="text-muted small">Tanpa Gambar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($j->title) ?></strong><br>
                                    <small class="text-muted">Slug: <?= htmlspecialchars($j->slug) ?></small><br>
                                    <?php if (!empty($j->tags)): ?>
                                        <small class="text-info"><i class="fas fa-tags mr-1"></i> <?= htmlspecialchars($j->tags) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center text-muted small">
                                    <?= date('d M Y, H:i', strtotime($j->created_at)) ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($j->status == 'Published'): ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('journals/comments/' . $j->id) ?>" class="btn btn-sm btn-secondary mb-1" title="Kelola Komentar"><i class="fas fa-comments"></i></a>
                                    <a href="<?= base_url('journals/edit/' . $j->id) ?>" class="btn btn-sm btn-info text-white mb-1" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('journals/delete/' . $j->id) ?>" class="btn btn-sm btn-danger mb-1" title="Hapus" onclick="return confirm('Yakin ingin menghapus artikel ini secara permanen?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada artikel yang diterbitkan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>