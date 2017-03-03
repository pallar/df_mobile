<?php
/* DF_2: reports/f_jselm2.php
report: input select for any milk report
c: 20.02.2007
m: 08.07.2015 */

if ( $filts1>-1 ) {
	$restrict_by_field1=1;
	$restrict_field1="d.gr_id";
	$restrict_id1=$filts1;
}
if ( $filts2>-1 ) {
	$restrict_by_field1=1;
	$restrict_field1="d.lot_id";
	$restrict_id1=$filts2;
}

$query="SELECT
 d.cow_id,
 d.day, d.month, d.year,
 d.milk_kg, d.milk_begin, d.milk_end, d.milk_time,
 d.id_time, d.rep_time,
 d.manual, d.retries, d.stopped, d.exhaust,
 d.mast_4, d.tr, d.ov,
 d.bd_num, c.cow_num, c.nick, d.milk_sess, d.r";
if ( $outsele_*1==-1 ) $query=$query.", c.id";
else $query=$query.", ".$outsele_field;
if ( $outsele_*1==-1 ) $query=$query."
 FROM $dbt d, $cows c
 WHERE c.id=d.cow_id";
else $query=$query."
 FROM $dbt d, $cows c, $outsele_table
 WHERE c.id=d.cow_id AND $outsele_field=$outsele_table.id";
if ( $restrict_id*1>0 ) $query=$query." AND d.cow_id=$restrict_id";
if ( $restrict_by_field*1>0 ) $query=$query." AND $restrict_field=$restrict_id";
if ( $restrict_by_field1*1>0 ) $query=$query." AND $restrict_field1=$restrict_id1";
if ( $filt_cowid*1>0 ) $query=$query." AND cow_id=$filt_cowid";
if ( $bd_first*1>0 ) $query=$query." AND bd_num>=$bd_first AND bd_num<=$bd_last";
$query=$query.$WHEREADV."
 ORDER BY d.code";
$res=mysql_query( $query, $db ); $error=$sqlerr=mysql_errno();
?>
