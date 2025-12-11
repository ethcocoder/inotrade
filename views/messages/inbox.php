<?php
// Telegram-style Inbox: $conversations (array), $currentUser
?>
<style>
.msg-layout { display: flex; min-height: 70vh; background: var(--bg-card); border-radius: 1.5rem; box-shadow: var(--shadow-lg); overflow: hidden; border: 1px solid var(--border-color); }
.msg-sidebar {
    width: 320px; min-width: 220px; max-width: 100%; background: var(--bg-body); border-right: 1px solid var(--border-color); padding: 1.2rem 0.5rem; display: flex; flex-direction: column;
}
.msg-sidebar .btn { margin-bottom: 1rem; }
.msg-chatlist { flex: 1 1 auto; overflow-y: auto; }
.msg-chatitem {
    display: flex; align-items: center; gap: 0.9rem; padding: 0.7rem 0.8rem; border-radius: 0.7rem; cursor: pointer; transition: background 0.15s; text-decoration: none;
}
.msg-chatitem.active, .msg-chatitem:hover { background: rgba(37, 99, 235, 0.1); }
.msg-chatitem .avatar {
    width: 48px; height: 48px; border-radius: 50%; object-fit: cover; background: var(--border-color); border: 2px solid var(--bg-card);
}
.msg-chatitem .group-badge { font-size: 1.1rem; margin-left: 0.2rem; color: var(--primary); }
.msg-chatitem .chat-info { flex: 1 1 auto; min-width: 0; }
.msg-chatitem .chat-name { font-weight: 600; font-size: 1.08rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--text-body); }
.msg-chatitem .chat-last { color: var(--text-muted); font-size: 0.97rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.msg-chatitem .chat-meta { text-align: right; min-width: 60px; }
.msg-chatitem .unread-badge { background: var(--primary); color: #fff; border-radius: 1rem; font-size: 0.85rem; padding: 0.1rem 0.6rem; margin-left: 0.2rem; }
.msg-chatitem .time { font-size: 0.93rem; color: var(--text-muted); }

.msg-bubble { padding: 0.75rem 1rem; border-radius: 1rem; max-width: 75%; position: relative; }
.msg-bubble.sent { background: var(--primary); color: #fff; border-bottom-right-radius: 0.2rem; }
.msg-bubble.received { background: var(--bg-body); color: var(--text-body); border: 1px solid var(--border-color); border-bottom-left-radius: 0.2rem; }
[data-theme="dark"] .msg-bubble.received { background: #334155; border-color: #475569; color: #f8fafc; }

.msg-meta { font-size: 0.75rem; margin-top: 0.25rem; text-align: right; }
.msg-bubble.sent .msg-meta { color: rgba(255,255,255,0.8); }
.msg-bubble.received .msg-meta { color: var(--text-muted); }

@media (max-width: 900px) { .msg-layout { flex-direction: column; } .msg-sidebar { width: 100%; border-right: none; border-bottom: 1px solid var(--border-color); } }
</style>
<div class="container my-4">
    <div class="msg-layout">
        <div class="msg-sidebar">
            <div class="d-flex gap-2 mb-3">
                <a href="/messages/send" class="btn btn-primary btn-sm flex-fill"><i class="bi bi-chat-dots"></i> New Chat</a>
                <a href="/messages/group/create" class="btn btn-outline-primary btn-sm flex-fill"><i class="bi bi-people"></i> New Group</a>
            </div>
            <div class="msg-chatlist">
                <?php if (empty($conversations)): ?>
                    <div class="text-center text-muted mt-5">No conversations yet.</div>
                <?php else: ?>
                    <?php foreach ($conversations as $chat): ?>
                        <a href="/messages?chat=<?= $chat['id'] ?>&type=<?= $chat['type'] ?>" class="msg-chatitem<?= !empty($chat['active']) ? ' active' : '' ?>">
                            <img src="<?= !empty($chat['avatar']) ? htmlspecialchars($chat['avatar']) : '/assets/default-profile.png' ?>" class="avatar">
                            <div class="chat-info">
                                <div class="chat-name">
                                    <?= htmlspecialchars($chat['name']) ?>
                                    <?php if ($chat['type'] === 'group'): ?><span class="group-badge" title="Group"><i class="bi bi-people-fill"></i></span><?php endif; ?>
                                </div>
                                <div class="chat-last"><?= htmlspecialchars($chat['last_message'] ?? '') ?></div>
                            </div>
                            <div class="chat-meta">
                                <div class="time">
                                    <?= !empty($chat['last_time']) ? htmlspecialchars($chat['last_time']) : '' ?>
                                </div>
                                <?php if (!empty($chat['unread_count'])): ?>
                                    <span class="unread-badge"><?= $chat['unread_count'] ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="flex-fill d-flex align-items-center justify-content-center" style="min-height:400px; background-color: var(--bg-body);">
            <?php if (isset($contactOrGroup) && !empty($contactOrGroup)): ?>
                <div class="w-100" style="max-width:600px; margin:2rem auto;">
                    <div class="d-flex align-items-center mb-3 gap-3 px-3">
                        <img src="<?= !empty($contactOrGroup['profile_image']) ? htmlspecialchars($contactOrGroup['profile_image']) : '/assets/default-profile.png' ?>" alt="Contact" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;">
                        <h4 class="mb-0 text-body" style="font-weight:700; font-size:1.3rem;">Conversation with <?= htmlspecialchars($contactOrGroup['name']) ?></h4>
                    </div>
                    <div class="mb-4 px-3" style="min-height:200px;">
                        <?php foreach ($conversation as $msg): ?>
                            <?php $isMe = $msg['sender_id'] == $currentUser['id']; ?>
                            <div class="d-flex mb-3 <?= $isMe ? 'justify-content-end' : 'justify-content-start' ?>">
                                <div class="msg-bubble <?= $isMe ? 'sent' : 'received' ?>">
                                    <?= nl2br(htmlspecialchars($msg['body'])) ?>
                                    <div class="msg-meta">
                                        <?= htmlspecialchars($msg['sender_name']) ?> · <?= date('M j, Y H:i', strtotime($msg['sent_at'])) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <form method="post" action="/messages/send?receiver_id=<?= $contactOrGroup['id'] ?>&type=<?= $chatType ?>" class="px-3">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                        <div class="input-group">
                            <input type="text" name="body" class="form-control" placeholder="Type a message..." required>
                            <input type="hidden" name="receiver_id" value="<?= $contactOrGroup['id'] ?>">
                            <input type="hidden" name="receiver_type" value="<?= $chatType ?>">
                            <input type="hidden" name="subject" value="">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-send"></i> Send</button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <div class="text-center text-muted">
                    <i class="bi bi-chat-dots" style="font-size:2.5rem;"></i>
                    <div class="mt-2 text-body">Select a conversation to start chatting</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container my-4">
    <div class="msg-layout">
        <div class="msg-sidebar">
            <div class="d-flex gap-2 mb-3">
                <a href="/messages/send" class="btn btn-primary btn-sm flex-fill"><i class="bi bi-chat-dots"></i> New Chat</a>
                <a href="/messages/group/create" class="btn btn-outline-primary btn-sm flex-fill"><i class="bi bi-people"></i> New Group</a>
            </div>
            <div class="msg-chatlist">
                <?php if (empty($conversations)): ?>
                    <div class="text-center text-muted mt-5">No conversations yet.</div>
                <?php else: ?>
                    <?php foreach ($conversations as $chat): ?>
                        <a href="/messages?chat=<?= $chat['id'] ?>&type=<?= $chat['type'] ?>" class="msg-chatitem<?= !empty($chat['active']) ? ' active' : '' ?>">
                            <img src="<?= !empty($chat['avatar']) ? htmlspecialchars($chat['avatar']) : '/assets/default-profile.png' ?>" class="avatar">
                            <div class="chat-info">
                                <div class="chat-name">
                                    <?= htmlspecialchars($chat['name']) ?>
                                    <?php if ($chat['type'] === 'group'): ?><span class="group-badge" title="Group"><i class="bi bi-people-fill"></i></span><?php endif; ?>
                                </div>
                                <div class="chat-last"><?= htmlspecialchars($chat['last_message'] ?? '') ?></div>
                            </div>
                            <div class="chat-meta">
                                <div style="font-size:0.93rem; color:#888;">
                                    <?= !empty($chat['last_time']) ? htmlspecialchars($chat['last_time']) : '' ?>
                                </div>
                                <?php if (!empty($chat['unread_count'])): ?>
                                    <span class="unread-badge"><?= $chat['unread_count'] ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="flex-fill d-flex align-items-center justify-content-center" style="min-height:400px;">
            <?php if (isset($contactOrGroup) && !empty($contactOrGroup)): ?>
                <div class="w-100" style="max-width:600px; margin:2rem auto;">
                    <div class="d-flex align-items-center mb-3 gap-3">
                        <img src="<?= !empty($contactOrGroup['profile_image']) ? htmlspecialchars($contactOrGroup['profile_image']) : '/assets/default-profile.png' ?>" alt="Contact" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;">
                        <h4 class="mb-0" style="font-weight:700; font-size:1.3rem;">Conversation with <?= htmlspecialchars($contactOrGroup['name']) ?></h4>
                    </div>
                    <div class="mb-4" style="min-height:200px;">
                        <?php foreach ($conversation as $msg): ?>
                            <?php $isMe = $msg['sender_id'] == $currentUser['id']; ?>
                            <div class="d-flex mb-3 <?= $isMe ? 'justify-content-end' : 'justify-content-start' ?>">
                                <div class="p-2 rounded" style="background:<?= $isMe ? '#007bff' : '#f1f3f6' ?>; color:<?= $isMe ? '#fff' : '#222' ?>; max-width:70%;">
                                    <?= nl2br(htmlspecialchars($msg['body'])) ?>
                                    <div class="text-end" style="font-size:0.85rem; color:#eee;">
                                        <?= htmlspecialchars($msg['sender_name']) ?> · <?= date('M j, Y H:i', strtotime($msg['sent_at'])) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <form method="post" action="/messages/send?receiver_id=<?= $contactOrGroup['id'] ?>&type=<?= $chatType ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                        <div class="input-group">
                            <input type="text" name="body" class="form-control" placeholder="Type a message..." required>
                            <input type="hidden" name="receiver_id" value="<?= $contactOrGroup['id'] ?>">
                            <input type="hidden" name="receiver_type" value="<?= $chatType ?>">
                            <input type="hidden" name="subject" value="">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-send"></i> Send</button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <div class="text-center text-muted">
                    <i class="bi bi-chat-dots" style="font-size:2.5rem;"></i>
                    <div class="mt-2">Select a conversation to start chatting</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div> 