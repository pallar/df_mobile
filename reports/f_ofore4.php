<?php
/* DF_2: reports/f_ofore4.php
report: extracting
c: 16.05.2011
m: 14.03.2017 */

$skip_clichk=1;

ob_start();//lock output to set cookies properly!

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];
if ( strlen( $title_ )<=1 ) $title_=$php_mm["_01_tab1_"];

$restrict_by_field=$_GET["restrict_by_field"]*1;
$restrict_field=$_GET["restrict_field"];
$restrict_id=$_GET["restrict_id"]*1;

$dontuse_period=3;
$dontuse_filt=1;//ONLY IN THIS REPORT

include( "f_jfilt.php" );
include( "frhead.php" );
include( "../locales/$lang/f_rrm._$lang" );
include( "../locales/$lang/f_cows._$lang" );
include( "../locales/$lang/f_rroerr._$lang" );
include( "../dflib/f_filt1.php" );

if ( $restrict_id==0 ) {
	if ( $filts1>-1 ) {
		$restrict_by_field=1;
		$restrict_field="d.gr_id";
		$restrict_id=$filts1*1;
	}
	if ( $filts2>-1 ) {
		$restrict_by_field=1;
		$restrict_field="d.lot_id";
		$restrict_id=$filts2*1;
	}
}

$rows_cnt=0; $vl=0;
$dots_cnt=0;

if ( $graph<1 ) {
	echo "
<table cellspacing='1' class='st2' style='width:100%'>
<tr $cjust class='st_title2' style='height:28px'>
	<td rowspan='2' width='1%'><b>".$ged['Month']."</b></td>
	<td rowspan='2' width='1%'><b>".PhraseCarry( $ged['Milk'].",".$ged['kg'], ",", 1 )."</b></td>
	<td rowspan='2' width='1%'><b>".PhraseCarry( $ged["Average:Animal"].",".$ged['kg'], ",", 1 )."</b></td>
	<td rowspan='2' width='1%'><b>".$ged["Animals"]."</b></td>
	<td colspan='3'><b>".$ged["Ages_groups"]."</b></td>
	<td colspan='3'><b>".$ged["Aborts"]."</b></td>
	<td rowspan='2' width='1%'><b>".$ged["Zapusks"]."</b></td>
</tr>
<tr $cjust class='st_title2' style='height:28px'>
	<td width='1%'><b>".$ged["Neteli"]."<br>(".$insem1st_days0."..".$not_abort1st_days0."&nbsp;".$ged["days"].")</b></td>
	<td width='1%'><b>".$ged["Cows"]."<br>(>".$not_abort1st_days0."&nbsp;".$ged["days"].")</b></td>
	<td width='1%'><b>".$ged["Total"]."</b></td>
	<td width='1%'><b>".$ged["Neteli"]."<br>(".$insem1st_days0."..".$not_abort1st_days0."&nbsp;".$ged["days"].")</b></td>
	<td width='1%'><b>".$ged["Cows"]."<br>(>".$not_abort1st_days0."&nbsp;".$ged["days"].")</b></td>
	<td width='1%'><b>".$ged["Total"]."</b></td>";
	echo "
</tr>";
}

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;

if ( $df<10 ) $date1="0"; $date1=$date1.$df."-";
if ( $mf<10 ) $date1=$date1."0"; $date1=$date1.$mf."-";
$date1=$date1.$yf;
if ( $dl<10 ) $date2="0"; $date2=$date2.$dl."-";
if ( $ml<10 ) $date2=$date2."0"; $date2=$date2.$ml."-";
$date2=$date2.$yl;

$query1="SELECT id, b_date, z_dates FROM $cows";
$res1=mysql_query( $query1, $db ); $sqlerr1=mysql_errno();
if ( $sqlerr1==0 ) { while ( $row1=mysql_fetch_row( $res1 )) {
	$cows_b_dmY[$row1[0]]=substr( $row1[1], 8, 2 ).".".substr( $row1[1], 5, 2 ).".".substr( $row1[1], 0, 4 );
	$cows_z_Ymd[$row1[0]]=$row1[2];
	$yc1=$yf; $mc1=$mf;
	while ( $yc1*100+$mc1<=$yl*100+$ml ) {
		$yc1z=Int2StrZ( $yc1, 4 ); $mc1z=Int2StrZ( $mc1, 2 );
		$dbt=$yc1z.$mc1z."_m";
		$ctrl_dmY="28.".$mc1z.".".$yc1z; $ctrl_Ymd=$yc1z."-".$mc1z."-28";
		if ( $cows_marked[$dbt][$row1[0]]==0 ) {
			$cows_marked[$dbt][$row1[0]]=1;
			if ( $cows_z_Ymd[$row1[0]]>$ctrl_Ymd | $cows_z_Ymd[$row1[0]]=='' ) {
				$t=DaysBetween( $cows_b_dmY[$row1[0]], $ctrl_dmY );
				if ( $t>0 ) {
					if ( $t<=$insem1st_days0 ) $cnt_telyci_mm[$dbt][1]++;
					else if ( $t>$insem1st_days0 & $t<=$not_abort1st_days0 ) $cnt_neteli_mm[$dbt][1]++;
					else $cnt_cows___mm[$dbt][1]++;
				}
			}
		}
		if ( $mc1<12 ) $mc1++; else { $mc1=1; $yc1++;}
	}
} mysql_free_result( $res1 );}

unset( $cows_marked );

//zapusk: oper_id==64 AND int_8==6
//not abort: oper_id==2048
$query2="SELECT cow_id, oper_id, month, year FROM $opers
 WHERE ( year='$yf' AND month>=$mf AND month<=$ml ) AND ( oper_id='2048' OR ( oper_id='64' AND int_8='6' ))";
$res2=mysql_query( $query2, $db ); $sqlerr2=mysql_errno();
if ( $sqlerr2==0 ) { while ( $row2=mysql_fetch_row( $res2 )) {
	$yc2z=Int2StrZ( $row2[3], 4 ); $mc2z=Int2StrZ( $row2[2], 2 );
	$dbt=$yc2z.$mc2z."_m";
	$ctrl_dmY="28.".$mc2z.".".$yc2z; $ctrl_Ymd=$yc2z."-".$mc2z."-28";
	if ( $cows_marked[$dbt][$row2[0]]==0 ) {
		$cows_marked[$dbt][$row2[0]]=1;
//NEXT 'if' IS COMMENTED, BECAUSE COW MAY HAVE OTEL AND ZABOY IN THE SAME MONTH
//		if ( $cows_z_Ymd[$row2[0]]>$ctrl_Ymd | $cows_z_Ymd[$row2[0]]=='' ) {
			$t=DaysBetween( $cows_b_dmY[$row2[0]], $ctrl_dmY );
			if ( $t>0 ) {
				if ( $row2[1]==2048 ) $idx=2; else $idx=3;
				if ( $t<=$insem1st_days0 ) $cnt_telyci_mm[$dbt][$idx]++;
				else if ( $t>$insem1st_days0 & $t<=$not_abort1st_days0 ) $cnt_neteli_mm[$dbt][$idx]++;
				else $cnt_cows___mm[$dbt][$idx]++;
			}
//		}
	}
} mysql_free_result( $res2 );}

$yc=$yf; $mc=$mf;
while ( $yc*100+$mc<=$yl*100+$ml ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	$query="SELECT d.cow_id, d.milk_kg";
	$query=$query." FROM $dbt d";
	if ( $restrict_by_field>0 ) $query=$query." AND $restrict_field=$restrict_id";
	if ( $filt_cowid>0 ) $query=$query." AND d.cow_id=$filt_cowid";
//	$query=$query.$WHEREADV;
	$query=$query." ORDER BY d.code";
	$res=mysql_query( $query, $db ); $sqlerr=mysql_errno();
	if ( $sqlerr==0 ) { while ( $row=mysql_fetch_row( $res )) {
		$m=$row[1];
		$t=$m_mm[$dbt]; $m_mm[$dbt]=$t+$m;
		$t=$mcows_mm[$dbt];
		if ( $cows_mm[$dbt][$row[0]]==0 ) {
			$cows_mm[$dbt][$row[0]]=1;
			$mcows_mm[$dbt]=$t+1;
			$t=$m_yyyy[$yc]; $m_yyyy[$yc]=$t+$m;
		}
		$rows_cnt++;
		if ( $graph==1 ) {
			$dots[$dots_cnt]=$m;
			$dots_cnt++;
		}
	} mysql_free_result( $res );}
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++;}
}

$yc=$yf; $mc=$mf;
while ( $yc*100+$mc<=$yl*100+$ml ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	$t="_mm_1".Int2StrZ( $mc, 2 ); $t=split( ",", $php_mm[$t] ); $mm=$t[0];
	$m=$m_mm[$dbt];
	$mcows=$mcows_mm[$dbt];
	if ( $mcows>0 ) $m_avg=round( $m/$mcows, 1 ); else $m_avg="&nbsp;";
	RepTr1( $rownum, $rjust );
	$total_m=$total_m+$m;
	for ( $i=1; $i<=3; $i++ ) {
		$cnt_anims__mm[$dbt][$i]=$cnt_telyci_mm[$dbt][$i]+$cnt_neteli_mm[$dbt][$i]+$cnt_cows___mm[$dbt][$i];
		$total_cnt_telyci_[$i]=$total_cnt_telyci_[$i]+$cnt_telyci_mm[$dbt][$i];
		$total_cnt_neteli_[$i]=$total_cnt_neteli_[$i]+$cnt_neteli_mm[$dbt][$i];
		$total_cnt_cows___[$i]=$total_cnt_cows___[$i]+$cnt_cows___mm[$dbt][$i];
		$total_cnt_anims__[$i]=$total_cnt_anims__[$i]+$cnt_anims__mm[$dbt][$i];
		if ( $cnt_anims__mm[$dbt][$i]==0 ) $cnt_anims__mm[$dbt][$i]="";
	}
	echo "
	<td $cjust>".$mm."&nbsp;</td>
	<td>".$m."&nbsp;</td>
	<td>".$m_avg."&nbsp;</td>
	<td>".$mcows."&nbsp;</td>
	<td>".$cnt_neteli_mm[$dbt][1]."&nbsp;</td>
	<td>".$cnt_cows___mm[$dbt][1]."&nbsp;</td>
	<td>".$cnt_anims__mm[$dbt][1]."&nbsp;</td>
	<td>".$cnt_neteli_mm[$dbt][2]."&nbsp;</td>
	<td>".$cnt_cows___mm[$dbt][2]."&nbsp;</td>
	<td>".$cnt_anims__mm[$dbt][2]."&nbsp;</td>
	<td>".$cnt_anims__mm[$dbt][3]."&nbsp;</td>
</tr>";
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++;}
}

$total_m=round( $total_m, 1 );

if ( $graph<1 ) {
	echo "
<tr class='st_title2' style='height:28px'>
	<td $cjust><b>".$ged['TOTAL'].":</b></td>
	<td $rjust><b>".$total_m."&nbsp;</b></td>
	<td $rjust><b>&nbsp;</b></td>
	<td $rjust><b>&nbsp;</b></td>
	<td $rjust><b>&nbsp;</b></td>
	<td $rjust><b>&nbsp;</b></td>
	<td $rjust><b>&nbsp;</b></td>
	<td $rjust><b>".$total_cnt_neteli_[2]."&nbsp;</b></td>
	<td $rjust><b>".$total_cnt_cows___[2]."&nbsp;</b></td>
	<td $rjust><b>".$total_cnt_anims__[2]."&nbsp;</b></td>
	<td $rjust><b>".$total_cnt_anims__[3]."&nbsp;</b></td>
</tr>
</table><br>";

} else {
	$dots_set=$dots[0];
	if ( $dots_cnt>300 ) $dots_cnt=300;//no more than 300 dots for JpGraph!
	for ( $i=1; $i<=$dots_cnt; $i++ ) $dots_set=$dots_set.";".$dots[$i];
	if ( $dots_cnt>2 ) {//no chance to build graph from less than two dots
		echo "
<br>
<font size='5'><b>&#8661;</b></font>&nbsp;".$ged['Milk,kg']."
<center><input type='image' src='fgraphgd.php?dots_cnt=$dots_cnt&dots_set=$dots_set'></center>
<center><font size='5'><b>&hArr;</b></font>&nbsp;".$ged["Dairy_cycle"]."</center>";
	} else;
}

ob_end_flush();
?>
