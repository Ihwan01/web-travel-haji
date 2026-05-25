<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Manajemen Perjalanan' ?></h1>
    <a href="<?= base_url('journeys/create') ?>" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Perjalanan Baru
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Paket Perjalanan & Koleksi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="12%" class="text-center">Gambar</th>
                        <th>Info Paket</th>
                        <th width="12%">Koleksi</th>
                        <th width="15%">Harga Dasar</th>
                        <th width="10%" class="text-center">Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($packages)): ?>
                        <?php $no = 1;
                        foreach ($packages as $p): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center">
                                    <?php if ($p->main_image): ?>
                                        <img src="<?= base_url('assets/uploads/packages/' . $p->main_image) ?>" alt="<?= $p->name ?>" class="img-thumbnail" style="max-height: 60px;">
                                    <?php else: ?>
                                        <span class="text-muted small">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= $p->name ?></strong><br>
                                    <small class="text-muted"><?= $p->tagline ? $p->tagline : '-' ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?= $p->collection_type ?></span>
                                </td>
                                <td>Rp <?= number_format($p->price, 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <?php if ($p->status == 'Published'): ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('journeys/edit/' . $p->id) ?>" class="btn btn-sm btn-info text-white mb-1" title="Edit">
                                        Edit
                                    </a>
                                    <a href="<?= base_url('journeys/delete/' . $p->id) ?>" class="btn btn-sm btn-danger mb-1" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini? Gambar yang terkait juga akan dihapus dari server.');">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada data perjalanan. Silakan tambahkan paket baru.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>