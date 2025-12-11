<?php
// Admin User View: $user (array), $currentUser
?>
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User Details</h2>
        <a href="/admin/users" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Users
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <img src="<?= htmlspecialchars($user['profile_image'] ?? '/public/assets/default-profile.png') ?>" 
                             alt="Profile" 
                             class="rounded-circle" 
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <h4 class="fw-bold mb-1"><?= htmlspecialchars($user['name'] ?? 'Unknown') ?></h4>
                    <p class="text-muted mb-2"><?= htmlspecialchars($user['email'] ?? '') ?></p>
                    <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'sponsor' ? 'success' : 'primary') ?> fs-6">
                        <?= ucfirst($user['role'] ?? 'unknown') ?>
                    </span>
                    <div class="mt-3">
                        <?php if (!empty($user['is_active'])): ?>
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Active</span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i>Inactive</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Full Name:</div>
                        <div class="col-sm-8 fw-medium"><?= htmlspecialchars($user['name'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email:</div>
                        <div class="col-sm-8 fw-medium"><?= htmlspecialchars($user['email'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Role:</div>
                        <div class="col-sm-8 fw-medium"><?= ucfirst($user['role'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Organization:</div>
                        <div class="col-sm-8 fw-medium"><?= htmlspecialchars($user['organization'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Phone:</div>
                        <div class="col-sm-8 fw-medium"><?= htmlspecialchars($user['phone'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Location:</div>
                        <div class="col-sm-8 fw-medium"><?= htmlspecialchars($user['location'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Bio:</div>
                        <div class="col-sm-8 fw-medium"><?= nl2br(htmlspecialchars($user['bio'] ?? '-')) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Registered:</div>
                        <div class="col-sm-8 fw-medium"><?= isset($user['created_at']) ? date('M j, Y H:i', strtotime($user['created_at'])) : '-' ?></div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="/admin/users/edit/<?= $user['id'] ?>" class="btn btn-primary">
                            <i class="bi bi-pencil me-2"></i>Edit User
                        </a>
                        <?php if (!empty($user['is_active'])): ?>
                            <a href="/admin/users/deactivate/<?= $user['id'] ?>" class="btn btn-warning">
                                <i class="bi bi-pause-circle me-2"></i>Deactivate
                            </a>
                        <?php else: ?>
                            <a href="/admin/users/activate/<?= $user['id'] ?>" class="btn btn-success">
                                <i class="bi bi-play-circle me-2"></i>Activate
                            </a>
                        <?php endif; ?>
                        <?php if (isset($currentUser) && $user['id'] !== $currentUser['id']): ?>
                            <a href="/admin/users/delete/<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                <i class="bi bi-trash me-2"></i>Delete User
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
