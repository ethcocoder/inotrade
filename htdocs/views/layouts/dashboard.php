<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div class="dashboard-sidebar vh-100 p-3">
            <h4 class="text-white">Dashboard</h4>
            <nav class="nav flex-column">
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/dashboard') === 0 ? 'active' : '' ?>" href="/dashboard"><i class="bi bi-speedometer2 me-2"></i> Home</a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/innovations') === 0 ? 'active' : '' ?>" href="/innovations"><i class="bi bi-collection me-2"></i> Innovations</a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/messages') === 0 ? 'active' : '' ?>" href="/messages"><i class="bi bi-envelope me-2"></i> Messages</a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/profile') === 0 ? 'active' : '' ?>" href="/profile"><i class="bi bi-person me-2"></i> Profile</a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/my-innovations') === 0 ? 'active' : '' ?>" href="/my-innovations"><i class="bi bi-star me-2"></i> My Innovations</a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/favorites') === 0 ? 'active' : '' ?>" href="/favorites"><i class="bi bi-heart me-2"></i> Favorites</a>
                <?php if (isset($currentUser) && $currentUser['role'] === 'innovator'): ?>
                    <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/my-sponsorships') === 0 ? 'active' : '' ?>" href="/my-sponsorships"><i class="bi bi-cash-coin me-2"></i> Sponsorships</a>
                <?php endif; ?>
                <?php if (isset($currentUser) && $currentUser['role'] === 'admin'): ?>
                    <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin') === 0 ? 'active' : '' ?>" href="/admin"><i class="bi bi-gear me-2"></i> Admin</a>
                <?php endif; ?>
                <a class="nav-link" href="/logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
            </nav>
        </div>
        <div class="w-100">
            <header class="p-3 bg-light border-bottom d-flex justify-content-between align-items-center">
                <h4><?= htmlspecialchars($title ?? 'Dashboard') ?></h4>
                <?php if (isset($currentUser)): ?>
                    <div>
                        <img src="<?= htmlspecialchars($currentUser['profile_image'] ?? '/assets/default-profile.png') ?>" alt="Profile" class="rounded-circle" width="40" height="40">
                        <span class="ms-2"><?= htmlspecialchars($currentUser['name']) ?></span>
                    </div>
                <?php endif; ?>
            </header>
            <main class="p-3">
                <?= $content ?? '' ?>
            </main>
        </div>
    </div>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
