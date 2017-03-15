<?php
/* DF_2: reports/f_ccw1.php
report: cow card 2-mol ([c]ard of [c]o[w][1]:Ukraine)
c: 15.09.2009
m: 13.03.2017 */

$cow_id=$_GET["cow_id"];
$ret0=$_GET["ret0"];//link to return to previous page
//TEMPORARY ALL URSs POINT TO PART1
$idx_a=array( "0", "1", "2", "2", "2", "2", "2", "2", "2", "2", "2", "2", "2", "2", "2", "2" );
//$idx_a=array( "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f" );
for ( $i=1; $i<=15; $i++ ) $ccw_href[$i]="../".$hDir['forms']."f__ccw1".$idx_a[$i].".php?cow_id=".$cow_id."&ret0=".$ret0;

include( "../f_vars0.php" );

//return date from db in screen format
function Date_FromDb2Scr( $from_db, $ch ) {
	$from_db_=split( "-", trim( $from_db ));
	$out_scr=$from_db_[2].$ch.$from_db_[1].$ch.$from_db_[0];
	return $out_scr;
}

//return date from screen in db format
function Date_FromScr2Db( $from_scr ) {
	$from_scr_=split( "-", trim( $from_scr ));
	$out_db=$from_scr_[2]."-".$from_scr_[1]."-".$from_scr_[0];
	return $out_db;
}

function Int2StrZ( $s, $length ) {
	$res=strval( $s );
	while ( strlen( $res )<$length ) $res="0".$res;
	return $res;
}

function Data_SELE( $dbt, $id, $ident ) {
	global $db,
	 $c_f2ml, $o_f2ml,
	 $m_, $mm_, $mf_, $f_, $fm_, $ff_,//ARRAYS
	 $mmm_19, $mfm_19, $mmf_19, $mff_19,
	 $buf_cows, $buf_oxes,
	 $cows, $oxes, $breeds, $xfuncs, $xraces, $xclasses,
	 $b_date, $b_place_id,
	 $i_date,
	 $defects,
	 $comments,
	 $cow_num,
	 $nick, $b_num, $nat, $nat1, $breed_id, $func_id, $race_id, $clas_id,
	 $m_nick, $m_b_num, $m_nat, $m_nat1, $m_breed_id, $m_func_id, $m_race_id, $m_clas_id, $m_id,
	 $f_nick, $f_b_num, $f_nat, $f_nat1, $f_breed_id, $f_func_id, $f_race_id, $f_clas_id, $f_id,
	 $mm_nick, $mm_b_num, $mm_nat, $mm_nat1, $mm_breed_id, $mm_func_id, $mm_race_id, $mm_clas_id, $mm_id,
	 $fm_nick, $fm_b_num, $fm_nat, $fm_nat1, $fm_breed_id, $fm_func_id, $fm_race_id, $fm_clas_id, $fm_id,
	 $mf_nick, $mf_b_num, $mf_nat, $mf_nat1, $mf_breed_id, $mf_func_id, $mf_race_id, $mf_clas_id, $mf_id,
	 $ff_nick, $ff_b_num, $ff_nat, $ff_nat1, $ff_breed_id, $ff_func_id, $ff_race_id, $ff_clas_id, $ff_id,
	 $mmm_nick, $mmm_b_num, $mmm_nat, $mmm_nat1, $mmm_breed_id, $mmm_func_id, $mmm_race_id, $mmm_clas_id, $mmm_id,
	 $fmm_nick, $fmm_b_num, $fmm_nat, $fmm_nat1, $fmm_breed_id, $fmm_func_id, $fmm_race_id, $fmm_clas_id, $fmm_id,
	 $mfm_nick, $mfm_b_num, $mfm_nat, $mfm_nat1, $mfm_breed_id, $mfm_func_id, $mfm_race_id, $mfm_clas_id, $mfm_id,
	 $ffm_nick, $ffm_b_num, $ffm_nat, $ffm_nat1, $ffm_breed_id, $ffm_func_id, $ffm_race_id, $ffm_clas_id, $ffm_id,
	 $mmf_nick, $mmf_b_num, $mmf_nat, $mmf_nat1, $mmf_breed_id, $mmf_func_id, $mmf_race_id, $mmf_clas_id, $mmf_id,
	 $fmf_nick, $fmf_b_num, $fmf_nat, $fmf_nat1, $fmf_breed_id, $fmf_func_id, $fmf_race_id, $fmf_clas_id, $fmf_id,
	 $mff_nick, $mff_b_num, $mff_nat, $mff_nat1, $mff_breed_id, $mff_func_id, $mff_race_id, $mff_clas_id, $mff_id,
	 $fff_nick, $fff_b_num, $fff_nat, $fff_nat1, $fff_breed_id, $fff_func_id, $fff_race_id, $fff_clas_id, $fff_id,
	 $breed_nick, $func_nick, $race_nick, $clas_nick,
	 $m_breed_nick, $m_func_nick, $m_race_nick, $m_clas_nick,
	 $f_breed_nick, $f_func_nick, $f_race_nick, $f_clas_nick,
	 $mm_breed_nick, $mm_func_nick, $mm_race_nick, $mm_clas_nick,
	 $fm_breed_nick, $fm_func_nick, $fm_race_nick, $fm_clas_nick,
	 $mf_breed_nick, $mf_func_nick, $mf_race_nick, $mf_clas_nick,
	 $ff_breed_nick, $ff_func_nick, $ff_race_nick, $ff_clas_nick,
	 $mmm_breed_nick, $mmm_func_nick, $mmm_race_nick, $mmm_clas_nick,
	 $fmm_breed_nick, $fmm_func_nick, $fmm_race_nick, $fmm_clas_nick,
	 $mfm_breed_nick, $mfm_func_nick, $mfm_race_nick, $mfm_clas_nick,
	 $ffm_breed_nick, $ffm_func_nick, $ffm_race_nick, $ffm_clas_nick,
	 $mmf_breed_nick, $mmf_func_nick, $mmf_race_nick, $mmf_clas_nick,
	 $fmf_breed_nick, $fmf_func_nick, $fmf_race_nick, $fmf_clas_nick,
	 $mff_breed_nick, $mff_func_nick, $mff_race_nick, $mff_clas_nick,
	 $fff_breed_nick, $fff_func_nick, $fff_race_nick, $fff_clas_nick;
	if ( $dbt==$buf_cows | $dbt==$cows ) {
		$dbt_num="cow_num";
		$res=mysql_query( "SELECT
		 `a1_0101`, `a1_0102`, `a1_0103`, `a1_0104`, `a1_0105`, `a1_0107`,
		 `a1_0201`, `a1_0202`, `a1_0203`, `a1_0204`, `a1_0205`, `a1_0207`,
		 `a1_0301`, `a1_0302`, `a1_0303`, `a1_0304`, `a1_0305`, `a1_0307`,
		 `a1_0401`, `a1_0402`, `a1_0403`, `a1_0404`, `a1_0405`, `a1_0407`,
		 `a1_0501`, `a1_0502`, `a1_0503`, `a1_0504`, `a1_0505`, `a1_0507`,
		 `a1_0601`, `a1_0602`, `a1_0603`, `a1_0604`, `a1_0605`, `a1_0607`,
		 `a1_0701`, `a1_0702`, `a1_0703`, `a1_0704`, `a1_0705`, `a1_0707`,
		 `a1_0801`, `a1_0802`, `a1_0803`, `a1_0804`, `a1_0805`, `a1_0807`,
		 `a1_0901`, `a1_0902`, `a1_0903`, `a1_0904`, `a1_0905`, `a1_0907`,
		 `a1_19`
		 FROM $c_f2ml WHERE $c_f2ml.id*1=$id", $db );
		$error=mysql_errno();
		if ( $error==0 ) {
			$row=mysql_fetch_row( $res ); $ri=0;
			for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=8; $aj++ ) $a1[$ai][$aj]=-1;
			$a1[0][19]=-1;
			for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=8; $aj++ ) {
				if ( $row[$ri]=="" ) $row[$ri]=-1;//IMPORTANT!!!
				if ( $row[$ri]*1==-1 ) $row[$ri]="";//IMPORTANT!!!
				if ( $aj!=6 & $aj!=8 ) {
					$a1[$ai][$aj]=$row[$ri]; $ri++;
				}
			}
			if ( $row[$ri]=="" ) $row[$ri]=-1;//IMPORTANT!!!
			if ( $row[$ri]*1==-1 ) $row[$ri]="";//IMPORTANT!!!
			$a1[0][19]=$row[$ri];
		} else {
			for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=8; $aj++ ) $a1[$ai][$aj]=-1;
			$a1[0][19]=-1;
		}
	} else {
		$dbt_num="num";
		$res=mysql_query( "SELECT
		 `a1_0000`,
		 `a1_0101`, `a1_0102`, `a1_0103`,
		 `a1_0201`, `a1_0202`, `a1_0203`,
		 `a1_0301`, `a1_0303`,
		 `a1_0401`, `a1_0402`, `a1_0403`,
		 `a1_0501`, `a1_0503`
		 FROM $o_f2ml WHERE $o_f2ml.id*1=$id", $db );
		$error=mysql_errno();
		if ( $error==0 ) {
			$row=mysql_fetch_row( $res ); $ri=1;
			for ( $ai=1; $ai<=5; $ai++ ) for ( $aj=1; $aj<=3; $aj++ ) $a1[$ai][$aj]=-1;
			for ( $ai=1; $ai<=5; $ai++ ) for ( $aj=1; $aj<=3; $aj++ ) {
				$idxx=$ai.$aj;
				if ( $row[$ri]=="" ) $row[$ri]=-1;//IMPORTANT!!!
				if ( $row[$ri]*1==-1 ) $row[$ri]="";//IMPORTANT!!!
				if ( $idxx!='32' & $idxx!='52' ) {
					$a1[$ai][$aj]=$row[$ri]; $ri++;
				}
			}
			$a1[0][0]=$row[0];
		} else {
			for ( $ai=1; $ai<=5; $ai++ ) for ( $aj=1; $aj<=3; $aj++ ) $a1[$ai][$aj]=-1;
			$a1[0][0]=-1;
		}
	}
	$res=mysql_query( "SELECT
	 $dbt.id, $dbt.$dbt_num, $dbt.nick,
	 $dbt.national_descr,
	 $dbt.b_num, $dbt.b_date, $dbt.b_place_id,
	 $dbt.defects, $dbt.comments,
	 $dbt.mth_id, $dbt.fth_id,
	 $dbt.breed_id, $breeds.nick,
	 $dbt._function, $xfuncs.nick,
	 $dbt._race, $xraces.nick,
	 $dbt._class, $xclasses.nick,
	 $dbt.i_date,
	 $dbt.owner_id
	 FROM $dbt, $breeds, $xfuncs, $xraces, $xclasses
	 WHERE $dbt.id*1=$id AND $breeds.id=$dbt.breed_id AND
	 $xfuncs.id=$dbt._function AND $xraces.id=$dbt._race AND $xclasses.id=$dbt._class", $db );
	$row=mysql_fetch_row( $res );
	$xnum=$row[1]; $xnick=$row[2];
	$xnat_d=$row[3];
	$xb_num=$row[4]; $xb_date=$row[5]; $xb_place_id=$row[6]*1;
	$xdefects=$row[7]; $xcomments=$row[8];
	$xm_id=$row[9]*1; $xf_id=$row[10]*1;
	$xbreed_id=$row[11]*1; $xbreed_nick=$row[12];
	$xfunc_id=$row[13]*1; $xfunc_nick=$row[14];
	$xrace_id=$row[15]*1; $xrace_nick=$row[16];
	$xclas_id=$row[17]*1; $xclas_nick=$row[18];
	$xi_date=$row[19]; $xowner_id=$row[20]*1;
	mysql_free_result( $res );
	$xb_date_=split( "-", $xb_date );
	$xb_date=$xb_date_[2]."-".$xb_date_[1]."-".$xb_date_[0];
	$xi_date_=split( "-", $xi_date );
	$xi_date=$xi_date_[2]."-".$xi_date_[1]."-".$xi_date_[0];
	switch ( $ident ) {
		case 'm-f':
			$cow_num=$xnum;
			$nick=$xnick;
			$nat=$xnat_d;
			$b_num=$xb_num;
			$b_date=$xb_date; $b_place_id=$xb_place_id; $i_date=$xi_date;
			$defects=$xdefects;
			$comments=$xcomments;
			$m_id=$xm_id;
			$f_id=$xf_id;
			$breed_id=$xbreed_id;
			$func_id=$xfunc_id;
			$race_id=$xrace_id;
			$clas_id=$xclas_id;
			$breed_nick=$xbreed_nick;
			$func_nick=$xfunc_nick;
			$race_nick=$xrace_nick;
			$clas_nick=$xclas_nick;
			break;
		case 'm':
			$m_num=$xnum;
			$m_nick=$xnick;
			$m_nat=$xnat_d;
			$m_b_num=$xb_num;
			$m_b_date=$xb_date; $m_i_date=$xi_date;
			$mm_id=$xm_id;
			$fm_id=$xf_id;
			$m_breed_id=$xbreed_id;
			$m_func_id=$xfunc_id;
			$m_race_id=$xrace_id;
			$m_clas_id=$xclas_id;
			for ( $ai=1; $ai<=8; $ai++ ) for ( $aj=1; $aj<=8; $aj++ ) {
				$tmp_var=$a1[$ai][$aj]; $m_[$ai][$aj]=$tmp_var;
			}
			$m_breed_nick=$xbreed_nick;
			$m_func_nick=$xfunc_nick;
			$m_race_nick=$xrace_nick;
			$m_clas_nick=$xclas_nick;
			break;
		case 'f':
			$f_num=$xnum;
			$f_nick=$xnick;
			$f_nat=$xnat_d;
			$f_b_num=$xb_num;
			$f_b_date=$xb_date; $f_i_date=$xi_date;
			$mf_id=$xm_id;
			$ff_id=$xf_id;
			$f_breed_id=$xbreed_id;
			$f_func_id=$xfunc_id;
			$f_race_id=$xrace_id;
			$f_clas_id=$xclas_id;
			for ( $ai=1; $ai<=5; $ai++ ) for ( $aj=1; $aj<=3; $aj++ ) {
				$tmp_var=$a1[$ai][$aj]; $f_[$ai][$aj]=$tmp_var;
			}
			$f_[0][0]=$a1[0][0];
			$f_breed_nick=$xbreed_nick;
			$f_func_nick=$xfunc_nick;
			$f_race_nick=$xrace_nick;
			$f_clas_nick=$xclas_nick;
			break;
		case 'mm':
			$mm_num=$xnum;
			$mm_nick=$xnick;
			$mm_nat=$xnat_d;
			$mm_b_num=$xb_num;
			$mm_b_date=$xb_date; $mm_i_date=$xi_date;
			$mmm_id=$xm_id;
			$fmm_id=$xf_id;
			$mm_breed_id=$xbreed_id;
			$mm_func_id=$xfunc_id;
			$mm_race_id=$xrace_id;
			$mm_clas_id=$xclas_id;
			for ( $ai=1; $ai<=8; $ai++ ) for ( $aj=1; $aj<=8; $aj++ ) {
				$tmp_var=$a1[$ai][$aj]; $mm_[$ai][$aj]=$tmp_var;
			}
			$mm_breed_nick=$xbreed_nick;
			$mm_func_nick=$xfunc_nick;
			$mm_race_nick=$xrace_nick;
			$mm_clas_nick=$xclas_nick;
			break;
		case 'fm':
			$fm_num=$xnum;
			$fm_nick=$xnick;
			$fm_nat=$xnat_d;
			$fm_b_num=$xb_num;
			$fm_b_date=$xb_date; $fm_i_date=$xi_date;
			$mfm_id=$xm_id;
			$ffm_id=$xf_id;
			$fm_breed_id=$xbreed_id;
			$fm_func_id=$xfunc_id;
			$fm_race_id=$xrace_id;
			$fm_clas_id=$xclas_id;
			for ( $ai=1; $ai<=5; $ai++ ) for ( $aj=1; $aj<=3; $aj++ ) {
				$tmp_var=$a1[$ai][$aj]; $fm_[$ai][$aj]=$tmp_var;
			}
			$fm_[0][0]=$a1[0][0];
			$fm_breed_nick=$xbreed_nick;
			$fm_func_nick=$xfunc_nick;
			$fm_race_nick=$xrace_nick;
			$fm_clas_nick=$xclas_nick;
			break;
		case 'mf':
			$mf_num=$xnum;
			$mf_nick=$xnick;
			$mf_nat=$xnat_d;
			$mf_b_num=$xb_num;
			$mf_b_date=$xb_date; $mf_i_date=$xi_date;
			$mmf_id=$xm_id;
			$fmf_id=$xf_id;
			$mf_breed_id=$xbreed_id;
			$mf_func_id=$xfunc_id;
			$mf_race_id=$xrace_id;
			$mf_clas_id=$xclas_id;
			for ( $ai=1; $ai<=8; $ai++ ) for ( $aj=1; $aj<=8; $aj++ ) {
				$tmp_var=$a1[$ai][$aj]; $mf_[$ai][$aj]=$tmp_var;
			}
			$mf_breed_nick=$xbreed_nick;
			$mf_func_nick=$xfunc_nick;
			$mf_race_nick=$xrace_nick;
			$mf_clas_nick=$xclas_nick;
			break;
		case 'ff':
			$ff_num=$xnum;
			$ff_nick=$xnick;
			$ff_nat=$xnat_d;
			$ff_b_num=$xb_num;
			$ff_b_date=$xb_date; $ff_i_date=$xi_date;
			$mff_id=$xm_id;
			$fff_id=$xf_id;
			$ff_breed_id=$xbreed_id;
			$ff_func_id=$xfunc_id;
			$ff_race_id=$xrace_id;
			$ff_clas_id=$xclas_id;
			for ( $ai=1; $ai<=5; $ai++ ) for ( $aj=1; $aj<=3; $aj++ ) {
				$tmp_var=$a1[$ai][$aj]; $ff_[$ai][$aj]=$tmp_var;
			}
			$ff_[0][0]=$a1[0][0];
			$ff_breed_nick=$xbreed_nick;
			$ff_func_nick=$xfunc_nick;
			$ff_race_nick=$xrace_nick;
			$ff_clas_nick=$xclas_nick;
			break;
		case 'mmm':
			$mmm_num=$xnum;
			$mmm_nick=$xnick;
			$mmm_nat=$xnat_d;
			$mmm_b_num=$xb_num;
			$mmm_b_date=$xb_date; $mmm_i_date=$xi_date;
			$mmm_breed_id=$xbreed_id;
			$mmm_func_id=$xfunc_id;
			$mmm_race_id=$xrace_id;
			$mmm_clas_id=$xclas_id;
			$mmm_19=$a1[0][19];
			$mmm_breed_nick=$xbreed_nick;
			$mmm_func_nick=$xfunc_nick;
			$mmm_race_nick=$xrace_nick;
			$mmm_clas_nick=$xclas_nick;
			break;
		case 'fmm':
			$fmm_num=$xnum;
			$fmm_nick=$xnick;
			$fmm_nat=$xnat_d;
			$fmm_b_num=$xb_num;
			$fmm_b_date=$xb_date; $fmm_i_date=$xi_date;
			$fmm_breed_id=$xbreed_id;
			$fmm_func_id=$xfunc_id;
			$fmm_race_id=$xrace_id;
			$fmm_clas_id=$xclas_id;
			$fmm_breed_nick=$xbreed_nick;
			$fmm_func_nick=$xfunc_nick;
			$fmm_race_nick=$xrace_nick;
			$fmm_clas_nick=$xclas_nick;
			break;
		case 'mmf':
			$mmf_num=$xnum;
			$mmf_nick=$xnick;
			$mmf_nat=$xnat_d;
			$mmf_b_num=$xb_num;
			$mmf_b_date=$xb_date; $mmf_i_date=$xi_date;
			$mmf_breed_id=$xbreed_id;
			$mmf_func_id=$xfunc_id;
			$mmf_race_id=$xrace_id;
			$mmf_clas_id=$xclas_id;
			$mmf_19=$a1[0][19];
			$mmf_breed_nick=$xbreed_nick;
			$mmf_func_nick=$xfunc_nick;
			$mmf_race_nick=$xrace_nick;
			$mmf_clas_nick=$xclas_nick;
			break;
		case 'fmf':
			$fmf_num=$xnum;
			$fmf_nick=$xnick;
			$fmf_nat=$xnat_d;
			$fmf_b_num=$xb_num;
			$fmf_b_date=$xb_date; $fmf_i_date=$xi_date;
			$fmf_breed_id=$xbreed_id;
			$fmf_func_id=$xfunc_id;
			$fmf_race_id=$xrace_id;
			$fmf_clas_id=$xclas_id;
			$fmf_breed_nick=$xbreed_nick;
			$fmf_func_nick=$xfunc_nick;
			$fmf_race_nick=$xrace_nick;
			$fmf_clas_nick=$xclas_nick;
			break;
		case 'mfm':
			$mfm_num=$xnum;
			$mfm_nick=$xnick;
			$mfm_nat=$xnat_d;
			$mfm_b_num=$xb_num;
			$mfm_b_date=$xb_date; $mfm_i_date=$xi_date;
			$mfm_breed_id=$xbreed_id;
			$mfm_func_id=$xfunc_id;
			$mfm_race_id=$xrace_id;
			$mfm_clas_id=$xclas_id;
			$mfm_19=$a1[0][19];
			$mfm_breed_nick=$xbreed_nick;
			$mfm_func_nick=$xfunc_nick;
			$mfm_race_nick=$xrace_nick;
			$mfm_clas_nick=$xclas_nick;
			break;
		case 'ffm':
			$ffm_num=$xnum;
			$ffm_nick=$xnick;
			$ffm_nat=$xnat_d;
			$ffm_b_num=$xb_num;
			$ffm_b_date=$xb_date; $ffm_i_date=$xi_date;
			$ffm_breed_id=$xbreed_id;
			$ffm_func_id=$xfunc_id;
			$ffm_race_id=$xrace_id;
			$ffm_clas_id=$xclas_id;
			$ffm_breed_nick=$xbreed_nick;
			$ffm_func_nick=$xfunc_nick;
			$ffm_race_nick=$xrace_nick;
			$ffm_clas_nick=$xclas_nick;
			break;
		case 'mff':
			$mff_num=$xnum;
			$mff_nick=$xnick;
			$mff_nat=$xnat_d;
			$mff_b_num=$xb_num;
			$mff_b_date=$xb_date; $mff_i_date=$xi_date;
			$mff_breed_id=$xbreed_id;
			$mff_func_id=$xfunc_id;
			$mff_race_id=$xrace_id;
			$mff_clas_id=$xclas_id;
			$mff_19=$a1[0][19];
			$mff_breed_nick=$xbreed_nick;
			$mff_func_nick=$xfunc_nick;
			$mff_race_nick=$xrace_nick;
			$mff_clas_nick=$xclas_nick;
			break;
		case 'fff':
			$fff_num=$xnum;
			$fff_nick=$xnick;
			$fff_nat=$xnat_d;
			$fff_b_num=$xb_num;
			$fff_b_date=$xb_date; $fff_i_date=$xi_date;
			$fff_breed_id=$xbreed_id;
			$fff_func_id=$xfunc_id;
			$fff_race_id=$xrace_id;
			$fff_clas_id=$xclas_id;
			$fff_breed_nick=$xbreed_nick;
			$fff_func_nick=$xfunc_nick;
			$fff_race_nick=$xrace_nick;
			$fff_clas_nick=$xclas_nick;
			break;
	}
}

function ArrayNbsp() {
	global
	 $m_, $mm_, $mf_, $f_, $fm_, $ff_;//ARRAYS
	for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=8; $aj++ ) {
		if ( trim( $m_[$ai][$aj]=="" )) $m_[$ai][$aj]="&nbsp;";
		if ( trim( $mm_[$ai][$aj]=="" )) $mm_[$ai][$aj]="&nbsp;";
		if ( trim( $mf_[$ai][$aj]=="" )) $mf_[$ai][$aj]="&nbsp;";
	}
	for ( $ai=1; $ai<=9; $ai++ ) {
		$a=$m_[$ai][04]; $x=$x*1; $b=$m_[$ai][5]; $b=$b*1;
		if ( $a>0 & $b>0 ) $m_[$ai][06]=round( $a*$b/100, 2 ); else $m_[$ai][06]="&nbsp;";
		$a=$m_[$ai][04]; $x=$x*1; $b=$m_[$ai][7]; $b=$b*1;
		if ( $a>0 & $b>0 ) $m_[$ai][08]=round( $a*$b/100, 2 ); else $m_[$ai][08]="&nbsp;";
		$a=$mm_[$ai][04]; $x=$x*1; $b=$mm_[$ai][5]; $b=$b*1;
		if ( $a>0 & $b>0 ) $mm_[$ai][06]=round( $a*$b/100, 2 ); else $mm_[$ai][06]="&nbsp;";
		$a=$mm_[$ai][04]; $x=$x*1; $b=$m_[$ai][7]; $b=$b*1;
		if ( $a>0 & $b>0 ) $mm_[$ai][08]=round( $a*$b/100, 2 ); else $mm_[$ai][08]="&nbsp;";
		$a=$mf_[$ai][04]; $x=$x*1; $b=$mf_[$ai][5]; $b=$b*1;
		if ( $a>0 & $b>0 ) $mf_[$ai][06]=round( $a*$b/100, 2 ); else $mf_[$ai][06]="&nbsp;";
		$a=$mm_[$ai][04]; $x=$x*1; $b=$m_[$ai][7]; $b=$b*1;
		if ( $a>0 & $b>0 ) $mf_[$ai][08]=round( $a*$b/100, 2 ); else $mf_[$ai][08]="&nbsp;";
	}
}

Dbase_connect(); Dbase_select();

$res=mysql_query( "SELECT region, subregion FROM $globals", $db ); $row=mysql_fetch_row( $res );
$region=$row[0]; $subregion=$row[1];

Data_SELE( $cows, $cow_id, 'm-f' );

Data_SELE( $cows, $m_id, 'm' );

Data_SELE( $oxes, $f_id, 'f' ); $f_[03][03]='x'; $f_[05][03]='x';
$a=$f_[01][02]; $x=$x*1; $b=$f_[02][02]; $b=$b*1;
if ( $a>0 & $b>0 ) $f_[03][02]=round( $a*$b/100, 2 ); else $f_[03][02]="&nbsp;";
$a=$f_[01][02]; $x=$x*1; $b=$f_[04][02]; $b=$b*1;
if ( $a>0 & $b>0 ) $f_[05][02]=round( $a*$b/100, 2 ); else $f_[05][02]="&nbsp;";

Data_SELE( $cows, $mm_id, 'mm' );

Data_SELE( $oxes, $fm_id, 'fm' ); $fm_[03][03]='x'; $fm_[05][03]='x';
$a=$fm_[01][02]; $x=$x*1; $b=$fm_[02][02]; $b=$b*1;
if ( $a>0 & $b>0 ) $fm_[03][02]=round( $a*$b/100, 2 ); else $fm_[03][02]="&nbsp;";
$a=$fm_[01][02]; $x=$x*1; $b=$fm_[04][02]; $b=$b*1;
if ( $a>0 & $b>0 ) $fm_[05][02]=round( $a*$b/100, 2 ); else $fm_[05][02]="&nbsp;";

Data_SELE( $cows, $mf_id, 'mf' );

Data_SELE( $oxes, $ff_id, 'ff' ); $ff_[03][03]='x'; $ff_[05][03]='x';
$a=$ff_[01][02]; $x=$x*1; $b=$ff_[02][02]; $b=$b*1;
if ( $a>0 & $b>0 ) $ff_[03][02]=round( $a*$b/100, 2 ); else $ff_[03][02]="&nbsp;";
$a=$ff_[01][02]; $x=$x*1; $b=$ff_[04][02]; $b=$b*1;
if ( $a>0 & $b>0 ) $ff_[05][02]=round( $a*$b/100, 2 ); else $ff_[05][02]="&nbsp;";

Data_SELE( $cows, $mmm_id, 'mmm' );

Data_SELE( $oxes, $fmm_id, 'fmm' );

Data_SELE( $cows, $mfm_id, 'mfm' );

Data_SELE( $oxes, $ffm_id, 'ffm' );

Data_SELE( $cows, $mmf_id, 'mmf' );

Data_SELE( $oxes, $fmf_id, 'fmf' );

Data_SELE( $cows, $mff_id, 'mff' );

Data_SELE( $oxes, $fff_id, 'fff' );

$a_00=$nick; $a_01=$b_date;
$a_02=$b_num; $a_03="&nbsp;";
$a_04=$nat; $a_05=$i_date;
$a_06=$breed_nick; $a_07="&nbsp;";
$a_08=$race_nick; $a_09=$func_nick;
$a_10="&nbsp;"; $a_11="&nbsp;";
$a_12="&nbsp;"; $a_13="&nbsp;";
$a_14="&nbsp;";
$a_15="&nbsp;";
$a_16=$clas_nick;
$a_17="&nbsp;";

$m_00=$m_nick;
$m_02=$m_b_num;
$m_04=$m_nat;
$m_06=$m_breed_nick;
$m_08=$m_race_nick;
$m_10="&nbsp;";
$m_12="&nbsp;";
$m_14="&nbsp;";
$m_15="&nbsp;";
$m_16=$m_clas_nick;
$m_17="&nbsp;";
$m_11="&nbsp;";

$f_00=$f_nick;
$f_02=$f_b_num;
$f_04=$f_nat;
$f_06=$f_breed_nick;
$f_08=$f_race_nick;
$f_10="&nbsp;";
$f_12="&nbsp;";
$f_14="&nbsp;";
$f_15="&nbsp;";
$f_16=$f_clas_nick;
$f_17="&nbsp;";
$f_11="&nbsp;";

$mm_00=$mm_nick;
$mm_02=$mm_b_num;
$mm_04=$mm_nat;
$mm_06=$mm_breed_nick;
$mm_08=$mm_race_nick;
$mm_10="&nbsp;";
$mm_12="&nbsp;";
$mm_14="&nbsp;";
$mm_15="&nbsp;";
$mm_16=$mm_clas_nick;
$mm_17="&nbsp;";
$mm_11="&nbsp;";

$fm_00=$fm_nick;
$fm_02=$fm_b_num;
$fm_04=$fm_nat;
$fm_06=$fm_breed_nick;
$fm_08=$fm_race_nick;
$fm_10="&nbsp;";
$fm_12="&nbsp;";
$fm_14="&nbsp;";
$fm_15="&nbsp;";
$fm_16=$fm_clas_nick;
$fm_17="&nbsp;";
$fm_11="&nbsp;";

$mf_00=$mf_nick;
$mf_02=$mf_b_num;
$mf_04=$mf_nat;
$mf_06=$mf_breed_nick;
$mf_08=$mf_race_nick;
$mf_10="&nbsp;";
$mf_12="&nbsp;";
$mf_14="&nbsp;";
$mf_15="&nbsp;";
$mf_16=$mf_clas_nick;
$mf_17="&nbsp;";
$mf_11="&nbsp;";

$ff_00=$ff_nick;
$ff_02=$ff_b_num;
$ff_04=$ff_nat;
$ff_06=$ff_breed_nick;
$ff_08=$ff_race_nick;
$ff_10="&nbsp;";
$ff_12="&nbsp;";
$ff_14="&nbsp;";
$ff_15="&nbsp;";
$ff_16=$ff_clas_nick;
$ff_17="&nbsp;";
$ff_11="&nbsp;";


$mmm_00=$mmm_nick;
$mmm_02=$mmm_b_num;
$mmm_04=$mmm_nat;
$mmm_06=$mmm_breed_nick;
$mmm_08=$mmm_race_nick;
$mmm_10="&nbsp;";
$mmm_12="&nbsp;";
$mmm_14="&nbsp;";
$mmm_15="&nbsp;";
$mmm_16=$mmm_clas_nick;
$mmm_17="&nbsp;";
$mmm_11="&nbsp;";

$mfm_00=$mfm_nick;
$mfm_02=$mfm_b_num;
$mfm_04=$mfm_nat;
$mfm_06=$mfm_breed_nick;
$mfm_08=$mfm_race_nick;
$mfm_10="&nbsp;";
$mfm_12="&nbsp;";
$mfm_14="&nbsp;";
$mfm_15="&nbsp;";
$mfm_16=$mfm_clas_nick;
$mfm_17="&nbsp;";
$mfm_11="&nbsp;";

$mmf_00=$mmf_nick;
$mmf_02=$mmf_b_num;
$mmf_04=$mmf_nat;
$mmf_06=$mmf_breed_nick;
$mmf_08=$mmf_race_nick;
$mmf_10="&nbsp;";
$mmf_12="&nbsp;";
$mmf_14="&nbsp;";
$mmf_15="&nbsp;";
$mmf_16=$mmf_clas_nick;
$mmf_17="&nbsp;";
$mmf_11="&nbsp;";

$mff_00=$mff_nick;
$mff_02=$mff_b_num;
$mff_04=$mff_nat;
$mff_06=$mff_breed_nick;
$mff_08=$mff_race_nick;
$mff_10="&nbsp;";
$mff_12="&nbsp;";
$mff_14="&nbsp;";
$mff_15="&nbsp;";
$mff_16=$mff_clas_nick;
$mff_17="&nbsp;";
$mff_11="&nbsp;";

ArrayNbsp();

$ri=0;
for ( $ai=1; $ai<=20; $ai++ ) for ( $aj=1; $aj<=20; $aj++ ) {
	if ( $row[$ri]=="" ) $row[$ri]=-1;//IMPORTANT!!!
	if ( $row[$ri]*1==-1 ) $row[$ri]="";//IMPORTANT!!!
	$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
/*
	$a1_[$aij]='1'.$aij;
	$a2_[$aij]='2'.$aij;
	$a3_[$aij]='3'.$aij;
	$a5_[$aij]='5'.$aij;
	$a6_[$aij]='6'.$aij;
	$a7_[$aij]='7'.$aij;
	$a8_[$aij]='8'.$aij;
	$a9_[$aij]='9'.$aij;
	$aa_[$aij]='a'.$aij;
	$a41_[$aij]='mi'.$aij;
	$a42_[$aij]='fa'.$aij;
	$a43_[$aij]='al'.$aij;
*/
	$a9_[$aij]="&nbsp;";
	$aa_[$aij]="&nbsp;";
}
//SELECT cycle for part 2 of ccw1
	$res1=mysql_query( "SELECT a2_0101 FROM $c_f2ml WHERE id=$cow_id", $db ); $r=mysql_fetch_row( $res1 );
	$cow_id_exist=1;//IMPORTANT!!!
	if ( strlen( trim( $r[0] ))==0 ) {
		$cow_id_exist=0;//IMPORTANT!!!
		for ( $ai=1; $ai<=20; $ai++ ) for ( $aj=1; $aj<=20; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			$a2_[$aij]="";
			$a3_[$aij]="";
			$a41_[$aij]="";
			$a42_[$aij]="";
			$a43_[$aij]="";
			$a5_[$aij]="";
			$a6_[$aij]="";
			$a7_[$aij]="";
			$a8_[$aij]="";
		}
	} else {
		$sele_query="SELECT defects FROM $cows WHERE id='$cow_id'";
		$res1=mysql_query( $sele_query, $db ); $r=mysql_fetch_row( $res1 ); $r_idx=0;
		$aij=Int2StrZ( 0, 2 ).Int2StrZ( 1, 2 );
		$a3_[$aij]=$r[0]; if ( $a3_[$aij]*1==-1 ) $a3_[$aij]="";
		$sele_query="SELECT a2_0101";
		for ( $ai=1; $ai<=12; $ai++ ) for ( $aj=1; $aj<=2; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			if ( $aij!="0101" ) $sele_query=$sele_query.", a2_".$aij;//IMPORTANT!!!
		}
		$sele_query=$sele_query." FROM $c_f2ml WHERE id='$cow_id'";
		$res1=mysql_query( $sele_query, $db ); $r=mysql_fetch_row( $res1 ); $r_idx=0;
		for ( $ai=1; $ai<=12; $ai++ ) for ( $aj=1; $aj<=2; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			$a2_[$aij]=$r[$r_idx]; if ( $a2_[$aij]*1==-1 ) $a2_[$aij]="";
			$r_idx++;
		}
		$sele_query="SELECT a3_0101";
		for ( $ai=1; $ai<=8; $ai++ ) for ( $aj=1; $aj<=5; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			if ( $aij!="0101" ) $sele_query=$sele_query.", a3_".$aij;//IMPORTANT!!!
		}
		$sele_query=$sele_query." FROM $c_f2ml WHERE id='$cow_id'";
		$res1=mysql_query( $sele_query, $db ); $r=mysql_fetch_row( $res1 ); $r_idx=0;
		for ( $ai=1; $ai<=8; $ai++ ) for ( $aj=1; $aj<=5; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			$a3_[$aij]=$r[$r_idx]; if ( $a3_[$aij]*1==-1 ) $a3_[$aij]="";
			$r_idx++;
		}
		$sele_query="SELECT a41_0101";
		for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=12; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			if ( $aij!="0101" ) $sele_query=$sele_query.", a41_".$aij;//IMPORTANT!!!
		}
		$sele_query=$sele_query." FROM $c_f2ml WHERE id='$cow_id'";
		$res1=mysql_query( $sele_query, $db ); $r=mysql_fetch_row( $res1 ); $r_idx=0;
		for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=12; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			$a41_[$aij]=$r[$r_idx]; if ( $a41_[$aij]*1==-1 ) $a41_[$aij]="";
			$r_idx++;
		}
		$sele_query="SELECT a42_0101";
		for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=12; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			if ( $aij!="0101" ) $sele_query=$sele_query.", a42_".$aij;//IMPORTANT!!!
		}
		$sele_query=$sele_query." FROM $c_f2ml WHERE id='$cow_id'";
		$res1=mysql_query( $sele_query, $db ); $r=mysql_fetch_row( $res1 ); $r_idx=0;
		for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=12; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			$a42_[$aij]=$r[$r_idx]; if ( $a42_[$aij]*1==-1 ) $a42_[$aij]="";
			$r_idx++;
		}
		$sele_query="SELECT a43_0101";
		for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=12; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			if ( $aij!="0101" ) $sele_query=$sele_query.", a43_".$aij;//IMPORTANT!!!
		}
		$sele_query=$sele_query." FROM $c_f2ml WHERE id='$cow_id'";
		$res1=mysql_query( $sele_query, $db ); $r=mysql_fetch_row( $res1 ); $r_idx=0;
		for ( $ai=1; $ai<=9; $ai++ ) for ( $aj=1; $aj<=12; $aj++ ) {
			$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
			$a43_[$aij]=$r[$r_idx]; if ( $a43_[$aij]*1==-1 ) $a43_[$aij]="";
			$r_idx++;
		}
		$sele_query="SELECT a5_0101";
		for ( $ai=1; $ai<=11; $ai++ ) {
			for ( $aj=1; $aj<=7; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				if ( $aij!="0101" ) $sele_query=$sele_query.", a5_".$aij;//IMPORTANT!!!
			}
			for ( $aj=1; $aj<=9; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				$sele_query=$sele_query.", a6_".$aij;
			}
			for ( $aj=1; $aj<=2; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				$sele_query=$sele_query.", a7_".$aij;
			}
			for ( $aj=1; $aj<=6; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				$sele_query=$sele_query.", a8_".$aij;
			}
		}
		$sele_query=$sele_query." FROM $c_f2ml WHERE id='$cow_id'";
		$res1=mysql_query( $sele_query, $db ); $r=mysql_fetch_row( $res1 ); $r_idx=0;
		for ( $ai=1; $ai<=11; $ai++ ) {
			for ( $aj=1; $aj<=7; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				$a5_[$aij]=$r[$r_idx]; if ( $a5_[$aij]*1==-1 ) $a5_[$aij]="";
				if ( $aj==2 | $aj==4 | $aj==5 ) {
					if ( strlen( $a5_[$aij] )==10 ) $a5_[$aij]=Date_FromDb2Scr( $a5_[$aij], "-" );
				}
				$r_idx++;
			}
			for ( $aj=1; $aj<=9; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				$a6_[$aij]=$r[$r_idx]; if ( $a6_[$aij]*1==-1 ) $a6_[$aij]="";
				$r_idx++;
			}
			for ( $aj=1; $aj<=2; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				$a7_[$aij]=$r[$r_idx]; if ( $a7_[$aij]*1==-1 ) $a7_[$aij]="";
				$r_idx++;
			}
			for ( $aj=1; $aj<=6; $aj++ ) {
				$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
				$a8_[$aij]=$r[$r_idx]; if ( $a8_[$aij]*1==-1 ) $a8_[$aij]="";
				$r_idx++;
			}
		}
	}
//SELECT cycle for part 2 of ccw1 [END]
for ( $ai=1; $ai<=20; $ai++ ) for ( $aj=1; $aj<=20; $aj++ ) {
	if ( $row[$ri]=="" ) $row[$ri]=-1;//IMPORTANT!!!
	if ( $row[$ri]*1==-1 ) $row[$ri]="";//IMPORTANT!!!
	$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
	if ( strlen( trim( $a1_[$aij]))==0 ) $a1_[$aij]=$a1_[$aij]."&nbsp;";
	if ( strlen( trim( $a2_[$aij]))==0 ) $a2_[$aij]=$a2_[$aij]."&nbsp;";
	if ( strlen( trim( $a3_[$aij]))==0 ) $a3_[$aij]=$a3_[$aij]."&nbsp;";
	if ( strlen( trim( $a5_[$aij]))==0 ) $a5_[$aij]=$a5_[$aij]."&nbsp;";
	if ( strlen( trim( $a6_[$aij]))==0 ) $a6_[$aij]=$a6_[$aij]."&nbsp;";
	if ( strlen( trim( $a7_[$aij]))==0 ) $a7_[$aij]=$a7_[$aij]."&nbsp;";
	if ( strlen( trim( $a8_[$aij]))==0 ) $a8_[$aij]=$a8_[$aij]."&nbsp;";
	if ( strlen( trim( $a9_[$aij]))==0 ) $a9_[$aij]=$a9_[$aij]."&nbsp;";
	if ( strlen( trim( $aa_[$aij]))==0 ) $aa_[$aij]=$aa_[$aij]."&nbsp;";
	if ( strlen( trim( $a41_[$aij]))==0 ) $a41_[$aij]=$a41_[$aij]."&nbsp;";
	if ( strlen( trim( $a42_[$aij]))==0 ) $a42_[$aij]=$a42_[$aij]."&nbsp;";
	if ( strlen( trim( $a43_[$aij]))==0 ) $a43_[$aij]=$a43_[$aij]."&nbsp;";
}
for ( $ai=1; $ai<=20; $ai++ ) {
	$aij=Int2StrZ( $ai, 2 ).Int2StrZ( 6, 2 );
	$m1_=Int2StrZ( $ai, 2 ).Int2StrZ( 4, 2 );
	$m2_=Int2StrZ( $ai, 2 ).Int2StrZ( 5, 2 );
	$a6_[$aij]=round( $a6_[$m1_]*$a6_[$m2_]/100, 2 );
	$aij=Int2StrZ( $ai, 2 ).Int2StrZ( 8, 2 );
	$m1_=Int2StrZ( $ai, 2 ).Int2StrZ( 4, 2 );
	$m2_=Int2StrZ( $ai, 2 ).Int2StrZ( 7, 2 );
	$a6_[$aij]=round( $a6_[$m1_]*$a6_[$m2_]/100, 2 );
}

echo "
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 3.2//EN'>
<HTML>
<HEAD>
<META CONTENT='text/html;charset=windows-1251' HTTP-EQUIV='content-type'>
</HEAD>
<BODY LANG='uk-UA' LINK='#000080' VLINK='#800000' DIR='LTR'>

<!-- ? -->
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0>
<TR ALIGN=CENTER>
	<TD ALIGN=LEFT ROWSPAN=2 WIDTH=11%>
		<P><FONT SIZE=1>КАРТКА ПЛЕМІННОЇ КОРОВИ</FONT></TD>
	<TD WIDTH=20%>
		<P><FONT SIZE=1>Область</FONT></TD>
	<TD WIDTH=19%>
		<P><FONT SIZE=1>Район</FONT></TD>
	<TD ALIGN=RIGHT ROWSPAN=2 WIDTH=50%>
		<P><FONT SIZE=1>ЗАТВЕРДЖЕНО<BR>
		Наказ Міністерства аграрної політики України<BR>
		30.12.2003 № 474<BR>
		Форма № 2 - мол</FONT></TD>
	</TR>
<TR ALIGN=CENTER>
	<TD>
		<B><FONT SIZE=1>$region</FONT></B></TD>
	<TD>
		<B><FONT SIZE=1>$subregion</FONT></B></TD>
</TR>
</TABLE>
<P></P>

<!-- ? -->
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0>
<TR>
	<TD WIDTH=11%>
		<P><FONT SIZE=1>Прізвисько</FONT></TD>
	<TD WIDTH=39%>
		<P><FONT SIZE=1><B>$a_00</B></FONT></TD>
	<TD WIDTH=11%>
		<P><FONT SIZE=1>Дата народження</FONT></TD>
	<TD WIDTH=39%>
		<P><FONT SIZE=1><B>$a_01</B></FONT></TD>
</TR>
<TR>
	<TD>
		<P><FONT SIZE=1>Ідентифікаційний №</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_02</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1>Місце народження</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_03</B></FONT></TD>
</TR>
<TR>
	<TD>
		<P><FONT SIZE=1>Марка і № у ДКПТ</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_04</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1>Дата надходження</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_05</B></FONT></TD>
</TR>
<TR>
	<TD>
		<P><FONT SIZE=1>Порода</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_06</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1>Масть</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_07</B></FONT></TD>
</TR>
<TR>
	<TD>
		<P><FONT SIZE=1>Породність</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_08</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1>Призначення</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_09</B></FONT></TD>
</TR>
<TR>
	<TD>
		<P><FONT SIZE=1>Лінія</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_10</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1>Генетичні дослідження</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_11</B></FONT></TD>
</TR>
<TR>
	<TD>
		<P><FONT SIZE=1>Родина</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_12</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1>Власник</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a_13</B></FONT></TD>
</TR>
</TABLE>
<P></P>

<!-- I. -->
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0>
<!-- m f -->
<TR ALIGN=CENTER>
	<TD COLSPAN=17 WIDTH=100%>
		<P><A HREF='$ccw_href[1]'><FONT SIZE=1>I. ПОХОДЖЕННЯ</FONT></TD>
</TR>
<TR ALIGN=CENTER>
	<TD WIDTH=11%>
		<P><FONT SIZE=1><BR></FONT></TD>
	<TD WIDTH=14%>
		<P><FONT SIZE=1>М</FONT></TD>
	<TD COLSPAN=8 WIDTH=26%>
		<P><FONT SIZE=1><BR></FONT></TD>
	<TD WIDTH=14%>
		<P><FONT SIZE=1>Б</FONT></TD>
	<TD COLSPAN=6 WIDTH=35%>
		<P><FONT SIZE=1><BR></FONT></TD>
</TR>
<TR ALIGN=CENTER>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Прізвисько</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_00<B></FONT></TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Рік</FONT></TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Лакт.</FONT></TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Днів лакт.</FONT></TD>
	<TD COLSPAN=5 WIDTH=17%>
		<P><FONT SIZE=1>Прод. за 305 днів:</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_00</B></FONT></TD>
	<TD COLSPAN=6 ROWSPAN=2 WIDTH=35%>
		<P><FONT SIZE=1>Оцінка за якістю потомства:</FONT></TD>
</TR>
<TR ALIGN=CENTER>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Ідентифікаційний №</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_02</B></FONT></TD>
	<TD ROWSPAN=2 WIDTH=5%>
		<P><FONT SIZE=1>надій, кг</FONT></TD>
	<TD COLSPAN=2 WIDTH=6%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD COLSPAN=2 WIDTH=6%>
		<P><FONT SIZE=1>білок</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_02</B></FONT></TD>
</TR>
<TR ALIGN=CENTER>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Марка і № у ДКПТ</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_04</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>%</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>%</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>кг</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_04</B></FONT></TD>
	<TD WIDTH=10%>
		<P><FONT SIZE=1>Метод, рік оцінки</FONT></TD>
	<TD ALIGN=RIGHT WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[00][00]."</B></FONT></TD>
	<TD COLSPAN=3 WIDTH=14%>
		<P><FONT SIZE=1>Середні:</FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1>ПЦ</FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Порода</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_06</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[01][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_06</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=10%>
		<P><FONT SIZE=1>Дочок</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[01][01]."</B></FONT></TD>
	<TD ALIGN=CENTER COLSPAN=2 WIDTH=8%>
		<P><FONT SIZE=1>надій, кг</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[01][02]."</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>".$f_[01][03]."</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Породність</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_08</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[02][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_08</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=10%>
		<P><FONT SIZE=1>Стад</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[02][01]."</B></FONT></TD>
	<TD ALIGN=CENTER ROWSPAN=2 WIDTH=4%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>%</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[02][02]."</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>".$f_[02][03]."</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Лінія</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_10</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[03][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_10</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=10%>
		<P><FONT SIZE=1>Повт., %</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[03][01]."</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>кг</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[03][02]."</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>".$f_[03][03]."</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Родина</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_12</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[04][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_12</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=10%>
		<P><FONT SIZE=1>Лакт. (вік)</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[04][01]."</B></FONT></TD>
	<TD ALIGN=CENTER ROWSPAN=2 WIDTH=4%>
		<P><FONT SIZE=1>білок</FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>%</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[04][02]."</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>".$f_[05][03]."</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Вік, місяців</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_14</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[05][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_14</B></FONT></TD>
	<TD ALIGN=LEFT COLSPAN=2 ROWSPAN=5 WIDTH=16%>
		<P><FONT SIZE=1>ОТ <B>".$f_[05][01]."</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>кг</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>".$f_[05][02]."</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>".$f_[05][03]."</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Жива маса, кг</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_15</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[06][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_15</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Комплексний клас</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_16</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[07][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_16</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Розряд ПЦ</FONT></TD>
	<TD ALIGN=CENTER WIDTH=14%>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[08][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_17</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Генетичні дослідження</FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$m_11</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][01]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][02]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][03]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][04]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][05]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][06]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][07]."</B></FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>".$m_[09][08]."</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=14%>
		<P><FONT SIZE=1><B>$f_11</B></FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD ALIGN=CENTER WIDTH=4%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=6%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
	<TD WIDTH=5%>
		<P><FONT SIZE=1><B>-</B></FONT></TD>
</TR>
<!-- mm fm mf ff -->
<TR>
<!-- mm fm -->
	<TD COLSPAN=10 WIDTH=50%>
		<TABLE WIDTH=100% BORDER=0 BORDERCOLOR=#ffffff CELLPADDING=3 CELLSPACING=1>
		<TR VALIGN=CENTER>
			<TD COLSPAN=6 STYLE=BACKGROUND:#dce2d7 WIDTH=50%>
				<P ALIGN=CENTER><FONT SIZE=1>ММ</FONT></TD>
			<TD COLSPAN=6 STYLE=BACKGROUND:#dce2d7 WIDTH=50%>
				<P ALIGN=CENTER><FONT SIZE=1>БМ</FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3 WIDTH=14%>
				<P><FONT SIZE=1>Прізв.</FONT></TD>
			<TD COLSPAN=3 WIDTH=33%>
				<P><FONT SIZE=1><B>$mm_00</B></FONT></TD>
			<TD COLSPAN=6 WIDTH=53%>
				<P><FONT SIZE=1><B>$fm_00</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Ідент. №</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mm_02</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$fm_02</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>ДКПТ</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mm_04</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$fm_04</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Порода</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mm_06</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$fm_06</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Породність</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mm_08</B></FONT></TD>
			<TD COLSPAN=7>
				<P><FONT SIZE=1><B>$fm_08</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>К. клас</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mm_16</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$fm_16</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Розряд ПЦ</FONT></TD>
			<TD ALIGN=CENTER COLSPAN=3>
				<P><FONT SIZE=1>x</FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$fm_17</B></FONT></TD>
		</TR>
		<TR ALIGN=CENTER STYLE=BACKGROUND:#eeeeee VALIGN=CENTER>
			<TD ROWSPAN=2 WIDTH=5%>
				<P><FONT SIZE=1>Рік</FONT></TD>
			<TD ROWSPAN=2 WIDTH=4%>
				<P><FONT SIZE=1>Лакт.</FONT></TD>
			<TD ROWSPAN=2 WIDTH=5%>
				<P><FONT SIZE=1>Днів лакт.</FONT></TD>
			<TD COLSPAN=3 WIDTH=33%>
				<P><FONT SIZE=1>Прод. за 305 днів:</FONT></TD>
			<TD COLSPAN=6 WIDTH=53%>
				<P><FONT SIZE=1>Оцінка за якістю потомства:</FONT></TD>
		</TR>
		<TR ALIGN=CENTER STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>надій, кг</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>жир, %</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>білок, %</FONT></TD>
			<TD WIDTH=12%>
				<P><FONT SIZE=1>Метод, рік оцінки</FONT></TD>
			<TD WIDTH=13%>
				<P ALIGN=RIGHT><FONT SIZE=1><B>".$fm_[00][00]."</B></FONT></TD>
			<TD COLSPAN=3 WIDTH=21%>
				<P><FONT SIZE=1>Середні:</FONT></TD>
			<TD WIDTH=1%>
				<P><FONT SIZE=1>ПЦ</FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[01][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[01][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[01][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[01][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[01][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[01][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Дочок</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[01][01]."</B></FONT></TD>
			<TD COLSPAN=2>
				<P ALIGN=CENTER><FONT SIZE=1>надій, кг</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[01][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[01][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[02][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[02][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[02][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[02][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[02][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[02][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Стад</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[02][01]."</B></FONT></TD>
			<TD ROWSPAN=2>
				<P ALIGN=CENTER><FONT SIZE=1>жир</FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>%</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[02][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[02][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[03][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[03][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[03][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[03][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[03][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[03][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Повт., %</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[03][01]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>кг</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[03][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[03][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[04][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[04][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[04][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[04][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[04][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[04][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Лакт. (вік)</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[04][01]."</B></FONT></TD>
			<TD ROWSPAN=2 WIDTH=11%>
				<P ALIGN=CENTER><FONT SIZE=1>білок</FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>%</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[04][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$fm_[04][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[05][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[05][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[05][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[05][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[05][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[05][07]."</B></FONT></TD>
			<TD COLSPAN=2 ROWSPAN=2>
				<P ALIGN=LEFT><FONT SIZE=1>ОТ&nbsp;<B>".$fm_[05][01]."</B></FONT></TD>
			<TD ALIGN=CENTER WIDTH=1%>
				<P ALIGN=CENTER><FONT SIZE=1>кг</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1><B>".$fm_[05][02]."</B></FONT></TD>
			<TD WIDTH=1%>
				<P><FONT SIZE=1><B>".$fm_[05][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE=BACKGROUND:#eeeeee VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[06][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[06][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[06][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[06][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[06][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mm_[06][07]."</B></FONT></TD>
			<TD WIDTH=11%>
				<P ALIGN=CENTER><FONT SIZE=1>-</FONT></TD>
			<TD ALIGN=CENTER WIDTH=1%>
				<P ALIGN=CENTER><FONT SIZE=1>-</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1><B>-</B></FONT></TD>
			<TD WIDTH=1%>
				<P><FONT SIZE=1><B>-</B></FONT></TD>
		</TR>
		</TABLE>
	</TD>
<!-- mf ff -->
	<TD COLSPAN=8 WIDTH=50%>
		<TABLE WIDTH=100% BORDER=0 BORDERCOLOR=#ffffff CELLPADDING=3 CELLSPACING=1>
		<TR VALIGN=CENTER>
			<TD COLSPAN=6 STYLE=BACKGROUND:#dce2d7 WIDTH=50%>
				<P ALIGN=CENTER><FONT SIZE=1>МБ</FONT></TD>
			<TD COLSPAN=6 STYLE=BACKGROUND:#dce2d7 WIDTH=50%>
				<P ALIGN=CENTER><FONT SIZE=1>ББ</FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3 WIDTH=14%>
				<P><FONT SIZE=1>Прізв.</FONT></TD>
			<TD COLSPAN=3 WIDTH=33%>
				<P><FONT SIZE=1><B>$mf_00</B></FONT></TD>
			<TD COLSPAN=6 WIDTH=53%>
				<P><FONT SIZE=1><B>$ff_00</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Ідент. №</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mf_02</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$ff_02</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>ДКПТ</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mf_04</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$ff_04</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Порода</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mf_06</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$ff_06</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Породність</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mf_08</B></FONT></TD>
			<TD COLSPAN=7>
				<P><FONT SIZE=1><B>$ff_08</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>К. клас</FONT></TD>
			<TD COLSPAN=3>
				<P><FONT SIZE=1><B>$mf_16</B></FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$ff_16</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD COLSPAN=3>
				<P><FONT SIZE=1>Розряд ПЦ</FONT></TD>
			<TD ALIGN=CENTER COLSPAN=3>
				<P><FONT SIZE=1>x</FONT></TD>
			<TD COLSPAN=6>
				<P><FONT SIZE=1><B>$ff_17</B></FONT></TD>
		</TR>
		<TR ALIGN=CENTER STYLE=BACKGROUND:#eeeeee VALIGN=CENTER>
			<TD ROWSPAN=2 WIDTH=5%>
				<P><FONT SIZE=1>Рік</FONT></TD>
			<TD ROWSPAN=2 WIDTH=4%>
				<P><FONT SIZE=1>Лакт.</FONT></TD>
			<TD ROWSPAN=2 WIDTH=5%>
				<P><FONT SIZE=1>Днів лакт.</FONT></TD>
			<TD COLSPAN=3 WIDTH=33%>
				<P><FONT SIZE=1>Прод. за 305 днів:</FONT></TD>
			<TD COLSPAN=6 WIDTH=53%>
				<P><FONT SIZE=1>Оцінка за якістю потомства:</FONT></TD>
		</TR>
		<TR ALIGN=CENTER STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>надій, кг</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>жир, %</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>білок, %</FONT></TD>
			<TD WIDTH=12%>
				<P><FONT SIZE=1>Метод, рік оцінки</FONT></TD>
			<TD WIDTH=13%>
				<P ALIGN=RIGHT><FONT SIZE=1><B>".$ff_[00][00]."</B></FONT></TD>
			<TD COLSPAN=3 WIDTH=21%>
				<P><FONT SIZE=1>Середні:</FONT></TD>
			<TD WIDTH=1%>
				<P><FONT SIZE=1>ПЦ</FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[01][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[01][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[01][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[01][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[01][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[01][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Дочок</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[01][01]."</B></FONT></TD>
			<TD COLSPAN=2>
				<P ALIGN=CENTER><FONT SIZE=1>надій, кг</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[01][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[01][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[02][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[02][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[02][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[02][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[02][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[02][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Стад</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[02][01]."</B></FONT></TD>
			<TD ROWSPAN=2>
				<P ALIGN=CENTER><FONT SIZE=1>жир</FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>%</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[02][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[02][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[03][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[03][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[03][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[03][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[03][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[03][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Повт., %</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[03][01]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>кг</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[03][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[03][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[04][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[04][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[04][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[04][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[04][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[04][07]."</B></FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>Лакт. (вік)</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[04][01]."</B></FONT></TD>
			<TD ROWSPAN=2 WIDTH=11%>
				<P ALIGN=CENTER><FONT SIZE=1>білок</FONT></TD>
			<TD>
				<P ALIGN=CENTER><FONT SIZE=1>%</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[04][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$ff_[04][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE='BACKGROUND:#eeeeee; HEIGHT:30px' VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[05][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[05][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[05][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[05][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[05][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[05][07]."</B></FONT></TD>
			<TD COLSPAN=2 ROWSPAN=2>
				<P ALIGN=LEFT><FONT SIZE=1>ОТ&nbsp;<B>".$ff_[05][01]."</B></FONT></TD>
			<TD ALIGN=CENTER WIDTH=1%>
				<P ALIGN=CENTER><FONT SIZE=1>кг</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1><B>".$ff_[05][02]."</B></FONT></TD>
			<TD WIDTH=1%>
				<P><FONT SIZE=1><B>".$ff_[05][03]."</B></FONT></TD>
		</TR>
		<TR ALIGN=RIGHT STYLE=BACKGROUND:#eeeeee VALIGN=CENTER>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[06][01]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[06][02]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[06][03]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[06][04]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[06][05]."</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>".$mf_[06][07]."</B></FONT></TD>
			<TD WIDTH=11%>
				<P ALIGN=CENTER><FONT SIZE=1>-</FONT></TD>
			<TD ALIGN=CENTER WIDTH=1%>
				<P ALIGN=CENTER><FONT SIZE=1>-</FONT></TD>
			<TD WIDTH=11%>
				<P><FONT SIZE=1><B>-</B></FONT></TD>
			<TD WIDTH=1%>
				<P><FONT SIZE=1><B>-</B></FONT></TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<!-- mmm fmm mfm ffm mmf fmf mff fff -->
<TR>
<!-- mmm fmm mfm ffm -->
	<TD COLSPAN=10 WIDTH=50%>
		<TABLE WIDTH=100% BORDER=0 BORDERCOLOR=#ffffff CELLPADDING=1 CELLSPACING=1>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P ALIGN=CENTER><FONT SIZE=1></FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>МММ</FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>БММ</FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>МБМ</FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>ББМ</FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Прізв.</FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$mmm_00</B></FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$fmm_00</B></FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$mfm_00</B></FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$ffm_00</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Ідент. №</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmm_02</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmm_02</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mfm_02</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$ffm_02</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>ДКПТ</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmm_04</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmm_04</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mfm_04</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$ffm_04</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Порода</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmm_06</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmm_06</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mfm_06</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$ffm_06</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Породність</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmm_08</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmm_08</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mfm_08</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$ffm_08</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>К. клас</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmm_16</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmm_16</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mfm_16</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$ffm_16</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Розряд ПЦ</FONT></TD>
			<TD ALIGN=CENTER>
				<P><FONT SIZE=1>x</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmm_17</B></FONT></TD>
			<TD ALIGN=CENTER>
				<P><FONT SIZE=1>x</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$ffm_17</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Продуктивність</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmm_19</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmm_19</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mfm_19</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$ffm_19</B></FONT></TD>
		</TR>
		</TABLE>
	</TD>
<!-- mmf fmf mff fff -->
	<TD COLSPAN=8 WIDTH=50%>
		<TABLE WIDTH=100% BORDER=0 BORDERCOLOR=#ffffff CELLPADDING=1 CELLSPACING=1>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P ALIGN=CENTER><FONT SIZE=1></FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>ММБ</FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>БМБ</FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>МББ</FONT></TD>
			<TD STYLE=BACKGROUND:#dce2d7 WIDTH=20%>
				<P ALIGN=CENTER><FONT SIZE=1>БББ</FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Прізв.</FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$mmf_00</B></FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$fmf_00</B></FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$mff_00</B></FONT></TD>
			<TD WIDTH=20%>
				<P><FONT SIZE=1><B>$fff_00</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Ідент. №</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmf_02</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmf_02</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mff_02</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fff_02</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>ДКПТ</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmf_04</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmf_04</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mff_04</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fff_04</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Порода</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmf_06</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmf_06</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mff_06</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fff_06</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Породність</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmf_08</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmf_08</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mff_08</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fff_08</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>К. клас</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmf_16</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmf_16</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mff_16</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fff_16</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Розряд ПЦ</FONT></TD>
			<TD ALIGN=CENTER>
				<P><FONT SIZE=1>x</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmf_17</B></FONT></TD>
			<TD ALIGN=CENTER>
				<P><FONT SIZE=1>x</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fff_17</B></FONT></TD>
		</TR>
		<TR VALIGN=CENTER>
			<TD WIDTH=11%>
				<P><FONT SIZE=1>Продуктивність</FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mmf_19</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fmf_19</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$mff_19</B></FONT></TD>
			<TD>
				<P><FONT SIZE=1><B>$fff_19</B></FONT></TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<P></P>

<!-- II. III. -->
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD COLSPAN=2 WIDTH=19%>
		<P><A HREF='$ccw_href[2]'><FONT SIZE=1>II. РОЗВИТОК</FONT></TD>
	<TD COLSPAN=7 WIDTH=81%>
		<P><A HREF='$ccw_href[3]'><FONT SIZE=1>III. ПРОМІРИ</FONT></TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD WIDTH=11%>
		<P><FONT SIZE=1>Вік</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>Жива маса, кг</FONT></TD>
	<TD ROWSPAN=3 WIDTH=11%>
		<P><FONT SIZE=1>Характеристика</FONT></TD>
	<TD COLSPAN=5>
		<P><FONT SIZE=1>Проміри (см) у віці:</FONT></TD>
	<TD ROWSPAN=13 WIDTH=21%>
		<P><FONT SIZE=1>Фото</FONT></TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD WIDTH=11%>
		<P><FONT SIZE=1>новонародж.</FONT></TD>
	<TD ALIGN=RIGHT WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0102]</B></FONT></TD>
	<TD COLSPAN=2>
		<P><FONT SIZE=1>місяців</FONT></TD>
	<TD COLSPAN=3>
		<P><FONT SIZE=1>отелень</FONT></TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD WIDTH=11%>
		<P><FONT SIZE=1>3 міс.</FONT></TD>
	<TD ALIGN=RIGHT WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0202]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>12</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>18</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>1</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>2</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>3...</FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>6 міс.</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0302]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Висота у холці</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0101]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0102]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0103]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0104]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0105]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>9 міс.</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0402]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Висота у крижах</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0201]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0202]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0203]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0204]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0205]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>12 міс.</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0502]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Глибина грудей</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0301]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0302]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0303]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0304]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0305]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>15 міс.</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0602]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Ширина грудей</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0401]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0402]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0403]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0404]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0405]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>18 міс.</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0702]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Ширина у сіднічних горбах</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0501]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0502]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0503]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0504]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0505]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>перше осім.</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0802]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Коса довжина тулуба</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0601]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0602]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0603]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0604]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0605]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>$a2_[0901]</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[0902]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Обхват за лопатками</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0701]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0702]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0703]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0704]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0705]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>$a2_[1001]</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[1002]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Обхват п`ясті</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0801]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0802]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0803]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0804]</B></FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a3_[0805]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>$a2_[1101]</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[1102]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>-</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1>-</FONT></TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=11%>
		<P><FONT SIZE=1>$a2_[1201]</FONT></TD>
	<TD WIDTH=8%>
		<P><FONT SIZE=1><B>$a2_[1202]</B></FONT></TD>
	<TD ALIGN=LEFT WIDTH=11%>
		<P><FONT SIZE=1>Вади екстер`єру</FONT></TD>
	<TD ALIGN=LEFT COLSPAN=5>
		<P><FONT SIZE=1><B>$a3_[0001]</B></FONT></TD>
</TR>
</TABLE>
<P></P>

<!-- IV. -->
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0>
<TBODY>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD COLSPAN=28>
		<P><A HREF='$ccw_href[4]'><FONT SIZE=1>IV. КОНТРОЛЬ МОЛОЧНОЇ ПРОДУКТИВНОСТІ ЗА МІСЯЦЯМИ</FONT></TD>
</TR>
</TBODY>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD ROWSPAN=2 WIDTH=10%>
		<P><FONT SIZE=1>Мiсяць</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_01 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_02 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_03 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_04 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_05 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_06 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_07 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_08 р.</FONT></TD>
	<TD COLSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>$a4_09 р.</FONT></TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>надiй, кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>бiлок</FONT></TD>
</TR>";
for ( $aj=1; $aj<=12; $aj++ ) {
	$aij=Int2StrZ( $aj, 2 );
	echo "
<TR ALIGN=RIGHT VALIGN=CENTER>
	<TD ALIGN=CENTER WIDTH=10%>
		<P><FONT SIZE=1>$mon $aij</FONT></TD>";
	for ( $ai=1; $ai<=9; $ai++ ) {
		$aij=Int2StrZ( $ai, 2 ).Int2StrZ( $aj, 2 );
		echo "
	<TD WIDTH=4%>
		<P><FONT SIZE=1><B>$a41_[$aij]</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a42_[$aij]</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a43_[$aij]</FONT></TD>";
	}
	echo "
</TR>";
}
echo "
</TABLE>
<P></P>

<!-- V. VI. VII. VIII. -->
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0>
<TBODY>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD COLSPAN=7>
		<P><A HREF='$ccw_href[5]'><FONT SIZE=1>V. ВІДТВОРЮВАЛЬНА ЗДАТНІСТЬ</FONT></TD>
	<TD COLSPAN=9>
		<P><A HREF='$ccw_href[6]'><FONT SIZE=1>VI. ПРОДУКТИВНІСТЬ І ЖИВА МАСА</FONT></TD>
	<TD COLSPAN=2>
		<P><A HREF='$ccw_href[7]'><FONT SIZE=1>VII. ПРИПЛІД</FONT></TD>
	<TD COLSPAN=7 WIDTH=30%>
		<P><A HREF='$ccw_href[8]'><FONT SIZE=1>VIII. ОЦІНКА ЗА ТИП БУДОВИ ТІЛА</FONT></TD>
</TR>
</TBODY>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD COLSPAN=3 ROWSPAN=2 WIDTH=15%>
		<P><FONT SIZE=1>Плідне осіменіння</FONT></TD>
	<TD ROWSPAN=3 WIDTH=4%>
		<P><FONT SIZE=1>Запуск</FONT></TD>
	<TD ROWSPAN=3 WIDTH=4%>
		<P><FONT SIZE=1>Отелення</FONT></TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Сух.</FONT></TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Серв.</FONT></TD>
	<TD COLSPAN=2 ROWSPAN=2>
		<P><FONT SIZE=1>Лакт.</FONT></TD>
	<TD WIDTH=3% ROWSPAN=3>
		<P><FONT SIZE=1>Надій, кг</FONT></TD>
	<TD COLSPAN=5>
		<P><FONT SIZE=1>Прод. за 305 днів:</FONT></TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Жива маса, кг</FONT></TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Стать</FONT></TD>
	<TD ROWSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>Ідент. №</FONT></TD>
	<TD ROWSPAN=3 WIDTH=10%>
		<P><FONT SIZE=1>Група ознак</FONT></TD>
	<TD COLSPAN=3>
		<P><FONT SIZE=1>Телиця (нетель)</FONT></TD>
	<TD COLSPAN=3>
		<P><FONT SIZE=1>Корова</FONT></TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD ROWSPAN=2 WIDTH=3%>
		<P><FONT SIZE=1>надій, кг</FONT></TD>
	<TD COLSPAN=2>
		<P><FONT SIZE=1>жир</FONT></TD>
	<TD COLSPAN=2>
		<P><FONT SIZE=1>білок</FONT></TD>
	<TD COLSPAN=3>
		<P><FONT SIZE=1>Балів у віці, міс.</FONT></TD>
	<TD COLSPAN=3>
		<P><FONT SIZE=1>Балів у віці, отел.</FONT></TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD WIDTH=1%>
		<P><FONT SIZE=1>№</FONT></TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>Дата</FONT></TD>
	<TD WIDTH=10%>
		<P><FONT SIZE=1>Бугай</FONT></TD>
	<TD WIDTH=1%>
		<P><FONT SIZE=1>№</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>днів</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>%</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>кг</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>%</FONT></TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>кг</FONT></TD>
	<TD WIDTH=2%>
		<P><FONT SIZE=1>6</FONT></TD>
	<TD WIDTH=2%>
		<P><FONT SIZE=1>12</FONT></TD>
	<TD WIDTH=2%>
		<P><FONT SIZE=1>18</FONT></TD>
	<TD WIDTH=2%>
		<P><FONT SIZE=1>1</FONT></TD>
	<TD WIDTH=2%>
		<P><FONT SIZE=1>2</FONT></TD>
	<TD WIDTH=2%>
		<P><FONT SIZE=1>3</FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0101]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0102]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0103]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0105]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0107]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0101]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0102]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0103]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0104]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0105]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0106]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0107]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0108]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0109]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0101]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0102]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Загальний вигляд</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0101]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0102]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0103]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0104]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0105]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0106]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0201]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0202]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0203]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0204]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0205]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0206]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0207]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0201]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0202]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0203]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0204]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0205]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0206]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0207]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0208]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0209]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0201]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0202]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Холка, спина, поперек, середня частина (формат тулуба для молодняку)</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0201]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0202]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0203]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0204]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0205]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0206]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0301]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0302]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0303]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0304]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0305]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0306]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0307]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0301]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0302]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0303]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0304]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0305]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0306]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0307]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0308]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0309]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0301]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0302]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Груди</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0304]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0305]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0306]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0401]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0402]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0403]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0404]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0405]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0406]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0407]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0401]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0402]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0403]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0404]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0405]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0406]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0407]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0408]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0409]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0401]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0402]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Крижі</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0404]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0405]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0406]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0501]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0502]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0503]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0504]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0505]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0506]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0507]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0501]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0502]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0503]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0504]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0505]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0506]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0507]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0508]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0509]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0501]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0502]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Кінцівки (кінцівки і ратиці для молодняку)</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0501]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0502]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0503]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0504]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0505]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0506]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0601]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0602]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0603]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0604]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0605]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0606]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0607]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0601]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0602]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0603]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0604]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0605]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0606]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0607]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0608]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0609]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0601]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0602]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Ратиці</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0604]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0605]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0606]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0701]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0702]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0703]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0704]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0705]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0706]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0707]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0701]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0702]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0703]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0704]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0705]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0706]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0707]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0708]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0709]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0701]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0702]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Вим`я</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0704]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0705]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0706]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0801]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0802]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0803]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0804]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0805]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0806]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0807]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0801]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0802]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0803]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0804]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0805]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0806]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0807]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0808]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0809]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0801]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0802]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Передня частина вимені</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0804]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0805]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0806]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0901]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0902]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[0903]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0904]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0905]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[0906]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[0907]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0901]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0902]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0903]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0904]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0905]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0906]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0907]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0908]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[0909]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[0901]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[0902]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Задня частина вимені</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0904]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0905]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[0906]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1001]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1002]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[1003]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[1004]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1005]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[1006]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1007]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1001]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1002]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1003]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1004]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1005]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1006]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1007]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1008]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1009]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[1001]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[1002]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Дійки</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1>x</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1004]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1005]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1006]</B></FONT></TD>
</TR>
<TR ALIGN=RIGHT HEIGHT=50px VALIGN=CENTER>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1101]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1102]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a5_[1103]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[1104]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1105]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a5_[1106]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a5_[1107]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1101]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1102]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1103]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1104]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1105]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1106]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1107]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1108]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a6_[1109]</B></FONT></TD>
	<TD ALIGN=CENTER>
		<P><FONT SIZE=1><B>$a7_[1101]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1><B>$a7_[1102]</B></FONT></TD>
	<TD ALIGN=LEFT>
		<P><FONT SIZE=1>Сума</FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1101]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1102]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1103]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1104]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1105]</B></FONT></TD>
	<TD>
		<P><FONT SIZE=1><B>$a8_[1106]</B></FONT></TD>
</TR>
</TABLE>
<P></P>

<!-- XI. X. XI. -->
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0>
<TBODY>
<TR ALIGN=CENTER VALIGN=CENTER>
	<TD COLSPAN=11>
		<P><A HREF='$ccw_href[9]'><FONT SIZE=1>XI. ВИЗНАЧЕННЯ КОМПЛЕКСНОГО КЛАСУ</FONT></TD>
	<TD COLSPAN=8>
		<P><A HREF='$ccw_href[10]'><FONT SIZE=1>X. СЕРЕДНЯ ПРОДУКТИВНІСТЬ ЗА РЯД ЛАКТАЦІЙ</FONT></TD>
	<TD COLSPAN=2>
		<P><A HREF='$ccw_href[15]'><FONT SIZE=1>УЧАСТЬ У ВИСТАВКАХ</FONT></TD>
</TR>
</TBODY>
<TR ALIGN=CENTER VALIGN=CENTER HEIGHT=45px>
	<TD ROWSPAN=3 COLSPAN=3>
		<P><FONT SIZE=1>Вік</FONT></TD>
	</TD>
	<TD COLSPAN=6>
		<P><FONT SIZE=1>Балів за:</FONT></TD>
	</TD>
	<TD ROWSPAN=3 WIDTH=3%>
		<P><FONT SIZE=1>Сума</FONT></TD>
	</TD>
	<TD ROWSPAN=3 WIDTH=5%>
		<P><FONT SIZE=1>К. клас</FONT></TD>
	</TD>
	<TD COLSPAN=3>
		<P><FONT SIZE=1>Враховано лакт.</FONT></TD>
	</TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=4%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER HEIGHT=45px>
	<TD ROWSPAN=2 WIDTH=3%>
		<P><FONT SIZE=1>мол. пр.</FONT></TD>
	</TD>
	<TD ROWSPAN=2 WIDTH=3%>
		<P><FONT SIZE=1>буд. тіла</FONT></TD>
	</TD>
	<TD ROWSPAN=2 WIDTH=3%>
		<P><FONT SIZE=1>живу масу</FONT></TD>
	</TD>
	<TD ROWSPAN=2 WIDTH=3%>
		<P><FONT SIZE=1>інт. м/в</FONT></TD>
	</TD>
	<TD COLSPAN=2 WIDTH=6%>
		<P><FONT SIZE=1>походж.</FONT></TD>
	</TD>
	<TD ROWSPAN=5 WIDTH=5%>
		<P><FONT SIZE=1>Сер. прод. за 305 днів</FONT></TD>
	</TD>
	<TD COLSPAN=2 WIDTH=4%>
		<P><FONT SIZE=1>надій, кг</FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0101]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0102]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0103]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0104]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0105]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER HEIGHT=45px>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>м</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>б</FONT></TD>
	</TD>
	<TD ROWSPAN=2 WIDTH=2%>
		<P><FONT SIZE=1>жир</FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1>%</FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0201]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0202]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0203]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0204]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0205]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER HEIGHT=47px>
	<TD ROWSPAN=4 WIDTH=3%>
		<P><FONT SIZE=1>Тел. (нет.)</FONT></TD>
	</TD>
	<TD COLSPAN=2 WIDTH=6%>
		<P><FONT SIZE=1>макс.</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>10</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>20</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>30</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>40</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>100</FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1>кг</FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0301]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0302]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0303]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0304]</B></FONT></TD>
	</TD>
	<TD ALIGN=RIGHT>
		<P><FONT SIZE=1><B>$aa_[0305]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER ROWSPAN=3>
		<P><FONT SIZE=1>міс.</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>6</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0102]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0103]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0105]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0106]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0107]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0108]</B></FONT></TD>
	</TD>
	<TD ROWSPAN=2>
		<P><FONT SIZE=1>біл.</FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1>%</FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0401]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0402]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0403]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0404]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0405]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>12</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0202]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0203]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0205]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0206]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0207]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0208]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1>кг</FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0501]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0502]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0503]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0504]</B></FONT></TD>
	</TD>
	<TD>
		<P><FONT SIZE=1><B>$aa_[0505]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>18</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0302]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0303]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0305]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0306]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0307]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0308]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=CENTER VALIGN=CENTER HEIGHT=45px>
	<TD ROWSPAN=6 WIDTH=3%>
		<P><FONT SIZE=1>Кор.</FONT></TD>
	</TD>
	<TD COLSPAN=2 WIDTH=6%>
		<P><FONT SIZE=1>макс.</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>70</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>10</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>5</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>5</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>5</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>5</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>100</FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1>x</FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER ROWSPAN=5>
		<P><FONT SIZE=1>отел.</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>1</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0401]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0402]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0403]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0403]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0405]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0406]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0407]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0408]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>2</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0501]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0502]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0503]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0504]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0505]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0506]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0507]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0508]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>3</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0601]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0602]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0603]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0604]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0605]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0606]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0607]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0608]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>4</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0701]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0702]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0703]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0704]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0705]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0706]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0707]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0708]</B></FONT></TD>
	</TD>
</TR>
<TR ALIGN=RIGHT VALIGN=CENTER HEIGHT=45px>
	<TD ALIGN=CENTER WIDTH=2%>
		<P><FONT SIZE=1>5</FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0801]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0802]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0803]</B></FONT></TD>
	</TD>
	<TD ALIGN=CENTER WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0804]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0805]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0806]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0807]</B></FONT></TD>
	</TD>
	<TD WIDTH=3%>
		<P><FONT SIZE=1><B>$a9_[0808]</B></FONT></TD>
	</TD>
</TR>
</TABLE>
<P></P>

</BODY>
</HTML>";
?>
