<?php
/* DF_2: oper/f_o_meas.php
INSERT oper ----4 (103) [meas]
c: 09.01.2006
m: 02.06.2017 */
	include_once( "f_o__000.php" );
	$dont_recalc=-1;
	$ik=count( $cows_arr ); if ( $ik>1 ) $ik--;
	for ( $i=0; $i<$ik; $i++ ) {
		$d1_=$_POST["d1_"];
		$d2_=$_POST["d2_"];
		$d3_=$_POST["d3_"];
		$d4_=$_POST["d4_"];
		$d5_=$_POST["d5_"];
		$d6_=$_POST["d6_"];
		$d7_=$_POST["d7_"];
		$d8_=$_POST["d8_"];
		$co=trim( $co_[$i] );
		$cow_id=$cows_arr[$i]*1;
		$opdate=split( "-", $dates_[$i] ); $d1=$opdate[0]; $m1=$opdate[1]; $y1=$opdate[2];
		$op_Ymd=$y1."-".$m1."-".$d1;
		$old_dmY=$z00;
		include_once( "f_o__zzz.php" );
		if ( $old_dmY!=$dates_[0] ) {
			if ( $co*1!=523041 ) mysql_query( "INSERT INTO $dbt (
			 `created_date`, `created_time`, `day`, `month`, `year`,
			 `comments`, `int_1`, `int_2`, `int_3`, `int_4`, `int_5`, `int_6`, `int_7`, `int_8`,
			 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
			 VALUES (
			 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
			 '$co', '$d1_[$i]', '$d2_[$i]', '$d3_[$i]', '$d4_[$i]', '$d5_[$i]', '$d6_[$i]', '$d7_[$i]', '$d8_[$i]',
			 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
			$op_id[0]=mysql_insert_id();
		} else {
			if ( $co*1!=523041 ) mysql_query( "UPDATE $dbt SET
			 int_1='$d1_[$i]',
			 int_2='$d2_[$i]',
			 int_3='$d3_[$i]',
			 int_4='$d4_[$i]',
			 int_5='$d5_[$i]',
			 int_6='$d6_[$i]',
			 int_7='$d7_[$i]',
			 int_8='$d8_[$i]',
			 comments='$co',
			 modif_uid='$userCoo', modif_date='$modif_Ymd', modif_time='$modif_His'
			 WHERE code=$delkeys[1]" );
			$op_id[0]=$delkeys[1];
		}
		if ( $varsession!=1 & strlen( $tmpdbt )>0 ) mysql_query( "INSERT INTO $tmpdbt (
		 `created_date`, `created_time`, `day`, `month`, `year`,
		 `comments`, `int_1`, `int_2`, `int_3`, `int_4`, `int_5`, `int_6`, `int_7`, `int_8`,
		 `oper_id`, `cow_id`, `modif_uid`, `modif_date`, `modif_time` )
		 VALUES (
		 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
		 '$co', '$d1_[$i]', '$d2_[$i]', '$d3_[$i]', '$d4_[$i]', '$d5_[$i]', '$d6_[$i]', '$d7_[$i]', '$d8_[$i]',
		 '$opertype', '$cow_id', '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
	}
?>
