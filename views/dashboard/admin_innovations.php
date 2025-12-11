<?php
// Admin Innovation Management View: $innovations (array), $filters (array), $currentUser
?>
<div class="container my-4">
    <h2 class="mb-4">Innovation Management</h2>
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" class="form-control" name="search" placeholder="Search by title or innovator" value="<?= htmlspecialchars($filters['search'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="category">
                <option value="">All Categories</option>
                <?php foreach ($filters['categories'] ?? [] as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($filters['category'] ?? '') == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="status">
                <option value="">All Statuses</option>
                <option value="draft" <?= ($filters['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= ($filters['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                <option value="funded" <?= ($filters['status'] ?? '') === 'funded' ? 'selected' : '' ?>>Funded</option>
                <option value="completed" <?= ($filters['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Completed</option>
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
                    <th>Title</th>
                    <th>Innovator</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($innovations as $inv): ?>
                    <?php if (!is_array($inv) || !isset($inv['id'])) continue; ?>
                    <tr>
                        <td><?= htmlspecialchars($inv['title'] ?? '') ?></td>
                        <td><?= htmlspecialchars($inv['innovator_name'] ?? 'Unknown') ?></td>
                        <td><?= htmlspecialchars($inv['category_name'] ?? 'Uncategorized') ?></td>
                        <td>
                            <?php $status = $inv['status'] ?? 'draft'; ?>
                            <span class="badge bg-<?= $status === 'published' ? 'success' : ($status === 'draft' ? 'secondary' : ($status === 'funded' ? 'info' : 'dark')) ?>">
                                <?= ucfirst($status) ?>
                            </span>
                        </td>
                        <td><?= isset($inv['created_at']) ? date('M j, Y', strtotime($inv['created_at'])) : '-' ?></td>
                        <td>
                            <a href="/innovations/<?= $inv['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                            <a href="/innovations/<?= $inv['id'] ?>/edit" class="btn btn-sm btn-outline-warning">Edit</a>
                            <?php if (($inv['status'] ?? '') !== 'published'): ?>
                                <a href="/innovations/<?= $inv['id'] ?>/toggle-status" class="btn btn-sm btn-outline-success">Publish</a>
                            <?php endif; ?>
                            <?php if (($inv['status'] ?? '') === 'published'): ?>
                                <a href="/innovations/<?= $inv['id'] ?>/toggle-status" class="btn btn-sm btn-outline-secondary">Unpublish</a>
                            <?php endif; ?>
                            <a href="/admin/innovation/delete?id=<?= $inv['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this innovation?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div> 