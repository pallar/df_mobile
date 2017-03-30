7<?php
/* DF_2: reports/f_mcws0.php
report: extracting by cows & days
c: 25.12.2005
m: 30.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];
if ( strlen( $title_ )<=1 ) $title_=$php_mm["_01_tab3_"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );
include( "frhead.php" );

$res=mysql_query( "SELECT sessions FROM $globals", $db );
$row=mysql_fetch_row( $res );
$sess_q=$row[0];
mysql_free_result( $res );

$i=0; $mtotal=0; $mtotal_mast=0; $cows_cnt=0; $t_sec=0;
$dots_cnt=0;

if ( $graph<1 ) {
	echo "
<table cellspacing='1' class='st2'>
<tr $cjust class='st_title2' style='height:28px'>
	<td width='7%'><b>".$ged['Number']."</b></td>
	<td><b>".$ged['Nick']."</b></td>";
	$res=mysql_query( "SELECT id, name FROM $sessions", $db );
	while ( $row=mysql_fetch_row( $res ))
		if ( $sess_q==3 ) {
			if ( floor( $row[0]/10 )*10==$row[0]*1 ) echo "
	<td width='10%'><b>".$ged['Milk,kg'].": ".$row[1]." ".$ged['o_mlk']."</b></td>";
		} else echo "
	<td width='10%'><b>".$ged['Milk,kg'].": ".$row[1]." ".$ged['o_mlk']."</b></td>";
	mysql_free_result( $res );
	echo "
	<td width='10%'><b>".$ged['Total_'].": ".$ged['milk,kg'].":</b></td>
	<td width='10%'><b>".$ged['From_Jan_01'].": ".$ged['milk,kg']."</b></td>
</tr>";
}

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;
while ( $yc<=$yl+1 ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	$yc1=$yc*10000; $mc1=$mc*100;
	if ( $yc1+$mc1<=$yl1+$ml1 ) {
		include( "f_jselm.php" );//DONT TOUCH THIS INCLUDE
		if ( $sqlerr<1 ) { while ( $row=mysql_fetch_row( $res )) {
			$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;
			if ( $odt>$yl1+$ml1+$dl );
			else if ( $odt<$yf1+$mf1+$df );
			else {
				$bd=$row[17]*1;
				if ((( trim( $filt_dev."." )!="." ) & ( $bd>=$bd_first ) & ( $bd<=$bd_last )) | (( trim( $filt_dev."." )=="." ) & ( $bd>0 ))) {
					$r=$row[0]*1;//cow_id
					$sess=$row[20]*1;
					$mdt=$row[1].".".$row[2].".".$row[3];//operation's date
					$m=$row[4]*1;//operations's milk
					$mcnt[$r]=$milk_cnt[$r]+1; $mq=$mq+1;//quantity of opers by cow, total quantity of opers
					if ( $m==0 ) {//with milk==0: quantity of opers by cow, total quantity of opers
						$milk0_cnt[$r]=$milk0_cnt[$r]+1; $m0q=$m0q+1;
					}
					$mbeg=$row[5]; $mend=$row[6]; $mtime=$row[7];//operation's begin & end & time
					$mast_4=$row[14]*1;//mastitus
//in this report only [BEGIN]
					$milk_from0101[$r]=$milk_from0101[$r]+$m;//milk by cow
					$mtotal_from0101=$mtotal_from0101+$m;//total milk
//in this report only [END]
					$milk_[$r]=$milk_[$r]+$m;//milk by cow
					$milk__[$r][$sess]=$milk__[$r][$sess]+$m;//milk by cow and session
					$mtotal=$mtotal+$m;//total milk
					if ( $mast_4>0 & $mast_4<5555 ) {//with mastitus: milk by cow & total milk
						$milk_mast[$r]=$milk_mast[$r]+$m;
						$mtotal_mast=$mtotal_mast+$m;
					}
					$tt=split( ":", $mtime ); $t_sec=$tt[0]*60+$tt[1]*1;//total time
					$milk_time[$r]=$milk_time[$r]+$t_sec;
					if ( $milk_beg[$r]*1==0 ) {
						$milk_beg[$r]=$milk_dt.", ".$mbeg."..".$mend;
						$milk_end[$r]=$milk_beg[$r];
					} else $milk_end[$r]=$milk_dt.", ".$mbeg."..".$mend;
				}
			}
		} mysql_free_result( $res ); }
	} else {
		$res1=mysql_query( "SELECT id, cow_num, nick FROM $cows ORDER BY cow_num*1", $db ); $sqlerr=mysql_errno();
		if ( $sqlerr<1 ) { while ( $row=mysql_fetch_row( $res1 )) {
			$r=$row[0]*1;
			$m=$milk_[$r];
			$m_mast=$milk_mast[$r]; if ( $m_mast==0 ) $m_mast="";
			$mcnt=$milk_cnt[$r];
			$m0cnt=$milk0_cnt[$r]; if ( $m0cnt==0 ) $m0cnt="";
			if ( $m<>0 ) {
				$rnum=$cownum_div.$row[1].$cownum_div1; $rnick=$row[2];
				$rnick_=StrCutLen1( $rnick, 41, $contentCharset );
				$mbeg=$milk_beg[$r]; $mend=$milk_end[$r];
				$t_sec=$milk_time[$r]; $t_hh=floor( $t_sec/3600 );
				$t_sec=$t_sec-$t_hh*3600; $t_mm=floor( $t_sec/60 );
				$t_sec=$t_sec-$t_mm*60; $t_ss=$t_sec;
				if ( $t_hh*1<10 ) $t_hh="0".$t_hh;
				if ( $t_mm*1<10 ) $t_mm="0".$t_mm;
				if ( $t_ss*1<10 ) $t_ss="0".$t_ss;
				$dots[$dots_cnt]=$m;
				$dots_cnt++;

				$m_from0101=$milk_from0101[$r];//milk by cow
				$m_sess[10]=$milk__[$r][10];
				$m_sess[11]=$milk__[$r][11];
				$m_sess[20]=$milk__[$r][20];
				$m_sess[21]=$milk__[$r][21];
				$m_sess[30]=$milk__[$r][30];
				$m_sess[31]=$milk__[$r][31];
				$mtotal_[10]=$mtotal_[10]+$m_sess[10];
				$mtotal_[11]=$mtotal_[11]+$m_sess[11];
				$mtotal_[20]=$mtotal_[20]+$m_sess[20];
				$mtotal_[21]=$mtotal_[21]+$m_sess[21];
				$mtotal_[30]=$mtotal_[30]+$m_sess[30];
				$mtotal_[31]=$mtotal_[31]+$m_sess[31];

				if ( $graph<1 ) {
					echo "
<tr ".RepTrCol().">
	<td $rjust onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm['0520']."?cow_id=".$row[0]."&ret0=-1' target='w1'>$rnum</td>
	<td title='$rnick' onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm['0520']."?cow_id=".$row[0]."&ret0=-1' target='w1'>".$rnick_."&nbsp;</td>";
					if ( $sess_q==3 ) echo "
	<td $rjust>$m_sess[10]&nbsp;</td>
	<td $rjust>$m_sess[20]&nbsp;</td>
	<td $rjust>$m_sess[30]&nbsp;</td>";
					else echo "
	<td $rjust>$m_sess[10]&nbsp;</td>
	<td $rjust>$m_sess[11]&nbsp;</td>
	<td $rjust>$m_sess[20]&nbsp;</td>
	<td $rjust>$m_sess[21]&nbsp;</td>
	<td $rjust>$m_sess[30]&nbsp;</td>
	<td $rjust>$m_sess[31]&nbsp;</td>";
					echo "
	<td $rjust>$m&nbsp;</td>
	<td $rjust>$m_from0101&nbsp;</td>
</tr>";
				}
			}
		} mysql_free_result( $res1 ); }
		break;
	}
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++; }
}

if ( $graph<1 ) {
	echo "
<tr $rjust class='st_title2'>
	<td $cjust class='st_title2'><b>".$ged['TOTAL'].":</td>
	<td><b>&nbsp;</td>";
	if ( $sess_q==3 ) {
		echo "
	<td><b>$mtotal_[10]&nbsp;</td>
	<td><b>$mtotal_[20]&nbsp;</td>
	<td><b>$mtotal_[30]&nbsp;</td>";
	} else echo "
	<td><b>$mtotal_[10]&nbsp;</td>
	<td><b>$mtotal_[11]&nbsp;</td>
	<td><b>$mtotal_[20]&nbsp;</td>
	<td><b>$mtotal_[21]&nbsp;</td>
	<td><b>$mtotal_[30]&nbsp;</td>
	<td><b>$mtotal_[31]&nbsp;</td>";
	echo "
	<td><b>$mtotal&nbsp;</td>
	<td><b>$mtotal_from0101&nbsp;</td>
</tr>
</table><br>";

} else {
	$dots_set=$dots[0];
	if ( $dots_cnt>300 ) $dots_cnt=300;//no more than 300 dots for JpGraph!
	for ( $i=1; $i<=$dots_cnt; $i++ ) $dots_set=$dots_set.";".$dots[$i];
	if ( $dots_cnt>2 ) {//no chance to build graph from less than two dots
		echo "
<center><input type='image' src='fgraphgd.php?dots_cnt=$dots_cnt&dots_set=$dots_set'></center>";
	} else;
}

ob_end_flush();
?>
