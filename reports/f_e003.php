<?php
/* DF_2: reports/f_e003.php
report: dairy by cows
c: 14.03.2011
m: 08.07.2015 */

ob_start();//lock output to set cookies properly!

$outsele_=-1;
$outsele_table="f_cows";
$outsele_field="c.cow_id";
$outsele_table=$_GET[select_table];
$outsele_field=$_GET[select_field];

include( "f_e003mt.php" );
?>
