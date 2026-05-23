<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otentikasi Eksekutif | Nuansa Rindu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/cms-style.css'); ?>">
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="brand-logo serif-font">
                Nuansa Rindu
            </div>

            <?php if ($this->session->flashdata('error_message')): ?>
                <div class="flash-message">
                    <?= $this->session->flashdata('error_message'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <div class="mb-4">
                    <input type="text" name="username" class="form-control" placeholder="ID Pengguna" required autocomplete="off">
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                </div>
                <button type="submit" class="btn btn-luxury">Masuk Portal</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.29/dist/lenis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        // 1. Inisialisasi Smooth Scroll Lenis
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            smooth: true,
            smoothTouch: false,
        });

        // 2. Sinkronisasi Mutlak Ticker GSAP & Lenis
        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        }, false, true);

        // 3. Transisi Masuk Sinematik Kartu Login (Menggunakan fromTo karena CSS eksternal tidak menahan opacity)
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