<?php
$skip_W3C_DOCTYPE=1;
echo "{";
include( "../f_vars.php" );
include( "../dflib/f_func.php" );
$zap=$_GET["zap"];
if ( $zap=="" );
else {
	if ( $zap=="tags" )
		mysql_query( "TRUNCATE TABLE $tags" ) or die( mysql_error());
	else if ( $zap=="parlor" ) {
		mysql_query( "DROP TABLE $parlor" ) or die( mysql_error());
		mysql_query( "CREATE TABLE $parlor (
		 `created_date` date NOT NULL default '1991-12-31',
		 `created_time` time NOT NULL default '00:00:00',
		 `milk_kg` varchar( 5 ) NOT NULL default '',
		 `r` varchar( 5 ) NOT NULL default '',
		 `kg_30s` varchar( 5 ) NOT NULL default '',
		 `kg_60s` varchar( 5 ) NOT NULL default '',
		 `kg_90s` varchar( 5 ) NOT NULL default '',
		 `milk_begin` time NOT NULL default '00:00:00',
		 `milk_end` time NOT NULL default '00:00:00',
		 `milk_time` varchar( 6 ) NOT NULL default '',
		 `manual` varchar( 11 ) NOT NULL default '',
		 `retries` char( 2 ) NOT NULL default '',
		 `stopped` varchar( 11 ) NOT NULL default '',
		 `id_date` date NOT NULL default '1991-01-01',
		 `id_time` time NOT NULL default '00:00:00',
		 `rep_date` date NOT NULL default '1991-01-01',
		 `rep_time` time NOT NULL default '00:00:00',
		 `bd_num` varchar( 2 ) NOT NULL default '00',
		 `dev_status` varchar( 51 ) NOT NULL default '',
		 `dev_status_` char( 1 ) NOT NULL default '',
		 `exhaust` varchar( 11 ) NOT NULL default '',
		 `mast` varchar( 11 ) NOT NULL default '',
		 `mast_4` varchar( 4 ) NOT NULL default '',
		 `tr` varchar( 11 ) NOT NULL default '',
		 `ov` varchar( 11 ) NOT NULL default '',
		 `cow_num` varchar( 7 ) NOT NULL default '',
		 `rfid_num` varchar( 30 ) NOT NULL default '',
		 `locked` varchar( 100 ) NOT NULL default '',
		 `nick` varchar( 100 ) NOT NULL default '',
		 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '1',
		 `modif_date` date NOT NULL default '1991-12-31',
		 `modif_time` time NOT NULL default '00:00:00' )
		 $table_utf8 $mysql_TYPE COMMENT='Parlor *$parlor.MYD*'", $db ) or die( mysql_error());
		for ( $i=1; $i<=96; $i++ ) {
			$bd_num=Int2StrZ( $i, 2 );
			mysql_query( "INSERT INTO $parlor ( `bd_num` ) VALUES ( '$bd_num' )" ) or die( mysql_error());
		}
	}
	include( "../dflib/f_patch1.php" );
	include( "../dflib/f_patch.php" );
	echo "}";
}
?>
