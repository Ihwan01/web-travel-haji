<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengaturan Halaman Depan (Homepage)</h1>
</div>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="<?= base_url('homepage_settings/update') ?>" method="POST" enctype="multipart/form-data">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <ul class="nav nav-tabs card-header-tabs" id="homeTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active font-weight-bold" data-bs-toggle="tab" data-bs-target="#tab-general" type="button">General (Fitur Publik)</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link font-weight-bold" data-bs-toggle="tab" data-bs-target="#tab-hero" type="button">Hero Section</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link font-weight-bold" data-bs-toggle="tab" data-bs-target="#tab-about" type="button">Tentang Kami (About)</button>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">

                <div class="tab-pane fade show active" id="tab-general">
                    <div class="alert alert-info">
                        Matikan sakelar (toggle) di bawah ini untuk menyembunyikan modul sepenuhnya dari halaman pengunjung. Admin tetap bisa mengisi data lewat CMS.
                    </div>
                    <div class="mb-4 form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="show_journey" name="show_journey" value="1" <?= ($settings->show_journey == 1) ? 'checked' : '' ?> style="width: 3em; height: 1.5em;">
                        <label class="form-check-label ml-3 mt-1 font-weight-bold" for="show_journey">Tampilkan Paket Perjalanan (Signature Journey)</label>
                    </div>
                    <div class="mb-4 form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="show_fashion" name="show_fashion" value="1" <?= ($settings->show_fashion == 1) ? 'checked' : '' ?> style="width: 3em; height: 1.5em;">
                        <label class="form-check-label ml-3 mt-1 font-weight-bold" for="show_fashion">Tampilkan Modul Perlengkapan (Fashion Identity)</label>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-hero">
                    <div class="row">
                        <div class="col-md-6 mb-4 border-right">
                            <h6 class="font-weight-bold text-primary mb-3">Tipe Tampilan & Media Hero</h6>
                            <div class="mb-3">
                                <label class="form-label">Tipe Hero Background</label>
                                <select class="form-select form-control" name="hero_type">
                                    <option value="Single" <?= ($settings->hero_type == 'Single') ? 'selected' : '' ?>>Gambar/Video Statis (Tanpa Titik Navigasi)</option>
                                    <option value="Slideshow" <?= ($settings->hero_type == 'Slideshow') ? 'selected' : '' ?>>Slideshow (Menampilkan Titik Navigasi)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Media Latar Belakang</label>
                                <select class="form-select form-control" name="hero_media_type" id="hero_media_type" onchange="toggleHeroMedia()">
                                    <option value="Video" <?= ($settings->hero_media_type == 'Video') ? 'selected' : '' ?>>Tautan Video (Autoplay)</option>
                                    <option value="Photo" <?= ($settings->hero_media_type == 'Photo') ? 'selected' : '' ?>>Unggah Foto Statis</option>
                                </select>
                            </div>

                            <div class="mb-3" id="box_hero_video">
                                <label class="form-label">Tautan Video (.mp4 / URL Publik)</label>
                                <input type="text" class="form-control" name="hero_video_link" value="<?= ($settings->hero_media_type == 'Video') ? $settings->hero_media : '' ?>" placeholder="Contoh: https://.../video.mp4">
                                <small class="text-muted">Video akan terputar otomatis di halaman depan tanpa suara.</small>
                            </div>

                            <div class="mb-3" id="box_hero_photo" style="display: none;">
                                <label class="form-label">Unggah File Foto (Maks 2MB)</label>
                                <input type="file" class="form-control" name="hero_photo" accept="image/*">
                                <?php if ($settings->hero_media_type == 'Photo' && $settings->hero_media): ?>
                                    <small class="d-block mt-2 text-success">Media tersimpan: <a href="<?= base_url($settings->hero_media) ?>" target="_blank">Lihat Gambar Aktif</a></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <h6 class="font-weight-bold text-primary mb-3">Teks & Tombol Aksi</h6>
                            <div class="mb-3">
                                <label class="form-label">Tagline Kecil (Di atas judul)</label>
                                <input type="text" class="form-control" name="hero_tagline" value="<?= htmlspecialchars($settings->hero_tagline) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Judul Utama (HTML diizinkan)</label>
                                <textarea class="form-control" name="hero_title" rows="3"><?= $settings->hero_title ?></textarea>
                                <small class="text-muted">Gunakan <code>&lt;br&gt;</code> untuk pindah baris, <code>&lt;em&gt;</code> untuk teks emas.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Lengkap</label>
                                <textarea class="form-control" name="hero_desc" rows="3"><?= $settings->hero_desc ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Teks Tombol Kiri</label>
                                    <input type="text" class="form-control" name="hero_btn1_text" value="<?= htmlspecialchars($settings->hero_btn1_text) ?>">
                                    <label class="form-label mt-2">Tautan Tombol Kiri</label>
                                    <input type="text" class="form-control" name="hero_btn1_url" value="<?= htmlspecialchars($settings->hero_btn1_url) ?>" placeholder="Contoh: journey">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Teks Tombol Kanan</label>
                                    <input type="text" class="form-control" name="hero_btn2_text" value="<?= htmlspecialchars($settings->hero_btn2_text) ?>">
                                    <label class="form-label mt-2">Tautan Tombol Kanan</label>
                                    <input type="text" class="form-control" name="hero_btn2_url" value="<?= htmlspecialchars($settings->hero_btn2_url) ?>" placeholder="Contoh: contact">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-about">
                    <div class="row">
                        <div class="col-md-7 mb-4 border-right">
                            <h6 class="font-weight-bold text-primary mb-3">Teks Tentang Kami</h6>
                            <div class="mb-3">
                                <label class="form-label">Judul Besar (HTML diizinkan)</label>
                                <textarea class="form-control" name="about_title" rows="4"><?= $settings->about_title ?></textarea>
                                <small class="text-muted">Gunakan <code>&lt;br&gt;</code> untuk baris baru, <code>&lt;em style="color:var(--gold);"&gt;</code> untuk warna emas.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Pembuka</label>
                                <textarea class="form-control" name="about_desc" rows="3"><?= $settings->about_desc ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-5 mb-4">
                            <h6 class="font-weight-bold text-primary mb-3">Media (Opsional)</h6>
                            <div class="mb-3">
                                <label class="form-label">Jenis Media Pendamping</label>
                                <select class="form-select form-control" name="about_media_type" id="about_media_type" onchange="toggleAboutMedia()">
                                    <option value="Photo" <?= ($settings->about_media_type == 'Photo') ? 'selected' : '' ?>>Unggah Foto</option>
                                    <option value="Video" <?= ($settings->about_media_type == 'Video') ? 'selected' : '' ?>>Tautan Video Player</option>
                                </select>
                            </div>

                            <div class="mb-3" id="box_about_photo" style="display: none;">
                                <label class="form-label">Unggah Foto (Maks 2MB)</label>
                                <input type="file" class="form-control" name="about_photo" accept="image/*">
                                <?php if ($settings->about_media_type == 'Photo' && $settings->about_media): ?>
                                    <small class="d-block mt-2 text-success"><a href="<?= base_url($settings->about_media) ?>" target="_blank">Lihat Gambar Aktif</a></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3" id="box_about_video" style="display: none;">
                                <label class="form-label">Tautan Video YouTube</label>
                                <input type="text" class="form-control" name="about_video_link" value="<?= ($settings->about_media_type == 'Video') ? $settings->about_media : '' ?>" placeholder="https://youtube.com/...">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save mr-2"></i> Simpan Semua Pengaturan</button>
        </div>
    </div>
</form>

<script>
    function toggleHeroMedia() {
        var type = document.getElementById('hero_media_type').value;
        if (type === 'Video') {
            document.getElementById('box_hero_video').style.display = 'block';
            document.getElementById('box_hero_photo').style.display = 'none';
        } else {
            document.getElementById('box_hero_video').style.display = 'none';
            document.getElementById('box_hero_photo').style.display = 'block';
        }
    }

    function toggleAboutMedia() {
        var type = document.getElementById('about_media_type').value;
        if (type === 'Video') {
            document.getElementById('box_about_video').style.display = 'block';
            document.getElementById('box_about_photo').style.display = 'none';
        } else {
            document.getElementById('box_about_video').style.display = 'none';
            document.getElementById('box_about_photo').style.display = 'block';
        }
    }

    // Jalankan saat halaman pertama kali dimuat
    document.addEventListener("DOMContentLoaded", function() {
        toggleHeroMedia();
        toggleAboutMedia();
    });
</script>