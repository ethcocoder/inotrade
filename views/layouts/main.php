<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <style>
        :root {
            --font-primary: 'Outfit', sans-serif;
            --primary-gradient: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            --secondary-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: 1px solid rgba(255, 255, 255, 0.3);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        
        body {
            font-family: var(--font-primary);
            color: #1e293b;
            background-color: #f1f5f9;
        }

        <?php if ($useGlassNav): ?>
        body, html { 
            background: transparent !important; 
        }
        nav.navbar.navbar-glass {
            background: rgba(255, 255, 255, 0.05) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: absolute;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }
        /* Sticky state could be added with JS later */
        <?php endif; ?>

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            color: #0f172a;
        }
        
        <?php if ($useGlassNav): ?>
        .navbar-brand { color: #fff; text-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        <?php endif; ?>

        .navbar-nav .nav-link {
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            color: <?php echo $useGlassNav ? 'rgba(255,255,255,0.85)' : '#475569'; ?>;
        }

        .navbar-nav .nav-link:hover, .navbar-nav .nav-link:focus {
            color: <?php echo $useGlassNav ? '#fff' : '#2563eb'; ?> !important;
            background: <?php echo $useGlassNav ? 'rgba(255,255,255,0.1)' : 'rgba(37,99,235,0.05)'; ?>;
        }

        .navbar-nav .nav-link.register-link {
            background: #fff;
            color: #2563eb !important;
            margin-left: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* More subtle shadow */
            padding: 0.5rem 1.5rem !important;
            border-radius: 2rem;
        }
        
        .navbar-nav .nav-link.register-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            background: #f8fafc;
        }
        
        /* Dropdown enhancements if needed */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border-radius: 1rem;
            padding: 0.5rem;
        }
        
        .dropdown-item {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }
        
        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #2563eb;
        }
    </style>
</head>
<body class="<?php if (
    $isHome) echo 'home-page';
    else if ($isAuth) echo 'auth-page';
    else if ($isAbout) echo 'about-page';
    else if ($isContact) echo 'contact-page';
?>">
<?php
$isHome = ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/home');
$isAuth = ($_SERVER['REQUEST_URI'] === '/login' || $_SERVER['REQUEST_URI'] === '/register');
$isAbout = ($_SERVER['REQUEST_URI'] === '/about');
$isContact = ($_SERVER['REQUEST_URI'] === '/contact');
$useGlassNav = $isHome || $isAuth;
?>
<nav class="navbar navbar-expand-lg <?php echo $useGlassNav ? 'navbar-glass' : 'navbar-dark bg-primary'; ?>">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">Innovation Trading Center</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="/innovations">Innovations</a></li>
                    <li class="nav-item"><a class="nav-link" href="/messages">Messages</a></li>
                    <li class="nav-item"><a class="nav-link" href="/messages/send?contact_admin=1">Contact Admin</a></li>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link register-link" href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php if ($isHome || $isAuth || $isAbout || $isContact): ?>
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="container mt-4">
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['flash']['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>
    <?= $content ?>
<?php else: ?>
    <div class="container">
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['flash']['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
        <?= $content ?>
    </div>
<?php endif; ?>
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html> 