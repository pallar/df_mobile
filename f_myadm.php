<?php
/* DF_2: f_myadm.php
init: MySQLd access
c: 14.10.2008
m: 04.05.2015 */

//MUST BE MOVED TO SPECIAL FILE TO GET FROM BY .sh SCRIPT
$db_host="localhost";
$db_user="root";
$db_password="20095230";
$db_name="df2";

$db=mysql_connect( $db_host, $db_user, $db_password );
$myrev_res=mysql_query( 'SELECT VERSION() AS version' );
$myrev_row=mysql_fetch_row( $myrev_res );
$match=explode( '.', $myrev_row[0] );
define( 'PMA_MYSQL_INT_REL', ( int )sprintf( '%d%02d%02d', $match[0], $match[1], intval( $match[2] )));
define( 'PMA_MYSQL_STR_REL', $myrev_row[0] );
//echo PMA_MYSQL_INT_REL."&nbsp;".PMA_MYSQL_STR_REL."<br>";
if( PMA_MYSQL_INT_REL*1>=40112 ) $db_utf8=1; else $db_utf8=0;
if( PMA_MYSQL_INT_REL*1>=50100 ) $mysql_TYPE="ENGINE=MyISAM"; else $mysql_TYPE="TYPE=MyISAM";

mysql_close( $db );
?>
