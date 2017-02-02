<?php
// DF_ajs: Insert Cow
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Escaping special characters from submitting data & storing in new variables
$cow_num = mysqli_real_escape_string($conn, $__data->cow_num);
$b_date = mysqli_real_escape_string($conn, $__data->b_date);
$b_num = mysqli_real_escape_string($conn, $__data->b_num);
$nick = mysqli_real_escape_string($conn, $__data->nick);
$__query = "INSERT INTO f_cows
 (cow_num, b_date, b_num, nick)
 VALUES ('$cow_num', '$b_date', '$b_num', '$nick')";
mysqli_query($conn, $__query);
echo true;
?>