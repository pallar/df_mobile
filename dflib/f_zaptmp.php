<?php
/* DF_2: dflib/f_zaptmp.php
c: 11.09.2009
m: 30.06.2015 */

$now_Ymd=date( "Y-m-d" );
$res=mysql_query( "SELECT var_name, created_date FROM $vars WHERE var_valuetype='varchar' AND var_name LIKE 'tmp_%'" );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) { while ( $row=mysql_fetch_row( $res )) {
	if ( $row[1]<$now_Ymd ) {
		$t1=$row[0];
		$t2=$row[0]."c";
		$t3=$row[0]."o";
		Sql_query( "DROP TABLE IF EXISTS $t1" );
		Sql_query( "DROP TABLE IF EXISTS $t2" );
		Sql_query( "DROP TABLE IF EXISTS $t3" );
		Sql_query( "DELETE FROM $vars WHERE var_name='$row[0]'" );
	}
}}
?>
