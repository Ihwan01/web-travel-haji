<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Pengaturan SEO' ?></h1>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-white">
        <ul class="nav nav-tabs card-header-tabs" id="seoTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active font-weight-bold" id="tracking-tab" data-bs-toggle="tab" data-bs-target="#tracking" type="button" role="tab" aria-controls="tracking" aria-selected="true">
                    <i class="fas fa-code mr-1"></i> Tracking & Analytics
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link font-weight-bold" id="meta-tab" data-bs-toggle="tab" data-bs-target="#meta" type="button" role="tab" aria-controls="meta" aria-selected="false">
                    <i class="fas fa-search mr-1"></i> Page Metadata (SEO)
                </button>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="seoTabsContent">

            <div class="tab-pane fade show active" id="tracking" role="tabpanel" aria-labelledby="tracking-tab">
                <form action="<?= base_url('seo/update_tracking') ?>" method="POST">
                    <p class="text-muted mb-4">Tempelkan script tag pelacakan dari pihak ketiga ke dalam kotak di bawah ini. Kode ini akan otomatis disisipkan ke bagian <code>&lt;head&gt;</code> halaman publik Anda.</p>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Google Search Console (Verifikasi)</label>
                        <textarea class="form-control text-monospace text-sm" name="gsc_code" rows="3" placeholder='<meta name="google-site-verification" content="..." />'><?= htmlspecialchars($tracking->gsc_code ?? '') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Google Analytics 4 (GA4)</label>
                        <textarea class="form-control text-monospace text-sm" name="ga4_code" rows="5" placeholder="..."><?= htmlspecialchars($tracking->ga4_code ?? '') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Meta (Facebook) Pixel</label>
                        <textarea class="form-control text-monospace text-sm" name="meta_pixel_code" rows="5" placeholder="..."><?= htmlspecialchars($tracking->meta_pixel_code ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-2"></i> Simpan Kode Tracking</button>
                </form>
            </div>

            <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                <div class="row">
                    <div class="col-md-5 mb-4 mb-md-0 border-right">
                        <h6 class="font-weight-bold mb-3">Tulis/Perbarui Metadata</h6>
                        <form action="<?= base_url('seo/save_meta') ?>" method="POST">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">URL Halaman Publik <span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="page_url" required>
                                    <option value="">-- Pilih Halaman --</option>
                                    <option value="home">Beranda (Home)</option>
                                    <option value="journey">Daftar Paket (Journey)</option>
                                    <option value="journal">Daftar Artikel (Journal)</option>
                                    <option value="fashion">Fashion & Essentials</option>
                                    <option value="gallery">Galeri & Film</option>
                                    <option value="contact">Hubungi Kami</option>
                                    <option value="about">Tentang Kami</option>
                                </select>
                                <small class="text-muted mt-1 d-block">Catatan: Untuk detail artikel dan paket, meta otomatis diambil dari database judul konten.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Meta Title (Max 70 karakter)</label>
                                <input type="text" class="form-control" name="meta_title" maxlength="70" placeholder="Judul tab browser...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Meta Description (Max 160 karakter)</label>
                                <textarea class="form-control" name="meta_description" rows="3" maxlength="160" placeholder="Deskripsi singkat yang muncul di Google..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords" placeholder="umroh, haji, travel jakarta, dll (pisahkan koma)">
                            </div>
                            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save mr-2"></i> Simpan Metadata</button>
                        </form>
                    </div>

                    <div class="col-md-7">
                        <h6 class="font-weight-bold mb-3">Metadata Aktif Saat Ini</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Halaman (URL)</th>
                                        <th>Meta Title</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($metadata)): foreach ($metadata as $meta): ?>
                                            <tr>
                                                <td><strong><?= htmlspecialchars($meta->page_url) ?></strong></td>
                                                <td><?= htmlspecialchars($meta->meta_title) ?></td>
                                                <td class="text-truncate" style="max-width: 150px;" title="<?= htmlspecialchars($meta->meta_description) ?>">
                                                    <?= htmlspecialchars($meta->meta_description) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada metadata yang disimpan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>