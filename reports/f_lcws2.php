<?php
/* DF_2: reports/f_lcws2.php
report: cows quantity by age & state
c: 27.02.2007
m: 14.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

include( "f_jfilt.php" );

$th1="&nbsp;";
$th2=$ged["TOTAL"];
$th3=$ged["[C18]"];
$th4=$ged["[C16]"];
$th5=$ged["[C13]"];
$th6=$ged["[C12]"];

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1):before { content:\"\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th2."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th3."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(4):before { content:\"".$th4."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(5):before { content:\"".$th5."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(6):before { content:\"".$th6."\"; text-align:left; top:0; }";

include( "frhead.php" );

$sele_byAge=$_GET["sele_byAge"]; $temp=split( ":", $sele_byAge ); $sele_byAge_from=$temp[0]; $sele_byAge_to=$temp[1];
$sele_byState=$_GET["sele_byState"];
$cows_order_=$_GET["order_by"];
if ( strlen( $cows_order_ )<1 ) $cows_order_="$cows.cow_num*1";

echo "
<table>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th><b>".$th1."</b></td>
	<th><b>".$th2."</b></td>
	<th><b>".$th3."</b></td>
	<th><b>".$th4."</b></td>
	<th><b>".$th5."</b></td>
	<th><b>".$th6."</b></td>
</tr>
</thead>
<tbody id='rep_tbody'>";

$dbt="000000_o";
$sql_query="SELECT
 $dbt.cow_id,
 $dbt.day, $dbt.month, $dbt.year,
 $dbt.int_7,
 $dbt.oper_id,
 $dbt.code
 FROM $dbt
 WHERE oper_id>=128 AND oper_id<=2048
 ORDER BY $dbt.year*10000+$dbt.month*100+$dbt.day+$dbt.code/100000000 DESC";
$res=mysql_query( $sql_query, $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) { while ( $row=mysql_fetch_row( $res )) {
	$r=$row[0];
	$oid=$row[5]*1;
	$odmY=$row[1].".".$row[2].".".$row[3];
	if ( $cwoid[$r]==0 ) {
		$cwoid[$r]=$oid;
		if ( $oid==256 ) $cwoid[$r]=128;
		if ( $oid==512 & $row[4]*1<>4 ) $cwoid[$r]=128;
		if ( $oid==2048 ) {
			if ( DaysBetween( $odmY, $now_dmY )*1>=91+17 ) $cwoid[$r]=2048;
			else $cwoid[$r]=2049;
		}
	}
} mysql_free_result( $res ); }
$sql_query="SELECT
 $cows.cow_num,
 $cows.nick,
 $cows.national_descr,
 $cows.b_num,
 $cows.b_date,
 $cows.id
 FROM $cows";
$res=mysql_query( $sql_query, $db );
while ( $row=mysql_fetch_row( $res )) {
	$r=$row[5];
	$cwbddmY=substr( $row[4], 8, 2 ).".".substr( $row[4], 5, 2 ).".".substr( $row[4], 0, 4 );
	$cwage=DaysBetween( $cwbddmY, $now_dmY );
	if ( $cwage<7 ) $a0++;
	else if ( $cwage<14 ) $a1++;
	else if ( $cwage<183 ) $a2++;
	else if ( $cwage<365 ) $a3++;
	else if ( $cwage<730 ) $a4++;
	else if ( $cwage<1460 ) $a5++;
	else {
		if ( $cwage>3650 ) $a7++;
		else if ( $cwage>=1460 ) $a6++;
	}
	if ( $cwoid[$r]==128 ) {
		if ( $cwage<7 ) $b0++;
		else if ( $cwage<14 ) $b1++;
		else if ( $cwage<183 ) $b2++;
		else if ( $cwage<365 ) $b3++;
		else if ( $cwage<730 ) $b4++;
		else if ( $cwage<1460 ) $b5++;
		else {
			if ( $cwage>3650 ) $b7++;
			else if ( $cwage>=1460 ) $b6++;
		}
		$b99++;
	} else if ( $cwoid[$r]==512 ) {
		if ( $cwage<7 ) $c0++;
		else if ( $cwage<14 ) $c1++;
		else if ( $cwage<183 ) $c2++;
		else if ( $cwage<365 ) $c3++;
		else if ( $cwage<730 ) $c4++;
		else if ( $cwage<1460 ) $c5++;
		else {
			if ( $cwage>3650 ) $c7++;
			else if ( $cwage>=1460 ) $c6++;
		}
		$c99++;
	} else if ( $cwoid[$r]==2048 ) {
		if ( $cwage<7 ) $d0++;
		else if ( $cwage<14 ) $d1++;
		else if ( $cwage<183 ) $d2++;
		else if ( $cwage<365 ) $d3++;
		else if ( $cwage<730 ) $d4++;
		else if ( $cwage<1460 ) $d5++;
		else {
			if ( $cwage>3650 ) $d7++;
			else if ( $cwage>=1460 ) $d6++;
		}
		$d99++;
	} else if ( $cwoid[$r]==2049 ) {
		if ( $cwage<7 ) $e0++;
		else if ( $cwage<14 ) $e1++;
		else if ( $cwage<183 ) $e2++;
		else if ( $cwage<365 ) $e3++;
		else if ( $cwage<730 ) $e4++;
		else if ( $cwage<1460 ) $e5++;
		else {
			if ( $cwage>3650 ) $e7++;
			else if ( $cwage>=1460 ) $e6++;
		}
		$e99++;
	}
	$a99++;
}

if ( $a0==0 ) $a0="&nbsp;";
if ( $a1==0 ) $a1="&nbsp;";
if ( $a2==0 ) $a2="&nbsp;";
if ( $a3==0 ) $a3="&nbsp;";
if ( $a4==0 ) $a4="&nbsp;";
if ( $a5==0 ) $a5="&nbsp;";
if ( $a6==0 ) $a6="&nbsp;";
if ( $a7==0 ) $a7="&nbsp;";
if ( $a99==0 ) $a99="&nbsp;";

if ( $b0==0 ) $b0="&nbsp;";
if ( $b1==0 ) $b1="&nbsp;";
if ( $b2==0 ) $b2="&nbsp;";
if ( $b3==0 ) $b3="&nbsp;";
if ( $b4==0 ) $b4="&nbsp;";
if ( $b5==0 ) $b5="&nbsp;";
if ( $b6==0 ) $b6="&nbsp;";
if ( $b7==0 ) $b7="&nbsp;";
if ( $b99==0 ) $b99="&nbsp;";

if ( $c0==0 ) $c0="&nbsp;";
if ( $c1==0 ) $c1="&nbsp;";
if ( $c2==0 ) $c2="&nbsp;";
if ( $c3==0 ) $c3="&nbsp;";
if ( $c4==0 ) $c4="&nbsp;";
if ( $c5==0 ) $c5="&nbsp;";
if ( $c6==0 ) $c6="&nbsp;";
if ( $c7==0 ) $c7="&nbsp;";
if ( $c99==0 ) $c99="&nbsp;";

if ( $d0==0 ) $d0="&nbsp;";
if ( $d1==0 ) $d1="&nbsp;";
if ( $d2==0 ) $d2="&nbsp;";
if ( $d3==0 ) $d3="&nbsp;";
if ( $d4==0 ) $d4="&nbsp;";
if ( $d5==0 ) $d5="&nbsp;";
if ( $d6==0 ) $d6="&nbsp;";
if ( $d7==0 ) $d7="&nbsp;";
if ( $d99==0 ) $d99="&nbsp;";

if ( $e0==0 ) $e0="&nbsp;";
if ( $e1==0 ) $e1="&nbsp;";
if ( $e2==0 ) $e2="&nbsp;";
if ( $e3==0 ) $e3="&nbsp;";
if ( $e4==0 ) $e4="&nbsp;";
if ( $e5==0 ) $e5="&nbsp;";
if ( $e6==0 ) $e6="&nbsp;";
if ( $e7==0 ) $e7="&nbsp;";
if ( $e99==0 ) $e99="&nbsp;";

echo "
<tr $cjust>
	<td $ljust>".$ged["[C 1]"]."</td>
	<td>$a0</td>
	<td>$b0</td>
	<td>$c0</td>
	<td>X</td>
	<td>X</td>
</tr>
<tr $cjust>
	<td $ljust>".$ged["[C 2]"]."</td>
	<td>$a1</td>
	<td>$b1</td>
	<td>$c1</td>
	<td>X</td>
	<td>X</td>
</tr>
<tr $cjust>
	<td $ljust>".$ged["[C 3]"]."</td>
	<td>$a2</td>
	<td>$b2</td>
	<td>$c2</td>
	<td>X</td>
	<td>X</td>
</tr>
<tr $cjust>
	<td $ljust>".$ged["[C 4]"]."</td>
	<td>$a3</td>
	<td>$b3</td>
	<td>$c3</td>
	<td>X</td>
	<td>X</td>
</tr>
<tr $cjust>
	<td $ljust>".$ged["[C 5]"]."</td>
	<td>$a4</td>
	<td>$b4 0</td>
	<td>$c4</td>
	<td>$d4</td>
	<td>$e4</td>
</tr>
<tr $cjust>
	<td $ljust>".$ged["[C 6]"]."</td>
	<td>$a5</td>
	<td>$b5</td>
	<td>$c5</td>
	<td>$d5</td>
	<td>$e5</td>
</tr>
<tr $cjust>
	<td $ljust>".$ged["[C 7]"]."</td>
	<td>$a6</td>
	<td>$b6</td>
	<td>$c6</td>
	<td>$d6</td>
	<td>$e6</td>
</tr>
<tr $cjust>
	<td $ljust>".$ged["[C 8]"]."</td>
	<td>$a7</td>
	<td>$b7</td>
	<td>$c7</td>
	<td>$d7</td>
	<td>$e7</td>
</tr>
</tbody>
<tfoot id='rep_tfoot'>
<tr $rjust height='28px'>
	<td><b>".$ged["TOTAL"].":</b></td>
	<td><b>$a99</b></td>
	<td><b>$b99</b></td>
	<td><b>$c99</b></td>
	<td><b>$d99</b></td>
	<td><b>$e99</b></td>
</tr>
<tr $rjust>
	<td>".$ged["[C11]"]."</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</tfoot>
</table><br>";

ob_end_flush();
?>
