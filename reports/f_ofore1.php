<?php
/* DF_2: reports/f_o.php
report: operations other than extracting
c: 10.05.2005
m: 30.03.2017 */

$dbt_ext="_o";

ob_start();//lock output to set cookies properly!

$title_=$title=$_GET["title"];

$dontuse_period=1;//ONLY IN THIS REPORT
$repfilt__hide=1;//hide filters

include( "f_jfilt.php" );
include( "frhead.php" );
include( "../locales/$lang/f_rrm._$lang" );
include( "../locales/$lang/f_rroerr._$lang" );

$now=date( 'Y-m-d' );

$insem1_0=$prep_ovul1_days0; $insem1_1=$insem1_0+$ovul_durat_days0;
$insem2_0=$prep_ovul2_days0; $insem2_1=$insem2_0+$ovul_durat_days0;
$insem3_0=$prep_ovul3_days0; $insem3_1=$insem3_0+$ovul_durat_days0;

echo "
<table cellspacing='1' class='st2' width='500px'>
<tr class='st_title2' style='height:28px'>
	<td $cjust width='55px'><b>".$ged['Number']."</b></td>
	<td $cjust><b>".$ged['Nick']."</b></td>
	<td $cjust><b>".$ged['Group']."</b></td>
	<td $cjust width='1%'><b>".$ged['Abort_Date~']."</b></td>
	<td $cjust width='15%'><b>".$ged["O."]."&nbsp;1</b></td>
	<td $cjust width='15%'><b>".$ged["O."]."&nbsp;2</b></td>
	<td $cjust width='15%'><b>".$ged["O."]."&nbsp;3</b></td>
	<td $cjust width='100px'><b>".$ged["Warning"]."</b></td>
</tr>";
$query="SELECT id, cow_num, gr_id, nick, a_dates, b_dates, b_dates_res, c_dates, c_dates_res FROM $cows WHERE z_dates='' ORDER BY c_dates ASC"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_array( $res )) {
	$all++;
	if( $row[c_dates]>$row[a_dates] && $row[c_dates]>$row[b_dates] ) {
		if( $row[c_dates_res]==4 ) {
			$query1="SELECT nick FROM $groups WHERE id=$row[gr_id]"; $res1=mysql_query( $query1, $db );
			$row1=mysql_fetch_array( $res1 );
			$dt=strtotime( $row[c_dates] );
			$date10=date( 'Y-m-d', strtotime( $insem1_0.' days', $dt ));
			$date11=date( 'Y-m-d', strtotime( $insem1_1.' days', $dt ));
			$date20=date( 'Y-m-d', strtotime( $insem2_0.' days', $dt ));
			$date21=date( 'Y-m-d', strtotime( $insem2_1.' days', $dt ));
			$date30=date( 'Y-m-d', strtotime( $insem3_0.' days', $dt ));
			$date31=date( 'Y-m-d', strtotime( $insem3_1.' days', $dt ));
			$warning=""; $warning_tip="";
			if ( $userCoo*1!=9 ) {
				$href="<a href='../".$hFrm['0600']."'>";
				$href_e="</a>";
			} else {
				$href="";
				$href_e="";
			}
			if( $date31<$now ) {
				$warning=$ged["Bad_insem~"];
				$warning_tip=$ged["Bad_insem"];
			}
			echo "
<tr ".RepTrCol().">
	<td $rjust><a href='../".$hFrm['0520']."?cow_id=".$row[0]."'>".$cownum_div.$row[cow_num].$cownum_div1."</a></td>
	<td><a href='../".$hFrm['0520']."?cow_id=".$row[0]."'>".$row[nick]."</td>
	<td>$row1[nick]</td>
	<td $cjust title='".$php_mm["_06_tip"]."'>".$href.Date_FromDb2Scr( $row[c_dates], "." ).$href_e."</td>
	<td $cjust>&nbsp;".Date_FromDb2Scr( $date10, "." )." - ".Date_FromDb2Scr( $date11, "." )."</td>
	<td $cjust>&nbsp;".Date_FromDb2Scr( $date20, "." )." - ".Date_FromDb2Scr( $date21, "." )."</td>
	<td $cjust>&nbsp;".Date_FromDb2Scr( $date30, "." )." - ".Date_FromDb2Scr( $date31, "." )."</td>
	<td $cjust title='$warning_tip'>".$href."<font style='color:#ff0000'><b>$warning</b></font>".$href_e."</td>
</tr>";
		}
	}
}
echo "
</table><br>";

ob_end_flush();
?>
