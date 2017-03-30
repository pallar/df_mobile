<?php
/* DF_2: oper/f_o_rect.php
oper --512 (110) [rectal condition]
c: 09.01.2006
m: 30.03.2017 */

$dbt_ext="_o";//DON'T MOVE THIS BELOW!

$t0=$_GET["opertype"]; $t1=$_GET["sess_id"]; $t2=$_GET["row_date"]; $key=$_GET["key"];
if ( empty( $t0 ) & empty( $t1 ) & empty( $t2 ) & empty( $key )) return;

if ( strlen( $key )>8 ) {
	$keys=split( ":", $key ); $cow_id=$keys[2];
	$nosession=1;
	$dmY=$_GET["row_date"];
	$co=$_GET["row17"];
	$d7=$_GET["row13"];
	$d8=$_GET["row14"];
	$d16=$_GET["row16"]; $d16_=split( "@", $d16 );
	$div_hide=1;
} else {
	$nosession=-1;
	$dmY="";
	$co="";
	$d7="";
	$d8="";
	$d16="@@@@"; $d16_=split( "@", $d16 );
	$key="";
	$div_hide=-1;
}
if ( $varsession==1 ) {
	$div_hide=1;
	$add_oper_type="button";
	$op_d1=date( d ); $op_m1=date( m ); $op_y1=date( Y );
	$modif_Ymd=$op_y1."-".$op_m1."-".$op_d1; $modif_His=date( "H:i:s" );
	$dmY=$op_d1."-".$op_m1."-".$op_y1;
} else {
	$add_oper_type="submit";
	include( "../oper/f_rcwsf.php" );
	include( "../oper/f_oprwdp.php" );
}
if ( strlen( $key )>8 ) $add_oper_tip=$php_mm["_06_forward_update_btn_tip"];
else $add_oper_tip=$php_mm["_06_forward_btn_tip"];

$dbt=$opers; Toper_create( $dbt );

$_list_height=$_height-200;

$res=mysql_query( "SELECT id, descr FROM $states", $db );
while ( $row=mysql_fetch_row( $res )) {
	$sta_id[$row[0]]=$row[0];
	$sta_desc[$row[0]]=$row[1];
}
$res=mysql_query( "SELECT id, descr FROM $pregnant", $db );
while ( $row=mysql_fetch_row( $res )) {
	$pre_id[$row[0]]=$row[0];
	$pre_desc[$row[0]]=$row[1];
}

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__110.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date
	$td1w="10px";
	$td2w="60px";
	$td3w="60px";
	$td4w="140px";
	$td5w="50px";
	$td6w="50px";
	$td7w="60px"; $td567w="160px"; $td56w="100px";
	$tddw="60px";
	$tdew="60px";
	if ( $div_hide!=1 ) {
		if ( count( $cows_arr )>99 ) $td1w="20px";
		if ( count( $cows_arr )>999 ) $td1w="30px";
	} else {
		$td567w="300px";
		$tddw="300px";
	}
	if ( $varsession!=1 ) include_once( "../oper/f_oprwd.php" );
	$query="SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $groups.id=$cows.gr_id";
	if ( $div_hide!=1 ) $query.=" ORDER BY gr_id, cow_num*1"; else $query.=" AND $cows.id=$cow_id";
	$res=mysql_query( $query, $db );
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
		<td rowspan='2' width='$td1w'>&nbsp;</td>
		<td rowspan='2' width='$td2w'>".$ged['Group']."</td>
		<td rowspan='2' width='$td3w'>".$ged['Number']."</td>
		<td rowspan='2' width='$td4w'>".$ged['Nick']."</td>";
	else $rowspan_="rowspan='2'";
	echo "
		<td colspan='3' width='$td567w'>".$ged['Cond._Pregn.']."</td>
		<td $rowspan_ width='$tddw'>".$ged['Comment.']."</td>
		<td rowspan='2' width='$tdew'>".$ged['Date']."</td>
	</tr>
	<tr $cjust class='st_title2' style='height:27px'>
		<td width='$td5w'>".$ged['cond.']."</td>
		<td width='$td6w'>".$ged['cond.']."</td>
		<td width='$td7w'>".$ged['comment.']."</td>";
	if ( $div_hide!=1 ) echo "
		<td width='$tddw'><input id='comments1' maxlength='255' name='comments1' style='$rw_style; height:23px' type='text' onkeyup='table_edits( \"comments1\", \"co1\" )'></td>";
	echo "
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px; $tbody_style'>
	<table class='st2'>";
	$j=0;
	$res=mysql_query( $query, $db );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) echo "
		<td $cjust rowspan='2' width='$td1w'>".$j."</td>
		<td $cjust height='22px' rowspan='2' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust rowspan='2' title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust rowspan='2' title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>
		<td width='$td5w'><input style='$rr_style; height:18px' type='text' value='".$pre_desc[$d7]."' onkeypress='return false'></td>
		<td width='$td6w'><input style='$rr_style; height:18px' type='text' value='".$sta_desc[$d8]."' onkeypress='return false'></td>
		<td width='$td7w'><input style='$rr_style; height:18px' type='text' value='".$d16_[3]."' onkeypress='return false'></td>
		<td width='$tddw'><input style='$rr_style; height:18px' type='text' value='$co' onkeypress='return false'></td>
		<td height='22px' width='$tdew'><input style='$rr_style; height:18px' type='text' value='$dmY' onkeypress='return false'></td>
	</tr>
	<tr>";
			echo "
		<td style='background:#fff' width='$td5w'><select name='d7_1_[".$i."]' style='$li_style; height:18px'>";
			$d=mysql_query( "SELECT id, descr FROM $pregnant", $db );
			while ($row1=mysql_fetch_row( $d )) {
				$val="value='".$row1[0]."'";
				if ( $nosession==1 & $row1[1]==$pre_desc[$d7] ) $val.=" selected";
				echo "<option $val>".$row1[1]."</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$td6w'><select name='d7_2_[".$i."]' style='$li_style; height:18px'>";
			$d=mysql_query( "SELECT id, descr FROM $states", $db );
			while ($row1=mysql_fetch_row( $d )) {
				$val="value='".$row1[0]."'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d8] ) $val.=" selected";
				echo "<option $val>".$row1[1]."</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$td7w'><input maxlength='55' name='d7_[".$i."]' style='$rw_style; height:18px' type='text' value='".$d16_[3]."'></td>
		<td style='background:#fff' width='$tddw'><input id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$rw_style; height:18px' type='text' value='$co'></td>
		<td style='background:#fff' width='$tdew'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false' href=''><input id='date1".$i."' name='dates_[".$i."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a></td>
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
