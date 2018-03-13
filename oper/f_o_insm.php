<?php
/* DF_2: oper/f_o_insm.php
oper --128/--256 (108/109) [insemination]
c: 09.01.2006
m: 20.02.2018 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!
$_list_height=$_list_height+80;

if ( strlen( $key )>8 ) {
	$ox_id=$_GET["row14"];
} else {
	$ox_id="";
}

$oxs=0;
$res=mysql_query( "SELECT id, nick FROM $oxes" );
while ( $row=mysql_fetch_row( $res )) {
	$oxs_id[$oxs]=$row[0];
	$oxs_nick[$oxs]=$row[1];
	if ( $oxs_id[$oxs]==$ox_id ) $ox_nick=$row[1];
	$oxs++;
}

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__108.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	$tdw[2]="60px";
	$tdw[3]="60px";
	$tdw[4]="140px";
	$tdw[5]="50px";
	$tdw[20]="100px";
	$tdw[21]="170px";
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
<div class='mk' style='border:0; $theadS0; height:59px;'>";
	else if ( $nosession==1 ) echo "<br><br>";
	echo "
	<table id='OPER_TABLE' style='width:100%;'>
	<tbody id='rep_tbody'>
	<tr $cjust style='height:27px;'>";
	if ( $div_hide!=1 ) {
		echo "
		<td width='".$tdw[2]."'>".$ged["Group"]."</td>
		<td width='".$tdw[3]."'>".$ged["Number"]."</td>
		<td width='".$tdw[4]."'>".$ged["Nick"]."</td>";
	} else {
		$row=mysql_fetch_row( $res );
		echo "
		<td $ljust colspan='3'><font color='#0'>".$ged["Group"].":&nbsp;</font><font color='#aaa'>".$row[3]."</font><br><font color='#0'>".$ged["Number"].":&nbsp;</font><font color='#aaa'>".$row[1]."</font><br><font color='#0'>".$ged["Nick"].":&nbsp;</font><font color='#aaa'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>
	</tr>
	<tr $cjust style='height:27px;'>";
	}
	echo "
		<td width='".$tdw[5]."'>".$ged["Bull_Nick"]."</td>
		<td width='".$tdw[20]."'>".$ged["Comment."]."</td>
		<td width='".$tdw[21]."'>".$ged["Date"]."</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	<tr $cjust style='height:27px;'>
		<td width='".$tdw[20]."'><input id='comments1' maxlength='255' name='comments1' style='height:23px;' type='text' onkeyup='fill_tds( \"comments1\", \"co1\" )'></td>
	</tr>
	</table>
</div>
<div style='height:".$_list_height."px;'>
	<table>
	<tbody id='rep_tbody'>";
	$j=0;
	$res=mysql_query( $query );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) echo "
		<td $cjust title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='".$tdw[2]."'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust title='".$cownum_div.$row[1].$cownum_div1."' width='".$tdw[3]."'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='".$tdw[4]."'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			if ( $varsession!=1 ) echo "
		<td width='".$tdw[5]."'><input class='txt txt_h0' style='$disS0;' type='text' value='$ox_nick' onkeypress='return false;'></td>
		<td width='".$tdw[6]."'><input class='txt txt_h0' style='$disS1;' type='text' value='$co' onkeypress='return false;'></td>
		<td width='".$tdw[7]."'><input class='txt txt_h0' style='$disS0;' type='text' value='$dmY' onkeypress='return false;'></td>
	</tr>
	<tr>";
			echo "
		<td><select class='txt txt_h0' name='oxs_[".$i."]' style='$inpS0; width:100%;'>";
			for ( $ox=0; $ox<$oxs; $ox++ ) {
				$val="value='".$oxs_id[$ox]."'";
				if ( $nosession==1 && $oxs_nick[$ox]==$ox_nick ) $val.=" selected";
				echo "<option $val>".$oxs_nick[$ox]."</option>";
			}
			echo "</select></td>
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
