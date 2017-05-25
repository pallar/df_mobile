<?php
/* DF_2: dflib/f_dbnew3.php
setup: database dynamic tables structures
c: 02.10.2007
m: 01.07.2015 */

if ( $db_utf8==1 ) {
	$table_utf8="DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
	$dbCharset="utf8";
} else {
	$table_utf8="";
	$dbCharset="";
}

$now_Ymd=date( "Y-m-d" );
$def_date_creat=$now_Ymd;
$def_yyyy_creat=substr( $def_date_creat, 0, 4 );
$def_mm_creat=substr( $def_date_creat, 5, 2 );
$def_date_modif=$now_Ymd;
$def_yyyy_modif=substr( $def_date_modif, 0, 4 );
$def_mm_modif=substr( $def_date_modif, 5, 2 );

$journ_o_struc="(
 `code` int( 10 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '$def_date_creat',
 `created_time` time NOT NULL default '00:00:00',
 `day` char( 2 ) NOT NULL default '01',
 `month` char( 2 ) NOT NULL default '$def_mm_creat',
 `year` varchar( 4 ) NOT NULL default '$def_yyyy_creat',
 `int_1` double unsigned NOT NULL default '0',
 `int_2` double unsigned NOT NULL default '0',
 `int_3` double unsigned NOT NULL default '0',
 `int_4` double unsigned NOT NULL default '0',
 `int_5` double unsigned NOT NULL default '0',
 `int_6` double unsigned NOT NULL default '0',
 `int_7` double unsigned NOT NULL default '0',
 `int_8` double unsigned NOT NULL default '0',
 `data_1:4` varchar( 255 ) NOT NULL default '@-@-@-@-',
 `data_5:8` varchar( 255 ) NOT NULL default '@-@-@-@-',
 `comments` varchar( 255 ) NOT NULL default '-',
 `oper_id` mediumint( 8 ) unsigned NOT NULL default '0',
 `cow_id` int( 10 ) unsigned NOT NULL default '1',
 `modif_uid` tinyint( 3 ) NOT NULL default '2',
 `modif_date` date NOT NULL default '$def_date_modif',
 `modif_time` time NOT NULL default '00:00:00',
 `sub__oper_id` mediumint( 8 ) unsigned NOT NULL default '0',
 `sub__code` int( 10 ) unsigned NOT NULL default '0',
 `prev_table` varchar( 6 ) NOT NULL,
 `prev_code` int( 10 ) unsigned NOT NULL,
 `next_table` varchar( 6 ) NOT NULL,
 `next_code` int( 10 ) unsigned NOT NULL,
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL,
 PRIMARY KEY ( `code` ))
 $table_utf8 $mysql_TYPE
 COMMENT='$comment'";

$journ_m_struc="(
 `code` int( 10 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '$def_date_creat',
 `created_time` time NOT NULL default '00:00:00',
 `day` char( 2 ) NOT NULL default '01',
 `month` char( 2 ) NOT NULL default '$def_mm_creat',
 `year` varchar( 4 ) NOT NULL default '$def_yyyy_creat',
 `milk_kg` double unsigned NOT NULL default '0',
 `kg_30s` double unsigned NOT NULL default '0',
 `kg_60s` double unsigned NOT NULL default '0',
 `kg_90s` double unsigned NOT NULL default '0',
 `milk_begin` varchar( 8 ) NOT NULL default '00:00:00',
 `milk_end` varchar( 8 ) NOT NULL default '00:00:00',
 `milk_time` varchar( 6 ) NOT NULL default '0:00',
 `milk_sess` tinyint( 2 ) unsigned NOT NULL default '0',
 `comments` varchar( 100 ) NOT NULL,
 `manual` tinyint( 1 ) unsigned NOT NULL default '0',
 `retries` tinyint( 1 ) unsigned NOT NULL default '0',
 `stopped` tinyint( 1 ) unsigned NOT NULL default '0',
 `id_time` varchar( 8 ) NOT NULL default '00:00:00',
 `rep_time` varchar( 8 ) NOT NULL default '00:00:00',
 `bd_num` varchar( 2 ) NOT NULL default '00',
 `exhaust` tinyint( 1 ) unsigned NOT NULL default '0',
 `mast_4` varchar( 4 ) NOT NULL default '0000',
 `r` smallint( 4 ) NOT NULL default '0',
 `tr` tinyint( 1 ) NOT NULL default '0',
 `ov` tinyint( 1 ) NOT NULL default '0',
 `cow_id` int( 10 ) unsigned NOT NULL default '1',
 `subgr_id` smallint( 5 ) unsigned NOT NULL default '1',
 `gr_id` smallint( 5 ) unsigned NOT NULL default '1',
 `lot_id` smallint( 5 ) unsigned NOT NULL default '1',
 `modif_uid` tinyint( 3 ) NOT NULL default '2',
 `modif_date` date NOT NULL default '$def_date_modif',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL,
 PRIMARY KEY ( `code` ),
 KEY `day` ( `day` ),
 KEY `month` ( `month` ),
 KEY `year` ( `year` ),
 KEY `cow_id` ( `cow_id` ))
 $table_utf8 $mysql_TYPE
 COMMENT='$comment'";
?>
