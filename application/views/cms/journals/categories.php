<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Kategori</h1>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <!-- Form Tambah Kategori -->
    <div class="col-md-4 mb-4">
        <div class="card shadow border-left-primary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Baru</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('journals/add_category') ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Inspirasi Umroh" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Simpan Kategori</button>
                </form>
                <div class="mt-3 text-muted small">
                    <i class="fas fa-info-circle"></i> Tag (Label) tidak perlu ditambahkan di sini. Anda bisa membuat dan menghapus Tag secara dinamis saat menulis artikel.
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Kategori -->
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th width="10%" class="text-center">No</th>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)): $no = 1;
                                foreach ($categories as $cat): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><strong><?= htmlspecialchars($cat->name) ?></strong></td>
                                        <td class="text-muted"><?= htmlspecialchars($cat->slug) ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('journals/delete_category/' . $cat->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin menghapus kategori ini? Artikel terkait tidak akan ikut terhapus, namun menjadi Tanpa Kategori.');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada kategori yang ditambahkan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>