<?php
/* DF_2: oper/f_o_vacc.php
oper ---32 (106) [vaccination]
c: 09.01.2006
m: 20.02.2018 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!
$_list_height=$_list_height+90;

if ( strlen( $key )>8 ) {
	$vc_id="";
} else {
	$vc_id="";
}

/*$vcs=0;
$res=mysql_query( "SELECT id, code, nick FROM $vaccins", $db );
while ( $row=mysql_fetch_row( $res )) {
	$vcs_id[$vcs]=$row[0];
	$vcs_name[$vcs]=$row[2];
	if ( $vcs_id[$vcs]==$vc_id ) $vc_name=$row[2];
	$vcs++;
}*/

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__106.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	$tdw[2]="60px";
	$tdw[3]="60px";
	$tdw[4]="240px";
	$tdw[5]="70px";
	$tdw[20]="100px";
	$tdw[21]="170px";
//	$tdw[1]="10px";
//	if ( $div_hide!=1 ) {
//		if ( count( $cows_arr )>99 ) $td1w="20px";
//		if ( count( $cows_arr )>999 ) $td1w="30px";
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
		<td width='$td1w'>&nbsp;</td>
		<td width='$td2w'>".$ged["Group"]."</td>
		<td width='$td3w'>".$ged["Number"]."</td>
		<td width='$td4w'>".$ged["Nick"]."</td>";
	} else {
		$row=mysql_fetch_row( $res );
		echo "
		<td $ljust colspan='3'><font color='#0'>".$ged["Group"].":&nbsp;</font><font color='#aaa'>".$row[3]."</font><br><font color='#0'>".$ged["Number"].":&nbsp;</font><font color='#aaa'>".$row[1]."</font><br><font color='#0'>".$ged["Nick"].":&nbsp;</font><font color='#aaa'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>
	</tr>
	<tr $cjust>";
	}
	echo "
		<td width='$td5w'>&nbsp;</td>
		<td width='$tddw'>".$ged["Comment."]."</td>
		<td width='$tdew'>".$ged["Date"]."</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	<tr $cjust>
		<td width='$tddw'><input id='comments1' maxlength='255' name='comments1' style='' type='text' onkeyup='fill_tds( \"comments1\", \"co1\" )'></td>
	</tr>
	</table>
</div>
<div style='height:".$_list_height."px;'>
	<table>";
	$j=0;
	$res=mysql_query( $query );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) echo "
		<td $cjust rowspan='2' width='$td1w'>".$j."</td>
		<td $cjust height='22px' rowspan='2' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust rowspan='2' title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust rowspan='2' title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			if ( $varsession!=1 ) echo "
		<td width='$td5w'><input style='' type='text' value='$vc_name' onkeypress='return false;'></td>
		<td width='$tddw'><input style='' type='text' value='$co' onkeypress='return false;'></td>
		<td width='$tdew'><input style='' type='text' value='$dmY' onkeypress='return false;'></td>
	</tr>
	<tr>";
			echo "
		<td width='$td5w'>&nbsp;</td>
		<td width='".$tdw[20]."'><input class='txt txt_h0' id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$inpS1; width:100%;' type='text' value='$co'></td>
		<td width='".$tdw[21]."'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false;'><input class='txt txt_h0' id='date1".$i."' name='dates_[".$i."]' readonly size='8' style='$inpS0; width:100%;' type='text' value='$dmY' onkeypress='return false;'></a></td>
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
