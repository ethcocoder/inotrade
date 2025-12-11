<?php
// Admin Dashboard View: $currentUser, $stats (users, innovations, messages)
?>

<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 bg-gradient text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
            <div class="card-body p-4 position-relative z-index-1">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-2">Welcome back, <?= htmlspecialchars($currentUser['name']) ?>! 🛡️</h2>
                        <p class="opacity-90 mb-3">You have admin privileges. Monitor and manage the platform here.</p>
                        <a href="/admin/users" class="btn btn-light btn-sm rounded-pill px-4 fw-bold shadow-sm me-2">
                            <i class="bi bi-people me-1"></i> Manage Users
                        </a>
                        <a href="/admin/innovations" class="btn btn-outline-light btn-sm rounded-pill px-4 fw-bold">
                            <i class="bi bi-kanban me-1"></i> Manage Innovations
                        </a>
                    </div>
                    <div class="col-lg-4 text-end d-none d-lg-block">
                        <i class="bi bi-shield-check display-1 opacity-25"></i>
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
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                        <i class="bi bi-arrow-up me-1"></i> Growing
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['users'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">Total Users</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/admin/users" class="text-primary text-decoration-none small fw-bold">
                    Manage users <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-lightbulb-fill fs-4"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                        <i class="bi bi-collection me-1"></i> Active
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['innovations'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">Total Innovations</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/admin/innovations" class="text-primary text-decoration-none small fw-bold">
                    Manage innovations <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 stat-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-chat-dots-fill fs-4"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                        <i class="bi bi-envelope me-1"></i> Activity
                    </span>
                </div>
                <h3 class="fw-bold mb-1"><?= $stats['messages'] ?? 0 ?></h3>
                <p class="text-muted mb-0 small">Total Messages</p>
            </div>
            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                <a href="/admin/messages" class="text-primary text-decoration-none small fw-bold">
                    View messages <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Admin Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 p-4 pb-2">
                <h5 class="fw-bold mb-0">Administration Tools</h5>
            </div>
            <div class="card-body p-4 pt-2">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="/admin/users" class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-people-fill fs-5"></i>
                            <span class="fw-bold">Manage Users</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/admin/innovations" class="btn btn-outline-success w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-kanban-fill fs-5"></i>
                            <span class="fw-bold">Manage Innovations</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/admin/messages" class="btn btn-outline-info w-100 py-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-envelope-fill fs-5"></i>
                            <span class="fw-bold">View All Messages</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Platform Overview -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 p-4 pb-2">
                <h5 class="fw-bold mb-0">Platform Status</h5>
            </div>
            <div class="card-body p-4 pt-2">
                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success rounded-circle" style="width: 10px; height: 10px;"></div>
                        <span>System Status</span>
                    </div>
                    <span class="badge bg-success-subtle text-success">Online</span>
                </div>
                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success rounded-circle" style="width: 10px; height: 10px;"></div>
                        <span>Database</span>
                    </div>
                    <span class="badge bg-success-subtle text-success">Connected</span>
                </div>
                <div class="d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                        <span>Active Sessions</span>
                    </div>
                    <span class="badge bg-primary-subtle text-primary">Normal</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 p-4 pb-2">
                <h5 class="fw-bold mb-0">Quick Stats</h5>
            </div>
            <div class="card-body p-4 pt-2">
                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <span class="text-muted">Innovators</span>
                    <span class="fw-bold"><?= $stats['innovators'] ?? '-' ?></span>
                </div>
                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <span class="text-muted">Sponsors</span>
                    <span class="fw-bold"><?= $stats['sponsors'] ?? '-' ?></span>
                </div>
                <div class="d-flex align-items-center justify-content-between py-3">
                    <span class="text-muted">Pending Approvals</span>
                    <span class="fw-bold text-warning"><?= $stats['pending'] ?? '0' ?></span>
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