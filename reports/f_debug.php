<?php
/* DF_2: reports/f_debug.php
report: log
c: 17.07.2015
m: 23.07.2015 */

$skip_clichk=1;

ob_start();//lock output to set cookies properly!

$title_=$title="DEBUG";

include( "f_jfilt.php" );
include( "frhead.php" );
include( "../locales/$lang/f_rrm._$lang" );
include( "../dflib/f_filt1.php" );

$trows=0;

echo "
<table>
<tr $cjust style='height:28px'>
	<td width='80px'><b>".$ged['Date']."</b></td>
	<td width='80px'><b>".$ged['Time']."</b></td>
	<td width='35px'><b>Dev.</b></td>
	<td width='35px'><b>Cmd</b></td>
	<td><b>Data</b></td>";
echo "
</tr>";

if ( $df<10 ) $df="0".$df;
if ( $mf<10 ) $mf="0".$mf;
$Ymd1=$yf."-".$mf."-".$df;
if ( $dl<10 ) $dl="0".$dl;
if ( $ml<10 ) $ml="0".$ml;
$Ymd2=$yl."-".$ml."-".$dl;

$query="SELECT
 modif_Ymd,
 modif_His,
 dev_num, cmd, data
 FROM $debug_log
 WHERE modif_Ymd>='$Ymd1' AND modif_Ymd<='$Ymd2'";
if ( $bd_first>0 & $bd_last>0 ) $query.="
 AND dev_num>=$bd_first AND dev_num<=$bd_last";
$res=mysql_query( $query, $db );
if ( mysql_errno()<1 ) { while ( $row=mysql_fetch_row( $res )) {
	echo "
<tr $cjust>
	<td><b>".$row[0]."</b></td>
	<td><b>".$row[1]."</b></td>
	<td><b>".$row[2]."</b></td>
	<td><b>".$row[3]."</b></td>
	<td $ljust><b>&nbsp;".$row[4]."</b></td>
</tr>";
}}

echo "</table>
</body>
</html>";

ob_end_flush();
?>
