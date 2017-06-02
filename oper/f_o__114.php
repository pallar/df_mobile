<?php
/* DF_2: oper/f_o_jagg.php
INSERT oper -8192 (114) [jagging and "disable milking"]
c: 10.08.2009
m: 02.06.2017 */

function Date_Decode( $dates__ ) {
	$dt=split( "-", $dates__ ); $dd=$dt[0]; $mm=$dt[1]; $yy=$dt[2];
	return $yy."-".$mm."-".$dd;
}

function Arr_s_Pack( $arr_s1, $arr_s2, $arr_s3, $arr_s9 ) {
	$arr1=$arr_s1=='on'; $arr2=$arr_s2=='on'; $arr3=$arr_s3=='on';
	$arr9=$arr_s9=='on';
	return Int2StrZ( $arr9, 1 ).Int2StrZ( $arr1*1+$arr2*2+$arr3*4, 5 );
}

	include_once( "f_o__000.php" );
	$ik=count( $cows_arr ); if ( $ik>1 ) $ik--;
	if ( $cows_arr[0]=="" ) { $cows_arr[0]=CookieGet( "ccwi" )*1; CookieSet( "ccwi", "" ); $key="11111111"; }
	for ( $i=0; $i<$ik; $i++ ) {
		$c1_=$_POST["c1_"];
		$c2_=$_POST["c2_"];
		$c3_=$_POST["c3_"];
		$c9_=$_POST["c9_"];
		$i1=10000+$i*1; $i2=20000+$i*1; $i3=30000+$i*1; $i4=40000+$i*1; $i5=50000+$i*1;
		$cow_id=$cows_arr[$i]*1;
		$opdate=split( "-", $dates_[$i] ); $d1=$opdate[0]; $m1=$opdate[1]; $y1=$opdate[2];
		$dt1=Date_Decode( $dates_[$i1] );
		$dt2=Date_Decode( $dates_[$i2] );
		$dt3=Date_Decode( $dates_[$i3] );
		$dt4=Date_Decode( $dates_[$i4] );
		$dt5=Date_Decode( $dates_[$i5] );
		$arr199=Arr_s_Pack( $c1_[$i1], $c2_[$i1], $c3_[$i1], $c9_[$i1] );
		$arr299=Arr_s_Pack( $c1_[$i2], $c2_[$i2], $c3_[$i2], $c9_[$i2] );
		$arr399=Arr_s_Pack( $c1_[$i3], $c2_[$i3], $c3_[$i3], $c9_[$i3] );
		$arr499=Arr_s_Pack( $c1_[$i4], $c2_[$i4], $c3_[$i4], $c9_[$i4] );
		$arr599=Arr_s_Pack( $c1_[$i5], $c2_[$i5], $c3_[$i5], $c9_[$i5] );
		$restrict_sched="$dt1:$arr199;";
		if ( $dt2!="1990-01-01" & $dt2!=$dt1 ) $restrict_sched=$restrict_sched."$dt2:$arr299;";
		if ( $dt3!="1990-01-01" & $dt3!=$dt2 & $dt3!=$dt1 ) $restrict_sched=$restrict_sched."$dt3:$arr399;";
		if ( $dt4!="1990-01-01" & $dt4!=$dt3 & $dt4!=$dt2 & $dt4!=$dt1 ) $restrict_sched=$restrict_sched."$dt4:$arr499;";
		if ( $dt5!="1990-01-01" & $dt5!=$dt4 & $dt5!=$dt3 & $dt5!=$dt2 & $dt5!=$dt1 ) $restrict_sched=$restrict_sched."$dt5:$arr599;";
		if ( $dt1=="1990-01-01" & strlen( $restrict_sched )<20 ) $restrict_sched="";
		Sql_query( "UPDATE $cows SET
		 restrict_sched='$restrict_sched',
		 modif_uid='$userCoo', modif_date='$modif_date', modif_time='$modif_His'
		 WHERE id=$cow_id" );
	}
?>
