<?php
// DF_ajs: Insert Group
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Escaping special characters from submitting data & storing in new variables
$num = mysqli_real_escape_string($conn, $__data->num);
$national_descr = mysqli_real_escape_string($conn, $__data->national_descr);
$comments = mysqli_real_escape_string($conn, $__data->comments);
$nick = mysqli_real_escape_string($conn, $__data->nick);
$__query = "INSERT INTO f__grs
 (num, national_descr, nick, comments)
 VALUES ('$num', '$national_descr', '$nick', '$comments')";
mysqli_query($conn, $__query);
echo true;
?>