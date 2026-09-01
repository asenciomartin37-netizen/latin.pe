<?php
require_once 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// ============ HELPERS DE RESPUESTA ============
function jsonSuccess($data = []) {
    echo json_encode(array_merge(['success' => true], $data));
}

function jsonError($message) {
    echo json_encode(['error' => $message]);
}

// ============ HELPERS DE DATOS ============
function getPost($key, $default = '') {
    return isset($_POST[$key]) ? sanitize($_POST[$key]) : $default;
}

function getGet($key, $default = '') {
    return isset($_GET[$key]) ? sanitize($_GET[$key]) : $default;
}

function getIntPost($key, $default = 0) {
    return isset($_POST[$key]) ? intval($_POST[$key]) : $default;
}

function getIntGet($key, $default = 0) {
    return isset($_GET[$key]) ? intval($_GET[$key]) : $default;
}

function getFloatPost($key, $default = 0) {
    return isset($_POST[$key]) ? floatval($_POST[$key]) : $default;
}

// ============ HELPERS DE QUERY ============
function fetchAll($sql) {
    $conn = conectarDB();
    $result = $conn->query($sql);
    $rows = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function fetchOne($sql) {
    $conn = conectarDB();
    $result = $conn->query($sql);
    return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
}

function executeQuery($sql) {
    $conn = conectarDB();
    return $conn->query($sql);
}

// ============ ROUTER ============
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get_cajas':        obtenerCajas(); break;
    case 'get_caja':         obtenerCaja(); break;
    case 'guardar_caja':     guardarCaja(); break;
    case 'get_hilos_caja':   obtenerHilosCaja(); break;
    case 'guardar_hilo':     guardarHilo(); break;
    case 'eliminar_hilo':    eliminarHilo(); break;
    case 'get_cables':       obtenerCables(); break;
    case 'guardar_cable':    guardarCable(); break;
    case 'get_clientes':     obtenerClientes(); break;
    case 'get_cliente':      obtenerCliente(); break;
    case 'guardar_cliente':  guardarCliente(); break;
    case 'get_next_cliente_codigo': getNextClienteCodigo(); break;
    case 'buscar_clientes':  buscarClientes(); break;
    case 'get_stats':        obtenerStats(); break;
    default:                 jsonError('Acción no válida');
}

// ============ CAJAS ============
function obtenerCajas() {
    $cajas = fetchAll("SELECT * FROM cajas ORDER BY fecha_creacion DESC");
    echo json_encode($cajas);
}

function obtenerCaja() {
    $id = getIntGet('id');
    $row = fetchOne("SELECT * FROM cajas WHERE id = $id");
    if ($row) {
        $row['google_maps_link'] = $row['google_maps_link'] ?? "https://www.google.com/maps?q={$row['latitud']},{$row['longitud']}";
        echo json_encode($row);
    } else {
        jsonError('Caja no encontrada');
    }
}

function guardarCaja() {
    $nombre       = getPost('nombre');
    $codigo       = getPost('codigo');
    $direccion    = getPost('direccion');
    $latitud      = getFloatPost('latitud');
    $longitud     = getFloatPost('longitud');
    $altitud      = getFloatPost('altitud');
    $link         = getPost('google_maps_link');
    $colorPri     = getPost('color_primario', '#3498db');
    $colorSec     = getPost('color_secundario', '#2ecc71');
    $tipo         = getPost('tipo', 'CTO');
    $capacidad    = getIntPost('capacidad');

    if (empty($nombre) || $latitud == 0 || $longitud == 0) {
        jsonError('Nombre, latitud y longitud son requeridos');
        return;
    }

    $conn = conectarDB();
    $sql = "INSERT INTO cajas (nombre, codigo, direccion, latitud, longitud, altitud, google_maps_link, color_primario, color_secundario, tipo, capacities) 
            VALUES ('$nombre', '$codigo', '$direccion', $latitud, $longitud, $altitud, '$link', '$colorPri', '$colorSec', '$tipo', $capacidad)";

    if ($conn->query($sql)) {
        jsonSuccess(['id' => $conn->insert_id, 'message' => 'Caja guardada correctamente']);
    } else {
        jsonError('Error al guardar la caja: ' . $conn->error);
    }
}

// ============ HILOS ============
function obtenerHilosCaja() {
    $caja_id = getIntGet('caja_id');
    $hilos = fetchAll("SELECT * FROM hilos_fusionados WHERE caja_id = $caja_id ORDER BY FIELD(tipo, 'primario', 'secundario', 'terciario', 'distribucion'), nombre");
    echo json_encode($hilos);
}

function guardarHilo() {
    $caja_id    = getIntPost('caja_id');
    $nombre     = getPost('nombre');
    $color      = getPost('color', '#e74c3c');
    $tipo       = getPost('tipo', 'secundario');
    $capacidad  = getIntPost('capacidad', 12);
    $observ     = getPost('observaciones');

    if ($caja_id == 0 || empty($nombre)) {
        jsonError('Caja y nombre son requeridos');
        return;
    }

    $sql = "INSERT INTO hilos_fusionados (caja_id, nombre, color, tipo, capacidad, observaciones) 
            VALUES ($caja_id, '$nombre', '$color', '$tipo', $capacidad, '$observ')";

    if (executeQuery($sql)) {
        $conn = conectarDB();
        jsonSuccess(['id' => $conn->insert_id, 'message' => 'Hilo guardado correctamente']);
    } else {
        jsonError('Error al guardar el hilo');
    }
}

function eliminarHilo() {
    $id = getIntGet('id');
    if (executeQuery("DELETE FROM hilos_fusionados WHERE id = $id")) {
        jsonSuccess(['message' => 'Hilo eliminado correctamente']);
    } else {
        jsonError('Error al eliminar el hilo');
    }
}

// ============ CABLES ============
function obtenerCables() {
    $cables = fetchAll("SELECT c.*, 
            co.latitud as lat_origen, co.longitud as lng_origen,
            cd.latitud as lat_destino, cd.longitud as lng_destino
            FROM cables c
            LEFT JOIN cajas co ON c.origen_id = co.id
            LEFT JOIN cajas cd ON c.destino_id = cd.id
            ORDER BY c.fecha_creacion DESC");
    echo json_encode($cables);
}

function guardarCable() {
    $nombre     = getPost('nombre');
    $codigo     = getPost('codigo');
    $origen_id  = getIntPost('origen_id');
    $destino_id = getIntPost('destino_id');
    $puntos     = getPost('puntos_intermedios', '[]');
    $tipo       = getPost('tipo', 'Fibra Óptica');
    $longitud   = getFloatPost('longitud');
    $color      = getPost('color', '#e74c3c');

    if ($origen_id == 0 || $destino_id == 0) {
        jsonError('Origen y destino son requeridos');
        return;
    }

    $sql = "INSERT INTO cables (nombre, codigo, origen_id, destino_id, puntos_intermedios, tipo, longitud, color) 
            VALUES ('$nombre', '$codigo', $origen_id, $destino_id, '$puntos', '$tipo', $longitud, '$color')";

    if (executeQuery($sql)) {
        $conn = conectarDB();
        jsonSuccess(['id' => $conn->insert_id, 'message' => 'Cable guardado correctamente']);
    } else {
        jsonError('Error al guardar el cable');
    }
}

// ============ CLIENTES ============
function obtenerClientes() {
    $clientes = fetchAll("SELECT c.*, ca.nombre as caja_nombre, cb.nombre as cable_nombre, cb.color as cable_color
            FROM clientes c 
            LEFT JOIN cajas ca ON c.caja_id = ca.id 
            LEFT JOIN cables cb ON c.cable_id = cb.id
            ORDER BY c.fecha_creacion DESC");
    echo json_encode($clientes);
}

function obtenerCliente() {
    $id = getIntGet('id');
    $row = fetchOne("SELECT * FROM clientes WHERE id = $id");
    if ($row) {
        $row['google_maps_link'] = $row['google_maps_link'] ?? "https://www.google.com/maps?q={$row['latitud']},{$row['longitud']}";
        echo json_encode($row);
    } else {
        jsonError('Cliente no encontrado');
    }
}

function guardarCliente() {
    $codigo_cliente = getPost('codigo_cliente');
    $nombre         = getPost('nombre');
    $documento      = getPost('documento');
    $direccion      = getPost('direccion');
    $telefono       = getPost('telefono');
    $email          = getPost('email');
    $latitud        = getFloatPost('latitud');
    $longitud       = getFloatPost('longitud');
    $altitud        = getFloatPost('altitud');
    $link           = getPost('google_maps_link');
    $caja_id        = isset($_POST['caja_id']) && $_POST['caja_id'] != '' ? intval($_POST['caja_id']) : 'NULL';
    $cable_id       = isset($_POST['cable_id']) && $_POST['cable_id'] != '' ? intval($_POST['cable_id']) : 'NULL';
    $velocidad      = getPost('velocidad', '100Mbps');
    $fecha_inst     = $_POST['fecha_instalacion'] ?? date('Y-m-d');
    $fecha_reg      = date('Y-m-d');

    if (empty($codigo_cliente) || empty($nombre) || $latitud == 0 || $longitud == 0) {
        jsonError('Código, nombre, latitud y longitud son requeridos');
        return;
    }

    $conn = conectarDB();
    $check = $conn->query("SELECT id FROM clientes WHERE codigo_cliente = '$codigo_cliente'");
    if ($check->num_rows > 0) {
        jsonError('El código de cliente ya existe. Por favor use otro.');
        return;
    }

    $sql = "INSERT INTO clientes (codigo_cliente, nombre, documento, direccion, telefono, email, latitud, longitud, altitud, google_maps_link, caja_id, cable_id, velocidad, fecha_instalacion, fecha_registro, estado) 
            VALUES ('$codigo_cliente', '$nombre', '$documento', '$direccion', '$telefono', '$email', $latitud, $longitud, $altitud, '$link', $caja_id, $cable_id, '$velocidad', '$fecha_inst', '$fecha_reg', 'activo')";

    if ($conn->query($sql)) {
        if ($caja_id != 'NULL') {
            $conn->query("UPDATE cajas SET ocupados = ocupados + 1 WHERE id = $caja_id");
        }
        jsonSuccess(['id' => $conn->insert_id, 'message' => 'Cliente guardado correctamente']);
    } else {
        jsonError('Error al guardar el cliente: ' . $conn->error);
    }
}

function getNextClienteCodigo() {
    $row = fetchOne("SELECT MAX(CAST(SUBSTRING(codigo_cliente, 5) AS UNSIGNED)) as max_codigo FROM clientes WHERE codigo_cliente LIKE 'CLI-%'");
    $next = ($row['max_codigo'] ?? 0) + 1;
    echo json_encode(['codigo' => 'CLI-' . str_pad($next, 4, '0', STR_PAD_LEFT)]);
}

function buscarClientes() {
    $q = getGet('q');
    $conn = conectarDB();
    $qEsc = $conn->real_escape_string($q);
    $clientes = fetchAll("SELECT * FROM clientes 
            WHERE codigo_cliente LIKE '%$qEsc%' 
            OR nombre LIKE '%$qEsc%' 
            OR documento LIKE '%$qEsc%'
            OR telefono LIKE '%$qEsc%'
            ORDER BY fecha_creacion DESC");
    echo json_encode($clientes);
}

// ============ ESTADÍSTICAS ============
function obtenerStats() {
    $total = function ($table, $where = '') {
        $sql = "SELECT COUNT(*) as total FROM $table" . ($where ? " WHERE $where" : '');
        $row = fetchOne($sql);
        return $row['total'] ?? 0;
    };

    echo json_encode([
        'total_cajas'     => $total('cajas'),
        'total_clientes'  => $total('clientes'),
        'total_cables'    => $total('cables'),
        'clientes_activos' => $total('clientes', "estado = 'activo'"),
        'total_hilos'     => $total('hilos_fusionados')
    ]);
}
