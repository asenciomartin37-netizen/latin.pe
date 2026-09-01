<?php

$modo = isset($_GET['modo']) && !empty($_GET['modo']) ? $_GET['modo'] : '';

$pages = [
    '404'                => ['titulo' => 'Pagina no encontrada',            'file' => 'libs/fileContent/404.php'],
    'planesduo'          => ['titulo' => 'Plan duos',                       'file' => 'libs/fileContent/planesduo.php'],
    'internetilimitado'  => ['titulo' => 'Internet Ilimitado',              'file' => 'libs/fileContent/internetilimitado.php'],
    'guiadecanales'      => ['titulo' => 'Guía de canales',                 'file' => 'libs/fileContent/guiadecanales.php'],
    'contacto'           => ['titulo' => 'Contacto',                        'file' => 'libs/fileContent/contacto.php'],
    'testdevelocidad'    => ['titulo' => 'Test De Velocidad',               'file' => 'libs/fileContent/testdevelocidad.php'],
    'tv'                 => ['titulo' => 'Tv ENVIVO',                       'file' => 'libs/fileContent/tv.php'],
    'formaspago'         => ['titulo' => 'Formas de Pago',                  'file' => 'libs/fileContent/formaspago.php'],
];

$page = $pages[$modo] ?? [
    'titulo' => 'Latin Cable Perú &#8211; Empresa de Telecomunicaciones',
    'file'   => 'libs/fileContent/Inicio.php'
];

$titulo      = $page['titulo'] . ' | ' . SITE;
$descripcion = $page['descripcion'] ?? $titulo;
$keywords    = $page['keywords'] ?? '';
$imagen      = URL . 'static/img/default.jpg';

define('CONTENT', $page['file']);
define('TITULO', $titulo);
define('DESCIPCION', $descripcion);
define('KEYWORDS', $keywords);
define('IMAGEN', $imagen);
