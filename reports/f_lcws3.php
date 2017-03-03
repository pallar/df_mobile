<?php
/* DF_2: reports/f_lcws3.php
report: status cows list
created: 17.06.2009
modified: 08.07.2015 */

$dbt_ext="_o";

$_GET[title]; $title_=$title;
if ( strlen( $title_ )<=1 ) $title_="???";
//oper_id that must be last
$_GET[locate_where]; $locate_where=split( ";", $locate_where );
//all oper_ids for SELECT query (split by ";")
$_GET[sele_where]; $select_where=split( ";", $sele_where );

include( "f_jfilt.php" );
include( "frhead.php" );

$rows_cnt=0; $t_min=0; $t_sec=0; $cows_cnt=0;

$_GET[operkeys]; if ( $operkeys*1==0 ) $operkeys=-1;
$_GET[opertype]; if ( $opertype*1==0 ) $opertype=-1;
$outsele_=$opertype; $outsele_table=-1; $outsele_field=-1;
if ( $select_where[0]*1!=0 ) $outsele1=$select_where[0]*1;
if ( $select_where[1]*1!=0 ) $outsele2=$select_where[1]*1;
if ( $select_where[2]*1!=0 ) $outsele3=$select_where[2]*1;
if ( $select_where[3]*1!=0 ) $outsele4=$select_where[3]*1;
if ( $select_where[4]*1!=0 ) $outsele5=$select_where[4]*1;
if ( $select_where[5]*1!=0 ) $outsele6=$select_where[5]*1;
if ( $select_where[6]*1!=0 ) $outsele7=$select_where[6]*1;
if ( $select_where[7]*1!=0 ) $outsele8=$select_where[7]*1;
$query_descending=1;

if ( $userCoo*1!=9 ) $operkeys=1;//TEMPORARY!!!

echo "
<table cellspacing='1' class='st2'>
<tr class='st_title2' style='height:28px'>
	<td $cjust width='5%'><b>".$ged['Date']."</b></td>
	<td $cjust width='5%'><b>".$ged['Modif._Time']."</b></td>
	<td $cjust width='55px'><b>".$ged['Number']."</b></td>
	<td $cjust><b>".$ged['Nick.']."</b></td>";
if ( $opertype*1==-1 ) echo "
	<td $cjust width='15%'><b>".$ged['What_Was_Done'];
echo "
	<td $cjust><b>".$ged['Detailed_Content'];
if ( $dbt_ext=="_o" ) echo "</b></td>
	<td $cjust><b>".$ged['Comment.']."</b></td>";
echo "
</tr>";

$query="SELECT descr, id FROM $pregnant"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $pregnan[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT descr, id FROM $states"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $stan[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT descr, id FROM $results"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $result[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT nick, id FROM $departs"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $dep[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT nick, id FROM $oxes"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $ox[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT nick, id FROM $cows"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) { $cow[$row[1]]=-1; $cowoperid[$row[1]]=-1; }
mysql_free_result( $res );

$yf=1991; $mf=01; $df=01;
$yl=2037; $ml=12; $dl=31;

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;
$dbt="000000_o";
include( "f_jselo.php" );
if ( $sqlerr<1 ) { while ( $row=mysql_fetch_row( $res )) {
	$yc1=$row[3]*10000; $mc1=$row[2]*100;//when all operations are in one table
	$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;
	if ( $odt>$yl1+$ml1+$dl );
	else if ( $odt<$yf1+$mf1+$df );
	else {
		$INVALID_OPER=0;//filter for not simple operations, f. e. rectal
		$cowid=$row[0]*1;
		if ( $dbt_ext=="_o" ) $oper_id=$row[18]*1; else $oper_id=1;
//======================
		if (( $locate_where[0]*1==512 | $locate_where[1]*1==512 ) & $row[13]*1<4 ) $INVALID_OPER=1;
//======================
		if ( $cowoperid[$cowid]==-1 ) {
//======================
			$o_ddmmyyy=$row[1].".".$row[2].".".$row[3];
			if ( $locate_where[0]*1==64 ) {//moving
				if ( $oper_id==64 & $row[14]!=1 )
					$INVALID_OPER=1;
			} else if ( $locate_where[0]*1==127 ) {//ready for insemination
				if ((( $oper_id==1024 | $oper_id==2048 ) & DaysBetween( $o_ddmmyyy, $now_dmY )*1<90 ) | ( $oper_id==128 | $oper_id=256 ))
					$INVALID_OPER=1;
			} else if ( $locate_where[0]*1==511 ) {//ready for rectal
				if (( $oper_id==128 | $oper_id==256 ) & DaysBetween( $o_ddmmyyy, $now_dmY )*1<90 )
					$INVALID_OPER=1;
			} else if ( $locate_where[0*1]==2048 ) {//ready for lactation
				if (( $oper_id=2048 & DaysBetween( $o_ddmmyyy, $now_dmY )*1<90 ) | $oper_id!=2048 )
					$INVALID_OPER=1;
			} else if ( $locate_where[0*1]==2049 ) {//ready for lactation end
				if (( $oper_id=2048 & DaysBetween( $o_ddmmyyy, $now_dmY )*1<306 ) | $oper_id!=2048 )
					$INVALID_OPER=1;
			} else if (( $locate_where[1]*1>0 | $locate_where[1]*1>0 ) & $oper_id!=$locate_where[0]*1 & $oper_id!=$locate_where[1]*1 )
			$INVALID_OPER=1;
			if ( $cow[$cowid]!=1 ) {
				if ( $INVALID_OPER!=1 ) $cows_cnt=$cows_cnt+1;
				$cow[$cowid]=1;
			}
//======================
			$operkey="$row[1].$row[2].$row[3]&nbsp;";
			include( "f_odecod.php" );
			if ( $operkeys!=-1 ) $operkey="<a href='../oper/f_o_$url_.php?$params&opertype=$oper_id&key=$dbt:$row[22]:$row[0]'>".$operkey."</a>";
			$cowoperid[$cowid]=$oper_id;
			$cowoperkey[$cowid]=$operkey;
			$upd_date=$row[21]; $upd_time=$row[24];
			$cowopertime[$cowid]=Date_FromDb2Scr( $upd_date, "." )."<br>$upd_time&nbsp;";
//if rectal result is fault, then this oper is fault!
			if ( $INVALID_OPER!=1 ) {
				$rows_cnt++;
				RepTr( $rownum );
				$cownum=$cownum_div.$row[4].$cownum_div1;
				$cownick=$row[5];
				$cowoperdes=$row[6];
				echo "
	<td>$operkey</td>
	<td>$cowopertime[$cowid]</td>
	<td $rjust>".$cownum."</td>
	<td>".$cownick."&nbsp;</td>";
				if ( $opertype*1==-1 ) echo "
	<td>".$cowoperdes."&nbsp;</td>";
				echo "
	<td>$descr&nbsp;</td>";
				if ( $dbt_ext=="_o" ) echo "
	<td>$row[17]&nbsp;</td>";
				echo "
</tr>";
			}
		}
	}
} mysql_free_result( $res ); }

if ( $locate_where[0]==64 ) {
	$query="SELECT nick, cow_num, id FROM $cows ORDER BY nick"; $res=mysql_query( $query, $db );
	while ( $row=mysql_fetch_row( $res )) {
		$cowid=$row[2]*1;
		if ( $cowoperid[$cowid]==-1 ) {
			$rows_cnt++;
			if ( $cow[$cowid]!=1 ) {
				$cows_cnt++;
				$cow[$cowid]=1;
			}
			RepTr( $rownum );
			$cownum=$cownum_div.$row[1].$cownum_div1;
			$cownick=$row[0];
			echo "
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td $rjust>".$cownum."</td>
	<td>".$cownick."&nbsp;</td>";
			if ( $opertype*1==-1 ) echo "
	<td>&nbsp;</td>";
			echo "
	<td>&nbsp;</td>";
			if ( $dbt_ext=="_o" ) echo "
	<td>&nbsp;</td>";
			echo "
</tr>";
		}
	}
}

echo "
<tr class='st_title2' style='height:28px'>
	<td $cjust><b>".$ged['TOTAL'].":</b></td>
	<td $rjust><center>".$ged['rows'].":</center><b>$rows_cnt&nbsp;</b></td>
	<td $rjust><center>".$ged['animals'].":</center><b>$cows_cnt&nbsp;</b></td>
	<td><b>$vl&nbsp;</b></td>";
if ( $opertype*1==-1 ) echo "
	<td><b>&nbsp;</b></td>";
echo "
	<td><b>&nbsp;</b></td>";
if ( $dbt_ext=="_o" ) echo "
	<td><b>&nbsp;</b></td>";
echo "
</tr>
</table><br>";
?>
