<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Tulis Artikel Baru' ?></h1>
    <a href="<?= base_url('journals') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali ke Daftar</a>
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

<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <form action="<?= base_url('journals/create') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="title" value="<?= set_value('title') ?>" required placeholder="Masukkan judul yang menarik...">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat->id ?>" <?= set_select('category_id', $cat->id) ?>><?= htmlspecialchars($cat->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Tags / Label</label>
                            <input type="text" class="form-control" name="tags" value="<?= set_value('tags') ?>" placeholder="Ketik tag lalu tekan enter/koma...">
                            <small class="text-muted d-block mt-1">Tekan Enter atau Koma untuk memisahkan Tag.</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Isi Artikel (Konten) <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" id="content" rows="15"><?= set_value('content') ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Gambar Sampul <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                                <small class="text-muted d-block mt-2">Maksimal ukuran: 2MB. Format: JPG/PNG/WEBP.</small>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Status Publikasi</label>
                                <select class="form-select form-control" name="status">
                                    <option value="Draft" <?= set_select('status', 'Draft'); ?>>Simpan sebagai Draf</option>
                                    <option value="Published" <?= set_select('status', 'Published'); ?>>Terbitkan Langsung</option>
                                </select>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-paper-plane mr-2"></i> Simpan Artikel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    // Inisialisasi Tagify agar data tetap dikonversi jadi Comma-Separated String
    var inputTags = document.querySelector('input[name=tags]');
    new Tagify(inputTags, {
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
    });
</script>