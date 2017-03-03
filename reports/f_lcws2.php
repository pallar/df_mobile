<?php
/*
DF_2: reports/f_lcws2.php
report: cows quantity by age & state
created: 27.02.2007
modified: 12.09.2014
*/

ob_start();//lock output to set cookies properly!

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

$title_=$_GET[title];

include( "f_jfilt.php" );
include( "frhead.php" );

$_GET[sele_byAge]; $temp=split( ":", $sele_byAge ); $sele_byAge_from=$temp[0]; $sele_byAge_to=$temp[1];
$_GET[sele_byState]; $sele_byState_=$sele_byState;
$_GET[order_by]; $cows_order_=$order_by;
if ( strlen( $cows_order_ )<=0 ) $cows_order_="$cows.cow_num*1";

echo "
<table class='st2'>
<tr $cjust class='st_title2' style='height:28px'>
	<td><b>&nbsp;</b></td>
	<td><b>".$ged["TOTAL"]."</b></td>
	<td><b>".$ged["[C18]~"]."</b></td>
	<td><b>".$ged["[C16]~"]."</b></td>
	<td><b>".$ged["[C13]~"]."</b></td>
<!--
	<td><b>".$ged["[C12]~"]."</b></td>
-->
</tr>";

$dbt="000000_o";
$sqlquery="SELECT
 $dbt.cow_id,
 $dbt.day, $dbt.month, $dbt.year,
 $dbt.int_7,
 $dbt.oper_id,
 $dbt.code
 FROM $dbt
 WHERE oper_id>=128 AND oper_id<=2048
 ORDER BY $dbt.year*10000+$dbt.month*100+$dbt.day+$dbt.code/100000000 DESC";
$res=mysql_query( $sqlquery, $db );
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

RepTr( 1 );
echo "
	<td>".$ged["[C 1]"]."</td>
	<td $cjust>$a0</td>
	<td $cjust>$b0</td>
	<td $cjust>$c0</td>
	<td $cjust>X</td>
<!--
	<td $cjust>$e0</td>-->
</tr>";
RepTr( 0 );
echo "
	<td>".$ged["[C 2]"]."</td>
	<td $cjust>$a1</td>
	<td $cjust>$b1</td>
	<td $cjust>$c1</td>
	<td $cjust>X</td>
<!--
	<td $cjust>$e1</td>-->
</tr>";
RepTr( 1 );
echo "
	<td>".$ged["[C 3]"]."</td>
	<td $cjust>$a2</td>
	<td $cjust>$b2</td>
	<td $cjust>$c2</td>
	<td $cjust>X</td>
<!--
	<td $cjust>$e2</td>-->
</tr>";
RepTr( 0 );
echo "
	<td>".$ged["[C 4]"]."</td>
	<td $cjust>$a3</td>
	<td $cjust>$b3</td>
	<td $cjust>$c3</td>
	<td $cjust>X</td>
<!--
	<td $cjust>$e3</td>-->
</tr>";
RepTr( 1 );
echo "
	<td>".$ged["[C 5]"]."</td>
	<td $cjust>$a4</td>
	<td $cjust>$b4</td>
	<td $cjust>$c4</td>
	<td $cjust>$d4</td>
<!--
	<td $cjust>$e4</td>-->
</tr>";
RepTr( 0 );
echo "
	<td>".$ged["[C 6]"]."</td>
	<td $cjust>$a5</td>
	<td $cjust>$b5</td>
	<td $cjust>$c5</td>
	<td $cjust>$d5</td>
<!--
	<td $cjust>$e5</td>-->
</tr>";
RepTr( 1 );
echo "
	<td>".$ged["[C 7]"]."</td>
	<td $cjust>$a6</td>
	<td $cjust>$b6</td>
	<td $cjust>$c6</td>
	<td $cjust>$d6</td>
<!--
	<td $cjust>$e6</td>-->
</tr>";
RepTr( 0 );
echo "
	<td>".$ged["[C 8]"]."</td>
	<td $cjust>$a7</td>
	<td $cjust>$b7</td>
	<td $cjust>$c7</td>
	<td $cjust>$d7</td>
<!--
	<td $cjust>$e7</td>-->
</tr>";
echo "
<tr class='st_title2' style='height:28px'>
	<td><b>".$ged["TOTAL"].":</b></td>
	<td $cjust><b>$a99</b></td>
	<td $cjust><b>$b99</b></td>
	<td $cjust><b>$c99</b></td>
	<td $cjust><b>$d99</b></td>
<!--
	<td $cjust><b>$e99</b></td>-->
</tr>";
RepTr( 1 );
echo "
	<td>".$ged["[C11]"]."</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
<!--
	<td></td>-->
</tr>
</table><br>";

mysql_free_result( $res );
ob_end_flush();//unlock output to set cookies properly!
?>
