<?php
/* DF_2: exp_imp/f_e001.php
export: milk data in DF_1 '2005.02.10' export format
c: 21.03.2011
m: 20.04.2017 */

function Iconv_1251_866( $x ) {
	$x=str_replace( chr( 178 ), "hex:B2:(UK)", $x );
	$x=str_replace( chr( 179 ), "hex:B3:(UK)", $x );
	if ( !@extension_loaded( "iconv" )) {
		$recoding_engine["iconv"]="-";
		$y=$x;
	} else {
		$y=iconv( "CP1251", "CP866", $x );
	}
	$y=str_replace( "hex:B2:(UK)", chr( 246 ), $y );
	$y=str_replace( "hex:B3:(UK)", chr( 247 ), $y );
	return $y;
}

$skip_clichk=1;
$skip_W3C_DOCTYPE=1;

//DONT TOUCH NEXT! CRITICAL FOR EXPORT!
$connectionCharset1="cp1251";

ob_start();//lock output to set cookies properly!

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

$title_=$title=$_GET["title"];
if ( strlen( $title_ )<=1 ) $title_=$php_mm["_01_tab1_"];

include( "../reports/f_jfilt.php" );//$hDir['reps'] IS NOT READY FOR THIS SCRIPT!

$yesterday=$_GET["yesterday"];
if ( $yesterday=="yesterday" ) {
	$now_dmY=date( "d.m.Y" ); $now_His=date( "H:i:s" );
	$today=strtotime( DateDdMmmYyyy( $now_dmY ));
	$dd=date( "d", $today ); $mm=date( "m", $today ); $yyyy=date( "Y", $today );
	$date2=date( "d-m-Y", mktime( -24, 0, 0, $mm, $dd, $yyyy ));
	$date1=$date2;
	$x=split( "-", $date2 );
	$yl=$yf=$x[2]*1; $ml=$mf=$x[1]*1; $dl=$df=$x[0]*1;
	$yl1=$yf1=$yf*10000; $ml1=$mf1=$mf*100;
	$yc=$yl; $mc=$ml; $dc=$dl;
} else {
	$yf1=$yf*10000; $mf1=$mf*100;
	$yl1=$yl*10000; $ml1=$ml*100;
	if ( $df<10 ) $date1="0"; $date1=$date1.$df."-";
	if ( $mf<10 ) $date1=$date1."0"; $date1=$date1.$mf."-";
	$date1=$date1.$yf;
	if ( $dl<10 ) $date2="0"; $date2=$date2.$dl."-";
	if ( $ml<10 ) $date2=$date2."0"; $date2=$date2.$ml."-";
	$date2=$date2.$yl;
}

if ( $mf<10 ) $mf="0".$mf; if ( $df<10 ) $df="0".$df;
if ( $ml<10 ) $ml="0".$ml; if ( $dl<10 ) $dl="0".$dl;

$query="SELECT
 id, nick
 FROM $lots";
$res=mysql_query( $query, $db ); $sqlerr=mysql_errno();
while ( $row=mysql_fetch_row( $res )) $lotnick_prv[$row[0]]=$row[1];
$query="SELECT
 id, nick
 FROM $groups";
$res=mysql_query( $query, $db ); $sqlerr=mysql_errno();
while ( $row=mysql_fetch_row( $res )) $grnick_prv[$row[0]]=$row[1];

$f_head="Dat_d;Ninv;Klichka;Nferm;Ndz;Ud;Time_d;Spid_30;Spid_60;Spid_90;Mastit;Travma;Oxota;Time_end;Fors;Section;Exhaust";
echo $f_head."<br>";
if ( DaysBetween( $date1, $date2 )>7 ) echo "";
else while ( $yc<=$yl+1 ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	$yc1=$yc*10000; $mc1=$mc*100;
	if ( $yc1+$mc1<=$yl1+$ml1 ) { for ( $i_s=1; $i_s<=3; $i_s++ ) {
		$sess=$i_s*10;
		if ( $date1==$date2 ) {
			if ( $sess==10 ) $end="d";
			elseif ( $sess==20 ) $end="w";
			elseif ( $sess==30 ) $end="u";
			$f=fopen( "../data/export/d".$df.$mf.substr( $yf, 2, 2 ).$end.".txt", "w+" );
			fputs( $f, $f_head.chr( 10 ));
		}
		$query="SELECT
		 d.cow_id,
		 d.day, d.month, d.year,
		 d.milk_kg,
		 d.milk_begin, d.milk_end,
		 d.milk_time,
		 d.id_time, d.rep_time,
		 d.manual, d.retries, d.stopped, d.exhaust,
		 d.mast_4, d.tr, d.ov,
		 d.bd_num,
		 c.cow_num, c.nick,
		 $lots.nick,
		 $groups.nick,
		 c.id, d.kg_30s, d.kg_60s, d.kg_90s, d.str_res, d.gr_id, c.gr_id, d.lot_id, c.lot_id";
		$query=$query."
		 FROM $dbt d, $cows c, $lots, $groups
		 WHERE c.id=d.cow_id AND $lots.id=d.lot_id AND $groups.id=d.gr_id AND d.milk_sess=$sess
		 ORDER BY d.code";
		$res=mysql_query( $query, $db ); $sqlerr=mysql_errno();
		if ( $sqlerr==0 ) { while ( $row=mysql_fetch_row( $res )) {
			$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;
			if ( $odt>$yl1+$ml1+$dl );
			else if ( $odt<$yf1+$mf1+$df );
			else {
//				$bd=$row[17]*1;
//				$cowid=$row[0]*1;
				$dd=$row[1]; $mm=$row[2]; $yyyy=$row[3];
				$m=$row[4]*1;
				$mbeg=$row[5]; $mend=$row[6];
				$mtime=$row[7];
//				$idtime=$row[8]; $reptime=$row[9];
				$manual=$C[$row[10]*1];
//				$retries=$row[11]; if ( $retries*1==0 ) $retries="";
				$stopped=$C[$row[12]*1];
				$exhaust=$C[$row[13]*1];
				$mastit=$C[0];
				if ( $row[14]*1>=0 & $row[14]<5555 ) $mastit=$row[14];
				if ( $row[14]*1==5555 ) $mastit=$C[1];
				$tr=$C[$row[15]*1];
				$ov=$C[$row[16]*1];
				if ( trim( $stat )=="," ) $stat="";
				$cownum=$cownum_div.$row[18].$cownum_div1;
				$cownick=$row[19];
				$lotnick=$row[20];
				$grnick=$row[21];
				$m1=$row[23]*1; $m2=$row[24]*1; $m3=$row[25]*1;
				$rfid_res=$row[26];
				$grcode=$row[27];
				if ( $grnick=="---" ) {
					$grnick=$grnick_prv[$row[28]];
					$grcode=$row[28];
				}
				$lotcode=$row[29];
				if ( $lotnick=="--" ) {
					$lotnick=$lotnick_prv[$row[30]];
					$lotcode=$row[30];
				}
				if ( $mastit=="+" ) $mastit="1"; else $mastit="0";
				if ( $tr=="+" ) $tr="1"; else $tr="0";
				if ( $ov=="+" ) $ov="1"; else $ov="0";
				if ( $manual=="+" ) $manual="1"; else $manual="0";
				if ( $exhaust=="+" ) $exhaust="1"; else $exhaust="0";
				$x=explode( ".", $m ); if ( $x[1]."."=="." ) $m=$m."."."0";
				$x=explode( ".", $m1 ); if ( $x[1]."."=="." ) $m1=$m1."."."0";
				$x=explode( ".", $m2 ); if ( $x[1]."."=="." ) $m2=$m2."."."0";
				$x=explode( ".", $m3 ); if ( $x[1]."."=="." ) $m3=$m3."."."0";
				$x="$dd.$mm.$yyyy;$cownick;".$row[18].";2;4;".str_replace( ".", ",", $m ).";".str_replace( ":", ",", $mtime ).";".str_replace( ".", ",", $m1 ).";".str_replace( ".", ",", $m2 ).";".str_replace( ".", ",", $m3 ).";$mastit;$tr;$ov;$mend;$manual;$lotnick:$grnick;$exhaust";
				echo $x."<br>";
				if ( $date1==$date2 ) fputs( $f, Iconv_1251_866( $x ).chr( 10 ));
			}
		} mysql_free_result( $res ); }
	}
	if ( $date1==$date2 ) fclose( $f );
	}
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++; }
}

ob_end_flush();
?>
