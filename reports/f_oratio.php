<?php
/*
DF_2: reports/f_oratio.php
report: herd current quantitative ratio
created: 21.04.2011
modified: 02.06.2014
*/

ob_start();//lock output to set cookies properly!

$_GET[title]; $title_=$title;

$dontuse_period=1;//ONLY IN THIS REPORT
$repfilt__hide = 1;//hide filters

include( "f_jfilt.php" );
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
}

echo "
<table cellspacing='1' class='st2' width='500px'>
<tr class='st_title2' style='height:28px'>
	<td $cjust width='50%'><b>".$_02_h_cap['Index']."</b></td>
	<td $cjust width='25%'><b>".$_02_h_cap['Value']."</b></td>
	<td $cjust width='25%'><b>".$_02_h_cap['Percent']."</b></td>
</tr>";
RepTr();//inseminated
echo "
	<td><b>".$_02_h_cap['12']."</b>:&nbsp;</td>
	<td $cjust><b>$insem</b></td>
	<td $cjust><b>$p_insem</b></td>
</tr>";
RepTr();//inseminated once
echo "
	<td $rjust>".$_02_h_cap['12_01'].":&nbsp;<br>".$_02_h_cap['12_02'].":&nbsp;</td>
	<td $cjust>$insem1<br>$insem2</td>
	<td $cjust>$p_insem1<br>$p_insem2</td>
</tr>";
RepTr();//pregnant
echo "
	<td><b>".$_02_h_cap['15']."</b>:&nbsp;</td>
	<td $cjust><b>$pregn</b></td>
	<td $cjust><b>$p_pregn</b></td>
</tr>";
RepTr();//pregnant after first insem
echo "
	<td $rjust>".$_02_h_cap['15_01'].":&nbsp;<br>".$_02_h_cap['15_02'].":&nbsp;<br>".$_02_h_cap['15_03'].":&nbsp;</td>
	<td $cjust>$pregn1<br>$pregn2<br>$pregn3 ($pregn4)</td>
	<td $cjust>$p_pregn1<br>$p_pregn2<br>$p_pregn3 ($p_pregn4)</td>
</tr>";
RepTr();//not pregnant
echo "
	<td><b>".$_02_h_cap['14']."</b>:&nbsp;</td>
	<td $cjust><b>$npregn</b></td>
	<td $cjust><b>$p_npregn</b></td>
</tr>";
RepTr();//calvings
echo "
	<td><b>".$_02_h_cap['16_01']."</b>:&nbsp;</td>
	<td $cjust><b>$calvings</b></td>
	<td $cjust><b>$p_calvings</b></td>
</tr>";
RepTr();//aborts
echo "
	<td><b>".$_02_h_cap['16_02']."</b>:&nbsp;</td>
	<td $cjust><b>$aborts</b></td>
	<td $cjust><b>$p_aborts</b></td>
</tr>";
RepTr();//others
echo "
	<td><b>".$_02_h_cap['10']."</b>:&nbsp;</td>
	<td $cjust><b>$others</b></td>
	<td $cjust><b>$p_others</b></td>
</tr>
<tr class='st_title2' style='height:28px'>
	<td $cjust><b>".$ged['TOTAL']."</b>:&nbsp;</td>
	<td $cjust><b>$all</b></td>
	<td $cjust><b></b></td>
</tr>
</table>";

ob_end_flush();//unlock output to set cookies properly!
?>
