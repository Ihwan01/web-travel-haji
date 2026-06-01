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
                    <button class="nav-link active font-weight-bold" data-bs-toggle="tab" data-bs-target="#tab-general" type="button">General</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link font-weight-bold" data-bs-toggle="tab" data-bs-target="#tab-hero" type="button">Hero Section</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link font-weight-bold" data-bs-toggle="tab" data-bs-target="#tab-about" type="button">About Us</button>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">

                <div class="tab-pane fade show active" id="tab-general">
                    <div class="mb-4 form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="show_journey" name="show_journey" value="1" <?= ($settings->show_journey == 1) ? 'checked' : '' ?> style="width: 3em; height: 1.5em;">
                        <label class="form-check-label ml-3 mt-1 font-weight-bold" for="show_journey">Tampilkan Paket Perjalanan (Signature Journey)</label>
                    </div>
                    <div class="mb-4 form-check form-switch border-bottom pb-4">
                        <input class="form-check-input" type="checkbox" role="switch" id="show_fashion" name="show_fashion" value="1" <?= ($settings->show_fashion == 1) ? 'checked' : '' ?> style="width: 3em; height: 1.5em;">
                        <label class="form-check-label ml-3 mt-1 font-weight-bold" for="show_fashion">Tampilkan Modul Perlengkapan (Fashion Identity)</label>
                    </div>

                    <h6 class="font-weight-bold text-primary mt-4 mb-3">Mode Hero Section</h6>
                    <div class="mb-4 form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_slideshow" name="is_slideshow" value="1" <?= ($settings->is_slideshow == 1) ? 'checked' : '' ?> onchange="toggleMode()" style="width: 3em; height: 1.5em;">
                        <label class="form-check-label ml-3 mt-1 font-weight-bold text-dark" for="is_slideshow">Aktifkan Mode Slideshow / Carousel</label>
                        <small class="d-block text-muted ml-5 mt-1">Jika dimatikan, Hero akan berupa Banner Statis tunggal (Slider HTML/JS akan dihilangkan dari halaman depan).</small>
                    </div>

                    <div class="mb-4 form-check form-switch" id="wrap_autoplay">
                        <input class="form-check-input" type="checkbox" role="switch" id="slideshow_autoplay" name="slideshow_autoplay" value="1" <?= ($settings->slideshow_autoplay == 1) ? 'checked' : '' ?> style="width: 3em; height: 1.5em;">
                        <label class="form-check-label ml-3 mt-1 font-weight-bold" for="slideshow_autoplay">Putar Otomatis (Auto-play Slideshow)</label>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-hero">
                    <div id="slides_container">
                        <?php foreach ($slides as $index => $slide): ?>
                            <div class="slide-item card bg-light mb-4 border" id="slide_<?= $index ?>">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <strong class="text-primary slide-title-head">Slide Item</strong>
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-slide" onclick="removeSlide(this)" style="display: <?= ($settings->is_slideshow == 1 && $index > 0) ? 'block' : 'none' ?>;"><i class="fas fa-trash"></i> Hapus</button>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-5 border-right">
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Tipe Media</label>
                                            <select class="form-select form-control media-type-select" name="slide_media_type[]" onchange="toggleSlideMedia(this)">
                                                <option value="Video" <?= ($slide->media_type == 'Video') ? 'selected' : '' ?>>Tautan Video (Autoplay)</option>
                                                <option value="Photo" <?= ($slide->media_type == 'Photo') ? 'selected' : '' ?>>Unggah Foto Statis</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 box-video" style="display: <?= ($slide->media_type == 'Video') ? 'block' : 'none' ?>;">
                                            <label class="form-label font-weight-bold">Tautan Video Publik</label>
                                            <input type="text" class="form-control mb-2" name="slide_video_link[]" value="<?= ($slide->media_type == 'Video') ? htmlspecialchars($slide->media_url) : '' ?>" placeholder="https://...">

                                            <label class="form-label font-weight-bold text-info mt-2">Sampul (Thumbnail) Video</label>
                                            <input type="file" class="form-control" name="slide_video_thumbnail[]" accept="image/*">
                                            <input type="hidden" name="old_slide_video_thumbnail[]" value="<?= isset($slide->video_thumbnail) ? $slide->video_thumbnail : '' ?>">
                                            <small class="text-muted d-block mt-1">Opsional: Gambar preview sebelum video dimainkan.</small>
                                        </div>
                                        <div class="mb-3 box-photo" style="display: <?= ($slide->media_type == 'Photo') ? 'block' : 'none' ?>;">
                                            <label class="form-label font-weight-bold">File Foto (Maks 2MB)</label>
                                            <input type="file" class="form-control" name="slide_photo[]" accept="image/*">
                                            <input type="hidden" name="old_slide_photo[]" value="<?= ($slide->media_type == 'Photo') ? $slide->media_url : '' ?>">
                                            <?php if ($slide->media_type == 'Photo' && $slide->media_url): ?>
                                                <small class="d-block mt-2 text-success"><a href="<?= base_url($slide->media_url) ?>" target="_blank">Lihat Gambar Aktif</a></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-label font-weight-bold">Tagline (Sub-judul)</label>
                                                <input type="text" class="form-control" name="slide_tagline[]" value="<?= htmlspecialchars($slide->tagline ?? '') ?>">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label font-weight-bold">Judul Utama (HTML diizinkan)</label>
                                                <textarea class="form-control" name="slide_title[]" rows="2"><?= $slide->title ?? '' ?></textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label font-weight-bold">Deskripsi</label>
                                                <textarea class="form-control" name="slide_desc[]" rows="2"><?= $slide->desc_text ?? '' ?></textarea>
                                            </div>
                                            <!-- [UPDATE] Tombol Single -->
                                            <div class="col-6 mb-3">
                                                <label class="form-label font-weight-bold">Teks Tombol Aksi</label>
                                                <input type="text" class="form-control" name="slide_btn_text[]" value="<?= htmlspecialchars($slide->btn_text ?? '') ?>" placeholder="Misal: Lihat Paket">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label font-weight-bold">URL Tautan</label>
                                                <input type="text" class="form-control" name="slide_btn_url[]" value="<?= htmlspecialchars($slide->btn_url ?? '') ?>" placeholder="Misal: /journeys">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="btn btn-outline-primary" id="btnAddSlide" onclick="addSlide()" style="display: <?= ($settings->is_slideshow == 1) ? 'inline-block' : 'none' ?>;">
                        <i class="fas fa-plus mr-2"></i> Tambah Slide Baru
                    </button>
                </div>

                <div class="tab-pane fade" id="tab-about">
                    <div class="row">
                        <div class="col-md-7 border-right">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Judul Besar (HTML diizinkan)</label>
                                <textarea class="form-control" name="about_title" rows="4"><?= $settings->about_title ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Deskripsi Pembuka</label>
                                <textarea class="form-control" name="about_desc" rows="3"><?= $settings->about_desc ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Jenis Media</label>
                                <select class="form-select form-control" name="about_media_type" id="about_media_type" onchange="toggleAboutMedia()">
                                    <option value="Photo" <?= ($settings->about_media_type == 'Photo') ? 'selected' : '' ?>>Unggah Foto Statis</option>
                                    <option value="Video" <?= ($settings->about_media_type == 'Video') ? 'selected' : '' ?>>Tautan Video (YouTube)</option>
                                </select>
                            </div>

                            <div class="mb-3" id="box_about_photo" style="display: none;">
                                <label class="form-label font-weight-bold">Unggah Foto Utama (Maks 2MB)</label>
                                <input type="file" class="form-control" name="about_photo" accept="image/*">
                                <?php if ($settings->about_media_type == 'Photo' && $settings->about_media): ?>
                                    <small class="d-block mt-2 text-success"><a href="<?= base_url($settings->about_media) ?>" target="_blank">Lihat Gambar Aktif</a></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3" id="box_about_video" style="display: none;">
                                <label class="form-label font-weight-bold">Tautan Video</label>
                                <input type="text" class="form-control mb-3" name="about_video_link" value="<?= ($settings->about_media_type == 'Video') ? $settings->about_media : '' ?>" placeholder="https://youtube.com/...">

                                <label class="form-label font-weight-bold text-info">Unggah Sampul (Thumbnail) Video</label>
                                <input type="file" class="form-control" name="about_video_thumbnail" accept="image/*">
                                <small class="text-muted d-block mt-1">Gambar ini akan tampil dengan ikon PLAY. Maks 2MB.</small>
                                <?php if ($settings->about_media_type == 'Video' && $settings->about_video_thumbnail): ?>
                                    <small class="d-block mt-2 text-success"><a href="<?= base_url($settings->about_video_thumbnail) ?>" target="_blank">Lihat Sampul Aktif</a></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save mr-2"></i> Simpan Pengaturan</button>
        </div>
    </div>
</form>

<script>
    function toggleMode() {
        var isSlide = document.getElementById('is_slideshow').checked;
        var btnAdd = document.getElementById('btnAddSlide');
        var autoWrap = document.getElementById('wrap_autoplay');
        var delBtns = document.querySelectorAll('.btn-remove-slide');
        var slides = document.querySelectorAll('.slide-item');

        if (isSlide) {
            btnAdd.style.display = 'inline-block';
            autoWrap.style.display = 'block';
            delBtns.forEach(btn => btn.style.display = 'block');

            if (delBtns.length > 0) delBtns[0].style.display = 'none'; // Sembunyikan delete untuk index 0

            document.querySelectorAll('.slide-title-head').forEach((el, idx) => el.innerText = 'Slide ' + (idx + 1));
        } else {
            btnAdd.style.display = 'none';
            autoWrap.style.display = 'none';

            // [PENTING] DOM Remove semua form slide KECUALI yang pertama (indeks 0)
            for (let i = slides.length - 1; i > 0; i--) {
                slides[i].remove();
            }

            if (delBtns.length > 0) delBtns[0].style.display = 'none';
            if (document.querySelector('.slide-title-head')) {
                document.querySelector('.slide-title-head').innerText = 'Data Banner Statis';
            }
        }
    }

    function toggleSlideMedia(selectElem) {
        var cardBody = selectElem.closest('.card-body');
        var val = selectElem.value;
        if (val === 'Video') {
            cardBody.querySelector('.box-video').style.display = 'block';
            cardBody.querySelector('.box-photo').style.display = 'none';
        } else {
            cardBody.querySelector('.box-video').style.display = 'none';
            cardBody.querySelector('.box-photo').style.display = 'block';
        }
    }

    function toggleAboutMedia() {
        var val = document.getElementById('about_media_type').value;
        if (val === 'Video') {
            document.getElementById('box_about_video').style.display = 'block';
            document.getElementById('box_about_photo').style.display = 'none';
        } else {
            document.getElementById('box_about_video').style.display = 'none';
            document.getElementById('box_about_photo').style.display = 'block';
        }
    }

    function addSlide() {
        var container = document.getElementById('slides_container');
        var firstSlide = container.querySelector('.slide-item');
        var newSlide = firstSlide.cloneNode(true);

        // Bersihkan form
        newSlide.querySelectorAll('input[type="text"], textarea, input[type="hidden"]').forEach(input => input.value = '');
        let smallPhoto = newSlide.querySelector('.box-photo small');
        if (smallPhoto) smallPhoto.remove();

        newSlide.querySelector('.btn-remove-slide').style.display = 'block';

        container.appendChild(newSlide);
        toggleMode();
    }

    function removeSlide(btn) {
        btn.closest('.slide-item').remove();
        toggleMode();
    }

    document.addEventListener("DOMContentLoaded", function() {
        toggleAboutMedia();
        toggleMode(); // Pastikan script tereksekusi rapi saat pertama muat
    });
</script>