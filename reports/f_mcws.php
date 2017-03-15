<?php
/* DF_2: reports/f_mcws.php
report: dairy by cows
c: 25.12.2005
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$outsele_=-1;
$outsele_table=$_GET["select_table"];
$outsele_field=$_GET["select_field"];

include( "f_mt.php" );
?>
