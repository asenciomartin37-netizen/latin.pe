<?php
// config.php
session_start();

// Cargar variables de entorno manualmente
function loadEnv() {
    $envFile = __DIR__ . '/.env';
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '#') === 0) continue;
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
            $_ENV[trim($key)] = trim($value);
        }
    }
}
loadEnv();

// Definir constantes - si falta .env en producción, la app debe fallar explícitamente
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: '');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: '');

// Validar que las credenciales estén configuradas
if (empty(DB_USER) || empty(DB_NAME)) {
    die("Error: Credenciales de base de datos no configuradas. Crea el archivo .env con DB_USER, DB_PASS y DB_NAME.");
}
define('APP_ENV', getenv('APP_ENV') ?: 'production');
define('APP_DEBUG', filter_var(getenv('APP_DEBUG') ?: false, FILTER_VALIDATE_BOOLEAN));
define('APP_NAME', getenv('APP_NAME') ?: 'Sistema FTTH');
define('APP_URL', getenv('APP_URL') ?: 'https://latin.pe/mp/');

// Configuración de sesión segura
if (APP_ENV === 'production') {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.cookie_samesite', 'Strict');
}
ini_set('session.use_only_cookies', 1);
ini_set('session.gc_maxlifetime', 3600);

// Configuración de errores
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/logs/error.log');
}

// Crear directorio de logs si no existe
if (!is_dir(__DIR__ . '/logs')) {
    mkdir(__DIR__ . '/logs', 0755, true);
}
if (!is_dir(__DIR__ . '/cache')) {
    mkdir(__DIR__ . '/cache', 0755, true);
}

// ============ FUNCIONES DE BASE DE DATOS ============

function conectarDB() {
    static $conn = null;
    if ($conn === null) {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($conn->connect_error) {
                throw new Exception("Error de conexión: " . $conn->connect_error);
            }
            $conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            error_log($e->getMessage());
            die("Error de conexión a la base de datos");
        }
    }
    return $conn;
}

// ============ FUNCIONES DE SEGURIDAD ============

function sanitize($input) {
    if (is_array($input)) {
        return array_map('sanitize', $input);
    }
    return htmlspecialchars(strip_tags(trim((string)$input)), ENT_QUOTES, 'UTF-8');
}

function sanitizeSql($input) {
    $conn = conectarDB();
    return $conn->real_escape_string(trim((string)$input));
}

function validarCoordenadas($lat, $lng) {
    return is_numeric($lat) && is_numeric($lng) && 
           $lat >= -90 && $lat <= 90 && 
           $lng >= -180 && $lng <= 180;
}

function generarToken() {
    return bin2hex(random_bytes(32));
}

// ============ FUNCIONES DE AUTENTICACIÓN ============

function usuarioAutenticado() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_rol']);
}

function esAdmin() {
    return isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin';
}

function esTecnico() {
    return isset($_SESSION['user_rol']) && ($_SESSION['user_rol'] === 'admin' || $_SESSION['user_rol'] === 'tecnico');
}

function verificarAcceso() {
    if (!usuarioAutenticado()) {
        header('Location: login.php');
        exit;
    }
}

// ============ FUNCIONES DE LOGS ============

function registrarLog($usuario_id, $accion, $descripcion) {
    $conn = conectarDB();
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $stmt = $conn->prepare("INSERT INTO logs (usuario_id, accion, descripcion, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $usuario_id, $accion, $descripcion, $ip, $user_agent);
    $stmt->execute();
    $stmt->close();
}

function registrarLogAccion($accion, $descripcion) {
    $usuario_id = $_SESSION['user_id'] ?? null;
    registrarLog($usuario_id, $accion, $descripcion);
}

// ============ FUNCIONES DE BASE DE DATOS ============

function ejecutarQuery($sql) {
    $conn = conectarDB();
    $result = $conn->query($sql);
    if ($conn->error) {
        error_log("Error SQL: " . $conn->error . " - SQL: " . $sql);
        return false;
    }
    return $result;
}
?>