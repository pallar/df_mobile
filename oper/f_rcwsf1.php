<?php
/* DF_2: oper/f_rcwsf1.php
group operations clear session
c: 25.05.2006
m: 11.09.2012 */

//destroy current session data [BEGIN]
//delete the session cookie
//if ( isset( $_COOKIE[$sess_name] )) setcookie( $sess_name, '', time()-42000, '/' );
$now_Ymd=date( "Y-m-d" ); $v_default="0";
$query="SELECT var_name, var_value, var_uid, modif_date FROM $vars WHERE var_value='$sess_id' AND var_uid='$userCoo'";
$res=mysql_query( $query, $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	$sqlerr=$sqlerr.": ".mysql_error();
	echo "$query<br><h3>MySQL ERROR $sqlerr.</h3>";
	$res1=$v_default;//fix possible problem
} else {
	while ( $row=mysql_fetch_row( $res )) {
		$v_name=$row[0]; $res1=$row[1]; $res3=$row[3];
		if ( strlen( $res1 )<strlen( $v_default )) $res1=$v_default;//fix possible problem
		$cursess_id=$res1;
		if ( $res1=="0" ) $res3=$now_Ymd;
		if ( $cursess_id<>"0" ) {
			$cursess_name="sess_".$cursess_id;
			session_id( $cursess_id ); session_name( $cursess_name );
			session_start(); $_SESSION=array();
			session_destroy();
			Var_ToDb( "session", $v_name, "0", $userCoo );
			mysql_query( "DELETE FROM $vars WHERE var_name='$v_name' AND var_value='0'", $db );
		}
	}
	mysql_free_result( $res );
}
?>
