<?php
// --phpMyAdmin SQL Dump
// --version 2.6.1
// --http://www.phpmyadmin.net
// --
// --m: 01.04.2015
// --PHP: 5.2.4

//DON'T TOUCH THIS SCRIPT! IT'S NOT FOR MODIFICATION!
//IF THIS SCRIPT WILL BE MODIFIED, YOU CAN BREAK DATABASE!
include( "../f_vars.php" );
include( "../dflib/f_func.php" );

mysql_query( "DROP DATABASE IF EXISTS $db_name" );
$sqlerr=$error=mysql_errno();
if ( $error==0 ) echo "<h4>*** DATABASE \"$db_name\" IS DROPPED.</h4>";
else {
	echo "<br><hr><b>*** ERROR ***</b>"; return;
}

$query="CREATE DATABASE $db_name";
if ( $db_utf8==1 ) $query=$query." DEFAULT CHARACTER SET utf8";
mysql_query( $query ) or die( mysql_error());
echo "<h4>*** DATABASE \"$db_name\" IS CREATED.</h4>";
$sqlerr=$error=mysql_errno();

mysql_select_db( $db_name, $db );

mysql_query( "CREATE TABLE `f_chat` (
 `id` int( 10 ) NOT NULL auto_increment,
 `name` varchar( 255 ) NOT NULL,
 `text` text,
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE", $db ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $globals (
 `state` varchar( 250 ) NOT NULL default '',
 `region` varchar( 250 ) NOT NULL default '',
 `subregion` varchar( 250 ) NOT NULL default '',
 `enterprise` varchar( 250 ) NOT NULL default '',
 `address` varchar( 250 ) NOT NULL default '',
 `phone` varchar( 100 ) NOT NULL default '',
 `chief` varchar( 100 ) NOT NULL default '',
 `chief_animal_technician` varchar( 100 ) NOT NULL default '',
 `farm` varchar( 100 ) NOT NULL default '',
 `totaldevs` tinyint( 2 ) unsigned NOT NULL default '16',
 `power` char( 3 ) NOT NULL default '',
 `transact` mediumint( 8 ) unsigned NOT NULL default '0',
 `sessions` tinyint( 1 ) unsigned NOT NULL default '3',
 `language` varchar( 5 ) NOT NULL default 'uk',
 `os` varchar( 30 ) NOT NULL default 'linux',
 `suex_dir` varchar( 255 ) NOT NULL default '/_df2drv',
 `suex_ver` tinyint( 2 ) NOT NULL default '1',
 `suex_passw` varchar( 255 ) default '',
 `xorg.conf` varchar( 31 ) default '',
 `today_date` date NOT NULL default '1991-12-31',
 `db_rel` varchar( 11 ) NOT NULL default '[2009:0808]',
 `db_charset` varchar( 50 ) default '$db_charset' )
 $table_utf8 $mysql_TYPE COMMENT='Globals *$globals.MYD*'", $db ) or die( mysql_error());
echo "Table \"$globals\" is created. Adding defaults...<br>";
$res1=0; $res=mysql_query( "SELECT * FROM $globals" );
while ( mysql_fetch_row( $res )) $res1++;
mysql_free_result( $res );
if ( $res1==0 ) mysql_query( "INSERT INTO $globals (
 `language`,
 `state`, `region`, `subregion`, `address`,
 `enterprise`,
 `phone`,
 `chief`, `chief_animal_technician`,
 `farm`,
 `totaldevs`,
 `power`,
 `transact`,
 `sessions` )
 VALUES (
 'uk',
 '-', '-', '-', '-',
 'JSC Bratslav',
 '-',
 '-', '-',
 '-',
 '16',
 'ON',
 '0',
 '3' )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $person (
 `id` tinyint( 3 ) unsigned NOT NULL auto_increment,
 `user_id` tinyint( 3 ) unsigned NOT NULL default '2',
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 20 ) NOT NULL default '0',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `valid_from` date NOT NULL default '1991-12-31',
 `valid_to` date NOT NULL default '2037-01-01',
 `passw` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '1',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Personnel *$person.MYD*'", $db ) or die( mysql_error());
echo "Table \"$person\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $person
 ( `id`, `user_id`, `num`,
 `nick`, `comments`, `passw`,
 `locked`, `valid_from`, `valid_to`, `modif_uid` )
 VALUES
 ( 1, 1, '0',
 'root', 'root', '20095230',
 '5230', '1991-01-01', '2037-01-01', 1 ),
 ( 2, 2, '1',
 'admin', 'admin', '5237',
 '5230', '1991-01-01', '2037-12-31', 1 ),
 ( 3, 3, '2',
 'operator', 'operator', '501',
 '', '1991-01-01', '2037-12-31', 1 ),
 ( 9, 9, '8',
 'anonymous', 'anonymous', '',
 '5230', '1991-01-01', '2037-12-31', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $dairymds (
 `dairymd_devs` varchar( 255 ) NOT NULL default '',
 `dairymd_idx` tinyint( 2 ) unsigned NOT NULL default '0' )
 $table_utf8 $mysql_TYPE COMMENT='Dairymaids *$dairymds.MYD*'", $db ) or die( mysql_error());
echo "Table \"$dairymds\" is created.<br>";

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $xfuncs (
 `id` tinyint( 3 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Functions *$xfuncs.MYD*'", $db ) or die( mysql_error());
echo "Table \"$xfuncs\" is created. Adding defaults...<br>";
for ( $i=1; $i<=10; $i++ ) mysql_query( "INSERT INTO $xfuncs
 ( `id`, `num`, `locked`, `modif_uid` )
 VALUES
 ( $i, $i-1, '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $xraces (
 `id` tinyint( 3 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Races *$xraces.MYD*'", $db ) or die( mysql_error());
echo "Table \"$xraces\" is created. Adding defaults...<br>";
for ( $i=1; $i<=9; $i++ ) mysql_query( "INSERT INTO $xraces
 ( `id`, `num`, `locked`, `modif_uid` )
 VALUES
 ( $i, $i-1, '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $xclasses (
 `id` tinyint( 3 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Complex classes *$xclasses.MYD*'", $db ) or die( mysql_error());
echo "Table \"$xclasses\" is created. Adding defaults...<br>";
for ( $i=1; $i<=6; $i++ ) mysql_query( "INSERT INTO $xclasses
 ( `id`, `num`, `locked`, `modif_uid` )
 VALUES
 ( $i, $i-1, '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $breeds (
 `id` smallint( 5 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Breeds *$breeds.MYD*'", $db ) or die( mysql_error());
echo "Table \"$breeds\" is created. Adding defaults...<br>";
for ( $i=1; $i<=56; $i++ ) mysql_query( "INSERT INTO $breeds
 ( `id`, `num`, `modif_uid` )
 VALUES
 ( $i, $i-1, 1 )" ) or die( mysql_error());

// ---------------------------------------------------------
mysql_query( "CREATE TABLE $lots (
 `id` smallint( 5 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Lots *$lots.MYD*'", $db ) or die( mysql_error());
echo "Table \"$lots\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $lots (
 `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
 VALUES
 ( 1, '0', '**0', '-', '**', '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $groups (
 `id` smallint( 5 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `lot_id` smallint( 5 ) unsigned NOT NULL default '1',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Groups *$groups.MYD*'", $db ) or die( mysql_error());
echo "Table \"$groups\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $groups
 ( `id`, `num`, `national_descr`, `lot_id`, `nick`, `comments`, `locked`, `modif_uid` )
 VALUES
 ( 1, '0', '***0', 1, '-', '***', '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $subgrs (
 `id` smallint( 5 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `gr_id` smallint( 5 ) unsigned NOT NULL default '1',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Subgroups *$subgrs.MYD*'", $db ) or die( mysql_error());
echo "Table \"$subgrs\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $subgrs
 ( `id`, `num`, `national_descr`, `gr_id`, `nick`, `comments`, `locked`, `modif_uid` )
 VALUES
 ( 1, '0', '****0', 1, '-', '****', '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $departs (
 `id` smallint( 5 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `code` varchar( 10 ) NOT NULL default '',
 `nick` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Cows departments *$departs.MYD*'", $db ) or die( mysql_error());
echo "Table \"$departs\" is created. Adding defaults...<br>";
for ( $i=1; $i<=7; $i++ ) mysql_query( "INSERT INTO $departs
 ( `id`, `locked`, `modif_uid` )
 VALUES
 ( $i, '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $states (
 `id` smallint( 5 ) unsigned NOT NULL default '0',
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `descr` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='States *$states.MYD*'", $db ) or die( mysql_error());
echo "Table \"$states\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $states
 ( `id`, `locked`, `modif_uid` )
 VALUES
 ( 01, '5230', 1 ),
 ( 02, '5230', 1 ),
 ( 04, '5230', 1 ),
 ( 08, '5230', 1 ),
 ( 16, '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $results (
 `id` smallint( 5 ) unsigned NOT NULL default '0',
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `descr` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Results *$results.MYD*'", $db ) or die( mysql_error());
echo "Table \"$results\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $results
 ( `id`, `locked`, `modif_uid` )
 VALUES
 ( 01, '5230', 1 ),
 ( 02, '5230', 1 ),
 ( 04, '5230', 1 ),
 ( 08, '5230', 1 ),
 ( 16, '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $pregnant (
 `id` smallint( 5 ) unsigned NOT NULL default '0',
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `descr` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Pregnant states *$pregnant.MYD*'", $db ) or die( mysql_error());
echo "Table \"$pregnant\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $pregnant
 ( `id`, `locked`, `modif_uid` )
 VALUES
 ( 01, '5230', 1 ),
 ( 02, '5230', 1 ),
 ( 04, '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $cows (
 `id` int( 10 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `stall_num` int( 5 ) unsigned NOT NULL default '0',
 `cow_num` varchar( 7 ) NOT NULL default '0',
 `b_date` date NOT NULL default '1991-12-31',
 `b_num` varchar( 30 ) NOT NULL default '',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `mth_id` int( 10 ) unsigned NOT NULL default '1',
 `fth_id` int( 10 ) unsigned NOT NULL default '1',
 `breed_id` smallint( 5 ) unsigned NOT NULL default '1',
 `gr_id` smallint( 5 ) unsigned NOT NULL default '1',
 `subgr_id` smallint( 5 ) unsigned NOT NULL default '1',
 `lot_id` smallint( 5 ) unsigned NOT NULL default '1',
 `rfid_num` varchar( 30 ) NOT NULL default '',
 `rfid_native` varchar( 30 ) NOT NULL default '',
 `rfid_date` date NOT NULL default '1991-12-31',
 `rfid_time` time NOT NULL default '00:00:00',
 `nick` varchar( 100 ) NOT NULL default '',
 `defects` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `a_dates` varchar( 255 ) NOT NULL default '',
 `b_dates` varchar( 255 ) NOT NULL default '',
 `c_dates` varchar( 255 ) NOT NULL default '',
 `bd_leds` smallint( 5 ) unsigned NOT NULL default '0',
 `dont_use` smallint( 5 ) unsigned NOT NULL default '0',
 `prev_s31` double unsigned NOT NULL default '0',
 `prev_s30` double unsigned NOT NULL default '0',
 `prev_s21` double unsigned NOT NULL default '0',
 `prev_s20` double unsigned NOT NULL default '0',
 `prev_s11` double unsigned NOT NULL default '0',
 `prev_s10` double unsigned NOT NULL default '0',
 `now_s31` double unsigned NOT NULL default '0',
 `now_s30` double unsigned NOT NULL default '0',
 `now_s21` double unsigned NOT NULL default '0',
 `now_s20` double unsigned NOT NULL default '0',
 `now_s11` double unsigned NOT NULL default '0',
 `now_s10` double unsigned NOT NULL default '0',
 `milk_total` double unsigned NOT NULL default '0',
 `milk_q` mediumint( 7 ) unsigned NOT NULL default '0',
 `milk_max` double unsigned NOT NULL default '0',
 `milk_min` double unsigned NOT NULL default '0',
 `lact_days` smallint( 3 ) unsigned NOT NULL default '0',
 `milkm_total` double unsigned NOT NULL default '0',
 `milkm_q` mediumint( 7 ) unsigned NOT NULL default '0',
 `milkm_max` double unsigned NOT NULL default '0',
 `milkm_min` double unsigned NOT NULL default '0',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Cows *$cows.MYD*'", $db ) or die( mysql_error());
echo "Table \"$cows\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $cows
 ( `id`, `cow_num`, `b_date`, `b_num`, `national_descr`,
 `rfid_num`, `rfid_native`, `rfid_date`,
 `nick`,
 `locked`, `modif_uid` )
 VALUES
 ( 1, '0', '1991-12-31', '0-0', '0-00',
 '12345', '1.2.3.4.5', '1991-12-31',
 '- w/o RFID',
 '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $oxes (
 `id` int( 10 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `num` varchar( 4 ) NOT NULL default '0',
 `b_date` date NOT NULL default '1991-12-31',
 `b_num` varchar( 30 ) NOT NULL default '',
 `national_descr` varchar( 50 ) NOT NULL default '',
 `mth_id` int( 10 ) unsigned NOT NULL default '1',
 `fth_id` int( 10 ) unsigned NOT NULL default '1',
 `breed_id` smallint( 5 ) unsigned NOT NULL default '1',
 `gr_id` smallint( 5 ) unsigned NOT NULL default '1',
 `subgr_id` smallint( 5 ) unsigned NOT NULL default '1',
 `lot_id` smallint( 5 ) unsigned NOT NULL default '1',
 `nick` varchar( 100 ) NOT NULL default '',
 `defects` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Oxes *$oxes.MYD*'", $db ) or die( mysql_error());
echo "Table \"$oxes\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $oxes
 ( `id`, `num`, `b_num`, `national_descr`,
 `mth_id`, `fth_id`, `breed_id`, `gr_id`, `subgr_id`, `lot_id`, `nick`,
 `locked`, `modif_uid` )
 VALUES
 ( 1, '0', '', '',
 1, 1, 1, 1, 1, 1, '-',
 '5230', 1 )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $operstyp (
 `id` mediumint( 8 ) unsigned NOT NULL default '0',
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `descr` varchar( 100 ) NOT NULL default '',
 `comments` varchar( 100 ) NOT NULL default '',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Operations types *$operstyp.MYD*'", $db ) or die( mysql_error());
echo "Table \"$operstyp\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $operstyp
 ( `id`, `locked`, `modif_uid` )
 VALUES
 ( 0000, '5230', 1 ),
 ( 0001, '5230', 1 ),
 ( 0002, '5230', 1 ),
 ( 0004, '5230', 1 ),
 ( 0008, '5230', 1 ),
 ( 0032, '5230', 1 ),
 ( 0064, '5230', 1 ),
 ( 0128, '5230', 1 ),
 ( 0256, '5230', 1 ),
 ( 0512, '5230', 1 ),
 ( 1024, '5230', 1 ),
 ( 2048, '5230', 1 ),
 ( 8192, '5230', 1 )" ) or die( mysql_error());
//LOCKED OPERATIONS
// ( 4096, '5230', 1 ),
//LOCKED OPERATIONS

// ----------------------------------------------------------
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
echo "Table \"$parlor\" is created. Adding defaults...<br>";
for ( $i=1; $i<=96; $i++ ) {
	$bd_num=Int2StrZ( $i, 2 );
	mysql_query( "INSERT INTO $parlor ( `bd_num` ) VALUES ( '$bd_num' )" ) or die( mysql_error());
}

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $sessions (
 `id` tinyint( 2 ) unsigned NOT NULL default '0',
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `name` varchar( 50 ) NOT NULL default '',
 `b` varchar( 5 ) NOT NULL default '00:00',
 `locked` varchar( 100 ) NOT NULL default '',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '1',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=4 COMMENT='Sessions *$sessions.MYD*'", $db ) or die( mysql_error());
echo "Table \"$sessions\" is created. Adding defaults...<br>";
mysql_query( "INSERT INTO $sessions
 ( `id`, `locked` )
 VALUES
 ( 10, '5230' ),
 ( 11, '5230' ),
 ( 20, '5230' ),
 ( 21, '5230' ),
 ( 30, '5230' ),
 ( 31, '5230' )" ) or die( mysql_error());

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $hardw (
 `pits` tinyint( 2 ) unsigned NOT NULL default '1',
 `drmds_by_pit` tinyint( 1 ) unsigned NOT NULL default '1',
 `drmd_bds` tinyint( 1 ) unsigned NOT NULL default '0',
 `data_wires_by_pit` tinyint( 1 ) unsigned NOT NULL default '1',
 `devs_by_pit` tinyint( 2 ) NOT NULL default '16',
 `waitstate_between_devs` smallint( 4 ) NOT NULL default '200',
 `ports` tinyint( 2 ) unsigned NOT NULL default '1',
 `ports_type` varchar( 30 ) NOT NULL default 'COM',
 `port_first` tinyint( 2 ) unsigned NOT NULL default '5',
 `port_bps` mediumint( 6 ) unsigned NOT NULL default '2400',
 `driver_dir` varchar( 255 ) NOT NULL default '/_df2drv',
 `driver_fname` varchar( 30 ) NOT NULL default 'httpbd06' )
 $table_utf8 $mysql_TYPE COMMENT='Hardware configuration *$hardw.MYD*'", $db ) or die( mysql_error());
echo "Table \"$hardw\" is created. Adding defaults...<br>";
$res1=0; $res=mysql_query( "SELECT * FROM $hardw" );
while ( mysql_fetch_row( $res )) $res1++;
mysql_free_result( $res );
if ( $res1==0 ) {
	mysql_query( "INSERT INTO $hardw (
	 `ports` )
	 VALUES (
	 '0' )" ) or die( mysql_error());
}

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $hardwj (
 `jaggs` tinyint( 2 ) unsigned NOT NULL default '0',
 `ports` tinyint( 2 ) unsigned NOT NULL default '0',
 `ports_type` varchar( 30 ) NOT NULL default 'COM',
 `port_first` tinyint( 2 ) unsigned NOT NULL default '0',
 `port_bps` mediumint( 6 ) unsigned NOT NULL default '9600',
 `driver_dir` varchar( 255 ) NOT NULL default '/_df2drv',
 `driver_fname` varchar( 30 ) NOT NULL default 'httpsep' )
 $table_utf8 $mysql_TYPE COMMENT='Hardware (jagg) configuration *$hardwj.MYD*'", $db ) or die( mysql_error());
echo "Table \"$hardwj\" is created. Adding defaults...<br>";
$res1=0; $res=mysql_query( "SELECT * FROM $hardwj" );
while ( mysql_fetch_row( $res )) $res1++;
mysql_free_result( $res );
if ( $res1==0 ) {
	mysql_query( "INSERT INTO $hardwj (
	 `ports` )
	 VALUES (
	 '0' )" ) or die( mysql_error());
}

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $hardwports (
 `port_name` varchar( 32 ) default '',
 `port_bps` mediumint( 6 ) unsigned NOT NULL default '2400',
 `dev_first` tinyint( 2 ) unsigned NOT NULL default '0',
 `dev_last` tinyint( 2 ) unsigned NOT NULL default '0',
 `waitstate_between_devs` smallint( 4 ) unsigned NOT NULL default '0',
 `port_idx` tinyint( 3 ) unsigned NOT NULL default '0' )
 $table_utf8 $mysql_TYPE COMMENT='Hardware ports *$hardwports.MYD*'", $db ) or die( mysql_error());
echo "Table \"$hardwports\" is created.<br>";

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $vars (
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `var_name` varchar( 100 ) NOT NULL default '',
 `var_value` varchar( 255 ) NOT NULL default '',
 `var_valuetype` varchar( 20 ) NOT NULL default 'varchar',
 `var_uid` mediumint( 8 ) NOT NULL default '2',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 `int_res` mediumint( 9 ) NOT NULL default '0',
 `str_res` varchar( 255 ) NOT NULL default '' )
 $table_utf8 $mysql_TYPE COMMENT='Variables *$vars.MYD*'", $db ) or die( mysql_error());
echo "Table \"$vars\" is created.<br>";

// ----------------------------------------------------------
mysql_query( "CREATE TABLE $dbidx (
 `id` mediumint( 8 ) unsigned NOT NULL auto_increment,
 `created_date` date NOT NULL default '1991-12-31',
 `created_time` time NOT NULL default '00:00:00',
 `dbt_path` varchar( 255 ) NOT NULL default '',
 `dbt_name` varchar( 100 ) NOT NULL default '',
 `dbt_modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `dbt_modif_date` date NOT NULL default '1991-12-31',
 `dbt_modif_time` time NOT NULL default '00:00:00',
 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
 `modif_date` date NOT NULL default '1991-12-31',
 `modif_time` time NOT NULL default '00:00:00',
 PRIMARY KEY ( `id` ))
 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Database structure *$dbidx.MYD*'", $db ) or die( mysql_error());
echo "Table \"$dbidx\" is created.<br>";

echo "<br><hr>OK";

include( "../f_set_p1.php" );
?>
