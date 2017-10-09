<?php
/* DF_2 | DF_ajs: forms/index0.php | _view/index0.php
c: 25.12.2005
m: 26.09.2017 */

$dev_1st=CookieGet( "dev_1st" )*1; if ( $dev_1st<1 ) $dev_1st=1;
if ( CookieGet( "devs_prev" )*1==1 ) {
	$devs=CookieGet( "devs" )*1;
	if ( $dev_1st<$devs-$devs_onmnemo ) $dev_1st=$dev_1st+$devs_onmnemo; else $dev_1st=1;
	CookieSet( "devs_prev", "" ); CookieSet( "dev_1st", "$dev_1st" );
}

if ( $userCoo*1<1 ) {
	$_id=CookieGet( "_id" );
	if ( strlen( $_id )<10 ) $local_id=md5( uniqid( rand(), true )); else $local_id=$_id;
	CookieSetSs( "_id", "$local_id", 60*60*24*3650 );
	$res=mysql_query( "SELECT language FROM $globals" ); $sqlerr=mysql_errno()*1;
	if ( $sqlerr==0 ) {
		$lang=mysql_fetch_row( $res ); $lang=$lang[0];
	} else $lang="ru";
	CookieSet( "_lang", $lang );
	include( "../dflib/f_zaptmp.php" );
	include( "../dflib/f_zap.php" );
	include( "../dflib/f_perget.php" );
	include( "../dflib/f_patch1.php" );
	include( "../dflib/f_patch.php" );
	$f_limits_php="../f_lim.php";
	include( "../dflib/f_limset.php" );
	CookieSet( "_filts0", "59" );
	CookieSet( "_filts9", "63" );
}
include( "../dflib/f_perset.php" );
?>
