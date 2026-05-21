<footer>
    <a href="<?= base_url(); ?>" class="footer-logo">
        <span style="color:rgba(196,163,90,0.6); margin-right:8px;">✦</span>
        NUANSA RINDU
    </a>
    <ul class="footer-links">
        <li><a href="<?= base_url('#journey'); ?>">Journey</a></li>
        <li><a href="<?= base_url('#experience'); ?>">Experience</a></li>
        <li><a href="<?= base_url('#about'); ?>">About</a></li>
        <li><a href="<?= base_url('journal'); ?>">Journal</a></li>
        <li><a href="<?= base_url('#footer-cta'); ?>">Contact</a></li>
    </ul>
    <div class="footer-social">
        <a href="#" title="Instagram">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                <circle cx="12" cy="12" r="4"/>
                <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor"/>
            </svg>
        </a>
        <a href="#" title="X / Twitter">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
        </a>
    </div>
</footer>

<script>
    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
            }
        });
    }, { threshold: 0.12 });
    reveals.forEach(el => observer.observe(el));

    // Hero dots cycling
    const dots = document.querySelectorAll('.hero-dots span');
    let current = 0;
    if (dots.length > 0) {
        setInterval(() => {
            dots[current].classList.remove('active');
            current = (current + 1) % dots.length;
            dots[current].classList.add('active');
        }, 3200);
    }
</script>

</body>
</html>