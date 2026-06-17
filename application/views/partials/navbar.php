<nav class="navbar" id="navbar">
    <a href="<?= base_url() ?>" class="nav-logo">
        <img src="<?= base_url('assets/images/Logo.png') ?>" alt="Nuansa Rindu" style="height: 32px; width: auto; display: block;">
        NUANSA RINDU
    </a>


    <ul class="nav-links">
        <li><a href="<?= base_url() ?>" class="<?= (isset($page) && $page === 'home') ? 'active' : '' ?>">Home</a></li>
        <?php if (isset($show_journey) && $show_journey): ?>
            <li><a href="<?= base_url('journey') ?>" class="<?= (isset($page) && $page === 'journey')  ? 'active' : '' ?>">Journey</a></li>
        <?php endif; ?>
        <li><a href="<?= base_url('gallery') ?>" class="<?= (isset($page) && $page === 'gallery')  ? 'active' : '' ?>">Experience</a></li>
        <?php if (isset($show_fashion) && $show_fashion): ?>
            <li><a href="<?= base_url('fashion') ?>" class="<?= (isset($page) && $page === 'fashion')  ? 'active' : '' ?>">Fashion</a></li>
        <?php endif; ?>
        <li><a href="<?= base_url('about') ?>" class="<?= (isset($page) && $page === 'about')    ? 'active' : '' ?>">About</a></li>
        <li><a href="<?= base_url('journal') ?>" class="<?= (isset($page) && $page === 'journal')  ? 'active' : '' ?>">Journal</a></li>
        <li><a href="<?= base_url('contact') ?>" class="<?= (isset($page) && $page === 'contact')  ? 'active' : '' ?>">Contact</a></li>
    </ul>

    <a href="<?= base_url('contact') ?>" class="nav-cta">Begin The Journey</a>

    <button class="nav-hamburger" id="navToggle" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>