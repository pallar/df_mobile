<?php
/* DF_ajs: _view/f__1_0b.php
f__1st0.php's ajax back
c: 25.12.2005
m: 31.03.2017 */

include( "../_view/f__1__.php" );
$width=CookieGet( "_width" )*1; if ( $width==0 ) $width=801;
if ( $width>800 ) { $fcs0=3; $fcs1=8; } else { $fcs0=2; $fcs1=7; }
$hcs=$fcs0+$fcs1;
if ( $devs<$devs_onmnemo ) $devs_onpage=$devs-1; else $devs_onpage=$devs_onmnemo-1;
$dev_last=$dev_1st+$devs_onpage;

$_RESULT="
<table cellspacing='1' class='st'>
<tr $cjust class='st_title' style='height:28px'>
	<td $ljust colspan='".$hcs."' title='".$powermode_title."'>&nbsp;".$powermode."</td>
</tr>
<tr $cjust class='st_title2'>
	<td width='20px'>&nbsp;".$php_mm["_00_devnum_column_"]."&nbsp;</td>
	<td width='130px'>".$php_mm["_00_devstat_column_"]."</td>";
if ( $width>800 ) $_RESULT.="
	<td>".$php_mm["_00_cow_column_"]."</td>";
$_RESULT.="
	<td colspan='2'>".$php_mm["_00_milkvol_column_"]."</td>
	<td colspan='3' title='".$ged["Start_manual"]." ".$ged["Start_retr."]." ".$ged["Break_done"]."'>".$ged["Start_manual~"].",&nbsp;".$ged["Start_retr.~"].",&nbsp;".$ged["Break_done~"]."</td>";
if ( $width>800 ) $_RESULT.="
	<td width='70px'>".$ged["M.~"]."</td>
	<td colspan='2' width='40px'>".$ged["T.~"].",&nbsp;".$ged["O.~"]."</td>";
echo "
</tr>";

$res=mysql_query( "SELECT
 bd_num, dev_status,
 id_date, id_time, rep_date, rep_time,
 cow_num, rfid_num, nick,
 milk_kg, milk_time,
 manual,
 retries,
 stopped,
 exhaust,
 mast, mast_4, tr, ov,
 modif_date, modif_time,
 dev_status_, locked
 FROM $parlor
 WHERE bd_num*1>=$dev_1st AND
 bd_num*1<=$dev_last" );
while ( $row=mysql_fetch_row( $res )) {
	$connected='';
	$bd_num=$row[0]*1;
	$bd_state=trim( $row[1] );
	$id_date=trim( $row[2] ); $id_time=trim( $row[3] );
	$rep_date=trim( $row[4] ); $rep_time=trim( $row[5] );
	$cow_num=trim( $row[6] );
	$cow_rfid=trim( $row[7] );
	$cow_nick=trim( $row[8] );
	$cow_style=$ljust." bgcolor='".$row[22]."'";
	$m=trim( $row[9]."kg" ); if ( $m=="kg" ) $m=""; else $m=$row[9];
	$retries=$row[12]*1; if ( $retries==0 ) $retries="&nbsp;";
	$dev_status_=trim( $row[21] );
	$dev_status=$dev_status_;//device's last useful status, not current
	include( "../httpmon/devstats.php" );
	if ( $cow_num.$cow_rfid.$cow_nick!="" ) {
		$cow_inf=$cow_num.", ".$cow_rfid.", ".$cow_nick;
		if ( strlen( $cow_inf )>35 ) {
			$cow_inf_0=$cow_inf;
			$cow_inf=mb_substr( $cow_inf, 0, 35, $contentCharset )."...";
		}
//---------------------- ERROR! SEARCH MUST BE DONE ON $cow_num, NOT $cow_rfid
		if ( $cow_rfid!="" ) {
			$res1=mysql_query( "SELECT
			 dont_use
			 FROM $cows
			 WHERE rfid_num='$cow_rfid'");
			$row1=mysql_fetch_row( $res1 );
//			$cow_inf=$cow_inf." ".$cow_rfid;
			if (( $row1[0] & 32768 )*1==32768 ) $cow_inf="<b>".$cow_inf."</b>";
		}
//----------------------------------------------------------------------------
	} else $cow_inf="";
	$dev_bgcolor="#0";
	if ( $bd_state==$php_m[772] )//version
		$dev_color="#f09000";
	elseif ( $bd_state==$php_m[771] )//RFID updating
		$dev_color="#9a5050";
	elseif ( $bd_state==$php_m[770] )//RFID
		$dev_color="#caca09";
	elseif ( $bd_state==$php_m[769] )//cow number
		$dev_color="#caca09";
	elseif ( $bd_state==$php_m[768] )//report done
		$dev_color="#00a000";
	elseif ( $bd_state==$php_m[767] )//connection
		$dev_color="#ea0000";
	elseif ( $bd_state==$php_m[766] )//intDB overflow
		$dev_color="#ea0000";
	elseif ( $bd_state==$php_m[765] )//error
		$dev_color="#ea0000";
	elseif ( $bd_state==$php_m[764] )//report ready
		$dev_color="#00a000";
	elseif ( $bd_state==$php_m[763] )//milking
		$dev_color="#b000b0";
	elseif ( $bd_state==$php_m[762] )//device ready (waiting)
		$dev_color="#00af00";//"#1f1f1f"
	elseif ( $bd_state==$php_m[761] )//device washing
		$dev_color="#00aaff";
	else
		$dev_color="#aa0000";
	$dev_style="color:".$dev_color;
	if ( $dev_bgcolor!="#0" ) $dev_style="background:".$dev_bgcolor."; ".$dev_style;
	if ( $dev_status_=="a" )
		$connected=$id_date.",&nbsp;".$id_time;
	elseif ( $dev_status_=="x" )
		$connected=$id_date.",&nbsp;".$id_time;
	elseif ( $dev_status_=="i" )
		$connected=$id_date.",&nbsp;".$id_time;
	elseif ( $dev_status_=="r" )
		$connected=$rep_date.",&nbsp;".$rep_time;
	else
		$connected=$rep_date.",&nbsp;".$rep_time;
	$connected=$dev_status."<br>".$row[19]."&nbsp;".$rep_time;
	if ( $row[14]=="+" ) $m_color="#ff0000"; else $m_color="#000000";
	$dev_style="style='".$dev_style."'";
	if ( $trans!=1 ) $phase=$bd_state; else { $phase=$connected; $dev_style=""; }
	$_RESULT=$_RESULT."
<tr $cjust ".GrTrCol().">
	<td $cjust style='height:32px'>$bd_num</td>
	<td $dev_style'>$phase</td>";
	if ( $width>800 ) $_RESULT.="
	<td $cow_style title='$cow_inf_0'>&nbsp;$cow_inf</td>";
	$_RESULT.="
	<td $rjust style='color:$m_color' width='45px'>$m&nbsp;</td>
	<td $rjust style='color:$m_color' width='51px'>".$row[10]."&nbsp;</td>
	<td width='20px'>".$row[11]."</td>
	<td width='30px'>$retries</td>
	<td width='20px'>".$row[13]."</td>";
	if ( $width>800 ) $_RESULT.="
	<td>".$row[15]."&nbsp;".$row[16]."</td>
	<td width='20px'>".$row[17]."</td>
	<td width='20px'>".$row[18]."</td>";
	echo "
</tr>";
}

$_RESULT=$_RESULT."
<tr class='st_title2' style='height:28px'>
	<td colspan='".$fcs0."'>&nbsp;".$php_mm["_00_devs_"].":".$devs_ok."/".$devs."&nbsp;</td>
	<td $rjust colspan=".$fcs1.">".$php_mm["_00_transact_"].":".$trans."&nbsp;</td>
</tr>";

$res=mysql_query( "SELECT milk_kg FROM $parlor WHERE bd_num='A1'" );
$row=mysql_fetch_row( $res ); $m10=$row[0]*1;
$res=mysql_query( "SELECT milk_kg FROM $parlor WHERE bd_num='A2'" );
$row=mysql_fetch_row( $res ); $m20=$row[0]*1;
$res=mysql_query( "SELECT milk_kg FROM $parlor WHERE bd_num='A3'" );
$row=mysql_fetch_row( $res ); $m30=$row[0]*1;
$m40=$m10+$m20+$m30;
$mXX=$m10.":".$m20.":".$m30.":".$m40.":";
$m=split( ":", $mXX );
for ( $j=0; $j<4; $j++ ) {
	$_RESULT=$_RESULT."
<tr ".GrTrCol().">";
	$i=($j+1)*10; $i="_00_tot_".$i."_";
	$_RESULT=$_RESULT."
	<td colspan='".$fcs0."'>&nbsp;".$php_mm[$i].":</td>
	<td $rjust>".$m[$j]."&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>";
	if ( $width>800 ) $_RESULT.="
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>";
	echo "
</tr>";
	}

$_RESULT=$_RESULT."
</table>";

Dbase_disconnect();
?>
