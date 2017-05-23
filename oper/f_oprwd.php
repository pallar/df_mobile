<?php
/* DF_2: oper/f_oprwd.php
group operations rewind menu
c: 25.05.2006
m: 23.05.2017 */

echo "
<form method='post' action='$tmp_phpself?opertype=$opertype&sess_id=$sess_id'>
<input type='hidden' id='ret0' name='ret0' value='$ret0'>
<input type='hidden' id='cow_id' name='cow_id' value='$cow_id'>
<div class='b_h'>";
$arr_menu[0]["url"]="";
$arr_menu[0]["name"]="&nbsp;".$title_."&nbsp;<input class='txt txt_h0' id='key' name='key' type='text' value='$key' onkeypress='return false;'>&nbsp;</font>&nbsp;<select class='sel sel_h0' style='width:100px'><option></option></select>";
if ( $nosession!=1 ) {
}
ArrMenu( $arr_menu );
echo "</div><br>";
?>
