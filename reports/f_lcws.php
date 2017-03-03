<?php
/* DF_2: reports/f_lcws.php
report: cows
c: 05.05.2005
m: 20.07.2015 */

ob_start();//lock output to set cookies properly!

$title_=$title=$_GET["title"];

$dontuse_period=1;
$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );
include( "../locales/$lang/f_05._$lang" );
include( "frhead.php" );

$temp=split( ":", $_GET["sele_byAge"] ); $sele_byAge_from=$temp[0]*1; $sele_byAge_to=$temp[1]*1;
$sele_byState_=$_GET["sele_byState"];
$cows_order_=$_GET["order_by"];

if ( $sele_byAge_to==0 ) $sele_byAge_to=99999;

$nocardsfilt=1; $nocardsctrls=1;//dont show cards filter, ctrls
include( "../dflib/f_tcws.php" );

ob_end_flush();
?>
