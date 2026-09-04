<?php

/*CONFIG DB **/
// prefijo de base de datos si usa
define( 'DB_PREFIX', 'latin_' );
define( 'DB_DRIVER', 'mysql' );

$http_host = $_SERVER[ "HTTP_HOST" ];
$is_local = ( $http_host == 'localhost' || preg_match('/^192\.168\./', $http_host) || preg_match('/^10\./', $http_host) || preg_match('/^172\.(1[6-9]|2[0-9]|3[01])\./', $http_host) );

if ( $is_local ) {
    // Usar ruta relativa para que funcione desde cualquier dispositivo en la red
    define( 'HTTP_SERVER', 'http://' . $http_host . '/' );
    define( 'SITE_DIR', 'latin.pe/' );
} else {
    // ✅ CORREGIDO: Apunta directamente a tu enlace real de la página
    define( 'HTTP_SERVER', 'https://latin-pe.onrender.com' );
    define( 'SITE_DIR', '/' );
}

// ✅ CONEXIÓN DIRECTA CORREGIDA PARA AIVEN
define("DB_HOST", "latin-db-asenciomartin37-f92d.aivencloud.com;port=27821"); 
define("DB_DATABASE", "defaultdb");
define("DB_HOST_USERNAME", "avnadmin");
define("DB_HOST_PASSWORD", "AVNS_DhhuOmzbjqynT7caMbc"); 

define( 'URL', HTTP_SERVER . SITE_DIR );
define( 'SITE', 'LATIN.PE' );

// entorno: development muestra errores detallados, production oculta datos sensibles
define( 'ENVIRONMENT', ( $is_local ) ? 'development' : 'production' );

$config[ 'site' ] = SITE;
$config[ 'url' ] = HTTP_SERVER . SITE_DIR;
$config[ 'css' ] = HTTP_SERVER . SITE_DIR . 'css/';
$config[ 'js' ] = HTTP_SERVER . SITE_DIR . 'js/';
$config[ 'logo' ] = HTTP_SERVER . SITE_DIR . 'images/';
$config[ 'favicons' ] = HTTP_SERVER . SITE_DIR . 'images/favicon/';
$config[ 'images' ] = HTTP_SERVER . SITE_DIR . 'images/';
$config[ 'files' ] = 'libs/';

// definir tablas de bases de datos
define( 'TABLE_GRILLA', DB_PREFIX . 'canales' );

// Numero de resultados para paginador
define( 'item_per_page', '15' );

?>
