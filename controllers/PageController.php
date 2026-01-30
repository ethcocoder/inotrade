<?php
require_once 'BaseController.php';
class PageController extends BaseController {
    public function show($view) {
        if ($view === 'contact' && $_SERVER['REQUEST_METHOD'] === 'POST') {
             $this->handleContactSubmission();
             return;
        }
        $this->render($view);
    }

    private function handleContactSubmission() {
        // Validate inputs
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        if (empty($name) || empty($email) || empty($message)) {
            $this->setFlash('error', 'Please fill in all fields.');
            $this->redirect('/contact');
            return;
        }

        require_once __DIR__ . '/../models/ContactMessage.php';
        $contactModel = new ContactMessage();
        $contactModel->create([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
        
        $this->setFlash('success', 'Thank you for your message! We will get back to you soon.');
        $this->redirect('/contact');
    }
} 