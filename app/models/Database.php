<?php
// Database.php - Modelo de conexión a la base de datos

class Database {
    private static $connection = null;

    // Obtener la conexión a la base de datos unificada
    public static function getConnection() {
        if (self::$connection === null) {
            self::$connection = getDbConnection();
        }
        return self::$connection;
    }
}
?>
