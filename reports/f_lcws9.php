<?php
/* DF_2: reports/f_lcws9.php
report: cows tags
c: 20.01.2012
m: 14.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];

$outsele_=-1; $outsele_field=-1; $outsele_table=-1;

$full_tags=1;

include( "f_jfilt.php" );
include( "../locales/$lang/f_05._$lang" );
include( "frhead.php" );

$sele_byAge=$_GET["sele_byAge"]; $temp=split( ":", $sele_byAge ); $sele_byAge_from=$temp[0]*1; $sele_byAge_to=$temp[1]*1;
$sele_byState=$_GET["sele_byState"];
$cows_order_=$_GET["order_by"];

if ( $sele_byAge_to==0 ) $sele_byAge_to=99999;

$nocardsfilt=1; $nocardsctrls=1;//dont show cards filter, ctrls
include( "f_lcws0.php" );

ob_end_flush();
?>
