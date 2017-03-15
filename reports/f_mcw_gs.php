<?php
/* DF_2: reports/f_mcw_gs.php
report: dairy by breeds/groups/subgroups/lots
c: 25.12.2005
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

//DONT USE IN "$outsele_table" VARIABLES. THEY ARENT READY YET
$outsele_=1;
//$outsele_table="f_groups";
//$outsele_field="c.gr_id";
$outsele_table=$_GET["select_table"];
$outsele_field=$_GET["select_field"];

include( "f_mt.php" );
?>
