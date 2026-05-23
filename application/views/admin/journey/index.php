<div class="adm-card">
    <div class="adm-card-title">
        Daftar Journey
        <a href="<?= base_url('admin/journey/create') ?>" class="btn-add">+ Tambah Journey</a>
    </div>
    <table class="adm-table">
        <thead><tr>
            <th style="width:52px">Foto</th>
            <th>Nama</th><th>Koleksi</th><th>Harga</th><th>Status</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        <?php if (!empty($packages)): ?>
            <?php foreach ($packages as $pkg): ?>
            <tr>
                <td>
                    <?php if ($pkg->main_image): ?>
                        <img class="tbl-thumb" src="<?= base_url($pkg->main_image) ?>" alt="">
                    <?php else: ?>
                        <div class="tbl-thumb-placeholder"></div>
                    <?php endif; ?>
                </td>
                <td><strong><?= htmlspecialchars($pkg->name) ?></strong><br>
                    <span style="font-size:0.72rem;color:var(--muted);"><?= htmlspecialchars($pkg->tagline ?? '') ?></span>
                </td>
                <td><?= htmlspecialchars($pkg->collection_type) ?></td>
                <td><?= htmlspecialchars($pkg->price_display ?? '—') ?></td>
                <td><span class="badge badge-<?= strtolower($pkg->status) ?>"><?= $pkg->status ?></span></td>
                <td style="display:flex;gap:6px;flex-wrap:wrap;padding-top:14px;">
                    <a href="<?= base_url('admin/journey/edit/'.$pkg->id) ?>" class="btn-sm btn-edit">Edit</a>
                    <a href="<?= base_url('admin/journey/delete/'.$pkg->id) ?>" class="btn-sm btn-delete"
                       onclick="return confirm('Hapus journey ini?')">Hapus</a>
                    <a href="<?= base_url('journey/'.$pkg->slug) ?>" target="_blank" class="btn-sm btn-edit">Lihat</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" style="text-align:center;padding:32px;color:var(--muted);">Belum ada journey. <a href="<?= base_url('admin/journey/create') ?>" style="color:var(--gold);">Tambah sekarang →</a></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
