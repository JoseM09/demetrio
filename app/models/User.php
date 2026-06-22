<?php
// User.php - Modelo para usuarios (Administradores)

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Buscar un usuario por su nombre de usuario
    public function getByUsername($username) {
        $query = 'SELECT * FROM users WHERE username = :username LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
