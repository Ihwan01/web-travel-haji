<div class="adm-card">
    <div class="adm-card-title">
        Daftar Journal
        <a href="<?= base_url('admin/journal/create') ?>" class="btn-add">+ Tulis Journal</a>
    </div>
    <table class="adm-table">
        <thead><tr>
            <th style="width:52px">Foto</th>
            <th>Judul</th><th>Penulis</th><th>Status</th><th>Tanggal</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        <?php if (!empty($journals)): ?>
            <?php foreach ($journals as $jn): ?>
            <tr>
                <td>
                    <?php if ($jn->main_image): ?>
                        <img class="tbl-thumb" src="<?= base_url($jn->main_image) ?>" alt="">
                    <?php else: ?>
                        <div class="tbl-thumb-placeholder"></div>
                    <?php endif; ?>
                </td>
                <td><strong><?= htmlspecialchars($jn->title) ?></strong></td>
                <td><?= htmlspecialchars($jn->author_name ?? '—') ?></td>
                <td><span class="badge badge-<?= strtolower($jn->status) ?>"><?= $jn->status ?></span></td>
                <td style="font-size:0.72rem;color:var(--muted);"><?= date('d M Y', strtotime($jn->created_at)) ?></td>
                <td style="display:flex;gap:6px;flex-wrap:wrap;padding-top:14px;">
                    <a href="<?= base_url('admin/journal/edit/'.$jn->id) ?>" class="btn-sm btn-edit">Edit</a>
                    <a href="<?= base_url('admin/journal/delete/'.$jn->id) ?>" class="btn-sm btn-delete"
                       onclick="return confirm('Hapus journal ini?')">Hapus</a>
                    <a href="<?= base_url('journal/'.$jn->slug) ?>" target="_blank" class="btn-sm btn-edit">Lihat</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" style="text-align:center;padding:32px;color:var(--muted);">Belum ada journal. <a href="<?= base_url('admin/journal/create') ?>" style="color:var(--gold);">Tulis sekarang →</a></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
