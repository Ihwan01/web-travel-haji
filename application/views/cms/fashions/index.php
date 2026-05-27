<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Kelola Fashion' ?></h1>

    <?php if (isset($role_id) && in_array($role_id, [1, 2])): ?>
        <a href="<?= base_url('fashions/create') ?>" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Koleksi
        </a>
    <?php endif; ?>
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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" width="100%">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%" class="text-center">Foto Utama</th>
                        <th>Nama Koleksi</th>
                        <th width="10%" class="text-center">Status</th>

                        <?php if (isset($role_id) && in_array($role_id, [1, 2])): ?>
                            <th width="15%" class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($fashions)): ?>
                        <?php $no = 1;
                        foreach ($fashions as $item):
                            $images = json_decode($item->image_gallery, true);
                            $main_img = !empty($images) ? base_url($images[0]) : '';
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center">
                                    <?php if ($main_img): ?>
                                        <img src="<?= $main_img ?>" alt="Foto" class="img-thumbnail" style="height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="text-muted small">Tanpa Gambar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($item->name) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($item->fabric_details) ?></small>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $item->status == 'Published' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                        <?= $item->status ?>
                                    </span>
                                </td>

                                <?php if (isset($role_id) && in_array($role_id, [1, 2])): ?>
                                    <td class="text-center">
                                        <a href="<?= base_url('fashions/edit/' . $item->id) ?>" class="btn btn-sm btn-info text-white mb-1">Edit</a>
                                        <a href="<?= base_url('fashions/delete/' . $item->id) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Hapus koleksi ini?');">Hapus</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= (isset($role_id) && in_array($role_id, [1, 2])) ? '5' : '4' ?>" class="text-center py-4">Belum ada koleksi fashion.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>