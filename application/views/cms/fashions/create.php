<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Koleksi Fashion</h1>
    <a href="<?= base_url('fashions') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali</a>
</div>

<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi Kesalahan Validasi:</strong><br>
        <?= validation_errors() ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($error_upload)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal Upload:</strong> <?= $error_upload ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal:</strong> <?= $this->session->flashdata('error_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <form action="<?= base_url('fashions/create') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nama Koleksi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Deskripsi Singkat</label>
                        <textarea class="form-control" name="description" rows="3"><?= set_value('description') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Detail Bahan (Kain)</label>
                        <input type="text" class="form-control" name="fabric_details" value="<?= set_value('fabric_details') ?>" placeholder="Contoh: Katun Toyobo Premium">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Galeri Foto (Bisa pilih banyak) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="image_gallery[]" accept="image/*" multiple required>
                        <small class="text-muted d-block mt-1">Tahan tombol CTRL/CMD untuk memilih lebih dari 1 foto sekaligus. Maksimal 2MB per foto.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-select form-control" name="status">
                            <option value="Draft" <?= set_select('status', 'Draft'); ?>>Draft</option>
                            <option value="Published" <?= set_select('status', 'Published'); ?>>Published</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-save mr-2"></i> Simpan Data</button>
                </div>
            </div>
        </form>
    </div>
</div>