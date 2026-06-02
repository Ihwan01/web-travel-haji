<div class="container dashboard-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="serif-font mb-0" style="color: var(--mahogany);">Manajemen Pengguna</h3>
        <a href="<?= base_url('users/create') ?>" class="btn-luxury text-decoration-none px-4 py-2 text-center" style="width: auto; margin-top: 0; font-size: 0.75rem;">+ TAMBAH PENGGUNA</a>
    </div>

    <?php if ($this->session->flashdata('success_message')): ?>
        <div class="alert alert-success rounded-0" style="border-left: 4px solid #28a745; background-color: #f8fff9; border-color: #e3f3e6; color: #1e7e34;">
            <?= $this->session->flashdata('success_message'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error_message')): ?>
        <div class="alert alert-danger rounded-0" style="border-left: 4px solid #dc3545; background-color: #fff8f8; border-color: #f3e3e3; color: #bd2130;">
            <?= $this->session->flashdata('error_message'); ?>
        </div>
    <?php endif; ?>

    <div class="welcome-card p-0" style="overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" style="font-size: 0.95rem;">
                <thead style="background-color: var(--soft-cream);">
                    <tr>
                        <th class="px-4 py-3 text-muted" style="font-weight: 500;">USERNAME</th>
                        <th class="px-4 py-3 text-muted" style="font-weight: 500;">EMAIL</th>
                        <th class="px-4 py-3 text-muted" style="font-weight: 500;">OTORITAS</th>
                        <th class="px-4 py-3 text-end text-muted" style="font-weight: 500;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td class="px-4 py-3" style="font-weight: 500; color: var(--mahogany);"><?= html_escape($u['username']) ?></td>
                            <td class="px-4 py-3"><?= html_escape($u['email']) ?></td>
                            <td class="px-4 py-3">
                                <?php
                                if ($u['role_id'] == 1) echo '<span class="badge bg-dark rounded-0 px-2 py-1">Super Admin</span>';
                                elseif ($u['role_id'] == 2) echo '<span class="badge bg-secondary rounded-0 px-2 py-1">Administrator</span>';
                                else echo '<span class="badge bg-light text-dark border rounded-0 px-2 py-1">Kontributor</span>';
                                ?>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-0 px-3 me-2" style="font-size: 0.8rem;">Edit</a>

                                <?php if ($u['id'] != $this->session->userdata('admin_id')): ?>
                                    <a href="<?= base_url('users/force_reset_password/' . $u['id']) ?>" class="btn btn-sm btn-warning rounded-0 px-3 me-2" style="font-size: 0.8rem; font-weight:500;" onclick="return confirm('Anda yakin ingin me-reset kata sandi <?= $u['username'] ?> ke sandi bawaan sistem (NuansaRindu2026!)?')">
                                        <i class="fas fa-key me-1"></i> Reset Sandi
                                    </a>

                                    <a href="<?= base_url('users/delete/' . $u['id']) ?>" class="btn btn-sm btn-outline-danger rounded-0 px-3" style="font-size: 0.8rem;" onclick="return confirm('Tindakan ini tidak dapat dibatalkan. Hapus akun ini?')">Hapus</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>