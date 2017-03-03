<?php
/* DF_2: dflib/f_librep.php
reports common functions
c: 21.08.2006
m: 01.04.2015 */

function GrTrCol() {
	global $rownum;
	$rownum=1-$rownum;
	if ( $rownum==0 ) $bgcol="#fbfbfb"; else $bgcol="#eeeeee";
	return $bgcol;
}

function GrTr() {
	$bgcol=GrTrCol();
	echo "
<tr bgcolor='$bgcol'>";
	return $bgcol;
}

function RepTrCol() {
	global $rownum;
	$rownum=1-$rownum;
	if ( $rownum==0 ) $bgcol="ffffff"; else $bgcol="f9fdf9";
	return $bgcol;
}

function RepTr() {
	$bgcol=RepTrCol();
	echo "
<tr bgcolor='$bgcol'>";
	return $bgcol;
}

function RepTr1( $rownum, $just ) {
	$bgcol=RepTrCol();
	echo "
<tr $just bgcolor='$bgcol'>";
	return $bgcol;
}
?>
