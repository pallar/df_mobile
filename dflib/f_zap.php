<?php
/* DF_2: dflib/f_zap.php
zap prev data (date & sessions)
c: 30.03.2007
m: 15.06.2015 */

ob_start();//lock output to set cookies properly!

$query="SELECT var_name FROM $vars WHERE var_valuetype<>'session'";
$res=mysql_query( $query ); $sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	while ( $row=mysql_fetch_row( $res )) {
		$v_name=$row[0];
		if ( strlen( $v_name )<30 )
			mysql_query( "DELETE FROM $vars WHERE var_name='$v_name'" );
	}
	mysql_free_result( $res );
}

$query="SELECT var_name, var_value, var_uid, modif_date FROM $vars WHERE var_valuetype='session'";
$res=mysql_query( $query ); $sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	while ( $row=mysql_fetch_row( $res )) {
		$v_name=$row[0]; $_sid=$row[1]; $_smodif=$row[3];
		if ( $_smodif<$now_Ymd ) {
			$_sname="sess_".$_sid;
			mysql_query( "DELETE FROM $vars WHERE var_name='$v_name'", $db );
			$_sdbt=trim( "tmp_m".$_sid ); mysql_query( "DROP TABLE IF EXISTS $_sdbt" );
			$_sdbt=trim( "tmp_o".$_sid ); mysql_query( "DROP TABLE IF EXISTS $_sdbt" );
			$_sdbt=trim( "tmp".$_sid ); mysql_query( "DROP TABLE IF EXISTS $_sdbt" );
			session_id( $_sid ); session_name( $_sname );
			session_start();
			session_destroy();
		}
	}
	mysql_free_result( $res );
}

$query="SELECT var_name, var_value, var_uid, modif_date FROM $vars WHERE var_valuetype='date' AND var_value='--'";
$res=mysql_query( $query ); $sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	while ( $row=mysql_fetch_row( $res )) {
		$v_name=$row[0];
		mysql_query( "DELETE FROM $vars WHERE var_name='$v_name'", $db );
	}
	mysql_free_result( $res );
}

$query="SHOW TABLES LIKE 'tmp%'";
$res=mysql_query( $query, $db ); $sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	while ( $row=mysql_fetch_row( $res )) {
		$_sdbt=$row[0];
		$v_name=substr( $_sdbt, 5, strlen( $_sdbt )-4 );
		$query1="SELECT var_value FROM $vars WHERE var_valuetype='session' AND var_value='$v_name'";
		$res1=mysql_query( $query1, $db ); $sqlerr=mysql_errno();
		if ( $sqlerr==0 ) {
			$row1=mysql_fetch_row( $res1 );
			$v_name1=$row1[0];
			mysql_free_result( $res1 );
		} else $v_name1="";
		if ( $v_name!=$v_name1 ) mysql_query( "DROP TABLE IF EXISTS $_sdbt" );
	}
	mysql_free_result( $res );
}

ob_end_flush();
?>
