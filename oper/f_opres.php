<?php
/* DF_2: oper/f_opres.php
report: operations other than extracting (special edition)
created: 25.12.2005
modified: 11.11.2015 */

$title_=$title=$_GET["title"];
if ( strlen( $title_ )<=1 ) $title_=$php_mm["_06_oper_inserted_list"]."&nbsp;$inserted_opername:";

$outsele_=-1; $outsele_table=-1; $outsele_field=-1; $filt_cowid=-1;
$outsele1=-1; $outsele2=-1; $outsele3=-1; $outsele4=-1;
$outsele5=-1; $outsele6=-1; $outsele7=-1; $outsele8=-1;

$rows_cnt=0; $cows_cnt=0; $rowspan_=1;

if ( $key==-1 ) $ret_url="../".$hFrm['0500'];
else {
	if ( strlen( $key )>8 ) $ret_url="../".$hRep['o'];
	else $ret_url="../".$hFrm['0600'];
}
$ret0=$_POST["ret0"];
if ( $ret0=="05" ) {
	$cow_id=$_POST["cow_id"];
	$ret_url="../".$hFrm['0520']."?cow_id=".$cow_id."&ret0=05";
}

echo "
<table width='100%'>
<tr>
	<td>
		<div class='b_h'>";
$arr_menu[0]["url"]="";
$arr_menu[0]["name"]="&nbsp;".$title_."&nbsp;";
ArrMenu( $arr_menu );
echo "
		</div>
	</td>
</tr>
</table><br>
<input class='btn gradient_0f0 btn_h0' style='width:200px' type='button' value='".$php_mm["_com_forward_btn_"]."' onclick='window.location.href=\"$ret_url\"'><br><br>";

$opertype=$_GET["opertype"]*1;
if ( $opertype>1 ) $db_ext="_o";
if ( $coo!=-1 ) $rowspan_++;
if ( $db_ext=="_o" ) $rowspan_++;
if ( $rowspan_==1 ) $rowspan_=0;

if ( $coo!=-1 ) echo "
<div style='height:323px; $tbody_style'>";

echo "
<table cellspacing='1' class='st2'>
<tr $cjust class='st_title2' style='font-weight:bold; height:28px'>
	<td rowspan='$rowspan_' width='60px'>".$ged['Date']."</td>
	<td width='60px'>".$ged['Modif._Time']."</td>
	<td width='60px'>".$ged['Number']."</td>
	<td>".$ged['Nick']."</td>";
if ( $coo!=-1 ) echo "
</tr>
<tr $cjust class='st_title2' style='font-weight:bold'>
	<td colspan='3' width='700px'>".$ged['Detailed_Content']."</td>";
if ( $dbt_ext=="_o" ) echo "
</tr>
<tr $cjust class='st_title2' style='font-weight:bold'>
	<td colspan='3'>".$ged['Comment.']."</td>";
echo "
</tr>";

if ( $coo!=-1 ) {
	$query="SELECT descr, id FROM $pregnant";
	$res=mysql_query( $query, $db ); while ( $row=mysql_fetch_row( $res )) $pregnan[$row[1]]=$row[0];
	$query="SELECT descr, id FROM $states";
	$res=mysql_query( $query, $db ); while ( $row=mysql_fetch_row( $res )) $stan[$row[1]]=$row[0];
	$query="SELECT descr, id FROM $results";
	$res=mysql_query( $query, $db ); while ( $row=mysql_fetch_row( $res )) $result[$row[1]]=$row[0];
	$query="SELECT nick, id FROM $departs";
	$res=mysql_query( $query, $db ); while ( $row=mysql_fetch_row( $res )) $dep[$row[1]]=$row[0];
	$query="SELECT nick, id FROM $oxes";
	$res=mysql_query( $query, $db ); while ( $row=mysql_fetch_row( $res )) $ox[$row[1]]=$row[0];
}

if ( $dbt_ext=="_o" ) include( "../".$hDir['reps']."f_jselo.php" ); else include( "../".$hDir['reps']."f_jselm.php" );

if ( $error==0 ) while ( $row=mysql_fetch_row( $res )) {
	RepTr();
	if ( $dbt_ext=="_o" ) $oper_id=$row[18]*1; else $oper_id=1;
	$nick1=StrCutLen1( $row[5], 59, $contentCharset );
	if ( $coo!=-1 ) {
		include( "../".$hDir['reps']."f_odecod.php" );
		$desc1=StrCutLen1( $descr, 110, $contentCharset );
		echo "
	<td rowspan='$rowspan_' $cjust>".$row[1].".".$row[2].".".$row[3]."</td>
	<td $cjust>".Date_FromDb2Scr( $row[21], "." )."<br>".$row[24]."</td>
	<td $rjust><b>".$cownum_div.$row[4].$cownum_div1."</b></td>
	<td $cjust>".$nick1."&nbsp;</td>
</tr>";
		RepTr();
		echo "
	<td colspan='3'>".$descr."</td>";
		if ( $dbt_ext=="_o" ) {
			$comm1=StrCutLen1( $row[17], 110, $contentCharset );
//			$comm1=PhraseCarry1( $row[17], "<br>", 50, $contentCharset );
			echo "
</tr>";
		RepTr();
		echo "
	<td colspan='3'>".$comm1."&nbsp;</td>";
		}
	} else {
		echo "
	<td $cjust style='background:#aee0e0'>".$row[1].".".$row[2].".".$row[3]."</td>
	<td $cjust style='background:#bed0d0'>".Date_FromDb2Scr( $upd_date, "." )."<br>".$upd_time."</td>
	<td $rjust style='background:#cec0c0'><b>".$cownum_div.$row[4].$cownum_div1."</b></td>
	<td $cjust style='background:#deb0b0'>".$nick1."&nbsp;</td>
</tr>";
		RepTr();
		echo "
	<td $cjust colspan='4'>".$co1."&nbsp;</td>";
	}
	echo "
</tr>";
	$rows_cnt++; if ( $c1[$row[0]*1]!=1 ) $cows_cnt++; $c1[$row[0]*1]=1;
}

echo "
<tr $cjust class='st_title2' style='height:28px'>
	<td><b>".$ged['TOTAL'].":</b></td>
	<td $rjust><center>".$ged['rows'].":</center><b>".$rows_cnt."</b></td>
	<td $rjust><center>".$ged['animals'].":</center><b>".$cows_cnt."</b></td>
	<td $rjust>&nbsp;</td>
</tr>
</table>";

if ( $coo!=-1 ) echo "
</div>";
?>
