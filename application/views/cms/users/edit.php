<div class="container dashboard-wrapper">
    <div class="mb-4">
        <a href="<?= base_url('users') ?>" class="text-decoration-none text-muted" style="font-size: 0.9rem; transition: color 0.3s;" onmouseover="this.style.color='var(--mahogany)'" onmouseout="this.style.color='#6c757d'">&larr; Kembali ke Daftar Pengguna</a>
        <h3 class="serif-font mt-2" style="color: var(--mahogany);">Edit Data Pengguna</h3>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="welcome-card card shadow-sm border-0 p-4">
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger rounded-0" style="border-left: 4px solid #dc3545;">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error_message')): ?>
                    <div class="alert alert-danger rounded-0" style="border-left: 4px solid #dc3545;">
                        <?= $this->session->flashdata('error_message'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('users/edit/' . $user['id']) ?>" method="POST">
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">USERNAME</label>
                        <input type="text" name="username" class="form-control" value="<?= set_value('username', $user['username']) ?>" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">EMAIL</label>
                        <input type="email" name="email" class="form-control" value="<?= set_value('email', $user['email']) ?>" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">KATA SANDI BARU (OPSIONAL)</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah kata sandi">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">OTORITAS AKSES</label>
                        <select name="role_id" class="form-select form-control" style="cursor: pointer;" required>
                            <option value="1" <?= set_select('role_id', '1', $user['role_id'] == 1) ?>>Super Admin (Akses Penuh)</option>
                            <option value="2" <?= set_select('role_id', '2', $user['role_id'] == 2) ?>>Administrator (Akses Operasional)</option>
                            <option value="3" <?= set_select('role_id', '3', $user['role_id'] == 3) ?>>Kontributor Jurnal (Akses Penulisan)</option>
                        </select>
                    </div>

                    <div class="mb-5 bg-light p-4 border rounded">
                        <label class="form-label fw-bold text-dark mb-1">Berikan Izin Akses Modul</label>
                        <p class="text-muted small mb-3">Centang modul yang boleh dikelola oleh pengguna ini.</p>

                        <?php
                        // Pecah string dari database menjadi array
                        $user_modules = isset($user['allowed_modules']) ? explode(',', $user['allowed_modules']) : [];
                        ?>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="allowed_modules[]" value="journals" id="mod_journals" <?= in_array('journals', $user_modules) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="mod_journals">Manajemen Artikel (Journals & Komentar)</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="allowed_modules[]" value="galleries" id="mod_galleries" <?= in_array('galleries', $user_modules) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="mod_galleries">Manajemen Galeri & Film (Galleries)</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="allowed_modules[]" value="journeys" id="mod_journeys" <?= in_array('journeys', $user_modules) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="mod_journeys">Manajemen Paket Perjalanan (Journeys)</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="allowed_modules[]" value="fashions" id="mod_fashions" <?= in_array('fashions', $user_modules) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="mod_fashions">Manajemen Perlengkapan (Fashions)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="allowed_modules[]" value="leads" id="mod_leads" <?= in_array('leads', $user_modules) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="mod_leads">Manajemen Konsultasi Masuk (Leads)</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-luxury w-100 py-2">PERBARUI DATA</button>
                </form>
            </div>
        </div>
    </div>
</div>