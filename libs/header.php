<?php
session_name('zegax');
session_start();
require_once( "functions/config.php" );
require_once( "functions/functions.inc.php" );
require_once( "functions/sound.class.php" );

$zegax = new Sound($config);

?>