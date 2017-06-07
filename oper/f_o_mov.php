<?php
/* DF_2: oper/f_o_mov.php
oper ---64 (107) [moving & death]
c: 09.01.2006
m: 06.06.2017 */

$dbt_ext="_o";//DON'T MOVE THIS BELOW!

if ( strlen( $key )>8 ) {
	$dp_id=$_GET["row14"];
} else {
	$dp_id="";
}

$dps=0;
$res=mysql_query( "SELECT id, nick FROM $departs", $db );
while ( $row=mysql_fetch_row( $res )) {
	$dps_id[$dps]=$row[0];
	$dps_name[$dps]=$row[1];
	if ( $dps_id[$dps]==$dp_id ) $dp_name=$row[1];
	$dps++;
}

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__107.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	$th[1]=$ged["Group"];
	$th[2]=$ged["Number"];
	$th[3]=$ged["Nick"];
	$th[4]=$ged["Departm."];
	$th[5]=$ged["Comment."];
	$th[6]=$ged["Date"];
	$_mod_rep_CSS=1;
	$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1) { background:#ddd; }
	#rep_tbody td:nth-of-type(1):before { content:\"".$th[1]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th[2]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th[3]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(4):before { content:\"".$th[4]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(5):before { content:\"".$th[5]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(6):before { content:\"".$th[6]."\"; text-align:left; top:0; }";
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date
	$td2w="60px";
	$td3w="60px";
	$td4w="170px";
	$td5w="70px";
	$tddw="60px";
	$tdew="60px";
	if ( $varsession!=1 ) include_once( "../oper/f_oprwd.php" );
	$query="SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $groups.id=$cows.gr_id";
	if ( $div_hide!=1 ) $query.=" ORDER BY gr_id, cow_num*1"; else $query.=" AND $cows.id=$cow_id";
	$res=mysql_query( $query, $db );
	echo "
<table><tr><td height='3px'></td></tr></table>

<div class='mk' style='border:0; height:90px; margin:0; overflow-x:hidden; overflow-y:scroll'>";
	if ( $userCoo!=9 ) echo "
	<input class='btn btn_h0 gradient_0f0' id='add_oper' name='add_oper' style='width:91px' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype].")...'>&nbsp;";
	if ( $div_hide!=1 ) include_once( "../oper/f_dt.php" );//page's date
	else if ( $varsession!=1 & $userCoo!=9 ) echo "&nbsp;<a onclick='sele_to_dele( \"co10\", \"".$php_mm["_06_forward_delete_btn_tip"]."\" ); return false' href=''>".$php_mm["_com_DELE_lnk_"]."</a>";
	echo "
</div>";
	if ( $div_hide!=1 ) echo "
<div style='height:59px; $thead_style'>";
	else if ( $nosession==1 ) echo "<br><br>";
	echo "
	<table id='OPER_TABLE' class='st2'>
	<tr $cjust class='st_title2' style='height:27px'>";
	if ( $div_hide!=1 ) {
		echo "
		<td rowspan='2' width='$td2w'>".$ged["Group"]."</td>
		<td rowspan='2' width='$td3w'>".$ged["Number"]."</td>
		<td rowspan='2' width='$td4w'>".$ged["Nick"]."</td>";
		$rowspan_="rowspan='2'";
	} else {
		$row=mysql_fetch_row( $res );
		echo "
		<td $ljust colspan='3'><font color='#0'>".$ged["Group"].":&nbsp;</font><font color='#aaa'>".$row[3]."</font><br><font color='#0'>".$ged["Number"].":&nbsp;</font><font color='#aaa'>".$row[1]."</font><br><font color='#0'>".$ged["Nick"].":&nbsp;</font><font color='#aaa'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>
	</tr>
	<tr $cjust class='st_title2' style='height:27px'>";
	}
	echo "
		<td $rowspan_ width='$td5w'>".$ged["Departm."]."</td>
		<td width='$tddw'>".$ged["Comment."]."</td>
		<td $rowspan_ width='$tdew'>".$ged["Date"]."</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	<tr $cjust class='st_title2' style='height:27px'>
		<td width='$tddw'><input id='comments1' maxlength='255' name='comments1' style='$rw_style; height:23px' type='text' onkeyup='table_edits( \"comments1\", \"co1\" )'></td>
	</tr>
	</table>
</div>
<div style='height:".$_list_height."px; $tbody_style'>
	<table class='st2'>";
	$j=0;
	$res=mysql_query( $query, $db );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) echo "
		<td $cjust rowspan='2' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust rowspan='2' title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust rowspan='2' title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			if ( $varsession!=1 ) echo "
		<td width='$td5w'><input style='$rr_style' type='text' value='$dp_name' onkeypress='return false'></td>
		<td width='$tddw'><input style='$rr_style' type='text' value='$co' onkeypress='return false'></td>
		<td height='22px' width='$tdew'><input style='$rr_style' type='text' value='$dmY' onkeypress='return false'></td>
	</tr>
	<tr>";
			echo "
		<td style='background:#fff' width='$td5w'><select name='dps_[".$i."]' style='$li_style; height:18px'>";
			for ( $dp=0; $dp<$dps; $dp++ ) {
				$val="value='".$dps_id[$dp]."'";
				if ( $nosession==1 && $dps_name[$dp]==$dp_name ) $val.=" selected";
				if ( $dps_id[$dp]!=2 && $dps_id[$dp]!=3 ) echo "<option $val>".$dps_name[$dp]."</option>";
			}
			echo "</select></td>
		<td style='background:#fff' width='$tddw'><input id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$rw_style; height:18px' type='text' value='$co'></td>
		<td height='22px' style='background:#fff' width='$tdew'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false' href=''><input id='date1".$i."' name='dates_[".$i."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a></td>
	</tr>";
		}
	}
	echo "
	</table>";
	if ( $div_hide!=1 ) echo "
</div>"; else echo "
	<table id='div' width='760px'></table><br>";
	echo "
</form>";
}
?>
