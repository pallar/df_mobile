<?php
/* DF_2: oper/f_o_.php
one cow operations
c: 10.07.2011
m: 01.04.2015 */

ob_start();//lock output to set cookies properly!

switch ( $opertype ) {
case 1:
	$url_="mlk";
	break;
case 2:
	$url_="mlkt";
	break;
case 4:
	$url_="meas";
	break;
case 8:
	$url_="care";
	break;
case 16:
	$url_="cond";
	break;
case 32:
	$url_="vacc";
	break;
case 64:
	$url_="mov";
	break;
case 128:
case 256:
	$url_="insm";
	break;
case 512:
	$url_="rect";
	break;
case 1024:
	$url_="abrt";
	break;
case 2048:
	$url_="abrt";
	break;
case 4096:
	$url_="abrt";
	break;
case 8192:
	$url_="jagg";
	break;
}
include_once( "../oper/f_o_".$url_.".php" );

ob_end_flush();//unlock output!
?>
