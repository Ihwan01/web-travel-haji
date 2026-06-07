<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Perjalanan: <?= $package->name ?></h1>
    <a href="<?= base_url('journeys') ?>" class="btn btn-sm btn-secondary">&larr; Kembali</a>
</div>

<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <form action="<?= base_url('journeys/edit/' . $package->id) ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nama Perjalanan</label>
                        <input type="text" class="form-control" name="name" value="<?= set_value('name', $package->name) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Tipe Koleksi</label>
                            <select class="form-select form-control" name="collection_type">
                                <?php foreach (['Classic', 'Signature', 'Private', 'Sacred'] as $type): ?>
                                    <option value="<?= $type ?>" <?= ($package->collection_type == $type) ? 'selected' : '' ?>><?= $type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Harga Dasar</label>
                            <input type="number" class="form-control" name="price" value="<?= set_value('price', $package->price) ?>" required>
                        </div>
                    </div>

                    <div class="row bg-light pt-3 pb-1 mb-3 rounded border">
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold">Durasi</label>
                            <input type="text" class="form-control" name="duration" value="<?= set_value('duration', isset($package->duration) ? $package->duration : '') ?>" placeholder="Contoh: 10 - 14 Hari">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold">Keberangkatan</label>
                            <input type="text" class="form-control" name="departure" value="<?= set_value('departure', isset($package->departure) ? $package->departure : '') ?>" placeholder="Contoh: 24 Sep 2024">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label font-weight-bold">Kapasitas / Kuota Grup</label>
                            <input type="number" class="form-control" name="capacity" value="<?= set_value('capacity', isset($package->capacity) ? $package->capacity : '') ?>" placeholder="Contoh: 40">
                            <small class="text-muted d-block mt-1">Kuota maksimal jamaah per grup keberangkatan (Hanya angka).</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Tagline</label>
                            <input type="text" class="form-control" name="tagline" value="<?= set_value('tagline', $package->tagline) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Harga Tampil (Display)</label>
                            <input type="text" class="form-control" name="price_display" value="<?= set_value('price_display', $package->price_display) ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Gambar Utama</label>
                        <?php if ($package->main_image): ?>
                            <div class="mb-2"><img src="<?= base_url('assets/uploads/packages/' . $package->main_image) ?>" class="img-thumbnail" width="100%"></div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="main_image">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-select form-control" name="status">
                            <option value="Draft" <?= ($package->status == 'Draft') ? 'selected' : '' ?>>Draf</option>
                            <option value="Published" <?= ($package->status == 'Published') ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Tentang Perjalanan Ini</label>
                    <small class="text-info d-block mb-2"><i class="fas fa-info-circle"></i> Gunakan kolom ini untuk mendeskripsikan secara detail tentang perjalanan ini kepada calon jamaah.</small>
                    <textarea class="form-control" name="itinerary" id="itinerary" rows="6"><?= set_value('itinerary', $package->itinerary) ?></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Yang Kami Siapkan</label>
                    <small class="text-info d-block mb-2"><i class="fas fa-info-circle"></i> Pisahkan dengan baris baru (Enter) untuk menampilkan daftar list fasilitas/pelayanan di halaman frontend.</small>
                    <textarea class="form-control" name="hotel_details" id="hotel_details" rows="6"><?= set_value('hotel_details', $package->hotel_details) ?></textarea>
                </div>
            </div>
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save mr-2"></i> Update Data Perjalanan</button>
            </div>
        </form>
    </div>
</div>