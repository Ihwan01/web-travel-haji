<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Admin Nuansa Rindu</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=Jost:wght@300;400&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        :root{--cream:#F5F0E8;--brown:#3B2A1A;--gold:#C4A35A;--dark:#1A1008;--muted:#7A6A56}
        body{font-family:'Jost',sans-serif;background:var(--dark);display:flex;align-items:center;justify-content:center;min-height:100vh;font-weight:300}
        .login-wrap{width:100%;max-width:400px;padding:24px}
        .login-box{background:var(--cream);padding:52px 44px}
        .login-logo{font-family:'Cormorant Garamond',serif;font-size:1.1rem;letter-spacing:0.14em;color:var(--brown);margin-bottom:8px;display:flex;align-items:center;gap:8px}
        .login-logo span{color:var(--gold)}
        .login-sub{font-size:0.72rem;color:var(--muted);letter-spacing:0.1em;margin-bottom:40px}
        .form-group{margin-bottom:24px}
        .form-label{display:block;font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--muted);margin-bottom:8px}
        .form-input{width:100%;padding:10px 0 12px;background:transparent;border:none;border-bottom:1px solid rgba(59,42,26,0.25);font-family:'Jost',sans-serif;font-size:0.9rem;font-weight:300;color:var(--brown);outline:none;transition:border-color .2s;border-radius:0}
        .form-input:focus{border-bottom-color:var(--gold)}
        .login-btn{width:100%;padding:13px;background:var(--brown);color:var(--cream);border:none;font-family:'Jost',sans-serif;font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;cursor:pointer;margin-top:32px;transition:background .25s}
        .login-btn:hover{background:var(--gold)}
        .error-msg{background:rgba(180,60,40,0.1);border-left:2px solid #c03020;padding:12px 16px;font-size:0.78rem;color:#a02010;margin-bottom:24px}
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-box">
            <div class="login-logo"><span>✦</span> NUANSA RINDU</div>
            <p class="login-sub">Admin Panel</p>

            <?php if (isset($error)): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url('admin/login') ?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-input" required autofocus>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" required>
                </div>
                <button type="submit" class="login-btn">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>
