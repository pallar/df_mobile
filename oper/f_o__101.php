<?php
/* DF_2: oper/f_o_mlk.php
INSERT oper ----1 (101) [milking]
c: 09.01.2006
m: 23.03.2017 */
	include_once( "../f_o__000.php" );

	$dbt_ext="_m";

	$dont_recalc=-1;
	$ik=count( $cows_arr ); if ( $ik>1 ) $ik--;
	for ( $i=0; $i<count( $cows_arr )-1; $i++ ) {
		$cow_id=$cows_arr[$i]*1;
		$opdate=split( "-", $dates_[$i] ); $d1=$opdate[0]; $m1=$opdate[1]; $y1=$opdate[2];
		$dbt=$y1.$m1.$dbt_ext; Tmilk_create( $dbt );
//is there char ":" in arr_???[$i]?
		if ( strlen( $arr_beg[$i] )<8 ) $arr_beg[$i]="00:00:00";
		if ( strlen( $arr_dur[$i] )<5 ) $arr_dur[$i]="01:00";
		$arr_end[$i]=$arr_beg[$i];
		$_beg_=split( ":", trim( $arr_beg[$i] ));
		$_beg1=$_beg_[0]*3600+$_beg_[1]*60;
		$_end_=split( ":", trim( $arr_end[$i] ));
		$_end1=$_end_[0]*3600+$_end_[1]*60;
		$_dur_=split( ":", $arr_dur[$i] );
//milk total > 50 kg
		if ( $arr_kg[$i]*1>50 ) {
			$errmsg1=$ged["_06_err_01"]."<br>";
//			$err1=1;
		}
//session's milk total > milk total
		if ( $arr_kg0[$i]*1+$arr_kg1[$i]*1+$arr_kg2[$i]*1>$arr_kg[$i]*1 ) {
			$errmsg1=$ged["_06_err_02"]."<br>";
			if ( $err1 ) $errmsg=$errmsg.$errmsg1; else $errmsg=$errmsg1;
//			$err1=1;
		}
//time wrong formats
		if ( count( $_beg_ )<3 ) {
			$errmsg1=$ged["_06_err_03"]."<br>";
			if ( $err1 ) $errmsg=$errmsg.$errmsg1; else $errmsg=$errmsg1;
//			$err1=1;
		}
		if ( count( $_end_ )<3 ) {
			$errmsg1=$ged["_06_err_04"]."<br>";
			if ( $err1 ) $errmsg=$errmsg.$errmsg1; else $errmsg=$errmsg1;
//			$err1=1;
		}
		if ( $_end1<$_beg1 ) {
			$errmsg1=$ged["_06_err_05"]."<br>";
			if ( $err1 ) $errmsg=$errmsg.$errmsg1; else $errmsg=$errmsg1;
//			$err1=1;
		}
		if ( count( $_dur_ )<2 ) {
			$errmsg1=$ged["_06_err_06"]."<br>";
			if ( $err1 ) $errmsg=$errmsg.$errmsg1; else $errmsg=$errmsg1;
//			$err1=1;
		}
		if ( $err1 ) {
			echo "<h2>".$ged["_06_errors"].$cow_num[$cow_id].":</h2>";
			echo "$errmsg";
			break;
		} else {
			if ( $arr_notag[$i]=='on' ) $arr_notag[$i]=1;
			if ( $arr_stopped[$i]=='on' ) $arr_stopped[$i]=1;
			if ( $arr_exhaust[$i]=='on' ) $arr_exhaust[$i]=1;
			$tmp=$arr_m4[$i]; while ( strlen( $tmp )<4 ) $tmp=$tmp."0"; $arr_m4[$i]=$tmp;
			if (( $arr_m[$i]=='on' ) & ( $arr_m4[$i]*1==0 )) $arr_m4[$i]=5555;
			if ( $arr_t[$i]=='on' ) $arr_t[$i]=1; else $arr_t[$i]=0;
			if ( $arr_o[$i]=='on' ) $arr_o[$i]=1; else $arr_o[$i]=0;
				mysql_query( "INSERT INTO $dbt (
				 `created_date`, `created_time`, `day`, `month`, `year`,
				 `milk_kg`, `kg_30s`, `kg_60s`, `kg_90s`,
				 `milk_begin`, `milk_end`, `milk_time`,
				 `milk_sess`,
				 `comments`,
				 `manual`, `retries`, `stopped`, `exhaust`,
				 `mast_4`, `tr`, `ov`,
				 `id_time`, `rep_time`,
				 `bd_num`,
				 `cow_id`,
				 `modif_uid`, `modif_date`, `modif_time` )
				 VALUES (
				 '$modif_Ymd', '$modif_His', '$d1', '$m1', '$y1',
				 '$arr_kg[$i]', '$arr_kg0[$i]', '$arr_kg1[$i]', '$arr_kg2[$i]',
				 '$arr_beg[$i]', '$arr_end[$i]', '$arr_dur[$i]',
				 '$arr_sess[$i]',
				 '$arr_comm[$i]',
				 '$arr_notag[$i]', '$arr_retr[$i]', '$arr_stopped[$i]', '$arr_exhaust[$i]',
				 '$arr_m4[$i]', '$arr_t[$i]', '$arr_o[$i]',
				 '$arr_beg[$i]', '$arr_end[$i]',
				 '00',
				 '$cows_arr[$i]',
				 '$userCoo', '$modif_Ymd', '$modif_His' )", $db );
		}
	}
?>
