<?php
/* DF_2: reports/f_jper.php
report: print period in any report
c: 20.02.2007
m: 20.07.2015 */

if ( $dontuse_period==0 ) echo "
	<td $rjust width='50px'><a onclick='Per_FromCoo(); Period_Show(); return false'><u>$beg1</u>&nbsp;..&nbsp;<u>$end1</u>,&nbsp;".$php_mm["_com_rephd2_"]."&nbsp;$now_dmY</td>";
else {
	if ( $dontuse_period==1 ) echo "
	<td $rjust width='50px'>".$php_mm["_com_rephd2_"]."&nbsp;$now_dmY</td>";
	else echo "
	<td $rjust width='50px'><u>$beg1</u>&nbsp;..&nbsp;<u>$end1</u>,&nbsp;".$php_mm["_com_rephd2_"]."&nbsp;$now_dmY</td>";
}
?>
