<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Tulis Artikel Baru' ?></h1>
    <a href="<?= base_url('journals') ?>" class="btn btn-sm btn-secondary shadow-sm">&larr; Kembali ke Daftar</a>
</div>

<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi Kesalahan Validasi:</strong><br>
        <?= validation_errors() ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($error_upload)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal Upload:</strong> <?= $error_upload ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal:</strong> <?= $this->session->flashdata('error_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <form action="<?= base_url('journals/create') ?>" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="title" value="<?= set_value('title') ?>" required placeholder="Masukkan judul yang menarik...">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold d-flex justify-content-between align-items-center w-100">
                                <span>Kategori <span class="text-danger">*</span></span>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalCategory" class="small text-decoration-none text-primary"><i class="fas fa-plus"></i> Kategori Baru</a>
                            </label>
                            <select class="form-select form-control" name="category_id" id="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php if (!empty($categories)): foreach ($categories as $cat): ?>
                                        <option value="<?= $cat->id ?>" <?= set_select('category_id', $cat->id) ?>><?= htmlspecialchars($cat->name) ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Tags / Label</label>
                            <input type="text" class="form-control" name="tags" value="<?= set_value('tags') ?>" placeholder="Ketik tag lalu tekan enter/koma...">
                            <small class="text-muted d-block mt-1">Tekan Enter atau Koma untuk memisahkan Tag.</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold">Isi Artikel (Konten) <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" id="content" rows="15"><?= set_value('content') ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Gambar Sampul <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                                <small class="text-muted d-block mt-2">Maksimal ukuran: 2MB. Format: JPG/PNG/JPEG.</small>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Status Publikasi</label>
                                <select class="form-select form-control" name="status">
                                    <option value="Draft" <?= set_select('status', 'Draft'); ?>>Simpan sebagai Draf</option>
                                    <option value="Published" <?= set_select('status', 'Published'); ?>>Terbitkan Langsung</option>
                                </select>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-paper-plane mr-2"></i> Simpan Artikel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalCategory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title h6 font-weight-bold">Tambah Kategori Cepat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="new_category_name" class="form-control" placeholder="Nama Kategori (Contoh: Sejarah Islam)">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnSaveCategory">Simpan & Pilih</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    // 1. INISIALISASI TAGIFY
    var inputTags = document.querySelector('input[name=tags]');
    new Tagify(inputTags, {
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
    });

    // 2. AJAX UNTUK TAMBAH KATEGORI DINAMIS
    document.getElementById('btnSaveCategory').addEventListener('click', function() {
        let catName = document.getElementById('new_category_name').value;
        if (catName.trim() === '') {
            alert('Nama kategori tidak boleh kosong!');
            return;
        }

        let formData = new FormData();
        formData.append('name', catName);
        formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');

        let btn = this;
        btn.innerHTML = 'Menyimpan...';
        btn.disabled = true;

        fetch('<?= base_url("journals/add_category") ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    let select = document.getElementById('category_id');
                    let option = new Option(data.name, data.id, true, true);
                    select.add(option);

                    document.getElementById('new_category_name').value = '';
                    let modalEl = document.getElementById('modalCategory');
                    let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.hide();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada server saat menambahkan kategori.');
            })
            .finally(() => {
                btn.innerHTML = 'Simpan & Pilih';
                btn.disabled = false;
            });
    });
</script>