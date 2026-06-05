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
                <div class="col-md-9 mb-4">
                    <label class="form-label font-weight-bold">Judul / Keterangan Media <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="<?= set_value('title') ?>" required placeholder="Contoh: Keseruan Jamaah di Madinah">
                </div>
                <div class="col-md-3 mb-4">
                    <label class="form-label font-weight-bold">Tipe Media <span class="text-danger">*</span></label>
                    <select class="form-select form-control" name="media_type" id="media_type" required onchange="toggleMediaInput()">
                        <option value="Photo" <?= set_select('media_type', 'Photo'); ?>>Foto</option>
                        <option value="Video" <?= set_select('media_type', 'Video'); ?>>Video / Embed</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4" id="photo_input_box">
                    <label class="form-label font-weight-bold">File Foto <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="file_url" id="file_photo" accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                </div>

                <div class="col-md-6 mb-4" id="video_input_box" style="display: none;">
                    <label class="form-label font-weight-bold">Tautan Video / Kode Embed HTML <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="video_url" rows="4" placeholder="Masukkan Link YouTube/TikTok, atau copas kode HTML <iframe... / <blockquote... dari Instagram di sini."></textarea>
                    <small class="text-muted d-block mt-1">Skrip akan otomatis mengenali link dan mengubahnya menjadi pemutar video.</small>
                </div>

                <div class="col-md-6 mb-4" id="thumbnail_box" style="display: none;">
                    <label class="form-label font-weight-bold">Gambar Sampul (Thumbnail) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="thumbnail_url" accept="image/*">
                    <small class="text-muted d-block mt-1">Gambar yang akan tampil sebelum video diklik (Play).</small>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save mr-2"></i> Simpan Media</button>
        </form>
    </div>
</div>

<script>
    function toggleMediaInput() {
        var type = document.getElementById('media_type').value;
        var photoBox = document.getElementById('photo_input_box');
        var videoBox = document.getElementById('video_input_box');
        var thumbBox = document.getElementById('thumbnail_box');
        var filePhotoInput = document.getElementById('file_photo');

        if (type === 'Video') {
            photoBox.style.display = 'none';
            filePhotoInput.removeAttribute('required');

            videoBox.style.display = 'block';
            thumbBox.style.display = 'block';
        } else {
            photoBox.style.display = 'block';
            filePhotoInput.setAttribute('required', 'required');

            videoBox.style.display = 'none';
            thumbBox.style.display = 'none';
        }
    }

    document.addEventListener("DOMContentLoaded", toggleMediaInput);
</script>