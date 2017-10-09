<?php
/* DF_2: dflib/f_perget.php
get period, language etc. from database
c: 30.03.2007
m: 27.09.2017 */

ob_start();

if( $userCoo<1 ) { $userCoo=9; CookieSet( "userCoo", $userCoo ); CookieSet( "unickCoo", "anonymous" ); }//IMPORTANT!
Period_FromDb( $userCoo, $vars );
if ( $_GET["demo"]==1 ) {
	CookieSet( "_dt1", "2015-05-03" ); CookieSet( "_dt2", "2015-05-03" );
}
?>
