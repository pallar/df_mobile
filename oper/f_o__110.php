<?php
/* DF_2: oper/f_o_rect.php
INSERT oper --512 (110) [rectal condition]
c: 09.01.2006
m: 02.06.2017 */
	include_once( "f_o__000.php" );
	$dont_recalc=-1;
	$ik=count( $cows_arr ); if ( $ik>1 ) $ik--;
	for ( $i=0; $i<$ik; $i++ ) {
		$d7_1_=$_POST["d7_1_"];
		$d7_2_=$_POST["d7_2_"];
		$d7_=$_POST["d7_"];
		$d8_=$_POST["d8_"];
		$co=trim( $co_[$i] );
		$cow_id=$cows_arr[$i]*1;
		$opdate=split( "-", $dates_[$i] ); $d1=$opdate[0]; $m1=$opdate[1]; $y1=$opdate[2];
		$op_Ymd=$y1."-".$m1."-".$d1;
		$old_dmY=$z00;
		include_once( "f_o__zzz.php" );
		if ( $old_dmY!=$dates_[0] ) {
			if ( $co*1!=523041 & $cow_id>1 ) {
				mysql_query( "INSERT INTO $dbt (
				 `created_date`, `created_time`, `day`, `month`, `year`,
				 `comments`,
				 `int_7`, `int_8`,
				 `data_5:8`,
				 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
				 VALUES (
				 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
				 '$co', '$d7_1_[$i]', '$d7_2_[$i]', '@@@$d7_[$i]@$d8_[$i]',
				 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
				$op_id[0]=mysql_insert_id();
				$res=mysql_query( "SELECT b_dates
				 FROM $cows
				 WHERE id=$cow_id", $db );
				$row=mysql_fetch_row( $res );
				if ( strlen( $row[0] )==0 | $row[0]<$op_Ymd ) {
					mysql_query( "UPDATE $cows SET
					 b_dates='$op_Ymd', b_dates_res='$d7_1_[$i]',
					 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
					 WHERE id=$cow_id" );
					$dont_recalc=1;
				}
			}
		} else {
			if ( $co*1!=523041 ) mysql_query( "UPDATE $dbt SET
			 comments='$co',
			 int_7='$d7_1_[$i]', int_8='$d7_2_[$i]',
			 `data_5:8`='@@@$d7_[$i]@$d8_[$i]',
			 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
			 WHERE code=$delkeys[1]" );
			$op_id[0]=$delkeys[1];
		}
		if ( $dont_recalc!=1 ) {
			$last_rect="0000-00-00"; $last_rect_res="1";
			if ( $cow_id>1 ) {
				$res=mysql_query( "SELECT day, month, year, int_7
				 FROM $dbt WHERE oper_id=512 AND cow_id=$cow_id", $db );
				while ( $row=mysql_fetch_row( $res )) {
					$op_Ymd=$row[2]."-".$row[1]."-".$row[0];
					if ( $op_Ymd>=$last_rect ) {
						$last_rect=$op_Ymd;
						$last_rect_res=$row[3];
					}
				}
				if ( $last_rect=="0000-00-00" ) {
					mysql_query( "UPDATE $cows SET
					 b_dates='', b_dates_res='$last_rect_res',
					 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
					 WHERE id=$cow_id" );
				} else {
					mysql_query( "UPDATE $cows SET
					 b_dates='$last_rect', b_dates_res='$last_rect_res',
					 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
					 WHERE id=$cow_id" );
				}
			}
		}
		if ( $varsession!=1 & strlen( $tmpdbt )>0 ) mysql_query( "INSERT INTO $tmpdbt (
		 `created_date`, `created_time`, `day`, `month`, `year`,
		 `comments`, `int_7`, `int_8`,
		 `data_5:8`,
		 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
		 VALUES (
		 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
		 '$co', '$d7_1_[$i]', '$d7_2_[$i]',
		 '@@@$d7_[$i]@$d8_[$i]',
		 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
	}
?>
