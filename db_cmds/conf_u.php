<?php
// DF_ajs: Update Conf
require_once "_db_conn.php";
$__data = json_decode(file_get_contents("php://input"));
// Zap special characters from updated data
$state = mysqli_real_escape_string($conn, $__data->state);
$region = mysqli_real_escape_string($conn, $__data->region);
$subregion = mysqli_real_escape_string($conn, $__data->subregion);
$enterprise = mysqli_real_escape_string($conn, $__data->enterprise);
$farm = mysqli_real_escape_string($conn, $__data->farm);
$address = mysqli_real_escape_string($conn, $__data->address);
$phone = mysqli_real_escape_string($conn, $__data->phone);
$chief = mysqli_real_escape_string($conn, $__data->chief);
$chief_animal_technician = mysqli_real_escape_string($conn, $__data->chief_animal_technician);
$pits = mysqli_real_escape_string($conn, $__data->pits);
$devs_by_pit = mysqli_real_escape_string($conn, $__data->devs_by_pit);
$data_wires_by_pit = mysqli_real_escape_string($conn, $__data->data_wires_by_pit);
$ports_type = mysqli_real_escape_string($conn, $__data->ports_type);
$port_first = mysqli_real_escape_string($conn, $__data->port_first);
$waitstate_between_devs = mysqli_real_escape_string($conn, $__data->waitstate_between_devs);
$__query = "UPDATE f_consts
 SET state='$state', region='$region', subregion='$subregion',
 enterprise='$enterprise', farm='$farm', address='$address', phone='$phone',
 chief='$chief',
 chief_animal_technician='$chief_animal_technician'";
Sql_query($__query);
$__query1 = "UPDATE f_hardw
 SET pits='$pits', devs_by_pit='$devs_by_pit', data_wires_by_pit='$data_wires_by_pit',
 waitstate_between_devs='$waitstate_between_devs',
 ports_type='$ports_type', port_first='$port_first'";
Sql_query($__query1);
echo true;
?>