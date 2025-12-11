<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Dashboard') ?> | Innovation Trading Center</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/public/assets/css/styles.css?v=<?= time() ?>" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --sidebar-bg: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f1f5f9;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .dashboard-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            padding: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        
        .sidebar-nav {
            padding: 1rem;
            flex: 1;
            overflow-y: auto;
        }
        
        .nav-section {
            margin-bottom: 1.5rem;
        }
        
        .nav-section-title {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0 1rem;
            margin-bottom: 0.5rem;
        }
        
        .dashboard-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
        }
        
        .dashboard-sidebar .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        
        .dashboard-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            transform: translateX(4px);
        }
        
        .dashboard-sidebar .nav-link.active {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }
        
        .dashboard-sidebar .nav-link.logout-link {
            color: #f87171;
        }
        
        .dashboard-sidebar .nav-link.logout-link:hover {
            background: rgba(248, 113, 113, 0.1);
            color: #fca5a5;
        }
        
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .sidebar-user-info {
            flex: 1;
            min-width: 0;
        }
        
        .sidebar-user-name {
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .sidebar-user-role {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            text-transform: capitalize;
        }
        
        /* Main Content */
        .dashboard-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        
        .dashboard-header {
            height: var(--header-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .dashboard-header h4 {
            font-weight: 700;
            font-size: 1.25rem;
            color: #0f172a;
            margin: 0;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-search {
            position: relative;
        }
        
        .header-search input {
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            background: #f8fafc;
            width: 250px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .header-search input:focus {
            outline: none;
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .header-search i {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        
        .header-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.2s;
            position: relative;
        }
        
        .header-icon-btn:hover {
            background: #f8fafc;
            color: #3b82f6;
            border-color: #3b82f6;
        }
        
        .header-icon-btn .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .dashboard-content {
            padding: 2rem;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .dashboard-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .dashboard-sidebar.show {
                transform: translateX(0);
            }
            
            .dashboard-main {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: flex !important;
            }
        }
        
        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            align-items: center;
            justify-content: center;
            color: #64748b;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="dashboard-sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4>
                <span class="brand-icon"><i class="bi bi-lightning-charge-fill"></i></span>
                InoTrade
            </h4>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main Menu</div>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/dashboard') === 0 && strlen($_SERVER['REQUEST_URI']) <= 11 ? 'active' : '' ?>" href="/dashboard">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/innovations') === 0 ? 'active' : '' ?>" href="/innovations">
                    <i class="bi bi-lightbulb-fill"></i> Innovations
                </a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/messages') === 0 ? 'active' : '' ?>" href="/messages">
                    <i class="bi bi-chat-dots-fill"></i> Messages
                </a>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Personal</div>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/profile') === 0 ? 'active' : '' ?>" href="/profile">
                    <i class="bi bi-person-fill"></i> Profile
                </a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/my-innovations') === 0 ? 'active' : '' ?>" href="/my-innovations">
                    <i class="bi bi-rocket-takeoff-fill"></i> My Innovations
                </a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/favorites') === 0 ? 'active' : '' ?>" href="/favorites">
                    <i class="bi bi-heart-fill"></i> Favorites
                </a>
                <?php if (isset($currentUser) && $currentUser['role'] === 'innovator'): ?>
                    <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/my-sponsorships') === 0 ? 'active' : '' ?>" href="/my-sponsorships">
                        <i class="bi bi-cash-coin"></i> Sponsorships
                    </a>
                <?php endif; ?>
            </div>
            
            <?php if (isset($currentUser) && $currentUser['role'] === 'admin'): ?>
            <div class="nav-section">
                <div class="nav-section-title">Administration</div>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/users') === 0 ? 'active' : '' ?>" href="/admin/users">
                    <i class="bi bi-people-fill"></i> Manage Users
                </a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/innovations') === 0 ? 'active' : '' ?>" href="/admin/innovations">
                    <i class="bi bi-kanban-fill"></i> Manage Innovations
                </a>
                <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/messages') === 0 ? 'active' : '' ?>" href="/admin/messages">
                    <i class="bi bi-envelope-fill"></i> All Messages
                </a>
            </div>
            <?php endif; ?>
            
            <div class="nav-section mt-auto">
                <a class="nav-link" href="/home">
                    <i class="bi bi-house-fill"></i> Back to Home
                </a>
                <a class="nav-link logout-link" href="/logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </nav>
        
        <?php if (isset($currentUser)): ?>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <img src="<?= htmlspecialchars($currentUser['profile_image'] ?? '/public/assets/default-profile.png') ?>" alt="Profile" class="sidebar-user-avatar">
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name"><?= htmlspecialchars($currentUser['name']) ?></div>
                    <div class="sidebar-user-role"><?= htmlspecialchars($currentUser['role']) ?></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </aside>
    
    <!-- Main Content -->
    <div class="dashboard-main">
        <header class="dashboard-header">
            <div class="d-flex align-items-center">
                <button class="mobile-menu-btn" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h4><?= htmlspecialchars($title ?? 'Dashboard') ?></h4>
            </div>
            
            <div class="header-actions">
                <div class="header-search d-none d-md-block">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                
                <a href="/messages" class="header-icon-btn text-decoration-none">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-danger rounded-pill">3</span>
                </a>
                
                <?php if (isset($currentUser)): ?>
                <div class="dropdown">
                    <button class="header-icon-btn dropdown-toggle border-0" type="button" data-bs-toggle="dropdown">
                        <img src="<?= htmlspecialchars($currentUser['profile_image'] ?? '/public/assets/default-profile.png') ?>" alt="Profile" class="rounded" width="28" height="28" style="object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2">
                        <li><a class="dropdown-item rounded-2 py-2" href="/profile"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item rounded-2 py-2" href="/home"><i class="bi bi-house me-2"></i> Home</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item rounded-2 py-2 text-danger" href="/logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </header>
        
        <main class="dashboard-content">
            <?php if (isset($_SESSION['flash'])): ?>
                <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
                    <?= htmlspecialchars($_SESSION['flash']['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>
            
            <?= $content ?? '' ?>
        </main>
    </div>
    
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
