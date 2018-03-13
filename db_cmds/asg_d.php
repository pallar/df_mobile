<?php
// DF_ajs: Delete Lot
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
$__query = "DELETE FROM f__sgrs WHERE id=$__data->id AND locked=''";
Sqli_query($__query);
echo true;
?>