<?php
/* DF_2: reports/f_jerr.php
report: error for any report
c: 13.03.2007
m: 08.07.2015 */

if ( $error<>0 ) {
	$error=$sqlerr=$error.": ".mysql_error();
	echo "$query<br>$dbt : $error<br>";
}
?>
