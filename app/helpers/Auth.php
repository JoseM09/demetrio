<?php
class Auth {
    public static function check() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
    }

    public static function login($username, $password) {
        // Ejemplo simple (puedes mejorarlo con base de datos)
        if ($username === 'drnunez' && $password === 'inmobiliario2024') {
            $_SESSION['user'] = $username;
            return true;
        }
        return false;
    }

    public static function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }
}
