<?php
require_once 'config.php';

// Verificar si existe el usuario admin, si no crearlo
$conn = conectarDB();
$result = $conn->query("SELECT COUNT(*) as total FROM usuarios WHERE email = 'admin@sistema.com'");
$count = $result->fetch_assoc();

if ($count['total'] == 0) {
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO usuarios (nombre, email, password, rol, estado) 
                  VALUES ('Administrador', 'admin@sistema.com', '$hash', 'admin', 'activo')");
}

// Si ya está autenticado, redirigir
if (usuarioAutenticado()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Por favor, complete todos los campos';
    } else {
        $conn = conectarDB();
        $stmt = $conn->prepare("SELECT id, nombre, email, password, rol, estado FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user = $result->fetch_assoc()) {
            if ($user['estado'] === 'bloqueado') {
                $error = 'Usuario bloqueado. Contacte al administrador.';
            } elseif (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_rol'] = $user['rol'];
                
                // Actualizar último acceso
                $stmt = $conn->prepare("UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = ?");
                $stmt->bind_param("i", $user['id']);
                $stmt->execute();
                
                // Registrar login
                registrarLog($user['id'], 'login', 'Inicio de sesión');
                
                header('Location: index.php');
                exit;
            } else {
                $error = 'Contraseña incorrecta';
                registrarLog($user['id'] ?? 0, 'login_failed', 'Intento de login fallido');
            }
        } else {
            $error = 'Usuario no encontrado';
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #0052cc 0%, #0066ff 40%, #00c2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0,194,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .login-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        .login-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 45px 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15), 0 0 40px rgba(0,102,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 35px;
        }
        .login-logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0066ff, #0052cc);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 8px 25px rgba(0,102,255,0.3);
        }
        .login-logo-icon i {
            font-size: 30px;
            color: #fff;
        }
        .login-logo h1 {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }
        .login-logo p {
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #334155;
            font-size: 13px;
            margin-bottom: 8px;
            letter-spacing: 0.02em;
        }
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
            transition: color 0.3s;
        }
        .input-icon input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            color: #1e293b;
            background: #f8fafc;
            transition: all 0.3s;
        }
        .input-icon input:focus {
            outline: none;
            border-color: #0066ff;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0,102,255,0.1);
        }
        .input-icon input:focus + i,
        .input-icon input:focus ~ i {
            color: #0066ff;
        }
        .input-icon input::placeholder {
            color: #cbd5e1;
        }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #0066ff, #0052cc);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(0,102,255,0.3);
            margin-top: 5px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,102,255,0.4);
            background: linear-gradient(135deg, #0077ff, #0066ff);
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .error-message {
            background: #fef2f2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid #fecaca;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .success-message {
            background: #f0fdf4;
            color: #16a34a;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid #bbf7d0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .footer-login {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .footer-login p {
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.6;
        }
        .footer-login strong {
            color: #475569;
        }
        .version {
            text-align: center;
            font-size: 11px;
            color: #cbd5e1;
            margin-top: 12px;
        }
        .login-brand {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: rgba(255,255,255,0.7);
        }
        .login-brand a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        @media (max-width: 480px) {
            .login-card { padding: 30px 25px; border-radius: 16px; }
            .login-logo h1 { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-logo">
                <div class="login-logo-icon">
                    <i class="fas fa-network-wired"></i>
                </div>
                <h1><?php echo APP_NAME; ?></h1>
                <p>Sistema de Gesti&oacute;n FTTH</p>
            </div>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['created']) && $_GET['created'] == 1): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> Usuario creado correctamente. Inicia sesi&oacute;n.
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-icon">
                        <input type="email" name="email" placeholder="admin@sistema.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Contrase&ntilde;a</label>
                    <div class="input-icon">
                        <input type="password" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesi&oacute;n
                </button>
            </form>
            
            <div class="footer-login">
                <p><strong>Usuario:</strong> admin@sistema.com<br><strong>Contrase&ntilde;a:</strong> admin123</p>
            </div>
            <div class="version">
                v2.0.0 &mdash; Sistema en Producci&oacute;n
            </div>
        </div>
        <div class="login-brand">
            <a href="../">Latin Cable Per&uacute;</a>
        </div>
    </div>
</body>
</html>