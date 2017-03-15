<?php
include( "../dflib/f_filt1.php" );

$row_pre=""; $row_pre2="";
if ( $dontuse_filt==0 ) {
	if ( $filts1>-1 ) {
		$restrict_by_field1=1;
		$restrict_field1="d.gr_id";
		$restrict_id1=$filts1;
		$query_pre="SELECT nick FROM $groups WHERE id=$filts1";
		$res_pre=mysql_query( $query_pre, $db );
		$row_pre=mysql_fetch_row( $res_pre );
		$row_pre2="&nbsp;[".$php_mm["_11_filt_"]."&nbsp;".$row_pre[0]."]";
		$row_pre="&nbsp;<font color='#000000'>[</font><font color='#001199'>".$php_mm["_11_filt_"]."</font>&nbsp;<font color='#009955'>".$row_pre[0]."<font color='#000000'>]</font>";
	}
	if ( $filts2>-1 ) {
		$restrict_by_field1=1;
		$restrict_field1="d.lot_id";
		$restrict_id1=$filts2;
		$query_pre="SELECT nick FROM $lots WHERE id=$filts2";
		$res_pre=mysql_query( $query_pre, $db );
		$row_pre=mysql_fetch_row( $res_pre );
		$row_pre2="&nbsp;[".$php_mm["_11_filt_"]."&nbsp;".$row_pre[0]."]";
		$row_pre="&nbsp;<font color='#000000'>[</font><font color='#001199'>".$php_mm["_11_filt_"]."</font>&nbsp;<font color='#009955'>".$row_pre[0]."<font color='#000000'>]</font>";
	}
}

$title__=$title_.$row_pre;
$title_=$title_.$row_pre2;
?>
