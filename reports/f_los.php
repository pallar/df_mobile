<?php
/* DF_2: reports/f_los.php
report: oxes
c: 05.05.2005
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];
if ( strlen( $title_ )<=1 ) $title_="";

$dontuse_period=1;
$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );

include( "frhead.php" );

$nocardsfilt=1; $nocardsctrls=1;//dont show cards filter, ctrls
include( "../dflib/f_tos.php" );

ob_end_flush();
?>
