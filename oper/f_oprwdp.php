<?php
/* DF_2: oper/f_oprwdp.php
group operations rewind menu preparing ([OP]erations [R]e[W]in[D] menu)
c: 25.05.2006
m: 19.05.2017 */

$opertype=$_GET["opertype"];
include( "../oper/f_opname.php" );

if ( $nosession!=1 ) $title_=$php_mm["_06_tip"]." ".$inserted_opername;
else $title_=$php_mm["_06_edit_tip"]." ".$inserted_opername;

$op_d1=date( d ); $op_m1=date( m ); $op_y1=date( Y );
$modif_Ymd=$op_y1."-".$op_m1."-".$op_d1; $modif_His=date( "H:i:s" );

$local_id=CookieGet( "_id" );
if ( empty( $local_id )) return;
if ( empty( $dbt_ext )) return;
if ( empty( $sess_id )) return;

if ( $varsession!=1 ) {
	$tmpdbt="tmp".$dbt_ext.$sess_id;
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	if ( $dbt_ext=="_o" ) Toper_create( $tmpdbt ); else Tmilk_create( $tmpdbt );
}

//store current session data [BEGIN]
$sess_name="sess_".$sess_id;
session_id( $sess_id ); session_name( $sess_name );
$v_name=$sess_name;
Var_ToDb( "session", $v_name, $sess_id, $userCoo );
//store current session data [END]
?>
