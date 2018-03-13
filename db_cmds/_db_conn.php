<?php
$halt_mysql_connect = 1;
include("../f_myadm.php");
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$conn->set_charset("utf8");

function Sqli_query($query) {
	global $conn;
//	$res=mysqli_query($conn, $query);
	$res=$conn->query($query);
	return $res;
}
?>