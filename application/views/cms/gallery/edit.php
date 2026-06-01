<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Media</h1>
</div>

<div class="card shadow mb-4 border-left-info">
    <div class="card-body">
        <form action="<?= base_url('galleries/edit/' . $media->id) ?>" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label font-weight-bold">Judul Media</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($media->title) ?>" required>
            </div>

            <?php if ($media->media_type == 'Video'): ?>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Tautan Video Baru (Opsional)</label>
                    <input type="text" name="video_url" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah tautan">
                    <small class="text-muted d-block mt-1">Saat ini: <a href="<?= $media->file_url ?>" target="_blank">Lihat Video Aktif</a></small>
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Ganti Sampul / Thumbnail (Opsional)</label>
                    <input type="file" name="thumbnail_url" class="form-control" accept="image/*">
                </div>
            <?php else: ?>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Ganti File Foto (Opsional)</label>
                    <input type="file" name="file_url" class="form-control" accept="image/*">
                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti foto saat ini.</small>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
            <a href="<?= base_url('galleries') ?>" class="btn btn-secondary mt-3 ml-2">Batal</a>
        </form>
    </div>
</div>