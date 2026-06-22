<?php
// AdminController.php - Controlador del Panel de Administración

class AdminController extends Controller {

    // Método auxiliar para proteger las rutas administrativas
    private function checkAuth() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: ' . BASE_URL . 'index.php?url=auth/login');
            exit;
        }
    }

    // Cargar el Dashboard del administrador
    public function dashboard() {
        $this->checkAuth();

        // Obtener publicaciones
        $postModel = $this->model('Post');
        $posts = $postModel->getAll();

        // Obtener mensajes de contacto
        $messageModel = $this->model('Message');
        $messages = $messageModel->getAll();

        // Obtener configuraciones generales (redes sociales)
        $settingModel = $this->model('Setting');
        $settings = $settingModel->getAll();

        $this->view('admin/dashboard', [
            'posts' => $posts,
            'messages' => $messages,
            'settings' => $settings,
            'success' => $_GET['success'] ?? null,
            'error' => $_GET['error'] ?? null
        ]);
    }

    // Marcar un mensaje de contacto como leído
    public function markMessageRead($id = null) {
        $this->checkAuth();
        if ($id === null) {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard');
            exit;
        }

        $messageModel = $this->model('Message');
        $messageModel->markAsRead($id);

        header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard&success=message_read');
        exit;
    }

    // Guardar configuraciones de redes sociales
    public function saveSettings() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $settingModel = $this->model('Setting');
            
            $facebook = trim($_POST['social_facebook'] ?? '');
            $twitter = trim($_POST['social_twitter'] ?? '');
            $instagram = trim($_POST['social_instagram'] ?? '');
            $linkedin = trim($_POST['social_linkedin'] ?? '');
            
            $settingModel->update('social_facebook', $facebook);
            $settingModel->update('social_twitter', $twitter);
            $settingModel->update('social_instagram', $instagram);
            $settingModel->update('social_linkedin', $linkedin);
            
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard&success=settings_updated');
            exit;
        }
    }
}
?>
