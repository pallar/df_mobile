<?php
/* DF_2: oper/f_o_mov.php
oper ---64 (107) [moving & death]
c: 09.01.2006
m: 22.03.2018 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!
$_list_height=$_list_height+90;

if ( strlen( $key )>8 ) {
	$dp_id=$_GET["row14"];
} else {
	$dp_id="";
}

$dps=0;
$res=mysql_query( "SELECT id, nick FROM $departs" );
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
//	$tdw[1]="10px";
//	if ( $div_hide!=1 ) {
//		if ( count( $cows_arr )>99 ) $tdw[1]="20px";
//		if ( count( $cows_arr )>999 ) $tdw[1]="30px";
//	}
	include_once( "../oper/f_oprwd.php" );
	echo "
<div class='mk' style='border:0; height:50px; margin:0; overflow-x:hidden; overflow-y:scroll; padding:10px 10px 0 10px;'>";
	if ( $userCoo!=9 ) echo "
	<input class='btn btn_h0 gradient_0f0' id='add_oper' name='add_oper' style='width:91px;' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype].")...'>&nbsp;";
	else if ( $varsession!=1 & $userCoo!=9 ) echo "&nbsp;<a onclick='sele_to_dele( \"co10\", \"".$php_mm["_06_forward_delete_btn_tip"]."\" ); return false' href=''>".$php_mm["_com_DELE_lnk_"]."</a>";
	echo "
</div>";
	if ( $div_hide!=1 ) echo "
<div class='mk' id='rep_thead_div' style='border:0; $theadS0;'>";
	else if ( $nosession==1 ) echo "<br><br>";
	echo "
	<table id='OPER_TABLE' style='width:100%;'>
	<thead id='rep_thead'>
	<tr>";
	if ( $div_hide!=1 ) {
//		echo "
//		<th width='".$tdw[1]."'>&nbsp;</th>";
		echo "
		<th width='".$tdw[2]."'>".$th[2]."</th>
		<th width='".$tdw[3]."'>".$th[3]."</th>
		<th>".$th[4]."</th>";
	}
	echo "
		<th width='".$tdw[5]."'>".$th[5]."</th>
		<th width='".$tdw[20]."'>".$th[20]."</th>
		<th width='".$tdw[21]."'>".$th[21]."</th>
	</tr>
	</thead>
	<tbody id='rep_thead'>
	<tr>";
	if ( $div_hide!=1 ) {
//		echo "
//		<td>&nbsp;</td>";
		echo "
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>";
	}
	echo "
		<td><select class='sel sel_h0' id='dep_ctrl' style='$inpS0; width:100%;' onchange='fill_tds( \"dep_ctrl\", \"tdep\" );'>";
			for ( $dp=0; $dp<$dps; $dp++ ) {
				$val="value='".$dps_id[$dp]."'";
				if ( $dps_id[$dp]!=2 && $dps_id[$dp]!=3 ) echo "<option $val>".$dps_name[$dp]."</option>";
			}
	echo "</select></td>
		<td><input class='txt txt_h0' id='co_ctrl' maxlength='255' name='comments1' style='$inpS1; width:100%;' type='text' onkeyup='fill_tds( \"co_ctrl\", \"tco\" );'></t>
		<td>";
	include_once( "../oper/f_dt1.php" );//page's date
	echo "
		</td>
	</tr>
	</tbody>
	</table>
</div>
<div class='mk' style='border:0; $tbodyS0; height:".$_list_height."px;'>
	<table style='width:100%;'>
	<tbody id='rep_tbody'>";
	$j=0;
	$query="SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $groups.id=$cows.gr_id";
	if ( $div_hide!=1 ) $query.=" ORDER BY gr_id, cow_num*1"; else $query.=" AND $cows.id=$cow_id";
	$res=mysql_query( $query );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) {
//				echo "
//		<td $cjust width='".$tdw[1]."'>".$j."</td>
				echo "
		<td title='".StrCutLen1( $row[3], 59, $contentCharset )."'>&nbsp;".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td title='".$cownum_div.$row[1].$cownum_div1."'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td title='".StrCutLen1( $row[2], 59, $contentCharset ) ."'>&nbsp;".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			}		
			if ( $varsession!=1 ) echo "
		<td>&nbsp;REMOVE_THIS $dp_name</td>
		<td>&nbsp;REMOVE_THIS $co</td>
		<td>&nbsp;REMOVE_THIS $dmY</td>
	</tr>
	<tr>";
			if ( $div_hide!=1 ) {
//				echo "
//		<td $cjust width='".$tdw[1]."'>&nbsp;</td>
				echo "
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>";
			}
			echo "
		<td><select class='sel sel_h0' id='tdep".$i."' name='dps_[".$i."]' style='$inpS0; width:100%;'>";
			for ( $dp=0; $dp<$dps; $dp++ ) {
				$val="value='".$dps_id[$dp]."'";
				if ( $nosession==1 && $dps_name[$dp]==$dp_name ) $val.=" selected";
				if ( $dps_id[$dp]!=2 && $dps_id[$dp]!=3 ) echo "<option $val>".$dps_name[$dp]."</option>";
			}
			echo "</select></td>
		<td><input class='txt txt_h0' id='tco".$i."' name='co_[".$i."]' maxlength='255' style='$inpS1; width:100%;' type='text' value='$co'></td>
		<td><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false;'><input class='txt txt_h0' id='date1".$i."' name='dates_[".$i."]' readonly size='8' style='$inpS0; width:100%;' type='text' value='$dmY' onkeypress='return false;'></a></td>
	</tr>";
		}
	}
	echo "
	</tbody>
	</table>";
	if ( $div_hide!=1 ) echo "
</div><br>";
	echo "
</form>";
}
?>
