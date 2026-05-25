<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Perjalanan: <?= $package->name ?></h1>
    <a href="<?= base_url('journeys') ?>" class="btn btn-sm btn-secondary">&larr; Kembali</a>
</div>

<div class="card shadow mb-4">
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
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Tagline</label>
                        <input type="text" class="form-control" name="tagline" value="<?= set_value('tagline', $package->tagline) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Harga Tampil (Display)</label>
                        <input type="text" class="form-control" name="price_display" value="<?= set_value('price_display', $package->price_display) ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Gambar Utama</label>
                        <?php if ($package->main_image): ?>
                            <div class="mb-2"><img src="<?= base_url('assets/uploads/packages/' . $package->main_image) ?>" class="img-thumbnail" width="100%"></div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="main_image">
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
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Detail Itinerary</label>
                    <textarea class="form-control" name="itinerary" id="itinerary" rows="6"><?= set_value('itinerary', $package->itinerary) ?></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Detail Hotel</label>
                    <textarea class="form-control" name="hotel_details" id="hotel_details" rows="6"><?= set_value('hotel_details', $package->hotel_details) ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary px-4">Update Data Perjalanan</button>
        </form>
    </div>
</div>