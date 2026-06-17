<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Media</h1>
</div>

<?php if (validation_errors() || $this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= validation_errors() ?>
        <?= $this->session->flashdata('error_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4 border-left-info">
    <div class="card-body">
        <form action="<?= base_url('galleries/edit/' . $media->id) ?>" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label font-weight-bold">Judul Media</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($media->title) ?>" required>
            </div>

            <?php if ($media->media_type == 'Video'): ?>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Tautan / Kode Embed Video Baru (Opsional)</label>
                    <textarea name="video_url" class="form-control" rows="4" placeholder="Kosongkan jika tidak ingin mengubah tautan/embed saat ini"></textarea>
                    <small class="text-muted d-block mt-1">Sistem mendukung link pendek TikTok, URL YouTube, maupun copas kode HTML Iframe/Blockquote Instagram.</small>
                    <small class="text-danger d-block mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: text-bottom; margin-right: 4px;">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        Jika tautan dari Tiktok, pastikan video berasal dari profil anda. Tiktok membatasi tautan/embed video dari akun lain.
                    </small>
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Ganti Sampul / Thumbnail (Opsional)</label>
                    <input type="file" name="thumbnail_url" class="form-control check-file-size" accept="image/*">
                </div>
            <?php else: ?>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Ganti File Foto (Opsional)</label>
                    <input type="file" name="file_url" class="form-control check-file-size" accept="image/*">
                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti foto saat ini.</small>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
            <a href="<?= base_url('galleries') ?>" class="btn btn-secondary mt-3 ml-2">Batal</a>
        </form>
    </div>
</div>

<script>
    // VALIDASI JAVASCRIPT: Cek file > 2MB langsung saat dipilih
    document.addEventListener("DOMContentLoaded", function() {
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