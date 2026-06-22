<?php
// ../app/init.php - Inicialización del proyecto

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir el directorio raíz
define('ROOT_DIR', dirname(__DIR__));

// Detectar dinámicamente la URL base del proyecto (ej: /demetrio/public/)
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$baseUrl = str_replace('index.php', '', $scriptName);
define('BASE_URL', $baseUrl);

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'demetrio_blog');
define('DB_USER', 'root');
define('DB_PASS', ''); // Cambiar si es necesario

// Función para conectar a la base de datos y realizar auto-instalación si es necesario
function getDbConnection() {
    try {
        // Intentar conectar a la base de datos existente
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Auto-migración para agregar columna 'category' si no existe
        try {
            $stmt = $pdo->query("SHOW COLUMNS FROM `posts` LIKE 'category'");
            if (!$stmt->fetch()) {
                $pdo->exec("ALTER TABLE `posts` ADD COLUMN `category` VARCHAR(100) NOT NULL DEFAULT 'Análisis Político'");
            }
        } catch (PDOException $ex) {
            // Silencioso en caso de que las tablas no existan aún
        }

        // Auto-migración para crear tabla de configuraciones si no existe
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS `settings` (
                `key` VARCHAR(50) PRIMARY KEY,
                `value` TEXT DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
            
            // Insertar valores por defecto de redes sociales si no existen
            $stmt = $pdo->query("SELECT COUNT(*) FROM `settings`");
            if ($stmt->fetchColumn() == 0) {
                $pdo->exec("INSERT INTO `settings` (`key`, `value`) VALUES
                    ('social_facebook', 'https://facebook.com'),
                    ('social_twitter', 'https://twitter.com'),
                    ('social_instagram', 'https://instagram.com'),
                    ('social_linkedin', 'https://linkedin.com')");
            }
        } catch (PDOException $ex) {
            // Silencioso
        }
        
        return $pdo;
    } catch (PDOException $e) {
        // Si falla porque no existe, intentar crearla ejecutando el script SQL
        try {
            $dsnWithoutDb = "mysql:host=" . DB_HOST . ";charset=utf8mb4";
            $pdoInit = new PDO($dsnWithoutDb, DB_USER, DB_PASS);
            $pdoInit->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sqlFile = ROOT_DIR . '/app/database.sql';
            if (file_exists($sqlFile)) {
                $sqlContent = file_get_contents($sqlFile);
                
                // Ejecutar la creación de la DB y las tablas
                $pdoInit->exec($sqlContent);
                
                // Conectar nuevamente con la base de datos ya creada
                $dsnWithDb = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                $pdo = new PDO($dsnWithDb, DB_USER, DB_PASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } else {
                die("Error: El archivo de base de datos 'database.sql' no se encuentra en: " . $sqlFile);
            }
        } catch (PDOException $ex) {
            die("Error crítico de auto-instalación de base de datos: " . $ex->getMessage());
        }
    }
}

// Autoload de todas las clases del proyecto (core, controllers, models)
spl_autoload_register(function ($class) {
    $paths = [
        ROOT_DIR . '/core/',
        ROOT_DIR . '/app/controllers/',
        ROOT_DIR . '/app/models/',
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    
    // Si no se encuentra, registrar el error de forma silenciosa para que otros autoloaders puedan intentarlo
});

// Establecer el manejo de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configurar la zona horaria para las fechas y horas
date_default_timezone_set('America/Santo_Domingo');

// Función helper global para formatear fechas al español de forma elegante
function formatSpanishDate($dateStr) {
    if (empty($dateStr)) return '';
    $timestamp = strtotime($dateStr);
    $months = [
        'January' => 'enero', 'February' => 'febrero', 'March' => 'marzo',
        'April' => 'abril', 'May' => 'mayo', 'June' => 'junio',
        'July' => 'julio', 'August' => 'agosto', 'September' => 'septiembre',
        'October' => 'octubre', 'November' => 'noviembre', 'December' => 'diciembre'
    ];
    $day = date('j', $timestamp); // Sin ceros a la izquierda para hacerlo más natural en español
    $monthEnglish = date('F', $timestamp);
    $monthSpanish = $months[$monthEnglish] ?? $monthEnglish;
    $year = date('Y', $timestamp);
    return "$day de $monthSpanish, $year";
}
?>
