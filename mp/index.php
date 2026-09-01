<?php
require_once 'config.php';
verificarAcceso();

registrarLogAccion('view', 'Visualización del panel principal');

$conn = conectarDB();
$result = $conn->query("SELECT COUNT(*) as total FROM cajas");
$totalCajas = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM clientes");
$totalClientes = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM cables");
$totalCables = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM hilos_fusionados");
$totalHilos = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT tipo, COUNT(*) as total FROM cajas GROUP BY tipo");
$tiposCajas = [];
while ($row = $result->fetch_assoc()) {
    $tiposCajas[$row['tipo']] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        /* ===== TODOS LOS ESTILOS DEL index.php ANTERIOR ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; }
        
        #header {
            background: linear-gradient(135deg, #1a2a3a, #2c3e50);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            z-index: 1000;
            flex-wrap: wrap;
            gap: 8px;
        }
        #header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 13px;
        }
        #header .user-info .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            color: white;
        }
        #header .user-info .user-name {
            color: #ecf0f1;
        }
        #header .user-info .user-rol {
            background: rgba(255,255,255,0.15);
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
        }
        #header .user-info .btn-logout {
            background: rgba(231,76,60,0.2);
            color: #e74c3c;
            border: 1px solid rgba(231,76,60,0.3);
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s;
        }
        #header .user-info .btn-logout:hover {
            background: rgba(231,76,60,0.4);
        }
        #header h1 { font-size: 18px; display: flex; align-items: center; gap: 8px; }
        #header h1 small { font-size: 12px; font-weight: normal; color: #8ea7c2; }
        
        .menu { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
        .menu button {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .menu button:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }
        .menu button.active { background: #3498db; border-color: #3498db; }
        
        #map-container { display: flex; height: calc(100vh - 60px); }
        #map { flex: 1; height: 100%; }
        
        #sidebar {
            width: 420px;
            background: white;
            padding: 12px;
            overflow-y: auto;
            border-left: 2px solid #e0e0e0;
        }
        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid #3498db;
        }
        .sidebar-header h3 { color: #2c3e50; font-size: 15px; }
        .sidebar-header .badge-count {
            background: #3498db;
            color: white;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
        }
        
        .search-box { margin-bottom: 10px; }
        .search-box input {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 13px;
        }
        .search-box input:focus { outline: none; border-color: #3498db; }
        
        .quick-add-panel {
            background: #f0f7ff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #d4e6ff;
        }
        .quick-add-panel h4 { font-size: 12px; color: #2c3e50; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
        .quick-add-buttons { display: flex; gap: 5px; flex-wrap: wrap; }
        .quick-add-buttons button {
            padding: 5px 12px;
            border: 2px solid #ddd;
            border-radius: 4px;
            background: white;
            cursor: pointer;
            font-size: 11px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .quick-add-buttons button:hover { border-color: #3498db; background: #f0f8ff; transform: scale(1.05); }
        .quick-add-buttons button .icon-mufa { color: #e74c3c; }
        .quick-add-buttons button .icon-caja { color: #3498db; }
        .quick-add-buttons button .icon-nap { color: #2ecc71; }
        .quick-add-buttons button .icon-cliente { color: #9b59b6; }
        
        .draw-panel {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #e0e0e0;
        }
        .draw-panel h4 { font-size: 12px; color: #2c3e50; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
        .draw-tools { display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 6px; }
        .draw-tools button {
            padding: 4px 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            background: white;
            cursor: pointer;
            font-size: 11px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .draw-tools button:hover { border-color: #3498db; background: #f0f8ff; }
        .draw-tools button.active { border-color: #3498db; background: #3498db; color: white; }
        
        .color-picker-container {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin: 5px 0;
            padding: 6px;
            background: white;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }
        .color-picker-container label { font-size: 11px; font-weight: 600; color: #2c3e50; }
        .color-options { display: flex; gap: 4px; flex-wrap: wrap; }
        .color-option {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 3px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }
        .color-option:hover { transform: scale(1.15); }
        .color-option.active { border-color: #2c3e50; box-shadow: 0 0 8px rgba(0,0,0,0.3); }
        .color-option .check {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 10px;
            display: none;
        }
        .color-option.active .check { display: block; }
        
        .line-style-options { display: flex; gap: 5px; margin: 4px 0; }
        .line-style-options button {
            padding: 3px 8px;
            border: 2px solid #ddd;
            border-radius: 3px;
            background: white;
            cursor: pointer;
            font-size: 10px;
            transition: all 0.3s;
        }
        .line-style-options button:hover { border-color: #3498db; }
        .line-style-options button.active { border-color: #3498db; background: #3498db; color: white; }
        
        .cable-preview {
            background: #e8f0fe;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            color: #1a3a5c;
            margin: 4px 0;
        }
        
        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #2c3e50;
            margin: 12px 0 8px 0;
            padding-bottom: 4px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-title .count {
            background: #e0e0e0;
            padding: 1px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
            color: #666;
        }
        
        .info-card {
            background: white;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 6px;
            border: 1px solid #e8e8e8;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }
        .info-card:hover { transform: translateX(4px); box-shadow: 0 2px 12px rgba(0,0,0,0.1); border-color: #3498db; }
        .info-card .card-title { font-weight: 600; color: #2c3e50; font-size: 14px; }
        .info-card .card-title .cliente-code {
            background: #f0f0f0;
            padding: 0 8px;
            border-radius: 3px;
            font-size: 11px;
            color: #666;
            margin-left: 6px;
            font-weight: normal;
        }
        .info-card .card-subtitle { color: #888; font-size: 12px; margin-top: 2px; }
        .info-card .card-coords {
            font-size: 10px;
            color: #999;
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .info-card .card-tags { display: flex; gap: 4px; margin-top: 4px; flex-wrap: wrap; }
        .info-card .card-actions { margin-top: 6px; display: flex; gap: 4px; flex-wrap: wrap; }
        .info-card .card-actions button {
            padding: 3px 10px;
            border: none;
            border-radius: 4px;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .info-card .card-actions .btn-zoom { background: #3498db; color: white; }
        .info-card .card-actions .btn-zoom:hover { background: #2980b9; }
        .info-card .card-actions .btn-maps { background: #34a853; color: white; }
        .info-card .card-actions .btn-maps:hover { background: #2d9249; }
        .info-card .card-actions .btn-copy { background: #4285f4; color: white; }
        .info-card .card-actions .btn-copy:hover { background: #3367d6; }
        .info-card .card-actions .btn-hilos { background: #9b59b6; color: white; }
        .info-card .card-actions .btn-hilos:hover { background: #8e44ad; }
        
        .badge {
            display: inline-block;
            padding: 1px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
        }
        .badge-pop { background: #e74c3c; color: white; }
        .badge-cto { background: #3498db; color: white; }
        .badge-splitter { background: #1abc9c; color: white; }
        .badge-caja_distribucion { background: #9b59b6; color: white; }
        .badge-mufaprimaria { background: #e74c3c; color: white; }
        .badge-mufasecundaria { background: #f39c12; color: white; }
        .badge-mufaterciaria { background: #2ecc71; color: white; }
        .badge-nap { background: #2ecc71; color: white; }
        .badge-nodo { background: #e67e22; color: white; }
        .badge-registro { background: #95a5a6; color: white; }
        .badge-camara { background: #2c3e50; color: white; }
        .badge-activo { background: #27ae60; color: white; }
        .badge-inactivo { background: #e74c3c; color: white; }
        .badge-pendiente { background: #f39c12; color: white; }
        .badge-mantenimiento { background: #f39c12; color: white; }
        .badge-planificado { background: #95a5a6; color: white; }
        .badge-primario { background: #e74c3c; color: white; }
        .badge-secundario { background: #f39c12; color: white; }
        .badge-terciario { background: #2ecc71; color: white; }
        .badge-distribucion { background: #9b59b6; color: white; }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            backdrop-filter: blur(4px);
        }
        .modal-content {
            background: white;
            width: 95%;
            max-width: 540px;
            margin: 25px auto;
            padding: 25px;
            border-radius: 10px;
            max-height: 85vh;
            overflow-y: auto;
        }
        .modal-content h2 {
            color: #2c3e50;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
            font-size: 18px;
        }
        .form-group { margin-bottom: 12px; }
        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 12px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 8px 10px;
            border: 2px solid #e0e0e0;
            border-radius: 4px;
            font-size: 13px;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
        }
        .form-group textarea { min-height: 50px; resize: vertical; }
        .form-group small { color: #666; font-size: 11px; display: block; margin-top: 2px; }
        
        .ubicacion-box {
            background: #f0f7ff;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #d4e6ff;
            margin-bottom: 12px;
        }
        .ubicacion-box label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 12px;
            display: block;
            margin-bottom: 4px;
        }
        .ubicacion-box .input-group { display: flex; gap: 6px; }
        .ubicacion-box .input-group input { flex: 1; }
        .ubicacion-box .input-group button {
            padding: 8px 15px;
            background: #34a853;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            white-space: nowrap;
        }
        .ubicacion-box .input-group button:hover { background: #2d9249; }
        .ubicacion-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 8px; }
        .ubicacion-grid .form-group { margin-bottom: 0; }
        .ubicacion-actions { display: flex; gap: 4px; flex-wrap: wrap; margin-top: 6px; }
        .ubicacion-actions button { padding: 4px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 11px; }
        .ubicacion-actions .btn-gps { background: #4285f4; color: white; }
        .ubicacion-actions .btn-gps:hover { background: #3367d6; }
        .ubicacion-actions .btn-clear { background: #e74c3c; color: white; }
        .ubicacion-actions .btn-clear:hover { background: #c0392b; }
        
        .btn {
            padding: 8px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 13px;
        }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-success { background: #27ae60; color: white; }
        .btn-success:hover { background: #229954; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-danger:hover { background: #c0392b; }
        .btn-close {
            float: right;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }
        .btn-close:hover { color: #333; }
        
        .leyenda {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }
        .leyenda h4 { margin-bottom: 6px; color: #2c3e50; font-size: 12px; }
        .leyenda-item { display: flex; align-items: center; gap: 6px; margin: 2px 0; font-size: 11px; }
        .leyenda-icon {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2px solid white;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 6px;
            font-weight: bold;
        }
        .color-box { width: 16px; height: 3px; border-radius: 2px; flex-shrink: 0; }
        .color-circle { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; border: 1px solid rgba(0,0,0,0.1); }
        
        .loading { text-align: center; padding: 20px; color: #666; }
        .location-pulse { animation: pulse 1.5s ease-in-out 3; }
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(2); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .selected-point-marker {
            background: #e74c3c;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 20px rgba(231,76,60,0.8);
            animation: pulse-marker 1.5s ease-in-out infinite;
        }
        @keyframes pulse-marker {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            margin-bottom: 10px;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 6px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }
        .stat-card .number { font-size: 20px; font-weight: 700; color: #2c3e50; }
        .stat-card .label { font-size: 10px; color: #666; }
        .stat-card.pop { border-top: 3px solid #e74c3c; }
        .stat-card.clientes { border-top: 3px solid #27ae60; }
        .stat-card.cables { border-top: 3px solid #3498db; }
        .stat-card.activos { border-top: 3px solid #f39c12; }
        
        .highlight {
            background: #f1c40f;
            padding: 0 2px;
            border-radius: 2px;
            font-weight: bold;
        }
        
        .hilo-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 6px;
            border-left: 4px solid var(--hilo-color, #e74c3c);
            transition: all 0.3s;
        }
        .hilo-item:hover { transform: translateX(4px); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .hilo-color-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
            flex-shrink: 0;
        }
        .hilo-info { flex: 1; }
        .hilo-info .nombre { font-weight: 600; color: #2c3e50; }
        .hilo-info .detalles { font-size: 11px; color: #666; }
        .hilo-info .detalles span { margin-left: 10px; }
        .btn-eliminar-hilo {
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 4px 10px;
            cursor: pointer;
            font-size: 11px;
            transition: all 0.3s;
        }
        .btn-eliminar-hilo:hover { background: #c0392b; }
        
        @media (max-width: 768px) {
            #sidebar { width: 100%; height: 250px; border-left: none; border-top: 2px solid #e0e0e0; }
            #map-container { flex-direction: column-reverse; }
            #header { flex-direction: column; gap: 6px; }
            .menu { justify-content: center; }
            .modal-content { margin: 15px auto; padding: 20px; max-width: 95%; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .ubicacion-grid { grid-template-columns: 1fr; }
            .user-info { flex-wrap: wrap; justify-content: center; }
        }
    </style>
</head>
<body>
    <div id="header">
        <h1>
            <i class="fas fa-network-wired"></i> <?php echo APP_NAME; ?>
            <small>OZmap Clone</small>
        </h1>
        <div class="user-info">
            <div class="user-avatar">
                <?php echo strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)); ?>
            </div>
            <span class="user-name"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?></span>
            <span class="user-rol"><?php echo htmlspecialchars($_SESSION['user_rol'] ?? 'tecnico'); ?></span>
            <button class="btn-logout" onclick="window.location.href='logout.php'">
                <i class="fas fa-sign-out-alt"></i> Salir
            </button>
        </div>
        <div class="menu">
            <button onclick="toggleDraw('polyline')" id="btnDrawLine">
                <i class="fas fa-pen"></i> Dibujar
            </button>
            <button onclick="cargarDatos()">
                <i class="fas fa-sync"></i> Actualizar
            </button>
            <?php if (esAdmin()): ?>
                <button onclick="window.location.href='admin.php'" style="background:#e74c3c;border-color:#e74c3c;">
                    <i class="fas fa-cog"></i> Admin
                </button>
            <?php endif; ?>
            <button onclick="abrirModal('modalCaja')" class="active">
                <i class="fas fa-box"></i> + Caja
            </button>
            <button onclick="abrirModal('modalCable')">
                <i class="fas fa-plug"></i> + Cable
            </button>
            <button onclick="abrirModal('modalCliente')">
                <i class="fas fa-user"></i> + Cliente
            </button>
        </div>
    </div>
    
    <div id="map-container">
        <div id="map"></div>
        <div id="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-list"></i> Panel de Control</h3>
                <span class="badge-count" id="totalItems">0 elementos</span>
            </div>
            
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="🔍 Buscar cajas, clientes o códigos...">
            </div>
            
            <div class="stats-grid">
                <div class="stat-card pop">
                    <div class="number"><?php echo $totalCajas; ?></div>
                    <div class="label"><i class="fas fa-box"></i> Cajas</div>
                </div>
                <div class="stat-card clientes">
                    <div class="number"><?php echo $totalClientes; ?></div>
                    <div class="label"><i class="fas fa-users"></i> Clientes</div>
                </div>
                <div class="stat-card cables">
                    <div class="number"><?php echo $totalCables; ?></div>
                    <div class="label"><i class="fas fa-plug"></i> Cables</div>
                </div>
                <div class="stat-card activos">
                    <div class="number"><?php echo $totalHilos; ?></div>
                    <div class="label"><i class="fas fa-palette"></i> Hilos</div>
                </div>
            </div>
            
            <div class="quick-add-panel">
                <h4><i class="fas fa-plus-circle"></i> Agregar desde el mapa</h4>
                <div class="quick-add-buttons">
                    <button onclick="activarAgregar('MUFAPRIMARIA')">
                        <span class="icon-mufa">●</span> Mufa
                    </button>
                    <button onclick="activarAgregar('CTO')">
                        <span class="icon-caja">■</span> Caja
                    </button>
                    <button onclick="activarAgregar('NAP')">
                        <span class="icon-nap">▲</span> NAP
                    </button>
                    <button onclick="activarAgregar('CLIENTE')">
                        <span class="icon-cliente">●</span> Cliente
                    </button>
                    <button onclick="desactivarAgregar()" style="border-color:#e74c3c;color:#e74c3c;">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
                <div id="quickAddStatus" style="margin-top:5px;font-size:11px;color:#666;">
                    <i class="fas fa-info-circle"></i> Haz clic en el mapa para agregar un elemento
                </div>
            </div>
            
            <div class="draw-panel">
                <h4><i class="fas fa-paint-brush"></i> Herramientas de Dibujo</h4>
                
                <div class="draw-tools">
                    <button onclick="toggleDraw('polyline')" id="drawLineBtn" class="active">
                        <i class="fas fa-draw-polygon"></i> Trazar
                    </button>
                    <button onclick="limpiarDibujo()">
                        <i class="fas fa-trash"></i> Limpiar
                    </button>
                    <button onclick="guardarDibujo()" style="background:#27ae60;color:white;border-color:#27ae60;">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
                
                <div class="color-picker-container">
                    <label><i class="fas fa-palette"></i> Color:</label>
                    <div class="color-options" id="colorOptions">
                        <div class="color-option active" style="background:#e74c3c;" data-color="#e74c3c" onclick="seleccionarColor(this, '#e74c3c')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="color-option" style="background:#3498db;" data-color="#3498db" onclick="seleccionarColor(this, '#3498db')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="color-option" style="background:#2ecc71;" data-color="#2ecc71" onclick="seleccionarColor(this, '#2ecc71')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="color-option" style="background:#f39c12;" data-color="#f39c12" onclick="seleccionarColor(this, '#f39c12')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="color-option" style="background:#9b59b6;" data-color="#9b59b6" onclick="seleccionarColor(this, '#9b59b6')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="color-option" style="background:#1abc9c;" data-color="#1abc9c" onclick="seleccionarColor(this, '#1abc9c')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="color-option" style="background:#e67e22;" data-color="#e67e22" onclick="seleccionarColor(this, '#e67e22')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="color-option" style="background:#2c3e50;" data-color="#2c3e50" onclick="seleccionarColor(this, '#2c3e50')">
                            <span class="check"><i class="fas fa-check"></i></span>
                        </div>
                    </div>
                </div>
                
                <div class="line-style-options">
                    <button onclick="seleccionarEstilo('solid')" id="styleSolid" class="active">
                        <i class="fas fa-minus"></i> Sólido
                    </button>
                    <button onclick="seleccionarEstilo('dashed')" id="styleDashed">
                        <i class="fas fa-minus"></i> Discontinuo
                    </button>
                    <button onclick="seleccionarEstilo('dotted')" id="styleDotted">
                        <i class="fas fa-minus"></i> Puntos
                    </button>
                </div>
                
                <div class="cable-preview" id="cablePreview">
                    <i class="fas fa-info-circle"></i> Haz clic en el mapa para trazar
                </div>
            </div>
            
            <div id="infoContent">
                <div class="loading">Cargando datos...</div>
            </div>
            
            <div class="leyenda">
                <h4><i class="fas fa-tag"></i> Leyenda de Elementos</h4>
                <div style="margin-bottom:4px;font-weight:600;font-size:11px;color:#2c3e50;">
                    <i class="fas fa-box"></i> MUFAS
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#e74c3c;width:16px;height:16px;font-size:7px;">MP</div>
                    <span>Mufa Primaria</span>
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#f39c12;width:14px;height:14px;font-size:6px;">MS</div>
                    <span>Mufa Secundaria</span>
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#2ecc71;width:12px;height:12px;font-size:6px;">MT</div>
                    <span>Mufa Terciaria</span>
                </div>
                <div style="margin:4px 0;font-weight:600;font-size:11px;color:#2c3e50;">
                    <i class="fas fa-box"></i> CAJAS
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#3498db;border-radius:3px;width:12px;height:12px;font-size:6px;">C</div>
                    <span>CTO</span>
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#9b59b6;border-radius:3px;width:12px;height:12px;font-size:6px;">D</div>
                    <span>Caja Distribución</span>
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#1abc9c;width:10px;height:10px;font-size:5px;">SP</div>
                    <span>Splitter</span>
                </div>
                <div style="margin:4px 0;font-weight:600;font-size:11px;color:#2c3e50;">
                    <i class="fas fa-wifi"></i> NAP
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#2ecc71;width:12px;height:12px;border-radius:3px;font-size:6px;">N</div>
                    <span>NAP</span>
                </div>
                <div style="margin:4px 0;font-weight:600;font-size:11px;color:#2c3e50;">
                    <i class="fas fa-satellite-dish"></i> OTROS
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#e67e22;width:14px;height:14px;font-size:7px;">N</div>
                    <span>Nodo</span>
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#95a5a6;border-radius:2px;width:10px;height:10px;font-size:5px;">R</div>
                    <span>Registro</span>
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#2c3e50;width:12px;height:12px;font-size:6px;">C</div>
                    <span>Cámara</span>
                </div>
                <div class="leyenda-item">
                    <div class="leyenda-icon" style="background:#e74c3c;width:14px;height:14px;font-size:7px;">P</div>
                    <span>POP</span>
                </div>
                <div style="margin:4px 0;font-weight:600;font-size:11px;color:#2c3e50;">
                    <i class="fas fa-palette"></i> HILOS FUSIONADOS
                </div>
                <div class="leyenda-item"><div class="color-box" style="background:#e74c3c;height:4px;"></div><span>Primario</span></div>
                <div class="leyenda-item"><div class="color-box" style="background:#f39c12;height:4px;"></div><span>Secundario</span></div>
                <div class="leyenda-item"><div class="color-box" style="background:#2ecc71;height:4px;"></div><span>Terciario</span></div>
                <div class="leyenda-item"><div class="color-box" style="background:#9b59b6;height:4px;"></div><span>Distribución</span></div>
                <div style="margin:4px 0;font-weight:600;font-size:11px;color:#2c3e50;">
                    <i class="fas fa-user"></i> CLIENTES
                </div>
                <div class="leyenda-item"><div class="color-circle" style="background:#27ae60;width:10px;height:10px;"></div><span>Cliente Activo</span></div>
                <div class="leyenda-item"><div class="color-circle" style="background:#e74c3c;width:10px;height:10px;"></div><span>Cliente Inactivo</span></div>
                <div class="leyenda-item"><div class="color-circle" style="background:#f39c12;width:10px;height:10px;"></div><span>Cliente Pendiente</span></div>
                <div style="margin:4px 0;font-weight:600;font-size:11px;color:#2c3e50;">
                    <i class="fas fa-plug"></i> CABLES
                </div>
                <div class="leyenda-item"><div class="color-box" style="background:#e74c3c;height:3px;"></div><span>Cable Principal</span></div>
                <div class="leyenda-item"><div class="color-box" style="background:#f39c12;height:3px;"></div><span>Cable Secundario</span></div>
                <div class="leyenda-item"><div class="color-box" style="background:#3498db;height:3px;"></div><span>Cable Distribución</span></div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Hilo -->
    <div id="modalCaja" class="modal">
        <div class="modal-content">
            <button class="btn-close" onclick="cerrarModal('modalCaja')">&times;</button>
            <h2><i class="fas fa-box"></i> Nueva Caja / Mufa / NAP</h2>
            <form id="formCaja" onsubmit="guardarCaja(event)">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" id="cajaNombre" required placeholder="Ej: Mufa Principal 1">
                </div>
                <div class="form-group">
                    <label>Código</label>
                    <input type="text" id="cajaCodigo" placeholder="Ej: MP-001">
                </div>
                <div class="form-group">
                    <label>Tipo de Elemento *</label>
                    <select id="cajaTipo" required>
                        <optgroup label="📦 MUFAS">
                            <option value="MUFAPRIMARIA">🔴 Mufa Primaria (MP)</option>
                            <option value="MUFASECUNDARIA">🟠 Mufa Secundaria (MS)</option>
                            <option value="MUFATERCIARIA">🟢 Mufa Terciaria (MT)</option>
                        </optgroup>
                        <optgroup label="📦 CAJAS">
                            <option value="CTO">🔵 CTO (Caja Terminal)</option>
                            <option value="CAJA_DISTRIBUCION">🟣 Caja Distribución</option>
                            <option value="SPLITTER">🩵 Splitter</option>
                        </optgroup>
                        <optgroup label="📡 NAP">
                            <option value="NAP">🟢 NAP (Punto de Acceso)</option>
                        </optgroup>
                        <optgroup label="📡 OTROS">
                            <option value="NODO">🟠 Nodo</option>
                            <option value="REGISTRO">⚪ Registro</option>
                            <option value="CAMARA">⚫ Cámara</option>
                            <option value="POP">🔴 POP</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" id="cajaDireccion" placeholder="Ej: Rua Idalina Pereira dos Santos">
                </div>
                
                <div class="ubicacion-box">
                    <label><i class="fas fa-map-marked-alt"></i> Ubicación Exacta</label>
                    <div class="form-group" style="margin-bottom:8px;">
                        <label>Pegar link de Google Maps</label>
                        <div class="input-group">
                            <input type="text" id="cajaGoogleMapsLink" placeholder="https://www.google.com/maps?q=-27.5925,-48.5459">
                            <button type="button" onclick="extraerCoordenadasDesdeLinkCaja()">
                                <i class="fas fa-arrow-right"></i> Extraer
                            </button>
                        </div>
                        <small>Pega el link exacto de Google Maps y haz clic en "Extraer"</small>
                    </div>
                    <div class="ubicacion-grid">
                        <div class="form-group">
                            <label>Latitud *</label>
                            <input type="number" step="0.000000001" id="cajaLat" required>
                        </div>
                        <div class="form-group">
                            <label>Longitud *</label>
                            <input type="number" step="0.000000001" id="cajaLng" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Altitud (metros)</label>
                        <input type="number" step="0.01" id="cajaAltitud" placeholder="0.00">
                    </div>
                    <div class="ubicacion-actions">
                        <button type="button" class="btn-gps" onclick="obtenerUbicacionActualCaja()">
                            <i class="fas fa-crosshairs"></i> Mi ubicación
                        </button>
                        <button type="button" class="btn-clear" onclick="limpiarCoordenadasCaja()">
                            <i class="fas fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Color Primario del Hilo</label>
                    <input type="color" id="cajaColorPrimario" value="#3498db">
                    <small>Color principal para identificar la mufa</small>
                </div>
                <div class="form-group">
                    <label>Color Secundario del Hilo</label>
                    <input type="color" id="cajaColorSecundario" value="#2ecc71">
                    <small>Color secundario para identificar la mufa</small>
                </div>
                <div class="form-group">
                    <label>Capacidad</label>
                    <input type="number" id="cajaCapacidad" value="24">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
            </form>
        </div>
    </div>

    <!-- Modal Cable -->
    <div id="modalCable" class="modal">
        <div class="modal-content">
            <button class="btn-close" onclick="cerrarModal('modalCable')">&times;</button>
            <h2><i class="fas fa-plug"></i> Nuevo Cable</h2>
            <form id="formCable" onsubmit="guardarCable(event)">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" id="cableNombre" required placeholder="Ej: Cable Principal 1">
                </div>
                <div class="form-group">
                    <label>Código</label>
                    <input type="text" id="cableCodigo" placeholder="Ej: CAB-001">
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="color" id="cableColor" value="#e74c3c">
                </div>
                <div class="form-group">
                    <label>Origen *</label>
                    <select id="cableOrigen" required></select>
                </div>
                <div class="form-group">
                    <label>Destino *</label>
                    <select id="cableDestino" required></select>
                </div>
                <div class="form-group">
                    <label>Puntos Intermedios</label>
                    <textarea id="cablePuntos" placeholder="[[lat1,lng1],[lat2,lng2]]"></textarea>
                    <small>Coordenadas de los puntos intermedios en formato JSON</small>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select id="cableTipo">
                        <option value="Fibra Óptica">Fibra Óptica</option>
                        <option value="Cobre">Cobre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Longitud (metros)</label>
                    <input type="number" step="0.01" id="cableLongitud" placeholder="0.00">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cable</button>
            </form>
        </div>
    </div>

    <!-- Modal Cliente -->
    <div id="modalCliente" class="modal">
        <div class="modal-content">
            <button class="btn-close" onclick="cerrarModal('modalCliente')">&times;</button>
            <h2><i class="fas fa-user"></i> Nuevo Cliente</h2>
            <form id="formCliente" onsubmit="guardarCliente(event)">
                <div class="form-group">
                    <label>Código del Cliente *</label>
                    <input type="text" id="clienteCodigo" required placeholder="Ej: CLI-0001">
                    <small>Código único para identificar al cliente en el sistema</small>
                </div>
                <div class="form-group">
                    <label>Nombre / Razón Social *</label>
                    <input type="text" id="clienteNombre" required placeholder="Ej: Juan Pérez">
                </div>
                <div class="form-group">
                    <label>Documento (DNI/RUC)</label>
                    <input type="text" id="clienteDocumento" placeholder="Ej: 12345678 o 20512345678">
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" id="clienteDireccion" placeholder="Ej: Rua Idalina Pereira dos Santos 10">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" id="clienteTelefono" placeholder="Ej: (48) 99999-1111">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="clienteEmail" placeholder="Ej: cliente@email.com">
                </div>
                
                <div class="ubicacion-box">
                    <label><i class="fas fa-map-marked-alt"></i> Ubicación Exacta</label>
                    <div class="form-group" style="margin-bottom:8px;">
                        <label>Pegar link de Google Maps</label>
                        <div class="input-group">
                            <input type="text" id="clienteGoogleMapsLink" placeholder="https://www.google.com/maps?q=-27.5925,-48.5459">
                            <button type="button" onclick="extraerCoordenadasDesdeLink()">
                                <i class="fas fa-arrow-right"></i> Extraer
                            </button>
                        </div>
                        <small>Pega el link exacto de Google Maps y haz clic en "Extraer"</small>
                    </div>
                    <div class="ubicacion-grid">
                        <div class="form-group">
                            <label>Latitud *</label>
                            <input type="number" step="0.000000001" id="clienteLat" required>
                        </div>
                        <div class="form-group">
                            <label>Longitud *</label>
                            <input type="number" step="0.000000001" id="clienteLng" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Altitud (metros)</label>
                        <input type="number" step="0.01" id="clienteAltitud" placeholder="0.00">
                    </div>
                    <div class="ubicacion-actions">
                        <button type="button" class="btn-gps" onclick="obtenerUbicacionActual()">
                            <i class="fas fa-crosshairs"></i> Mi ubicación
                        </button>
                        <button type="button" class="btn-clear" onclick="limpiarCoordenadas()">
                            <i class="fas fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Caja Asignada</label>
                    <select id="clienteCaja">
                        <option value="">Sin caja</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Cable Asignado</label>
                    <select id="clienteCable">
                        <option value="">Sin cable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Velocidad</label>
                    <select id="clienteVelocidad">
                        <option value="100Mbps">100 Mbps</option>
                        <option value="200Mbps">200 Mbps</option>
                        <option value="300Mbps">300 Mbps</option>
                        <option value="500Mbps">500 Mbps</option>
                        <option value="1Gbps">1 Gbps</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha de Instalación</label>
                    <input type="date" id="clienteFechaInstalacion">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cliente</button>
            </form>
        </div>
    </div>

    <!-- Modal Hilos -->
    <div id="modalHilos" class="modal">
        <div class="modal-content" style="max-width:600px;">
            <button class="btn-close" onclick="cerrarModal('modalHilos')">&times;</button>
            <h2><i class="fas fa-palette"></i> Colores de Hilos Fusionados</h2>
            <div style="margin-bottom:15px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                    <span style="font-weight:600;color:#2c3e50;">
                        <i class="fas fa-box"></i> <span id="hilosCajaNombre">Cargando...</span>
                    </span>
                    <button onclick="abrirModal('modalNuevoHilo')" class="btn btn-success" style="padding:4px 12px;font-size:12px;">
                        <i class="fas fa-plus"></i> Nuevo Hilo
                    </button>
                </div>
                <div id="hilosLista">
                    <div class="loading">Cargando hilos...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Hilo -->
    <div id="modalNuevoHilo" class="modal">
        <div class="modal-content" style="max-width:450px;">
            <button class="btn-close" onclick="cerrarModal('modalNuevoHilo')">&times;</button>
            <h2><i class="fas fa-plus-circle"></i> Nuevo Hilo Fusionado</h2>
            <form id="formHilo" onsubmit="guardarHilo(event)">
                <input type="hidden" id="hiloCajaId">
                <div class="form-group">
                    <label>Nombre del Hilo *</label>
                    <input type="text" id="hiloNombre" required placeholder="Ej: Hilo Principal 1">
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select id="hiloTipo">
                        <option value="primario">🔴 Primario</option>
                        <option value="secundario" selected>🟠 Secundario</option>
                        <option value="terciario">🟢 Terciario</option>
                        <option value="distribucion">🟣 Distribución</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="color" id="hiloColor" value="#e74c3c">
                </div>
                <div class="form-group">
                    <label>Capacidad</label>
                    <input type="number" id="hiloCapacidad" value="12">
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea id="hiloObservaciones" placeholder="Detalles adicionales..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Hilo</button>
            </form>
        </div>
    </div>
	<script>
    let map, markers = [], markerObjects = {}, polylines = [];
    let currentDrawMode = null, currentCablePath = [], tempPolyline = null, tempMarkers = [];
    let selectedColor = '#e74c3c', selectedStyle = 'solid', zoomAnimation = null, buscando = false;
    let modoAgregar = null, puntoSeleccionado = null, markerPuntoSeleccionado = null;

    const COLORES_TIPO = {
        'MUFAPRIMARIA': '#e74c3c', 'MUFASECUNDARIA': '#f39c12', 'MUFATERCIARIA': '#2ecc71',
        'CTO': '#3498db', 'CAJA_DISTRIBUCION': '#9b59b6', 'SPLITTER': '#1abc9c',
        'NAP': '#2ecc71', 'NODO': '#e67e22', 'REGISTRO': '#95a5a6',
        'CAMARA': '#2c3e50', 'POP': '#e74c3c'
    };

    // ============ INICIALIZACIÓN ============
    function initMap() {
        map = L.map('map').setView([-27.5935, -48.5465], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap', maxZoom: 19
        }).addTo(map);

        map.on('click', function(e) {
            const lat = e.latlng.lat, lng = e.latlng.lng;
            document.getElementById('cajaLat').value = lat.toFixed(9);
            document.getElementById('cajaLng').value = lng.toFixed(9);
            document.getElementById('cajaGoogleMapsLink').value = `https://www.google.com/maps?q=${lat.toFixed(9)},${lng.toFixed(9)}`;
            document.getElementById('clienteLat').value = lat.toFixed(9);
            document.getElementById('clienteLng').value = lng.toFixed(9);
            document.getElementById('clienteGoogleMapsLink').value = `https://www.google.com/maps?q=${lat.toFixed(9)},${lng.toFixed(9)}`;
            
            if (modoAgregar) {
                mostrarPuntoSeleccionado(lat, lng);
                if (modoAgregar === 'CLIENTE') {
                    abrirModal('modalCliente');
                    document.getElementById('clienteNombre').focus();
                } else {
                    document.getElementById('cajaTipo').value = modoAgregar;
                    const tipos = {
                        'MUFAPRIMARIA': 'Nueva Mufa Primaria',
                        'MUFASECUNDARIA': 'Nueva Mufa Secundaria',
                        'MUFATERCIARIA': 'Nueva Mufa Terciaria',
                        'CTO': 'Nuevo CTO',
                        'CAJA_DISTRIBUCION': 'Nueva Caja Distribución',
                        'SPLITTER': 'Nuevo Splitter',
                        'NAP': 'Nuevo NAP'
                    };
                    document.querySelector('#modalCaja h2').textContent = '📦 ' + (tipos[modoAgregar] || 'Nueva Caja');
                    abrirModal('modalCaja');
                    document.getElementById('cajaNombre').focus();
                }
            }
            
            if (currentDrawMode === 'polyline') {
                currentCablePath.push([lat, lng]);
                dibujarCableTemporal();
                actualizarPreview();
            }
        });

        map.on('dblclick', function(e) {
            if (currentDrawMode === 'polyline' && currentCablePath.length >= 2) {
                alert('✅ Trazo finalizado. Haz clic en "Guardar" para registrar el cable.');
                currentDrawMode = null;
                document.getElementById('drawLineBtn').classList.remove('active');
            }
        });

        cargarDatos();
        
        let timeoutId = null;
        $('#searchInput').on('input', function() {
            clearTimeout(timeoutId);
            const valor = $(this).val();
            timeoutId = setTimeout(function() { buscarElemento(valor); }, 300);
        });
    }

    // ============ FUNCIONES DE AGREGAR RÁPIDO ============
    function activarAgregar(tipo) {
        modoAgregar = tipo;
        document.getElementById('quickAddStatus').innerHTML = `
            <i class="fas fa-circle" style="color:#e74c3c;"></i> 
            Modo agregar: <strong>${tipo === 'CLIENTE' ? 'Cliente' : tipo}</strong> - 
            Haz clic en el mapa para colocar el elemento
            <button onclick="desactivarAgregar()" style="margin-left:8px;padding:0 8px;border:none;background:#e74c3c;color:white;border-radius:3px;cursor:pointer;">✕</button>
        `;
        document.getElementById('map').style.cursor = 'crosshair';
        if (markerPuntoSeleccionado) { map.removeLayer(markerPuntoSeleccionado); markerPuntoSeleccionado = null; }
        puntoSeleccionado = null;
    }

    function desactivarAgregar() {
        modoAgregar = null;
        document.getElementById('quickAddStatus').innerHTML = `<i class="fas fa-info-circle"></i> Haz clic en el mapa para agregar un elemento`;
        document.getElementById('map').style.cursor = '';
        if (markerPuntoSeleccionado) { map.removeLayer(markerPuntoSeleccionado); markerPuntoSeleccionado = null; }
        puntoSeleccionado = null;
    }

    function mostrarPuntoSeleccionado(lat, lng) {
        if (markerPuntoSeleccionado) map.removeLayer(markerPuntoSeleccionado);
        puntoSeleccionado = { lat, lng };
        const icon = L.divIcon({
            html: `<div class="selected-point-marker"></div>`,
            className: '', iconSize: [16, 16], popupAnchor: [0, -8]
        });
        const marker = L.marker([lat, lng], { icon: icon }).addTo(map);
        const tipoNombre = {
            'MUFAPRIMARIA': 'Mufa Primaria', 'MUFASECUNDARIA': 'Mufa Secundaria',
            'MUFATERCIARIA': 'Mufa Terciaria', 'CTO': 'CTO',
            'CAJA_DISTRIBUCION': 'Caja Distribución', 'SPLITTER': 'Splitter',
            'NAP': 'NAP', 'CLIENTE': 'Cliente'
        };
        marker.bindPopup(`
            <div style="text-align:center;padding:5px;">
                <b>📍 Nuevo ${tipoNombre[modoAgregar] || 'Elemento'}</b>
                <br><small>Lat: ${lat.toFixed(9)}</small>
                <br><small>Lng: ${lng.toFixed(9)}</small>
                <br><button onclick="document.querySelector('.modal').style.display='block'" style="margin-top:5px;padding:4px 12px;background:#27ae60;color:white;border:none;border-radius:4px;cursor:pointer;">
                    <i class="fas fa-edit"></i> Completar datos
                </button>
            </div>
        `).openPopup();
        markerPuntoSeleccionado = marker;
    }

    // ============ FUNCIONES GOOGLE MAPS ============
    function abrirGoogleMaps(lat, lng, nombre) {
        if (!lat || !lng) { alert('❌ No hay coordenadas disponibles'); return; }
        window.open(`https://www.google.com/maps?q=${lat},${lng}`, '_blank');
    }

    function copiarCoordenadas(lat, lng) {
        const texto = `${lat}, ${lng}`;
        navigator.clipboard.writeText(texto).then(() => {
            alert('✅ Coordenadas copiadas al portapapeles');
        }).catch(() => {
            const input = document.createElement('input');
            input.value = texto;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            alert('✅ Coordenadas copiadas al portapapeles');
        });
    }

    // ============ EXTRAER COORDENADAS ============
    function extraerCoordenadasPrecisas(link) {
        let lat = null, lng = null;
        let match = link.match(/[?&]q=([^&]+)/);
        if (match) { const coords = match[1].split(','); if (coords.length >= 2) { lat = parseFloat(coords[0]); lng = parseFloat(coords[1]); } }
        if (!lat || !lng) { match = link.match(/@([^,]+),([^,]+)/); if (match) { lat = parseFloat(match[1]); lng = parseFloat(match[2]); } }
        if (!lat || !lng) { match = link.match(/[?&]ll=([^&]+)/); if (match) { const coords = match[1].split(','); if (coords.length >= 2) { lat = parseFloat(coords[0]); lng = parseFloat(coords[1]); } } }
        if (!lat || !lng) { match = link.match(/\/@([^,]+),([^,]+)/); if (match) { lat = parseFloat(match[1]); lng = parseFloat(match[2]); } }
        if (!lat || !lng) { match = link.match(/place\/[^\/]*\/@([^,]+),([^,]+)/); if (match) { lat = parseFloat(match[1]); lng = parseFloat(match[2]); } }
        if (lat && lng && !isNaN(lat) && !isNaN(lng)) return { lat, lng };
        return null;
    }

    function extraerCoordenadasForm(prefijo) {
        const link = document.getElementById(prefijo + 'GoogleMapsLink').value.trim();
        if (!link) { alert('⚠️ Por favor, pega un link de Google Maps primero.'); return; }
        const coords = extraerCoordenadasPrecisas(link);
        if (coords) {
            document.getElementById(prefijo + 'Lat').value = coords.lat;
            document.getElementById(prefijo + 'Lng').value = coords.lng;
            document.getElementById(prefijo + 'Altitud').value = 0;
            mostrarPreviewMapa(coords.lat, coords.lng);
            alert('✅ Coordenadas extraídas con precisión');
        } else {
            alert('❌ No se pudieron extraer las coordenadas del link.');
        }
    }

    function extraerCoordenadasDesdeLink() { extraerCoordenadasForm('cliente'); }
    function extraerCoordenadasDesdeLinkCaja() { extraerCoordenadasForm('caja'); }

    function mostrarPreviewMapa(lat, lng) {
        if (map) {
            map.flyTo([lat, lng], 17, { duration: 1 });
            if (window.tempLocationMarker) map.removeLayer(window.tempLocationMarker);
            window.tempLocationMarker = L.circleMarker([lat, lng], {
                radius: 10, color: '#34a853', weight: 3, opacity: 1, fillColor: '#34a853', fillOpacity: 0.3
            }).addTo(map);
            window.tempLocationMarker.bindPopup(`<b>📍 Ubicación exacta</b><br>Lat: ${lat}<br>Lng: ${lng}`).openPopup();
        }
    }

    // ============ UBICACIÓN ACTUAL ============
    function obtenerUbicacionActualForm(prefijo) {
        if (!navigator.geolocation) { alert('❌ Tu navegador no soporta geolocalización.'); return; }
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude, lng = position.coords.longitude;
                document.getElementById(prefijo + 'Lat').value = lat;
                document.getElementById(prefijo + 'Lng').value = lng;
                document.getElementById(prefijo + 'Altitud').value = position.coords.altitude || 0;
                document.getElementById(prefijo + 'GoogleMapsLink').value = `https://www.google.com/maps?q=${lat},${lng}`;
                mostrarPreviewMapa(lat, lng);
                alert('✅ Ubicación obtenida correctamente');
            },
            function(error) { alert('❌ Error al obtener la ubicación'); },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    }

    function obtenerUbicacionActual() { obtenerUbicacionActualForm('cliente'); }
    function obtenerUbicacionActualCaja() { obtenerUbicacionActualForm('caja'); }

    function limpiarCoordenadasForm(prefijo) {
        document.getElementById(prefijo + 'Lat').value = '';
        document.getElementById(prefijo + 'Lng').value = '';
        document.getElementById(prefijo + 'Altitud').value = '';
        document.getElementById(prefijo + 'GoogleMapsLink').value = '';
        if (window.tempLocationMarker) { map.removeLayer(window.tempLocationMarker); window.tempLocationMarker = null; }
    }

    function limpiarCoordenadas() { limpiarCoordenadasForm('cliente'); }
    function limpiarCoordenadasCaja() { limpiarCoordenadasForm('caja'); }

    // ============ FUNCIÓN ZOOM ============
    function zoomToLocation(lat, lng, nombre, tipo) {
        if (!lat || !lng) { alert('❌ No hay coordenadas disponibles'); return; }
        const latNum = parseFloat(lat), lngNum = parseFloat(lng);
        map.flyTo([latNum, lngNum], 18, { duration: 1.5, easeLinearity: 0.25 });
        const popupContent = `
            <div style="text-align:center;padding:5px;">
                <b style="color:#2c3e50;font-size:16px;">📍 ${nombre || 'Ubicación'}</b>
                <br><span class="badge badge-${(tipo || '').toLowerCase()}">${tipo || 'Elemento'}</span>
                <br><small>Lat: ${latNum} | Lng: ${lngNum}</small>
                <br><button onclick="abrirGoogleMaps(${latNum}, ${lngNum}, '${nombre}')" style="margin-top:4px;padding:3px 10px;background:#34a853;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                    <i class="fas fa-map-marked-alt"></i> Google Maps
                </button>
            </div>
        `;
        if (zoomAnimation) map.removeLayer(zoomAnimation);
        zoomAnimation = L.circleMarker([latNum, lngNum], {
            radius: 20, color: '#e74c3c', weight: 3, opacity: 0.8, fillColor: '#e74c3c', fillOpacity: 0.2,
            className: 'location-pulse'
        }).addTo(map);
        zoomAnimation.bindPopup(popupContent).openPopup();
        setTimeout(() => { if (zoomAnimation) { map.removeLayer(zoomAnimation); zoomAnimation = null; } }, 4000);
    }

    function zoomToCaja(id) {
        $.ajax({
            url: `api.php?action=get_caja&id=${id}`,
            method: 'GET', dataType: 'json',
            success: function(caja) {
                if (caja && !caja.error) zoomToLocation(caja.latitud, caja.longitud, caja.nombre, caja.tipo);
            }
        });
    }

    // ============ HERRAMIENTAS DE DIBUJO ============
    function dibujarCableTemporal() {
        if (tempPolyline) { map.removeLayer(tempPolyline); tempPolyline = null; }
        tempMarkers.forEach(m => map.removeLayer(m)); tempMarkers = [];
        if (currentCablePath.length > 1) {
            const style = selectedStyle === 'solid' ? null : selectedStyle === 'dashed' ? '5, 10' : '2, 5';
            tempPolyline = L.polyline(currentCablePath, {
                color: selectedColor, weight: 4, dashArray: style, opacity: 0.9
            }).addTo(map);
            currentCablePath.forEach((p, i) => {
                const marker = L.circleMarker(p, {
                    radius: i === 0 || i === currentCablePath.length - 1 ? 6 : 4,
                    color: selectedColor, fillColor: selectedColor, fillOpacity: 0.8, weight: 2
                }).addTo(map);
                tempMarkers.push(marker);
            });
        }
    }

    function actualizarPreview() {
        const puntos = currentCablePath.length;
        let texto = `<i class="fas fa-info-circle"></i> `;
        if (puntos === 0) texto += 'Haz clic en el mapa para comenzar a trazar';
        else if (puntos === 1) texto += `1 punto trazado. Haz clic para continuar`;
        else texto += `${puntos} puntos trazados. Doble clic para finalizar`;
        document.getElementById('cablePreview').innerHTML = texto;
    }

    function seleccionarColor(element, color) {
        document.querySelectorAll('.color-option').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        selectedColor = color;
        if (tempPolyline) dibujarCableTemporal();
    }

    function seleccionarEstilo(style) {
        document.querySelectorAll('.line-style-options button').forEach(el => el.classList.remove('active'));
        if (style === 'solid') document.getElementById('styleSolid').classList.add('active');
        else if (style === 'dashed') document.getElementById('styleDashed').classList.add('active');
        else if (style === 'dotted') document.getElementById('styleDotted').classList.add('active');
        selectedStyle = style;
        if (tempPolyline) dibujarCableTemporal();
    }

    function toggleDraw(mode) {
        if (currentDrawMode === mode) { currentDrawMode = null; document.getElementById('drawLineBtn').classList.remove('active'); return; }
        currentDrawMode = mode;
        document.getElementById('drawLineBtn').classList.remove('active');
        if (mode === 'polyline') {
            document.getElementById('drawLineBtn').classList.add('active');
            if (currentCablePath.length === 0) alert('💡 Haz clic en el mapa para agregar puntos. Doble clic para finalizar.');
        }
    }

    function limpiarDibujo() {
        if (tempPolyline) { map.removeLayer(tempPolyline); tempPolyline = null; }
        tempMarkers.forEach(m => map.removeLayer(m)); tempMarkers = [];
        currentCablePath = []; currentDrawMode = null;
        document.getElementById('drawLineBtn').classList.remove('active');
        document.getElementById('cablePreview').innerHTML = '<i class="fas fa-info-circle"></i> Haz clic en el mapa para trazar';
    }

    function guardarDibujo() {
        if (currentCablePath.length < 2) { alert('⚠️ Dibuja al menos 2 puntos para crear un cable.'); return; }
        document.getElementById('cablePuntos').value = JSON.stringify(currentCablePath);
        document.getElementById('cableColor').value = selectedColor;
        let length = 0;
        for (let i = 1; i < currentCablePath.length; i++) {
            const p1 = currentCablePath[i-1], p2 = currentCablePath[i];
            const d = Math.sqrt(Math.pow(p2[0]-p1[0], 2) + Math.pow(p2[1]-p1[1], 2)) * 111000;
            length += d;
        }
        document.getElementById('cableLongitud').value = length.toFixed(2);
        abrirModal('modalCable');
    }

    // ============ GENERAR CÓDIGO DE CLIENTE ============
    function generarCodigoCliente() {
        $.ajax({
            url: 'api.php?action=get_next_cliente_codigo',
            method: 'GET', dataType: 'json',
            success: function(response) {
                if (response.codigo) document.getElementById('clienteCodigo').value = response.codigo;
            },
            error: function() {
                const fecha = new Date();
                const año = fecha.getFullYear().toString().substr(-2);
                const mes = String(fecha.getMonth() + 1).padStart(2, '0');
                const dia = String(fecha.getDate()).padStart(2, '0');
                const random = String(Math.floor(Math.random() * 10000)).padStart(4, '0');
                document.getElementById('clienteCodigo').value = `CL-${año}${mes}${dia}-${random}`;
            }
        });
    }

    // ============ CARGA DE DATOS ============
    function cargarDatos() {
        cargarCajas();
        cargarClientes();
        cargarCables();
        cargarSelects();
        actualizarEstadisticas();
    }

    // ============ HILOS FUSIONADOS ============
    function abrirModalHilos(cajaId, cajaNombre) {
        document.getElementById('hilosCajaNombre').textContent = cajaNombre || 'Caja ' + cajaId;
        document.getElementById('hiloCajaId').value = cajaId;
        abrirModal('modalHilos');
        cargarHilos(cajaId);
    }

    function cargarHilos(cajaId) {
        $.ajax({
            url: `api.php?action=get_hilos_caja&caja_id=${cajaId}`,
            method: 'GET', dataType: 'json',
            success: function(hilos) { mostrarHilos(hilos); },
            error: function() { document.getElementById('hilosLista').innerHTML = '<p style="color:#e74c3c;text-align:center;padding:10px;">Error al cargar los hilos</p>'; }
        });
    }

    function mostrarHilos(hilos) {
        if (hilos.length === 0) {
            document.getElementById('hilosLista').innerHTML = `
                <div style="text-align:center;padding:20px;color:#999;">
                    <i class="fas fa-palette" style="font-size:30px;display:block;margin-bottom:10px;"></i>
                    No hay hilos fusionados registrados
                    <br><small>Haz clic en "Nuevo Hilo" para agregar uno</small>
                </div>
            `;
            return;
        }
        const tipos = { 'primario': '🔴 Primario', 'secundario': '🟠 Secundario', 'terciario': '🟢 Terciario', 'distribucion': '🟣 Distribución' };
        let html = '';
        hilos.forEach(hilo => {
            const tipoLabel = tipos[hilo.tipo] || hilo.tipo;
            html += `
                <div class="hilo-item" style="--hilo-color: ${hilo.color};">
                    <div class="hilo-color-circle" style="background:${hilo.color};"></div>
                    <div class="hilo-info">
                        <div class="nombre">${hilo.nombre}</div>
                        <div class="detalles">
                            <span>${tipoLabel}</span>
                            <span>📊 ${hilo.ocupados}/${hilo.capacidad}</span>
                            ${hilo.observaciones ? `<span>📝 ${hilo.observaciones}</span>` : ''}
                        </div>
                    </div>
                    <button onclick="eliminarHilo(${hilo.id})" class="btn-eliminar-hilo"><i class="fas fa-trash"></i></button>
                </div>
            `;
        });
        document.getElementById('hilosLista').innerHTML = html;
    }

    function guardarHilo(e) {
        e.preventDefault();
        const data = {
            caja_id: document.getElementById('hiloCajaId').value,
            nombre: document.getElementById('hiloNombre').value,
            color: document.getElementById('hiloColor').value,
            tipo: document.getElementById('hiloTipo').value,
            capacidad: document.getElementById('hiloCapacidad').value,
            observaciones: document.getElementById('hiloObservaciones').value
        };
        $.ajax({
            url: 'api.php?action=guardar_hilo',
            method: 'POST', data: data, dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('✅ ' + response.message);
                    cerrarModal('modalNuevoHilo');
                    document.getElementById('formHilo').reset();
                    const cajaId = document.getElementById('hiloCajaId').value;
                    cargarHilos(cajaId);
                } else {
                    alert('❌ Error: ' + (response.error || 'Error desconocido'));
                }
            },
            error: function() { alert('❌ Error al guardar'); }
        });
    }

    function eliminarHilo(id) {
        if (!confirm('¿Estás seguro de eliminar este hilo?')) return;
        $.ajax({
            url: `api.php?action=eliminar_hilo&id=${id}`,
            method: 'GET', dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('✅ Hilo eliminado correctamente');
                    const cajaId = document.getElementById('hiloCajaId').value;
                    cargarHilos(cajaId);
                } else {
                    alert('❌ Error al eliminar');
                }
            },
            error: function() { alert('❌ Error al eliminar'); }
        });
    }

    // ============ CAJAS ============
    function cargarCajas() {
        $.ajax({
            url: 'api.php?action=get_cajas',
            method: 'GET', dataType: 'json',
            success: function(cajas) {
                mostrarCajas(cajas);
                dibujarCajas(cajas);
            },
            error: function() { console.error('Error cargando cajas'); }
        });
    }

    function getTipoInfo(tipo) {
        tipo = tipo || 'CTO';
        const color = COLORES_TIPO[tipo] || '#3498db';
        const tamano = tipo === 'MUFAPRIMARIA' ? 20 : tipo === 'MUFASECUNDARIA' ? 18 : tipo === 'NODO' ? 18 : 14;
        const letras = tipo === 'MUFAPRIMARIA' ? 'MP' : tipo === 'MUFASECUNDARIA' ? 'MS' : tipo === 'MUFATERCIARIA' ? 'MT' : tipo === 'SPLITTER' ? 'SP' : tipo === 'NAP' ? 'N' : tipo === 'NODO' ? 'N' : tipo === 'REGISTRO' ? 'R' : tipo === 'CAMARA' ? 'C' : tipo === 'POP' ? 'P' : tipo.charAt(0);
        const borderRadius = ['CTO', 'CAJA_DISTRIBUCION', 'REGISTRO', 'NAP'].includes(tipo) ? '4px' : '50%';
        return { color, tamano, letras, borderRadius };
    }

    function dibujarCajas(cajas) {
        markers.forEach(m => map.removeLayer(m));
        markers = []; markerObjects = {};
        cajas.forEach(caja => {
            if (!caja.latitud || !caja.longitud) return;
            const lat = parseFloat(caja.latitud), lng = parseFloat(caja.longitud);
            const tipo = caja.tipo || 'CTO';
            const info = getTipoInfo(tipo);
            const icon = L.divIcon({
                html: `<div style="background:${info.color};width:${info.tamano}px;height:${info.tamano}px;border-radius:${info.borderRadius};border:3px solid white;box-shadow:0 0 12px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;font-size:${info.tamano > 16 ? 10 : 8}px;color:white;font-weight:bold;text-shadow:0 1px 2px rgba(0,0,0,0.3);">${info.letras}</div>`,
                className: '', iconSize: [info.tamano, info.tamano], popupAnchor: [0, -(info.tamano/2 + 2)]
            });
            const marker = L.marker([lat, lng], { icon: icon }).addTo(map);
            const altitud = caja.altitud ? `🌄 Altitud: ${caja.altitud}m` : '';
            marker.bindPopup(`
                <div style="min-width:280px;max-width:320px;">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                        <div style="width:36px;height:36px;border-radius:50%;background:${info.color};display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:14px;border:2px solid white;box-shadow:0 2px 8px rgba(0,0,0,0.2);">${info.letras}</div>
                        <div><b style="color:#2c3e50;font-size:15px;">${caja.nombre}</b><br><span class="badge badge-${tipo.toLowerCase()}">${tipo}</span></div>
                    </div>
                    <div style="font-size:12px;color:#666;">
                        <div>📍 ${caja.direccion || 'Sin dirección'}</div>
                        <div>📊 ${caja.ocupados}/${caja.capacidad}</div>
                        <div>Estado: <span class="badge badge-${caja.estado}">${caja.estado}</span></div>
                    </div>
                    <hr style="margin:6px 0;border-color:#eee;">
                    <div style="font-size:12px;color:#666;">
                        <div><i class="fas fa-map-pin"></i> Lat: ${lat}</div>
                        <div><i class="fas fa-map-pin"></i> Lng: ${lng}</div>
                        ${altitud ? `<div>${altitud}</div>` : ''}
                    </div>
                    <div style="margin-top:8px;display:flex;gap:4px;flex-wrap:wrap;">
                        <button onclick="abrirGoogleMaps(${lat}, ${lng}, '${caja.nombre}')" style="padding:4px 12px;background:#34a853;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                            <i class="fas fa-map-marked-alt"></i> Google Maps
                        </button>
                        <button onclick="copiarCoordenadas(${lat}, ${lng})" style="padding:4px 12px;background:#4285f4;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                        <button onclick="zoomToCaja(${caja.id})" style="padding:4px 12px;background:#3498db;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                            <i class="fas fa-search-location"></i> Centrar
                        </button>
                        <button onclick="abrirModalHilos(${caja.id}, '${caja.nombre}')" style="padding:4px 12px;background:#9b59b6;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                            <i class="fas fa-palette"></i> Hilos
                        </button>
                    </div>
                </div>
            `);
            markers.push(marker);
            markerObjects[`caja_${caja.id}`] = marker;
        });
    }

    function mostrarCajas(cajas) {
        const searchValue = document.getElementById('searchInput').value.trim();
        if (searchValue.length >= 2 && !buscando) return;
        const etiquetasTipo = {
            'MUFAPRIMARIA': 'Mufa Primaria', 'MUFASECUNDARIA': 'Mufa Secundaria',
            'MUFATERCIARIA': 'Mufa Terciaria', 'CTO': 'CTO',
            'CAJA_DISTRIBUCION': 'Caja Distribución', 'SPLITTER': 'Splitter',
            'NAP': 'NAP', 'NODO': 'Nodo', 'REGISTRO': 'Registro',
            'CAMARA': 'Cámara', 'POP': 'POP'
        };
        const iconosTipo = {
            'MUFAPRIMARIA': '🔴', 'MUFASECUNDARIA': '🟠', 'MUFATERCIARIA': '🟢',
            'CTO': '🔵', 'CAJA_DISTRIBUCION': '🟣', 'SPLITTER': '🩵',
            'NAP': '🟢', 'NODO': '🟠', 'REGISTRO': '⚪',
            'CAMARA': '⚫', 'POP': '🔴'
        };
        let html = `<div class="section-title"><span><i class="fas fa-boxes"></i> Cajas / MUFAS / NAP</span><span class="count">${cajas.length}</span></div>`;
        if (cajas.length === 0) html += '<p style="color:#999;text-align:center;padding:15px;">No hay elementos registrados</p>';
        cajas.slice(0, 10).forEach(caja => {
            const tipo = caja.tipo || 'CTO', color = COLORES_TIPO[tipo] || '#3498db', etiqueta = etiquetasTipo[tipo] || tipo, icono = iconosTipo[tipo] || '📦';
            const coords = caja.latitud && caja.longitud ? `${parseFloat(caja.latitud)}, ${parseFloat(caja.longitud)}` : 'Sin coordenadas';
            html += `
                <div class="info-card" style="border-left: 3px solid ${color};">
                    <div class="card-title">${icono} ${caja.nombre}<span style="font-size:10px;color:#666;font-weight:normal;margin-left:6px;">${etiqueta}</span></div>
                    <div class="card-subtitle">📍 ${caja.direccion || 'Sin dirección'}</div>
                    <div class="card-coords"><i class="fas fa-map-pin"></i> ${coords}${caja.altitud ? ` | 🌄 ${caja.altitud}m` : ''}</div>
                    <div class="card-tags"><span class="badge badge-${tipo.toLowerCase()}">${tipo}</span><span class="badge badge-${caja.estado}">${caja.estado}</span><span style="font-size:11px;color:#666;">${caja.ocupados}/${caja.capacidad}</span></div>
                    <div class="card-actions">
                        <button class="btn-zoom" onclick="zoomToCaja(${caja.id})"><i class="fas fa-search-location"></i> Ver en mapa</button>
                        ${caja.latitud && caja.longitud ? `
                            <button class="btn-maps" onclick="abrirGoogleMaps(${caja.latitud}, ${caja.longitud}, '${caja.nombre}')"><i class="fas fa-map-marked-alt"></i> Maps</button>
                            <button class="btn-copy" onclick="copiarCoordenadas(${caja.latitud}, ${caja.longitud})"><i class="fas fa-copy"></i></button>
                        ` : ''}
                        <button class="btn-hilos" onclick="abrirModalHilos(${caja.id}, '${caja.nombre}')"><i class="fas fa-palette"></i> Hilos</button>
                    </div>
                </div>
            `;
        });
        if (cajas.length > 10) html += `<p style="text-align:center;color:#999;font-size:11px;margin:5px 0;">... y ${cajas.length - 10} más</p>`;
        document.getElementById('infoContent').innerHTML = html;
        if (searchValue.length < 2) cargarClientesSidebar();
    }

    // ============ CLIENTES ============
    function cargarClientes() {
        $.ajax({
            url: 'api.php?action=get_clientes',
            method: 'GET', dataType: 'json',
            success: function(clientes) { dibujarClientes(clientes); },
            error: function() { console.error('Error cargando clientes'); }
        });
    }

    function cargarClientesSidebar() {
        $.ajax({
            url: 'api.php?action=get_clientes',
            method: 'GET', dataType: 'json',
            success: function(clientes) {
                const searchValue = document.getElementById('searchInput').value.trim();
                if (searchValue.length >= 2) return;
                let html = document.getElementById('infoContent').innerHTML;
                html += `<div class="section-title" style="margin-top:12px;"><span><i class="fas fa-users"></i> Clientes</span><span class="count">${clientes.length}</span></div>`;
                if (clientes.length === 0) html += '<p style="color:#999;text-align:center;padding:10px;">No hay clientes registrados</p>';
                clientes.slice(0, 10).forEach(cliente => {
                    const estadoColor = cliente.estado === 'activo' ? '#27ae60' : cliente.estado === 'pendiente' ? '#f39c12' : '#e74c3c';
                    const coords = cliente.latitud && cliente.longitud ? `${parseFloat(cliente.latitud)}, ${parseFloat(cliente.longitud)}` : 'Sin coordenadas';
                    html += `
                        <div class="info-card" style="border-left: 3px solid ${estadoColor};">
                            <div class="card-title">${cliente.nombre}<span class="cliente-code">${cliente.codigo_cliente || 'Sin código'}</span></div>
                            <div class="card-subtitle">📍 ${cliente.direccion || 'Sin dirección'}</div>
                            <div class="card-coords"><i class="fas fa-map-pin"></i> ${coords}${cliente.altitud ? ` | 🌄 ${cliente.altitud}m` : ''}</div>
                            <div class="card-tags"><span class="badge badge-${cliente.estado}">${cliente.estado}</span><span style="font-size:11px;color:#666;">⚡ ${cliente.velocidad || 'N/A'}</span></div>
                            <div class="card-actions">
                                <button class="btn-zoom" onclick="zoomToLocation(${cliente.latitud}, ${cliente.longitud}, '${cliente.nombre}', 'Cliente')"><i class="fas fa-search-location"></i> Ver en mapa</button>
                                ${cliente.latitud && cliente.longitud ? `
                                    <button class="btn-maps" onclick="abrirGoogleMaps(${cliente.latitud}, ${cliente.longitud}, '${cliente.nombre}')"><i class="fas fa-map-marked-alt"></i> Maps</button>
                                    <button class="btn-copy" onclick="copiarCoordenadas(${cliente.latitud}, ${cliente.longitud})"><i class="fas fa-copy"></i></button>
                                ` : ''}
                            </div>
                        </div>
                    `;
                });
                if (clientes.length > 10) html += `<p style="text-align:center;color:#999;font-size:11px;margin:5px 0;">... y ${clientes.length - 10} más</p>`;
                document.getElementById('infoContent').innerHTML = html;
            }
        });
    }

    function dibujarClientes(clientes) {
        clientes.forEach(cliente => {
            if (!cliente.latitud || !cliente.longitud) return;
            const lat = parseFloat(cliente.latitud), lng = parseFloat(cliente.longitud);
            const color = cliente.estado === 'activo' ? '#27ae60' : cliente.estado === 'pendiente' ? '#f39c12' : '#e74c3c';
            const marker = L.circleMarker([lat, lng], {
                radius: 5, fillColor: color, color: '#fff', weight: 2, opacity: 1, fillOpacity: 0.9
            }).addTo(map);
            const altitud = cliente.altitud ? `🌄 Altitud: ${cliente.altitud}m` : '';
            const documento = cliente.documento ? `📄 ${cliente.documento}` : '';
            marker.bindPopup(`
                <div style="min-width:260px;">
                    <b style="font-size:14px;">${cliente.nombre}</b>
                    <br><span style="background:#f0f0f0;padding:1px 8px;border-radius:3px;font-size:11px;color:#666;">${cliente.codigo_cliente || 'Sin código'}</span>
                    <br>📍 ${cliente.direccion || 'Sin dirección'}
                    <br>📞 ${cliente.telefono || 'Sin teléfono'}
                    <br>📧 ${cliente.email || 'Sin email'}
                    <br>⚡ ${cliente.velocidad || 'N/A'}
                    <br>Estado: <span class="badge badge-${cliente.estado}">${cliente.estado}</span>
                    ${documento ? `<br>${documento}` : ''}
                    <hr style="margin:6px 0;border-color:#eee;">
                    <div style="font-size:12px;color:#666;">
                        <div><i class="fas fa-map-pin"></i> Lat: ${lat}</div>
                        <div><i class="fas fa-map-pin"></i> Lng: ${lng}</div>
                        ${altitud ? `<div>${altitud}</div>` : ''}
                    </div>
                    <div style="margin-top:6px;display:flex;gap:4px;flex-wrap:wrap;">
                        <button onclick="abrirGoogleMaps(${lat}, ${lng}, '${cliente.nombre}')" style="padding:3px 10px;background:#34a853;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                            <i class="fas fa-map-marked-alt"></i> Google Maps
                        </button>
                        <button onclick="copiarCoordenadas(${lat}, ${lng})" style="padding:3px 10px;background:#4285f4;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                        <button onclick="zoomToLocation(${lat}, ${lng}, '${cliente.nombre}', 'Cliente')" style="padding:3px 10px;background:#27ae60;color:white;border:none;border-radius:4px;cursor:pointer;font-size:11px;">
                            <i class="fas fa-search-location"></i> Centrar
                        </button>
                    </div>
                </div>
            `);
            markers.push(marker);
        });
    }

    // ============ CABLES ============
    function cargarCables() {
        $.ajax({
            url: 'api.php?action=get_cables',
            method: 'GET', dataType: 'json',
            success: function(cables) { dibujarCables(cables); },
            error: function() { console.error('Error cargando cables'); }
        });
    }

    function dibujarCables(cables) {
        polylines.forEach(p => map.removeLayer(p)); polylines = [];
        cables.forEach(cable => {
            let puntos = [];
            if (cable.lat_origen && cable.lng_origen) puntos.push([parseFloat(cable.lat_origen), parseFloat(cable.lng_origen)]);
            if (cable.puntos_intermedios) {
                try { const intermedios = JSON.parse(cable.puntos_intermedios); intermedios.forEach(p => { puntos.push([parseFloat(p[0]), parseFloat(p[1])]); }); } catch(e) {}
            }
            if (cable.lat_destino && cable.lng_destino) puntos.push([parseFloat(cable.lat_destino), parseFloat(cable.lng_destino)]);
            if (puntos.length < 2) return;
            const color = cable.color || '#e74c3c';
            const isPrincipal = cable.nombre && cable.nombre.toLowerCase().includes('principal');
            const polyline = L.polyline(puntos, {
                color: color, weight: isPrincipal ? 4 : 3, opacity: 0.8,
                dashArray: cable.estado === 'activo' ? null : '5, 10'
            }).addTo(map);
            polyline.bindPopup(`
                <b>${cable.nombre || 'Cable'}</b>
                <br>Código: ${cable.codigo || 'N/A'}
                <br>Tipo: ${cable.tipo || 'Fibra Óptica'}
                <br>Longitud: ${cable.longitud || 'N/A'} m
                <br><span style="display:inline-block;width:20px;height:3px;background:${color};"></span> Color
            `);
            polylines.push(polyline);
        });
    }

    // ============ SELECTS ============
    function cargarSelects() {
        $.ajax({
            url: 'api.php?action=get_cajas',
            method: 'GET', dataType: 'json',
            success: function(cajas) {
                let options = '<option value="">Seleccionar</option>';
                cajas.forEach(caja => { options += `<option value="${caja.id}">${caja.nombre}</option>`; });
                document.getElementById('clienteCaja').innerHTML = options;
                document.getElementById('cableOrigen').innerHTML = options;
                document.getElementById('cableDestino').innerHTML = options;
            }
        });
        $.ajax({
            url: 'api.php?action=get_cables',
            method: 'GET', dataType: 'json',
            success: function(cables) {
                let options = '<option value="">Seleccionar</option>';
                cables.forEach(cable => { options += `<option value="${cable.id}">${cable.nombre || 'Cable ' + cable.id}</option>`; });
                document.getElementById('clienteCable').innerHTML = options;
            }
        });
    }

    // ============ ESTADÍSTICAS ============
    function actualizarEstadisticas() {
        $.ajax({
            url: 'api.php?action=get_stats',
            method: 'GET', dataType: 'json',
            success: function(stats) {
                document.getElementById('statCajas').textContent = stats.total_cajas || 0;
                document.getElementById('statClientes').textContent = stats.total_clientes || 0;
                document.getElementById('statCables').textContent = stats.total_cables || 0;
                document.getElementById('statActivos').textContent = stats.clientes_activos || 0;
                document.getElementById('totalItems').textContent = `${stats.total_cajas || 0} cajas, ${stats.total_clientes || 0} clientes`;
            }
        });
    }

    // ============ BUSCADOR ============
    function resaltarTexto(texto, busqueda) {
        if (!texto) return 'Sin información';
        const regex = new RegExp(`(${busqueda})`, 'gi');
        return texto.replace(regex, '<span class="highlight">$1</span>');
    }

    function buscarElemento(valor) {
        if (!valor || valor.length < 2) { buscando = false; cargarDatos(); return; }
        buscando = true;
        valor = valor.toLowerCase().trim();
        document.getElementById('infoContent').innerHTML = `<div class="loading"><i class="fas fa-spinner fa-spin"></i> Buscando...</div>`;
        $.ajax({
            url: 'api.php?action=get_cajas',
            method: 'GET', dataType: 'json',
            success: function(cajas) {
                const cajasFiltradas = cajas.filter(c => c.nombre.toLowerCase().includes(valor) || (c.direccion && c.direccion.toLowerCase().includes(valor)) || (c.codigo && c.codigo.toLowerCase().includes(valor)));
                $.ajax({
                    url: `api.php?action=buscar_clientes&q=${encodeURIComponent(valor)}`,
                    method: 'GET', dataType: 'json',
                    success: function(clientes) {
                        let html = '';
                        const totalResultados = cajasFiltradas.length + clientes.length;
                        html += `<div style="background:#e8f4fd;padding:8px 12px;border-radius:6px;margin-bottom:10px;"><b style="color:#2c3e50;">🔍 Resultados para: "${valor}"</b><span style="float:right;background:#3498db;color:white;padding:1px 10px;border-radius:10px;font-size:11px;">${totalResultados} encontrados</span></div>`;
                        html += `<div class="section-title"><span><i class="fas fa-boxes"></i> Cajas / MUFAS / NAP</span><span class="count">${cajasFiltradas.length}</span></div>`;
                        if (cajasFiltradas.length === 0) { html += '<p style="color:#999;text-align:center;padding:10px;font-size:12px;">No hay elementos coincidentes</p>'; } else {
                            cajasFiltradas.forEach(caja => {
                                const color = COLORES_TIPO[caja.tipo] || '#9b59b6';
                                let nombreDestacado = resaltarTexto(caja.nombre, valor);
                                let direccionDestacada = caja.direccion ? resaltarTexto(caja.direccion, valor) : 'Sin dirección';
                                html += `<div class="info-card" style="border-left: 3px solid ${color};"><div class="card-title">${nombreDestacado}</div><div class="card-subtitle">📍 ${direccionDestacada}</div><div class="card-tags"><span class="badge badge-${caja.tipo.toLowerCase()}">${caja.tipo}</span><span class="badge badge-${caja.estado}">${caja.estado}</span></div><div class="card-actions"><button class="btn-zoom" onclick="zoomToCaja(${caja.id})"><i class="fas fa-search-location"></i> Ver en mapa</button>${caja.latitud && caja.longitud ? `<button class="btn-maps" onclick="abrirGoogleMaps(${caja.latitud}, ${caja.longitud}, '${caja.nombre}')"><i class="fas fa-map-marked-alt"></i> Maps</button>` : ''}</div></div>`;
                            });
                        }
                        html += `<div class="section-title" style="margin-top:12px;"><span><i class="fas fa-users"></i> Clientes</span><span class="count">${clientes.length}</span></div>`;
                        if (clientes.length === 0) { html += '<p style="color:#999;text-align:center;padding:10px;font-size:12px;">No hay clientes coincidentes</p>'; } else {
                            clientes.forEach(cliente => {
                                const estadoColor = cliente.estado === 'activo' ? '#27ae60' : cliente.estado === 'pendiente' ? '#f39c12' : '#e74c3c';
                                let nombreDestacado = resaltarTexto(cliente.nombre, valor);
                                let direccionDestacada = cliente.direccion ? resaltarTexto(cliente.direccion, valor) : 'Sin dirección';
                                let codigoDestacado = cliente.codigo_cliente ? resaltarTexto(cliente.codigo_cliente, valor) : 'Sin código';
                                html += `<div class="info-card" style="border-left: 3px solid ${estadoColor};"><div class="card-title">${nombreDestacado}<span class="cliente-code">${codigoDestacado}</span></div><div class="card-subtitle">📍 ${direccionDestacada}</div><div class="card-tags"><span class="badge badge-${cliente.estado}">${cliente.estado}</span><span style="font-size:11px;color:#666;">⚡ ${cliente.velocidad || 'N/A'}</span></div><div class="card-actions"><button class="btn-zoom" onclick="zoomToLocation(${cliente.latitud}, ${cliente.longitud}, '${cliente.nombre}', 'Cliente')"><i class="fas fa-search-location"></i> Ver en mapa</button>${cliente.latitud && cliente.longitud ? `<button class="btn-maps" onclick="abrirGoogleMaps(${cliente.latitud}, ${cliente.longitud}, '${cliente.nombre}')"><i class="fas fa-map-marked-alt"></i> Maps</button>` : ''}</div></div>`;
                            });
                        }
                        document.getElementById('infoContent').innerHTML = html;
                        actualizarMapaBusqueda(cajasFiltradas, clientes);
                    },
                    error: function() { document.getElementById('infoContent').innerHTML = `<div style="color:#e74c3c;text-align:center;padding:20px;"><i class="fas fa-exclamation-circle"></i> Error al buscar clientes</div>`; }
                });
            },
            error: function() { document.getElementById('infoContent').innerHTML = `<div style="color:#e74c3c;text-align:center;padding:20px;"><i class="fas fa-exclamation-circle"></i> Error al buscar elementos</div>`; }
        });
    }

    function actualizarMapaBusqueda(cajas, clientes) {
        markers.forEach(m => map.removeLayer(m)); markers = [];
        polylines.forEach(p => map.removeLayer(p)); polylines = [];
        cajas.forEach(caja => {
            if (!caja.latitud || !caja.longitud) return;
            const lat = parseFloat(caja.latitud), lng = parseFloat(caja.longitud);
            const tipo = caja.tipo || 'CTO';
            const info = getTipoInfo(tipo);
            const icon = L.divIcon({
                html: `<div style="background:${info.color};width:${info.tamano}px;height:${info.tamano}px;border-radius:${info.borderRadius};border:3px solid white;box-shadow:0 0 12px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;font-size:${info.tamano > 16 ? 10 : 8}px;color:white;font-weight:bold;">${info.letras}</div>`,
                className: '', iconSize: [info.tamano, info.tamano], popupAnchor: [0, -(info.tamano/2 + 2)]
            });
            const marker = L.marker([lat, lng], { icon: icon }).addTo(map);
            marker.bindPopup(`
                <div style="min-width:200px;">
                    <b style="color:#2c3e50;font-size:15px;">${caja.nombre}</b>
                    <br><span class="badge badge-${tipo.toLowerCase()}">${tipo}</span>
                    <br>📍 ${caja.direccion || 'Sin dirección'}
                    <br><button onclick="zoomToCaja(${caja.id})" style="margin-top:6px;padding:4px 12px;background:#3498db;color:white;border:none;border-radius:4px;cursor:pointer;"><i class="fas fa-search-location"></i> Centrar</button>
                    <br><button onclick="abrirGoogleMaps(${lat}, ${lng}, '${caja.nombre}')" style="margin-top:4px;padding:4px 12px;background:#34a853;color:white;border:none;border-radius:4px;cursor:pointer;"><i class="fas fa-map-marked-alt"></i> Google Maps</button>
                    <br><button onclick="abrirModalHilos(${caja.id}, '${caja.nombre}')" style="margin-top:4px;padding:4px 12px;background:#9b59b6;color:white;border:none;border-radius:4px;cursor:pointer;"><i class="fas fa-palette"></i> Hilos</button>
                </div>
            `);
            markers.push(marker);
        });
        clientes.forEach(cliente => {
            if (!cliente.latitud || !cliente.longitud) return;
            const lat = parseFloat(cliente.latitud), lng = parseFloat(cliente.longitud);
            const color = cliente.estado === 'activo' ? '#27ae60' : cliente.estado === 'pendiente' ? '#f39c12' : '#e74c3c';
            const marker = L.circleMarker([lat, lng], {
                radius: 7, fillColor: color, color: '#fff', weight: 2, opacity: 1, fillOpacity: 0.9,
                className: 'location-pulse'
            }).addTo(map);
            marker.bindPopup(`
                <div style="min-width:220px;">
                    <b style="font-size:14px;">${cliente.nombre}</b>
                    <br><span style="background:#f0f0f0;padding:1px 8px;border-radius:3px;font-size:11px;color:#666;">${cliente.codigo_cliente || 'Sin código'}</span>
                    <br>📍 ${cliente.direccion || 'Sin dirección'}
                    <br>⚡ ${cliente.velocidad || 'N/A'}
                    <br><button onclick="zoomToLocation(${lat}, ${lng}, '${cliente.nombre}', 'Cliente')" style="margin-top:5px;padding:4px 12px;background:#27ae60;color:white;border:none;border-radius:4px;cursor:pointer;"><i class="fas fa-search-location"></i> Centrar</button>
                    <br><button onclick="abrirGoogleMaps(${lat}, ${lng}, '${cliente.nombre}')" style="margin-top:4px;padding:4px 12px;background:#34a853;color:white;border:none;border-radius:4px;cursor:pointer;"><i class="fas fa-map-marked-alt"></i> Google Maps</button>
                </div>
            `);
            markers.push(marker);
        });
    }

    // ============ GUARDAR ============
    function guardarCaja(e) {
        e.preventDefault();
        const data = {
            nombre: document.getElementById('cajaNombre').value,
            codigo: document.getElementById('cajaCodigo').value,
            direccion: document.getElementById('cajaDireccion').value,
            latitud: document.getElementById('cajaLat').value,
            longitud: document.getElementById('cajaLng').value,
            altitud: document.getElementById('cajaAltitud').value || 0,
            google_maps_link: document.getElementById('cajaGoogleMapsLink').value || '',
            color_primario: document.getElementById('cajaColorPrimario').value || '#3498db',
            color_secundario: document.getElementById('cajaColorSecundario').value || '#2ecc71',
            tipo: document.getElementById('cajaTipo').value,
            capacidad: document.getElementById('cajaCapacidad').value
        };
        if (!data.latitud || data.latitud === '0' || !data.longitud || data.longitud === '0') {
            alert('⚠️ Por favor, ingresa las coordenadas de ubicación'); return;
        }
        $.ajax({
            url: 'api.php?action=guardar_caja',
            method: 'POST', data: data, dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('✅ ' + response.message);
                    cerrarModal('modalCaja');
                    document.getElementById('formCaja').reset();
                    desactivarAgregar();
                    cargarDatos();
                    if (window.tempLocationMarker) { map.removeLayer(window.tempLocationMarker); window.tempLocationMarker = null; }
                } else {
                    alert('❌ Error: ' + (response.error || 'Error desconocido'));
                }
            },
            error: function() { alert('❌ Error al guardar'); }
        });
    }

    function guardarCable(e) {
        e.preventDefault();
        const data = {
            nombre: document.getElementById('cableNombre').value,
            codigo: document.getElementById('cableCodigo').value,
            origen_id: document.getElementById('cableOrigen').value,
            destino_id: document.getElementById('cableDestino').value,
            puntos_intermedios: document.getElementById('cablePuntos').value || '[]',
            tipo: document.getElementById('cableTipo').value,
            longitud: document.getElementById('cableLongitud').value,
            color: document.getElementById('cableColor').value
        };
        $.ajax({
            url: 'api.php?action=guardar_cable',
            method: 'POST', data: data, dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('✅ ' + response.message);
                    cerrarModal('modalCable');
                    document.getElementById('formCable').reset();
                    limpiarDibujo();
                    cargarDatos();
                } else {
                    alert('❌ Error: ' + (response.error || 'Error desconocido'));
                }
            },
            error: function() { alert('❌ Error al guardar'); }
        });
    }

    function guardarCliente(e) {
        e.preventDefault();
        const data = {
            codigo_cliente: document.getElementById('clienteCodigo').value,
            nombre: document.getElementById('clienteNombre').value,
            documento: document.getElementById('clienteDocumento').value,
            direccion: document.getElementById('clienteDireccion').value,
            telefono: document.getElementById('clienteTelefono').value,
            email: document.getElementById('clienteEmail').value,
            latitud: document.getElementById('clienteLat').value,
            longitud: document.getElementById('clienteLng').value,
            altitud: document.getElementById('clienteAltitud').value || 0,
            google_maps_link: document.getElementById('clienteGoogleMapsLink').value || '',
            caja_id: document.getElementById('clienteCaja').value || null,
            cable_id: document.getElementById('clienteCable').value || null,
            velocidad: document.getElementById('clienteVelocidad').value,
            fecha_instalacion: document.getElementById('clienteFechaInstalacion').value || null
        };
        if (!data.codigo_cliente || data.codigo_cliente.trim() === '') { alert('⚠️ El código del cliente es obligatorio'); return; }
        if (!data.latitud || data.latitud === '0' || !data.longitud || data.longitud === '0') { alert('⚠️ Por favor, ingresa las coordenadas de ubicación'); return; }
        $.ajax({
            url: 'api.php?action=guardar_cliente',
            method: 'POST', data: data, dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('✅ ' + response.message);
                    cerrarModal('modalCliente');
                    document.getElementById('formCliente').reset();
                    generarCodigoCliente();
                    desactivarAgregar();
                    cargarDatos();
                    if (window.tempLocationMarker) { map.removeLayer(window.tempLocationMarker); window.tempLocationMarker = null; }
                } else {
                    alert('❌ Error: ' + (response.error || 'Error desconocido'));
                }
            },
            error: function() { alert('❌ Error al guardar'); }
        });
    }

    // ============ MODALES ============
    function abrirModal(id) {
        document.getElementById(id).style.display = 'block';
        document.body.style.overflow = 'hidden';
        if (id === 'modalCliente') {
            generarCodigoCliente();
            if (!document.getElementById('clienteFechaInstalacion').value) {
                const hoy = new Date().toISOString().split('T')[0];
                document.getElementById('clienteFechaInstalacion').value = hoy;
            }
        }
    }

    function cerrarModal(id) {
        document.getElementById(id).style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    // ============ INICIALIZAR ============
    $(document).ready(function() { initMap(); });
</script>
</body>
</html>