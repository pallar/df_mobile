<?php
/* DF_2: dflib/f_perset.php
put period to database
c: 01.02.2006
m: 25.08.2015 */

$uuid=$userCoo;
if ( $uuid<1 ) return;
$dt1=CookieGet( "_dt1" ); $dt1_db=PeriodBeg_FromDb( $uuid, $vars );
$dt2=CookieGet( "_dt2" ); $dt2_db=PeriodEnd_FromDb( $uuid, $vars );
$dt1=substr( $dt1, 0, 4 )."-".substr( $dt1, 5, 2 )."-".substr( $dt1, 8, 2 );
$dt2=substr( $dt2, 0, 4 )."-".substr( $dt2, 5, 2 )."-".substr( $dt2, 8, 2 );
//echo "perset.php | $dt1 | $dt1_db |<br>";
//echo "perset.php | $dt2 | $dt2_db |<br>";
if ( strlen( $dt1 )<strlen( $dt1_db ) | strlen( $dt2 )<strlen( $dt2_db )) {
	$dt1=$dt1_db; CookieSet( "_dt1", $dt1 );
	$dt2=$dt2_db; CookieSet( "_dt2", $dt2 );
//echo "perset.php | $dt1 | $dt1_db |<br>";
//echo "perset.php | $dt2 | $dt2_db |<br>";
}
if ( strlen( $dt1 )==strlen( $dt1_db ) | strlen( $dt2 )==strlen( $dt2_db )) {
	$local_id=CookieGet( "_id" );
	if ( !empty( $local_id )) {
		Date_ToDb( $uuid, $vars, $local_id.".rep__.fdate", $dt1 );
		Date_ToDb( $uuid, $vars, $local_id.".rep__.ldate", $dt2 );
	}
}
?>
