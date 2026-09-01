<?php
require_once 'config.php';
verificarAcceso();

if (!esAdmin()) {
    header('Location: index.php');
    exit;
}

$conn = conectarDB();
$usuarios = $conn->query("SELECT * FROM usuarios ORDER BY id DESC");
$logs = $conn->query("SELECT l.*, u.nombre as usuario_nombre FROM logs l LEFT JOIN usuarios u ON l.usuario_id = u.id ORDER BY l.fecha DESC LIMIT 50");
$stats = $conn->query("SELECT accion, COUNT(*) as total FROM logs GROUP BY accion");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; }
        .admin-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #3498db; flex-wrap: wrap; gap: 10px; }
        .admin-header h1 { color: #2c3e50; font-size: 24px; }
        .admin-header h1 i { color: #3498db; }
        .admin-header .btn-back { background: #3498db; color: white; padding: 8px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .admin-header .btn-back:hover { background: #2980b9; }
        .admin-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .admin-card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .admin-card h3 { color: #2c3e50; margin-bottom: 15px; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px; }
        .admin-card table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .admin-card table th { text-align: left; padding: 8px; background: #f8f9fa; font-weight: 600; color: #2c3e50; }
        .admin-card table td { padding: 8px; border-bottom: 1px solid #e8e8e8; }
        .admin-card table tr:hover td { background: #f8f9fa; }
        .badge-rol { padding: 2px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-rol.admin { background: #e74c3c; color: white; }
        .badge-rol.tecnico { background: #3498db; color: white; }
        .badge-rol.visualizador { background: #95a5a6; color: white; }
        .badge-estado { padding: 2px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-estado.activo { background: #27ae60; color: white; }
        .badge-estado.inactivo { background: #95a5a6; color: white; }
        .badge-estado.bloqueado { background: #e74c3c; color: white; }
        @media (max-width: 768px) {
            .admin-grid { grid-template-columns: 1fr; }
            .admin-header { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fas fa-cog"></i> Panel de Administración</h1>
            <a href="index.php" class="btn-back"><i class="fas fa-arrow-left"></i> Volver al Dashboard</a>
        </div>
        <div class="admin-grid">
            <div class="admin-card">
                <h3><i class="fas fa-users"></i> Usuarios</h3>
                <table>
                    <thead><tr><th>Nombre</th><th>Email</th><th>Rol</th><th>Estado</th></tr></thead>
                    <tbody>
                        <?php while($user = $usuarios->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><span class="badge-rol <?php echo $user['rol']; ?>"><?php echo $user['rol']; ?></span></td>
                            <td><span class="badge-estado <?php echo $user['estado']; ?>"><?php echo $user['estado']; ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="admin-card">
                <h3><i class="fas fa-chart-bar"></i> Actividad del Sistema</h3>
                <table>
                    <thead><tr><th>Acción</th><th>Cantidad</th></tr></thead>
                    <tbody>
                        <?php while($row = $stats->fetch_assoc()): ?>
                        <tr><td><?php echo htmlspecialchars($row['accion']); ?></td><td><?php echo $row['total']; ?></td></tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="admin-card" style="grid-column: 1 / -1;">
                <h3><i class="fas fa-history"></i> Logs Recientes</h3>
                <table>
                    <thead><tr><th>Usuario</th><th>Acción</th><th>Descripción</th><th>Fecha</th></tr></thead>
                    <tbody>
                        <?php while($log = $logs->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($log['usuario_nombre'] ?? 'Sistema'); ?></td>
                            <td><?php echo htmlspecialchars($log['accion']); ?></td>
                            <td><?php echo htmlspecialchars($log['descripcion']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($log['fecha'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>