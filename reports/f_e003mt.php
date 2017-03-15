<?php
/* DF_2: reports/f_e003mt.php
report: dairy by table
c: 14.03.2011
m: 13.03.2017 */

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

$restrict_field=$_GET["select_field"];

$outsele__=$outsele_;//ERROR!!!
$outsele_field__=$outsele_field_;//ERROR!!!

include( "f_jfilt.php" );

if ( $title_==$ged['RR2102'] ) $title_next=$ged['RR2102-'];
if ( $title_==$ged['RR2103'] ) $title_next=$ged['RR2103-'];
if ( $title_==$ged['RR2103.A'] ) $title_next=$ged['RR2103.A-'];
if ( $title_==$ged['RR2104'] ) $title_next=$ged['RR2104-'];
if ( $title_==$ged['RR0301'] ) $title_next=$ged['RR0301-'];

$outsele_=$outsele__;//ERROR!!!
$outsele_field_=$outsele_field__;//ERROR!!!

$mtotal=0; $mtotal_mast=0; $idtotal=0; $dots_cnt=0;
$repbeg=$yf*100+$mf+$df/100; $repend=$yl*100+$ml+$dl/100;

if ( $outsele_*1==-1 ) $db_id=0; else $db_id=21;

$cws_cnt=0;

if ( $outsele_*1==-1 ) $res1=mysql_query( "SELECT id, cow_num, nick FROM $cows ORDER BY cow_num*1", $db );
else $res1=mysql_query( "SELECT id, num, nick FROM $outsele_table ORDER BY nick", $db );
$error=mysql_errno();
if ( $error==0 ) { while ( $row=mysql_fetch_row( $res1 )) {
	$cws_cnt++;
	$cws_s[$cws_cnt]=$row[1]*1;//sorted
	$cws_ns[$row[0]*1]=$cws_cnt;//not sorted
}}

if ( $graph<1 ) {
	echo "
Номер корови;Надій,кг;;;<br>";
}

$yc_prv=$yc;
$mc_prv=$mc;
$dc_prv=$dc;

while ( $yc<=$yl+1 ) {
	$dbt=Int2StrZ( $yc, 4 ).Int2StrZ( $mc, 2 )."_m";
	if ( $yc*100+$mc<=$yl*100+$ml ) {
		include( "f_jselm.php" );//DONT TOUCH THIS INCLUDE
		if ( $error==0 ) { while ( $row=mysql_fetch_row( $res )) {//cut errors
			$dc=$row[1]*1;//operation's day
			$odt=$yc*100+$mc+$dc/100;//operation's date
			$odtt=$yc+"-"+$mc+"-"+$dc;
			if ( $odt>$repend | $odt<$repbeg );
			else {//operation's in period, thats calc
				$idx=$cws_ns[$row[0]*1];
				$m=$row[4]*1;//operations's milk
				$mm=$mcws[$idx][$odtt];
				$mcws[$idx][$odtt]=$mm+$m;
			}
		} mysql_free_result( $res );}//else echo $error.": ".mysql_error()."<br>";
	}
	if ( $mc<12 ) $mc++; else { $mc=1; $yc++;}
}

$yc=$yc_prv;
$mc=$mc_prv;
$dc=$dc_prv;

while ( $yc<=$yl+1 ) {
	$odt=$yc*100+$mc+$dc/100;//operation's date
	$odtt=$yc+"-"+$mc+"-"+$dc;
	$day_ready[$odtt]=0;
	if ( $yc*100+$mc<=$yl*100+$ml ) {
		if ( $odt>$repend | $odt<$repbeg );
		else {
			for ( $k=1; $k<$cws_cnt; $k++ )
				if ( $mcws[$k][$odtt]>0 ) {
					$mcws1=str_replace( ".", ",", $mcws[$k][$odtt] );
					$num=$cws_s[$k];
					if ( $day_ready[$odtt]==0 ) {
						$dcc=$dc; if ( $dc<=9 ) $dcc="0".$dc;
						$mcc=$mc; if ( $mc<=9 ) $mcc="0".$mc;
						$ycc=substr( $yc, 2, 2 );
						echo "
$dcc.$mcc.$ycc;;;;<br>";
						$day_ready[$odtt]=1;
					}
					echo "
$num;$mcws1;;;<br>";
				}
		}
	}
	if ( $dc<31 ) $dc++;
	else {
		if ( $mc<12 ) $mc++; else { $mc=1; $dc=1; $yc++;}
	}
}

ob_end_flush();
?>
