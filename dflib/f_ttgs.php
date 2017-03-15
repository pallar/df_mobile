<?php
/* DF_2: dflib/f_ttgs.php
tags list
c: 30.12.2011
m: 15.03.2017 */

echo "
<script language='JavaScript' src='../dflib/f_input.js'></script>
<script language='JavaScript' src='../dflib/f_ttgs_u.js'></script>";

$j=0;
$n_len=6;
$s_len=5;
$res=mysql_query( "SELECT rfid_mode FROM $globals", $db ); $row=mysql_fetch_row( $res );
$rfid_mode=$row[0];

$tags_order=$_GET["tags_order"]; if ( strlen( $tags_order )<=0 ) $tags_order="rfid_native";

if ( $tags_order=="$tags.cow_num*1" ) {
	$num_order="&nabla;";
	$tag_order="";
} elseif ( $tags_order=="rfid_native" ) {
	$num_order="";
	$tag_order="&nabla;";
}

$now_Ymd=date( "Y-m-d" ); $now_His=date( "H:i:s" );

$send_buf=$_POST["send_buf"];
if ( $send_buf!="" ) {
	$res1=mysql_query( "SELECT stall_num, cow_num, rfid_native FROM $tags", $db );
	while ( $row1=mysql_fetch_row( $res1 )) {
		$s=$row1[0]*1; $n=$row1[1]*1; $t=$row1[2];
		if ( $n>0 ) {
			$res=mysql_query( "SELECT id, rfid_native FROM $cows WHERE cow_num='$n'", $db ); $row=mysql_fetch_row( $res );
			$cnid1=0;
			if ( $row!="" ) {
				$cnid=$row[0];
				if ( !empty( $row[1] )) $cnid1=$row[0];
			} else $cnid=0;
			$res=mysql_query( "SELECT id FROM $cows WHERE rfid_native='$t'", $db ); $row=mysql_fetch_row( $res );
			if ( $row!="" ) $tnid=$row[0]; else $tnid=0;
			if ( $rfid_mode==3 ) {
				$res=mysql_query( "SELECT id FROM $cows WHERE stall_num='$s'", $db ); $row=mysql_fetch_row( $res );
			}
			if ( $row!="" ) $snid=$row[0]; else $snid=0;
			if ( $snid!=0 & $snid==$cnid ) $snid=0;
			if ( $cnid1!=0 | $snid!=0 ) {
				if ( $cnid!=0 & $cnid==$tnid ) Sql_query( "DELETE FROM $tags WHERE rfid_native='$t'" );
				else {
					$query="UPDATE $tags SET cow_num='$n' WHERE rfid_native='$t'";
					if ( Sql_query( $query )==0 )
						if ( $rfid_mode==3 ) Sql_query( "UPDATE $tags SET stall_num='$s' WHERE rfid_native='$t'" );
				}
			} else {
				if ( $cnid==0 & $tnid==0 ) {
					$query="INSERT INTO $cows (
					 `created_date`, `created_time`,
					 `cow_num`,
					 `rfid_date`, `rfid_time`, `rfid_num`, `rfid_native` )
					 VALUES (
					 '$now_Ymd', '$now_His',
					 '$n',
					 '$now_Ymd', '$now_His', '$t', '$t' )";
					if ( Sql_query( $query )==0 ) {
						if ( $rfid_mode==3 ) Sql_query( "UPDATE $cows SET stall_num='$s' WHERE rfid_native='$t'" );
						Sql_query( "DELETE FROM $tags WHERE rfid_native='$t'" );
					}
				} else {
					if ( $tnid!=0 ) {
						$query="UPDATE $cows SET
						 rfid_date='$now_Ymd', rfid_time='$now_His', rfid_num='', rfid_native=''
						 WHERE id='$tnid'";
					} else {
						$query="SELECT id FROM $cows WHERE rfid_native='$t'";
					}
					if ( Sql_query( $query )==0 ) {
						if ( $cnid==0 )
							$query="INSERT INTO $cows (
							 `created_date`, `created_time`,
							 `cow_num`,
							 `rfid_date`, `rfid_time`, `rfid_num`, `rfid_native` )
							 VALUES (
							 '$now_Ymd', '$now_His',
							 '$n',
							 '$now_Ymd', '$now_His', '$t', '$t' )";
						else
							$query="UPDATE $cows SET
							 rfid_date='$now_Ymd', rfid_time='$now_His', rfid_num='$t', rfid_native='$t'
							 WHERE id='$cnid'";
						if ( Sql_query( $query )==0 ) {
							if ( $rfid_mode==3 ) Sql_query( "UPDATE $cows SET stall_num='$s' WHERE rfid_native='$t'" );
							Sql_query( "DELETE FROM $tags WHERE rfid_native='$t'" );
						}
					}
				}
			}
		}
	}
	Res_Draw( 2, "../".$hFrm["0500"], "", "", $php_mm_tip[0] );

} else {
	if ( $nocardsfilt!=1 ) echo "
<table width='100%'>
<tr height='40px'>
	<td style='padding:5px' width='150px'></td>
	<td><input class='btn gradient_0f0' name='send_buf' style='width:140px' type='submit' value='".$php_mm["_com_accept_btn_"]."'></td>
	<td></td>
</tr>
</table>
<div style='height:38px; width:100%; overflow-y:scroll'>";
	echo "
<table width='100%'>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th style='width:60px'>".$ged["Number"].$num_order."</th>
	<th>".$ged["TAG"].$tag_order."</th>";
	if ( $rfid_mode==3 ) echo "
	<th style='width:60px'>Stall</th>";
	echo "
</tr>
</thead>";
	if ( $nocardsfilt!=1 ) echo "
</table>
</div>
<div style='height:60%; width:100%; overflow-y:scroll'>
<table width='100%'>";
	echo "
<tbody id='rep_tbody'>";
	$query="SELECT
	 cow_num,
	 rfid_native, rfid_num, rfid_date, rfid_time, stall_num
	 FROM $tags";
	$query=$query."
	 ORDER BY ".$tags_order;
	$res=mysql_query( $query, $db );
	while ( $row=mysql_fetch_row( $res )) {
		$jj=Int2StrZ( $j, 4 );
		if ( empty( $row[0] )) {
			$el_col="#003366"; $cownum="";
		} else {
			$el_col="red"; $cownum=$row[0];
		}
		echo "
<tr>
	<td id='hilight[$jj]' style='height:28px; width:60px'><input id='n$jj' maxlength='$n_len' name='n$jj' size='$n_len' style='background-color:white; border:none; color:$el_col; font:9pt Tahoma,sans-serif; width:100%; height:18px' type='text' value='$cownum' onfocus='int_keyp( \"n$jj\", 1, 999999, $n_len )' onclick='int_keyp( \"n$jj\", 1, 999999, $n_len )' onkeypress='int_keyp( \"n$jj\", 1, 999999, $n_len )'";
		if ( $userCoo!=9 ) echo "onkeyup='Ttgs__cow_num__Update( \"$row[1]\", this.value )'>";
		echo "</td>
	<td><input id='t$jj' maxlength='0' name='t$jj' size='0' style='$rw_style; height:18px' type='text' value='$row[1]' onkeypress='return false'></td>";
		if ( $rfid_mode==3 ) {
			echo "
	<td id='hilight[$jj]' style='height:28px; width:60px'><input id='s$jj' maxlength='$s_len' name='s$jj' size='$s_len' style='background-color:white; border:none; font:9pt Tahoma,sans-serif; width:100%; height:18px' type='text' value='$row[5]' onkeypress='return false'";
			if ( $userCoo!=9 ) echo "onkeyup='Ttgs__stall_num__Update( \"$row[1]\", this.value )'>"; echo "</td>";
		}
		echo "
</tr>";
		$j++;
	}
	echo "
</tbody>
<tfoot id='rep_tfoot'>
<tr $rjust height='28px'>
	<td style='width:60px'>".$j."&nbsp;</td>
	<td>&nbsp;</td>";
	if ( $rfid_mode==3 ) echo "
	<td style='width:60px'>&nbsp;</td>";
	echo "
</tr>
</tfoot>
</table>";
	if ( $nocardsfilt!=1 ) echo "
</div>";
	else echo "
<br>";
}
?>
