<?php
/* DF_2: oper/f_o_meas.php
oper ----4 (103) [measurings]
c: 09.01.2006
m: 20.02.2018 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!
$_list_height=$_list_height+80;

if ( strlen( $key )>8 ) {
	$d1=$_GET["row7"];
	$d2=$_GET["row8"];
	$d3=$_GET["row9"];
	$d4=$_GET["row10"];
	$d5=$_GET["row11"];
	$d6=$_GET["row12"];
	$d7=$_GET["row13"];
	$d8=$_GET["row14"];
} else {
	$d1="";
	$d2="";
	$d3="";
	$d4="";
	$d5="";
	$d6="";
	$d7="";
	$d8="";
}

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__103.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	echo "
<script language='JavaScript' src='../dflib/f_input.js'></script>";
	$td2w="60px";
	$td3w="60px";
	$td4w="60px";
	$td5w="20px";
	$td6w="20px";
	$td7w="20px";
	$td8w="20px";
	$td9w="20px";
	$tdaw="20px";
	$tdbw="20px";
	$tdcw="20px";
	$tdw[20]="100px";
	$tdw[21]="170px";
//	$tdw[1]="10px";
//	if ( $div_hide!=1 ) {
//		if ( count( $cows_arr )>99 ) $td1w="20px";
//		if ( count( $cows_arr )>999 ) $td1w="30px";
//	}
	include_once( "../oper/f_oprwd.php" );
	if ( $userCoo!=9 ) echo "
<input class='btn btn_h0 gradient_0f0' id='add_oper' name='add_oper' style='width:200px' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype*1].")...'>&nbsp;";
	else if ( $varsession!=1 & $userCoo!=9 ) echo "
&nbsp;<a onclick='sele_to_dele( \"co10\", \"".$php_mm["_06_forward_delete_btn_tip"]."\" ); return false' href=''>".$php_mm["_com_DELE_lnk_"]."</a>";
	echo "
<center>".$ged["mm"].":&nbsp;".
"(<b>1</b>&nbsp;-".$ged["Depth,Chest"].")&nbsp;(<b>2</b>&nbsp;-".$ged["Width,Chest"].
")&nbsp;(<b>3</b>&nbsp;-".$ged["Diam.,Chest"].")&nbsp;(<b>4</b>&nbsp;-".$ged["Height"].
")&nbsp;(<b>5</b>&nbsp;-".$ged["Width,Shoulder-blade"].")&nbsp;(<b>6</b>&nbsp;-".$ged["Slant._Len."].
")&nbsp;(<b>7</b>&nbsp;-".$ged["Diam.,Wrist."].
")&nbsp;&nbsp;<b>8</b>&nbsp;-".$ged["Brutto"].", ".$ged["kg"]."</center>";
	if ( $div_hide!=1 ) echo "
<div style='$theadS0; height:59px;'>";
	echo "
	<table id='OPER_TABLE'>
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>";
//	if ( $div_hide!=1 ) echo "
//		<td width='".$tdw[1]."'>&nbsp;</td>";
	echo "
		<td width='$td2w'>".$ged["Group"]."</td>
		<td width='$td3w'>".$ged["Number"]."</td>
		<td width='$td4w'>".$ged["Nick"]."</td>
		<td width='$td5w'>1</td>
		<td width='$td6w'>2</td>
		<td width='$td7w'>3</td>
		<td width='$td8w'>4</td>
		<td width='$td9w'>5</td>
		<td width='$tdaw'>6</td>
		<td width='$tdbw'>7</td>
		<td width='$tdcw'>8</td>
		<td width='".$tdw[20]."'>".$ged["Comment."]."</td>
		<td width='".$tdw[21]."'>".$ged["Date"]."</td>
	</tr>
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>
		<td width='$tddw'>";
	if ( $userCoo!=9 & $div_hide!=1 ) echo "<input id='comments1' maxlength='255' name='comments1' style='$rwS0; height:23px;' type='text' onkeyup='fill_tds( \"comments1\", \"co1\" )'>"; else echo "&nbsp;";
	echo "</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px;'>
	<table>";
	else if ( $varsession!=1 ) echo "
	<tr ".GrTrCol().">
		<td width='$td2w'>&nbsp;</td>
		<td width='$td3w'>&nbsp;</td>
		<td width='$td4w'>&nbsp;</td>
		<td width='$td5w'><input style='' type='text' value='$d1' onkeypress='return false;'></td>
		<td width='$td6w'><input style='' type='text' value='$d2' onkeypress='return false;'></td>
		<td width='$td7w'><input style='' type='text' value='$d3' onkeypress='return false;'></td>
		<td width='$td8w'><input style='' type='text' value='$d4' onkeypress='return false;'></td>
		<td width='$td9w'><input style='' type='text' value='$d5' onkeypress='return false;'></td>
		<td width='$tdaw'><input style='' type='text' value='$d6' onkeypress='return false;'></td>
		<td width='$tdbw'><input style='' type='text' value='$d7' onkeypress='return false;'></td>
		<td width='$tdcw'><input style='' type='text' value='$d8' onkeypress='return false;'></td>
		<td width='".$tdw[20]."'><input style='' type='text' value='$co' onkeypress='return false;'></td>
		<td width='".$tdw[21]."'><input style='' type='text' value='$dmY' onkeypress='return false;'></td>
	</tr>";
	$res=mysql_query( "SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick
	 FROM $cows, $groups
	 WHERE $groups.id=$cows.gr_id
	 ORDER BY gr_id, cow_num*1" );
	$j=0;
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
//			if ( $div_hide!=1 ) echo "
//		<td $cjust width='".$tdw[1]."'>".$j."</td>";
			echo "
		<td $cjust title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 3, $contentCharset )."</td>
		<td width='$td5w'><input id='data1".$i."' maxlength='4' name='d1_[".$i."]' style='' type='text' value='$d1' onfocus='int_keyp( \"data1$i\", 1, 2500, 4 );' onclick='int_keyp( \"data1$i\", 1, 2500, 4 );' onkeypress='int_keyp( \"data1$i\", 1, 2500, 4 );'></td>
		<td width='$td6w'><input id='data2".$i."' maxlength='3' name='d2_[".$i."]' style='' type='text' value='$d2' onfocus='int_keyp( \"data2$i\", 1, 800, 3 );' onclick='int_keyp( \"data2$i\", 1, 800, 3 );' onkeypress='int_keyp( \"data2$i\", 1, 800, 3 );'></td>
		<td width='$td7w'><input id='data3".$i."' maxlength='4' name='d3_[".$i."]' style='' type='text' value='$d3' onfocus='int_keyp( \"data3$i\", 1, 1000, 4 );' onclick='int_keyp( \"data3$i\", 1, 1000, 4 );' onkeypress='int_keyp( \"data3$i\", 1, 1000, 4 );'></td>
		<td width='$td8w'><input id='data4".$i."' maxlength='4' name='d4_[".$i."]' style='' type='text' value='$d4' onfocus='int_keyp( \"data4$i\", 1, 2000, 4 );' onclick='int_keyp( \"data4$i\", 1, 2000, 4 );' onkeypress='int_keyp( \"data4$i\", 1, 2000, 4 );'></td>
		<td width='$td9w'><input id='data5".$i."' maxlength='4' name='d5_[".$i."]' style='' type='text' value='$d5' onfocus='int_keyp( \"data5$i\", 1, 1000, 4 );' onclick='int_keyp( \"data5$i\", 1, 1000, 4 );' onkeypress='int_keyp( \"data5$i\", 1, 1000, 4 );'></td>
		<td width='$tdaw'><input id='data6".$i."' maxlength='4' name='d6_[".$i."]' style='' type='text' value='$d6' onfocus='int_keyp( \"data6$i\", 1, 2500, 4 );' onclick='int_keyp( \"data6$i\", 1, 2500, 4 );' onkeypress='int_keyp( \"data6$i\", 1, 2500, 4 );'></td>
		<td width='$tdbw'><input id='data7".$i."' maxlength='3' name='d7_[".$i."]' style='' type='text' value='$d7' onfocus='int_keyp( \"data7$i\", 1, 200, 3 );' onclick='int_keyp( \"data7$i\", 1, 200, 3 );' onkeypress='int_keyp( \"data7$i\", 1, 200, 3 );'></td>
		<td width='$tdcw'><input id='data8".$i."' maxlength='4' name='d8_[".$i."]' style='' type='text' value='$d8' onfocus='int_keyp( \"data8$i\", 1, 2000, 4 );' onclick='int_keyp( \"data8$i\", 1, 2000, 4 );' onkeypress='int_keyp( \"data8$i\", 1, 2000, 4 );'></td>
		<td width='".$tdw[20]."'><input class='txt txt_h0' id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$inpS1; width:100%;' type='text' value='$co'></td>
		<td width='".$tdw[21]."'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false;' href=''><input class='txt txt_h0' id='date1".$i."' name='dates_[".$i."]' size='8' style='$inpS0; width:100%;' type='text' value='$dmY' onkeypress='return false;'></a></td>
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
