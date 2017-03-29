<?php
ob_start();

$skip_W3C_DOCTYPE=1;
$skip_PASSW=1;

$get_lang=$_GET["lang"];
$demo=$_GET["demo"]*1;
include_once( "f_vars.php" );
if ( strlen( $get_lang )>=2 ) {
	$lang=$get_lang;
	include_once( "setup/f_upd".$lang.".php");
	CookieSet( "_lang", $lang );
}
CookieSet( "_demo", $demo );

ob_end_flush();

echo "
<html>
<head>
<meta content='0;url=forms/index.php?demo=".$demo."' http-equiv='refresh'>
<meta content='text/html;charset=utf-8' http-equiv='content-type'>
</head>
</html>";
?>
