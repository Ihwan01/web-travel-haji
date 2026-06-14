<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?= base_url() ?></loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url('journey') ?></loc>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?= base_url('fashion') ?></loc>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?= base_url('gallery') ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= base_url('about') ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= base_url('journal') ?></loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= base_url('contact') ?></loc>
        <priority>0.7</priority>
    </url>

    <?php if (!empty($journeys)): ?>
        <?php foreach ($journeys as $journey): ?>
            <url>
                <loc><?= base_url('journey/' . $journey->slug) ?></loc>
                <priority>0.9</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($fashions)): ?>
        <?php foreach ($fashions as $fashion): ?>
            <url>
                <loc><?= base_url('fashion/' . $fashion->slug) ?></loc>
                <priority>0.8</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($journals)): ?>
        <?php foreach ($journals as $journal): ?>
            <url>
                <loc><?= base_url('journal/' . $journal->slug) ?></loc>
                <priority>0.7</priority>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>

</urlset>