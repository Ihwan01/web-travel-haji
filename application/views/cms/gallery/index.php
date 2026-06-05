<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Kelola Experience' ?></h1>
    <a href="<?= base_url('galleries/create') ?>" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-upload fa-sm text-white-50 mr-1"></i> Unggah Media
    </a>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%" class="text-center">Pratinjau</th>
                        <th>Informasi Media</th>
                        <th width="10%" class="text-center">Tipe</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($media)): ?>
                        <?php $no = 1;
                        foreach ($media as $m): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center">
                                    <?php if ($m->media_type == 'Photo'): ?>
                                        <img src="<?= base_url($m->file_url) ?>" alt="Foto" class="img-thumbnail" style="height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                        <?php if ($m->thumbnail_url): ?>
                                            <img src="<?= base_url($m->thumbnail_url) ?>" alt="Thumb" class="img-thumbnail" style="height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-dark text-white rounded d-flex align-items-center justify-content-center" style="height: 60px; width: 80px; margin: auto;">
                                                <i class="fas fa-video"></i>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($m->title) ?></strong><br>
                                    <small class="text-muted"> Diunggah: <?= date('d M Y', strtotime($m->created_at)) ?></small>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $m->media_type == 'Video' ? 'bg-danger' : 'bg-success' ?>">
                                        <?= $m->media_type ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('galleries/edit/' . $m->id) ?>" class="btn btn-sm btn-info text-white" title="Edit Media">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('galleries/delete/' . $m->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus media ini secara permanen?');" title="Hapus Media">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Belum ada media yang diunggah.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>