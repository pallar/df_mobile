<?php
// DF_ajs: Update Ox
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Zap special characters from updated data
$id = mysqli_real_escape_string($conn, $__data->id);
$num = mysqli_real_escape_string($conn, $__data->num);
$b_date = mysqli_real_escape_string($conn, $__data->b_date);
$b_num = mysqli_real_escape_string($conn, $__data->b_num);
$nick = mysqli_real_escape_string($conn, $__data->nick);
$__query = "UPDATE f_oxes
 SET num='$num', b_date='$b_date', b_num='$b_num', nick='$nick'
 WHERE id=$id AND locked=''";
Sqli_query($__query);
echo $__data;
?>