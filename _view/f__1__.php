<?php
/* DF_ajs: _view/f__1__.php
c: 25.12.2005
m: 14.11.2015 */

$skip_W3C_DOCTYPE=1;

$ANGULAR_IS_USED=1;

include( "../f_vars.php" );
include( "../locales/$lang/f_php._$lang" );
include( "../locales/$lang/f_devs._$lang" );
include( "../locales/$lang/f_00._$lang" );
include( "../locales/$lang/f_rrm._$lang" );
include( "../dflib/f_func.php" );
include( "../dflib/f_librep.php" );

require_once "../dflib/ajax/jshttprq.php";
$JsHttpRequest=&new JsHttpRequest( $contentCharset );

$devs_ok=0;
$res=mysql_query( "SELECT SUM( modif_uid ) FROM $parlor WHERE
 dev_status_='a' OR dev_status_='x' OR dev_status_='i' OR
 dev_status_='m' OR dev_status_='r' OR dev_status_='t' OR
 dev_status_='w' OR dev_status_='s' OR dev_status_='o'" );
$row=mysql_fetch_row( $res );
$devs_ok=$row[0]*1;
$dev_1st=CookieGet( "dev_1st" )*1; if ( $dev_1st==0 ) $dev_1st=1;
$res=mysql_query( "SELECT totaldevs, halt_timeout, transact FROM $globals" );
$row=mysql_fetch_row( $res );
$devs=$row[0]*1; CookieSet( "devs", "$devs" ); $powermode=$row[1]*1; $trans=$row[2];
if ( $powermode<=-2 ) {
	$powermode=$php_mm["_00_power_ctrloff_"];
	$powermode_title=$php_mm["_00_power_ctrloff_tip"];
} else if ( $powermode==-1 ) {
	$powermode=$php_mm["_00_power_ok_"];
	$powermode_title=$php_mm["_00_power_ok_tip"];
} else if ( $powermode>=0 ) {
	$powermode="<font color='#aa0000'>".$php_mm["_00_power_absent_"]."&nbsp;".$powermode."</font>";
	$powermode_title=$php_mm["_00_power_absent_tip"];
}
?>
