<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otentikasi Eksekutif | Nuansa Rindu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/cms-style.css'); ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/Logo.png') ?>" />
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="brand-logo serif-font">Nuansa Rindu</div>

            <?php if ($this->session->flashdata('error_message')): ?>
                <div class="flash-message bg-danger text-white rounded p-2 mb-3 text-center" style="font-size: 0.85rem;">
                    <?= $this->session->flashdata('error_message'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success_message')): ?>
                <div class="flash-message bg-success text-white rounded p-2 mb-3 text-center" style="font-size: 0.85rem;">
                    <?= $this->session->flashdata('success_message'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <div class="mb-4">
                    <input type="text" name="username" class="form-control" placeholder="ID Pengguna" required autocomplete="off">
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" id="login_pass" name="password" class="form-control border-end-0" placeholder="Kata Sandi" required>
                        <button class="btn border border-start-0 toggle-password bg-white text-muted" type="button" data-target="#login_pass">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4 text-end">
                    <a href="<?= base_url('auth/forgot_password') ?>" class="text-decoration-none text-muted" style="font-size: 0.8rem; font-weight: 500; transition: color 0.3s;" onmouseover="this.style.color='#d4af37'" onmouseout="this.style.color='#6c757d'">Lupa Kata Sandi?</a>
                </div>

                <button type="submit" class="btn btn-luxury">Masuk Portal</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.29/dist/lenis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        // JS Untuk Show/Hide
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

        // Transisi GSAP
        document.addEventListener("DOMContentLoaded", function() {
            gsap.fromTo(".auth-card", {
                y: 30,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 1.5,
                ease: "power3.out",
                delay: 0.2
            });
        });
    </script>
</body>

</html>