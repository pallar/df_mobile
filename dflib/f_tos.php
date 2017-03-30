<?php
/* DF_2: dflib/f_tos.php
oxes list
c: 10.12.2005
m: 30.03.2017 */

if ( strlen( $oxes_title_ )<=0 ) $oxes_title_=$php_mm["_05_ostab_lnk_"].":&nbsp;".$php_mm["_05_list_"];
if ( strlen( $oxes_order_ )<=0 ) $oxes_order_="$oxes.num*1";

$i=0;
$res=mysql_query( "SELECT id, breed_id, gr_id, lot_id, subgr_id, mth_id, fth_id FROM $oxes", $db );
while ( $row=mysql_fetch_row( $res )) {
	$i++;
	$iid=$row[0]; $upd=0;
	$upd_query="UPDATE $oxes SET ";
	if ( $row[1]*1==0 ) { $upd=1; $upd_query=$upd_query."breed_id='1', "; }
	if ( $row[2]*1==0 ) { $upd=1; $upd_query=$upd_query."gr_id='1', "; }
	if ( $row[3]*1==0 ) { $upd=1; $upd_query=$upd_query."lot_id='1', "; }
	if ( $row[4]*1==0 ) { $upd=1; $upd_query=$upd_query."subgr_id='1', "; }
	if ( $row[5]*1==0 ) { $upd=1; $upd_query=$upd_query."mth_id='1', "; }
	if ( $row[6]*1==0 ) { $upd=1; $upd_query=$upd_query."fth_id='1', "; }
	$upd_query=trim( $upd_query );
	if ( $upd!=0 ) {
		$upd_query=substr( $upd_query, 0, strlen( $upd_query )-1 )." WHERE id='$iid'";
		mysql_query( $upd_query );
	}
}

if ( $nocardsfilt!=1 ) {//dont show when in reports mode
	echo "
<table width='100%'>
<tr height='40px'>
	<td style='padding:5px' width='150px'>";
	if ( $userCoo*1!=9 ) echo "
		<a href='$PHP_SELF?ox_add=$i'><u>".$php_mm["_com_INSE_lnk_"]."</u></a>";
	echo "
	</td>
</tr>
</table>";
}

$ox_add=$_GET["ox_add"];
$ox_del=$_GET["ox_del"];
$ox_edit=$_GET["ox_edit"];
$ox_find=$_GET["ox_find"];
if ( $ox_add==$i ) {
	$num="*.".$i;
	$nick="*.".$i.".".$now_Ymd.".".$now_His;
	mysql_query( "INSERT INTO $oxes (
	 `num`,
	 `created_date`, `created_time`,
	 `nick` )
	 VALUES (
	 '$num',
	 '$now_Ymd', '$now_His',
	 '$nick' )" );
	$i++;
}

if ( $nocardsfilt!=1 ) echo "
<div style='height:38px; overflow-y:scroll; width:100%'>";
echo "
<table width='100%'>
<tr $cjust style='height:28px'>
	<td width='60px'>".$ged["Number"]."</td>
	<td width='101px'>".$ged["Nick"]."</td>
	<td width='101px'>".$ged["Nat._Id."]."</td>
	<td width='65px'>".$ged["Birthday"]."</td>
	<td width='80px'>".$ged["Mom"]."</td>
	<td width='80px'>".$ged["Dad"]."</td>
	<td width='80px'>".$ged["Breed"]."</td>
	<td width='90px'>".$ged["Exter._Defects"]."</td>
	<td width='60px'>".$ged["Comment."]."</td>
</tr>
</table>";
if ( $nocardsfilt!=1 ) echo "
</div>
<div style='height:".$_list_height."px; overflow-y:scroll; width:100%'>
<table width='100%'>";
$res=mysql_query( "SELECT
 $oxes.id,
 $oxes.num, $oxes.nick,
 $oxes.national_descr,
 $oxes.b_num, $oxes.b_date,
 $cows.nick, father.nick,
 $breeds.nick,
 $groups.nick, $subgrs.nick, $lots.nick,
 $oxes.defects, $oxes.comments
 FROM $oxes, $oxes father, $cows, $breeds, $groups, $lots, $subgrs
 WHERE father.id=$oxes.fth_id AND
 $cows.id=$oxes.mth_id AND
 $breeds.id=$oxes.breed_id AND
 $groups.id=$oxes.gr_id AND
 $lots.id=$oxes.lot_id AND
 $subgrs.id=$oxes.subgr_id
 ORDER BY $oxes_order_", $db );
while ( $row=mysql_fetch_row( $res )) {
echo "
<tr ".RepTrCol().">";
	$oxnum=$cownum_div.$row[1].$cownum_div1;
	$bdt=substr( $row[5], 8, 2 ).".".substr( $row[5], 5, 2 ).".".substr( $row[5], 0, 4 );
	if ( $nocardsfilt!=1 ) echo "
	<td $rjust style='height:28px' width='60px' onmouseover='style.cursor=\"pointer\"'><b><a href='../".$hFrm['0530']."?id=".$row[0]."'>$oxnum</b></td>
	<td width='101px'><input readonly style='border:0; height:100%; font-size:12; width:99%' type='text' value='".$row[2]."'/></td>
	<td width='101px'><input readonly style='border:0; height:100%; font-size:12; width:99%' type='text' value='".$row[3]."'/></td>
	<td $cjust width='65px'>$bdt</td>
	<td width='80px'><input readonly style='border:0; height:100%; font-size:12; width:99%' type='text' value='".$row[6]."'/></td>
	<td width='80px'><input readonly style='border:0; height:100%; font-size:12; width:99%' type='text' value='".$row[7]."'/></td>
	<td width='80px'><input readonly style='border:0; height:100%; font-size:12; width:99%' type='text' value='".$row[8]."'/></td>
	<td width='90px'><input readonly style='border:0; height:100%; font-size:12; width:99%' type='text' value='".$row[12]."'/></td>
	<td width='60px'><input readonly style='border:0; height:100%; font-size:12; width:99%' type='text' value='".$row[13]."'/></td>";
	else echo "
	<td $rjust style='height:28px' onmouseover='style.cursor=\"pointer\"'><b><a href='../".$hFrm['0530']."?ox_id=".$row[0]."&cards_groups_tab=".$cards_groups_tab_."'>$oxnum</b></td>
	<td>".$row[2]."</td>
	<td>".$row[3]."</td>
	<td $cjust>$bdt</td>
	<td>".$row[6]."</td>
	<td>".$row[7]."</td>
	<td>".$row[8]."</td>
	<td>".$row[12]."</td>
	<td>".$row[13]."</td>";
	echo "
</tr>";
}
echo "
<tr $rjust style='height:28px'>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>";
	if ( $nocardsfilt!=1 ) echo "
</div>";
	else echo "
<br>";
?>
