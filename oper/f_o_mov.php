<?php
/* DF_2: oper/f_o_mov.php
oper ---64 (107) [moving & death]
c: 09.01.2006
m: 09.10.2017 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!
$_list_height=$_list_height+80;

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
	$th[2]=$ged["Group"];
	$th[3]=$ged["Number"];
	$th[4]=$ged["Nick"];
	$th[5]=$ged["Departm."];
	$th[6]=$ged["Comment."];
	$th[7]=$ged["Date"];
	$_mod_rep_CSS=1;
	if ( $div_hide!=1 ) $_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1) { background:#ddd; }
	#rep_tbody td:nth-of-type(1):before { content:\"".$th[2]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th[3]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th[4]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(4):before { content:\"".$th[5]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(5):before { content:\"".$th[6]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(6):before { content:\"".$th[7]."\"; text-align:left; top:0; }";
	else $_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1):before { content:\"".$th[5]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th[6]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th[7]."\"; text-align:left; top:0; }";
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date
	$tdw[2]="60px";
	$tdw[3]="60px";
	$tdw[4]="170px";
	$tdw[5]="100px";
	$tdw[6]="100px";
	$tdw[7]="170px";
//	$tdw[1]="10px";
//	if ( $div_hide!=1 ) {
//		if ( count( $cows_arr )>99 ) $tdw[1]="20px";
//		if ( count( $cows_arr )>999 ) $tdw[1]="30px";
//	}
	if ( $varsession!=1 ) include_once( "../oper/f_oprwd.php" );
	echo "
<div class='mk' style='border:0; height:50px; margin:0; overflow-x:hidden; overflow-y:scroll; padding:10px 10px 0 10px;'>";
	if ( $userCoo!=9 ) echo "
	<input class='btn btn_h0 gradient_0f0' id='add_oper' name='add_oper' style='width:91px;' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype].")...'>&nbsp;";
	if ( $div_hide!=1 ) include_once( "../oper/f_dt.php" );//page's date
	else if ( $varsession!=1 & $userCoo!=9 ) echo "&nbsp;<a onclick='sele_to_dele( \"co10\", \"".$php_mm["_06_forward_delete_btn_tip"]."\" ); return false' href=''>".$php_mm["_com_DELE_lnk_"]."</a>";
	echo "
</div>";
	if ( $div_hide!=1 ) echo "
<div class='mk' style='border:0; $theadS0; height:59px;'>";
	else if ( $nosession==1 ) echo "<br><br>";
	echo "
	<table id='OPER_TABLE' style='width:100%;'>
	<tr $cjust style='height:27px;'>";
	if ( $div_hide!=1 ) {
		echo "
		<td width='".$tdw[2]."'>".$th[2]."</td>
		<td width='".$tdw[3]."'>".$th[3]."</td>
		<td>".$th[4]."</th>
		<td width='".$tdw[5]."'>".$th[5]."</td>
		<td width='".$tdw[6]."'>".$th[6]."</td>
		<td width='".$tdw[7]."'>".$th[7]."</td>
	</tr>
	<tr $cjust style='height:27px;'>
		<td width='".$tdw[2]."'>&nbsp;</td>
		<td width='".$tdw[3]."'>&nbsp;</td>
		<td>&nbsp;</td>
		<td width='".$tdw[5]."'>&nbsp;</td>
		<td width='".$tdw[6]."'><input class='txt txt_h0' id='comments1' maxlength='255' name='comments1' style='$inpS1; width:100%;' type='text' onkeyup='fill_tds( \"comments1\", \"co1\" )'></t>
		<td width='".$tdw[7]."'>";
		include_once( "../oper/f_dt1.php" );//page's date
		echo "
		</td>";
	} else {
		$row=mysql_fetch_row( $res );
		echo "
		<td $ljust colspan='6'><font color='#0'>".$th[2].":&nbsp;</font><font color='#aaa'>".$row[3]."</font><br><font color='#0'>".$ged["Number"].":&nbsp;</font><font color='#aaa'>".$row[1]."</font><br><font color='#0'>".$ged["Nick"].":&nbsp;</font><font color='#aaa'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>";
	}
	echo "
	</tr>
	</table>
</div>
<div class='mk' style='border:0; $tbodyS0; height:".$_list_height."px;'>
	<table style='width:100%;'>";
	$j=0;
	$query="SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $groups.id=$cows.gr_id";
	if ( $div_hide!=1 ) $query.=" ORDER BY gr_id, cow_num*1"; else $query.=" AND $cows.id=$cow_id";
	$res=mysql_query( $query );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) echo "
		<td $cjust title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='".$tdw[2]."'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust title='".$cownum_div.$row[1].$cownum_div1."' width='".$tdw[3]."'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust title='".StrCutLen1( $row[2], 59, $contentCharset ) ."'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			if ( $varsession!=1 ) echo "
		<td width='".$tdw[5]."'><input class='txt txt_h0' style='$disS0; width:100%;' type='text' value='$dp_name' onkeypress='return false;'></td>
		<td width='".$tdw[6]."'><input class='txt txt_h0' style='$disS1; width:100%;' type='text' value='$co' onkeypress='return false;'></td>
		<td width='".$tdw[7]."'><input class='txt txt_h0' style='$disS0; width:100%;' type='text' value='$dmY' onkeypress='return false;'></td>
	</tr>
	<tr>";
			if ( $div_hide!=1 ) echo "
		<td $cjust width='".$tdw[2]."'>&nbsp;</td>
		<td $rjust width='".$tdw[3]."'>&nbsp;</td>
		<td $cjust>&nbsp;</td>";
			echo "
		<td width='".$tdw[5]."'><select class='sel sel_h0' name='dps_[".$i."]' style='$inpS0; width:100%;'>";
			for ( $dp=0; $dp<$dps; $dp++ ) {
				$val="value='".$dps_id[$dp]."'";
				if ( $nosession==1 && $dps_name[$dp]==$dp_name ) $val.=" selected";
				if ( $dps_id[$dp]!=2 && $dps_id[$dp]!=3 ) echo "<option $val>".$dps_name[$dp]."</option>";
			}
			echo "</select></td>
		<td width='".$tdw[6]."'><input class='txt txt_h0' id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$inpS1; width:100%;' type='text' value='$co'></td>
		<td width='".$tdw[7]."'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false;' href=''><input class='txt txt_h0' id='date1".$i."' name='dates_[".$i."]' size='8' style='$inpS0; width:100%;' type='text' value='$dmY' onkeypress='return false;'></a></td>
	</tr>";
		}
	}
	echo "
	</table>";
	if ( $div_hide!=1 ) echo "
</div>";
	echo "
</form>";
}
?>
