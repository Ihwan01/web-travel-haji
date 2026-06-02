<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi | Nuansa Rindu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/cms-style.css'); ?>">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card text-center">
            <h4 class="serif-font mb-3" style="color: var(--mahogany);">Pemulihan Sandi</h4>
            <p class="text-muted mb-4" style="font-size: 0.85rem;">Masukkan alamat email yang terdaftar, kami akan mengirimkan instruksi pemulihan.</p>

            <?php if ($this->session->flashdata('error_message')): ?>
                <div class="alert alert-danger p-2 text-start" style="font-size: 0.8rem;">
                    <?= $this->session->flashdata('error_message'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success_message')): ?>
                <div class="alert alert-success p-2 text-start" style="font-size: 0.8rem;">
                    <?= $this->session->flashdata('success_message'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/forgot_password') ?>" method="POST">
                <div class="mb-4">
                    <input type="email" name="email" class="form-control text-center" placeholder="email@domain.com" required>
                </div>
                <button type="submit" class="btn btn-luxury w-100 mb-3">Kirim Tautan Pemulihan</button>
            </form>

            <a href="<?= base_url('login') ?>" class="text-muted text-decoration-none" style="font-size: 0.8rem;">&larr; Kembali ke halaman login</a>
        </div>
    </div>
</body>

</html>