<!-- DASHBOARD -->
<div class="adm-stats">
    <div class="stat-card"><div class="stat-num"><?= $total_pkg ?></div><div class="stat-label">Journey</div></div>
    <div class="stat-card"><div class="stat-num"><?= $total_jrn ?></div><div class="stat-label">Journal</div></div>
    <div class="stat-card"><div class="stat-num"><?= $total_fsh ?></div><div class="stat-label">Fashion Items</div></div>
    <div class="stat-card"><div class="stat-num"><?= $total_gal ?></div><div class="stat-label">Gallery Media</div></div>
    <div class="stat-card"><div class="stat-num"><?= $total_lead ?></div><div class="stat-label">Konsultasi Masuk</div></div>
</div>

<div class="adm-card">
    <div class="adm-card-title">
        Konsultasi Terbaru
        <a href="<?= base_url('admin/leads') ?>" style="font-size:0.65rem;letter-spacing:0.12em;color:var(--gold);">Lihat Semua →</a>
    </div>
    <?php if (!empty($recent_leads)): ?>
    <table class="adm-table">
        <thead><tr>
            <th>Nama</th><th>WhatsApp</th><th>Paket Diminati</th><th>Tanggal</th>
        </tr></thead>
        <tbody>
        <?php foreach ($recent_leads as $lead): ?>
        <tr>
            <td><?= htmlspecialchars($lead->client_name) ?></td>
            <td>
                <a href="https://wa.me/<?= preg_replace('/\D/','',$lead->whatsapp_number) ?>"
                   target="_blank" style="color:var(--gold);">
                    <?= htmlspecialchars($lead->whatsapp_number) ?>
                </a>
            </td>
            <td><?= htmlspecialchars($lead->package_interest ?: '—') ?></td>
            <td style="font-size:0.75rem;color:var(--muted);"><?= date('d M Y, H:i', strtotime($lead->created_at)) ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p style="font-size:0.82rem;color:var(--muted);padding:12px 0;">Belum ada konsultasi masuk.</p>
    <?php endif; ?>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    <a href="<?= base_url('admin/journey/create') ?>" class="adm-card" style="display:block;cursor:pointer;transition:border .2s;border-bottom:2px solid transparent;" onmouseover="this.style.borderColor='var(--gold)'" onmouseout="this.style.borderColor='transparent'">
        <div style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:var(--brown);margin-bottom:8px;">+ Tambah Journey</div>
        <p style="font-size:0.75rem;color:var(--muted);">Tambah paket perjalanan baru ke website.</p>
    </a>
    <a href="<?= base_url('admin/journal/create') ?>" class="adm-card" style="display:block;cursor:pointer;transition:border .2s;border-bottom:2px solid transparent;" onmouseover="this.style.borderColor='var(--gold)'" onmouseout="this.style.borderColor='transparent'">
        <div style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:var(--brown);margin-bottom:8px;">+ Tulis Journal</div>
        <p style="font-size:0.75rem;color:var(--muted);">Tulis artikel journal baru untuk website.</p>
    </a>
</div>
