<?php
// DF_ajs: Get Cow Details
require_once "_db_conn.php";
$arr = array();
$__data = json_decode(file_get_contents("php://input"));
$__query = "SELECT
 id, b_date, b_num, national_descr,
 cow_num, nick, rfid_num,
 breed_id, lot_id, gr_id, subgr_id,
 mth_id, fth_id,
 comments, defects
 FROM f_cows
 WHERE id=$__data->id";
$__res = mysqli_query($conn, $__query);
if(mysqli_num_rows($__res) != 0)
	while($__row = mysqli_fetch_assoc($__res)) $arr[] = $__row;
// Return json array containing data from the database
echo $json_info = json_encode($arr);
?>