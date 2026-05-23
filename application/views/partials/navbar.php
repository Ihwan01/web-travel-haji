<nav class="navbar" id="navbar">
    <a href="<?= base_url() ?>" class="nav-logo">
        <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
            <path d="M16 4C16 4 8 10 8 20C8 24.4 11.6 28 16 28C20.4 28 24 24.4 24 20C24 10 16 4 16 4Z"
                  stroke="#C4A35A" stroke-width="1.2" fill="none"/>
            <path d="M12 16C14 12 18 10 22 12" stroke="#C4A35A" stroke-width="0.8" fill="none" opacity="0.5"/>
            <circle cx="16" cy="6" r="1.5" fill="#C4A35A" opacity="0.6"/>
        </svg>
        NUANSA RINDU
    </a>

    <ul class="nav-links">
        <li><a href="<?= base_url('journey') ?>"  class="<?= (isset($page) && $page==='journey')  ? 'active':'' ?>">Journey</a></li>
        <li><a href="<?= base_url('gallery') ?>"  class="<?= (isset($page) && $page==='gallery')  ? 'active':'' ?>">Film & Gallery</a></li>
        <li><a href="<?= base_url('fashion') ?>"  class="<?= (isset($page) && $page==='fashion')  ? 'active':'' ?>">Fashion</a></li>
        <li><a href="<?= base_url('about') ?>"    class="<?= (isset($page) && $page==='about')    ? 'active':'' ?>">About</a></li>
        <li><a href="<?= base_url('journal') ?>"  class="<?= (isset($page) && $page==='journal')  ? 'active':'' ?>">Journal</a></li>
        <li><a href="<?= base_url('contact') ?>"  class="<?= (isset($page) && $page==='contact')  ? 'active':'' ?>">Contact</a></li>
    </ul>

    <a href="<?= base_url('contact') ?>" class="nav-cta">Begin The Journey</a>

    <!-- Mobile hamburger -->
    <button class="nav-hamburger" id="navToggle" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>
