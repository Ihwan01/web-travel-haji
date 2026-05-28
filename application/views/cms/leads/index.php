<?php $this->load->helper('whatsapp'); // Muat helper untuk view ini 
?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Konsultasi Masuk' ?></h1>
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

<div class="card shadow mb-4 border-0">
    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white border-bottom">
        <h6 class="m-0 font-weight-bold" style="color: var(--mahogany);">Daftar Pesan & Konsultasi</h6>

        <form action="<?= base_url('leads') ?>" method="GET" class="d-flex" style="width: 320px;">
            <input type="text" name="q" class="form-control form-control-sm me-2" placeholder="Cari nama / nomor wa..." value="<?= htmlspecialchars($search ?? '') ?>">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
            <?php if (!empty($search)): ?>
                <a href="<?= base_url('leads') ?>" class="btn btn-sm btn-outline-secondary ms-2" title="Reset Pencarian"><i class="fas fa-times"></i></a>
            <?php endif; ?>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Tanggal Masuk</th>
                        <th width="20%">Nama Calon Jamaah</th>
                        <th width="20%">WhatsApp</th>
                        <th>Minat Paket</th>

                        <?php if (isset($role_id) && in_array($role_id, [1, 2])): ?>
                            <th width="10%" class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($leads)): ?>
                        <?php $no = $page_number + 1;
                        foreach ($leads as $lead): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="small text-muted">
                                    <span class="d-block font-weight-bold text-dark"><?= date('d M Y', strtotime($lead->created_at)) ?></span>
                                    <?= date('H:i', strtotime($lead->created_at)) ?> WIB
                                </td>
                                <td><strong><?= htmlspecialchars($lead->client_name) ?></strong></td>
                                <td>
                                    <a href="https://wa.me/<?= normalize_whatsapp($lead->whatsapp_number) ?>" target="_blank" class="btn btn-sm btn-success mb-1 w-100 text-start shadow-sm">
                                        <i class="fab fa-whatsapp me-1"></i> Hubungi Balik
                                    </a>
                                    <div class="small fw-bold text-dark mt-1 text-center font-monospace" style="letter-spacing: 0.5px;">
                                        <?= format_whatsapp($lead->whatsapp_number) ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if (!empty($lead->package_interest)): ?>
                                        <span class="badge bg-info text-dark">Minat: <?= htmlspecialchars($lead->package_interest) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small">Konsultasi Umum</span>
                                    <?php endif; ?>
                                </td>

                                <?php if (isset($role_id) && in_array($role_id, [1, 2])): ?>
                                    <td class="text-center">
                                        <a href="<?= base_url('leads/delete/' . $lead->id) ?>" class="btn btn-sm btn-danger" title="Hapus Pesan" onclick="return confirm('Yakin ingin menghapus pesan ini?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= (isset($role_id) && in_array($role_id, [1, 2])) ? '6' : '5' ?>" class="text-center py-5 text-muted">
                                <?= !empty($search) ? '<i class="fas fa-search-minus fa-2x mb-2 text-black-50"></i><br>Pencarian tidak ditemukan.' : 'Belum ada pesan atau konsultasi yang masuk.' ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($pagination)): ?>
            <div class="mt-4">
                <?= $pagination ?>
            </div>
        <?php endif; ?>
    </div>
</div>