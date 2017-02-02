<?php
// DF_ajs: Get Conf
require_once "_db_conn.php";
$arr = array();
$__query = "SELECT
 state, region, subregion,
 enterprise, farm, address, phone,
 chief, chief_animal_technician,
 totaldevs,
 sessions,
 language,
 os, suex_dir, suex_ver, suex_passw, rfid_mode
 FROM f_consts";
$__res = mysqli_query($conn, $__query);
if(mysqli_num_rows($__res) != 0)
	while($__row = mysqli_fetch_assoc($__res)) $arr[] = $__row;
$__query1 = "SELECT
 pits,
 drmds_by_pit,
 drmd_bds,
 devs_by_pit,
 data_wires_by_pit,
 waitstate_between_devs,
 ports, ports_type, port_first,
 driver_dir, driver_fname
 FROM f_hardw";
$__res1 = mysqli_query($conn, $__query1);
if(mysqli_num_rows($__res1) != 0)
	while($__row1 = mysqli_fetch_assoc($__res1)) $arr[1] = $__row1;
// Return json array containing data from the database
echo $json_info = json_encode($arr);
?>