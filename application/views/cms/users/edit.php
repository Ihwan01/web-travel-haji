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

                <form action="<?= base_url('users/edit/' . $user['id']) ?>" method="POST" autocomplete="off">
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">USERNAME</label>
                        <input type="text" name="username" class="form-control" value="<?= set_value('username', $user['username']) ?>" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">EMAIL</label>
                        <input type="email" name="email" class="form-control" value="<?= set_value('email', $user['email']) ?>" required autocomplete="off">
                    </div>

                    <div class="mb-4 bg-light p-3 border rounded">
                        <label class="form-label font-weight-bold text-danger">Ganti Kata Sandi (Opsional)</label>
                        <div class="input-group">
                            <input type="password" id="edit_user_pass" name="password" class="form-control" placeholder="Biarkan kosong jika tidak ingin mengubah sandi" autocomplete="new-password">
                            <button class="btn btn-outline-secondary toggle-password bg-white" type="button" data-target="#edit_user_pass">
                                <i class="fas fa-eye text-muted"></i>
                            </button>
                        </div>
                        <small class="text-muted d-block mt-1">Hanya diisi jika Super Admin ingin mereset sandi pengguna ini secara manual.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">OTORITAS AKSES</label>
                        <select name="role_id" id="roleSelect" class="form-select form-control" style="cursor: pointer;" required>
                            <option value="1" <?= set_select('role_id', '1', $user['role_id'] == 1) ?>>Super Admin (Akses Penuh)</option>
                            <option value="2" <?= set_select('role_id', '2', $user['role_id'] == 2) ?>>Administrator (Akses Operasional)</option>
                            <option value="3" <?= set_select('role_id', '3', $user['role_id'] == 3) ?>>Kontributor Jurnal (Akses Penulisan)</option>
                        </select>
                    </div>

                    <div id="modulePermissionsBlock" class="mb-5 bg-light p-4 border rounded" style="display: none;">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Show/Hide Password
        document.querySelectorAll('.toggle-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const input = document.querySelector(this.getAttribute('data-target'));
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Toggle Izin Akses Modul berdasarkan Otoritas
        const roleSelect = document.getElementById('roleSelect');
        const permissionsBlock = document.getElementById('modulePermissionsBlock');

        function togglePermissions() {
            if (roleSelect.value === '3') {
                permissionsBlock.style.display = 'block';
            } else {
                permissionsBlock.style.display = 'none';
            }
        }

        if (roleSelect) {
            togglePermissions();
            roleSelect.addEventListener('change', togglePermissions);
        }
    });
</script>