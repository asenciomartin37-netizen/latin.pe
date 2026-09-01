<?php
// health.php
header('Content-Type: application/json');

$status = ['status' => 'ok', 'timestamp' => date('Y-m-d H:i:s'), 'app' => APP_NAME];

try {
    require_once 'config.php';
    $conn = conectarDB();
    $conn->query("SELECT 1");
    $status['database'] = 'ok';
} catch (Exception $e) {
    $status['database'] = 'error';
    $status['status'] = 'error';
}

$free_space = disk_free_space('/');
$total_space = disk_total_space('/');
$percentage = ($free_space / $total_space) * 100;
if ($percentage < 10) {
    $status['disk'] = 'warning';
    $status['disk_free'] = round($percentage, 2) . '%';
} else {
    $status['disk'] = 'ok';
}

$status['session'] = session_status() === PHP_SESSION_ACTIVE ? 'ok' : 'warning';
$status['logs_writable'] = is_writable(__DIR__ . '/logs') ? 'ok' : 'error';
$status['version'] = '2.0.0';

echo json_encode($status, JSON_PRETTY_PRINT);
?>