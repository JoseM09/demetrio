<?php
// AuthController.php - Controlador de autenticación

class AuthController extends Controller {

    public function login() {
        // Redirigir al panel si ya ha iniciado sesión
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($username) || empty($password)) {
                $this->view('auth/login', ['error' => 'Por favor, completa todos los campos.']);
                return;
            }

            // Buscar el usuario por su username
            $userModel = $this->model('User');
            $user = $userModel->getByUsername($username);

            // Verificar si el usuario existe y si la contraseña coincide con el hash
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['username'] = $user['username'];
                
                header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard');
                exit;
            } else {
                $this->view('auth/login', ['error' => 'Nombre de usuario o contraseña incorrectos.']);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function logout() {
        // Destruir todas las variables de sesión
        $_SESSION = [];

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();

        header('Location: ' . BASE_URL . 'index.php?url=home/index');
        exit;
    }
}
?>
