<?php $jn = isset($journal) ? $journal : null; ?>
<div style="max-width:900px;">
    <div style="margin-bottom:24px;">
        <a href="<?= base_url('admin/journal') ?>" style="font-size:0.65rem;letter-spacing:0.14em;text-transform:uppercase;color:var(--muted);">← Kembali</a>
    </div>

    <form action="<?= base_url($jn ? 'admin/journal/update/'.$jn->id : 'admin/journal/store') ?>"
          method="POST" enctype="multipart/form-data">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

        <div class="adm-card">
            <div class="adm-card-title"><?= $jn ? 'Edit Journal' : 'Tulis Journal Baru' ?></div>

            <div class="form-group">
                <label class="form-label">Judul Artikel *</label>
                <input type="text" name="title" class="form-control" required
                       value="<?= $jn ? htmlspecialchars($jn->title) : '' ?>">
            </div>
            <div class="adm-form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Penulis</label>
                    <input type="text" name="author_name" class="form-control"
                           placeholder="Contoh: Tim Nuansa Rindu"
                           value="<?= $jn ? htmlspecialchars($jn->author_name ?? '') : '' ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Draft"     <?= ($jn && $jn->status==='Draft')    ?'selected':'' ?>>Draft</option>
                        <option value="Published" <?= (!$jn || $jn->status==='Published')?'selected':'' ?>>Published</option>
                    </select>
                </div>
                <div class="form-group adm-form-full">
                    <label class="form-label">Foto Utama <?= $jn ? '(kosongkan jika tidak ingin mengganti)' : '' ?></label>
                    <input type="file" name="main_image" class="form-control" accept="image/*"
                           onchange="previewImg(this,'prevJn')">
                    <?php if ($jn && $jn->main_image): ?>
                    <img id="prevJn" class="form-img-preview" src="<?= base_url($jn->main_image) ?>" alt="">
                    <?php else: ?>
                    <img id="prevJn" class="form-img-preview" style="display:none;" src="" alt="">
                    <?php endif; ?>
                </div>
                <div class="form-group adm-form-full">
                    <label class="form-label">Konten Artikel *</label>
                    <textarea name="content" class="form-control" style="min-height:400px;line-height:1.8;" required><?= $jn ? htmlspecialchars($jn->content ?? '') : '' ?></textarea>
                    <p style="font-size:0.65rem;color:var(--muted);margin-top:6px;">Pisahkan paragraf dengan baris kosong. Bisa juga gunakan HTML untuk formatting lebih lanjut.</p>
                </div>
            </div>

            <div style="display:flex;gap:12px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn-add"><?= $jn ? 'Simpan Perubahan' : 'Publikasikan' ?></button>
                <a href="<?= base_url('admin/journal') ?>" style="font-size:0.72rem;color:var(--muted);">Batal</a>
            </div>
        </div>
    </form>
</div>

<script>
function previewImg(input, id) {
    var el = document.getElementById(id);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { el.src = e.target.result; el.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
