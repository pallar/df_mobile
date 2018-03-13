<?php
/* DF_2: oper/f_o_mlkt.php
oper ----2 (102) [milk testing]
c: 09.01.2006
m: 11.10.2017 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!
$_list_height=$_list_height+80;

if ( strlen( $key )>8 ) {
	$somop=$_GET["row8"];
	$somo1=$_GET["row9"];
	$fatp=$_GET["row10"];
	$albp=$_GET["row11"];
} else {
	$somop="";
	$somo1="";
	$fatp="";
	$albp="";
}

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__102.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	echo "
<script language='JavaScript' src='../dflib/f_input.js'></script>";
	$td2w="60px";
	$td3w="60px";
	$td4w="130px";
	$td5w="40px";
	$td6w="40px";
	$td7w="40px";
	$td8w="40px";
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
	if ( $div_hide==1 ) {
		$row=mysql_fetch_row( $res );
		echo "
		<td $ljust colspan='6'><font color='#0'>".$ged["Group"].":&nbsp;</font><font color='#aaa'>".$row[3]."</font><br><font color='#0'>".$ged["Number"].":&nbsp;</font><font color='#aaa'>".$row[1]."</font><br><font color='#0'>".$ged["Nick"].":&nbsp;</font><font color='#aaa'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>
	</tr>
	<tr $cjust class='st_title2' style='height:27px'>";
	} else echo "
		<td width='$td1w'>&nbsp;</td>
		<td width='$td3w'>".$ged["Group"]."</td>
		<td width='$td3w'>".$ged["Number"]."</td>
		<td width='$td4w'>".$ged["Nick"]."</td>";
	echo "
		<td width='$td5w'>".$ged["Somo,%"]."</td>
		<td width='$td6w'>".$ged["Somo,pieces"]."</td>
		<td width='$td7w'>".$ged["Fat,%"]."</td>
		<td width='$td8w'>".$ged["Albumen,%"]."</td>
		<td width='".$tdw[20]."'>".$ged["Comment."]."</td>
		<td width='".$tdw[21]."'>".$ged["Date"]."</td>
	</tr>
	<tr $cjust>
		<td width='".$tdw[20]."'>";
	if ( $div_hide!=1 ) echo "<input id='comments1' maxlength='255' name='comments1' style='$rwS0; height:23px;' type='text' onkeyup='fill_tds( \"comments1\", \"co1\" )'>"; else echo "&nbsp;";
	echo "</td>
	</tr>
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px;'>
	<table>";
	else if ( $varsession!=1 ) echo "
	<tr ".GrTrCol().">
		<td width='$td5w'><input style='' type='text' value='$somop' onkeypress='return false;'></td>
		<td width='$td6w'><input style='' type='text' value='$somo1' onkeypress='return false;'></td>
		<td width='$td7w'><input style='' type='text' value='$fatp' onkeypress='return false;'></td>
		<td width='$td8w'><input style='' type='text' value='$albp' onkeypress='return false;'></td>
		<td width='".$tdw[20]."'><input style='' type='text' value='$co' onkeypress='return false;'></td>
		<td width='".$tdw[21]."'><input style='' type='text' value='$dmY' onkeypress='return false;'></td>
	</tr>";
	$j=0;
	$res=mysql_query( $query, $db );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) echo "
		<td $cjust title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			echo "
		<td width='$td5w'><input id='d2".$i."' name='d2_[".$i."]' style='' type='text' value='$somop' onclick='real_keyp( \"d2$i\", 0, 15, 6, 3 );' onfocus='real_keyp( \"d2$i\", 0, 15, 6, 3 );' onkeypress='real_keyp( \"d2$i\", 0, 15, 6, 3 );'></td>
		<td width='$td6w'><input id='d3".$i."' name='d3_[".$i."]' style='' type='text' value='$somo1' onfocus='int_keyp( \"d3$i\", 0, 9999998, 7 );' onclick='int_keyp( \"d3$i\", 0, 9999998, 7 );' onkeypress='int_keyp( \"d3$i\", 0, 9999998, 7 );'></td>
		<td width='$td7w'><input id='d4".$i."' name='d4_[".$i."]' style='' type='text' value='$fatp' onclick='real_keyp( \"d4$i\", 0, 15, 6, 3 );' onfocus='real_keyp( \"d4$i\", 0, 15, 6, 3 );' onkeypress='real_keyp( \"d4$i\", 0, 15, 6, 3 );'></td>
		<td width='$td8w'><input id='d5".$i."' name='d5_[".$i."]' style='' type='text' value='$albp' onclick='real_keyp( \"d5$i\", 0, 15, 6, 3 );' onfocus='real_keyp( \"d5$i\", 0, 15, 6, 3 );' onkeypress='real_keyp( \"d5$i\", 0, 15, 6, 3 );'></td>
		<td width='".$tdw[20]."'><input class='txt txt_h0' id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$inpS1; width:100%;' type='text' value='$co'></td>
		<td width='".$tdw[21]."'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false;' href=''><input class='txt txt_h0' id='date1".$i."' name='dates_[".$i."]' size='8' style='$inpS0; width:100%;' type='text' value='$dmY' onkeypress='return false;'></a></td>
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
