<?php
/* DF_2: oper/f_rcwsf.php
group operations start session
created: 25.05.2006
modified: 10.11.2015 */

if ( $varsession!=1 ) {
	if ( $nosession!=1 ) {
//get session data [BEGIN]
		$sess_id=$_GET[sess_id]; $sess_name="sess_".$sess_id;
		session_id( $sess_id ); session_name( $sess_name );
		session_start();
		$sess_str=$_SESSION["sess_cows.txt"];
		$cows_arr=split( ',', $sess_str );
		$dates_=$_POST["dates_"];
		$co_=$_POST["co_"];
//get session data [END]
	} else {
		$dbtkeys=split( ':', $key );
		$dbt=$dbtkeys[0]; $outsele_=$dbtkeys[1]*1; $sess_str=$dbtkeys[2]*1;
		session_start(); $sess_id=session_id();
		$_SESSION["sess_cows.txt"]=$sess_str;
		$cows_arr=split( ',', $sess_str );
	}
}
$thead_style="margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; overflow-x:hidden; overflow-y:scroll";
$tbody_style="margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; overflow-x:hidden; overflow-y:scroll";
?>
