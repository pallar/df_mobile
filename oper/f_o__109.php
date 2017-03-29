<?php
/* DF_2: oper/f_o_insm.php
INSERT oper --128/--256 (108/109) [insemination]
c: 09.01.2006
m: 10.11.2015 */
	include_once( "f_o__000.php" );

	$dbt_ext="_o";
	$dbt=$opers; Toper_create( $dbt );

	$dont_recalc=-1;
	$ik=count( $cows_arr ); if ( $ik>1 ) $ik--;
	for ( $i=0; $i<$ik; $i++ ) {
		$oxs_=$_POST["oxs_"];
//
		$co=trim( $co_[$i] );
		$cow_id=$cows_arr[$i]*1;
		$opdate=split( "-", $dates_[$i] ); $d1=$opdate[0]; $m1=$opdate[1]; $y1=$opdate[2];
		$op_Ymd=$y1."-".$m1."-".$d1;
		$old_dmY=$z00;
		$ox_id=$oxs_[$i]*1;
		include_once( "f_o__zzz.php" );
		if ( $old_dmY!=$dates_[0] ) {
			if ( $co*1!=523041 & $cow_id>1 ) {
				mysql_query( "INSERT INTO $dbt (
				 `created_date`, `created_time`, `day`, `month`, `year`,
				 `comments`, `int_8`,
				 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
				 VALUES (
				 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
				 '$co', '$ox_id',
				 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
				$op_id[0]=mysql_insert_id();
				$res=mysql_query( "SELECT a_dates
				 FROM $cows
				 WHERE id=$cow_id", $db );
				$row=mysql_fetch_row( $res );
				if ( strlen( $row[0] )==0 | $row[0]<$op_Ymd ) {
					mysql_query( "UPDATE $cows SET
					 a_dates='$op_Ymd',
					 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
					 WHERE id=$cow_id" );
					$dont_recalc=1;
				}
			}
		} else {
			if ( $co*1!=523041 ) mysql_query( "UPDATE $dbt SET
			 comments='$co',
			 int_8='$ox_id',
			 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
			 WHERE code=$delkeys[1]" );
			$op_id[0]=$delkeys[1];
		}
		if ( $dont_recalc!=1 ) {
			$last_insm="0000-00-00"; $op_Ymd="0000-00-00";
			if ( $cow_id>1 ) {
				$res=mysql_query( "SELECT day, month, year
				 FROM $dbt WHERE ( oper_id=128 OR oper_id=256 ) AND cow_id=$cow_id", $db );
				while ( $row=mysql_fetch_row( $res )) {
					$op_Ymd=$row[2]."-".$row[1]."-".$row[0];
					if ( $op_Ymd>$last_insm ) $last_insm=$op_Ymd;
				}
				if ( $last_insm=="0000-00-00" ) {
					mysql_query( "UPDATE $cows SET
					 a_dates='',
					 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
					 WHERE id=$cow_id" );
				} else {
					mysql_query( "UPDATE $cows SET
					 a_dates='$last_insm',
					 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
					 WHERE id=$cow_id" );
				}
			}
		}
		if ( $varsession!=1 & strlen( $tmpdbt )>0 ) mysql_query( "INSERT INTO $tmpdbt (
		 `created_date`, `created_time`, `day`, `month`, `year`,
		 `comments`, `int_8`,
		 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
		 VALUES (
		 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
		 '$co', '$ox_id',
		 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
	}
	include_once( "../oper/f_o__z01.php" );//auto_prep_zapusk
?>
