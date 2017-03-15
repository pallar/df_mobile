<?php
/* DF_2: reports/f_mlactz.php
report: total milk by lactation (ONLY CALCULATION)
c: 09.06.2005
m: 14.03.2017 */

function DateDiff( $start, $end ) {
	$start_ts=strtotime( $start );
	$end_ts=strtotime( $end );
	$diff=$end_ts-$start_ts;
	return round( $diff/86400 );
}

function MilkPrediction( $Mday, $this_Mkg ) {
/*
	$Mday=lactation day, where data exists
	$this_Mkg=milk (kg) at this day
*/
	$Mkg=array(
	 '10'=>36, '20'=>42, '30'=>47, '60'=>48, '90'=>47, '120'=>45,
	 '150'=>42, '180'=>41, '210'=>38, '240'=>35, '270'=>31, '300'=>26 );
	$prev_day=0;
	$prev_Mkg=0;
	foreach ( $Mkg as $day=>$Milk_day ) {
		if ( $Mday>=$prev_day & $Mday<=$day ) {
			$dm=(( $Milk_day-$prev_Mkg)/( $day-$prev_day ));// average milk power per subperiod
			$d=$prev_day;
			$M=$prev_Mkg;
			while ( $d<$Mday ) {
				$M=$M+$dm;
				$d++;
			}
		}
		$prev_day=$day;
		$prev_Mkg=$Milk_day;
	}
	$k=round( 11920*$this_Mkg/$M );
	return $k;
}

function MilkPrediction_( $kg_idx, $kg_ ) {
	global $p, $n, $ppp;
	$kg_=$kg_*1;
	if ( $kg_>0 ) {
		$ppp=MilkPrediction( $kg_idx, $kg_/50 );
		$p=$p+$ppp; $n++;
	}
}

$dontuse_period=1;//ONLY IN THIS REPORT
$outsele_=-1; $outsele_table=-1; $outsele_field=-1;
$repfilt__hide=1;

$vl=0; $cows_cnt=0;

$beg="1991-01-01";
$yf=intval( substr( $beg, 0, 4 )); $mf=intval( substr( $beg, 5, 2 )); $df=intval( substr( $beg, 8, 2 ));
$end=date('Y')."-12-31";
$yl=intval( substr( $end, 0, 4 )); $ml=intval( substr( $end, 5, 2 )); $dl=intval( substr( $end, 8, 2 ));

$yc=$yf; $mc=$mf; $dc=$df;

if ( $lact_restr==0 ) $lact_restr=1;

if ( $graph!=1 | ( $filt_cowid==-1 & $graph==1 )) {
	if ( $skip_echo!=1 ) echo "
<table cellspacing='1' class='st2'>
<tr $cjust class='st_title2' style='height:28px'>
	<td width='7%'><b>".$ged['Number']."</b></td>
	<td><b>".$ged['Nick']."</b></td>
	<td width='10%'><b>".$ged['Starting']."</b></td>
	<td width='10%'><b>".$ged['Ending']."</b></td>
	<td width='3%'><b>".$ged['Lact._days']."</b></td>
	<td title='".$ged['Avg._tip']."' width='4%'><b>".$ged['Avg.']."</b></td>
	<td width='4%'><b>".$ged['Total']."</b></td>
	<td width='4%'><b>1..305</b></td>
	<td width='4%'><b>1..50</b></td>
	<td width='4%'><b>51..100</b></td>
	<td width='4%'><b>101..150</b></td>
	<td width='4%'><b>151..200</b></td>
	<td width='4%'><b>201..250</b></td>
	<td width='4%'><b>251..300</b></td>
	<td width='4%'><b>301..350</b></td>
	<td width='4%'><b>351..</b></td>
	<td title='".$ged['Predict~_tip']."' width='4%'><b>".$ged['Predict~']."</b></td>
</tr>";
}

$x_query="SELECT id FROM $cows";
if ( $filt_cowid>0 ) {
	$x_query=$x_query." WHERE id=$filt_cowid";
	for ( $pp=50; $pp<=350; $pp+=50 ) $milka[$pp][$filt_cowid]=0;
	$milka[351][$filt_cowid]=0;
}
$x=mysql_query( $x_query, $db );
while ( $a=mysql_fetch_row( $x )) {
	$cowid=$a[0];
	if ( $lact[$cowid]==$lact_restr ) {
		$b=explode('.', $lact_beg[$lact[$cowid]][$cowid]);
		$dots_cnt=0; $yc=$b[2]; $mc=$b[1]; $dc=$b[0];
		while ( $yc<$yl+1 ) {
			if ( $yc*100+$mc<=$yl*100+$ml ) {
				$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
				$res=mysql_query( "SELECT day, month, year, milk_kg
				 FROM $dbt
				 WHERE cow_id=$cowid", $db );
				$sqlerr=mysql_errno();
				if ( $sqlerr==0 ) { while ( $row=mysql_fetch_row( $res )) {
					$dc=$row[0]*1;
					$odt=$yc*10000+$mc*100+$dc;
					$o_d=$row[0]; $o_m=$row[1]; $o_Y=$row[2];
					$o_dmY=$o_d.".".$o_m.".".$o_Y;
					$m=$row[3];
					$days=DaysBetween( $lact_beg[$lact[$cowid]][$cowid], $o_dmY );
					if ( $days>0 & $lact_yf[$lact[$cowid]][$cowid]>0 ) {
						$vl=$vl+$m;
						if ( $cow[$cowid]!=1 ) $cows_cnt++;
						$cow[$cowid]=1;
						$milk_=$milk[$cowid]+$m; $milk[$cowid]=$milk_;
						if ( $milk_>0 ) {
							$milkcnt_=$milkcnt[$cowid]+1; $milkcnt[$cowid]=$milkcnt_;
						}
						if ( $days<=50 ) {
							$milk_=$milka[50][$cowid]+$m; $milka[50][$cowid]=$milk_;
						} else if ( $days<=100 ) {
							$milk_=$milka[100][$cowid]+$m; $milka[100][$cowid]=$milk_;
						} else if ( $days<=150 ) {
							$milk_=$milka[150][$cowid]+$m; $milka[150][$cowid]=$milk_;
						} else if ( $days<=200 ) {
							$milk_=$milka[200][$cowid]+$m; $milka[200][$cowid]=$milk_;
						} else if ( $days<=250 ) {
							$milk_=$milka[250][$cowid]+$m; $milka[250][$cowid]=$milk_;
						} else if ( $days<=300 ) {
							$milk_=$milka[300][$cowid]+$m; $milka[300][$cowid]=$milk_;
						} else if ( $days<=350 ) {
							$milk_=$milka[350][$cowid]+$m; $milka[350][$cowid]=$milk_;
						} else {
							$milk_=$milka[351][$cowid]+$m; $milka[351][$cowid]=$milk_;
						}
						if ( $days<=305 ) {
							$milk_=$milka[305][$cowid]+$m; $milka[305][$cowid]=$milk_;
						}
					}
				} mysql_free_result( $res ); }
			}
			if ( $mc<12 ) $mc++; else { $mc=1; $yc++; }
		}
	}
}

//output results
if ( $graph!=1 | ( $filt_cowid==-1 & $graph==1 )) {
	$x_query="SELECT id, cow_num, nick FROM $cows";
	if ( $filt_cowid>0 ) $x_query=$x_query." WHERE id=$filt_cowid";
	$res=mysql_query( $x_query." ORDER BY cow_num", $db );
	$sqlerr=mysql_errno();
	if ( $sqlerr==0 ) {
		while ( $row=mysql_fetch_row( $res )) {
			$predict=0;
			$cowid=$row[0]*1;
			$cownum=$row[1]*1; $cownick=$row[2];
			if ( $milk[$cowid]>0 & $lact[$cowid]==$lact_restr ) {
//prediction() begin
				if ( $milka[350][$cowid]*1>0 ) {
					$p=0; $n=0;
					$predict=$milk[$cowid];
				} else {
					$p=0; $n=0;
					$predict=0;
					for ( $pp=50; $pp<=350; $pp+=50 ) MilkPrediction_( $pp, $milka[$pp][$cowid] );
					if ( $n>1 ) $predict=round(( $p-$ppp )/( $n-1 ));
				}
//prediction() end
				if ( $skip_echo!=1 ) RepTr();
				if ( $milkcnt[$cowid]>0 ) $average_=floor( $milk[$cowid]/$milkcnt[$cowid]*100 )/100;
				else $average_=0;
				$lact_beg_=$lact_beg[$lact[$cowid]][$cowid];
				$lact_end_=$lact_end[$lact[$cowid]][$cowid];
				$lact_days_=$lact_days[$lact[$cowid]][$cowid];
				if ( $lact_auto[$cowid]==1 ) $lact_beg_=$lact_beg_." !!!";
				$do_period="&per_beg=$lact_beg_&per_end=$lact_end_";
				$title=htmlentities( urlencode ( $title_."&nbsp;(".$lact_beg_."-".$lact_end_."),&nbsp;".$ged['Nick'].":&nbsp;".$cownick."&nbsp;(".$ged['Number'].":&nbsp;".$cownum.")")).$do_period;
				if ( $filt_cowid>0 ) $href_cow="";
				else {
					if ( $graph!=1 ) $href_cow="<a href='../".$hRep['mcws1']."?filt_cowid=".$cowid."&title=".$ged['RR0301-'].":&nbsp;".$cownick."' target='w1'>";
					else $href_cow="<a href='../".$hRep['mlact']."?graph=".$graph."&lact_restrict=".$lact_restr."&filt_cowid=".$cowid."&title=".$title."' target='w1'>";
				}
				if ( $skip_echo!=1 ) {
					echo "
	<td $rjust><a href='../".$hFrm['0520']."?cow_id=".$cowid."&ret0=00' target='w1'>".$cownum_div.$cownum.$cownum_div1."</td>
	<td>$cownick</td>
	<td>$lact_beg_</td>
	<td>$lact_end_</td>
	<td $rjust>".$href_cow.$lact_days_."</td>
	<td $rjust>$average_</td>
	<td $rjust>".$milk[$cowid]."</td>
	<td $rjust>".$milka[305][$cowid]."</td>";
					for ( $pp=50; $pp<=350; $pp+=50 ) echo "
	<td $rjust>".$milka[$pp][$cowid]."</td>";
					echo "
	<td $rjust>".$milka[351][$cowid]."</td>
	<td $rjust><font color='#778899'>$predict</font></td>
</tr>";
				}
			}
		}
	} else {
		$sqlerr=$sqlerr.": ".mysql_error();
		if ( $skip_echo!=1 ) echo "<h3>".$php_mm["TABLE"]." '$cows': ".$php_mm["ERROR"]." MySQL $sqlerr.</h3>";
	}
	if ( $skip_echo!=1 ) echo "
</table><br>";

} else if ( $graph==1 & $skip_echo!=1 ) {
	for ( $pp=50; $pp<=350; $pp+=50 ) $dots[$pp/50-1]=$milka[$pp][$cowid];
	$dots[7]=$milk351[$cowid];
	$dots_cnt=7;
	$dots_set=$dots[0];
	if ( $dots_cnt>300 ) $dots_cnt=300;//no more than 300 dots for JpGraph!
	for ( $i=1; $i<=$dots_cnt; $i++ ) $dots_set=$dots_set.";".$dots[$i];
	if ( $dots_cnt>2 ) {//no chance to build graph from less than two dots
		echo "
<br>
<table width='100%'>
<tr>
	<td $cjust></td>
	<td $cjust width='120px'>";
		$a[0]=$milka[50][$cowid]*1;
		for ( $pp=100; $pp<=350; $pp+=50 ) $a[$pp/50-1]=$a[$pp/50-2]+$milka[$pp][$cowid]*1;
		$a[7]=$a[6]+$milk351[$cowid]*1;
		$tmp_=substr( $title_, strpos( $title_, "(" )+1, 31 );
		$lact_beg_=substr( $tmp_, 0, 10 );
		$lact_end_=substr( $tmp_, strpos( $tmp_, "-" )+1, 10 );
		echo "<br>
<table cellspacing='1' class='st2'>
<th colspan='2' class='st_title2' style='height:28px'>".$ged['Milk_by_periods'].",&nbsp;".$ged[kg]."
</th>";
		for ( $pp=50; $pp<=350; $pp+=50 ) {
			$pp1=$pp-50;
			if ( $pp1==0 ) $pp1=1;
			echo "
<tr $cjust class='st_title2' style='height:18px'>
	<td><b>".$pp1."..".$pp."</b></td>
	<td>".$milka[$pp][$cowid]."</td>
</tr>";
		}
		echo "
<tr $cjust class='st_title2' style='height:18px'>
	<td><b>351..</b></td>
	<td>".$milka[351][$cowid]."</td>
<tr $cjust class='st_title2' style='height:18px'>
	<td><b>".$ged['Total']."</b></td>
	<td>$milk[$cowid]</td>
</tr>
</table>
</td>
	<td $cjust width='5px'></td>
	<td $cjust width='642px'>";
		include( "fgraphgd.php" );
		Lineplot_Show( $dots, $lineplot_h, $expansion );
		echo "
	</td>
	<td $cjust width='5px'></td>
	<td $cjust width='120px'>
<table cellspacing='1' class='st2'>
<th colspan='2' class='st_title2' style='height:28px'>".$ged['Milk_growing'].",&nbsp;".$ged[kg]."
</th>";
		for ( $pp=50; $pp<=350; $pp+=50 ) echo "
<tr $cjust class='st_title2' style='height:18px'>
	<td><b>1..".$pp."</b></td>
	<td>".$a[$pp/50-1]."</td>
</tr>";
		echo "
<tr $cjust class='st_title2' style='height:18px'>
	<td><b>1..</b></td>
	<td>$a[7]</td>
</tr>
<tr $cjust class='st_title2' style='height:18px'>
	<td><b>".$ged['Total']."</b></td>
	<td>$milk[$cowid]</td>
</tr>
</table>
</td>
	</td>
	<td $cjust>
</tr>
</table>";
	} else;
}
?>
