<div class="container dashboard-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="welcome-card text-center">
                <h2 class="serif-font mb-3" style="color: var(--mahogany);">Selamat Datang, <?= ucfirst($username); ?>.</h2>
                <p class="text-muted" style="font-weight: 300;">
                    Otoritas Akses:
                    <strong>
                        <?php
                        if ($role_id == 1) echo 'Super Admin';
                        elseif ($role_id == 2) echo 'Administrator';
                        else echo 'Kontributor Jurnal';
                        ?>
                    </strong>
                </p>
                <hr class="my-4" style="border-color: var(--border-light);">
                <p style="font-size: 0.95rem; line-height: 1.8;">
                    Ini adalah ruang kendali utama platform eksekutif Nuansa Rindu. Dari sini, Anda dapat mengkurasi perjalanan spiritual, menulis jurnal sinematik, dan mengelola koleksi mode dengan standar kualitas tertinggi.
                </p>
            </div>
        </div>
    </div>
</div>