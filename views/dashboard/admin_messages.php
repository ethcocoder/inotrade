<?php
// Admin Message Management View: $messages (array), $filters (array), $currentUser
?>
<div class="container my-4">
    <h2 class="mb-4">Message Management</h2>
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" class="form-control" name="search" placeholder="Search by sender or receiver" value="<?= htmlspecialchars($filters['search'] ?? '') ?>">
        </div>
        <div class="col-md-2">
            <select class="form-select" name="status">
                <option value="">All Statuses</option>
                <option value="read" <?= ($filters['status'] ?? '') === 'read' ? 'selected' : '' ?>>Read</option>
                <option value="unread" <?= ($filters['status'] ?? '') === 'unread' ? 'selected' : '' ?>>Unread</option>
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
                    <th>From</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-chat-dots display-4 opacity-25 d-block mb-3"></i>
                            <div>No messages found matching your criteria.</div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php if (!is_array($msg) || !isset($msg['id'])) continue; ?>
                        <tr class="<?= !empty($msg['is_read']) ? '' : 'table-warning' ?>">
                            <td><?= htmlspecialchars($msg['sender_name'] ?? 'Unknown') ?></td>
                            <td><?= htmlspecialchars($msg['receiver_name'] ?? 'Unknown') ?></td>
                            <td><?= htmlspecialchars($msg['subject'] ?? '(No subject)') ?></td>
                            <td><?= isset($msg['sent_at']) ? date('M j, Y H:i', strtotime($msg['sent_at'])) : '-' ?></td>
                            <td><?= !empty($msg['is_read']) ? 'Read' : '<strong>Unread</strong>' ?></td>
                            <td>
                                <a href="/messages/conversation?contact_id=<?= $msg['sender_id'] ?? '' ?>" class="btn btn-sm btn-outline-info">View Conversation</a>
                                <a href="/admin/messages/delete/<?= $msg['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
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