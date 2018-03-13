<?php
// DF_ajs: Delete Cow
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
$__query = "DELETE FROM f_cows WHERE id=$__data->id AND locked=''";
Sqli_query($__query);
echo true;
?>