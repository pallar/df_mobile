<?php
// DF_ajs: Update Group
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Zap special characters from updated data
$id = mysqli_real_escape_string($conn, $__data->id);
$num = mysqli_real_escape_string($conn, $__data->num);
$national_descr = mysqli_real_escape_string($conn, $__data->national_descr);
$nick = mysqli_real_escape_string($conn, $__data->nick);
$comments = mysqli_real_escape_string($conn, $__data->comments);
$__query = "UPDATE f__grs
 SET num='$num', national_descr='$national_descr', nick='$nick', comments='$comments'
 WHERE id=$id AND locked=''";
Sqli_query($__query);
echo $__data;
?>