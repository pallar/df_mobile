<?php
/* DF_2: oper/f_o_care.php
oper ----8 (104) [care]
c: 09.01.2006
m: 30.03.2017 */

$dbt_ext="_o";//DON'T MOVE THIS BELOW!

$t0=$_GET["opertype"]; $t1=$_GET["sess_id"]; $t2=$_GET["row_date"]; $key=$_GET["key"];
if ( empty( $t0 ) & empty( $t1 ) & empty( $t2 ) & empty( $key )) return;

$div_hide=-1;
if ( strlen( $key )>8 ) {
	$nosession=1;
	$dmY=$t2;
	$co=$_GET["row17"];
	$d1=$_GET["row7"];
	$d2=$_GET["row8"];
	$d3=$_GET["row9"];
	$d4=$_GET["row10"];
	$d7=$_GET["row13"];
	$d8=$_GET["row14"];
	$d15=$_GET["row15"];
	$d16=$_GET["row16"];
	$d15_=split( "@", $d15 );
	$d16_=split( "@", $d16 );
	$div_hide=1;
} else {
	$nosession=-1;
	$dmY="";
	$co="";
	$d1="";
	$d2="";
	$d3="";
	$d4="";
	$d7="";
	$d8="";
	$d15="@@@@";
	$d16="@@@@";
	$d15_=split( "@", $d15 );
	$d16_=split( "@", $d16 );
	$key="";
}
if ( $varsession==1 ) {
	$div_hide=1;
	$add_oper_type="button";
	$op_d1=date( d ); $op_m1=date( m ); $op_y1=date( Y );
	$modif_Ymd=$op_y1."-".$op_m1."-".$op_d1; $modif_His=date( "H:i:s" );
} else {
	$add_oper_type="submit";
	include( "../oper/f_rcwsf.php" );
	include( "../oper/f_oprwdp.php" );
}
if ( strlen( $key )>8 ) $add_oper_tip=$php_mm["_06_forward_update_btn_tip"];
else $add_oper_tip=$php_mm["_06_forward_btn_tip"];

$dbt=$opers; Toper_create( $dbt );

$_list_height=$_height-200;

$res=mysql_query("SELECT id, descr FROM $states", $db);
while ( $row=mysql_fetch_row( $res )) {
	$sta_id[$row[0]]=$row[0]*1;
	$sta_desc[$row[0]]=$row[1];
}
$res=mysql_query("SELECT id, descr FROM $results", $db);
while ( $row=mysql_fetch_row( $res )) {
	$res_id[$row[0]]=$row[0]*1;
	$res_desc[$row[0]]=$row[1];
}

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__104.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date
	$td1w='10px';
	$td2w='60px';
	$td3w='60px';
	$td4w='100px';
	$td5w='60px';
	$td6w='60px';
	$td7w='60px';
	$td8w='60px';
	$td9w='60px';
	$tdaw='60px';
	$tddw='60px';
	$tdew='60px';
	if ( $div_hide!=1 ) {
		if ( count( $cows_arr )>99 ) $td1w='20px';
		if ( count( $cows_arr )>999 ) $td1w='30px';
	}
	if ( $varsession!=1 ) include_once( "../oper/f_oprwd.php" );
	if ( $userCoo!=9 ) echo "
<input class='btn gradient_0f0 btn_h0' id='add_oper' name='add_oper' style='width:200px' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype*1].")...'>&nbsp;";
	if ( $div_hide!=1 ) include_once( "../oper/f_dt.php" );//page's date
	else if ( $varsession!=1 & $userCoo!=9 ) echo "&nbsp;<a onclick='sele_to_dele( \"co10\", \"".$php_mm["_06_forward_delete_btn_tip"]."\" ); return false' href=''>".$php_mm["_com_DELE_lnk_"]."</a>";
	if ( $div_hide!=1 ) echo "

<div style='height:59px; $thead_style'>"; else if ( $nosession==1 ) echo "<br><br>";
	echo "
	<table id='OPER_TABLE' class='st2'>
	<tr $cjust class='st_title2' style='height:27px'>";
	if ( $div_hide!=1 ) echo "
		<td rowspan='2' width='$td1w'>&nbsp;</td>";
	echo "
		<td rowspan='2' width='$td2w'>".$ged['Group']."</td>
		<td rowspan='2' width='$td3w'>".$ged['Number']."</td>
		<td rowspan='2' width='$td4w'>".$ged['Nick']."</td>
		<td rowspan='2' width='$td5w'>".PhraseCarry( $ged['Cond.,Udder'], ' ', 1 )."</td>
		<td rowspan='2' width='$td6w'>".PhraseCarry( $ged['Cond.,Womb'], ' ', 1 )."</td>
		<td rowspan='2' width='$td7w'>".PhraseCarry( $ged['Cond.,Hornes'], ' ', 1 )."</td>
		<td rowspan='2' width='$td8w'>".PhraseCarry( $ged['Cond.,Hoof'], ' ', 1 )."</td>
		<td rowspan='2' width='$td9w'>".PhraseCarry( $ged['Cond.,Common'], ' ', 1 )."</td>
		<td rowspan='2' width='$tdaw'>".PhraseCarry(  $ged['Conclusion_Common'], ' ', 1 )."</td>
		<td width='$tddw'>".$ged['Comment.']."</td>
		<td rowspan='2' width='$tdew'>".$ged['Date']."</td>
	</tr>
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>
		<td width='$tddw'>";
	if ( $userCoo!=9 & $div_hide!=1 ) echo "<input id='comments1' maxlength='255' name='comments1' style='$rw_style; height:23px' type='text' onkeyup='table_edits( \"comments1\", \"co1\" )'>"; else echo "&nbsp;";
	echo "</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px; $tbody_style'>
	<table cellspacing='1' class='st2'>";
	else if ( $varsession!=1 ) {
		echo "
	<tr ".GrTrCol().">
		<td rowspan='2' height='41px'>&nbsp;</td>
		<td rowspan='2'>&nbsp;</td>
		<td rowspan='2'>&nbsp;</td>
		<td><input style='$rr_style; height:18px' type='text' value='$d15_[1]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$d15_[2]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$d15_[3]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$d15_[4]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$d16_[3]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$d16_[4]' onkeypress='return false'></td>
		<td rowspan='2'><input style='$rr_style; height:100%' type='text' value='$co' onkeypress='return false'></td>
		<td rowspan='2'><input style='$rr_style; height:100%' type='text' value='$dmY' onkeypress='return false'></td>
	</tr>
	<tr ".GrTrCol().">
		<td><input style='$rr_style; height:18px' type='text' value='$sta_desc[$d1]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$sta_desc[$d2]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$sta_desc[$d3]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$sta_desc[$d4]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$sta_desc[$d7]' onkeypress='return false'></td>
		<td><input style='$rr_style; height:18px' type='text' value='$res_desc[$d8]' onkeypress='return false'></td>
	</tr>";
	}
	$res=mysql_query( "SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick
	 FROM $cows, $groups
	 WHERE $groups.id=$cows.gr_id
	 ORDER BY gr_id, cow_num*1", $db );
	$j=0;
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			if ( $div_hide!=1 ) echo "
	<tr ".GrTrCol().">
		<td $cjust rowspan='2' width='$td1w'>".$j."</td>";
			echo "
		<td $cjust height='22px' rowspan='2' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust rowspan='2' title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust rowspan='2' title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 9, $contentCharset )."</td>
		<td style='background:#fff' width='$td5w'><input maxlength='55' name='d1_[$i]' style='$rw_style; height:18px' type='text' value='$d15_[1]'></td>
		<td style='background:#fff' width='$td6w'><input maxlength='55' name='d2_[$i]' style='$rw_style; height:18px' type='text' value='$d15_[2]'></td>
		<td style='background:#fff' width='$td7w'><input maxlength='55' name='d3_[$i]' style='$rw_style; height:18px' type='text' value='$d15_[3]'></td>
		<td style='background:#fff' width='$td8w'><input maxlength='55' name='d4_[$i]' style='$rw_style; height:18px' type='text' value='$d15_[4]'></td>
		<td style='background:#fff' width='$td9w'><input maxlength='55' name='d7_[$i]' style='$rw_style; height:18px' type='text' value='$d16_[3]'></td>
		<td style='background:#fff' width='$tdaw'><input maxlength='55' name='d8_[$i]' style='$rw_style; height:18px' type='text' value='$d16_[4]'></td>
		<td rowspan='2' style='background:#fff' width='$tddw'><input id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$rw_style; height:41px' type='text' value='$co'></td>
		<td rowspan='2' style='background:#fff' width='$tdew'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false' href=''><input id='date1".$i."' name='dates_[".$i."]' size='8' style='$li_style; height:41px' type='text' value='$dmY' onkeypress='return false'></a></td>
	</tr>
	<tr ".GrTrCol().">
		<td height='22px' style='background:#fff' width='$td5w'><select name='d1_1_[$i]' style='$li_style; height:18px'>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states", $db );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d1] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$td6w'><select name='d2_1_[$i]' style='$li_style; height:18px'>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states", $db );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d2] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$td7w'><select name='d3_1_[$i]' style='$li_style; height:18px'>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states", $db );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d3] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$td8w'><select name='d4_1_[$i]' style='$li_style; height:18px'>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states", $db );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d4] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$td9w'><select name='d7_1_[$i]' style='$li_style; height:18px'>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states", $db );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d7] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$tdaw'><select name='d8_1_[$i]' style='$li_style; height:18px'>";
			$d1_1=mysql_query( "SELECT id, descr FROM $results", $db );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$res_desc[$d8] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
	</tr>";
		}}
	}
	echo "
	</table>";
	if ( $div_hide!=1 ) echo "
</div>"; else echo "
	<table id='div' width='760px'></table><br>";
	echo "
</form>";
}
