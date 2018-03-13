<?php
/* DF_2: oper/f_o_care.php
oper ----8 (104) [care]
c: 09.01.2006
m: 11.10.2017 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!
$_list_height=$_list_height+80;

if ( strlen( $key )>8 ) {
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
} else {
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
}

$res=mysql_query( "SELECT id, descr FROM $states" );
while ( $row=mysql_fetch_row( $res )) {
	$sta_id[$row[0]]=$row[0]*1;
	$sta_desc[$row[0]]=$row[1];
}
$res=mysql_query( "SELECT id, descr FROM $results" );
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
	$td2w="60px";
	$td3w="60px";
	$td4w="100px";
	$td5w="60px";
	$td6w="60px";
	$td7w="60px";
	$td8w="60px";
	$td9w="60px";
	$tdaw="60px";
	$tdw[20]="100px";
	$tdw[21]="170px";
//	$tdw[1]="10px";
//	if ( $div_hide!=1 ) {
//		if ( count( $cows_arr )>99 ) $td1w="20px";
//		if ( count( $cows_arr )>999 ) $td1w="30px";
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
<div class='mk' style='border:0; $theadS0; height:59px;'>";
	else if ( $nosession==1 ) echo "<br><br>";
	echo "
	<table id='OPER_TABLE' style='width:100%;'>
	<tbody id='rep_tbody'>
	<tr $cjust style='height:27px;'>";
	if ( $div_hide!=1 ) echo "
		<td width='$td2w'>".$ged["Group"]."</td>
		<td width='$td3w'>".$ged["Number"]."</td>
		<td width='$td4w'>".$ged["Nick"]."</td>
		<td width='$td5w'>".PhraseCarry( $ged["Cond.,Udder"], ' ', 1 )."</td>
		<td width='$td6w'>".PhraseCarry( $ged["Cond.,Womb"], ' ', 1 )."</td>
		<td width='$td7w'>".PhraseCarry( $ged["Cond.,Hornes"], ' ', 1 )."</td>
		<td width='$td8w'>".PhraseCarry( $ged["Cond.,Hoof"], ' ', 1 )."</td>
		<td width='$td9w'>".PhraseCarry( $ged["Cond.,Common"], ' ', 1 )."</td>
		<td width='$tdaw'>".PhraseCarry( $ged["Conclusion_Common"], ' ', 1 )."</td>
		<td width='".$tdw[20]."'>".$ged["Comment."]."</td>
		<td width='".$tdw[21]."'>".$ged["Date"]."</td>
	</tr>
	<tr $cjust style='height:27px;'>
		<td width='$tddw'>";
	if ( $userCoo!=9 & $div_hide!=1 ) echo "<input id='comments1' maxlength='255' name='comments1' style='$rwS0; height:23px;' type='text' onkeyup='fill_tds( \"comments1\", \"co1\" )'>"; else echo "&nbsp;";
	echo "</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px;'>
	<table>";
	else if ( $varsession!=1 ) {
		echo "
	<tr ".GrTrCol().">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type='text' value='$d15_[1]' onkeypress='return false;'></td>
		<td><input type='text' value='$d15_[2]' onkeypress='return false;'></td>
		<td><input type='text' value='$d15_[3]' onkeypress='return false;'></td>
		<td><input type='text' value='$d15_[4]' onkeypress='return false;'></td>
		<td><input type='text' value='$d16_[3]' onkeypress='return false;'></td>
		<td><input type='text' value='$d16_[4]' onkeypress='return false;'></td>
		<td><input type='text' value='$co' onkeypress='return false;'></td>
		<td><input type='text' value='$dmY' onkeypress='return false;'></td>
	</tr>
	<tr ".GrTrCol().">
		<td><input type='text' value='$sta_desc[$d1]' onkeypress='return false;'></td>
		<td><input type='text' value='$sta_desc[$d2]' onkeypress='return false;'></td>
		<td><input type='text' value='$sta_desc[$d3]' onkeypress='return false;'></td>
		<td><input type='text' value='$sta_desc[$d4]' onkeypress='return false;'></td>
		<td><input type='text' value='$sta_desc[$d7]' onkeypress='return false;'></td>
		<td><input type='text' value='$res_desc[$d8]' onkeypress='return false;'></td>
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
		<td $cjust width='$td1w'>".$j."</td>";
			echo "
		<td $cjust title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 9, $contentCharset )."</td>
		<td width='$td5w'><input maxlength='55' name='d1_[$i]' style='' type='text' value='$d15_[1]'></td>
		<td width='$td6w'><input maxlength='55' name='d2_[$i]' style='' type='text' value='$d15_[2]'></td>
		<td width='$td7w'><input maxlength='55' name='d3_[$i]' style='' type='text' value='$d15_[3]'></td>
		<td width='$td8w'><input maxlength='55' name='d4_[$i]' style='' type='text' value='$d15_[4]'></td>
		<td width='$td9w'><input maxlength='55' name='d7_[$i]' style='' type='text' value='$d16_[3]'></td>
		<td width='$tdaw'><input maxlength='55' name='d8_[$i]' style='' type='text' value='$d16_[4]'></td>
		<td width='".$tdw[20]."'><input class='txt txt_h0' id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$inpS1; width:100%;' type='text' value='$co'></td>
		<td width='".$tdw[21]."'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false;' href=''><input class='txt txt_h0' id='date1".$i."' name='dates_[".$i."]' size='8' style='$inpS0; width:100%;' type='text' value='$dmY' onkeypress='return false;'></a></td>
	</tr>
	<tr ".GrTrCol().">
		<td width='$td5w'><select name='d1_1_[$i]' style=''>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states" );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d1] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td width='$td6w'><select name='d2_1_[$i]' style=''>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states" );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d2] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td width='$td7w'><select name='d3_1_[$i]' style=''>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states" );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d3] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td width='$td8w'><select name='d4_1_[$i]' style=''>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states" );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d4] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td width='$td9w'><select name='d7_1_[$i]' style=''>";
			$d1_1=mysql_query( "SELECT id, descr FROM $states" );
			while ( $row1=mysql_fetch_row( $d1_1 )) {
				$val="value='$row1[0]'";
				if ( $nosession==1 & $row1[1]==$sta_desc[$d7] ) $val.=" selected";
				echo "<option $val>$row1[1]</option>";
			}
			echo "</select></td>
		<td width='$tdaw'><select name='d8_1_[$i]' style=''>";
			$d1_1=mysql_query( "SELECT id, descr FROM $results" );
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
</div>";
	echo "
</form>";
}
?>
