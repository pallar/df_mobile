<?php
// DF_ajs: Insert Ox
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Zap special characters from submitting data
$num = mysqli_real_escape_string($conn, $__data->num);
$b_date = mysqli_real_escape_string($conn, $__data->b_date);
$b_num = mysqli_real_escape_string($conn, $__data->b_num);
$nick = mysqli_real_escape_string($conn, $__data->nick);
$__query = "INSERT INTO f_oxes
 (num, b_date, b_num, nick)
 VALUES ('$num', '$b_date', '$b_num', '$nick')";
Sqli_query($__query);
echo true;
?>