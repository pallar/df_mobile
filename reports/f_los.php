<?php
/* DF_2: reports/f_los.php
report: oxes
c: 05.05.2005
m: 28.07.2015 */

ob_start();//lock output to set cookies properly!

$dontuse_period=1;
$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

$title_=$title=$_GET["title"];

include( "f_jfilt.php" );
include( "frhead.php" );

$nocardsfilt=1; $nocardsctrls=1;//dont show cards filter, ctrls
include( "../dflib/f_tos.php" );

ob_end_flush();
?>
