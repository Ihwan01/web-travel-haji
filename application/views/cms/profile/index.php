<h3 class="serif-font mb-4" style="color: var(--mahogany);">Profil Saya</h3>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success_message') ?></div>
<?php endif; ?>

<div class="welcome-card card border-0 p-4 shadow-sm" style="max-width: 700px;">
    <form action="<?= base_url('profile/update') ?>" method="POST" enctype="multipart/form-data">

        <div class="d-flex align-items-center mb-4">
            <?php if (!empty($user->profile_picture)): ?>
                <img src="<?= base_url($user->profile_picture) ?>" class="rounded-circle border" style="width:100px; height:100px; object-fit:cover; margin-right:20px;">
            <?php else: ?>
                <i class="fas fa-user-circle fa-4x text-muted" style="margin-right:20px;"></i>
            <?php endif; ?>

            <div class="flex-grow-1">
                <label class="form-label text-muted" style="font-size:0.85rem; letter-spacing:1px;">UBAH FOTO PROFIL</label>
                <input type="file" name="profile_picture" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">USERNAME</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user->username) ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label text-muted" style="font-size: 0.85rem; letter-spacing: 1px;">EMAIL</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user->email) ?>" required>
        </div>

        <div class="mb-5 bg-light p-3 border">
            <label class="form-label text-danger" style="font-size: 0.85rem; letter-spacing: 1px;">UBAH KATA SANDI BARU</label>
            <input type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak ingin mengubah password">
        </div>

        <button type="submit" class="btn btn-luxury" style="margin:0;">SIMPAN PERUBAHAN PROFIL</button>
    </form>
</div>