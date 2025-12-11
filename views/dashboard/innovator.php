<?php
// Innovator Dashboard View: $currentUser, $stats (my_innovations, messages, favorites)
?>

<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 bg-gradient text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);">
            <div class="card-body p-4 position-relative z-index-1">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-2">Welcome back, <?= htmlspecialchars($currentUser['name']) ?>! 👋</h2>
                        <p class="opacity-90 mb-3">Here's what's happening with your innovations today.</p>
                        <a href="/innovations/create" class="btn btn-light btn-sm rounded-pill px-4 fw-bold shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Post New Innovation
                        </a>
                    </div>
                    <div class="col-lg-4 text-end d-none d-lg-block">
                        <i class="bi bi-rocket-takeoff-fill display-1 opacity-25"></i>
                    </div>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 w-50 h-100 opacity-10" style="background: url('data:image/svg+xml,...') no-repeat center; background-size: cover;"></div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-lightbulb-fill fs-4"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                        <i class="bi bi-arrow-up me-1"></i> Active
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['my_innovations'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">My Innovations</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/my-innovations" class="text-primary text-decoration-none small fw-bold">
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
                        <i class="bi bi-chat-dots-fill fs-4"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                        <i class="bi bi-envelope me-1"></i> New
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
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-heart-fill fs-4"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                        <i class="bi bi-star-fill me-1"></i> Saved
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['favorites'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">Favorites</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/favorites" class="text-primary text-decoration-none small fw-bold">
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
                        <a href="/innovations/create" class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-plus-circle fs-5"></i>
                            <span class="fw-bold">Post Innovation</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/my-innovations" class="btn btn-outline-success w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-collection fs-5"></i>
                            <span class="fw-bold">View My Innovations</span>
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