<?php
/* DF_2: reports/f_mcws2.php
report: conductivity by cows, total for 7(8) days (AVIDA)
c: 10.09.2008
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$outsele_=-1; $outsele_table=''; $outsele_field=-1;

include( "f_mt2.php" );
?>
