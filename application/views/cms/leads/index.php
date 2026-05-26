<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($title) ? $title : 'Konsultasi Masuk' ?></h1>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pesan & Pertanyaan Jamaah</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Tanggal</th>
                        <th width="20%">Nama Pengirim</th>
                        <th width="15%">Kontak</th>
                        <th>Isi Pesan / Pertanyaan</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($leads)): ?>
                        <?php $no = 1;
                        foreach ($leads as $lead): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="small text-muted">
                                    <?= date('d M Y', strtotime($lead->created_at)) ?><br>
                                    <?= date('H:i', strtotime($lead->created_at)) ?> WIB
                                </td>
                                <td><strong><?= htmlspecialchars($lead->name) ?></strong></td>
                                <td>
                                    <?php if (!empty($lead->phone)): ?>
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $lead->phone) ?>" target="_blank" class="btn btn-sm btn-success mb-1 w-100">
                                            <i class="fab fa-whatsapp"></i> WhatsApp
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($lead->email)): ?>
                                        <a href="mailto:<?= htmlspecialchars($lead->email) ?>" class="btn btn-sm btn-outline-secondary w-100" style="font-size: 0.75rem;">
                                            <i class="fas fa-envelope"></i> Email
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td><?= nl2br(htmlspecialchars($lead->message)) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('leads/delete/' . $lead->id) ?>" class="btn btn-sm btn-danger" title="Hapus Pesan" onclick="return confirm('Yakin ingin menghapus pesan ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada pesan atau konsultasi yang masuk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>