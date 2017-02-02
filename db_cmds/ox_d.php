<?php
// DF_ajs: Delete Ox
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
$__query = "DELETE FROM f_oxes WHERE id=$__data->id";
mysqli_query($conn, $__query);
echo true;
?>