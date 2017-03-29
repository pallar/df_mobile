<?php
/* DF_2: oper/f_o_meas.php
oper ----4 (103) [measurings]
c: 09.01.2006
m: 24.03.2017 */

$dbt_ext="_o";//DON'T MOVE THIS BELOW!

$t0=$_GET["opertype"]; $t1=$_GET["sess_id"]; $t2=$_GET["row_date"]; $key=$_GET["key"];
if ( empty( $t0 ) & empty( $t1 ) & empty( $t2 ) & empty( $key )) return;

if ( strlen( $key )>8 ) {
	$nosession=1;
	$dmY=$t2;
	$co=$_GET["row17"];
	$d1=$_GET["row7"];
	$d2=$_GET["row8"];
	$d3=$_GET["row9"];
	$d4=$_GET["row10"];
	$d5=$_GET["row11"];
	$d6=$_GET["row12"];
	$d7=$_GET["row13"];
	$d8=$_GET["row14"];
	$div_hide=1;
} else {
	$nosession=-1;
	$dmY="";
	$co="";
	$d1="";
	$d2="";
	$d3="";
	$d4="";
	$d5="";
	$d6="";
	$d7="";
	$d8="";
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

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__103.php" );
	$dbt=$tmpdbt; include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
	include( "../oper/f_rcwsf1.php" );
} else {
	echo "
<script language='JavaScript' src='../dflib/f_input.js'></script>";
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date
	$td1w='10px';
	$td2w='60px';
	$td3w='60px';
	$td4w='60px';
	$td5w='20px';
	$td6w='20px';
	$td7w='20px';
	$td8w='20px';
	$td9w='20px';
	$tdaw='20px';
	$tdbw='20px';
	$tdcw='20px';
	$tddw='60px';
	$tdew='60px';
	if ( $div_hide!=1 ) {
		if ( count( $cows_arr )>99 ) $td1w='20px';
		if ( count( $cows_arr )>999 ) $td1w='30px';
	}
	if ( $varsession!=1 ) include_once( "../oper/f_oprwd.php" );
	if ( $userCoo!=9 ) echo "
<input class='btn gradient_0f0 btn_h0' id='add_oper' name='add_oper' style='width:200px' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype*1].")...'>&nbsp;";
	if ( $div_hide!=1 ) include_once( "../oper/f_dt.php" );//page's date
	else if ( $varsession!=1 & $userCoo!=9 ) echo "
&nbsp;<a onclick='sele_to_dele( \"co10\", \"".$php_mm["_06_forward_delete_btn_tip"]."\" ); return false' href=''>".$php_mm["_com_DELE_lnk_"]."</a>";
	echo "
<center>".$ged['mm'].":&nbsp;".
"(<b>1</b>&nbsp;-".$ged['Depth,Chest'].")&nbsp;(<b>2</b>&nbsp;-".$ged['Width,Chest'].
")&nbsp;(<b>3</b>&nbsp;-".$ged['Diam.,Chest'].")&nbsp;(<b>4</b>&nbsp;-".$ged['Height'].
")&nbsp;(<b>5</b>&nbsp;-".$ged['Width,Shoulder-blade'].")&nbsp;(<b>6</b>&nbsp;-".$ged['Slant._Len.'].
")&nbsp;(<b>7</b>&nbsp;-".$ged['Diam.,Wrist.'].
")&nbsp;&nbsp;<b>8</b>&nbsp;-".$ged['Brutto'].", ".$ged['kg']."</center>";
	if ( $div_hide!=1 ) echo "
<div style='height:59px; $thead_style'>";
	echo "
	<table id='OPER_TABLE' cellspacing='1' class='st2'>
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>";
	if ( $div_hide!=1 ) echo "
		<td rowspan='2' width='$td1w'>&nbsp;</td>";
	echo "
		<td rowspan='2' width='$td2w'>".$ged['Group']."</td>
		<td rowspan='2' width='$td3w'>".$ged['Number']."</td>
		<td rowspan='2' width='$td4w'>".$ged['Nick']."</td>
		<td rowspan='2' width='$td5w'>1</td>
		<td rowspan='2' width='$td6w'>2</td>
		<td rowspan='2' width='$td7w'>3</td>
		<td rowspan='2' width='$td8w'>4</td>
		<td rowspan='2' width='$td9w'>5</td>
		<td rowspan='2' width='$tdaw'>6</td>
		<td rowspan='2' width='$tdbw'>7</td>
		<td rowspan='2' width='$tdcw'>8</td>
		<td width='$tddw'>".$ged['Comment.']."</td>
		<td rowspan='2' width='$tdew'>".$ged['Date']."</td>
	</tr>
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>
		<td width='$tddw'>";
	if ( $userCoo!=9 & $div_hide!=1 ) echo "<input id='comments1' maxlength='255' name='comments1' style='$rw_style; height:23px' type='text' onkeyup='table_edits( \"comments1\", \"co1\" )'>"; else echo "&nbsp;";
	echo "</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px; $tbody_style'>
	<table cellspacing='1' class='st2'>";
	else if ( $varsession!=1 ) {
		GrTr();
		echo "
		<td width='$td2w'>&nbsp;</td>
		<td width='$td3w'>&nbsp;</td>
		<td width='$td4w'>&nbsp;</td>
		<td width='$td5w'><input style='$rr_style; height:18px' type='text' value='$d1' onkeypress='return false'></td>
		<td width='$td6w'><input style='$rr_style; height:18px' type='text' value='$d2' onkeypress='return false'></td>
		<td width='$td7w'><input style='$rr_style; height:18px' type='text' value='$d3' onkeypress='return false'></td>
		<td width='$td8w'><input style='$rr_style; height:18px' type='text' value='$d4' onkeypress='return false'></td>
		<td width='$td9w'><input style='$rr_style; height:18px' type='text' value='$d5' onkeypress='return false'></td>
		<td width='$tdaw'><input style='$rr_style; height:18px' type='text' value='$d6' onkeypress='return false'></td>
		<td width='$tdbw'><input style='$rr_style; height:18px' type='text' value='$d7' onkeypress='return false'></td>
		<td width='$tdcw'><input style='$rr_style; height:18px' type='text' value='$d8' onkeypress='return false'></td>
		<td width='$tddw'><input style='$rr_style; height:18px' type='text' value='$co' onkeypress='return false'></td>
		<td height='22px' width='$tdew'><input style='$rr_style; height:18px' type='text' value='$dmY' onkeypress='return false'></td>
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
			GrTr();
			if ( $div_hide!=1 ) echo "
		<td $cjust width='$td1w'>".$j."</td>";
			echo "
		<td $cjust height='22px' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 3, $contentCharset )."</td>
		<td style='background:#fff' width='$td5w'><input id='data1".$i."' maxlength='4' name='d1_[".$i."]' style='$rw_style; height:18px' type='text' value='$d1' onfocus='int_keyp( \"data1$i\", 1, 2500, 4 )' onclick='int_keyp( \"data1$i\", 1, 2500, 4 )' onkeypress='int_keyp( \"data1$i\", 1, 2500, 4 )'></td>
		<td style='background:#fff' width='$td6w'><input id='data2".$i."' maxlength='3' name='d2_[".$i."]' style='$rw_style; height:18px' type='text' value='$d2' onfocus='int_keyp( \"data2$i\", 1, 800, 3 )' onclick='int_keyp( \"data2$i\", 1, 800, 3 )' onkeypress='int_keyp( \"data2$i\", 1, 800, 3 )'></td>
		<td style='background:#fff' width='$td7w'><input id='data3".$i."' maxlength='4' name='d3_[".$i."]' style='$rw_style; height:18px' type='text' value='$d3' onfocus='int_keyp( \"data3$i\", 1, 1000, 4 )' onclick='int_keyp( \"data3$i\", 1, 1000, 4 )' onkeypress='int_keyp( \"data3$i\", 1, 1000, 4 )'></td>
		<td style='background:#fff' width='$td8w'><input id='data4".$i."' maxlength='4' name='d4_[".$i."]' style='$rw_style; height:18px' type='text' value='$d4' onfocus='int_keyp( \"data4$i\", 1, 2000, 4 )' onclick='int_keyp( \"data4$i\", 1, 2000, 4 )' onkeypress='int_keyp( \"data4$i\", 1, 2000, 4 )'></td>
		<td style='background:#fff' width='$td9w'><input id='data5".$i."' maxlength='4' name='d5_[".$i."]' style='$rw_style; height:18px' type='text' value='$d5' onfocus='int_keyp( \"data5$i\", 1, 1000, 4 )' onclick='int_keyp( \"data5$i\", 1, 1000, 4 )' onkeypress='int_keyp( \"data5$i\", 1, 1000, 4 )'></td>
		<td style='background:#fff' width='$tdaw'><input id='data6".$i."' maxlength='4' name='d6_[".$i."]' style='$rw_style; height:18px' type='text' value='$d6' onfocus='int_keyp( \"data6$i\", 1, 2500, 4 )' onclick='int_keyp( \"data6$i\", 1, 2500, 4 )' onkeypress='int_keyp( \"data6$i\", 1, 2500, 4 )'></td>
		<td style='background:#fff' width='$tdbw'><input id='data7".$i."' maxlength='3' name='d7_[".$i."]' style='$rw_style; height:18px' type='text' value='$d7' onfocus='int_keyp( \"data7$i\", 1, 200, 3 )' onclick='int_keyp( \"data7$i\", 1, 200, 3 )' onkeypress='int_keyp( \"data7$i\", 1, 200, 3 )'></td>
		<td style='background:#fff' width='$tdcw'><input id='data8".$i."' maxlength='4' name='d8_[".$i."]' style='$rw_style; height:18px' type='text' value='$d8' onfocus='int_keyp( \"data8$i\", 1, 2000, 4 )' onclick='int_keyp( \"data8$i\", 1, 2000, 4 )' onkeypress='int_keyp( \"data8$i\", 1, 2000, 4 )'></td>
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
