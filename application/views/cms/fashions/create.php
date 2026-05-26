<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Koleksi Fashion</h1>
    <a href="<?= base_url('fashions') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali</a>
</div>

<?php if (validation_errors()) : ?>
    <div class="alert alert-danger"><?= validation_errors() ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
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
                        <label class="form-label font-weight-bold">Galeri Foto (Bisa pilih banyak)</label>
                        <input type="file" class="form-control" name="image_gallery[]" accept="image/*" multiple>
                        <small class="text-muted">Tahan tombol CTRL/CMD untuk memilih lebih dari 1 foto sekaligus.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-select form-control" name="status">
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-save mr-2"></i> Simpan Data</button>
                </div>
            </div>
        </form>
    </div>
</div>