<?php
// Message.php - Modelo para los mensajes de contacto

class Message {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Guardar un nuevo mensaje de contacto
    public function create($name, $email, $subject, $message) {
        $query = 'INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)';
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);
    }

    // Obtener todos los mensajes para el panel de administración
    public function getAll() {
        $query = 'SELECT * FROM messages ORDER BY created_at DESC';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Marcar mensaje como leído
    public function markAsRead($id) {
        $query = 'UPDATE messages SET is_read = 1 WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
