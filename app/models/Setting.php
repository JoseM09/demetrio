<?php
// Setting.php - Modelo para configuraciones generales (Redes Sociales, etc.)

class Setting {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Utiliza la conexión unificada
    }

    // Obtener todas las configuraciones indexadas por clave
    public function getAll() {
        $query = 'SELECT * FROM settings';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $settings = [];
        foreach ($results as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    // Actualizar o insertar una configuración específica
    public function update($key, $value) {
        $query = 'INSERT INTO settings (`key`, `value`) VALUES (:key, :value) 
                  ON DUPLICATE KEY UPDATE `value` = :value';
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':key' => $key,
            ':value' => $value
        ]);
    }
}
?>
