<?php
/* DF_2: reports/f_mcws1.php
report: extracting by cows, total for 7(8) days (AVIDA), relative
c: 10.09.2008
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

$filt_percent=$_GET["filt_percent"]*1;
$min_percent=$_GET["min_percent"]*1;

include( "f_mt3.php" );
?>
