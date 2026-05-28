<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Profil & Kontak Global' ?></h1>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4 border-0">
    <div class="card-header py-3 bg-white border-bottom">
        <h6 class="m-0 font-weight-bold" style="color: var(--mahogany);">Informasi Kontak Perusahaan</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('company/update') ?>" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Nama Travel / Perusahaan</label>
                    <input type="text" name="company_name" class="form-control" value="<?= htmlspecialchars($company->company_name ?? '') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Email Resmi</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($company->email ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">WhatsApp (Format 628...)</label>
                    <input type="text" name="whatsapp" class="form-control" value="<?= htmlspecialchars($company->whatsapp ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Pesan Awalan WhatsApp</label>
                    <textarea name="whatsapp_message" class="form-control" rows="2" placeholder="Halo Nuansa Rindu, saya ingin bertanya tentang..."><?= htmlspecialchars($company->whatsapp_message ?? '') ?></textarea>
                    <small class="text-muted">Pesan ini akan otomatis terisi saat klien mengklik tombol WA.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Telepon Kantor</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($company->phone ?? '') ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label font-weight-bold">Alamat Lengkap</label>
                    <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($company->address ?? '') ?></textarea>
                </div>

                <div class="col-12 mt-4 mb-3">
                    <h6 class="font-weight-bold border-bottom pb-2">Sosial Media & Peta Lokasi</h6>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold"><i class="fab fa-instagram text-danger"></i> Link Instagram</label>
                    <input type="url" name="instagram_url" class="form-control" placeholder="https://instagram.com/..." value="<?= htmlspecialchars($company->instagram_url ?? '') ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold"><i class="fab fa-facebook text-primary"></i> Link Facebook</label>
                    <input type="url" name="facebook_url" class="form-control" placeholder="https://facebook.com/..." value="<?= htmlspecialchars($company->facebook_url ?? '') ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold"><i class="fab fa-youtube text-danger"></i> Link YouTube</label>
                    <input type="url" name="youtube_url" class="form-control" placeholder="https://youtube.com/..." value="<?= htmlspecialchars($company->youtube_url ?? '') ?>">
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label font-weight-bold"><i class="fas fa-map-marker-alt text-success"></i> Google Maps Iframe (Sematkan HTML)</label>
                    <textarea name="google_maps_iframe" class="form-control text-monospace text-sm" rows="4" placeholder='<iframe src="..."></iframe>'><?= htmlspecialchars($company->google_maps_iframe ?? '') ?></textarea>
                    <small class="text-muted">Buka Google Maps > Bagikan > Sematkan Peta > Salin HTML.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-2"></i> Simpan Pengaturan</button>
        </form>
    </div>
</div>