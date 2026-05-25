<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Tambah Perjalanan Baru' ?></h1>
    <a href="<?= base_url('journeys') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali ke Daftar</a>
</div>

<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi Kesalahan Validasi:</strong><br>
        <?= validation_errors() ?>
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
        <form action="<?= base_url('journeys/create') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nama Perjalanan (Paket) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Tipe Koleksi</label>
                            <select class="form-select form-control" name="collection_type" required>
                                <option value="Classic" <?= set_select('collection_type', 'Classic'); ?>>Classic</option>
                                <option value="Signature" <?= set_select('collection_type', 'Signature'); ?>>Signature</option>
                                <option value="Private" <?= set_select('collection_type', 'Private'); ?>>Private</option>
                                <option value="Sacred" <?= set_select('collection_type', 'Sacred'); ?>>Sacred</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Harga Dasar (Angka Saja)</label>
                            <input type="number" class="form-control" name="price" value="<?= set_value('price') ?>" required placeholder="Contoh: 35000000">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Tagline</label>
                        <input type="text" class="form-control" name="tagline" value="<?= set_value('tagline') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Harga Tampil (Display)</label>
                        <input type="text" class="form-control" name="price_display" value="<?= set_value('price_display') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Gambar Utama (Sampul) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="main_image" accept="image/*" required>
                        <small class="text-muted d-block mt-1">Maksimal ukuran file: 2MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-select form-control" name="status">
                            <option value="Draft" <?= set_select('status', 'Draft'); ?>>Draft</option>
                            <option value="Published" <?= set_select('status', 'Published'); ?>>Published</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Detail Itinerary</label>
                    <textarea class="form-control" name="itinerary" id="itinerary" rows="6"><?= set_value('itinerary') ?></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Detail Hotel & Akomodasi</label>
                    <textarea class="form-control" name="hotel_details" id="hotel_details" rows="6"><?= set_value('hotel_details') ?></textarea>
                </div>
            </div>
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save mr-2"></i> Simpan Data</button>
            </div>
        </form>
    </div>
</div>