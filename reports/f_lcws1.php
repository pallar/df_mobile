<?php
/* DF_2: reports/f_lcws1.php
report: cows last measuring results
c: 27.02.2007
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );

$th1=$ged["Number"];
$th2=$ged["Nick"];
$th3=$ged["Depth,Chest"];
$th4=$ged["Width,Chest"];
$th5=$ged["Diam.,Chest"];
$th6=$ged["Height"];
$th7=$ged["Width,Shoulder-blade"];
$th8=$ged["Slant._Len."];
$th9=$ged["Diam.,Wrist."];
$th10=$ged["Brutto"];
$th11=$ged["Exter._Defects"];

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1):before { content:\"".$th1."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th2."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th3."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(4):before { content:\"".$th4."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(5):before { content:\"".$th5."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(6):before { content:\"".$th6."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(7):before { content:\"".$th7."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(8):before { content:\"".$th8."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(9):before { content:\"".$th9."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(10):before { content:\"".$th10."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(11):before { content:\"".$th11."\"; text-align:left; top:0; }";

include( "frhead.php" );

$rows_cnt=0; $cows_cnt=0;
$outsele_=4;

$sele_byAge=$_GET["sele_byAge"]; $temp=split( ":", $sele_byAge ); $sele_byAge_from=$temp[0]; $sele_byAge_to=$temp[1];
$sele_byState=$_GET["sele_byState"];
$cows_order_=$_GET["order_by"];
if ( strlen( $cows_order_ )<1 ) $cows_order_="$cows.cow_num*1";

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;
$dbt="000000_o";
include( "f_jselo.php" );
if ( $error==0 ) { while ( $row=mysql_fetch_row( $res )) {
	$yc1=$row[3]*10000; $mc1=$row[2]*100;//all opers in one table
	$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;
	$r=$row[0]*1;
	$data[1][$r]=$row[7];
	$data[2][$r]=$row[8];
	$data[3][$r]=$row[9];
	$data[4][$r]=$row[10];
	$data[5][$r]=$row[11];
	$data[6][$r]=$row[12];
	$data[7][$r]=$row[13];
	$data[8][$r]=$row[14];
} mysql_free_result( $res ); }

echo "
<table>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th><b>".$th1."</b></td>
	<th><b>".$th2."</b></td>
	<th><b>".$th3."</b></td>
	<th><b>".$th4."</b></td>
	<th><b>".$th5."</b></td>
	<th><b>".$th6."</b></td>
	<th><b>".$th7."</b></td>
	<th><b>".$th8."</b></td>
	<th><b>".$th9."</b></td>
	<th><b>".$th10."</b></td>
	<th><b>".$th11."</b></td>
</tr>
</thead>
<tbody id='rep_tbody'>";

$sql_query="SELECT
 $cows.id,
 $cows.cow_num, $cows.nick,
 $cows.national_descr, $cows.b_num,
 $cows.b_date,
 $cows.defects, $cows.comments,
 $breeds.nick, $groups.nick, $subgrs.nick, $lots.nick,
 mother.nick, $oxes.nick
 FROM $cows, $oxes, $cows mother, $breeds, $groups, $lots, $subgrs
 WHERE $oxes.id=$cows.fth_id AND
 mother.id=$cows.mth_id AND
 $breeds.id=$cows.breed_id AND
 $groups.id=$cows.gr_id AND
 $lots.id=$cows.lot_id AND
 $subgrs.id=$cows.subgr_id
 ORDER BY ".$cows_order_;
$res=mysql_query( $sql_query, $db );
while ( $row=mysql_fetch_row( $res )) {
	$r=$row[0];
	$cwnum=$cownum_div.$row[1].$cownum_div1;
//	$cwbddmY=substr( $row[5], 8, 2 ).".".substr( $row[5], 5, 2 ).".".substr( $row[5], 0, 4 );
//	$cwage=DaysBetween( $birthday, $now_dmY );
	echo "
<tr $cjust>
	<td $rjust onmouseover='style.cursor=\"pointer\"'><b><a href='../".$hFrm['0520']."?cow_id=".$r."&ret0=00'>".$cwnum."</b></td>
	<td>".$row[2]."&nbsp;</td>";
	for ( $x=1; $x<=8; $x++ ) echo "
	<td $rjust>".$data[$x][$r]."&nbsp;</td>";
	echo "
	<td>".$row[6]."&nbsp;</td>
</tr>";
	$cows_cnt++;
}

echo "
</tbody>
<tfoot id='rep_tfoot'>
<tr $rjust height='28px'>
	<td $cjust><b>".$ged["TOTAL"].":</b></td>
	<td><b>".$cows_cnt."&nbsp;</b></td>";
for ( $x=2; $x<=10; $x++ ) echo "
	<td><b>&nbsp;</b></td>";
echo "
</tr>
</tfoot>
</table><br>";

ob_end_flush();
?>
