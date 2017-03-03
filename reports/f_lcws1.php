<?php
/* DF_2: reports/f_lcws1.php
report: cows last measuring results
c: 27.02.2007
m: 08.07.2015 */

ob_start();//lock output to set cookies properly!

$title_=$_GET[title];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );
include( "frhead.php" );

$rows_cnt=0; $cows_cnt=0;
$outsele_=4;

$_GET[sele_byAge]; $temp=split( ":", $sele_byAge ); $sele_byAge_from=$temp[0]; $sele_byAge_to=$temp[1];
$_GET[sele_byState]; $sele_byState_=$sele_byState;
$_GET[order_by]; $cows_order_=$order_by;
if ( strlen( $cows_order_ )<=0 ) $cows_order_="$cows.cow_num*1";

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;
$dbt="000000_o";
include( "f_jselo.php" );
if ( $sqlerr==0 ) { while ( $row=mysql_fetch_row( $res )) {
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
<table class='st2'>
<tr $cjust class='st_title2' style='height:28px'>
	<td><b>".$ged["Number"]."</b></td>
	<td><b>".$ged["Nick"]."</b></td>
	<td><b>".$ged["Depth,Chest"]."</b></td>
	<td><b>".$ged["Width,Chest"]."</b></td>
	<td><b>".$ged["Diam.,Chest"]."</b></td>
	<td><b>".$ged["Height"]."</b></td>
	<td><b>".$ged["Width,Shoulder-blade"]."</b></td>
	<td><b>".$ged["Slant._Len."]."</b></td>
	<td><b>".$ged["Diam.,Wrist."]."</b></td>
	<td><b>".$ged["Brutto"]."</b></td>
	<td><b>".$ged["Exter._Defects"]."</b></td>
</tr>";

$sqlquery="SELECT
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
$res=mysql_query( $sqlquery, $db );
while ( $row=mysql_fetch_row( $res )) {
	$r=$row[0];
	$cwnum=$cownum_div.$row[1].$cownum_div1;
//	$cwbddmY=substr( $row[5], 8, 2 ).".".substr( $row[5], 5, 2 ).".".substr( $row[5], 0, 4 );
//	$cwage=DaysBetween( $birthday, $now_dmY );
	if ( $rs==0 ) $rs=1; else $rs=0;
	RepTr( $rs );
	echo "
	<td $rjust onmouseover='style.cursor=\"pointer\"'><b><a href='../".$hFrm['0520']."?cow_id=".$r."&ret0=00'>".$cwnum."</b></td>
	<td>$row[2]&nbsp;</td>";
	for ( $x=1; $x<=8; $x++ ) echo "
	<td $rjust>".$data[$x][$r]."&nbsp;</td>";
	echo "
	<td>$row[6]</td>
</tr>";
	$cows_cnt++;
}

echo "
<tr class='st_title2' style='height:28px'>
	<td $cjust><b>".$ged['TOTAL'].":</b></td>
	<td $rjust><b>".$cows_cnt."&nbsp;</b></td>";
for ( $x=2; $x<=10; $x++ ) echo "
	<td><b>&nbsp;</b></td>";
echo "
</tr>
</table><br>";

ob_end_flush();
?>
