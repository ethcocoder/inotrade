<?php
// Admin User Management View: $users (array), $filters (array), $currentUser
?>
<div class="container my-4">
    <h2 class="mb-4">User Management</h2>
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" class="form-control" name="search" placeholder="Search by name or email" value="<?= htmlspecialchars($filters['search'] ?? '') ?>">
        </div>
        <div class="col-md-2">
            <select class="form-select" name="role">
                <option value="">All Roles</option>
                <option value="admin" <?= ($filters['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="innovator" <?= ($filters['role'] ?? '') === 'innovator' ? 'selected' : '' ?>>Innovator</option>
                <option value="sponsor" <?= ($filters['role'] ?? '') === 'sponsor' ? 'selected' : '' ?>>Sponsor</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="status">
                <option value="">All Statuses</option>
                <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-people display-4 opacity-25 d-block mb-3"></i>
                            <div>No users found matching your criteria.</div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <?php if (!is_array($user) || !isset($user['id'])) continue; ?>
                        <tr>
                            <td><?= htmlspecialchars($user['name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                            <td><?= ucfirst($user['role'] ?? 'unknown') ?></td>
                            <td>
                                <?php if (!empty($user['is_active'])): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td><?= isset($user['created_at']) ? date('M j, Y', strtotime($user['created_at'])) : '-' ?></td>
                            <td>
                                <a href="/admin/users/view/<?= $user['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                                <a href="/admin/users/edit/<?= $user['id'] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <?php if (!empty($user['is_active'])): ?>
                                    <a href="/admin/users/deactivate/<?= $user['id'] ?>" class="btn btn-sm btn-outline-secondary">Deactivate</a>
                                <?php else: ?>
                                    <a href="/admin/users/activate/<?= $user['id'] ?>" class="btn btn-sm btn-outline-success">Activate</a>
                                <?php endif; ?>
                                <?php if (isset($currentUser) && $user['id'] !== $currentUser['id']): ?>
                                    <a href="/admin/users/delete/<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php 
    // Pagination
    $currentFilters = [];
    if (!empty($filters['search'])) $currentFilters['search'] = $filters['search'];
    if (!empty($filters['role'])) $currentFilters['role'] = $filters['role'];
    if (!empty($filters['status'])) $currentFilters['status'] = $filters['status'];
    $queryString = http_build_query($currentFilters);
    ?>

    <?php if (isset($pagination['last_page']) && $pagination['last_page'] > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $pagination['current_page'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= max(1, $pagination['current_page'] - 1) ?>&<?= $queryString ?>">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">Page <?= $pagination['current_page'] ?> of <?= $pagination['last_page'] ?></span>
                </li>
                <li class="page-item <?= $pagination['current_page'] >= $pagination['last_page'] ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= min($pagination['last_page'], $pagination['current_page'] + 1) ?>&<?= $queryString ?>">Next</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div> 