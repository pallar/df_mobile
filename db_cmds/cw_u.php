<?php
// DF_ajs: Update Cow
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Zap special characters from updated data
$id = mysqli_real_escape_string($conn, $__data->id);
$b_date = mysqli_real_escape_string($conn, $__data->cur_cw_b_date);
$b_num = mysqli_real_escape_string($conn, $__data->cur_cw_b_num);
$national_descr = mysqli_real_escape_string($conn, $__data->cur_cw_national_descr);
$cow_num = mysqli_real_escape_string($conn, $__data->cur_cw_cow_num);
$nick = mysqli_real_escape_string($conn, $__data->cur_cw_nick);
$rfid_num = mysqli_real_escape_string($conn, $__data->cur_cw_rfid_num);
$breed_id = mysqli_real_escape_string($conn, $__data->cur_cw_breed_id);
$lot_id = mysqli_real_escape_string($conn, $__data->cur_cw_lot_id);
$gr_id = mysqli_real_escape_string($conn, $__data->cur_cw_gr_id);
$subgr_id = mysqli_real_escape_string($conn, $__data->cur_cw_subgr_id);
$mom_id = mysqli_real_escape_string($conn, $__data->cur_cw_mom_id);
$dad_id = mysqli_real_escape_string($conn, $__data->cur_cw_dad_id);
$comments = mysqli_real_escape_string($conn, $__data->cur_cw_comments);
$defects = mysqli_real_escape_string($conn, $__data->cur_cw_defects);
$__query = "UPDATE f_cows SET
 cow_num='$cow_num', nick='$nick', rfid_num='$rfid_num', rfid_native='$rfid_num',
 comments='$comments', defects='$defects',
 b_date='$b_date', b_num='$b_num', national_descr='$national_descr'
 WHERE id=$id";
//$__query = "UPDATE f_cows SET
// cow_num='$cow_num', nick='$nick', rfid_num='$rfid_num', rfid_native='$rfid_num',
// mth_id='$mom_id', fth_id='$dad_id',
// comments='$comments', defects='$defects',
// b_date='$b_date', b_num='$b_num', national_descr='$national_descr'
// WHERE id=$id";
Sql_query($__query);
echo $__data;
?>