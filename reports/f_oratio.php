<?php
/* DF_2: reports/f_oratio.php
report: herd current quantitative ratio
c: 21.04.2011
m: 15.03.2017 */

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];

$dontuse_period=1;//ONLY IN THIS REPORT
$repfilt__hide=1;//hide filters

include( "f_jfilt.php" );

$th1=$_02_h_["Index"];
$th2=$_02_h_["Value"];
$th3=$_02_h_["Percent"];

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1):before { content:\"".$th1."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th2."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th3."\"; text-align:left; top:0; }";

include( "frhead.php" );

$all=0;
$insem=0;
$insem1=0;
$insem2=0;
$pregn=0;
$pregn1=0;
$pregn2=0;
$pregn3=0;
$pregn4=0;
$npregn=0;
$calvings=0;
$aborts=0;
$others=0;

$qr1="SELECT id, a_dates, b_dates, b_dates_res, c_dates, c_dates_res FROM $cows WHERE z_dates=''";
$res1=mysql_query( $qr1, $db );
while( $row=mysql_fetch_array( $res1 )) {
	$all++;
	if( $row[a_dates]>$row[b_dates] && $row[a_dates]>$row[c_dates] ) {
		$insem++; $cid=$row[id];
		$plus=0;
		$qr="SELECT code, year, month, day FROM 000000_o WHERE cow_id=$cid AND ( oper_id=128 OR oper_id=256 )";
		$res=mysql_query( $qr, $db );
		while( $r=mysql_fetch_row( $res )) {
			$dt=$r[1]."-".$r[2]."-".$r[3];
			if( $dt>=$row[c_dates] ) $plus++;
		}
		if( $plus!=0 && $plus==1 ) $insem1++; elseif( $plus>1 ) $insem2++;
	} elseif( $row[b_dates]>$row[a_dates] && $row[b_dates]>$row[c_dates] && $row[b_dates]!='' ) {
		$cid=$row[id];
		if( $row[b_dates_res]==4 ) {
			$pregn++;
			$plus=0;
			$qr="SELECT code, year, month, day FROM 000000_o WHERE cow_id=$cid AND ( oper_id=128 OR oper_id=256 )";
			$res=mysql_query( $qr, $db );
			while( $r=mysql_fetch_row( $res )) {
				$dt=$r[1]."-".$r[2]."-".$r[3];
				if( $dt<=$row[b_dates] && $dt>=$row[c_dates] ) $plus++;
			}
			if( $plus==1 ) $pregn1++; elseif( $plus==2 ) $pregn2++; elseif( $plus>2 ) $pregn3++; else $pregn4++;
		} else $npregn++;
	} elseif( $row[c_dates]>$row[a_dates] && $row[c_dates]>$row[b_dates] ) {
		if( $row[c_dates_res]==4 ) $calvings++;
		else $aborts++;
	} elseif( $row[c_dates]==$row[a_dates] && $row[c_dates]==$row[b_dates]) {
		$others++;
	}
}
if ( $all>0 ) {
	$p_insem=round( $insem/$all*100, 1);
	$p_insem1=round( $insem1/$all*100, 1); $p_insem2=round( $insem2/$all*100, 1);
	$p_pregn=round( $pregn/$all*100, 1);
	$p_pregn1=round( $pregn1/$all*100, 1); $p_pregn2=round( $pregn2/$all*100, 1); $p_pregn3=round( $pregn3/$all*100, 1); $p_pregn4=round( $pregn4/$all*100, 1);
	$p_npregn=round( $npregn/$all*100, 1);
	$p_calvings=round( $calvings/$all );
	$p_aborts=round( $aborts/$all );
	$p_others=round( $others/$all );
} else {
	$p_insem="-";
	$p_insem1="-"; $p_insem2="-";
	$p_pregn="-";
	$p_pregn1="-"; $p_pregn2="-"; $p_pregn3="-"; $p_pregn4="-";
	$p_npregn="-";
	$p_calvings="-";
	$p_aborts="-";
	$p_others="-";
}

echo "
<table>
<thead id='rep_thead'>
<tr $cjust height='28px'>
	<th $cjust width='50%'><b>".$th1."</b></th>
	<th $cjust width='25%'><b>".$th2."</b></th>
	<th $cjust width='25%'><b>".$th3."</b></th>
</tr>
</thead>
<tbody id='rep_tbody'>";
//RepTr();//inseminated
echo "
<tr $rjust>
	<td><b>".$_02_h_["12"]."</b>:</td>
	<td $cjust><b>$insem</b></td>
	<td $cjust><b>$p_insem</b></td>
</tr>";
//RepTr();//inseminated once
echo "
<tr $rjust>
	<td $rjust>".$_02_h_["12_01"].":<br>".$_02_h_["12_02"].":</td>
	<td $cjust>$insem1<br>$insem2</td>
	<td $cjust>$p_insem1<br>$p_insem2</td>
</tr>";
//RepTr();//pregnant
echo "
<tr $rjust>
	<td><b>".$_02_h_["15"]."</b>:</td>
	<td $cjust><b>$pregn</b></td>
	<td $cjust><b>$p_pregn</b></td>
</tr>";
//RepTr();//pregnant after first insem
echo "
<tr $rjust>
	<td $rjust>".$_02_h_["15_01"].":<br>".$_02_h_["15_02"].":<br>".$_02_h_["15_03"].":</td>
	<td $cjust>$pregn1<br>$pregn2<br>$pregn3 ($pregn4)</td>
	<td $cjust>$p_pregn1<br>$p_pregn2<br>$p_pregn3 ($p_pregn4)</td>
</tr>";
//RepTr();//not pregnant
echo "
<tr $rjust>
	<td><b>".$_02_h_["14"]."</b>:</td>
	<td $cjust><b>$npregn</b></td>
	<td $cjust><b>$p_npregn</b></td>
</tr>";
//RepTr();//calvings
echo "
<tr $rjust>
	<td><b>".$_02_h_["16_01"]."</b>:</td>
	<td $cjust><b>$calvings</b></td>
	<td $cjust><b>$p_calvings</b></td>
</tr>";
//RepTr();//aborts
echo "
<tr $rjust>
	<td><b>".$_02_h_["16_02"]."</b>:</td>
	<td $cjust><b>$aborts</b></td>
	<td $cjust><b>$p_aborts</b></td>
</tr>";
//RepTr();//others
echo "
<tr $rjust>
	<td><b>".$_02_h_["10"]."</b>:</td>
	<td $cjust><b>$others</b></td>
	<td $cjust><b>$p_others</b></td>
</tr>
</tbody>
<tfoot id='rep_tfoot'>
<tr $rjust height='28px'>
	<td $cjust><b>".$ged["TOTAL"]."</b>:</td>
	<td><b>$all</b></td>
	<td>&nbsp;</td>
</tr>
</tfoot>
</table><br>";

include( "frfoot.php" );

ob_end_flush();
?>
