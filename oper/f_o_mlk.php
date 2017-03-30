<?php
/* DF_2: oper/f_o_mlk.php
oper ----1 (101) [milking]
c: 09.01.2006
m: 30.03.2017 */

$t0=$_GET["opertype"]; $t1=$_GET["sess_id"]; $t2=$_GET["row_date"]; $key=$_GET["key"];
if ( empty( $t0 ) & empty( $t1 ) & empty( $t2 ) & empty( $key )) return;

$div_hide=-1;
if ( strlen( $key )>8 ) {
	$nosession=1;
	$old_dmY=$t2;
	include_once( "../f_vars0.php" );
	include_once( "../f_myadm.php" );
	$dbtkeys=split( ':', $key );
	$dbt=$dbtkeys[0]; $outsele_=$dbtkeys[1]*1; $sess_str=$dbtkeys[2]*1;
	$query="SELECT
	 d.cow_id,
	 d.day, d.month, d.year,
	 d.milk_kg,
	 d.milk_begin, d.milk_end,
	 d.milk_time,
	 d.id_time, d.rep_time,
	 d.manual, d.retries, d.stopped, d.exhaust,
	 d.mast_4,
	 d.tr, d.ov,
	 d.bd_num,
	 c.cow_num, c.nick, d.milk_sess,
	 d.kg_30s, d.kg_60s, d.kg_90s,
	 d.code
	 FROM $dbt d, $cows c
	 WHERE c.id=d.cow_id AND d.code=$sess_str";
	$res=mysql_query( $query, $db );
	$error=mysql_errno();
	$row=mysql_fetch_row( $res );
	$old_dmY=$row[1]."-".$row[2]."-".$row[3];
	$old_kg=$row[4];
	$old_kg0=$row[21]; $old_kg1=$row[22]; $old_kg2=$row[23];
	$old_beg=$row[5];
	$old_dur=$row[7];
	$old_dev=$row[17];
	$old_retries=$row[11];
	$div_hide="1";
} else {
	$nosession=-1;
	$dmY="";
	$old_kg="";
	$old_kg0=""; $old_kg1=""; $old_kg2="";
	$old_beg="";
	$old_dur="";
	$old_dev="";
	$old_retries="";
	$key="";
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
	include( "../locales/$lang/f_rrm._$lang" );
	include( "../locales/$lang/f_060001._$lang" );
}

if ( strlen( $key )>8 ) $add_oper_tip=$php_mm["_06_forward_update_btn_tip"];
else $add_oper_tip=$php_mm["_06_forward_btn_tip"];

$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) {
	include( "../oper/f_o__101.php" );
	$dbt=$tmpdbt;
	if ( $err1==0 ) include( "../oper/f_opres.php" );
	mysql_query( "DROP TABLE IF EXISTS $tmpdbt" );
} else {
	echo "
<script language='JavaScript' src='../dflib/f_input.js'></script>
<script language='JavaScript'>
function milksess_keyp( i_ ) {
	var k='_sess'+i_;
	var el=document.getElementById( String( k ));
	if ( null!=typeof( el )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event ) ?window.event.keyCode:e.which;
			if ( keyCode=='48' || keyCode=='49' || keyCode=='50' ||
			 keyCode=='8' || keyCode=='0' ) return true;
			else return false;
		}
	}
}
</script>";
	echo "
<script language='JavaScript' src='../dflib/f_input.js'></script>";
	include_once( "../oper/f_dtdiv.php" );//<tr>'s date
	$td1w='10px';
	$td2w='40px';
	$td3w='60px';
	$td4w='60px';
	$td5w='20px';
	$td9w='30px';
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
	$query="SELECT $cows.id, $cows.cow_num, $cows.nick, $groups.nick FROM $cows, $groups WHERE $groups.id=$cows.gr_id";
	if ( $varsession!=1 ) { $query.=" ORDER BY gr_id, cow_num*1"; } else $query.=" AND $cows.id=$cow_id";
	$res=mysql_query( $query, $db );
	if ( $div_hide!=1 ) echo "
<div style='height:59px; $thead_style'>";
	echo "
	<table id='OPER_TABLE' class='st2'>";
	if ( $div_hide==1 ) {
		$row=mysql_fetch_row( $res );
		echo "
	<tr class='st_title2' style='font-weight:bold; height:27px'>
		<td colspan='17'>".$ged['Group'].":&nbsp;<font color='red'>".$row[3]."</font><br>".$ged['Number'].":&nbsp;<font color='red'>".$row[1]."</font><br>".$ged['Nick'].":&nbsp;<font color='red'>".StrCutLen1( $row[2], 59, $contentCharset )."</font></td>
	</tr>
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>";
	} else echo "
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>
		<td rowspan='2' width='$td1w'>&nbsp;</td>
		<td rowspan='2' width='$td3w'>".$ged['Group']."</td>
		<td rowspan='2' width='$td3w'>".$ged['Number']."</td>";
	echo "
		<td colspan='4'>".$ged['Milk'].",".$ged['kg']."</td>
		<td colspan='3'>".$ged['Time']."</td>
		<td rowspan='2' title='".$ged["Dev."]."' width='$td5w'>".$ged["Dev.~"]."</td>
		<td rowspan='2' title='".$ged["Start_manual"]."' width='$td5w'>".$ged["Start_manual~"]."</td>
		<td rowspan='2' title='".$ged["Start_retr."]."' width='$td5w'>".$ged["Start_retr.~"]."</td>
		<td rowspan='2' title='".$ged["Break_done"]."' width='$td5w'>".$ged["Break_done~"]."</td>
		<td rowspan='2' title='".$ged["Exhaust"]."' width='$td5w'>".$ged["Exhaust~"]."</td>
		<td colspan='2' title='".$ged["M."]."' width='$td5w'>".$ged["M.~"]."</td>
		<td rowspan='2' title='".$ged["T."]."' width='$td5w'>".$ged["T.~"]."</td>
		<td rowspan='2' title='".$ged["O."]."' width='$td5w'>".$ged["O.~"]."</td>
		<td rowspan='2' width='$tdew'>".$ged['Date']."</td>
	</tr>
	<tr $cjust class='st_title2' style='font-weight:bold; height:27px'>
		<td width='$td5w'>&nbsp;</td>
		<td title='".$ged["00-30s,kg_tip"]."' width='$td9w'>".PhraseCarry( $ged["00-30s,kg"], ",", 1 )."</td>
		<td title='".$ged["31-60s,kg_tip"]."' width='$td9w'>".PhraseCarry( $ged["31-60s,kg"], ",", 1 )."</td>
		<td title='".$ged["61-90s,kg_tip"]."' width='$td9w'>".PhraseCarry( $ged["61-90s,kg"], ",", 1 )."</td>
		<td width='$td2w'>".$ged['beg.t']."</td>
		<td width='$td2w'>".$ged['duration']."</td>
		<td width='$td9w'>&nbsp;</td>
		<td width='$td5w'>&nbsp;</td>
		<td title='".$ged["M.d/~"]."' width='$td5w'>1..</td>
	</tr>";
	if ( $div_hide!=1 ) echo "
	</table>
</div>
<div style='height:".$_list_height."px; $tbody_style'>
	<table class='st2'>";
	$j=0;
	$res=mysql_query( $query, $db );
	while ( $row=mysql_fetch_row( $res )) {
		for ( $i=0; $i<count( $cows_arr ); $i++ ) { if ( $row[0]-$cows_arr[$i]==0 ) {
			$j++;
			echo "
	<tr ".GrTrCol().">";
			if ( $div_hide!=1 ) echo "
		<td $cjust width='$td1w'>".$j."</td>
		<td $cjust title='".StrCutLen1( $row[3], 59, $contentCharset )."' width='$td3w'>".StrCutLen1( $row[3], 5, $contentCharset )."</td>
		<td $rjust title='".$cownum_div.$row[1].$cownum_div1."' width='$td3w'><b>".$cownum_div.StrCutLen1( $row[1], 9, $contentCharset ).$cownum_div1."</b></td>";
			echo "
		<td height='22px' width='$td5w'><input id='kg".$i."' maxlength='4' name='arr_kg[".$i."]' size='1' style='$rw_style; height:100%' type='text' value='$old_kg' onclick='real_keyp( \"kg$i\", 0, 30, 4, 1 )' onfocus='real_keyp( \"kg$i\", 0, 30, 4, 1 )' onkeypress='real_keyp( \"kg$i\", 0, 30, 4, 1 )'></td>
		<td width='$td9w'><input id='kg0".$i."' maxlength='4' name='arr_kg0[".$i."]' size='1' style='$rw_style; height:100%' type='text' value='$old_kg0' onclick='real_keyp( \"kg0$i\", 0, 15, 4, 1 )' onfocus='real_keyp( \"kg0$i\", 0, 15, 4, 1 )' onkeypress='real_keyp( \"kg0$i\", 0, 15, 4, 1 )'></td>
		<td width='$td9w'><input id='kg1".$i."' maxlength='4' name='arr_kg1[".$i."]' size='1' style='$rw_style; height:100%' type='text' value='$old_kg1' onclick='real_keyp( \"kg1$i\", 0, 15, 4, 1 )' onfocus='real_keyp( \"kg1$i\", 0, 15, 4, 1 )' onkeypress='real_keyp( \"kg1$i\", 0, 15, 4, 1 )'></td>
		<td width='$td9w'><input id='kg2".$i."' maxlength='4' name='arr_kg2[".$i."]' size='1' style='$rw_style; height:100%' type='text' value='$old_kg2' onclick='real_keyp( \"kg2$i\", 0, 15, 4, 1 )' onfocus='real_keyp( \"kg2$i\", 0, 15, 4, 1 )' onkeypress='real_keyp( \"kg2$i\", 0, 15, 4, 1 )'></td>
		<td width='$td2w'><input id='_beg".$i."' maxlength='8' name='arr_beg[".$i."]' size='3' style='$rw_style; height:100%' type='text' value='$old_beg' onclick='time_keyp( \"_beg".$i."\", \"His\" )' onfocus='time_keyp( \"_beg".$i."\", \"His\" )' onkeypress='time_keyp( \"_beg".$i."\", \"His\" )'></td>
		<td width='$td2w'><input id='_dur".$i."' maxlength='5' name='arr_dur[".$i."]' size='3' style='$rw_style; height:100%' type='text' value='$old_dur' onclick='time_keyp( \"_time".$i."\", \"is\" )' onfocus='time_keyp( \"_time".$i."\", \"is\" )' onkeypress='time_keyp( \"_dur".$i."\", \"is\" )'></td>
		<td width='$td9w'><select id='_sess".$i."' name='arr_sess[".$i."]' style='$li_style; height:100%'>";
			$res1=mysql_query( "SELECT id, name FROM $sessions", $db );
			while ( $row1=mysql_fetch_row( $res1 )) echo "<option value='".$row1[0]."'>".$row1[1]."</option>";
			echo "</select></td>
		<td width='$td5w'><input id='bd".$i."' maxlength='2' name='arr_bd[".$i."]' size='1' style='$rw_style; height:100%' type='text' value='$old_dev' onclick='int_keyp( \"bd$i\", 0, 96, 2 )' onfocus='int_keyp( \"bd$i\", 0, 96, 2 )' onkeypress='int_keyp( \"bd$i\", 0, 96, 2 )'></td>
		<td width='$td5w'><input class='y_chk' id='notag".$i."' name='arr_notag[".$i."]' type='checkbox'></td>
		<td width='$td5w'><input id='retr".$i."' maxlength='1' name='arr_retr[".$i."]' size='1' style='$rw_style; height:100%' type='text' value='$old_retries' onclick='retries_keyp( ".$i." )' onfocus='retries_keyp( ".$i." )' onkeypress='retries_keyp( ".$i." )'></td>
		<td width='$td5w'><input class='y_chk' id='stopped".$i."' name='arr_stopped[".$i."]' type='checkbox'></td>
		<td width='$td5w'><input class='y_chk' id='exhaust".$i."' name='arr_exhaust[".$i."]' type='checkbox'></td>
		<td width='$td5w'><input class='y_chk' id='mast".$i."' name='arr_m[".$i."]' type='checkbox'></td>
		<td width='$td5w'><input id='mast4".$i."' maxlength='4' name='arr_m4[".$i."]' size='2' style='$rw_style; height:100%' type='text' onfocus='mastitus_keyp( \"mast4$i\" )' onclick='mastitus_keyp( \"mast4$i\" )' onkeypress='mastitus_keyp( \"mast4$i\" )'></td>
		<td width='$td5w'><input class='y_chk' id='tr".$i."' name='arr_t[".$i."]' type='checkbox'></td>
		<td width='$td5w'><input class='y_chk' id='ov".$i."' name='arr_o[".$i."]' type='checkbox'></td>
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
