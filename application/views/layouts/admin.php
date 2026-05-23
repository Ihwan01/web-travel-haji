<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) . ' — Admin Nuansa Rindu' : 'Admin Nuansa Rindu' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --cream:#F5F0E8; --warm:#EDE3D0; --brown:#3B2A1A;
            --gold:#C4A35A; --dark:#1A1008; --muted:#7A6A56;
            --sidebar-w: 240px;
            --font-display:'Cormorant Garamond',serif;
            --font-body:'Jost',sans-serif;
        }
        body { font-family:var(--font-body); background:#F0EBE2; color:var(--brown); display:flex; min-height:100vh; font-weight:300; }
        a { text-decoration:none; color:inherit; }

        /* SIDEBAR */
        .adm-sidebar {
            width:var(--sidebar-w); flex-shrink:0;
            background:var(--dark);
            display:flex; flex-direction:column;
            position:fixed; top:0; left:0; bottom:0;
            z-index:100;
            overflow-y:auto;
        }
        .adm-logo {
            padding:28px 24px 20px;
            font-family:var(--font-display);
            font-size:0.9rem; letter-spacing:0.12em;
            color:rgba(245,240,232,0.7);
            border-bottom:1px solid rgba(196,163,90,0.12);
            display:flex; align-items:center; gap:8px;
        }
        .adm-logo span { color:var(--gold); font-size:1rem; }
        .adm-nav { padding:20px 0; flex:1; }
        .adm-nav-label {
            font-size:0.56rem; letter-spacing:0.22em;
            text-transform:uppercase; color:rgba(245,240,232,0.25);
            padding:12px 24px 6px;
        }
        .adm-nav a {
            display:flex; align-items:center; gap:10px;
            padding:10px 24px;
            font-size:0.75rem; letter-spacing:0.08em;
            color:rgba(245,240,232,0.45);
            transition:all .2s;
        }
        .adm-nav a:hover, .adm-nav a.active {
            color:rgba(245,240,232,0.9);
            background:rgba(196,163,90,0.08);
            border-left:2px solid var(--gold);
            padding-left:22px;
        }
        .adm-nav a svg { width:15px; height:15px; stroke:currentColor; fill:none; stroke-width:1.4; flex-shrink:0; }
        .adm-user {
            padding:16px 24px;
            border-top:1px solid rgba(196,163,90,0.1);
            font-size:0.7rem;
            color:rgba(245,240,232,0.3);
            display:flex; align-items:center; justify-content:space-between;
        }
        .adm-user a { color:var(--gold); font-size:0.65rem; letter-spacing:0.1em; }

        /* MAIN */
        .adm-main {
            margin-left:var(--sidebar-w);
            flex:1; display:flex; flex-direction:column;
            min-height:100vh;
        }
        .adm-topbar {
            background:#fff;
            padding:0 36px;
            height:60px;
            display:flex; align-items:center; justify-content:space-between;
            border-bottom:1px solid rgba(59,42,26,0.08);
            position:sticky; top:0; z-index:50;
        }
        .adm-page-title {
            font-family:var(--font-display);
            font-size:1.3rem; font-weight:400; color:var(--brown);
        }
        .adm-content { padding:36px; flex:1; }

        /* CARDS */
        .adm-stats {
            display:grid; grid-template-columns:repeat(5,1fr); gap:16px;
            margin-bottom:32px;
        }
        .stat-card {
            background:#fff; padding:24px 20px;
            border-bottom:2px solid transparent;
            transition:border-color .2s;
        }
        .stat-card:hover { border-bottom-color:var(--gold); }
        .stat-num {
            font-family:var(--font-display);
            font-size:2.2rem; font-weight:300; color:var(--brown);
            line-height:1; margin-bottom:8px;
        }
        .stat-label { font-size:0.68rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); }

        /* TABLE */
        .adm-card { background:#fff; padding:28px; margin-bottom:24px; }
        .adm-card-title {
            font-family:var(--font-display);
            font-size:1.1rem; font-weight:400; color:var(--brown);
            margin-bottom:20px; padding-bottom:14px;
            border-bottom:1px solid rgba(59,42,26,0.08);
            display:flex; align-items:center; justify-content:space-between;
        }
        .adm-table { width:100%; border-collapse:collapse; }
        .adm-table th {
            font-size:0.6rem; letter-spacing:0.16em; text-transform:uppercase;
            color:var(--muted); padding:10px 14px; text-align:left;
            border-bottom:1px solid rgba(59,42,26,0.08);
        }
        .adm-table td { padding:12px 14px; font-size:0.82rem; color:var(--brown); border-bottom:1px solid rgba(59,42,26,0.05); vertical-align:middle; }
        .adm-table tr:last-child td { border-bottom:none; }
        .adm-table tr:hover td { background:rgba(196,163,90,0.04); }

        /* BADGES */
        .badge {
            display:inline-block; padding:3px 10px;
            font-size:0.6rem; letter-spacing:0.1em; text-transform:uppercase;
            border-radius:2px;
        }
        .badge-published { background:rgba(80,160,100,0.12); color:#407050; }
        .badge-draft     { background:rgba(196,163,90,0.15); color:#806040; }

        /* BUTTONS */
        .btn-sm {
            padding:6px 14px; font-size:0.62rem; letter-spacing:0.1em;
            text-transform:uppercase; border:none; cursor:pointer;
            transition:all .2s; font-family:var(--font-body); font-weight:400;
        }
        .btn-primary { background:var(--brown); color:var(--cream); }
        .btn-primary:hover { background:var(--gold); }
        .btn-edit { background:rgba(196,163,90,0.15); color:var(--brown); }
        .btn-edit:hover { background:var(--gold); color:var(--dark); }
        .btn-delete { background:rgba(180,60,40,0.1); color:#a03020; }
        .btn-delete:hover { background:#a03020; color:#fff; }
        .btn-add {
            display:inline-flex; align-items:center; gap:8px;
            padding:9px 20px; background:var(--brown); color:var(--cream);
            font-size:0.65rem; letter-spacing:0.14em; text-transform:uppercase;
            cursor:pointer; font-family:var(--font-body); border:none; transition:background .2s;
        }
        .btn-add:hover { background:var(--gold); }

        /* FORMS */
        .adm-form-grid { display:grid; grid-template-columns:1fr 1fr; gap:24px; }
        .adm-form-full { grid-column:span 2; }
        .form-group { margin-bottom:20px; }
        .form-label { display:block; font-size:0.62rem; letter-spacing:0.16em; text-transform:uppercase; color:var(--muted); margin-bottom:8px; }
        .form-control {
            width:100%; padding:10px 14px;
            border:1px solid rgba(59,42,26,0.18);
            background:var(--cream); color:var(--brown);
            font-family:var(--font-body); font-size:0.85rem; font-weight:300;
            outline:none; border-radius:0;
            transition:border-color .2s;
        }
        .form-control:focus { border-color:var(--gold); }
        select.form-control { cursor:pointer; }
        textarea.form-control { resize:vertical; min-height:120px; line-height:1.7; }
        .form-img-preview { max-width:200px; margin-top:10px; display:block; }

        /* THUMBNAIL in table */
        .tbl-thumb { width:52px; height:40px; object-fit:cover; display:block; }
        .tbl-thumb-placeholder { width:52px; height:40px; background:var(--warm); display:block; }

        @media(max-width:1024px) {
            .adm-stats { grid-template-columns:repeat(3,1fr); }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="adm-sidebar">
    <div class="adm-logo"><span>✦</span> NUANSA RINDU</div>
    <nav class="adm-nav">
        <div class="adm-nav-label">Utama</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="<?= (isset($title) && $title==='Dashboard')?'active':'' ?>">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>

        <div class="adm-nav-label">Konten</div>
        <a href="<?= base_url('admin/journey') ?>" class="<?= (isset($title) && strpos($title,'Journey')!==false)?'active':'' ?>">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Journey
        </a>
        <a href="<?= base_url('admin/journal') ?>" class="<?= (isset($title) && strpos($title,'Journal')!==false)?'active':'' ?>">
            <svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
            Journal
        </a>
        <a href="<?= base_url('admin/fashion') ?>" class="<?= (isset($title) && strpos($title,'Fashion')!==false)?'active':'' ?>">
            <svg viewBox="0 0 24 24"><path d="M20.38 8.57l-1.23 1.85a8 8 0 01-.22 7.58H5.07A8 8 0 0115.58 6.85l1.85-1.23A1 1 0 0119 6a2 2 0 012 2 1 1 0 01-.62.57z"/></svg>
            Fashion
        </a>
        <a href="<?= base_url('admin/gallery') ?>" class="<?= (isset($title) && strpos($title,'Gallery')!==false)?'active':'' ?>">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            Gallery
        </a>

        <div class="adm-nav-label">Leads</div>
        <a href="<?= base_url('admin/leads') ?>" class="<?= (isset($title) && strpos($title,'Konsultasi')!==false)?'active':'' ?>">
            <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Konsultasi Masuk
        </a>

        <div class="adm-nav-label">Publik</div>
        <a href="<?= base_url() ?>" target="_blank">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
            Lihat Website
        </a>
    </nav>
    <div class="adm-user">
        <span><?= isset($admin_user) ? htmlspecialchars($admin_user) : '' ?></span>
        <a href="<?= base_url('admin/logout') ?>">Keluar</a>
    </div>
</aside>

<!-- MAIN -->
<div class="adm-main">
    <div class="adm-topbar">
        <h1 class="adm-page-title"><?= isset($title) ? htmlspecialchars($title) : 'Admin' ?></h1>
    </div>
    <div class="adm-content">
        <?php $this->load->view($content_view); ?>
    </div>
</div>

</body>
</html>
