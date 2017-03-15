<?php
/* DF_2: reports/f_tdprep.php
report: operations to do
c: 23.11.2007
m: 14.03.2017 */

ob_start();//lock output to set cookies properly!

$title_=$title=$_GET["title"];
if ( strlen( $title_ )<=1 ) $title_=$php_mm["_00_todo_btn_tip"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );
include( "frhead.php" );

$i=0; $t_sec=0; $cows_cnt=0;

$yc=1991; $yl=2037;

$query="SELECT descr, id FROM $states"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $stan[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT descr, id FROM $results"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $result[$row[1]]=$row[0];
mysql_free_result( $res );

$dbt="000000_o";
include( "f_jselo.php" );
if ( $error==0 ) { while ( $row=mysql_fetch_row( $res )) {
	$cowid=$row[0]*1;
	$ocode=$row[22]*1;
	$oid=$row[18]*1;
	$odd=$row[1]; $omm=$row[2]; $oyyyy=$row[3];
	$odt=$oyyyy*10000+$omm*100+$odd; $odate=$odd.".".$omm.".".$oyyyy;
	$depid=0; if ( $oid==64 ) $depid=$row[14];
	if ( $oid==512 ) $cowst512[$cowid]=$row[13]*1;
	if ( $oid==2048 ) $cowst2048[$cowid]=$cowst2048[$cowid]+1;
//	echo "current: o_cow:$cowid o_dt:$odt o_date:$odate o_id:$oid o_code:$ocode<br>";
	if ( $cowst_dt[$cowid]*1==0 ) {
//		echo "last: o_cow:$cowid o_dt:$odt o_date:$odate o_id:$oid o_code:$ocode<br>";
		$cowst[$cowid]=$oid;
		$cowst_dt[$cowid]=$odt;
		$cowst_date[$cowid]=$odate;
	} else if ( $cowst_dt[$cowid]*1<$odt & $oid>=128 ) {
//		echo "last: o_cow:$cowid o_dt:$odt o_date:$odate o_id:$oid o_code:$ocode<br>";
		$cowst[$cowid]=$oid;
		$cowst_dt[$cowid]=$odt;
		$cowst_date[$cowid]=$odate;
	}
//	echo "$oid $odt :".$row[4].".<br>";
} mysql_free_result( $res ); } else {
	$error=$error.mysql_error();
}
?>
