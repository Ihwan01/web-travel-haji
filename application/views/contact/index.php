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

        <!-- LEFT: Form -->
        <div class="contact-form-side">
            <h2 class="contact-form-title">Mulai percakapan.</h2>
            <p class="contact-form-sub">Isi formulir di bawah ini dan tim kami akan menghubungi Anda dalam waktu 24 jam untuk memulai perjalanan Anda.</p>

            <?php
            // [LOGIKA PHP] Menangkap data parameter URL (contoh: ?package=Rindu Classic). 
            // Berguna jika pengunjung datang dari halaman detail paket dan langsung menekan tombol "Konsultasi".
            $selected_pkg = $this->input->get('package') ? htmlspecialchars($this->input->get('package')) : '';
            ?>

            <!-- [FORM KONSULTASI] Akan mengirim POST request ke Controller Contact fungsi 'send' -->
            <form action="<?= base_url('contact/send') ?>" method="POST" id="consultForm">

                <!-- [SECURITY] Token CSRF CodeIgniter untuk mencegah serangan form palsu (Cross-Site Request Forgery) -->
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                <div class="form-group">
                    <label class="form-label" for="client_name">Nama Lengkap</label>
                    <input type="text" id="client_name" name="client_name" class="form-input"
                        placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="whatsapp_number">Nomor WhatsApp</label>
                    <input type="tel" id="whatsapp_number" name="whatsapp_number" class="form-input"
                        placeholder="Contoh: 081234567890" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="package_interest">Perjalanan yang Diminati</label>
                    <select id="package_interest" name="package_interest" class="form-select">
                        <option value="">— Pilih Perjalanan —</option>

                        <?php
                        // [LOGIKA PHP] Mengecek apakah ada data paket dari database.
                        if (!empty($packages)):
                        ?>
                            <?php foreach ($packages as $pkg): ?>
                                <!-- Mencetak daftar paket secara dinamis. Jika nama paket sama dengan URL parameter, otomatis 'selected' (terpilih) -->
                                <option value="<?= htmlspecialchars($pkg->name) ?>" <?= ($selected_pkg === $pkg->name) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($pkg->name) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- [FALLBACK] Jika tabel paket di database masih kosong, tampilkan opsi manual default ini -->
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
                    <textarea id="message" name="message" class="form-textarea"
                        placeholder="Ceritakan harapan Anda untuk perjalanan ini..."></textarea>
                </div>

                <div class="form-submit">
                    <button type="submit" class="submit-btn">Kirim Pesan</button>
                    <p class="submit-note">Atau hubungi kami langsung via WhatsApp untuk respons lebih cepat.</p>
                </div>
            </form>
        </div>

        <!-- RIGHT: Info -->
        <div class="contact-info-side reveal">
            <div class="contact-info-top">
                <blockquote class="contact-info-quote">
                    "Setiap perjalanan dimulai dari sebuah percakapan yang tulus."
                </blockquote>

                <div class="contact-channels">
                    <!-- WhatsApp -->
                    <div class="contact-channel">
                        <div class="channel-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="channel-label">WhatsApp</p>
                            <!-- [INTEGRASI CMS] Menarik data $company->whatsapp. Menggunakan Null Coalescing (??) agar ada nomor default jika CMS kosong -->
                            <p class="channel-value"><?= htmlspecialchars($company->whatsapp ?? '+62 811-8888-9326') ?></p>
                            <p class="channel-note">Senin – Sabtu, 08.00 – 20.00 WIB</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-channel">
                        <div class="channel-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </div>
                        <div>
                            <p class="channel-label">Email</p>
                            <!-- [INTEGRASI CMS] Menarik data email dari tabel company_profile -->
                            <p class="channel-value"><?= htmlspecialchars($company->email ?? 'nuansarindu.id@gmail.com') ?></p>
                            <p class="channel-note">Respon dalam 24 jam kerja</p>
                        </div>
                    </div>

                    <!-- Instagram -->
                    <?php
                    // [LOGIKA PHP] Hanya render (tampilkan) bagian IG jika Super Admin mengisi link Instagram di CMS
                    if (!empty($company->instagram_url)):

                        // Membersihkan URL IG menjadi sekadar @username untuk visualisasi cantik di Front-End
                        $ig_handle = parse_url($company->instagram_url, PHP_URL_PATH);
                        $ig_handle = rtrim($ig_handle, '/');
                    ?>
                        <div class="contact-channel">
                            <div class="channel-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                    <circle cx="12" cy="12" r="4" />
                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                                </svg>
                            </div>
                            <div>
                                <p class="channel-label">Instagram</p>
                                <p class="channel-value">@<?= htmlspecialchars(str_replace('/', '', $ig_handle)) ?></p>
                                <p class="channel-note">DM untuk pertanyaan cepat</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- WhatsApp CTA DINAMIS -->
            <?php
            // [LOGIKA INTEGRASI WHATSAPP] 
            // 1. Membersihkan input nomor dari CMS. Jika admin mengetik +62 812-345, diubah menjadi 62812345 (format standar API WA)
            $wa_num = !empty($company->whatsapp) ? preg_replace('/[^0-9]/', '', $company->whatsapp) : '6281188889326';

            // 2. Menyiapkan kalimat default jaga-jaga jika admin belum mengetik 'Pesan Awalan' di CMS
            $default_msg = "Assalamu'alaikum Nuansa Rindu, saya ingin berkonsultasi mengenai perjalanan umrah.";

            // 3. Mengubah text menjadi format URL (spasi menjadi %20, dst) agar bisa dibaca oleh aplikasi WA
            $wa_msg = urlencode(!empty($company->whatsapp_message) ? $company->whatsapp_message : $default_msg);
            ?>
            <div>
                <!-- Mengarahkan klik langsung ke aplikasi WA dengan membawa $wa_num dan $wa_msg -->
                <a href="https://wa.me/<?= $wa_num ?>?text=<?= $wa_msg ?>" class="wa-cta" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- ── PACKAGE CHIPS ───────────────────────────────── -->
    <section class="contact-packages reveal">
        <h3>Atau pilih langsung perjalanan yang Anda minati:</h3>

        <!-- [UI INTERAKTIF] Membuat tombol-tombol mini (chips) sebagai jalan pintas untuk memilih opsi form select di atas -->
        <div class="pkg-chips">
            <?php
            // Memetakan ulang objek paket menjadi array berisi nama paket, jika DB kosong gunakan fallback list
            $chip_list = !empty($packages)
                ? array_map(fn($p) => $p->name, $packages)
                : ['Rindu Classic', 'Rindu Signature', 'Rindu Private', 'Sacred Journey', 'Belum Tahu'];

            foreach ($chip_list as $chip): ?>
                <button class="pkg-chip" onclick="selectPackage('<?= htmlspecialchars($chip) ?>')"><?= htmlspecialchars($chip) ?></button>
            <?php endforeach; ?>
        </div>
    </section>

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