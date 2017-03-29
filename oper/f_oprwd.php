<?php
/* DF_2: oper/f_oprwd.php
group operations rewind menu
created: 25.05.2006
modified: 11.11.2015 */

echo "
<form method='post' action='$PHP_SELF?opertype=$opertype&sess_id=$sess_id&f_chcws_php=$f_chcws_php'>
<input type='hidden' id='ret0' name='ret0' value='$ret0'>
<input type='hidden' id='cow_id' name='cow_id' value='$cow_id'>
<table width='100%'>
<tr>
	<td>
		<div class='b_h'>";
$arr_menu[0]["url"]="";
$arr_menu[0]["name"]="&nbsp;".$title_."&nbsp;<input class='cards_title' id='key' name='key' style='border:0' value='$key' onkeypress='return false;'>&nbsp;</font>";
if ( $nosession!=1 ) {
	$arr_menu[1]["url"]="../".$hFrm['0600']."?opertype=$opertype title='".$php_mm["_06_ret_to_level1_tip"]."'";
	$arr_menu[1]["name"]="<font style='color:#00509d; font:10pt Tahoma,sans-serif; line-height:28px'>".$php_mm["_06_ret_to_level1_"]."</font>";
}
ArrMenu( $arr_menu );
echo "</div>
	</td>
</tr>
</table><br>";
?>
