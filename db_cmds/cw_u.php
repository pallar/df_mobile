<?php
// DF_ajs: Update Cow
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Zap special characters from updated data
$id = mysqli_real_escape_string($conn, $__data->id);
$b_date = mysqli_real_escape_string($conn, $__data->b_date);
$b_num = mysqli_real_escape_string($conn, $__data->b_num);
$national_descr = mysqli_real_escape_string($conn, $__data->n_descr);
$cow_num = mysqli_real_escape_string($conn, $__data->cow_num);
$nick = mysqli_real_escape_string($conn, $__data->nick);
$rfid_num = mysqli_real_escape_string($conn, $__data->tag_num);
$breed_id = mysqli_real_escape_string($conn, $__data->bid);
$lot_id = mysqli_real_escape_string($conn, $__data->lid);
$gr_id = mysqli_real_escape_string($conn, $__data->gid);
$subgr_id = mysqli_real_escape_string($conn, $__data->sgid);
$mom_id = mysqli_real_escape_string($conn, $__data->momid);
$dad_id = mysqli_real_escape_string($conn, $__data->dadid);
$comments = mysqli_real_escape_string($conn, $__data->comments);
$defects = mysqli_real_escape_string($conn, $__data->defects);
if($mom_id*1==0) $mom_id=1;
if($dad_id*1==0) $dad_id=1;
$__query = "UPDATE f_cows SET
 cow_num='$cow_num', nick='$nick', rfid_num='$rfid_num', rfid_native='$rfid_num',
 comments='$comments', defects='$defects',
 b_date='$b_date', b_num='$b_num', national_descr='$national_descr',
 breed_id='$breed_id', gr_id='$gr_id', subgr_id='$subgr_id', lot_id='$lot_id',
 mth_id='$mom_id', fth_id='$dad_id'
 WHERE id=$id AND locked=''";
Sqli_query($__query);
echo $__data;
?>