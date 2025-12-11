<?php
require_once 'BaseController.php';

class AdminController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    // Main admin dashboard
    public function index() {
        $stats = [
            'users' => $this->user->countAll(),
            'innovations' => $this->innovation->countAll(),
            'messages' => $this->message->countAll(),
        ];
        $currentUser = $this->getCurrentUser();
        $this->render('dashboard/admin', [
            'stats' => $stats,
            'currentUser' => $currentUser
        ]);
    }

    // User management: list/search/filter users
    public function users() {
        $search = $_GET['search'] ?? '';
        $role = $_GET['role'] ?? '';
        $status = $_GET['status'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $result = $this->user->getAllWithFilters($search, $role, $status, $page);
        $currentUser = $this->getCurrentUser();
        $this->render('dashboard/admin_users', [
            'users' => $result['data'] ?? [],  // Pass just the data array
            'pagination' => $result,            // Pass full result for pagination
            'filters' => [                      // Pass filters for form
                'search' => $search,
                'role' => $role,
                'status' => $status
            ],
            'currentUser' => $currentUser
        ]);
    }

    // User management: view/edit user
    public function userView($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/users');
        $user = $this->user->find($id);
        if (!$user) $this->redirect('/admin/users');
        $currentUser = $this->getCurrentUser();
        $this->render('dashboard/admin_user_view', [
            'user' => $user,
            'currentUser' => $currentUser
        ]);
    }

    // User management: edit user
    public function userEdit($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/users');
        $user = $this->user->find($id);
        if (!$user) $this->redirect('/admin/users');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'role' => $_POST['role'] ?? $user['role'],
                'organization' => trim($_POST['organization'] ?? ''),
                'bio' => trim($_POST['bio'] ?? ''),
            ];
            $this->user->update($id, $data);
            $this->setFlash('success', 'User updated successfully.');
            $this->redirect('/admin/users');
        }
        
        $currentUser = $this->getCurrentUser();
        $this->render('dashboard/admin_user_edit', [
            'user' => $user,
            'currentUser' => $currentUser,
            'csrf' => $this->csrfInput()
        ]);
    }

    // User management: activate user
    public function userActivate($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/users');
        $this->user->update($id, ['is_active' => 1]);
        $this->setFlash('success', 'User activated successfully.');
        $this->redirect('/admin/users');
    }

    // User management: deactivate user
    public function userDeactivate($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/users');
        $this->user->update($id, ['is_active' => 0]);
        $this->setFlash('success', 'User deactivated successfully.');
        $this->redirect('/admin/users');
    }

    // User management: delete
    public function userDelete($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/users');
        $this->user->delete($id);
        $this->setFlash('success', 'User deleted.');
        $this->redirect('/admin/users');
    }

    // Innovation management: list/search/filter
    public function innovations() {
        $search = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $innovations = $this->innovation->getAllWithAdminFilters($search, $status, $page);
        $currentUser = $this->getCurrentUser();
        $this->render('dashboard/admin_innovations', [
            'innovations' => $innovations,
            'search' => $search,
            'status' => $status,
            'currentUser' => $currentUser
        ]);
    }

    // Innovation management: approve/reject
    public function innovationToggleStatus($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/innovations');
        $innovation = $this->innovation->find($id);
        if (!$innovation) $this->redirect('/admin/innovations');
        $newStatus = $innovation['status'] === 'approved' ? 'rejected' : 'approved';
        $this->innovation->update($id, ['status' => $newStatus]);
        $this->setFlash('success', 'Innovation status updated.');
        $this->redirect('/admin/innovations');
    }

    // Innovation management: delete
    public function innovationDelete($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/innovations');
        $this->innovation->delete($id);
        $this->setFlash('success', 'Innovation deleted.');
        $this->redirect('/admin/innovations');
    }

    // Message management: list/search/filter
    public function messages() {
        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $messages = $this->message->getAllWithAdminFilters($search, $page);
        $currentUser = $this->getCurrentUser();
        $this->render('dashboard/admin_messages', [
            'messages' => $messages,
            'search' => $search,
            'currentUser' => $currentUser
        ]);
    }

    // Message management: view conversation
    public function messageView($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/messages');
        $message = $this->message->find($id);
        if (!$message) $this->redirect('/admin/messages');
        $conversation = $this->message->getConversation($message['sender_id'], $message['receiver_id']);
        $currentUser = $this->getCurrentUser();
        $this->render('messages/conversation', [
            'conversation' => $conversation,
            'contact' => $this->user->find($message['sender_id']),
            'currentUser' => $currentUser
        ]);
    }

    // Message management: delete
    public function messageDelete($id = null) {
        if (!$id) $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/messages');
        $this->message->delete($id);
        $this->setFlash('success', 'Message deleted.');
        $this->redirect('/admin/messages');
    }
} 