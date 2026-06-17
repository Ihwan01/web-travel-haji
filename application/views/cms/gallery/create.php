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
                    <input type="file" class="form-control check-file-size" name="file_url" id="file_photo" accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                </div>

                <div class="col-md-6 mb-4" id="video_input_box" style="display: none;">
                    <label class="form-label font-weight-bold">Tautan Video / Kode Embed HTML <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="video_url" rows="4" placeholder="Masukkan Link YouTube/TikTok, atau copas kode HTML <iframe... / <blockquote... dari Instagram di sini."></textarea>
                    <small class="text-muted d-block mt-1">Skrip akan otomatis mengenali link dan mengubahnya menjadi pemutar video.</small>
                    <small class="text-danger d-block mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: text-bottom; margin-right: 4px;">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        Jika tautan dari Tiktok, pastikan video berasal dari profil anda. Tiktok membatasi tautan/embed video dari akun lain.
                    </small>
                </div>

                <div class="col-md-6 mb-4" id="thumbnail_box" style="display: none;">
                    <label class="form-label font-weight-bold">Gambar Sampul (Thumbnail) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control check-file-size" name="thumbnail_url" accept="image/*">
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

    document.addEventListener("DOMContentLoaded", function() {
        toggleMediaInput();

        // VALIDASI JAVASCRIPT: Cek file > 2MB langsung saat dipilih
        var fileInputs = document.querySelectorAll('.check-file-size');
        fileInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    var fileSizeMB = this.files[0].size / 1024 / 1024; // Konversi ke Megabyte
                    if (fileSizeMB > 2) {
                        alert('Peringatan: File yang Anda pilih berukuran ' + fileSizeMB.toFixed(2) + ' MB.\nSistem hanya menerima file maksimal 2 MB. Silakan kompres foto Anda terlebih dahulu.');
                        this.value = ''; // Otomatis mengosongkan form input
                    }
                }
            });
        });
    });
</script>