<div class="adm-card">
    <div class="adm-card-title">Konsultasi Masuk</div>
    <table class="adm-table">
        <thead><tr>
            <th>#</th><th>Nama</th><th>WhatsApp</th><th>Paket Diminati</th><th>Tanggal</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        <?php if (!empty($leads)): ?>
            <?php foreach ($leads as $i => $lead): ?>
            <tr>
                <td style="color:var(--muted);font-size:0.75rem;"><?= $i+1 ?></td>
                <td><strong><?= htmlspecialchars($lead->client_name) ?></strong></td>
                <td>
                    <a href="https://wa.me/<?= preg_replace('/\D/','',$lead->whatsapp_number) ?>"
                       target="_blank"
                       style="color:var(--gold);display:flex;align-items:center;gap:6px;">
                        <?= htmlspecialchars($lead->whatsapp_number) ?>
                        <span style="font-size:0.6rem;letter-spacing:0.1em;opacity:0.7;">CHAT ↗</span>
                    </a>
                </td>
                <td><?= htmlspecialchars($lead->package_interest ?: '—') ?></td>
                <td style="font-size:0.75rem;color:var(--muted);"><?= date('d M Y, H:i', strtotime($lead->created_at)) ?></td>
                <td>
                    <a href="<?= base_url('admin/leads/delete/'.$lead->id) ?>"
                       class="btn-sm btn-delete"
                       onclick="return confirm('Hapus data konsultasi ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" style="text-align:center;padding:32px;color:var(--muted);">Belum ada konsultasi masuk.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
