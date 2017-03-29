<?php
/* DF_2: oper/f_oprwdp.php
group operations rewind menu preparing ([OP]erations [R]e[W]in[D] menu)
c: 25.05.2006
m: 11.11.2015 */

include( "../f_vars.php" );
include( "../locales/$lang/f_prep._$lang" );
include( "../locales/$lang/f_php._$lang" );
include( "../locales/$lang/f_sel._$lang" );
include( "../locales/$lang/f_06._$lang" );
include( "../dflib/f_func.php" );
include( "../dflib/f_lib1.php" );
include( "../dflib/f_librep.php" );

$f_chcws_php=$_GET["f_chcws_php"];
$opertype=$_GET["opertype"];
include( "../oper/f_opname.php" );

if ( $nosession!=1 ) $title_=$php_mm["_06_tip"]." ".$inserted_opername;
else $title_=$php_mm["_06_edit_tip"]." ".$inserted_opername;

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) $body_="<body onload='App_Login(); App_OnStart();' onkeypress='App_HotKeys();' oncontextmenu='return false;'>";
else {
	$body_onload="App_Login(); App_OnStart();";
	if ( $div_hide!=1 ) $body_onload=$body_onload." cal_nowdayslist(); cal_fromcoo(); table_dates();";
	$body_="<body onload='$body_onload' onkeypress='App_HotKeys();' oncontextmenu='return false;' onmousedown='cn( this, event );'>";
}
MainMenu( "$title_", "opers", "$body_");

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
