<?php

// display all error except deprecated and notice  
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
// turn on output buffering 
ob_start();

/*
if you make login section for admin 
use session here otherwise no need
session_start();
*/

require_once("constants.php");
require_once("common_functions.php");

/*
 * apague el soporte de comillas mágicas, para el tiempo de ejecución e, ya que causará problemas si está habilitado
 */
if (version_compare(PHP_VERSION, 5.3, '<') && function_exists('set_magic_quotes_runtime')) set_magic_quotes_runtime(0);

// establecer currentPage en el ámbito local
$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);


// opciones básicas para PDO 
$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => FALSE,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
);

//conectarse con el servidor
//conectarse con el servidor
try {
 $dsn = DB_DRIVER . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE . ';charset=utf8mb4';
    $PDO = new PDO($dsn, DB_HOST_USERNAME, DB_HOST_PASSWORD, $dboptions);
} catch (Exception $ex) {
    // Esto imprimirá el error real en crudo directamente en la pantalla
    echo "<h2>Error detectado en la conexión:</h2>";
    echo "<p style='color:red; font-size:18px;'>" . $ex->getMessage() . "</p>";
    die;
}


?>
