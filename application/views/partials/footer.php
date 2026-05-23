<footer class="site-footer">
    <div class="footer-cta-section">
        <span class="footer-star">✦</span>
        <h2 class="footer-cta-quote">
            Setiap langkah adalah rindu<br>yang menemukan jalan pulang.
        </h2>
        <a href="<?= base_url('contact') ?>" class="footer-btn">
            Mulai Perjalanan <span>→</span>
        </a>
    </div>

    <div class="footer-bottom">
        <a href="<?= base_url() ?>" class="footer-logo">
            <span class="footer-logo-star">✦</span> NUANSA RINDU
        </a>

        <ul class="footer-nav">
            <li><a href="<?= base_url('journey') ?>">Journey</a></li>
            <li><a href="<?= base_url('gallery') ?>">Film & Gallery</a></li>
            <li><a href="<?= base_url('fashion') ?>">Fashion</a></li>
            <li><a href="<?= base_url('about') ?>">About</a></li>
            <li><a href="<?= base_url('journal') ?>">Journal</a></li>
            <li><a href="<?= base_url('contact') ?>">Contact</a></li>
        </ul>

        <div class="footer-social">
            <a href="#" title="Instagram" aria-label="Instagram">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="20" height="20" rx="5"/>
                    <circle cx="12" cy="12" r="4"/>
                    <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor"/>
                </svg>
            </a>
            <a href="#" title="X" aria-label="X / Twitter">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="footer-copy">
        <p>&copy; <?= date('Y') ?> Nuansa Rindu. All rights reserved.</p>
    </div>
</footer>
