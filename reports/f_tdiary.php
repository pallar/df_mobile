<?php
/* DF_2: reports/f_tdiary.php
report: todo_diary table
c: 23.11.2007
m: 11.09.2012 */

$j=0; $jk=0; $jk_byrow=25;//cows counter, cows in one row for stripped mode

//table header
if ( $cb_[$op]==0 ) {
	echo "
<table class='st2' style='width:100%'>
<tr $cjust class='st_title2' style='height:28px'>
	<td width='6%'><b>".$ged['Date']."</b></td>
	<td width='5%'><b>".$ged['Number']."</b></td>
	<td><b>".$ged['Nick']."</b></td>
	<td width='7%'><b>".$ged['Nat._Id.']."</b></td>
	<td width='7%'><b>".$ged['Birth_No.']."</b></td>
	<td width='7%'><b>".$ged['Birthday']."</b></td>
	<td width='4%'><b>".$ged['Age']."</b></td>
<!--
	<td width='4%'><b>".$ged['Lacts']."</b></td>
	<td width='4%'><b>".PhraseCarry( $ged['Lact._sched.'], " ", 1 )."</b></td>
-->
	<td width='4%'><b>".$ged['Lact.']."</b></td>
	<td width='7%'><b>".PhraseCarry( $_13_cw_lact_tot_milk_.",".$_13_cw_kg_, ",", 1)."</b></td>
	<td width='7%'><b>".PhraseCarry( $_13_cw_lact_max_milk_.",".$_13_cw_kg_, ",", 1)."</b></td>
	<td width='7%'><b>".PhraseCarry( $_13_cw_min_intens_.",".$_13_cw_kg_, ",", 1)."</b></td>
	<td width='7%'><b>".PhraseCarry( $_13_cw_avg_intens_.",".$_13_cw_kg_, ",", 1)."</b></td>
	<td width='7%'><b>".PhraseCarry( $_13_cw_max_intens_.",".$_13_cw_kg_, ",", 1)."</b></td>
</tr>";
} else {
	echo "
<table style='width:100%'>
<tr>
	<td>";
}

$query="SELECT
 $cows.cow_num, $cows.nick,
 $cows.national_descr,
 $cows.b_num, $cows.b_date,
 mother.nick, $oxes.nick,
 $breeds.nick,
 $groups.nick,
 $subgrs.nick,
 $lots.nick,
 $cows.mth_id, $cows.fth_id,
 $cows.breed_id,
 $cows.gr_id,
 $cows.subgr_id,
 $cows.lot_id,
 $cows.id,
 $cows.milk_total, $cows.milk_q, $cows.milk_max, $cows.milk_min,
 $cows.milkm_total, $cows.milkm_q, $cows.milkm_max, $cows.milkm_min,
 $cows.lact_days
 FROM $cows, $oxes, $cows mother, $breeds, $groups, $lots, $subgrs
 WHERE $oxes.id=$cows.fth_id AND
 mother.id=$cows.mth_id AND
 $breeds.id=$cows.breed_id AND
 $groups.id=$cows.gr_id AND
 $lots.id=$cows.lot_id AND
 $subgrs.id=$cows.subgr_id
 ORDER BY ".$cows_order_;
$res=mysql_query( $query );
while ( $row=mysql_fetch_row( $res )) {
	$cowid=$row[17]*1;
	$birthday=substr( $row[4], 8, 2 ).".".substr( $row[4], 5, 2 ).".".substr( $row[4], 0, 4 );
	$days_frombirth=DaysBetween( $birthday, $now_dmY );
	$days=DaysBetween( $cowst_date[$cowid], $now_dmY );
//	if ( $cowid==2 ) echo "$days $birthday $cowst_date[$cowid]<br>";
	$lactm=floor(( $days_frombirth-480-18-286)/305 ); if ( $lactm>5 ) $lactm=$lactm." ?";
	$lact=$cowst2048[$cowid];
//with no opers
	if ( $op==10 & $cowst[$cowid]==0 & $days_frombirth<480 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//to inseminate
	if ( $op==11 & (( $cowst[$cowid]==0 & $days_frombirth>=480 ) | ( $cowst[$cowid]==2048 & $days>=91 ))) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//inseminated
	if ( $op==12 & ( $cowst[$cowid]==128 | $cowst[$cowid]==256 ) & $days<=90 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//to do rectal
	if ( $op==13 & ( $cowst[$cowid]==128 | $cowst[$cowid]==256 ) & $days>=91 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//with fault insemin.
	if ( $op==14 & $cowst[$cowid]==512 & $cowst512[$cowid]<>4 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//pregnant
	if ( $op==15 & $cowst[$cowid]==512 & $cowst512[$cowid]==4 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//the beginning of lactation period
	if ( $op==17 & $cowst[$cowid]==2048 & $days<=90 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//ovulated
	if ( $op==18 & $cowst[$cowid]==2048 & $days>=91 & $days<=91+16) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//lactation period
	if ( $op==19 & $cowst[$cowid]==2048 & $days>=91+17 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//to zapusk
	if ( $op==20 & ( $cowst[$cowid]==128 | $cowst[$cowid]==256 ) & $days>=285-60 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
//zapusk period
	if ( $op==21 & $cowst[$cowid]==4096 & $days<=75 ) {
		$jk++;
		CowRow_Draw( $lactm ); if ( $jk==$jk_byrow & $cb_[$op+1]>0 ) { echo "<br>"; $jk=0; }
	}
}

mysql_free_result( $res );

if ( $cb_[$op]==0 ) {
	if ( $j>0 ) {
		echo "
<tr class='st_title2' style='height:28px'>
	<td $cjust><b>".$ged['TOTAL'].":&nbsp;</b></td>
	<td $rjust><b>$j&nbsp;</b></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
<!--
	<td>&nbsp;</td>
	<td>&nbsp;</td>
-->
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>";
	}
} else {
	echo "
	</td>
</tr>";
}
echo "
</table><br>";
?>
