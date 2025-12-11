<?php
// Sponsor Favorites Management View: $favorites (array), $currentUser
?>
<div class="container my-4">
    <h2 class="mb-4">My Favorites</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Innovator</th>
                    <th>Category</th>
                    <th>Date Favorited</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($favorites as $fav): ?>
                    <?php if (!is_array($fav) || !isset($fav['id'])) continue; ?>
                    <tr>
                        <td><?= htmlspecialchars($fav['title'] ?? '') ?></td>
                        <td><?= htmlspecialchars($fav['innovator_name'] ?? 'Unknown') ?></td>
                        <td><?= htmlspecialchars($fav['category_name'] ?? 'Uncategorized') ?></td>
                        <td><?= isset($fav['created_at']) ? date('M j, Y', strtotime($fav['created_at'])) : '-' ?></td>
                        <td>
                            <a href="/innovations/<?= $fav['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                            <a href="/innovations/<?= $fav['id'] ?>/favorite" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this innovation from your favorites?');">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div> 