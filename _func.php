<?php
/* DF_2: _func.php
common functions
c: 21.02.2018
m: 21.02.2018 */

function Dbase_connect() {
	global $db, $db_host, $db_user, $db_password;
	$db=mysql_connect( $db_host, $db_user, $db_password );
}

function Dbase_disconnect() {
	global $db;
	mysql_close( $db );
}


//sql_query with error reporting
function Sql_query( $query ) {
	global $db;
	mysql_query( $query, $db );
	$sqlerr=mysql_errno()*1;
	if ( $sqlerr!=0 ) {
		$sqlerr=$sqlerr.": ".mysql_error();
		echo "<h1>MySQL ERROR $sqlerr.</h1>";
		echo "<h3>$query</h3>";
	}
	return $sqlerr;
}

//sql_query without error reporting
function Sql_query1( $query ) {
	global $db;
	$res=mysql_query( $query, $db );
	return $res;
}

//sql_query with error reporting
function Sql_queryE( $query ) {
	global $db;
	mysql_query( $query, $db );
	$sqlerr=mysql_errno()*1;
	return $sqlerr;
}

function Dbase_select() {
	global $db, $db_name, $db_utf8, $connectionCharset, $connectionCharset1;
	if ( $connectionCharset!="cp1251" ) $connectionCharset="utf8";
//DONT TOUCH NEXT! CRITICAL FOR EXPORT!
	if ( $connectionCharset1=="cp1251" ) $connectionCharset="cp1251";
	mysql_select_db( $db_name, $db );
	if ( $db_utf8==1 ) {
		mysql_query( "SET CHARACTER SET ".$connectionCharset, $db );
		mysql_query( "SET NAMES ".$connectionCharset, $db );
	}
}

function CookieGet( $cname ) {
	global $HTTP_COOKIE_VARS, $_COOKIE;
//FOR PHP5 AND PHP4 COMPATIBILITY
	$res=$HTTP_COOKIE_VARS["$cname"];
	$res_php5=$_COOKIE["$cname"];
	if ( strlen( $res_php5 )>strlen( $res )) $res=$res_php5;
	return $res;
}

function CookieSet( $cname, $cvalue ) {
	setcookie( "$cname", $cvalue, 0, "/" );
}

function CookieSetSs( $cname, $cvalue, $ss ) {
	setcookie( "$cname", $cvalue, time()+$ss, "/" );
}
?>
