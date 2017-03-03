<?php
/* DF_2: reports/f_mcws.php
report: dairy by cows
c: 25.12.2005
m: 20.07.2015 */

ob_start();//lock output to set cookies properly!

$outsele_=-1;
$outsele_table=$_GET["select_table"];
$outsele_field=$_GET["select_field"];

include( "f_mt.php" );
?>
