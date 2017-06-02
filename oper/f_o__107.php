<?php
/* DF_2: oper/f_o_mov.php
INSERT oper ---64 (107) [moving & death]
c: 09.01.2006
m: 10.11.2015 */
	include_once( "f_o__000.php" );
	$dont_recalc=-1;
	$ik=count( $cows_arr ); if ( $ik>1 ) $ik--;
	for ( $i=0; $i<$ik; $i++ ) {
		$dps_=$_POST["dps_"];
		$dep_id=$dps_[$i]*1;
		$co=trim( $co_[$i] );
		$cow_id=$cows_arr[$i]*1;
		$opdate=split( "-", $dates_[$i] ); $d1=$opdate[0]; $m1=$opdate[1]; $y1=$opdate[2];
		$op_Ymd=$y1."-".$m1."-".$d1;
		$old_dmY=$z00;
		include_once( "f_o__zzz.php" );
		if ( $old_dmY!=$dates_[0] ) {
			if ( $co*1!=523041 ) mysql_query( "INSERT INTO $dbt (
			 `created_date`, `created_time`, `day`, `month`, `year`,
			 `comments`, `int_8`,
			 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
			 VALUES (
			 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
			 '$co', '$dep_id',
			 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
			$op_id[0]=mysql_insert_id();
		} else {
			if ( $co*1!=523041 ) mysql_query( "UPDATE $dbt SET
			 comments='$co',
			 int_8='$dep_id',
			 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
			 WHERE code=$delkeys[1]" );
			$op_id[0]=$delkeys[1];
		}
		if ( $co*1==523041 ) {
			$opdate=split( "-", $old_dmY ); $d1=$opdate[0]; $m1=$opdate[1]; $y1=$opdate[2];
			$co="<center><font size=4>".$php_mm["_06_oper_deleted_"]."!</font></center>";
			$coo=-1;
		}
		if ( $cow_id>1 ) {
			$last_dead="0000-00-00";
			$res=mysql_query( "SELECT day, month, year
			 FROM $dbt WHERE oper_id=64 AND int_8=7 AND cow_id=$cow_id", $db );
			$sqlerr=mysql_errno();
			if ( $sqlerr==0 ) while ( $row=mysql_fetch_row( $res )) {
				$op_Ymd=$row[2]."-".$row[1]."-".$row[0];
				$last_dead=$op_Ymd;
			}
			if ( $last_dead=="0000-00-00" ) {
				mysql_query( "UPDATE $cows SET
				 z_dates='',
				 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
				 WHERE id=$cow_id" );
			} else {
				mysql_query( "UPDATE $cows SET
				 z_dates='$last_dead',
				 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
				 WHERE id=$cow_id" );
			}
		}
		if ( $varsession!=1 & strlen( $tmpdbt )>0 ) mysql_query( "INSERT INTO $tmpdbt (
		 `created_date`, `created_time`, `day`, `month`, `year`,
		 `comments`, `int_8`,
		 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
		 VALUES (
		 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
		 '$co', '$dep_id',
		 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
	}
?>
