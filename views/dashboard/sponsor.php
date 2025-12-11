<?php
// Sponsor Dashboard View: $currentUser, $stats (favorites, messages, sponsored)
?>

<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 bg-gradient text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body p-4 position-relative z-index-1">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-2">Welcome back, <?= htmlspecialchars($currentUser['name']) ?>! 💰</h2>
                        <p class="opacity-90 mb-3">Discover amazing innovations waiting for your support.</p>
                        <a href="/innovations" class="btn btn-light btn-sm rounded-pill px-4 fw-bold shadow-sm">
                            <i class="bi bi-search me-1"></i> Browse Innovations
                        </a>
                    </div>
                    <div class="col-lg-4 text-end d-none d-lg-block">
                        <i class="bi bi-currency-dollar display-1 opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-heart-fill fs-4"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                        <i class="bi bi-star-fill me-1"></i> Saved
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['favorites'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">Favorite Innovations</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/favorites" class="text-primary text-decoration-none small fw-bold">
                    View all <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-chat-dots-fill fs-4"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                        <i class="bi bi-envelope me-1"></i> Inbox
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['messages'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">Messages</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/messages" class="text-primary text-decoration-none small fw-bold">
                    View all <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                        <i class="bi bi-trophy-fill me-1"></i> Funded
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['sponsored'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">Sponsored Innovations</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/innovations" class="text-primary text-decoration-none small fw-bold">
                    View all <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 p-4 pb-2">
                <h5 class="fw-bold mb-0">Quick Actions</h5>
            </div>
            <div class="card-body p-4 pt-2">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="/innovations" class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-search fs-5"></i>
                            <span class="fw-bold">Browse Innovations</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/favorites" class="btn btn-outline-success w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-heart fs-5"></i>
                            <span class="fw-bold">View Favorites</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/messages" class="btn btn-outline-info w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-envelope fs-5"></i>
                            <span class="fw-bold">Check Messages</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card {
    transition: all 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1) !important;
}
.bg-success-subtle { background-color: rgba(16, 185, 129, 0.1); }
.bg-primary-subtle { background-color: rgba(59, 130, 246, 0.1); }
.bg-warning-subtle { background-color: rgba(245, 158, 11, 0.1); }
</style>