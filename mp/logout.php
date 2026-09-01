<?php
require_once 'config.php';

if (usuarioAutenticado()) {
    registrarLog($_SESSION['user_id'], 'logout', 'Cierre de sesión');
}

$_SESSION = array();
session_destroy();

header('Location: login.php');
exit;
?>