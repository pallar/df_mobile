<?php
/* DF_2: oper/f_o_jagg.php
oper -8192 (114) [jagging and "disable milking"]
c: 10.08.2009
m: 24.03.2017 */

$t0=$_GET["opertype"]; $t1=$_GET["sess_id"]; $t2=$_GET["row_date"]; $key=$_GET["key"];
if ( empty( $t0 ) & empty( $t1 ) & empty( $t2 ) & empty( $key )) return;

if ( $key==-1 ) $nosession=1; else $nosession=-1;

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

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__114.php" );
	if ( strlen( $key )>8 ) $ret_url="../".$hRep['o'];
	else $ret_url="../".$hFrm['0600'];
	if ( strlen( $key )==8 ) $ret_url="../".$hFrm['0500'];
	Res_Draw( 1, $ret_url, "", "", $php_mm_tip[0] );
} else {
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date

	$_list_height=$_height-200;

	$td1w='10px';
	$td2w='60px';
	$td3w='60px';
	$td4w='130px';
	$td5w='70px';
	$tdew='60px';
	if ( $div_hide!=1 ) {
		if ( count( $cows_arr )>99 ) $td1w='20px';
		if ( count( $cows_arr )>999 ) $td1w='30px';
		$td5h="22px"; $td5d="&nbsp;&nbsp;";
	} else {
		$td5h=""; $td5d="<br>";
	}
	if ( $varsession!=1 ) include_once( "../oper/f_oprwd.php" );
	if ( $userCoo!=9 ) echo "
<input class='btn gradient_0f0 btn_h0' id='add_oper' name='add_oper' style='width:200px' type='$add_oper_type' value='".$php_mm["_com_forward_btn_"]."...' title='".$add_oper_tip."&nbsp;(".$opername[$opertype*1].")...'>&nbsp;";
	if ( $div_hide!=1 ) include_once( "../oper/f_dt.php" );//page's date
	if ( $varsession!=1 ) echo "<br><br>";
	echo "
<script language='JavaScript'>
function reset_all_keyp( i_ ) {
	for ( i=0; i<=5; i++ ) {
		var k=i_*1+i*10000;
		var k='date1'+k;
		var el=document.getElementById( String( k ));
		if ( null!=typeof( el )) el.value='01-01-1990';
	}
}
</script>";
	if ( $div_hide!=1 ) echo "
<div style='height:59px; $thead_style'>";
	echo "
	<table id='OPER_TABLE' cellspacing='1' class='st2'>
	<tr $cjust class='st_title2' style='font-weight:bold; height:54px'>";
	if ( $div_hide!=1 ) echo "
		<td width='$td1w'>&nbsp;</td>";
	echo "
		<td width='$td2w'>".$ged['Group']."</td>
		<td width='$td3w'>".$ged['Number']."</td>
		<td width='$td4w'>".$ged['Nick']."</td>
		<td width='$td5w'>".$ged['Interval']." 1"."</td>
		<td width='$td5w'>".$ged['Interval']." 2"."</td>
		<td width='$td5w'>".$ged['Interval']." 3"."</td>
		<td width='$td5w'>".$ged['Interval']." 4"."</td>
		<td width='$td5w'>".$ged['Interval']." 5"."</td>
		<td width='$tdew'>".$ged['Date']."</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px; $tbody_style'>
	<table cellspacing='1' class='st2'>";
	$res=mysql_query( "SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick
	 FROM $cows, $groups
	 WHERE $groups.id=$cows.gr_id
	 ORDER BY gr_id, cow_num*1", $db );
	$j=0;
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			GrTr();
			$i1=10000+$i*1; $i2=20000+$i*1; $i3=30000+$i*1; $i4=40000+$i*1; $i5=50000+$i*1;
			if ( $div_hide!=1 ) echo "
		<td rowspan='2' $cjust width='$td1w'>".$j."</td>";
			echo "
		<td $cjust height='22px' rowspan='2' title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td2w'>".StrCutLen1( $row[3], 7, $contentCharset )."</td>
		<td $rjust rowspan='2' title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>
		<td $cjust rowspan='2' title='".StrCutLen1( $row[2], 59, $contentCharset ) ."' width='$td4w'>".StrCutLen1( $row[2], 11, $contentCharset )."</td>
		<td height='22px' style='background:#fff' width='$td5w'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i1." ); return false' href=''><input id='date1".$i1."' name='dates_[".$i1."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a></td>
		<td height='22px' style='background:#fff' width='$td5w'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i2." ); return false' href=''><input id='date1".$i2."' name='dates_[".$i2."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a></td>
		<td height='22px' style='background:#fff' width='$td5w'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i3." ); return false' href=''><input id='date1".$i3."' name='dates_[".$i3."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a></td>
		<td height='22px' style='background:#fff' width='$td5w'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i4." ); return false' href=''><input id='date1".$i4."' name='dates_[".$i4."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a></td>
		<td height='22px' style='background:#fff' width='$td5w'><a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i5." ); return false' href=''><input id='date1".$i5."' name='dates_[".$i5."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a></td>
		<td rowspan='2' style='background:#fff' width='$tdew'>
			<a onclick='cal_u1( event, 0, 0 ); cal_load1( sender_=".$i." ); return false' href=''><input id='date1".$i."' name='dates_[".$i."]' size='8' style='$li_style; height:18px' type='text' value='$dmY' onkeypress='return false'></a>
			<a onclick='reset_all_keyp( ".$i." ); return false' href=''><input size='8' style='border:none; cursor:pointer; height:24px; width:100%' type='text' value='".$_06_reset_."' onkeypress='return false'></a>
		</td>
	</tr>";
		GrTr();
		echo "
		<td width='$td5w'>
			<input id='c1".$i1."' name='c1_[".$i1."]' style='cursor:pointer' title='".$php_mm["_com_s10_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s10_"], 0, 1, $contentCharset )."
			<input id='c2".$i1."' name='c2_[".$i1."]' style='cursor:pointer' title='".$php_mm["_com_s20_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s20_"], 0, 1, $contentCharset )."
			<input id='c3".$i1."' name='c3_[".$i1."]' style='cursor:pointer' title='".$php_mm["_com_s30_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s30_"], 0, 1, $contentCharset )."$td5d
			<input id='c9".$i1."' name='c9_[".$i1."]' style='cursor:pointer' title='$_06_every_second_day_' type='checkbox'>
		</td>
		<td width='$td5w'>
			<input id='c1".$i2."' name='c1_[".$i2."]' style='cursor:pointer' title='".$php_mm["_com_s10_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s10_"], 0, 1, $contentCharset )."
			<input id='c2".$i2."' name='c2_[".$i2."]' style='cursor:pointer' title='".$php_mm["_com_s20_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s20_"], 0, 1, $contentCharset )."
			<input id='c3".$i2."' name='c3_[".$i2."]' style='cursor:pointer' title='".$php_mm["_com_s30_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s30_"], 0, 1, $contentCharset )."$td5d
			<input id='c9".$i2."' name='c9_[".$i2."]' style='cursor:pointer' title='$_06_every_second_day_' type='checkbox'>
		</td>
		<td width='$td5w'>
			<input id='c1".$i3."' name='c1_[".$i3."]' style='cursor:pointer' title='".$php_mm["_com_s10_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s10_"], 0, 1, $contentCharset )."
			<input id='c2".$i3."' name='c2_[".$i3."]' style='cursor:pointer' title='".$php_mm["_com_s20_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s20_"], 0, 1, $contentCharset )."
			<input id='c3".$i3."' name='c3_[".$i3."]' style='cursor:pointer' title='".$php_mm["_com_s30_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s30_"], 0, 1, $contentCharset )."$td5d
			<input id='c9".$i3."' name='c9_[".$i3."]' style='cursor:pointer' title='$_06_every_second_day_' type='checkbox'>
		</td>
		<td width='$td5w'>
			<input id='c1".$i4."' name='c1_[".$i4."]' style='cursor:pointer' title='".$php_mm["_com_s10_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s10_"], 0, 1, $contentCharset )."
			<input id='c2".$i4."' name='c2_[".$i4."]' style='cursor:pointer' title='".$php_mm["_com_s20_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s20_"], 0, 1, $contentCharset )."
			<input id='c3".$i4."' name='c3_[".$i4."]' style='cursor:pointer' title='".$php_mm["_com_s30_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s30_"], 0, 1, $contentCharset )."$td5d
			<input id='c9".$i4."' name='c9_[".$i4."]' style='cursor:pointer' title='$_06_every_second_day_' type='checkbox'>
		</td>
		<td height='$td5h' width='$td5w'>
			<input id='c1".$i5."' name='c1_[".$i5."]' style='cursor:pointer' title='".$php_mm["_com_s10_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s10_"], 0, 1, $contentCharset )."
			<input id='c2".$i5."' name='c2_[".$i5."]' style='cursor:pointer' title='".$php_mm["_com_s20_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s20_"], 0, 1, $contentCharset )."
			<input id='c3".$i5."' name='c3_[".$i5."]' style='cursor:pointer' title='".$php_mm["_com_s30_"]."' type='checkbox'>".mb_substr( $php_mm["_com_s30_"], 0, 1, $contentCharset )."$td5d
			<input id='c9".$i5."' name='c9_[".$i5."]' style='cursor:pointer' title='$_06_every_second_day_' type='checkbox'>
		</td>
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
