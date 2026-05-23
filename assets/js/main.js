/* ═══════════════════════════════════════════════════════
   NUANSA RINDU — main.js
   ═══════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', function () {

    // ── Navbar scroll effect ─────────────────────────────
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', function () {
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // ── Mobile hamburger ─────────────────────────────────
    const toggle  = document.getElementById('navToggle');
    const navList = document.querySelector('.nav-links');
    if (toggle && navList) {
        toggle.addEventListener('click', function () {
            navList.classList.toggle('open');
        });
    }

    // ── Scroll reveal ─────────────────────────────────────
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        reveals.forEach(function (el) { observer.observe(el); });
    }

    // ── Hero video autoplay fallback ──────────────────────
    const heroVideo = document.getElementById('heroVideo');
    if (heroVideo) {
        heroVideo.play().catch(function () {
            // autoplay blocked, show poster instead
            heroVideo.style.display = 'none';
        });
    }

    // ── Hero dots cycling ─────────────────────────────────
    const dots = document.querySelectorAll('.hero-dot');
    if (dots.length) {
        let current = 0;
        setInterval(function () {
            dots[current].classList.remove('active');
            current = (current + 1) % dots.length;
            dots[current].classList.add('active');
        }, 3200);
    }

    // ── Lightbox for gallery ──────────────────────────────
    const galleryItems = document.querySelectorAll('[data-lightbox]');
    if (galleryItems.length) {
        // Create overlay
        const overlay = document.createElement('div');
        overlay.id = 'lightbox-overlay';
        overlay.innerHTML = '<div class="lb-inner"><button class="lb-close">&times;</button><div class="lb-content"></div></div>';
        document.body.appendChild(overlay);

        const lbContent = overlay.querySelector('.lb-content');
        const lbClose   = overlay.querySelector('.lb-close');

        galleryItems.forEach(function (item) {
            item.addEventListener('click', function () {
                const type = item.getAttribute('data-type');
                const src  = item.getAttribute('data-src');
                lbContent.innerHTML = '';
                if (type === 'Video') {
                    lbContent.innerHTML = '<video src="' + src + '" controls autoplay style="max-width:100%;max-height:80vh;"></video>';
                } else {
                    lbContent.innerHTML = '<img src="' + src + '" alt="" style="max-width:100%;max-height:85vh;object-fit:contain;">';
                }
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        lbClose.addEventListener('click', closeLightbox);
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeLightbox();
        });

        function closeLightbox() {
            overlay.classList.remove('active');
            lbContent.innerHTML = '';
            document.body.style.overflow = '';
        }
    }
});
