<?php
/* DF_2: reports/f_mt2.php
report: conductivity by table, total for 8 last days
c: 25.12.2005
m: 15.03.2017 */

function OutputRes_ByIdAndDate( $r, $sess ) {
	global $rjust, $mf, $mf_days, $df, $mrowt, $mrowaq;
	$mcz=Int2StrZ( $mf, 2 ); $dcz=Int2StrZ( $df, 2 ); $idx="$mcz-$dcz"; $dc_idx=1;
	while ( $dc_idx<=8 ) {
		$tstyle=$rjust;
		if ( $mrowaq[$r][$idx.$sess]>0 ) {
			$tstyle=$tstyle." style='color:#ff0000'";
		}
		echo "
	<td $tstyle>".$mrowt[$r][$idx.$sess]."&nbsp;</td>";
		if ( $dcz*1<$mf_days )
			$dcz=Int2StrZ( $dcz*1+1, 2 );
		else {
			$mcz=$mcz*1+1; if ( $mcz>12 ) $mcz=1;
			$mcz=Int2StrZ( $mcz, 2 ); $dcz="01";
		}
		$idx="$mcz-$dcz"; $dc_idx++;
	}
}

function OutputCondRes_ByIdAndDate( $r, $sess ) {
	global $rjust, $mf, $mf_days, $df, $mrowt, $mrowaq, $condrow;
	$mcz=Int2StrZ( $mf, 2 ); $dcz=Int2StrZ( $df, 2 ); $idx="$mcz-$dcz"; $dc_idx=1;
	while ( $dc_idx<=8 ) {
		$tstyle=$rjust;
		if ( $mrowaq[$r][$idx.$sess]>0 ) {
			$tstyle=$tstyle." style='color:#ff0000'";
		}
		echo "
	<td $tstyle>".$condrow[$r][$idx.$sess]."&nbsp;</td>";
		if ( $dcz*1<$mf_days )
			$dcz=Int2StrZ( $dcz*1+1, 2 );
		else {
			$mcz=$mcz*1+1; if ( $mcz>12 ) $mcz=1;
			$mcz=Int2StrZ( $mcz, 2 ); $dcz="01";
		}
		$idx="$mcz-$dcz"; $dc_idx++;
	}
}

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

include( "f_mt2c.php" );
include( "frhead.php" );

if ( $graph<1 ) {
	echo "
<table>
<tr $cjust style='height:28px'>
	<td rowspan='2' width='7%'><b>".$ged["Number"]."</b></td>
	<td rowspan='2'><b>";
	if ( $outsele_*1==-1 ) echo $ged["Nick"]."&nbsp;/&nbsp;".$ged["Group"];
	else echo $ged["Name"];
	echo "</b></td>
	<td colspan='11'><b>".$ged["Milk"].",".$ged["kg"]."</b></td>
	<td colspan='3'><b>".$ged["Start/Stop"]."</b></td>
	<td rowspan='2' width='7%'><b>".$ged["Duration"]."</b></td>
</tr>
<tr $cjust>
	<td width='7%'><b>".$ged["total_"]."</b></td>
	<td width='7%'><b>".$ged["average"]."</b></td>
	<td width='7%'><b>".$ged["mastit"]."</b></td>";
	$mcz=Int2StrZ( $mf, 2 ); $dcz=Int2StrZ( $df, 2 );
	for ( $i=1; $i<=8; $i++ ) {
		echo "
	<td width='4%'><b>".$dcz."</b></td>";
		if ( $dcz*1<$mf_days ) $dcz=Int2StrZ( $dcz*1+1, 2 );
		else $dcz="01";
	}
	echo "
	<td width='50px'><b>".$ged["total_"]."</b></td>
	<td width='50px'><b>".$ged["mastit"]."</b></td>
	<td width='50px'><b>"."0&nbsp;".$ged["kg"]."</b></td>
</tr>";
}

if ( $outsele_*1==-1 ) $res1=mysql_query( "SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $groups.id=$cows.gr_id ORDER BY cow_num*1" );
else $res1=mysql_query( "SELECT id, num, nick FROM $outsele_table ORDER BY nick" );
if ( mysql_errno()<1 ) { while ( $row=mysql_fetch_row( $res1 )) {
	$r=$row[0]*1;
	if ( $mrowt[$r]>0 ) {
		$itt++;//identified cows
		if ( $mrowtq[$r][0]==0 ) {
			$mrow1=""; $mrowtq[$r][0]="";
		} else {
			$mrow1=floor( $mrowt[$r][0]/$mrowtq[$r][0]*10 )/10;
		}
		if ( $mrowm[$r][0]==0 ) $mrowm[$r][0]="";
		if ( $mrow0q[$r][0]==0 ) $mrow0q[$r][0]="";
		if ( $graph<1 ) {//show text report
			$num=$cownum_div.$row[1].$cownum_div1;
			$nick=$row[2];
			if ( $outsele_*1==-1 ) {
				$nick1=$nick."&nbsp;/&nbsp;".$row[3];
				$nick_=StrCutLen1( $nick, 27, $contentCharset )."<br>/&nbsp;".$row[3];
			} else {
				$nick1=$nick;
				$nick_=StrCutLen1( $nick, 27, $contentCharset );
			}
			$tsec=$mrow_tsec[$r][0]*1;
			if ( $tsec>0 ) {
				$t_hh=floor( $tsec/3600 );
				$tsec=$tsec-$t_hh*3600; $t_mm=floor( $tsec/60 );
				$tsec=$tsec-$t_mm*60; $t_ss=$tsec;
				$t_His=Int2StrZ( $t_hh, 2 ).":".Int2StrZ( $t_mm, 2 ).":".Int2StrZ( $t_ss, 2 );
			} else $t_His="";
			echo "
<tr $rjust>";
			if ( $noCSS ) echo "
	<td rowspan='4'>".$num."</td>
	<td $ljust rowspan='4' title='".$nick1."'>".$nick_."&nbsp;</td>
	<td>".$mrowt[$r][0]."&nbsp;</td>"; else echo "
	<td rowspan='4' onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm['0520']."?cow_id=$r&ret0=00'><b>".$num."</b></td>
	<td $ljust rowspan='4' title='$nick1' onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm['0520']."?cow_id=$r&ret0=00'>".$nick_."&nbsp;</td>
	<td onmouseover='style.cursor=\"pointer\"'><a href='../".$hRep['m']."?restrict_id=".$r."&restrict_field=c.id&restrict_by_field=1&title=".$ged['RR0301-'].":&nbsp;".$nick."'>".$mrowt[$r][0]."&nbsp;</td>";
			echo "
	<td>".$mrow1."&nbsp;</td>
	<td>".$mrowm[$r][0]."&nbsp;</td>";
			OutputRes_ByIdAndDate( $r, 0 );
			echo "
	<td>".$mrowtq[$r][0]."&nbsp;</td>
	<td>".$mrowmq[$r][0]."&nbsp;</td>
	<td>".$mrow0q[$r][0]."&nbsp;</td>
	<td>".$t_His."&nbsp;</td>
</tr>";
			for ( $sessi=1; $sessi<=3; $sessi++ ) {
				$sess=$sessi*10;
				$tsec=$mrow_tsec[$r][$sess]*1;
				if ( $tsec>0 ) {
					$t_hh=floor( $tsec/3600 );
					$tsec=$tsec-$t_hh*3600; $t_mm=floor( $tsec/60 );
					$tsec=$tsec-$t_mm*60; $t_ss=$tsec;
					$t_His=Int2StrZ( $t_hh, 2 ).":".Int2StrZ( $t_mm, 2 ).":".Int2StrZ( $t_ss, 2 );
				} else $t_His="";
				echo "
<tr style='background:#eee;'>
	<td $rjust>".$mrowt[$r][$sess]."&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>";
				OutputCondRes_ByIdAndDate( $r, $sess );
				echo "
	<td $rjust>".$mrowtq[$r][$sess]."&nbsp;</td>
	<td $rjust>".$mrowmq[$r][$sess]."&nbsp;</td>
	<td $rjust>".$mrow0q[$r][$sess]."&nbsp;</td>
	<td $rjust>".$t_His."&nbsp;</td>
</tr>";
			}
		} else {//prep diagram
			$dots[$dots_cnt]=$m;
			$dots_cnt++;
		}
	}
}}

if ( $graph<1 ) {
	if ( $mttq>0 ) $mt1=floor( $mtt/$mttq*10 )/10;
	if ( $mtt==0 ) $mtt="";
	if ( $mt1==0 ) $mt1="";
	if ( $mtm==0 ) $mtm="";
	echo "
<tr $rjust height='28px'>
	<td $cjust class='st_title2'><b>".$ged["TOTAL"].":</b></td>
	<td><b>".$itt."&nbsp;</b></td>
	<td><b>".$mtt."&nbsp;</b></td>
	<td><b>".$mt1."&nbsp;</b></td>
	<td><b>".$mtm."&nbsp;</b></td>";
	for ( $i=1; $i<=8; $i++ ) echo "
	<td>&nbsp;</td>";
	if ( $mttq<1 ) $mttq="";
	if ( $mtmq<1 ) $mtmq="";
	if ( $mt0q<1 ) $mt0q="";
	echo "
	<td><b>".$mttq."&nbsp;</b></td>
	<td><b>".$mtmq."&nbsp;</b></td>
	<td><b>".$mt0q."&nbsp;</b></td>
	<td>&nbsp;</td>
</tr>
</table><br>";

} else {
	$dots_set=$dots[0];
	if ( $dots_cnt>300 ) $dots_cnt=300;//no more than 300 dots for JpGraph!
	for ( $i=1; $i<=$dots_cnt; $i++ )
		$dots_set=$dots_set.";".$dots[$i];
	if ( $dots_cnt>2 ) {//no chance to build diagram from less than two dots
		echo "
<center><input type='image' src='fgraphgd.php?dots_cnt=$dots_cnt&dots_set=$dots_set'></center>";
	} else;
}

include( "frfoot.php" );

ob_end_flush();
?>
