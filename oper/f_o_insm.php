<?php
/* DF_2: oper/f_o_insm.php
oper --128/--256 (108/109) [insemination]
c: 09.01.2006
m: 09.10.2017 */

$dbt_ext="_o";//DONT MOVE THIS BELOW!

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
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date
	$tdw[2]="60px";
	$tdw[3]="60px";
	$tdw[4]="140px";
	$tdw[5]="50px";
	$tdw[6]="60px";
	$tdw[7]="60px";
//	$tdw[1]="10px";
//	if ( $div_hide!=1 ) {
//		if ( count( $cows_arr )>99 ) $tdw[1]="20px";
//		if ( count( $cows_arr )>999 ) $tdw[1]="30px";
//	}
	if ( $varsession!=1 ) include_once( "../oper/f_oprwd.php" );
	$query="SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $groups.id=$cows.gr_id";
	if ( $div_hide!=1 ) $query.=" ORDER BY gr_id, cow_num*1"; else $query.=" AND $cows.id=$cow_id";
	$res=mysql_query( $query );
	echo "
<table><tr><td height='3px'></td></tr></table>
<div class='mk' style='border:0; height:90px; margin:0; overflow-x:hidden; overflow-y:scroll;'>";
	if ( $userCoo!=9 ) echo "
	<input class='btn btn_h0 gradient_0f0' id='add_oper' name='add_oper' style='width:200px' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype].")...'>&nbsp;";
	if ( $div_hide!=1 ) include_once( "../oper/f_dt.php" );//page's date
	else if ( $varsession!=1 & $userCoo!=9 ) echo "&nbsp;<a onclick='sele_to_dele( \"co10\", \"".$php_mm["_06_forward_delete_btn_tip"]."\" ); return false;' href=''>".$php_mm["_com_DELE_lnk_"]."</a>";
	echo "
</div>";
	if ( $div_hide!=1 ) echo "
<div style='$theadS0; height:59px;'>";
	else if ( $nosession==1 ) echo "<br><br>";
	echo "
	<table id='OPER_TABLE'>
	<thead id='rep_thead'>
	<tr $cjust style='height:27px;'>";
	if ( $div_hide!=1 ) {
		$rowspan="rowspan='2'";
		echo "
<!--		<td rowspan='2' width='".$tdw[1]."'>&nbsp;</td>-->
		<td rowspan='2' width='".$tdw[2]."'>".$ged["Group"]."</td>
		<td rowspan='2' width='".$tdw[3]."'>".$ged["Number"]."</td>
		<td rowspan='2' width='".$tdw[4]."'>".$ged["Nick"]."</td>";
	} else {
		$row=mysql_fetch_row( $res );
		echo "
		<td $ljust colspan='3'><font color='#0'>".$ged["Group"].":&nbsp;</font><font color='#aaa'>".$row[3]."</font><br><font color='#0'>".$ged["Number"].":&nbsp;</font><font color='#aaa'>".$row[1]."</font><br><font color='#0'>".$ged["Nick"].":&nbsp;</font><font color='#aaa'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>
	</tr>
	<tr $cjust style='height:27px;'>";
	}
	echo "
		<td $rowspan width='".$tdw[5]."'>".$ged["Bull_Nick"]."</td>
		<td width='".$tdw[6]."'>".$ged["Comment."]."</td>
		<td $rowspan width='".$tdw[7]."'>".$ged["Date"]."</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	<tr $cjust style='height:27px;'>
		<td width='".$tdw[6]."'><input id='comments1' maxlength='255' name='comments1' style='height:23px;' type='text' onkeyup='fill_tds( \"comments1\", \"co1\" )'></td>
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
		<td $cjust rowspan='2' width='$td1w'>".$j."</td>
		<td $cjust height='22px' rowspan='2' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust rowspan='2' title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust rowspan='2' title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			if ( $varsession!=1 ) echo "
		<td width='$td5w'><input class='txt txt_h0' style='$disS0;' type='text' value='$ox_nick' onkeypress='return false;'></td>
		<td width='$tddw'><input class='txt txt_h0' style='$disS1;' type='text' value='$co' onkeypress='return false;'></td>
		<td width='$tdew'><input class='txt txt_h0' style='$disS0;' type='text' value='$dmY' onkeypress='return false;'></td>
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
		<td><input class='txt txt_h0' id='co1".$i."' name='co_[".$i."]' maxlength='255' style='$inpS1;' type='text' value='$co'></td>
		<td><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false;' href=''><input class='txt txt_h0' id='date1".$i."' name='dates_[".$i."]' size='8' style='$inpS0; width:100%;' type='text' value='$dmY' onkeypress='return false'></a></td>
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
?>
