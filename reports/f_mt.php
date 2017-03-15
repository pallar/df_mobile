<?php
/* DF_2: reports/f_mt.php
report: extracting by table
c: 25.12.2005
m: 15.03.2017 */

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

$restrict_field=$_GET["select_field"];

$outsele__=$outsele_;//ERROR!!!
$outsele_field__=$outsele_field_;//ERROR!!!

include( "f_jfilt.php" );

$th1=$ged["Number"];
if ( $outsele_*1==-1 ) $th2=$ged["Nick"]." / ".$ged["Group"];
else $th2=$ged["Name"];
$th3=$ged["Milk"].",".$ged["kg"];
$th4=$ged["Start/Stop"];
$th5=$ged["Animals"];
$th6=$ged["Starting"];
$th7=$ged["Ending"];
$th8=$ged["Duration"];
$th3_1=$ged["total_"];
$th3_2=$ged["average"];
$th3_3=$ged["average:animal"];
$th3_4=$ged["average:date"];
$th3_5=$ged["mastit"];
$th4_1=$ged["total_"];
$th4_2="0 ".$ged["kg"];

$th_cnt=13;
$th[1]=$th1; $th[2]=$th2;
$th[3]=$th3." : ".$th3_1; $th[4]=$th3." : ".$th3_2; $th[5]=$th3." : ".$th3_3;
$th[6]=$th3." : ".$th3_4; $th[7]=$th3." : ".$th3_5;
$th[8]=$th4." : ".$th4_1; $th[9]=$th4." : ".$th4_2;
$th[10]=$th5; $th[11]=$th6; $th[12]=$th7; $th[13]=$th8;
if ( $restrict_field=="c.id" ) {
	$th_cnt=12;
	$th[1]=$th1; $th[2]=$th2;
	$th[3]=$th3." : ".$th3_1; $th[4]=$th3." : ".$th3_2; $th[5]=$th3." : ".$th3_3;
	$th[6]=$th3." : ".$th3_4; $th[7]=$th3." : ".$th3_5;
	$th[8]=$th4." : ".$th4_1; $th[9]=$th4." : ".$th4_2;
 	$th[10]=$th6; $th[11]=$th7; $th[12]=$th8;
}

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1) { background:#ddd; }";
for ( $i=1; $i<=$th_cnt; $i++ ) $_mod_rep_CSS_content=$_mod_rep_CSS_content."
	#rep_tbody td:nth-of-type(".$i."):before { content:\"".$th[$i]."\"; text-align:left; top:0; }";

include( "frhead.php" );

if ( $title_==$ged["RR2102"] ) $title_next=$ged["RR2102-"];
if ( $title_==$ged["RR2103"] ) $title_next=$ged["RR2103-"];
if ( $title_==$ged["RR2103.A"] ) $title_next=$ged["RR2103.A-"];
if ( $title_==$ged["RR2104"] ) $title_next=$ged["RR2104-"];
if ( $title_==$ged["RR0301"] ) $title_next=$ged["RR0301-"];

$outsele_=$outsele__;//ERROR!!!
$outsele_field_=$outsele_field__;//ERROR!!!

$t_cows=$t_m=$t_mq=$t_m0q=$t_mmast=$t_ids=$dots_cnt=0;
$repbeg=$yf.$mf.$df; $repend=$yl.$ml.$dl;

if ( $outsele_*1==-1 ) $db_id=0; else $db_id=21;

if ( $graph<1 ) {
	echo "
<table>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th rowspan='2' width='7%'><b>".$th1."</b></th>
	<th class='th' rowspan='2'><b>".$th2."</b></th>
	<th colspan='5'><b>".$th3."</b></th>
	<th colspan='2'><b>".$th4."</b></th>";
	if ( $restrict_field!="c.id" ) echo "
	<th rowspan='2' width='50px'><b>".$th5."</b></th>";
	echo "
	<th rowspan='2' width='167px'><b>".$th6."</b></th>
	<th rowspan='2' width='167px'><b>".$th7."</b></th>
	<th rowspan='2' width='7%'><b>".$th8."</b></th>
</tr>
<tr $cjust>
	<th width='7%'><b>".$th3_1."</b></th>
	<th width='7%'><b>".$th3_2."</b></th>
	<th width='7%'><b>".$th3_3."</b></th>
	<th width='7%'><b>".$th3_4."</b></th>
	<th width='7%'><b>".$th3_5."</b></th>
	<th width='50px'><b>".$th4_1."</b></th>
	<th width='50px'><b>".$th4_2."</b></th>
</tr>
</thead>
<tbody id='rep_tbody'>";
}

while ( $yc<=$yl+1 ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	if ( $yc*100+$mc<=$yl*100+$ml ) {
		include( "f_jselm.php" );//DONT TOUCH THIS!
		if ( $sqlerr<1 ) { while ( $row=mysql_fetch_row( $res )) {
			$dc=$row[1]*1;//operation's day
			$odt=$yc.$mc.$dc;//operation's date
			if ( $odt>$repend | $odt<$repbeg );
			else {//operation's in period, thats calc
				$bd=$row[17]*1;
				if ((( trim( $filt_dev."." )!="." ) & ( $bd>=$bd_first ) & ( $bd<=$bd_last )) | (( trim( $filt_dev."." )=="." ) & ( $bd>0 ))) {
					$r=$row[$db_id]*1;//id
					$cowid=$row[0]*1;
					if ( $cowuniq[$cowid]==0 ) $t_cows++;
					if ( $cowuniq[$cowid]==0 ) $r_cows[$r]++;
					if ( $cowdtuniq[$cowid][$odt]==0 ) $r_dt[$r]++;
					$cowuniq[$cowid]=1;
					$cowdtuniq[$cowid][$odt]=1;
					$mdt=$row[1].".".$row[2].".".$row[3];//operation's date
					$m=$row[4]*1;//operations's milk
					$r_mq[$r]++; $t_mq++;//quantity of opers by id, total quantity of opers
					if ( $m==0 ) {//with milk==0: quantity of opers by id, total quantity of opers
						$r_m0q[$r]++; $t_m0q++;
					}
					$mbeg=$row[5]; $mend=$row[6]; $mtime=$row[7];//operation's begin, end & time
					$mast_4=$row[14]*1;//mastitus
					$r_m[$r]=$r_m[$r]+$m;//milk by id
					$t_m=$t_m+$m;//total milk
					if ( $mast_4>0 & $mast_4<5555 ) {//with mastitus: milk by id & total milk
						$r_mmast[$r]=$r_mmast[$r]+$m;
						$t_mmast=$t_mmast+$m;
					}
					$tt=split( ":", $mtime ); $tsec=$tt[0]*60+$tt[1]*1;//total time
					$r_tsec[$r]=$r_tsec[$r]+$tsec;
					if ( $r_beg[$r]*1==0 ) {
						$r_beg[$r]=$mdt.", ".$mbeg."..".$mend;
						$r_end[$r]=$r_beg[$r];
					} else $r_end[$r]=$mdt.", ".$mbeg."..".$mend;
				}
			}
		} mysql_free_result( $res ); }
	} else {
		if ( $outsele_*1==-1 ) $res1=mysql_query( "SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $cows.gr_id=$groups.id ORDER BY cow_num*1", $db );
		else $res1=mysql_query( "SELECT id, num, nick FROM $outsele_table ORDER BY nick", $db );
		if ( mysql_errno()<1 ) { while ( $row=mysql_fetch_row( $res1 )) {
			$r=$row[0]*1;
			if ( $r_mq[$r]>0 ) {
				$t_ids++;
				if ( $r_mq[$r]==0 ) { $r_m1="&nbsp;"; $r_mq[$r]="&nbsp;"; }
				else { $r_m1=floor( $r_m[$r]/$r_mq[$r]*10 )/10; }
				if ( $r_cows[$r]==0 ) { $r_m2="&nbsp;"; $r_cows[$r]="&nbsp;"; }
				else { $r_m2=floor( $r_m[$r]/$r_cows[$r]*10 )/10; }
				if ( $r_dt[$r]==0 ) { $r_m3="&nbsp;"; $r_dt[$r]="&nbsp;"; }
				else { $r_m3=floor( $r_m[$r]/$r_dt[$r]*10 )/10; }
				if ( $r_mmast[$r]==0 ) $r_mmast[$r]="&nbsp;";
				if ( $r_m0q[$r]==0 ) $r_m0q[$r]="&nbsp;";
				if ( $graph<1 ) {//show text report
					$num=$cownum_div.$row[1].$cownum_div1;
					$nick=$row[2];
					$tsec=$r_tsec[$r]; $t_hh=floor( $tsec/3600 );
					$tsec=$tsec-$t_hh*3600; $t_mm=floor( $tsec/60 );
					$tsec=$tsec-$t_mm*60; $t_ss=$tsec;
					if ( $t_hh*1<10 ) $t_hh="0".$t_hh;
					if ( $t_mm*1<10 ) $t_mm="0".$t_mm;
					if ( $t_ss*1<10 ) $t_ss="0".$t_ss;
					if ( $outsele_*1==-1 ) {
						$nick1=$nick."&nbsp;/&nbsp;".$row[3];
						$nick_=StrCutLen1( $nick, 27, $contentCharset )."<br>/&nbsp;".$row[3];
					} else {
						$nick1=$nick;
						$nick_=StrCutLen1( $nick, 27, $contentCharset );
					}
					$title_next_=$title_next.":&nbsp;".$nick;
					echo "
<tr $rjust>";
					if ( $db_id+$noCSS<1 ) echo "
	<td onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm["0520"]."?cow_id=$r&ret0=-1'><b>".$num."</b></td>
	<td $ljust title='".$nick1."' onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm['0520']."?cow_id=".$row[0]."&ret0=-1'>&nbsp;".$nick_."</td>";
					else echo "
	<td>$num</td>
	<td $ljust title='".$nick."'>&nbsp;".$nick_."</td>";
					if ( $noCSS ) echo "
	<td>".$r_m[$r]."</td>"; else echo "
	<td onmouseover='style.cursor=\"pointer\"'><a href='../".$hRep["m"]."?restrict_id=$r&restrict_field=$restrict_field&restrict_by_field=1&title=$title_next_'>".$r_m[$r]."</td>";
					echo "
	<td>".$r_m1."</td>
	<td>".$r_m2."</td>
	<td>".$r_m3."</td>
	<td>".$r_mmast[$r]."</td>
	<td>".$r_mq[$r]."</td>
	<td>".$r_m0q[$r]."</td>";
	if ( $restrict_field!="c.id" ) echo "
	<td>".$r_cows[$r]."</td>";
	echo "
	<td $cjust>".$r_beg[$r]."</td>
	<td $cjust>".$r_end[$r]."</td>
	<td $cjust>".$t_hh.":".$t_mm.":".$t_ss."</td>
</tr>";
				} else {//show diagram
					$dots[$dots_cnt]=$mrow[$r];
					$dots_cnt++;
				}
			}
		} mysql_free_result( $res1 ); }
		break;
	}
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++; }
}

if ( $graph<1 ) {
	if ( $t_mq>0 ) $t_m1=round( $t_m/$t_mq, 1 ); else $t_m1="&nbsp;";
	if ( $t_cows>0 ) $t_m2=round( $t_m/$t_cows, 1 ); else $t_m2="&nbsp;";
	echo "
</tbody>
<tfoot id='rep_tfoot'>
<tr $rjust height='28px'>
	<td $cjust><b>".$ged["TOTAL"].":</b></td>
	<td><b>".$t_ids."</b></td>
	<td><b>".$t_m."</b></td>
	<td><b>".$t_m1."</b></td>
	<td><b>".$t_m2."</b></td>
	<td>&nbsp;</td>
	<td><b>".$t_mmast."</b></td>
	<td><b>".$t_mq."</b></td>
	<td><b>".$t_m0q."</b></td>";
	if ( $restrict_field!="c.id" ) echo "
	<td><b>".$t_cows."</b></td>";
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
	for ( $i=1; $i<=$dots_cnt; $i++ )
		$dots_set=$dots_set.";".$dots[$i];
	if ( $dots_cnt>2 ) {//no chance to build graph from less than two dots
		echo "
<br>
<font size='5'><b>&#8661;</b></font>&nbsp;".$ged["Milk"].",".$ged["kg"]."
<center><input type='image' src='fgraphgd.php?dots_cnt=$dots_cnt&dots_set=$dots_set'></center>";
	} else;
}

include( "frfoot.php" );

ob_end_flush();
?>
