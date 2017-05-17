<?php
/* DF_2: reports/f_mlact.php
report: total milk by lactation
c: 09.06.2005
m: 16.05.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$skip_echo=0;//to skip output of results and not graph mode

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

$lact_restr=$_GET["lact_restrict"]*1;//lactation number

$dontuse_filt=1;//IMPORTANT!
$dontuse_period=1;

include( "f_jfilt.php" );

$th1=$ged["Number"];
$th2=$ged["Nick"];
$th3=$ged["Starting"];
$th4=$ged["Ending"];
$th5=$ged["Lact._days"];
$th6=$ged["Avg."];
$th7=$ged["Total"];
$th8="1..305";
$th9="1..50";
$tha="51..100";
$thb="101..150";
$thc="151..200";
$thd="201..250";
$the="251..300";
$thf="301..350";
$thg="351..";
$thh=$ged["Predict~"];

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1) { background:#ddd; }
	#rep_tbody td:nth-of-type(1):before { content:\"".$th1."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th2."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th3."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(4):before { content:\"".$th4."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(5):before { content:\"".$th5."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(6):before { content:\"".$th6."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(7):before { content:\"".$th7."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(8):before { content:\"".$th8."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(9):before { content:\"".$th9."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(10):before { content:\"".$tha."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(11):before { content:\"".$thb."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(12):before { content:\"".$thc."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(13):before { content:\"".$thd."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(14):before { content:\"".$the."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(15):before { content:\"".$thf."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(16):before { content:\"".$thg."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(17):before { content:\"".$thh."\"; text-align:left; top:0; }";

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
