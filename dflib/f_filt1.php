<?php
/* DF_2: dflib/f_filt1.php
filter: filter for group (read/write)
c: 27.03.2011
m: 01.04.2015 */

$_filtsX=CookieGet( $_filtsXmode."_filts1" );
if ( strlen( $_filtsX )<3 ) {
	$_filtsX="-1%-1%-1%-1";
	$_filts1=-1;
	$_filts2=-1;
	$_filts3=-1;
	$_filts4=-1;
} else {
	$_filtsX=split( "%", $_filtsX );
	$_filts1=$_filtsX[0]*1;
	$_filts2=$_filtsX[1]*1;
	$_filts3=$_filtsX[2]*1;
	$_filts4=$_filtsX[3]*1;
}
$filts1=$_filts1;
$filts2=$_filts2;
$filts3=$_filts3;
$filts4=$_filts4;
?>
