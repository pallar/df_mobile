<?php
// DF_ajs: Get Cows
require_once "_db_conn.php";
$arr = array();
$__data = json_decode(file_get_contents("php://input"));
$__query = "SELECT
 id, cow_num, b_date, b_num, nick, locked
 FROM f_cows";
$__id="$__data->__id"; $__id=$__id*1;
if ($__id!=0) $__query=$__query."
 WHERE id!=$__id";
$__query=$__query."
 ORDER BY cow_num*1 ASC LIMIT 50";
$__res = Sqli_query($__query);
if(mysqli_num_rows($__res) != 0)
	while($__row = mysqli_fetch_assoc($__res)) $arr[] = $__row;
// Return json array containing data from the database
echo $json_info = json_encode($arr);
?>