<?php
/* DF_2: reports/f_mlactc.php
report: count lactations
c: 09.06.2005
m: 15.02.2017 */

//get all needed opers
//from 22.07.2009 in this report all otels are ignored!
$query="SELECT code, oper_id, day, month, year, cow_id, int_8
 FROM $opers
 WHERE";
if ( $filt_cowid>0 ) $query=$query." cow_id=".$filt_cowid." AND (";
$query=$query." oper_id=2048 OR oper_id=128 OR oper_id=256 OR ( oper_id=64 AND int_8=7 ) OR ( oper_id=64 AND int_8=6 )";
if ( $filt_cowid>0 ) $query=$query.")";
$query=$query." ORDER BY year*10000+month*100+day";
$res=mysql_query( $query, $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	while ( $row=mysql_fetch_row( $res )) {
		$opertype=$row[1]*1;
		$cowid=$row[5]*1;
		if ( $opertype==64 ) {
			$depart=$row[6]*1;
			if ( $ended[$lact[$cowid]][$cowid]==0 ) {
				$ended[$lact[$cowid]][$cowid]=1;
				$lact_yl_=$row[4]; $lact_ml_=$row[3]; $lact_dl_=$row[2];
				$lact_yl[$lact[$cowid]][$cowid]=$lact_yl_*1;
				$lact_ml[$lact[$cowid]][$cowid]=$lact_ml_*1;
				$lact_dl[$lact[$cowid]][$cowid]=$lact_dl_*1;
				$lact_end[$lact[$cowid]][$cowid]=$lact_dl_.".".$lact_ml_.".".$lact_yl_;
				if ( $depart==7 ) $died[$lact[$cowid]][$cowid]=1;
				$lact_zapus[$lact[$cowid]][$cowid]=$lact_dl_.".".$lact_ml_.".".$lact_yl_;
			}
		} elseif ( $opertype==128 | $opertype==256 ) {
			$lact_yl_=$row[4]; $lact_ml_=$row[3]; $lact_dl_=$row[2];
			$lact_yl[$lact[$cowid]][$cowid]=$lact_yl_*1;
			$lact_ml[$lact[$cowid]][$cowid]=$lact_ml_*1;
			$lact_dl[$lact[$cowid]][$cowid]=$lact_dl_*1;
			$lact_ser[$lact[$cowid]][$cowid]=$lact_dl_.".".$lact_ml_.".".$lact_yl_;
			$lact_insem[$lact[$cowid]][$cowid]=$lact_dl_.".".$lact_ml_.".".$lact_yl_;
			$zapusk_date_next=date( "d.m.Y", mktime( 24*$zapusk_days0, 0, 0, $lact_ml_, $lact_dl_, $lact_yl_ ));
			$lact_zapus[$lact[$cowid]][$cowid]="<font color='#778899'>".$zapusk_date_next;
		} elseif ( $opertype==2048 ) {
			$lact[$cowid]=$lact[$cowid]+1; $lactm[$cowid]=-1;
			$lact_yf_=$row[4]; $lact_mf_=$row[3]; $lact_df_=$row[2];
			$lact_yf[$lact[$cowid]][$cowid]=$lact_yf_*1;
			$lact_mf[$lact[$cowid]][$cowid]=$lact_mf_*1;
			$lact_df[$lact[$cowid]][$cowid]=$lact_df_*1;
			$lact_beg[$lact[$cowid]][$cowid]=$lact_df_.".".$lact_mf_.".".$lact_yf_;
			$lact_abort[$lact[$cowid]][$cowid]=$lact_df_.".".$lact_mf_.".".$lact_yf_;
			if ( $lact[$cowid]>1 ) {//cow has more than one lactation
				if ( $ended[$lact[$cowid]-1][$cowid]==0 ) {
					$ended[$lact[$cowid]-1][$cowid]=1;
					$lact_yl_=$lact_yf_; $lact_ml_=$lact_mf_; $lact_dl_=$lact_df_;
					$lact_yl[$lact[$cowid]-1][$cowid]=$lact_yl_*1;
					$lact_ml[$lact[$cowid]-1][$cowid]=$lact_ml_*1;
					$lact_dl[$lact[$cowid]-1][$cowid]=$lact_dl_*1;
					$lact_end[$lact[$cowid]-1][$cowid]=$lact_dl_.".".$lact_ml_.".".$lact_yl_;
				}
			}
			$insem_date_next=date( "d.m.Y", mktime( 24*$insem_days0, 0, 0, $lact_mf_, $lact_df_, $lact_yf_ ));
			$lact_insem[$lact[$cowid]][$cowid]="<font color='#778899'>".$insem_date_next;
		}
	}
} else {
	$sqlerr=$sqlerr.": ".mysql_error();
	echo "<h3>".$php_mm["TABLE"]." '$opers': ".$php_mm["ERROR"]." MySQL $sqlerr.</h3>";
}

//set lactation starting & ending points
$res=mysql_query( "SELECT cow_num, nick, national_descr, b_num, b_date, id FROM $cows ORDER BY id", $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	while ( $row=mysql_fetch_row( $res )) {
		$cowid=$row[5];
		$b_day_dd=substr( $row[4], 8, 2 ); $b_day_mm=substr( $row[4], 5, 2 ); $b_day_yy=substr( $row[4], 0, 4 );
		$birthday=$b_day_dd.".".$b_day_mm.".".$b_day_yy; $days_frombirth=DaysBetween( $birthday, $now_dmY );
		$lactm=floor(( $days_frombirth-480-18-286)/305 );//thats count lactation number
		if ( $lact[$cowid]==0 ) {//cow has no lactation
			$lact[$cowid]=$lactm;
			$lact_auto[$cowid]=1;
			$lact_beg[$lactm][$cowid]=date( "d.m.Y", mktime( 0, 0, 0, $b_day_mm, $b_day_dd+480+18+286+305*( $lactm-1 ), $b_day_yy ));
			$lact_beg_=$lact_beg[$lactm][$cowid];
			$lact_yf[$lactm][$cowid]=substr( $lact_beg_, 6, 4 );
			$lact_mf[$lactm][$cowid]=substr( $lact_beg_, 3, 2 );
			$lact_df[$lactm][$cowid]=substr( $lact_beg_, 0, 2 );
			$lact_end[$lactm][$cowid]=date( "d.m.Y", mktime( 0, 0, 0, $lact_mf[$lactm][$cowid], $lact_df[$lactm][$cowid]+305, $lact_yf[$lactm][$cowid] ));
			$lact_end_=$lact_end[$lactm][$cowid];
			$lact_yl[$lactm][$cowid]=substr( $lact_end_, 6, 4 );
			$lact_ml[$lactm][$cowid]=substr( $lact_end_, 3, 2 );
			$lact_dl[$lactm][$cowid]=substr( $lact_end_, 0, 2 );
			$lact_days[$lactm][$cowid]=DaysBetween( $lact_beg[$lactm][$cowid], $lact_end[$lactm][$cowid] );
		} else if ( $lact[$cowid]==1 ) {//cow has one lactation
			list( $lact_yl[1][$cowid], $lact_ml[1][$cowid], $lact_dl[1] )=split( '[/.-]', $now_dmY );
			if ( $died[$lact[$cowid]][$cowid]==1 | $ended[$lact[$cowid]][$cowid]==1 );
			else {
				$lact_yl[1][$cowid]=$lact_yl[1][$cowid]*1;
				$lact_ml[1][$cowid]=$lact_ml[1][$cowid]*1;
				$lact_dl[1][$cowid]=$lact_dl[1][$cowid]*1;
				$lact_end[1][$cowid]=$now_dmY;
			}
			$lact_days[1][$cowid]=DaysBetween( $lact_beg[1][$cowid], $lact_end[1][$cowid] );
		} else {
			if ( $lact_end[$lact[$cowid]][$cowid]."." == "." ) $lact_days[$lact[$cowid]][$cowid]=DaysBetween( $lact_beg[$lact[$cowid]][$cowid], $now_dmY );
			else $lact_days[$lact[$cowid]][$cowid]=DaysBetween( $lact_beg[$lact[$cowid]][$cowid], $lact_end[$lact[$cowid]][$cowid] );
		}
	}
} else {
	$sqlerr=$sqlerr.": ".mysql_error();
	echo "<h3>".$php_mm["TABLE"]." '$cows': ".$php_mm["ERROR"]." MySQL $sqlerr.</h3>";
}
?>
