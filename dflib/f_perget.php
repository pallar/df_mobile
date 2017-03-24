<?php
/* DF_2: dflib/f_perget.php
get period, language etc. from database
c: 30.03.2007
m: 10.08.2015 */

ob_start();

$userCoo=9; CookieSet( "userCoo", $userCoo ); CookieSet( "unickCoo", "anonymous" ); //IMPORTANT!
Period_FromDb( $userCoo, $vars );
if ( $_GET["demo"]==1 ) {
	CookieSet( "_dt1", "2015-05-03" ); CookieSet( "_dt2", "2015-05-03" );
}
?>
