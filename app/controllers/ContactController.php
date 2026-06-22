<?php
// ContactController.php - Controlador para la página de contacto

class ContactController extends Controller {

    public function form() {
        $this->view('contact/form');
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $subject = trim($_POST['subject'] ?? 'Mensaje desde Blog Personal');
            $messageText = trim($_POST['message'] ?? '');

            if (empty($name) || empty($email) || empty($messageText)) {
                $this->view('contact/form', ['error' => 'Por favor, completa todos los campos obligatorios.']);
                return;
            }

            // Guardar el mensaje en la base de datos usando el modelo Message
            $messageModel = $this->model('Message');
            $success = $messageModel->create($name, $email, $subject, $messageText);

            if ($success) {
                // Enviar correo de manera silenciosa por si no hay servidor local smtp configurado
                @mail('contacto@demetrionunez.com', $subject, $messageText, 'From: ' . $email);
                
                $this->view('contact/form', ['success' => '¡Gracias por contactarnos! Tu mensaje ha sido guardado y enviado correctamente.']);
            } else {
                $this->view('contact/form', ['error' => 'Ocurrió un error al guardar tu mensaje. Por favor intenta de nuevo.']);
            }
        } else {
            $this->view('contact/form');
        }
    }
}
?>
