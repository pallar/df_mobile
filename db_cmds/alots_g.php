<?php
// DF_ajs: Get Lots
require_once "_db_conn.php";
$arr = array();
$__query = "SELECT
 id, num, national_descr, nick, comments
 FROM f__lots
 ORDER BY nick ASC";
$__res = mysqli_query($conn, $__query);
if(mysqli_num_rows($__res) != 0)
	while($__row = mysqli_fetch_assoc($__res)) $arr[] = $__row;
// Return json array containing data from the database
echo $json_info = json_encode($arr);
?>