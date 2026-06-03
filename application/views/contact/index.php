<!-- ══════════════════════════════════════════════════════
     CONTACT / KONSULTASI PRIVAT — index.php
     ══════════════════════════════════════════════════════ -->

<div class="contact-page">

    <!-- ── HERO ───────────────────────────────────────── -->
    <section class="contact-hero">
        <div class="contact-hero-label">Konsultasi Privat</div>
        <h1 class="contact-hero-title">
            Biarkan kami membantu<br>merancang perjalanan Anda.
        </h1>
        <p class="contact-hero-sub">
            Setiap perjalanan adalah unik, seperti setiap hati yang merindukannya. Ceritakan kepada kami, dan kami akan merancang perjalanan yang paling bermakna untuk Anda.
        </p>
    </section>

    <!-- ── MAIN ────────────────────────────────────────── -->
    <div class="contact-main">

        <div class="contact-info-section reveal">
            <blockquote class="contact-info-quote text-center">
                "Setiap perjalanan dimulai dari sebuah percakapan yang tulus."
            </blockquote>

            <div class="contact-channels">
                <div class="contact-channel-card">
                    <div class="channel-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" />
                        </svg>
                    </div>
                    <p class="channel-label">WhatsApp</p>
                    <p class="channel-value"><?= htmlspecialchars($company->whatsapp ?? '+62 811-8888-9326') ?></p>
                    <p class="channel-note">Senin – Sabtu, 08.00 – 20.00 WIB</p>

                    <?php
                    $wa_num = !empty($company->whatsapp) ? preg_replace('/[^0-9]/', '', $company->whatsapp) : '6281188889326';
                    $default_msg = "Assalamu'alaikum Nuansa Rindu, saya ingin berkonsultasi mengenai perjalanan umrah.";
                    $wa_msg = urlencode(!empty($company->whatsapp_message) ? $company->whatsapp_message : $default_msg);
                    ?>
                    <a href="https://wa.me/<?= $wa_num ?>?text=<?= $wa_msg ?>" class="wa-cta-outline" target="_blank" rel="noopener">
                        Chat Sekarang
                    </a>
                </div>

                <div class="contact-channel-card">
                    <div class="channel-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>
                    <p class="channel-label">Email</p>
                    <p class="channel-value"><?= htmlspecialchars($company->email ?? 'nuansarindu.id@gmail.com') ?></p>
                    <p class="channel-note">Respon dalam 24 jam kerja</p>
                </div>

                <?php if (!empty($company->instagram_url)):
                    $ig_handle = parse_url($company->instagram_url, PHP_URL_PATH);
                    $ig_handle = rtrim($ig_handle, '/');
                ?>
                    <div class="contact-channel-card">
                        <div class="channel-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <circle cx="12" cy="12" r="4" />
                                <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                            </svg>
                        </div>
                        <p class="channel-label">Instagram</p>
                        <p class="channel-value">@<?= htmlspecialchars(str_replace('/', '', $ig_handle)) ?></p>
                        <p class="channel-note">DM untuk pertanyaan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="contact-form-section">
            <div class="form-wrapper">
                <div class="text-center" style="margin-bottom: 48px;">
                    <h2 class="contact-form-title">Tinggalkan Pesan</h2>
                    <p class="contact-form-sub" style="margin-bottom: 0;">Isi formulir di bawah ini dan biarkan kami yang menyiapkan semuanya untuk Anda.</p>
                </div>

                <?php $selected_pkg = $this->input->get('package') ? htmlspecialchars($this->input->get('package')) : ''; ?>

                <form action="<?= base_url('contact/send') ?>" method="POST" id="consultForm">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="client_name">Nama Lengkap</label>
                            <input type="text" id="client_name" name="client_name" class="form-input" placeholder="Masukkan nama Anda" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="whatsapp_number">Nomor WhatsApp</label>
                            <input type="tel" id="whatsapp_number" name="whatsapp_number" class="form-input" placeholder="Contoh: 081234567890" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="package_interest">Perjalanan yang Diminati</label>
                        <select id="package_interest" name="package_interest" class="form-select">
                            <option value="">— Pilih Perjalanan —</option>
                            <?php if (!empty($packages)): ?>
                                <?php foreach ($packages as $pkg): ?>
                                    <option value="<?= htmlspecialchars($pkg->name) ?>" <?= ($selected_pkg === $pkg->name) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($pkg->name) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="Rindu Classic" <?= $selected_pkg === 'Rindu Classic' ? 'selected' : '' ?>>Rindu Classic — Umrah Regular</option>
                                <option value="Rindu Signature" <?= $selected_pkg === 'Rindu Signature' ? 'selected' : '' ?>>Rindu Signature — Umrah Premium</option>
                                <option value="Rindu Private" <?= $selected_pkg === 'Rindu Private' ? 'selected' : '' ?>>Rindu Private — Umrah Custom</option>
                                <option value="Sacred Journey" <?= $selected_pkg === 'Sacred Journey' ? 'selected' : '' ?>>Sacred Journey — Haji</option>
                                <option value="Belum Tahu">Belum Tahu, Perlu Konsultasi</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">Pesan (Opsional)</label>
                        <textarea id="message" name="message" class="form-textarea" placeholder="Ceritakan harapan Anda untuk perjalanan ini..."></textarea>
                    </div>

                    <div class="form-submit justify-center">
                        <button type="submit" class="submit-btn">Kirim Pesan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

<!-- [JAVASCRIPT FRONTEND] Skrip untuk memproses klik pada tombol Chip di atas -->
<script>
    function selectPackage(name) {
        var sel = document.getElementById('package_interest');
        if (sel) {
            // Melakukan loop pada opsi select dan menyesuaikan pilihan dengan tombol chip yang ditekan user
            for (var i = 0; i < sel.options.length; i++) {
                if (sel.options[i].value === name) {
                    sel.selectedIndex = i;
                    break;
                }
            }
        }

        // Memberikan style class 'selected' pada tombol chip yang sedang aktif
        document.querySelectorAll('.pkg-chip').forEach(function(c) {
            c.classList.toggle('selected', c.textContent.trim() === name);
        });

        // Auto-scroll ke atas layar menuju form setelah pengunjung memilih chip paket
        document.getElementById('consultForm').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
</script>