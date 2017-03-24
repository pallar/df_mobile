<?php
/* DF_2: dflib/f_patch1.php
patch database
c: 08.09.2009
m: 15.11.2015 */

ob_start();//lock output to set cookies properly!

if ( $log_me==1 ) {
	mysql_query( "SELECT * FROM $debug_log", $db );
	$sqlerr=mysql_errno();
	if ( $sqlerr!=0 )
		mysql_query( "CREATE TABLE $debug_log (
		 `dev_num` varchar( 2 ) NOT NULL default '00',
		 `cmd` varchar( 2 ) NOT NULL default '',
		 `data` varchar( 255 ) NOT NULL default '',
		 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
		 `modif_Ymd` date NOT NULL default '1991-12-31',
		 `modif_His` time NOT NULL default '00:00:00' )
		 $table_utf8 $mysql_TYPE COMMENT='DEBUG *_debug.MYD*'" );
}

mysql_query( "SELECT * FROM $vars", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
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
	 $table_utf8 $mysql_TYPE COMMENT='Variables *$vars.MYD*'" );

//THIS MUST BE DONE HERE (NOT AT 'dflib/f_patch.php') TO AVOID ERRORS
$res=mysql_query( "SELECT language FROM $globals", $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	$row=mysql_fetch_row( $res );
	if ( trim( $row[0] )=="ua" ) {
		mysql_query( "ALTER TABLE `$globals`
		 DROP `language`" );
		mysql_query( "ALTER TABLE `$globals`
		 ADD `language` varchar( 5 ) NOT NULL default 'uk' AFTER `sessions`" );
	}
}

mysql_query( "SELECT id FROM $xfuncs", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
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
	 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Functions *$xfuncs.MYD*'" );
//	echo "Table \"$xfuncs\" is created... Adding defaults...<br>";
	if ( $lang=="uk" ) mysql_query( "INSERT INTO $xfuncs
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '00. -', '00. -', '*', '5230', 1 ),
	 ( 02, '1', '01. селекц. ядро (СЯ)', '01. селекц. ядро (СЯ)', 'СЯ', '5230', 1 ),
	 ( 03, '2', '02. селекц. ядро 1 (СЯ1)', '02. селекц. ядро 1 (СЯ1)', 'СЯ1', '5230', 1 ),
	 ( 04, '3', '03. селекц. ядро 2 (СЯ2)', '03. селекц. ядро 2 (СЯ2)', 'СЯ2', '5230', 1 ),
	 ( 05, '4', '04. виробнича група (ВГ)', '04. виробнича група (ВГ)', 'ВГ', '5230', 1 ),
	 ( 06, '5', '05. вибракування, виранжування (Б)', '05. вибракування, виранжування (Б)', 'Б', '5230', 1 ),
	 ( 07, '6', '06. ремонтні телиці (РТ)', '06. ремонтні телиці (РТ)', 'РТ', '5230', 1 ),
	 ( 08, '7', '07. племінні бугайці (ПБ)', '07. племінні бугайці (ПБ)', 'ПБ', '5230', 1 ),
	 ( 09, '8', '08. телиці для реалізації (ТР)', '08. телиці для реалізації (ТР)', 'ТР', '5230', 1 ),
	 ( 10, '9', '09. бугайці та телиці для відгодівлі (В)', '09. бугайці та телиці для відгодівлі (В)', 'В', '5230', 1 )" );
	else if ( $lang=="ru" ) mysql_query( "INSERT INTO $xfuncs
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '00. -', '00. -', '*', '5230', 1 ),
	 ( 02, '1', '01. селекц. ядро (СЯ)', '01. селекц. ядро (СЯ)', 'СЯ', '5230', 1 ),
	 ( 03, '2', '02. селекц. ядро 1 (СЯ1)', '02. селекц. ядро 1 (СЯ1)', 'СЯ1', '5230', 1 ),
	 ( 04, '3', '03. селекц. ядро 2 (СЯ2)', '03. селекц. ядро 2 (СЯ2)', 'СЯ2', '5230', 1 ),
	 ( 05, '4', '04. производств. группа (ПГ)', '04. производств. группа (ПГ)', 'ПГ', '5230', 1 ),
	 ( 06, '5', '05. выбраковка / выранжировка (Б)', '05. выбраковка / выранжировка (Б)', 'Б', '5230', 1 ),
	 ( 07, '6', '06. ремонтные тёлки (РТ)', '06. ремонтные тёлки (РТ)', 'РТ', '5230', 1 ),
	 ( 08, '7', '07. племенные бугаи (ПБ)', '07. племенные бугаи (ПБ)', 'ПБ', '5230', 1 ),
	 ( 09, '8', '08. тёлки на реализацию (ТР)', '08. тёлки на реализацию (ТР)', 'ТР', '5230', 1 ),
	 ( 10, '9', '09. бугаи и тёлки на откорм (О)', '09. бугаи и тёлки на откорм (О)', 'О', '5230', 1 )" );
	else mysql_query( "INSERT INTO $xfuncs
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '00. -', '00. -', '*', '5230', 1 ),
	 ( 02, '1', '01. селекц. ядро (СЯ)', '01. селекц. ядро (СЯ)', 'СЯ', '5230', 1 ),
	 ( 03, '2', '02. селекц. ядро 1 (СЯ1)', '02. селекц. ядро 1 (СЯ1)', 'СЯ1', '5230', 1 ),
	 ( 04, '3', '03. селекц. ядро 2 (СЯ2)', '03. селекц. ядро 2 (СЯ2)', 'СЯ2', '5230', 1 ),
	 ( 05, '4', '04. виробнича група (ВГ)', '04. виробнича група (ВГ)', 'ВГ', '5230', 1 ),
	 ( 06, '5', '05. вибракування, виранжування (Б)', '05. вибракування, виранжування (Б)', 'Б', '5230', 1 ),
	 ( 07, '6', '06. ремонтні телиці (РТ)', '06. ремонтні телиці (РТ)', 'РТ', '5230', 1 ),
	 ( 08, '7', '07. племінні бугайці (ПБ)', '07. племінні бугайці (ПБ)', 'ПБ', '5230', 1 ),
	 ( 09, '8', '08. телиці для реалізації (ТР)', '08. телиці для реалізації (ТР)', 'ТР', '5230', 1 ),
	 ( 10, '9', '09. бугайці та телиці для відгодівлі (В)', '09. бугайці та телиці для відгодівлі (В)', 'В', '5230', 1 )" );
}

mysql_query( "SELECT id FROM $xraces", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
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
	 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Races *$xraces.MYD*'" );
//	echo "Table \"$xraces\" is created... Adding defaults...<br>";
	if ( $lang=="uk" ) mysql_query( "INSERT INTO $xraces
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '-', '-', '-', '5230', 1 ),
	 ( 02, '1', 'чисто-породна (ЧП)', 'чисто-породна (ЧП)', 'ЧП', '5230', 1 ),
	 ( 03, '2', '1 (I)', '1 (I)', '1 (I)', '5230', 1 ),
	 ( 04, '3', '2 (II)', '2 (II)', '2 (II)', '5230', 1 ),
	 ( 05, '4', '3 (III)', '3 (III)', '3 (III)', '5230', 1 ),
	 ( 06, '5', '4 (IV)', '4 (IV)', '4 (IV)', '5230', 1 ),
	 ( 09, '8', 'помісь (П)', 'помісь (П)', 'П', '5230', 1 )" );
	else if ( $lang=="ru" ) mysql_query( "INSERT INTO $xraces
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '-', '-', '-', '5230', 1 ),
	 ( 02, '1', 'чисто-породная (ЧП)', 'чисто-породная (ЧП)', 'ЧП', '5230', 1 ),
	 ( 03, '2', '1 (I)', '1 (I)', '1 (I)', '5230', 1 ),
	 ( 04, '3', '2 (II)', '2 (II)', '2 (II)', '5230', 1 ),
	 ( 05, '4', '3 (III)', '3 (III)', '3 (III)', '5230', 1 ),
	 ( 06, '5', '4 (IV)', '4 (IV)', '4 (IV)', '5230', 1 ),
	 ( 09, '8', 'помесь (П)', 'помесь (П)', 'П', '5230', 1 )" );
	else mysql_query( "INSERT INTO $xraces
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '-', '-', '-', '5230', 1 ),
	 ( 02, '1', 'чисто-породна (ЧП)', 'чисто-породна (ЧП)', 'ЧП', '5230', 1 ),
	 ( 03, '2', '1 (I)', '1 (I)', '1 (I)', '5230', 1 ),
	 ( 04, '3', '2 (II)', '2 (II)', '2 (II)', '5230', 1 ),
	 ( 05, '4', '3 (III)', '3 (III)', '3 (III)', '5230', 1 ),
	 ( 06, '5', '4 (IV)', '4 (IV)', '4 (IV)', '5230', 1 ),
	 ( 09, '8', 'помісь (П)', 'помісь (П)', 'П', '5230', 1 )" );
}

mysql_query( "SELECT id FROM $xclasses", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
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
	 $table_utf8 $mysql_TYPE MIN_ROWS=1 COMMENT='Complex classes *$xclasses.MYD*'" );
//	echo "Table \"$xclasses\" is created... Adding defaults...<br>";
	if ( $lang=="uk" ) mysql_query( "INSERT INTO $xclasses
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '-', '-', '-', '5230', 1 ),
	 ( 02, '1', 'еліта-рекорд (ЕР)', 'еліта-рекорд (ЕР)', 'ЕР', '5230', 1 ),
	 ( 03, '2', 'еліта (Е)', 'еліта (Е)', 'Е', '5230', 1 ),
	 ( 04, '3', 'перший (1КЛ)', 'перший (1КЛ)', '1КЛ', '5230', 1 ),
	 ( 05, '4', 'другий (2КЛ)', 'другий (2КЛ)', '2КЛ', '5230', 1 ),
	 ( 06, '5', 'некласн. (НК)', 'некласн. (НК)', 'НК', '5230', 1 )" );
	else if ( $lang=="ru" ) mysql_query( "INSERT INTO $xclasses
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '-', '-', '-', '5230', 1 ),
	 ( 02, '1', 'элита-рекорд (ЭР)', 'элита-рекорд (ЭР)', 'ЭР', '5230', 1 ),
	 ( 03, '2', 'элита (Э)', 'элита (Э)', 'Э', '5230', 1 ),
	 ( 04, '3', 'первый (1КЛ)', 'первый (1КЛ)', '1КЛ', '5230', 1 ),
	 ( 05, '4', 'второй (2КЛ)', 'второй (2КЛ)', '2КЛ', '5230', 1 ),
	 ( 06, '5', 'неклассн. (НК)', 'неклассн. (НК)', 'НК', '5230', 1 )" );
	else mysql_query( "INSERT INTO $xclasses
	 ( `id`, `num`, `national_descr`, `nick`, `comments`, `locked`, `modif_uid` )
	 VALUES
	 ( 01, '0', '-', '-', '-', '5230', 1 ),
	 ( 02, '1', 'superior+ (S+)', 'superior+ (S+)', 'S+', '5230', 1 ),
	 ( 03, '2', 'superior (S)', 'superior (S)', 'S', '5230', 1 ),
	 ( 04, '3', 'first (1CL)', 'first (1CL)', '1CL', '5230', 1 ),
	 ( 05, '4', 'second (2CL)', 'другий (2CL)', '2CL', '5230', 1 ),
	 ( 06, '5', 'other (O)', 'other (O)', 'O', '5230', 1 )" );
}

mysql_query( "SELECT id FROM $c_f2ml", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	mysql_query( "CREATE TABLE $c_f2ml (
	 `id` int( 10 ) unsigned NOT NULL,
	 `created_date` date NOT NULL default '1991-12-31',
	 `created_time` time NOT NULL default '00:00:00',
	 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
	 `modif_date` date NOT NULL default '1991-12-31',
	 `modif_time` time NOT NULL default '00:00:00',
	 `a1_0101` varchar( 4 ) default '-1', `a1_0102` varchar( 2 ) default '-1', `a1_0103` varchar( 3 ) default '-1', `a1_0104` varchar( 7 ) default '-1', `a1_0105` varchar( 5 ) default '-1', `a1_0107` varchar( 5 ) default '-1',
	 `a1_0201` varchar( 4 ) default '-1', `a1_0202` varchar( 2 ) default '-1', `a1_0203` varchar( 3 ) default '-1', `a1_0204` varchar( 7 ) default '-1', `a1_0205` varchar( 5 ) default '-1', `a1_0207` varchar( 5 ) default '-1',
	 `a1_0301` varchar( 4 ) default '-1', `a1_0302` varchar( 2 ) default '-1', `a1_0303` varchar( 3 ) default '-1', `a1_0304` varchar( 7 ) default '-1', `a1_0305` varchar( 5 ) default '-1', `a1_0307` varchar( 5 ) default '-1',
	 `a1_0401` varchar( 4 ) default '-1', `a1_0402` varchar( 2 ) default '-1', `a1_0403` varchar( 3 ) default '-1', `a1_0404` varchar( 7 ) default '-1', `a1_0405` varchar( 5 ) default '-1', `a1_0407` varchar( 5 ) default '-1',
	 `a1_0501` varchar( 4 ) default '-1', `a1_0502` varchar( 2 ) default '-1', `a1_0503` varchar( 3 ) default '-1', `a1_0504` varchar( 7 ) default '-1', `a1_0505` varchar( 5 ) default '-1', `a1_0507` varchar( 5 ) default '-1',
	 `a1_0601` varchar( 4 ) default '-1', `a1_0602` varchar( 2 ) default '-1', `a1_0603` varchar( 3 ) default '-1', `a1_0604` varchar( 7 ) default '-1', `a1_0605` varchar( 5 ) default '-1', `a1_0607` varchar( 5 ) default '-1',
	 `a1_0701` varchar( 4 ) default '-1', `a1_0702` varchar( 2 ) default '-1', `a1_0703` varchar( 3 ) default '-1', `a1_0704` varchar( 7 ) default '-1', `a1_0705` varchar( 5 ) default '-1', `a1_0707` varchar( 5 ) default '-1',
	 `a1_0801` varchar( 4 ) default '-1', `a1_0802` varchar( 2 ) default '-1', `a1_0803` varchar( 3 ) default '-1', `a1_0804` varchar( 7 ) default '-1', `a1_0805` varchar( 5 ) default '-1', `a1_0807` varchar( 5 ) default '-1',
	 `a1_0901` varchar( 4 ) default '-1', `a1_0902` varchar( 2 ) default '-1', `a1_0903` varchar( 3 ) default '-1', `a1_0904` varchar( 7 ) default '-1', `a1_0905` varchar( 5 ) default '-1', `a1_0907` varchar( 5 ) default '-1',
	 `a1_19` varchar( 30 ) default '-1' )
	 $table_utf8 $mysql_TYPE COMMENT='Form 2-milk for cows'" );
//	echo "Table \"$c_f2ml\" is created... Adding defaults<br>";
	mysql_query( "INSERT INTO $c_f2ml ( `id` ) VALUES ( 1 )" );
}
mysql_query( "SELECT id FROM $o_f2ml", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	mysql_query( "CREATE TABLE $o_f2ml (
	 `id` int( 10 ) unsigned NOT NULL,
	 `created_date` date NOT NULL default '1991-12-31',
	 `created_time` time NOT NULL default '00:00:00',
	 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
	 `modif_date` date NOT NULL default '1991-12-31',
	 `modif_time` time NOT NULL default '00:00:00',
	 `a1_0000` varchar( 30 ) default '-1',
	 `a1_0101` varchar( 3 ) default '-1', `a1_0102` varchar( 7 ) default '-1', `a1_0103` varchar( 5 ) default '-1',
	 `a1_0201` varchar( 3 ) default '-1', `a1_0202` varchar( 5 ) default '-1', `a1_0203` varchar( 5 ) default '-1',
	 `a1_0301` varchar( 5 ) default '-1', `a1_0303` varchar( 5 ) default '-1',
	 `a1_0401` varchar( 3 ) default '-1', `a1_0402` varchar( 5 ) default '-1', `a1_0403` varchar( 5 ) default '-1',
	 `a1_0501` varchar( 100 ) default '-1', `a1_0503` varchar( 5 ) default '-1')
	 $table_utf8 $mysql_TYPE COMMENT='Form 2-milk for oxes'" );
//	echo "Table \"$o_f2ml\" is created... Adding defaults<br>";
	mysql_query( "INSERT INTO $o_f2ml ( `id` ) VALUES ( 1 )" );
}

mysql_query( "SELECT a2_0101 FROM $c_f2ml", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	$alter_query="ALTER TABLE `$c_f2ml`
	 ADD `a2_0101` varchar( 30 ) NOT NULL DEFAULT '-1' AFTER `a1_19`,
	 ADD `a2_0102` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a2_0101`";
	for ( $i=2; $i<=12; $i++ )
		$alter_query=$alter_query.",
	 ADD `a2_".Int2StrZ( $i, 2 )."01` varchar( 30 ) NOT NULL DEFAULT '-1' AFTER `a2_".Int2StrZ( $i-1, 2)."02`,
	 ADD `a2_".Int2StrZ( $i, 2 )."02` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a2_".Int2StrZ( $i, 2)."01`";
	$alter_query=$alter_query.",
	 ADD `a3_0101` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a2_1202`,
	 ADD `a3_0102` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_0101`,
	 ADD `a3_0103` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_0102`,
	 ADD `a3_0104` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_0103`,
	 ADD `a3_0105` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_0104`";
	for ( $i=2; $i<=10; $i++ )
		$alter_query=$alter_query.",
	 ADD `a3_".Int2StrZ( $i, 2 )."01` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_".Int2StrZ( $i-1, 2 )."05`,
	 ADD `a3_".Int2StrZ( $i, 2 )."02` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_".Int2StrZ( $i, 2 )."01`,
	 ADD `a3_".Int2StrZ( $i, 2 )."03` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_".Int2StrZ( $i, 2 )."02`,
	 ADD `a3_".Int2StrZ( $i, 2 )."04` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_".Int2StrZ( $i, 2 )."03`,
	 ADD `a3_".Int2StrZ( $i, 2 )."05` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a3_".Int2StrZ( $i, 2 )."04`";
	Sql_query( $alter_query );
}

mysql_query( "SELECT a41_0101 FROM $c_f2ml", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	$alter_query="ALTER TABLE `$c_f2ml`";
	for ( $k=41; $k<=43; $k++ ) {
		if ( $k==41 ) { $prev="a3_1005"; $len=7;}
		if ( $k==42 ) { $prev="a41_0900"; $len=5;}
		if ( $k==43 ) { $prev="a42_0912"; $len=5;}
		if ( $k!=41 ) $alter_query=$alter_query.",";
		$alter_query=$alter_query."
	 ADD `a".$k."_0101` varchar( ".$len." ) NOT NULL DEFAULT '-1' AFTER `".$prev."`";
		for ( $i=1; $i<=9; $i++ ) {
			for ( $j=2; $j<=12; $j++ ) $alter_query=$alter_query.",
	 ADD `a".$k."_".Int2StrZ( $i, 2 ).Int2StrZ( $j, 2 )."` varchar( ".$len." ) NOT NULL DEFAULT '-1' AFTER `a".$k."_".Int2StrZ( $i, 2).Int2StrZ( $j-1, 2)."`";
			if ( $k==41 ) {
				$alter_query=$alter_query.",
	 ADD `a".$k."_".Int2StrZ( $i, 2 )."00` varchar( 4 ) NOT NULL DEFAULT '-1' AFTER `a".$k."_".Int2StrZ( $i, 2).Int2StrZ( $j-1, 2)."`";
 				if ( $i!=9 ) $alter_query=$alter_query.",
	 ADD `a".$k."_".Int2StrZ( $i+1, 2 )."01` varchar( ".$len." ) NOT NULL DEFAULT '-1' AFTER `a".$k."_".Int2StrZ( $i, 2)."00`";
			} else if ( $i!=9 ) $alter_query=$alter_query.",
	 ADD `a".$k."_".Int2StrZ( $i+1, 2 )."01` varchar( ".$len." ) NOT NULL DEFAULT '-1' AFTER `a".$k."_".Int2StrZ( $i, 2).Int2StrZ( $j-1, 2)."`";
		}
	}
	Sql_query( $alter_query );
}

mysql_query( "SELECT a5_0101 FROM $c_f2ml", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	$alter_query="ALTER TABLE `$c_f2ml`
	 ADD `a5_0101` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a43_0912`,
	 ADD `a5_0102` varchar( 10 ) NOT NULL DEFAULT '-1' AFTER `a5_0101`,
	 ADD `a5_0103` varchar( 30 ) NOT NULL DEFAULT '-1' AFTER `a5_0102`,
	 ADD `a5_0104` varchar( 10 ) NOT NULL DEFAULT '-1' AFTER `a5_0103`,
	 ADD `a5_0105` varchar( 10 ) NOT NULL DEFAULT '-1' AFTER `a5_0104`,
	 ADD `a5_0106` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a5_0105`,
	 ADD `a5_0107` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a5_0106`";
	for ( $i=2; $i<=11; $i++ ) $alter_query=$alter_query.",
	 ADD `a5_".Int2StrZ( $i, 2 )."01` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a5_".Int2StrZ( $i-1, 2 )."07`,
	 ADD `a5_".Int2StrZ( $i, 2 )."02` varchar( 10 ) NOT NULL DEFAULT '-1' AFTER `a5_".Int2StrZ( $i, 2 )."01`,
	 ADD `a5_".Int2StrZ( $i, 2 )."03` varchar( 30 ) NOT NULL DEFAULT '-1' AFTER `a5_".Int2StrZ( $i, 2 )."02`,
	 ADD `a5_".Int2StrZ( $i, 2 )."04` varchar( 10 ) NOT NULL DEFAULT '-1' AFTER `a5_".Int2StrZ( $i, 2 )."03`,
	 ADD `a5_".Int2StrZ( $i, 2 )."05` varchar( 10 ) NOT NULL DEFAULT '-1' AFTER `a5_".Int2StrZ( $i, 2 )."04`,
	 ADD `a5_".Int2StrZ( $i, 2 )."06` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a5_".Int2StrZ( $i, 2 )."05`,
	 ADD `a5_".Int2StrZ( $i, 2 )."07` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a5_".Int2StrZ( $i, 2 )."06`";
	$alter_query=$alter_query.",
	 ADD `a6_0101` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a5_1107`,
	 ADD `a6_0102` varchar( 3 ) NOT NULL DEFAULT '-1' AFTER `a6_0101`,
	 ADD `a6_0103` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_0102`,
	 ADD `a6_0104` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_0103`,
	 ADD `a6_0105` varchar( 5 ) NOT NULL DEFAULT '-1' AFTER `a6_0104`,
	 ADD `a6_0106` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_0105`,
	 ADD `a6_0107` varchar( 5 ) NOT NULL DEFAULT '-1' AFTER `a6_0106`,
	 ADD `a6_0108` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_0107`,
	 ADD `a6_0109` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a6_0108`";
	for ( $i=2; $i<=11; $i++ ) $alter_query=$alter_query.",
	 ADD `a6_".Int2StrZ( $i, 2 )."01` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i-1, 2 )."09`,
	 ADD `a6_".Int2StrZ( $i, 2 )."02` varchar( 3 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."01`,
	 ADD `a6_".Int2StrZ( $i, 2 )."03` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."02`,
	 ADD `a6_".Int2StrZ( $i, 2 )."04` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."03`,
	 ADD `a6_".Int2StrZ( $i, 2 )."05` varchar( 5 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."04`,
	 ADD `a6_".Int2StrZ( $i, 2 )."06` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."05`,
	 ADD `a6_".Int2StrZ( $i, 2 )."07` varchar( 5 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."06`,
	 ADD `a6_".Int2StrZ( $i, 2 )."08` varchar( 7 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."07`,
	 ADD `a6_".Int2StrZ( $i, 2 )."09` varchar( 6 ) NOT NULL DEFAULT '-1' AFTER `a6_".Int2StrZ( $i, 2 )."08`";
	$alter_query=$alter_query.",
	 ADD `a7_0101` varchar( 3 ) NOT NULL DEFAULT '-1' AFTER `a6_1109`,
	 ADD `a7_0102` varchar( 30 ) NOT NULL DEFAULT '-1' AFTER `a7_0101`";
	for ( $i=2; $i<=11; $i++ ) $alter_query=$alter_query.",
	 ADD `a7_".Int2StrZ( $i, 2 )."01` varchar( 3 ) NOT NULL DEFAULT '-1' AFTER `a7_".Int2StrZ( $i-1, 2 )."02`,
	 ADD `a7_".Int2StrZ( $i, 2 )."02` varchar( 30 ) NOT NULL DEFAULT '-1' AFTER `a7_".Int2StrZ( $i, 2 )."01`";
	$alter_query=$alter_query.",
	 ADD `a8_0101` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a7_1102`,
	 ADD `a8_0102` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_0101`,
	 ADD `a8_0103` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_0102`,
	 ADD `a8_0104` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_0103`,
	 ADD `a8_0105` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_0104`,
	 ADD `a8_0106` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_0105`";
	for ( $i=2; $i<=11; $i++ ) $alter_query=$alter_query.",
	 ADD `a8_".Int2StrZ( $i, 2 )."01` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_".Int2StrZ( $i-1, 2 )."06`,
	 ADD `a8_".Int2StrZ( $i, 2 )."02` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_".Int2StrZ( $i, 2 )."01`,
	 ADD `a8_".Int2StrZ( $i, 2 )."03` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_".Int2StrZ( $i, 2 )."02`,
	 ADD `a8_".Int2StrZ( $i, 2 )."04` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_".Int2StrZ( $i, 2 )."03`,
	 ADD `a8_".Int2StrZ( $i, 2 )."05` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_".Int2StrZ( $i, 2 )."04`,
	 ADD `a8_".Int2StrZ( $i, 2 )."06` varchar( 2 ) NOT NULL DEFAULT '-1' AFTER `a8_".Int2StrZ( $i, 2 )."05`";
	Sql_query( $alter_query );
}

mysql_query( "SELECT jaggs FROM $hardwj", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	mysql_query( "CREATE TABLE $hardwj (
	 `jaggs` tinyint( 2 ) unsigned NOT NULL default '0',
	 `ports` tinyint( 2 ) unsigned NOT NULL default '0',
	 `ports_type` varchar( 30 ) NOT NULL default 'COM',
	 `port_first` tinyint( 2 ) unsigned NOT NULL default '0',
	 `driver_dir` varchar( 255 ) NOT NULL default '/var/_df2drv',
	 `driver_fname` varchar( 30 ) NOT NULL default 'httpsep' )
	 $table_utf8 $mysql_TYPE COMMENT='Hardware (jagg) configuration *$hardwj.MYD*'" );
	echo "Table \"$hardwj\" is created... Adding defaults...<br>";
	mysql_query( "INSERT INTO $hardwj (
	 `ports` )
	 VALUES (
	 '0' )" );
}

mysql_query( "SELECT limits FROM $limits", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	mysql_query( "CREATE TABLE $limits (
	 `limits` text NOT NULL )
	 $table_utf8 $mysql_TYPE COMMENT='Limits *$limits.MYD*'" );
//	echo "Table \"$limits\" is created...<br>";
	mysql_query( "INSERT INTO $limits (
	 `limits` )
	 VALUES (
	 '$insem1st_varname:480;$not_abort1st_varname:760;$rectal_varname:60;$insem_fault_rectal_varname:21;$prep_zapusk_varname:210;$zapusk_varname:230;$not_abort_varname:280;$insem_varname:30;$insem_abort_varname:30' )" );
}

mysql_query( "SELECT rfid_native FROM $tags", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	mysql_query( "CREATE TABLE $tags (
	 `created_date` date NOT NULL default '1991-12-31',
	 `created_time` time NOT NULL default '00:00:00',
	 `cow_num` varchar( 7 ) default '',
	 `rfid_num` varchar( 30 ) default '',
	 `rfid_native` varchar( 30 ) default '',
	 `rfid_date` date NOT NULL default '1991-12-31',
	 `rfid_time` time NOT NULL default '00:00:00',
	 `modif_date` date NOT NULL default '1991-12-31',
	 `modif_time` time NOT NULL default '00:00:00' )
	 $table_utf8 $mysql_TYPE" );

mysql_query( "SELECT * FROM $budms", $db );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	mysql_query( "CREATE TABLE $budms (
	 `id` int( 2 ) unsigned NOT NULL auto_increment,
	 `created_date` date NOT NULL default '1991-12-31',
	 `created_time` time NOT NULL default '00:00:00',
	 `num` varchar( 2 ) NOT NULL default '0',
	 `stall_min` int( 5 ) unsigned NOT NULL default '0',
	 `stall_max` int( 5 ) unsigned NOT NULL default '0',
	 `dev_min` tinyint( 2 ) unsigned NOT NULL default '0',
	 `dev_max` tinyint( 2 ) unsigned NOT NULL default '0',
	 `ready` tinyint( 1 ) unsigned NOT NULL default '0',
	 `modif_uid` tinyint( 3 ) unsigned NOT NULL default '2',
	 `modif_date` date NOT NULL default '1991-12-31',
	 `modif_time` time NOT NULL default '00:00:00',
	 PRIMARY KEY ( `id` ))
	 $table_utf8 $mysql_TYPE COMMENT='BUDMs *$budms.MYD*'" );
	mysql_query( "INSERT INTO $budms
	 ( `id`, `num`, `modif_uid` )
	 VALUES
	 ( 1, '01', 1 ),
	 ( 2, '02', 1 )" );
}

ob_end_flush();
?>
