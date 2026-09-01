<?php 

function info( $key ) {
	global $config;
	if ( isset( $config[ $key ] ) )
		echo $config[ $key ];
	else
		echo 'la clave no existe';

}

function get_info( $key ) {
	global $config;
	if ( isset( $config[ $key ] ) )
		return $config[ $key ];
	else
		return 'la clave no existe';
}
function getHomeURL() {
    return HTTP_SERVER . SITE_DIR;
}
function seeURL(){
    $myurl="http".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
return $myurl;
}
function alert($msg)
{
	echo '<script>alert("'.$msg.'");</script>';
}

function redirect($url)
{ 
	@header("location: ".$url);
    exit();
}
function simple_redirect($url) {

	echo "<script language=\"JavaScript\">";
    echo "window.location = \"" . $url . "\";\n";
    echo "</script>\n";

    return true;
}
function errorMessage($str) {
    return '<div style="width:50%; margin:0 auto; border:2px solid #F00;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function successMessage($str) {
    return '<div style="width:50%; margin:0 auto; border:2px solid #06C;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function referente(){
	if(preg_match("/localhost/",$_SERVER['HTTP_HOST']))
	{return preg_match("/localhost/",$_SERVER['HTTP_HOST']);#prueba localhost 
	}else{
	 return preg_match("/masprimicias\.com/",$_SERVER['HTTP_HOST']);#prueba servidor
	}
}
function logs($log)
{
	$fp = fopen("error_log.txt","a+");
	fwrite($fp,$log.PHP_EOL);
	fclose($fp);
} 

function _isset(&$v ){return isset($v) ? $v : NULL;}
function slug($str)
{
	$str = strtolower(trim(seo_url($str))); 
	$str = str_replace(" ","-",$str); 
	$str = preg_replace("/[^a-z0-9-]/","",$str);
	$str = str_replace("--","-",$str);
	$str = str_replace("--","-",$str);
	return $str;
}

function seo_url($vp_string){
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
	    $repl = array('a', 'e', 'i', 'o', 'u', 'n');
	    $vp_string = str_replace ($find, $repl, $vp_string);
	    $vp_string = str_replace(array('á','à','â','ã','ª'),"a",$vp_string);
	    $vp_string = str_replace(array('é','è','ê'),"e",$vp_string);
	    $vp_string = str_replace(array('í','ì','î'),"i",$vp_string);
	    $vp_string = str_replace(array('ò','ó','ô','õ','º'),"o",$vp_string);
	    $vp_string = str_replace(array('ú','ù','û'),"u",$vp_string);
	    $vp_string = str_replace(array('ç'),"c",$vp_string);
	    $vp_string = trim($vp_string);
	    $vp_string = html_entity_decode($vp_string);
	    $vp_string = strip_tags($vp_string);
	    $vp_string = strtolower($vp_string);
	    $vp_string = preg_replace('~[^ a-z0-9_.]~', ' ', $vp_string);
	    $vp_string = preg_replace('~ ~', '-', $vp_string);
	    $vp_string = preg_replace('~-+~', '-', $vp_string);        
	    $vp_string = str_replace('.', '', $vp_string);        
	    return $vp_string;
}
function images($i,$str)
{
    $img = (file_exists($i.'/'.$str.'.jpg')) ? URL.str_replace('../../','',$i).'/'.$str.'.jpg' : URL.'images/tv-default.jpg';

	return $img;
}

function sound_head()
{
	global $zegax; 
			$head = false;
			$zegax->header();
}
function sound_main()
{
	global $zegax; 
			$zegax->main();
}
function sound_secction()
{
	global $zegax; 
			$zegax->secction();
}
function sound_footer()
{
	global $zegax;
			$zegax->footer();
}
 
function is_ajax()
{
 	$flag = false;
 	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
       {
       		$flag = true;
       }
      return $flag;
        	
 }

function sendNoCacheHeaders() {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
}




?>