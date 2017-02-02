<?php
$conn = mysqli_connect("localhost", "root", "20095230", "_026");
$conn->set_charset("utf8");

function Sql_query($query) {
	global $conn;
	mysqli_query($conn, $query);
}
?>