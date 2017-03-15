<?php
/* DF_2: reports/f_lcws.php
report: cows
c: 05.05.2005
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];

$dontuse_period=1;
$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );
include( "../locales/$lang/f_05._$lang" );

$th[1]=$ged["To_Jagg"];
$th[2]=$_05_TOM_;
$th[3]=$ged["To_Restrict"];
$th[4]=$ged["Number"];
$th[5]=$ged["Nick"];
$th[6]=$ged["Lot"];
$th[7]=$ged["Group"];
$th[8]=$ged["Birthday"];
$th[9]=$ged["TAG"];
$th[10]=$ged["Comment."];

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */";
for ( $i=1; $i<=10; $i++ ) $_mod_rep_CSS_content=$_mod_rep_CSS_content."
	#rep_tbody td:nth-of-type(".$i."):before { content:\"".$th[$i]."\"; text-align:left; top:0; }";

include( "frhead.php" );

$temp=split( ":", $_GET["sele_byAge"] ); $sele_byAge_from=$temp[0]*1; $sele_byAge_to=$temp[1]*1;
$sele_byState_=$_GET["sele_byState"];
$cows_order_=$_GET["order_by"];

if ( $sele_byAge_to==0 ) $sele_byAge_to=99999;

$nocardsfilt=1; $nocardsctrls=1;//dont show cards filter, ctrls
include( "../dflib/f_tcws.php" );

ob_end_flush();
?>
