<?php
/* DF_2: reports/f_ltgs.php
report: free tags
c: 20.01.2012
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );
include( "../locales/$lang/f_05._$lang" );

$th1=$ged["Number"];
$th2=$ged["TAG"];

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1):before { content:\"".$th1."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th2."\"; text-align:left; top:0; }";
include( "frhead.php" );

$sele_byAge=$_GET["sele_byAge"]; $temp=split( ":", $sele_byAge ); $sele_byAge_from=$temp[0]*1; $sele_byAge_to=$temp[1]*1;
$sele_byState=$_GET["sele_byState"];
$cows_order_=$_GET["order_by"];

if ( $sele_byAge_to==0 ) $sele_byAge_to=99999;

$nocardsfilt=1; $nocardsctrls=1;//dont show cards filter, ctrls
include( "../dflib/f_ttgs.php" );

ob_end_flush();
?>
