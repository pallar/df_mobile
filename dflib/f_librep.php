<?php
/* DF_2: dflib/f_librep.php
reports common functions
c: 21.08.2006
m: 30.03.2017 */

function GrTrCol() {
	global $__rownum;
	$__rownum=1-$__rownum;
	if ( $__rownum==0 ) $__bgcol="#fbfbfb"; else $__bgcol="#eeeeee";
	return "bgcolor='".$__bgcol."'";
}

function RepTrCol() {
	global $rownum;
	$rownum=1-$rownum;
	if ( $rownum==0 ) $bgcol="ffffff"; else $bgcol="f9fdf9";
	return $bgcol;
}
?>
