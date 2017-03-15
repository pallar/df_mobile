<?php
/* DF_2: reports/f_jselo.php
report: input select for any operation report
c: 20.02.2007
m: 08.07.2015 */

$query="SELECT
 $dbt.cow_id,
 $dbt.day, $dbt.month, $dbt.year,
 $cows.cow_num, $cows.nick,
 $operstyp.descr,
 $dbt.int_1, $dbt.int_2, $dbt.int_3, $dbt.int_4, $dbt.int_5, $dbt.int_6,
 $dbt.int_7, $dbt.int_8,
 $dbt.`data_1:4`, $dbt.`data_5:8`,
 $dbt.comments,
 $dbt.oper_id,
 $dbt.created_date, $dbt.modif_uid, $dbt.modif_date,
 $dbt.code,
 $dbt.created_time, $dbt.modif_time
 FROM $dbt, $cows, $operstyp
 WHERE $cows.id=$dbt.cow_id AND $operstyp.id=$dbt.oper_id";
if ( $outsele_*1==24 ) $query=$query." AND $dbt.oper_id=8 OR $dbt.oper_id=16";
else if ( $outsele_*1!=-1 ) $query=$query." AND $dbt.oper_id=$outsele_";
$list="( ";
if ( $outsele1*1!=-1 ) $list=$list.$outsele1;
if ( $outsele2*1!=-1 ) $list=$list.", ".$outsele2;
if ( $outsele3*1!=-1 ) $list=$list.", ".$outsele3;
if ( $outsele4*1!=-1 ) $list=$list.", ".$outsele4;
if ( $outsele5*1!=-1 ) $list=$list.", ".$outsele5;
if ( $outsele6*1!=-1 ) $list=$list.", ".$outsele6;
if ( $outsele7*1!=-1 ) $list=$list.", ".$outsele7;
if ( $outsele8*1!=-1 ) $list=$list.", ".$outsele8;
if ( trim( $list )!="(" ) {
	$list=$list." )";
	$query=$query." AND $dbt.oper_id IN $list";
}
if ( $filt_cowid*1>0 ) $query=$query." AND $dbt.cow_id=$filt_cowid";
if ( $query_descending!=-1 ) $query=$query."
 ORDER BY $dbt.year*10000+$dbt.month*100+$dbt.day+$dbt.code/100000000 DESC";
else
 $query=$query."
 ORDER BY $dbt.year*10000+$dbt.month*100+$dbt.day+$dbt.code/100000000";
$res=mysql_query( $query, $db ); $error=$sqlerr=mysql_errno();
?>
