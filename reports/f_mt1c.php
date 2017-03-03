<?php
/* DF_2: reports/f_mt1c.php
math: extracting by table, total for 7(8) days (AVIDA)
c: 25.12.2005
m: 08.07.2015 */

//total by day
function Total_ByIdAndDate( $r, $m, $mc, $dc ) {
	global $mrowt, $row;
	$mcz=Int2StrZ( $mc, 2 ); $dcz=Int2StrZ( $dc, 2 ); $idx="$mcz-$dcz";
	$tmp=$mrowt[$r][$idx."0"]; $mrowt[$r][$idx."0"]=$tmp+$m;//milk by id & day
	$tmp=$mrowt[$r][$idx.$row[20]]; $mrowt[$r][$idx.$row[20]]=$tmp+$m;//milk by id & day & sess
	$tmp=$mtta[$r][$idx."0"]; $mtta[$r][$idx."0"]=$tmp+$m;//milk by day
}

$_filtsXmode="r";

$dontuse_period=2;//ONLY IN THIS REPORT, PERIOD_BEGIN=PERIOD_END MINUS 7 DAYS

$i=0; $dots_cnt=0;
$mtt=0; $mttq=0; $mtm=0; $mtmq=0; $mt0=0; $mt0q=0;

if ( $outsele_*1==-1 ) $db_id=0; else $db_id=21;

include( "f_jfilt.php" );
include( "../dflib/f_filt1.php" );

$yf1=$yf*10000; $mf1=$mf*100; $repbeg=$yf1+$mf1+$df;
$yl1=$yl*10000; $ml1=$ml*100; $repend=$yl1+$ml1+$dl;
while ( $yc<=$yl+1 ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	$yc1=$yc*10000; $mc1=$mc*100;
	if ( $yc1+$mc1<=$yl1+$ml1 ) {
		include( "f_jselm.php" );//DONT TOUCH THIS!
		if ( $error<1 ) { while ( $row=mysql_fetch_row( $res )) {//cut errors
			$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;//operation's date
			if ( $odt<$repbeg | $odt>$repend );
			else {
				$bd=$row[17]*1;
				if ((( trim( $filt_dev."." )!="." ) & ( $bd>=$bd_first ) & ( $bd<=$bd_last )) | (( trim( $filt_dev."." )=="." ) & ( $bd>0 ))) {
					$r=$row[$db_id]*1;//id
//					if ( $r_uniq[$r]==0 ) echo "$r<br>"; $r_uniq[$r]=$r;
					$mdt=$row[1].".".$row[2].".".$row[3];//operation's date
					$m=$row[4]*1;//operations's milk
					$mrowtq[$r][0]++; $mttq++; $mrowtq[$r][$row[20]]++;//quantity of opers: by id, total, by id & sess
					if ( $m==0 ) {//with milk==0: quantity of opers: by id, total, by id & sess
						$mrow0q[$r][0]++; $mt0q++;
						$mrow0q[$r][$row[20]]++;
					}
					$mbeg=$row[5]; $mend=$row[6]; $mtime=$row[7];//operation's begin & end & time
					$mast_4=$row[14]*1;//mastitus
					$mrowt[$r][0]=$mrowt[$r][0]+$m;//milk by id
					$mrowt[$r][$row[20]]=$mrowt[$r][$row[20]]+$m;//milk by id & sess
					$mtt=$mtt+$m;//total milk
					if ( $mast_4>0 ) {//with mastitus: milk by id & total milk
						$mrowmq[$r][0]++; $mtmq++;
						$mrowmq[$r][$row[20]]++;
						$mrowm[$r][0]=$mrowm[$r][0]+$m; $mtm=$mtm+$m;
						$mcz=Int2StrZ( $mc, 2 ); $dcz=Int2StrZ( $dc, 2 ); $idx="$mcz-$dcz";
						$mrowaq[$r][$idx.$row[20]]++;
					}
					Total_ByIdAndDate( $r, $m, $mc, $dc );//total by id and date
					$tt=split( ":", $mtime ); $tsec=$tt[0]*60+$tt[1]*1;//total time
					$mrow_tsec[$r][0]=$mrow_tsec[$r][0]+$tsec;
					$mrow_tsec[$r][$row[20]]=$mrow_tsec[$r][$row[20]]+$tsec;
					if ( $mrow_beg[$r]*1==0 ) {
						$mrow_beg[$r]=$mdt.", ".$mbeg."..".$mend;
						$mrow_end[$r]=$mrow_beg[$r];
					} else $mrow_end[$r]=$mdt.", ".$mbeg."..".$mend;
				}
			}
		} mysql_free_result( $res ); }
	} else return;
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++; }
}
?>
