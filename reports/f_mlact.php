<?php
/* DF_2: reports/f_mlact.php
report: total milk by lactation
c: 09.06.2005
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$skip_echo=0;//to skip output of results and not graph mode

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

$lact_restr=$_GET["lact_restrict"]*1;//lactation number

$dontuse_filt=1;//IMPORTANT!
$dontuse_period=1;

include( "f_jfilt.php" );
include( "frhead.php" );

$vl=0; $cows_cnt=0; $t_sec=0;

$beg="1991-01-01";
$yf=intval( substr( $beg, 0, 4 )); $mf=intval( substr( $beg, 5, 2 )); $df=intval( substr( $beg, 8, 2 ));
$end=date('Y')."-12-31";
$yl=intval( substr( $end, 0, 4 )); $ml=intval( substr( $end, 5, 2 )); $dl=intval( substr( $end, 8, 2 ));

$yc=$yf; $mc=$mf; $dc=$df;

//get all needed opers [BEGIN]
include( "f_mlactc.php" );
//get all needed opers [END]

include( "f_mlactz.php" );

ob_end_flush();
?>
