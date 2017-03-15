<?php
/* DF_2: reports/f_m.php
report: extracting
c: 25.12.2005
m: 15.03.2017 */

$skip_clichk=1;

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;
$restrict_by_field=$_GET["restrict_by_field"]*1;
$restrict_field=$_GET["restrict_field"];
$restrict_id=$_GET["restrict_id"]*1;

$rep_order=$_GET["rep_order"];
if ( $rep_order=="kg" ) {
	$kg_order="&nabla;";
	$kg_30s_order=$kg_60s_order=$kg_90s_order="";
	$null_order="";
} elseif ( $rep_order=="kg_30s" ) {
	$kg_order="";
	$kg_30s_order="&nabla;";
	$kg_60s_order=$kg_90s_order=$null_order="";
} elseif ( $rep_order=="kg_60s" ) {
	$kg_order=$kg_30s_order="";
	$kg_60s_order="&nabla;";
	$kg_90s_order=$null_order="";
} elseif ( $rep_order=="kg_90s" ) {
	$kg_order=$kg_30s_order=$kg_60s_order="";
	$kg_90s_order="&nabla;";
	$null_order="";
} else {
	$kg_order=$kg_30s_order=$kg_60s_order=$kg_90s_order="";
	$null_order="&nabla;";
}

include( "f_jfilt.php" );
include( "../locales/$lang/f_rrm._$lang" );

$th1=$ged["Date"];
$th2=$ged["Number"];
$th3=$ged["Nick"];
$th4=$ged["Lot"];
$th5=$ged["Group"];
$th6=$ged["Milk"].",".$ged["kg"];
$th7=$ged["00-30s,kg_tip"]; $th7_=$ged["00-30s,kg"];
$th8=$ged["31-60s,kg_tip"]; $th8_=$ged["31-60s,kg"];
$th9=$ged["61-90s,kg_tip"]; $th9_=$ged["61-90s,kg"];
$th10=$ged["kg/min._tip"]; $th10_=$ged["kg/min."];
$th11=$ged["TAG,0~"];
$th12=$ged["Starting"];
$th13=$ged["Dev._cmd_t~"];
$th14=$ged["Interv.~"];
$th15=$ged["Start_manual"]; $th15_=$ged["Start_manual~"];
$th16=$ged["Start_retr."]; $th16_=$ged["Start_retr.~"];
$th17=$ged["Break_done"]; $th17_=$ged["Break_done~"];
$th18=$ged["Exhaust"]; $th18_=$ged["Exhaust~"];
$th19=$ged["M."]; $th19_=$ged["M.~"];
$th20=$ged["Conduct."]; $th20_=$ged["Conduct.~"];
$th21=$ged["T."]; $th21_=$ged["T.~"];
$th22=$ged["O."]; $th22_=$ged["O.~"];
$th23=$ged["Dev."]; $th23_=$ged["Dev.~"];

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
	#rep_tbody td:nth-of-type(11):before { content:\"".$th11."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(12):before { content:\"".$th12."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(13):before { content:\"".$th13."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(14):before { content:\"".$th14."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(15):before { content:\"".$th15."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(16):before { content:\"".$th16."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(17):before { content:\"".$th17."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(18):before { content:\"".$th18."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(19):before { content:\"".$th19."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(20):before { content:\"".$th20."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(21):before { content:\"".$th21."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(22):before { content:\"".$th22."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(23):before { content:\"".$th23."\"; text-align:left; top:0; }";

include( "frhead.php" );
include( "../dflib/f_filt1.php" );

$sself="../".$hRep["m"];

if ( $restrict_id<1 ) {
	if ( $filts1>-1 ) {
		$restrict_by_field=1;
		$restrict_field="d.gr_id";
		$restrict_id=$filts1;
	}
	if ( $filts2>-1 ) {
		$restrict_by_field=1;
		$restrict_field="d.lot_id";
		$restrict_id=$filts2;
	}
}

$dots_cnt=$t_cows=$t_m=$t_rows=$t_sec=0;

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;

if ( $df<10 ) $date1="0"; $date1=$date1.$df."-";
if ( $mf<10 ) $date1=$date1."0"; $date1=$date1.$mf."-";
$date1=$date1.$yf;
if ( $dl<10 ) $date2="0"; $date2=$date2.$dl."-";
if ( $ml<10 ) $date2=$date2."0"; $date2=$date2.$ml."-";
$date2=$date2.$yl;

if ( DaysBetween( $date1, $date2 )>7 ) {
	echo "
<center><h2><blink>".$ged["Period_restricted_007"]."</blink></h2></center>";

	include( "frfoot.php" );
	ob_end_flush();
	return;
}

if ( $graph<1 ) {
	echo "
<table>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th width='1%'><b><a href='".$sself."'>".$th1."</a></b></th>
	<th width='55px'><b>".$th2."</b></th>
	<th><b>".$th3."</b></th>
	<th width='3%'><b>".$th4."</b></th>
	<th width='3%'><b>".$th5."</b></th>
	<th width='7%'><b><a href='$".$sself."?rep_order=kg'>".PhraseCarry( $th6, ",", 1 ).$kg_order."</a></b></th>
	<th title='".$th7."' width='30px'><b><a href='".$sself."?rep_order=kg_30s'>".PhraseCarry( $th7_, ",", 1 ).$kg_30s_order."</a></b></th>
	<th title='".$th8."' width='30px'><b><a href='".$sself."?rep_order=kg_60s'>".PhraseCarry( $th8_, ",", 1 ).$kg_60s_order."</a></b></th>
	<th title='".$th9."' width='30px'><b><a href='".$sself."?rep_order=kg_90s'>".PhraseCarry( $th9_, ",", 1 ).$kg_90s_order."</a></b></th>
	<th title='".$th10."' width='30px'><b>".PhraseCarry( $th10_, "/", 1 )."</b></th>
	<th width='30px'><b>".$th11."</b></th>
	<th width='30px'><b>".$th12."</b></th>
	<th width='30px'><b>".$th13."</b></th>
	<th width='30px'><b>".$th14."</b></th>
	<th title='".$th15."' width='17px'><b>".$th15_."</b></th>
	<th title='".$th16."' width='17px'><b>".$th16_."</b></th>
	<th title='".$th17."' width='17px'><b>".$th17_."</b></th>
	<th title='".$th18."' width='17px'><b>".$th18_."</b></th>
	<th title='".$th19."' width='3%'><b>".$th19_."</b></th>";
	if ( $conductiv_vis==1 ) echo "
	<th title='".$th20."' width='3%'><b>".$th20_."</b></th>";
	echo "
	<th title='".$th21."' width='3%'><b>".$th21_."<b></th>
	<th title='".$th22."' width='3%'><b>".$th22_."<b></th>
	<th title='".$th23."' width='17px'><b>".$th23_."</b></th>
</tr>
</thead>
<tbody id='rep_tbody'>";
}

while ( $yc<=$yl+1 ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	$yc1=$yc*10000; $mc1=$mc*100;
	if ( $yc1+$mc1<=$yl1+$ml1 ) {
		$query="SELECT
		 d.cow_id,
		 d.day, d.month, d.year,
		 d.milk_kg,
		 d.milk_begin, d.milk_end, d.milk_time,
		 d.id_time, d.rep_time,
		 d.manual, d.retries, d.stopped, d.exhaust,
		 d.mast_4, d.tr, d.ov,
		 d.bd_num,
		 c.cow_num, c.nick, $lots.nick, $groups.nick,
		 d.kg_30s, d.kg_60s, d.kg_90s, d.str_res, d.r, d.comments, d.gr_id";
		$query=$query."
		 FROM $dbt d, $cows c, $lots, $groups
		 WHERE c.id=d.cow_id AND $lots.id=d.lot_id AND $groups.id=d.gr_id";
		if ( $restrict_by_field>0 ) $query=$query." AND $restrict_field=$restrict_id";
		if ( $filt_cowid>0 ) $query=$query." AND d.cow_id=$filt_cowid";
		$query=$query.$WHEREADV;
		if ( $null_order=="&nabla;" )
			$query=$query." "."
			 ORDER BY d.code";
		elseif ( $kg_order=="&nabla;" )
			$query=$query." "."
			 ORDER BY d.year, d.month, d.day, d.milk_kg";
		elseif ( $kg_30s_order=="&nabla;" )
			$query=$query." "."
			 ORDER BY d.year, d.month, d.day, d.kg_30s";
		elseif ( $kg_60s_order=="&nabla;" )
			$query=$query." "."
			 ORDER BY d.year, d.month, d.day, d.kg_60s";
		elseif ( $kg_90s_order=="&nabla;" )
			$query=$query." "."
			 ORDER BY d.year, d.month, d.day, d.kg_90s";
		$res=mysql_query( $query, $db );
		if ( mysql_errno()<1 ) { while ( $row=mysql_fetch_row( $res )) {
			$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;
			if ( $odt>$yl1+$ml1+$dl );
			else if ( $odt<$yf1+$mf1+$df );
			else {
				$dev_num=$row[17]; $dev=$dev_num*1;
				if (( trim( $filt_dev."." )!="." & $dev>=$bd_first & $dev<=$bd_last ) | ( trim( $filt_dev."." )=="." & $dev>0 )) {
					$m=$row[4];
					if ( $graph<1 ) {
						$dd=$row[1]; $mm=$row[2]; $yyyy=$row[3];
						$cwnum=$cownum_div.$row[18].$cownum_div1;
						$cwnick=$row[19]; $ltnick=$row[20]; $grnick=$row[21];
						$mbeg=$row[5]; $mend=$row[6]; $mtime=$row[7];
						$idtime=$row[8]; $reptime=$row[9];
						$manual=$C[$row[10]*1];
						$retries=$row[11]*1; if ( $retries<1 ) $retries="";
						$stopped=$C[$row[12]*1];
						$exhaust=$C[$row[13]*1];
						$sim=$row[26]; if ( $sim>0 ) $sim=round( 10000/$sim, 1 ); else $sim="";
						$mastit=$C[0]; $mast_4=$row[14]*1;
						if ( $mast_4>=0 & $mast_4<5555 ) $mastit=$row[14];
						if ( $mast_4==5555 ) $mastit=$C[1];
						$tr=$C[$row[15]];
						$ov=$C[$row[16]];
						if ( trim( $stat )=="," ) $stat="";
						$m1=$row[22]; $m2=$row[23]; $m3=$row[24];
//NEXT 'if' IS NOT READY YET (IT MUST BE USED FOR IMPORTED FARM-1 DATA)
						if ( strlen( $row[27] )!=8 ) {
							if ( $m3>0 ) {
								if ( $m2>0 ) $m3=( $m3-$m2 )*2;
								else $m3=( $m3-$m1 )*2;
							}
							if ( $m2>0 & $m1<=$m2 ) $m2=( $m2-$m1 )*2;
							$m1=$m1*2;
						}
						$rfid_res=$row[25];
						$cwnickSh=StrCutLen1( $cwnick, 8, $contentCharset );
						$ltnickSh=StrCutLen1( $ltnick, 12, $contentCharset ); if ( $ltnick==$ltnickSh ) $ltnick="";
						$grnickSh=StrCutLen1( $grnick, 12, $contentCharset ); if ( $grnick==$grnickSh ) $grnick="";
						$tt=split( ":", $mtime ); $tt=$tt[0]*60+$tt[1]; if ( $tt>0 ) $m99=round( $m/$tt*60, 1 ); else $m99=0;
						if ( $filt_cowid<=0 ) $m_url="onmouseover='style.cursor=\"pointer\"'><a href='../".$hRep["m"]."?filt_cowid=".$row[0]."&title=".$ged["RR0301-"].":&nbsp;".$cwnick."' target='w1'";
						else $m_url="onmouseover='style.cursor=\"pointer\"'><a href='../".$hRep["mcws1"]."?filt_cowid=".$row[0]."&title=".$ged["RR0301-"].":&nbsp;".$cwnick."'";
						if ( $grnickSh!=$grnickprvSh ) {
							if ( $gr_col==0 | $gr_col=="99ff99" ) $gr_col="9999ff"; else $gr_col="99ff99";
							$grnickprvSh=$grnickSh;
						}
						echo "
<tr $rjust>
	<td>".$dd.".".$mm.".".$yyyy."</td>";
						if ( $noCSS ) echo "
	<td>".$cwnum."</td>"; else echo "
	<td onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm["0520"]."?cow_id=".$row[0]."&ret0=-1' target='w1'>".$cwnum."</td>";
						echo "
	<td $ljust title='$cwnick'>".$cwnickSh."&nbsp;</td>
	<td $ljust title='$ltnick'>".$ltnickSh."&nbsp;</td>";
						if ( $noCSS ) echo "
	<td $ljust title='$grnick'>".$grnickSh."&nbsp;</td>
	<td>".$m."&nbsp;</td>"; else echo "
	<td $ljust style='background:#".$gr_col."' title='$grnick'>".$grnickSh."&nbsp;</td>
	<td $m_url>".$m."&nbsp;</td>";
						echo "
	<td>".$m1."&nbsp;</td>
	<td>".$m2."&nbsp;</td>
	<td>".$m3."&nbsp;</td>
	<td>".$m99."&nbsp;</td>
	<td>".$idtime."&nbsp;</td>
	<td>".$mbeg."&nbsp;</td>
	<td>".$mend."&nbsp;</td>
	<td>".$mtime."&nbsp;</td>
	<td $cjust>".$manual."&nbsp;</td>
	<td $cjust>".$retries."&nbsp;</td>
	<td $cjust>".$stopped."&nbsp;</td>
	<td $cjust>".$exhaust."&nbsp;</td>
	<td $cjust>".$mastit."&nbsp;</td>";
						if ( $conductiv_vis==1 ) echo "
	<td $cjust>".$sim."&nbsp;</td>";
						echo "
	<td $cjust>".$tr."&nbsp;</td>
	<td $cjust>".$ov."&nbsp;</td>
	<td title='".$rfid_res."'>#".$dev_num."</td>
</tr>";
					}
					$t_rows++;
					$t_m+=$m;
					$t_m30_1+=$m1;
					$t_m30_2+=$m2;
					$t_m30_3+=$m3;
					$t_m60+=$m99;
					$t_sec+=$tt;
					if ( $cow[$row[0]*1]!=1 ) $t_cows++;
					$cow[$row[0]*1]=1;
					$dots[$dots_cnt]=$m;
					$dots_cnt++;
				}
			}
		} mysql_free_result( $res ); }
	}
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++; }
}

if ( $t_rows>0 ) {
	$t_m30_1=round( $t_m30_1/$t_rows, 1 );
	$t_m30_2=round( $t_m30_2/$t_rows, 1 );
	$t_m30_3=round( $t_m30_3/$t_rows, 1 );
	$t_m60=round( $t_m60/$t_rows, 1 );
} else {
	$t_m30_1=$t_m30_2=$t_m30_3=$t_m60="";
}
$t_hh=floor( $t_sec/3600 ); $t_sec=$t_sec-$t_hh*3600;
$t_mm=floor( $t_sec/60 ); $t_sec=$t_sec-$t_mm*60;
$t_ss=$t_sec;
if ( $t_hh<10 ) $t_hh="0".$t_hh;
if ( $t_mm<10 ) $t_mm="0".$t_mm;
if ( $t_ss<10 ) $t_ss="0".$t_ss;

if ( $graph<1 ) {
	echo "
</tbody>
<tfoot id='rep_tfoot'>
<tr $rjust height='28px'>
	<td $cjust><b>".$ged["TOTAL"].":</b>&nbsp;</td>
	<td><center>".$ged["dairy_cycles"].":</center><b>".$t_rows."</b>&nbsp;</td>
	<td><center>".$ged["animals"].":</center><b>".$t_cows."</b>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><b>".$t_m."</b>&nbsp;</td>
	<td><b>".$t_m30_1."</b>&nbsp;</td>
	<td><b>".$t_m30_2."</b>&nbsp;</td>
	<td><b>".$t_m30_3."</b>&nbsp;</td>
	<td><b>".$t_m60."</b>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td></b>".$t_hh.":<br>".$t_mm.":".$t_ss."</b>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>";
	if ( $conductiv_vis==1 ) echo "
	<td>&nbsp;</td>";
	echo "
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</tfoot>
</table><br>";

} else {
	$dots_set=$dots[0];
	if ( $dots_cnt>300 ) $dots_cnt=300;//no more than 300 dots for JpGraph!
	for ( $i=1; $i<=$dots_cnt; $i++ ) $dots_set=$dots_set.";".$dots[$i];
	if ( $dots_cnt>2 ) {//no chance to build diagram from less than two dots
		echo "
<br>
<font size='5'><b>&#8661;</b></font>&nbsp;".$ged["Milk,kg"]."
<center><input type='image' src='fgraphgd.php?dots_cnt=$dots_cnt&dots_set=$dots_set'></center>
<center><font size='5'><b>&hArr;</b></font>&nbsp;".$ged["Dairy_cycle"]."</center>";
	}
}

include( "frfoot.php" );
ob_end_flush();
?>
