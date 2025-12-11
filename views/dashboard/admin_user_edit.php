<?php
// Admin User Edit: $user (array), $currentUser, $csrf
?>
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit User</h2>
        <a href="/admin/users" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Users
        </a>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="/admin/users/edit/<?= $user['id'] ?>">
                        <?= $csrf ?? '' ?>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-medium">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="role" class="form-label fw-medium">Role</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="innovator" <?= ($user['role'] ?? '') === 'innovator' ? 'selected' : '' ?>>Innovator</option>
                                    <option value="sponsor" <?= ($user['role'] ?? '') === 'sponsor' ? 'selected' : '' ?>>Sponsor</option>
                                    <option value="admin" <?= ($user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="organization" class="form-label fw-medium">Organization</label>
                                <input type="text" class="form-control" id="organization" name="organization" 
                                       value="<?= htmlspecialchars($user['organization'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="bio" class="form-label fw-medium">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-lg me-2"></i>Save Changes
                            </button>
                            <a href="/admin/users/view/<?= $user['id'] ?>" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <img src="<?= htmlspecialchars($user['profile_image'] ?? '/public/assets/default-profile.png') ?>" 
                         alt="Profile" 
                         class="rounded-circle mb-3" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                    <h5 class="fw-bold mb-1"><?= htmlspecialchars($user['name'] ?? 'Unknown') ?></h5>
                    <p class="text-muted small mb-2"><?= htmlspecialchars($user['email'] ?? '') ?></p>
                    <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'sponsor' ? 'success' : 'primary') ?>">
                        <?= ucfirst($user['role'] ?? 'unknown') ?>
                    </span>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Account Status</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Status:</span>
                        <?php if (!empty($user['is_active'])): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactive</span>
                        <?php endif; ?>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Joined:</span>
                        <span class="text-muted"><?= isset($user['created_at']) ? date('M j, Y', strtotime($user['created_at'])) : '-' ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
