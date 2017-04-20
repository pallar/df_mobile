<?php
/* DF_2: exp_imp/f_i000.php
import: all data from DF_1 '2009.08.01' export format
c: 14.03.2011
m: 20.04.2017 */

//import DairyF-1 SQL data from file
function DairyF1_SQL_Data__Import( $db, $fname, $fcp, $fcp_iconv, $fcp_recode, $ext, $t_errs ) {
	if ( file_exists( $fname )) {
		$row=file( $fname );
		$i_rows=count( $row );
		$i_errs=0;
		for ( $i=0; $i<count( $row ); $i++ ) {
			$row1=trim( $row[$i] );
			if ( $ext=="iconv" )
				$query1=iconv( "$fcp_iconv", "UTF-8", $row1 );
			elseif ( $ext=="recode" )
				$query1=recode_string( "$fcp_recode..utf-8", $row1 );
			else {
				$query1=$row1;
				mysql_query( "SET CHARACTER SET $fcp", $db );
				mysql_query( "SET NAMES $fcp", $db );
			}
			mysql_query( $query1, $db );
			$sqlerr=mysql_errno();
			if ( $sqlerr<>0 ) {
				$sqlerr=$sqlerr.": ".mysql_error();
				$i_errs++;
				$t_errs++;
echo "$query1<br>";
echo "$sqlerr<br>";
			} else {
				if ( substr( $query1, 0, 6 )=="INSERT" ) {
//echo "$query1<br>";
//echo "RECORD IS ADDED<br>";
				} else {
//echo "RECORD IS UPDATED<br>";
				}
			}
		}
	}
	if ( $i_errs==0 ) $i_errs=""; else echo "<br>";
	echo "
<table width='50%' border='1em'>
<tr>
	<td colspan='2'>&nbsp;<b>TOTAL STATS</b>:</td>
</tr>
<tr>
	<td width='50%'>&nbsp;errors:</td><td align='right'><font color='red'><b>$t_errs</b></font>&nbsp;</td>
</tr>
<tr>
	<td colspan='2'>&nbsp;<b>FILE STATS</b>:</td>
</tr>
<tr>
	<td width='50%'>&nbsp;queries:</td><td align='right'><b>$i_rows</b>&nbsp;</td>
</tr>
<tr>
	<td width='50%'>&nbsp;errors:</td><td align='right'><font color='red'><b>$i_errs</b></font>&nbsp;</td>
</tr>
</table>";
	setcookie( "t_errs", $t_errs, 0, "/" );
}

echo "importing format:&nbsp;";
echo "<b>MySQL queries</b><br>";
echo "disabled PHP recoding extension(s):&nbsp;";

$PMA_recoding_engine='MySQL SET CHARSET + SET NAMES';
$disable_all_PHP_recode_exts=1;

if ( $disable_all_PHP_recode_exts==1 ) {
	$recoding_engine[recode]='-';
	$recoding_engine[iconv]='-';
} else {
	if ( !@extension_loaded( 'recode' )) {
//echo "recode<br>";
		$recoding_engine[recode]='-';
	}
//echo "iconv";
	if ( !@extension_loaded( 'iconv' )) {
		$recoding_engine[iconv]='-';
	}
}
if ( $recoding_engine[recode]=="-" & $recoding_engine[iconv]=="-" ) {
	$disabled_recoding_engines="'<b>recode</b>', '<b>iconv</b>'";
} elseif ( $recoding_engine[iconv]!="-" ) {
	$PMA_recoding_engine="iconv";
	$disabled_recoding_engines="'<b>recode</b>'";
} elseif ( $recoding_engine[recode]!="-" ) {
	$PMA_recoding_engine="recode";
	$disabled_recoding_engines="'<b>iconv</b>'";
}
echo $disabled_recoding_engines."<br>";
echo "used recoding method:&nbsp;";
echo "<b>".$PMA_recoding_engine."</b><br>";

$fname="../data/import/".$fname;
echo "importing file:&nbsp;";
echo "'<b>$fname</b>'...<br><br>";
$t_errs=$HTTP_COOKIE_VARS["t_errs"];
$t_errs_php5=$_COOKIE["t_errs"];
if ( strlen( $t_errs_php5 )>strlen( $t_errs )) $t_errs=$t_errs_php5;
DairyF1_SQL_Data__Import( $db, $fname, $fcp, $fcp_iconv, $fcp_recode, $PMA_recoding_engine, $t_errs );//$PMA_recoding_engine );//DF-1 export file name with full path
?>
