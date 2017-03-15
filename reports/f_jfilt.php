<?php
/* DF_2: reports/f_jfilt.php
report: input filter for any report
c: 20.02.2007
m: 14.03.2017 */

if ( $stop_f_jfilt==0 ) {
	function PHP3_cal_days_in_month( $CAL_TYPE, $mm, $yyyy ) {
		$days_in_month=31;
		$mm=$mm*1; $yyyy=$yyyy*1;
		if ( $mm==2 ) {
			if ( floor( $yyyy/4 )*4==$yyyy ) $days_in_month=29; else $days_in_month=28;
		}
		if ( $mm==4 ) $days_in_month=30;
		if ( $mm==6 ) $days_in_month=30;
		if ( $mm==9 ) $days_in_month=30;
		if ( $mm==11 ) $days_in_month=30;
		return $days_in_month;
	}

	if ( $stop_f_jfilt_include==0 ) {
		include( "../f_vars.php" );
		include( "../dflib/f_func.php" );
		include( "../locales/$lang/f_prep._$lang" );
		include( "../locales/$lang/f_php._$lang" );
		include( "../locales/$lang/f_sel._$lang" );
		include( "../locales/$lang/f_02._$lang" );
		include( "../dflib/f_librep.php" );
	}

	if ( $dontuse_filt!=1 ) {
		$rep_filt=CookieGet( "rep-filt" )*1;
		$_10_restrict=( $rep_filt & 1 )/1;//morning
		$_11_restrict=( $rep_filt & 2 )/2;
		$_20_restrict=( $rep_filt & 4 )/4;//afternoon
		$_21_restrict=( $rep_filt & 8 )/8;
		$_30_restrict=( $rep_filt & 16 )/16;//evening
		$_31_restrict=( $rep_filt & 32 )/32;
		$_knowntag_restrict=( $rep_filt & 64 )/64;
		$_unknowntag_restrict=( $rep_filt & 128 )/128;
		$_notag_restrict=( $rep_filt & 256 )/256;
		$_mast_restrict=( $rep_filt & 512 )/512;
		$_nomast_restrict=( $rep_filt & 1024 )/1024;
		$_trau_restrict=( $rep_filt & 2048 )/2048;
		$_notrau_restrict=( $rep_filt & 4096 )/4096;
		$_ovul_restrict=( $rep_filt & 8192 )/8192;
		$_noovul_restrict=( $rep_filt & 16384 )/16384;
	}

	$per_beg=$_GET["per_beg"];
	if ( trim( $per_beg."."!="." )) {
		$s=split( "[.]", $per_beg );
		$per_beg=Int2StrZ( $s[2], 4 )."-".Int2StrZ( $s[1], 2 )."-".Int2StrZ( $s[0], 2 );
	}
	$beg=$per_beg;

	$per_end=$_GET["per_end"];
	if ( trim( $per_end."."!="." )) {
		$s=split( "[.]", $per_end );
		$per_end=Int2StrZ( $s[2], 4 )."-".Int2StrZ( $s[1], 2 )."-".Int2StrZ( $s[0], 2 );
	}
	$end=$per_end; $per_end_=$per_end;

	$WHEREADV=""; $WHEREADV_txt=":<br>";

	$filt_dev=$_GET["filt_dev"];//one device
	$bd_first=substr( $filt_dev, 0, 2 );
	$bd_last=substr( $filt_dev, 3, 2 );
	$bd_first_=CookieGet( "_filts_devf" )*1;
	$bd_last_=CookieGet( "_filts_devl" )*1;
	if ( $bd_first_>0 & $bd_last_>0 & $bd_last_<$bd_first_ ) {
		$bd_first_tmp=$bd_first_; $bd_first_=$bd_last_; $bd_last_=$bd_first_tmp;
	}
	if ( $bd_first_>0 | $bd_last_>0 ) {
		$WHEREADV_txt.=" *".$php_mm["_com_only_one_dev_"]."&nbsp;";
		if ( $bd_first_>0 ) {
			$bd_first=$bd_first_;
			$WHEREADV=$WHEREADV." AND bd_num>=$bd_first";
			$WHEREADV_txt.=$bd_first;
		}
		if ( $bd_last_==$bd_first_ ) {
			$bd_last=$bd_last_;
			$WHEREADV=$WHEREADV." AND bd_num<=$bd_last";
		} else {
			if ( $bd_last_>0 ) {
				$bd_last=$bd_last_;
				$WHEREADV=$WHEREADV." AND bd_num<=$bd_last";
				$WHEREADV_txt.="..".$bd_last;
			} else
				$WHEREADV_txt.="..";
		}
		$WHEREADV_txt.="<br>";
	}

	if ( $_10_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND milk_sess*1<>10";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_s10_"]." ".$php_mm["_com_milking_"];
		if ( $WHEREADV1!=1 ) $WHEREADV1=1;
	}
	if ( $_11_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND milk_sess*1<>11";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_s11_"]." ".$php_mm["_com_milking_"];
		if ( $WHEREADV1!=1 ) $WHEREADV1=1;
	}
	if ( $_20_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND milk_sess*1<>20";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_s20_"]." ".$php_mm["_com_milking_"];
		if ( $WHEREADV1!=1 ) $WHEREADV1=1;
	}
	if ( $_21_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND milk_sess*1<>21";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_s21_"]." ".$php_mm["_com_milking_"];
		if ( $WHEREADV1!=1 ) $WHEREADV1=1;
	}
	if ( $_30_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND milk_sess*1<>30";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_s30_"]." ".$php_mm["_com_milking_"];
		if ( $WHEREADV1!=1 ) $WHEREADV1=1;
	}
	if ( $_31_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND milk_sess*1<>31";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_s31_"]." ".$php_mm["_com_milking_"];
		if ( $WHEREADV1!=1 ) $WHEREADV1=1;
	}
	if ( $WHEREADV1!=0 ) $WHEREADV_txt=$WHEREADV_txt."<br>";
	if ( $_knowntag_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND cow_id<2";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_known_tag_"];
		if ( $WHEREADV2!=1 ) $WHEREADV2=1;
	}
	if ( $_unknowntag_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND cow_id<>0";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_unknown_tag_"];
		if ( $WHEREADV2!=1 ) $WHEREADV2=1;
	}
	if ( $_notag_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND cow_id<>1";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_wo_tag_"];
		if ( $WHEREADV2!=1 ) $WHEREADV2=1;
	}
	if ( $WHEREADV2!=0 ) $WHEREADV_txt=$WHEREADV_txt."<br>";
	if ( $_mast_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND mast_4*1<=0";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_with_mastitus_"];
	}
	if ( $_nomast_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND mast_4*1<>0";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_wo_mastitus_"];
	}
	if ( $_trau_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND tr*1<>1";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_with_trauma_"];
	}
	if ( $_notrau_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND tr*1<>0";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_wo_trauma_"];
	}
	if ( $_ovul_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND ov*1<>1";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_wanted_ox_"];
	}
	if ( $_noovul_restrict>0 ) {
		$WHEREADV=$WHEREADV." AND ov*1<>0";
		$WHEREADV_txt=$WHEREADV_txt." *".$php_mm["_com_animals_"]." ".$php_mm["_com_not_wanted_ox_"];
	}

//calc period [BEGIN]
	if ( $dontuse_period!=5 ) {
		$end=CookieGet( "_dt2" );//only in this script, not "f_jper1.php"
		$end1=substr( $end, 8, 2 ).".".substr( $end, 5, 2 ).".".substr( $end, 0, 4 );
		$yl=intval( substr( $end, 0, 4 )); $ml=intval( substr( $end, 5, 2 )); $dl=intval( substr( $end, 8, 2 ));
	}
	if ( $dontuse_period==0 ) {
		$beg=CookieGet( "_dt1" );//only in this script, not "f_jper1.php"
		$beg1=substr( $beg, 8, 2 ).".".substr( $beg, 5, 2 ).".".substr( $beg, 0, 4 );
		$yf=intval( substr( $beg, 0, 4 )); $mf=intval( substr( $beg, 5, 2 )); $df=intval( substr( $beg, 8, 2 ));
	} else {
		if ( $dontuse_period==4 ) {
			$beg=date( "Y-m-d" ); $beg1=date( "d.m.Y" );
			$yf=intval( substr( $beg, 0, 4 )); $mf=intval( substr( $beg, 5, 2 )); $df=intval( substr( $beg, 8, 2 ));
			$end=date( "Y-m-d" ); $end1=date( "d.m.Y" );
			$yl=intval( substr( $end, 0, 4 )); $ml=intval( substr( $end, 5, 2 )); $dl=intval( substr( $end, 8, 2 ));
		} elseif ( $dontuse_period==3 ) {
			$beg1="01.01.".$yl;//start from 01.01 of the $yl
			$yf=$yl; $mf=1; $df=1;
		} elseif ( $dontuse_period==2 ) {
			if ( $dl>=6 ) {//if current date>=06.MM.YYYY
				$mf=$ml; $yf=$yl;
				if ( $dl==7 ) $df=1;
				else if ($dl==6 ) {
					if ( $ml==1 ) {
						$d=$dl-1;
						$yf=$yl-1; $mf=12; $df=31;
					} else {
						$yf=$yl; $mf=$ml-1; $df=PHP3_cal_days_in_month( CAL_GREGORIAN, $mf, $yf );
					}
				} else $df=$dl-7;
			} else {
				if ( $ml==1 ) {
					$d=$dl-1;
					$yf=$yl-1; $mf=12; $df=31-(6-$dl);
				} else {
					$yf=$yl; $mf=$ml-1; $df=PHP3_cal_days_in_month( CAL_GREGORIAN, $mf, $yf )-(6-$df);
				}
			}
			$mf_days=PHP3_cal_days_in_month( CAL_GREGORIAN, $mf, $yf );
			$yfz=$yf; $mfz=$mf; $dfz=$df;
			$mfz=Int2StrZ( $mf, 2 ); $dfz=Int2StrZ( $df, 2 );
			$beg=$yfz."-".$mfz."-".$dfz;
			$beg1=$dfz.".".$mfz.".".$yfz;
			$mtz=Int2StrZ( $ml, 2 ); $dtz=Int2StrZ( $dl, 2 );//today
			if ( $dl>1 ) {//yesterday
				$myz=$ml; $dyz=$dl-1;
			} else {
				if ( $ml==1 ) {
					$myz=12; $dyz=31;
				} else {
					$my_days=PHP3_cal_days_in_month( CAL_GREGORIAN, $ml-1, $yl );
					$myz=$ml-1; $dyz=$my_days;
				}
			}
			$myz=Int2StrZ( $myz, 2 ); $dyz=Int2StrZ( $dyz, 2 );
		}
	}
	$yc=$yf; $mc=$mf; $dc=$df;
//calc period [END]

	$B[1]="+"; $B[0]="-"; $C[1]="+"; $C[0]=" ";

	$now_dmY=date( "d.m.Y" ); $now_His=date( "H:i:s" );
}

$filt_cowid=$_GET["filt_cowid"]*1; if ( $filt_cowid<1 ) $filt_cowid=-1;//one cow

$outsele1=-1;
$outsele2=-1;
$outsele3=-1;
$outsele4=-1;
$outsele5=-1;
$outsele6=-1;
$outsele7=-1;
$outsele8=-1;
$query_descending=-1;
?>
