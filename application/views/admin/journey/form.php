<?php $pkg = isset($package) ? $package : null; ?>
<div style="max-width:900px;">
    <div style="margin-bottom:24px;">
        <a href="<?= base_url('admin/journey') ?>" style="font-size:0.65rem;letter-spacing:0.14em;text-transform:uppercase;color:var(--muted);">← Kembali</a>
    </div>

    <form action="<?= base_url($pkg ? 'admin/journey/update/'.$pkg->id : 'admin/journey/store') ?>"
          method="POST" enctype="multipart/form-data">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

        <div class="adm-card">
            <div class="adm-card-title"><?= $pkg ? 'Edit Journey' : 'Tambah Journey Baru' ?></div>

            <div class="adm-form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Paket *</label>
                    <input type="text" name="name" class="form-control" required
                           value="<?= $pkg ? htmlspecialchars($pkg->name) : '' ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Koleksi *</label>
                    <select name="collection_type" class="form-control" required>
                        <?php foreach (['Classic','Signature','Private','Sacred'] as $type): ?>
                        <option value="<?= $type ?>" <?= ($pkg && $pkg->collection_type===$type)?'selected':'' ?>><?= $type ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group adm-form-full">
                    <label class="form-label">Tagline</label>
                    <input type="text" name="tagline" class="form-control"
                           placeholder="Contoh: Perjalanan penuh ketenangan"
                           value="<?= $pkg ? htmlspecialchars($pkg->tagline ?? '') : '' ?>">
                </div>
                <div class="form-group adm-form-full">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" style="min-height:150px;"><?= $pkg ? htmlspecialchars($pkg->description ?? '') : '' ?></textarea>
                </div>
                <div class="form-group adm-form-full">
                    <label class="form-label">Itinerary</label>
                    <textarea name="itinerary" class="form-control" style="min-height:180px;"
                              placeholder="Tulis itinerary, satu baris per hari. Contoh:&#10;Hari 1: Keberangkatan dari Jakarta&#10;Hari 2: Tiba di Madinah"><?= $pkg ? htmlspecialchars($pkg->itinerary ?? '') : '' ?></textarea>
                </div>
                <div class="form-group adm-form-full">
                    <label class="form-label">Detail Hotel & Akomodasi</label>
                    <textarea name="hotel_details" class="form-control"><?= $pkg ? htmlspecialchars($pkg->hotel_details ?? '') : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Tampilan Harga</label>
                    <input type="text" name="price_display" class="form-control"
                           placeholder="Contoh: Rp 28.500.000 atau Hubungi Kami"
                           value="<?= $pkg ? htmlspecialchars($pkg->price_display ?? '') : '' ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Draft"     <?= ($pkg && $pkg->status==='Draft')    ?'selected':'' ?>>Draft</option>
                        <option value="Published" <?= (!$pkg || $pkg->status==='Published')?'selected':'' ?>>Published</option>
                    </select>
                </div>
                <div class="form-group adm-form-full">
                    <label class="form-label">Foto Utama <?= $pkg ? '(kosongkan jika tidak ingin mengganti)' : '' ?></label>
                    <input type="file" name="main_image" class="form-control" accept="image/*"
                           onchange="previewImg(this,'prevImg')">
                    <?php if ($pkg && $pkg->main_image): ?>
                    <img id="prevImg" class="form-img-preview" src="<?= base_url($pkg->main_image) ?>" alt="Preview">
                    <?php else: ?>
                    <img id="prevImg" class="form-img-preview" style="display:none;" src="" alt="Preview">
                    <?php endif; ?>
                </div>
            </div>

            <div style="margin-top:8px;display:flex;gap:12px;align-items:center;">
                <button type="submit" class="btn-add"><?= $pkg ? 'Simpan Perubahan' : 'Simpan Journey' ?></button>
                <a href="<?= base_url('admin/journey') ?>" style="font-size:0.72rem;color:var(--muted);">Batal</a>
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
