<?php
function canales_analogicos($group) {
	global $PDO;
	$rs = array();
	$sql = "SELECT " . TABLE_GRILLA . ".id,
                   " . TABLE_GRILLA . ".numer,
                   " . TABLE_GRILLA . ".channel,
				   " . TABLE_GRILLA . ".channel_name FROM " . TABLE_GRILLA . " WHERE channel = '" . $group . "' ORDER BY id ASC";

	try {
		$stmt = $PDO->prepare( $sql );
		//$stmt->bindValue();
		$stmt->execute();
		$results = $stmt->fetchAll();
	} catch ( Exception $ex ) {
		echo errorMessage( $ex->getMessage() );
	}

	if ( count( $results ) > 0 ) {

		foreach ( $results as $rs ) {
			 $hd = '';
			 if($rs[ 'channel' ] == "Digital"){
                 $hd = "<span>hd</span>";
             }
            echo '<li>' . $hd . '<div><img class="img" src="'.images('images/canales-tv',slug(mb_strtolower(str_replace(' HD','',$rs[ 'channel_name' ]), 'UTF-8'))).'" alt=""></div><h4>' . $rs[ "channel_name" ] . '</h4></li>';


		}
	}
}


?>