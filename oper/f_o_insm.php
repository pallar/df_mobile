<?php
/* DF_2: oper/f_o_insm.php
oper --128/--256 (108/109) [insemination]
c: 09.01.2006
m: 24.03.2017 */

$dbt_ext="_o";//DON'T MOVE THIS BELOW!

$t0=$_GET["opertype"]; $t1=$_GET["sess_id"]; $t2=$_GET["row_date"]; $key=$_GET["key"];
if ( empty( $t0 ) & empty( $t1 ) & empty( $t2 ) & empty( $key )) return;

if ( strlen( $key )>8 ) {
	$keys=split( ":", $key ); $cow_id=$keys[2];
	$nosession=1;
	$dmY=$t2;
	$ox_id=$_GET["row14"];
	$co=$_GET["row17"];
	$div_hide=1;
} else {
	$nosession=-1;
	$dmY="";
	$ox_id="";
	$co="";
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

$oxs=0;
$res=mysql_query( "SELECT id, nick FROM $oxes", $db );
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
	$td1w="10px";
	$td2w="60px";
	$td3w="60px";
	$td4w="140px";
	$td5w="50px";
	$tddw="60px";
	$tdew="60px";
	if ( $div_hide!=1 ) {
		if ( count( $cows_arr )>99 ) $td1w="20px";
		if ( count( $cows_arr )>999 ) $td1w="30px";
	} else {
		$td5w="200px";
		$tddw="350px";
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
	if ( $div_hide!=1 ) {
		echo "
		<td rowspan='2' width='$td1w'>&nbsp;</td>
		<td rowspan='2' width='$td2w'>".$ged['Group']."</td>
		<td rowspan='2' width='$td3w'>".$ged['Number']."</td>
		<td rowspan='2' width='$td4w'>".$ged['Nick']."</td>";
		$rowspan_="rowspan='2'";
	} else {
		$row=mysql_fetch_row( $res );
		echo "
		<td $ljust colspan='3'><font color='#0'>".$ged['Group'].":&nbsp;</font><font color='#aaa'>".$row[3]."</font><br><font color='#0'>".$ged['Number'].":&nbsp;</font><font color='#aaa'>".$row[1]."</font><br><font color='#0'>".$ged['Nick'].":&nbsp;</font><font color='#aaa'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>
	</tr>
	<tr $cjust class='st_title2' style='height:27px'>";
	}
	echo "
		<td $rowspan_ width='$td5w'>".$ged['Bull_Nick']."</td>
		<td width='$tddw'>".$ged['Comment.']."</td>
		<td $rowspan_ width='$tdew'>".$ged['Date']."</td>
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
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			GrTr();
			if ( $div_hide!=1 ) echo "
		<td $cjust rowspan='2' width='$td1w'>".$j."</td>
		<td $cjust height='22px' rowspan='2' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust rowspan='2' title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust rowspan='2' title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>";
			if ( $varsession!=1 ) echo "
		<td width='$td5w' ><input style='$rr_style; height:18px' type='text' value='$ox_nick' onkeypress='return false'></td>
		<td width='$tddw'><input style='$rr_style; height:18px' type='text' value='$co' onkeypress='return false'></td>
		<td width='$tdew'><input style='$rr_style; height:18px' type='text' value='$dmY' onkeypress='return false'></td>
	</tr>
	<tr>";
			echo "
		<td style='background:#fff' width='$td5w'><select name='oxs_[".$i."]' style='$li_style; height:18px'>";
			for ( $ox=0; $ox<$oxs; $ox++ ) {
				$val="value='$oxs_id[$ox]'";
				if ( $nosession==1 && $oxs_nick[$ox]==$ox_nick ) $val.=" selected";
				echo "<option $val>$oxs_nick[$ox]</option>";
			}
			echo "</select></td>
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
?>
