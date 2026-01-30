<?php
// Admin Contact Messages View
?>
<div class="container my-4">
    <h2 class="mb-4">Public Inquiries</h2>
    
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox display-4 opacity-25 d-block mb-3"></i>
                            <div>No inquiries found.</div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <tr class="<?= !empty($msg['is_read']) ? '' : 'table-warning' ?>">
                            <td class="fw-bold"><?= htmlspecialchars($msg['name']) ?></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" class="text-decoration-none">
                                    <?= htmlspecialchars($msg['email']) ?>
                                </a>
                            </td>
                            <td>
                                <div style="max-width: 400px; white-space: pre-wrap;"><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                            </td>
                            <td><?= date('M j, Y H:i', strtotime($msg['created_at'])) ?></td>
                            <td>
                                <a href="/admin/contact-messages/delete/<?= $msg['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this inquiry?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if (isset($pagination['last_page']) && $pagination['last_page'] > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $pagination['current_page'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= max(1, $pagination['current_page'] - 1) ?>">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">Page <?= $pagination['current_page'] ?> of <?= $pagination['last_page'] ?></span>
                </li>
                <li class="page-item <?= $pagination['current_page'] >= $pagination['last_page'] ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= min($pagination['last_page'], $pagination['current_page'] + 1) ?>">Next</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>
