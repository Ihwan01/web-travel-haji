<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Unggah Media' ?></h1>
    <a href="<?= base_url('galleries') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali</a>
</div>

<?php if (validation_errors() || $this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= validation_errors() ?>
        <?= $this->session->flashdata('error_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <form action="<?= base_url('galleries/create') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label font-weight-bold">Judul / Keterangan Media <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="<?= set_value('title') ?>" required placeholder="Contoh: Keseruan Jamaah di Madinah">
                </div>
                <div class="col-md-3 mb-4">
                    <label class="form-label font-weight-bold">Tipe Media <span class="text-danger">*</span></label>
                    <select class="form-select form-control" name="media_type" id="media_type" required onchange="toggleThumbnail()">
                        <option value="Photo" <?= set_select('media_type', 'Photo'); ?>>Foto</option>
                        <option value="Video" <?= set_select('media_type', 'Video'); ?>>Video (MP4)</option>
                    </select>
                </div>
                <div class="col-md-3 mb-4">
                    <label class="form-label font-weight-bold">Rasio (Bentuk) <span class="text-danger">*</span></label>
                    <select class="form-select form-control" name="aspect_ratio" required>
                        <option value="Landscape" <?= set_select('aspect_ratio', 'Landscape'); ?>>Landscape (Mendatar)</option>
                        <option value="Portrait" <?= set_select('aspect_ratio', 'Portrait'); ?>>Portrait (Memanjang)</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label font-weight-bold">File Media Utama <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="file_url" required>
                    <small class="text-muted d-block mt-1">Foto: JPG/PNG/WEBP. Video: MP4. Maks 100MB.</small>
                </div>
                <div class="col-md-6 mb-4" id="thumbnail_box" style="display: none;">
                    <label class="form-label font-weight-bold">Thumbnail Video (Opsional)</label>
                    <input type="file" class="form-control" name="thumbnail_url" accept="image/*">
                    <small class="text-muted d-block mt-1">Gambar sampul yang tampil sebelum video diputar.</small>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-upload mr-2"></i> Mulai Unggah</button>
        </form>
    </div>
</div>

<script>
    // Script sederhana untuk menyembunyikan input Thumbnail jika tipenya Foto
    function toggleThumbnail() {
        var type = document.getElementById('media_type').value;
        var thumbBox = document.getElementById('thumbnail_box');
        if (type === 'Video') {
            thumbBox.style.display = 'block';
        } else {
            thumbBox.style.display = 'none';
        }
    }
    // Jalankan saat pertama kali dimuat
    document.addEventListener("DOMContentLoaded", toggleThumbnail);
</script>