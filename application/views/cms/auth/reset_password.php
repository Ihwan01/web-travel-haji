<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Sandi | Nuansa Rindu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/cms-style.css'); ?>">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <h4 class="serif-font mb-4 text-center" style="color: var(--mahogany);">Atur Ulang Sandi</h4>

            <?php if ($this->session->flashdata('error_message')): ?>
                <div class="alert alert-danger p-2 text-center" style="font-size: 0.8rem;">
                    <?= $this->session->flashdata('error_message'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/reset_password/' . $token) ?>" method="POST">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" id="pass1" name="password" class="form-control border-end-0" placeholder="Kata Sandi Baru" required>
                        <button class="btn border border-start-0 toggle-password bg-white text-muted" type="button" data-target="#pass1"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="input-group">
                        <input type="password" id="pass2" name="confirm_password" class="form-control border-end-0" placeholder="Konfirmasi Kata Sandi" required>
                        <button class="btn border border-start-0 toggle-password bg-white text-muted" type="button" data-target="#pass2"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <button type="submit" class="btn btn-luxury w-100">Simpan Sandi Baru</button>
            </form>
        </div>
    </div>

    <script>
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
    </script>
</body>

</html>