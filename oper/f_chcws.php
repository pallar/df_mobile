<?php
/* DF_2: oper/f_chcws.php
form: cows operations: get cows from list
c: 09.01.2006
m: 02.06.2017 */

$_list_height=$_height-200;

ob_start();
?>

<script language='JavaScript'>
function visibility_chg( text, i ) {
	el=document.getElementById( String( text )+String( i ));
	el_style_visibility=el.style.visibility;
	el_style_display=el.style.display;
	if ( el_style_visibility=='hidden' ) el_style_visibility='visible';
	else el_style_visibility='hidden';
	if ( el_style_display=='none' ) el_style_display='';
	else el_style_display='none';
	el.style.visibility=el_style_visibility;
	el.style.display=el_style_display;
}
</script>

<?php
include( "../oper/f_opname.php" );

//Show group table title
function CwsGroupTableTitle_Show( $i, $ii ) {
	global $cjust, $ged, $userCoo;
	$iii=$i; while ( strlen( $iii )<4 ) $iii="0".$iii;
	echo "
			<tr $cjust class='st_title2' style='font-weight:bold; height:28px'>
				<td width='31px'>";
	if ( $userCoo>0 & $userCoo!=9 ) {
		if ( $i*1>=0 ) echo "
					<input class='y_chk' id='gr_cb$iii$ii' type='checkbox' onclick='gr_set0( \"$iii\", $ii, \"cw_cb\" )'>";
		else echo "
					<input class='y_chk' id='all_cb0000$ii' type='checkbox' onclick='all_set0( \"0000\", $ii, \"cw_cb\" )'>";
	}
	echo "
				</td>
				<td width='60px'>".$ged["Number"]."</td>
				<td>".$ged["Nick"]."</td>
			</tr>";
}

$filts0=CookieGet( "_filts0" )*1;
if (( $filts0&4 )==4 ) $filts0_3="checked"; else $filts0_3="";
if (( $filts0&32 )==32 ) $filts0_6="checked"; else $filts0_6="";

$op_php=$_GET["include"];
if ( $op_php."."!="." | $add_oper."."!="." ) {
	if ( $add_oper."."!="." ) {
		$opertype=$_GET["opertype"]*1;
		if ( $opertype==1 ) $url_='mlk';
		else if ( $opertype==2 ) $url_="mlkt";
		else if ( $opertype==4 ) $url_="meas";
		else if ( $opertype==8 ) $url_="care";
		else if ( $opertype==16 ) $url_="cond";
		else if ( $opertype==32 ) $url_="vacc";
		else if ( $opertype==64 ) $url_="mov";
		else if ( $opertype==128 | $opertype==256 ) $url_="insm";
		else if ( $opertype==512 ) $url_="rect";
		else if ( $opertype==1024 ) $url_="abrt";
		else if ( $opertype==2048 ) $url_="abrt";
		else if ( $opertype==4096 ) $url_="abrt";
		else if ( $opertype==8192 ) $url_="jagg";
		$op_php="f_o_".$url_.".php";
	}
	include( "f_opvars.php" );
	include( "$op_php" );
	return;
}

$res=mysql_query( "SELECT id, nick FROM $groups" );
while ( $row=mysql_fetch_row( $res )) {
	$gr_nick[$row[0]*1]=$row[1];
	$sess_str=$sess_str.$row[0].",";
}

$submit1=$_POST["submit1"];

if ( $submit1!="" ) {
	$cows_checkboxes=$_POST["cows_checkboxes"];
	$opertype=$_POST["opertype"]*1;
	$fo_scnt=count( $cows_checkboxes );//checked cows quantity
	if ( $fo_scnt<1 )
		Res_Draw( 3, $tmp_phpself."?opertype=$opertype", "", $php_mm["_com_no_selected_animals_"], $php_mm_tip[0] );
	else {
		$sess_str="";
		session_start(); $sess_id=session_id();
		$cows_arr=array_keys( $cows_checkboxes );
		for ( $i=0; $i<count( $cows_arr ); $i++ )
			$sess_str=$sess_str.$cows_arr[$i].",";
		$_SESSION["sess_cows.txt"]=$sess_str;
		if ( $opertype==1 ) $url_='mlk';
		else if ( $opertype==2 ) $url_="mlkt";
		else if ( $opertype==4 ) $url_="meas";
		else if ( $opertype==8 ) $url_="care";
		else if ( $opertype==16 ) $url_="cond";
		else if ( $opertype==32 ) $url_="vacc";
		else if ( $opertype==64 ) $url_="mov";
		else if ( $opertype==128 | $opertype==256 ) $url_="insm";
		else if ( $opertype==512 ) $url_="rect";
		else if ( $opertype==1024 ) $url_="abrt";
		else if ( $opertype==2048 ) $url_="abrt";
		else if ( $opertype==4096 ) $url_="abrt";
		else if ( $opertype==8192 ) $url_="jagg";
		Res_Draw( 1, $tmp_phpself."?include=f_o_".$url_.".php&div_hide=1&opertype=$opertype&sess_id=$sess_id", "", "", $php_mm_tip[0] );
	}
} else {
	$opertype=$_GET["opertype"]*1; if ( $opertype<1 ) $opertype=64;
	echo "

<form method='post' action='$tmp_phpself'>";
	$oper=mysql_query( "SELECT id, descr FROM $operstyp WHERE id>0 ORDER BY id" );
	$j=0;
	while ( $operrow=mysql_fetch_row( $oper )) {
		$opermyid[$j]=$operrow[0]*1; $opermydescr[$j]=$operrow[1];
		$j++;
	}
	echo "

<table width='100%'>
<tr>
	<td>
		<div class='b_h'>";
	if ( $userCoo>0 & $userCoo!=9 ) {
		$arr_menu[0]["url"]="";
		$arr_menu[0]["name"]="&nbsp;$title_&nbsp;";
		ArrMenu( $arr_menu );
		echo "
			<select class='sel sel_h0' name='opertype' style='width:200px'>";
		for ( $i=0; $i<count( $operspriv ); $i++ ) for ( $j=0; $j<count( $opermyid ); $j++ )
		if ( $opermyid[$j]==$operspriv[$i] ) {
//			if (( $userCoo==9 ) | (( $userCoo==3 ) & ( $opermyid[$j]*1<2 )));//oper #2 only for root
//			if (( $userCoo==9 ) | (( $userCoo==3 ) & ( $opermyid[$j]*1<1 )));
//			else {
				if ( $opertype==$opermyid[$j]*1 ) $cb_checked="checked";
				else $cb_checked="";
				$expl=explode( " ", $opermydescr[$j] ); $expl1=$expl[0];
				if ( strlen( $expl[1] )!=0 ) $expl1=$expl1."&nbsp;".substr( $expl[1], 0, 1).".";
				echo "
				<option value='".$opermyid[$j]."'>".$opermydescr[$j]."</option>";
//			}
		}
		mysql_free_result( $oper );
		echo "
			</select>";
	}
	echo "
		</div>
	</td>
</tr>
</table>
<table><tr><td height='3px'></td></tr></table>

<div class='mk' style='border:0; height:90px; margin:0; overflow-x:hidden; overflow-y:scroll; padding:10px 10px 0 10px;'>
	<table width='100%'>
	<tr $cjust>
		<td $ljust $vtjust>";
	if ( $userCoo!=9 ) echo "
			<input class='btn btn_h0 gradient_f00' style='width:91px' type='submit' name='submit1' value='".$php_mm["_com_forward_btn_"]."...'>";
	echo "
		</td>
		<td title='".$ged["filts0_3"]."' width='31px'>&nbsp;<input class='y_chk' type='checkbox' $filts0_3 id='f3' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_3~"]."</td>
		<td title='".$ged["filts0_6"]."' width='31px'>&nbsp;<input class='y_chk' type='checkbox' $filts0_6 id='f6' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_6~"]."</td>
	</tr>
	<tr height='10px'><td colspan='3'></td></tr>
	<tr>
		<td colspan='3' $vtjust>
			<table cellspacing='1' class='st2'>";
	CwsGroupTableTitle_Show( -1, 0 );
	echo "
			</table>
		</td>
	</tr>
	</table>
</div>
<table><tr><td height='3px'></td></tr></table>

<div class='mk' style='border:0; height:".$_list_height."px; margin:0; overflow-x:hidden; overflow-y:scroll; padding:10px 10px 0 10px;'>";
	include( "../dflib/f_setcbs.js" );
	$groups_arr=split( ",", $sess_str );
	for ( $i=0; $i<count( $groups_arr )-1; $i++ ) {
		$grnick=$gr_nick[$groups_arr[$i]];
		$iii=$i; while ( strlen( $iii )<4 ) $iii="0".$iii;
		echo "
	<table cellspacing='1' class='st2' style='width:100%'>
	<tr $cjust>
		<td width='31px' title='".$php_mm["_com_select_all_in_group_"]." \"$grnick\""."' $vtjust>";
		if ( $userCoo>0 & $userCoo!=9 ) echo "
			<input class='y_chk' id='gr_cb".$iii."0' type='checkbox' onclick='gr_set0( \"$iii\", 0, \"cw_cb\" )'>";
		echo "
		</td>
		<td $ljust $vtjust title='".$ged["Group"]." \"$grnick\"'>
			<input class='btn btn_h0 gradient_0f0' style='width:55px' type='button' onclick='visibility_chg( \"group\", $i )' value='+/-'>&nbsp;&nbsp;".$ged["Group"]." \"<b>$grnick</b>\"
		</td>
	</tr>
	</table>
	<table cellspacing='1' class='st2' id='group$i' style='width:100%;'>";
	$query="SELECT
	 $cows.id, $cows.cow_num, $cows.nick,
	 $cows.z_dates
	 FROM $cows, $groups
	 WHERE $cows.gr_id=".$groups_arr[$i]." AND $cows.gr_id=$groups.id";
	if ( $filts0_3=="checked" & $filts0_6=="" )
		$query=$query." AND $cows.z_dates<>''";
	if ( $filts0_3=="" & $filts0_6=="checked" )
		$query=$query." AND $cows.z_dates=''";
	if ( $filts0_3!="checked" & $filts0_6!="checked" )
		$query=$query." AND 1=2";
	$query=$query." ORDER BY $cows.cow_num*1";
	$res=mysql_query( $query, $db );
	$k=0;
	while ( $row=mysql_fetch_row( $res )) {
			echo "
	<tr ".GrTrCol().">";
		$kk=$k+1;
		$z_col="black"; if ( strlen( $row[3] )>0 ) $z_col="red";
		echo "
		<td $cjust style='height:28px; width:31px'>";
		if ( $userCoo>0 & $userCoo!=9 ) echo "
			<input class='y_chk' id='cw_cb$iii$k' name='cows_checkboxes[".$row[0]."]' type='checkbox' onclick='test0( \"$iii\", \"cw_cb\" )'>";
		echo "
		</td>
		<td $rjust style='color:$z_col; width:60px'><b>".$cownum_div.$row[1].$cownum_div1."</b></td>
		<td title='".$row[2]."'>".StrCutLen1( $row[2], 47, $contentCharset )."&nbsp;</td>
	</tr>";
		$k++;
	}
	$groups_arr_cnt[$i]=$k;
	echo "
	</table>
	<table><tr height='10px'><td></td></tr></table>";
	}
}
echo "
</div>

</form>

</body>
</html>";

ob_end_flush();
?>
