<?php
/* DF_2: f_clichk.php
init: check browser js & cookies support
c: 04.06.2008
m: 07.04.2017 */

ob_start();

$appDir="";
$tmp_phpself=$PHP_SELF; $tmp_phpselfpos=0; $tmp_slashlevel=0;
if ( trim( $tmp_phpself."." )=="." ) $tmp_phpself=$_SERVER["PHP_SELF"];
if ( trim( $tmp_phpself."." )=="." ) {
	echo "<h1>YOUR WEB SERVER DOES NOT SUPPORT 'PHP_SELF' FUNCTION!</h1>";
	return;
}
while ( $tmp_slashlevel<2 ) {
	$tmp_char=substr( $tmp_phpself, $tmp_phpselfpos, 1 );
	if ( $tmp_char=="/" ) $tmp_slashlevel++;
	$appDir=$appDir.$tmp_char;
	$tmp_phpselfpos++;
}
?>
