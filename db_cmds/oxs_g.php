<?php
// DF_ajs: Get Oxes
require_once "_db_conn.php";
$arr = array();
$__query = "SELECT
 id, num, b_date, b_num, nick
 FROM f_oxes
 ORDER BY num*1 ASC";
$__res = mysqli_query($conn, $__query);
if(mysqli_num_rows($__res) != 0)
	while($__row = mysqli_fetch_assoc($__res)) $arr[] = $__row;
// Return json array containing data from the database
echo $json_info = json_encode($arr);
?>