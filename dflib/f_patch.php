<?php
/* DF_2: dflib/f_patch.php
patch database (ALTER TABLE)
c: 06.10.2008
m: 16.11.2015 */

ob_start();//lock output to set cookies properly!

//DROP UNUSED TABLES
mysql_query( "SELECT * FROM $parlorstate" ); $sqlerr=mysql_errno();
if ( $sqlerr==0 ) mysql_query( "DROP TABLE `$parlorstate`", $db );
mysql_query( "SELECT * FROM $cowsdyna" ); $sqlerr=mysql_errno();
if ( $sqlerr==0 ) mysql_query( "DROP TABLE `$cowsdyna`", $db );
mysql_query( "SELECT * FROM $cowsstat" ); $sqlerr=mysql_errno();
if ( $sqlerr==0 ) mysql_query( "DROP TABLE `$cowsstat`", $db );

//FIX DATABASE VERSION
mysql_query( "SELECT db_rel FROM $globals" ); $sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$globals`
	 ADD `db_rel` varchar( 11 ) NOT NULL default '[2009:0808]'" );

$res=mysql_query( "SELECT id, nick, comments FROM $person WHERE nick='anonymous'" );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	$row=mysql_fetch_row( $res );
	if ( $row[0]*1==2 ) {
		if ( $lang=="uk" ) {
			$anonymous_co="гiсть";
			$admin_co="адмiн";
		} else if ( $lang=="ru" ) {
			$anonymous_co="гость";
			$admin_co="админ";
		}
		mysql_query( "INSERT INTO $person
		 ( `id`, `user_id`, `num`,
		 `nick`, `comments`, `passw`,
		 `locked`, `valid_from`, `valid_to`, `modif_uid` )
		 VALUES
		 ( 9, 9, '8',
		 'anonymous', '$anonymous_co', '',
		 '5230', '1991-01-01', '2037-12-31', 1 )" );
		mysql_query( "UPDATE $person SET
		 nick='admin', comments='$admin_co', passw='5237',
		 locked='5230', valid_from='1991-01-01', valid_to='2037-12-31'
		 WHERE id*1=2" );
		mysql_query( "DELETE FROM $person WHERE id*1=4" );
	}
	if ( $lang=="ru" ) {
		if ( $row[2]!="гость" ) {
			mysql_query( "UPDATE $person SET comments='гость'
			 WHERE id=9" );
			mysql_query( "UPDATE $person SET comments='администратор'
			 WHERE id=2" );
		}
		mysql_query( "UPDATE $person SET comments='сервис'
		 WHERE id=1" );
	}
	if ( $lang=="uk" ) {
		if ( $row[2]!="гість" ) {
			mysql_query( "UPDATE $person SET comments='гість'
			 WHERE id=9" );
			mysql_query( "UPDATE $person SET comments='адміністратор'
			 WHERE id=2" );
		}
		mysql_query( "UPDATE $person SET comments='сервіс'
		 WHERE id=1" );
	}
}

$res=mysql_query( "SELECT passw FROM $person WHERE nick='root'" );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
	$row=mysql_fetch_row( $res );
	if ( $row[0]*1==5230 ) {
		mysql_query( "UPDATE $person SET
		 passw='20095230',
		 valid_from='1991-01-01', valid_to='2037-12-31'
		 WHERE nick='root'" );
		mysql_query( "UPDATE $person SET
		 passw='5237',
		 valid_from='1991-01-01', valid_to='2037-12-31'
		 WHERE nick='admin'" );
		mysql_query( "UPDATE $person SET
		 passw='501',
		 valid_from='1991-01-01', valid_to='2037-12-31'
		 WHERE nick='operator'" );
	}
}

mysql_query( "SELECT restrict_sched FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	Sql_query( "ALTER TABLE `$cows`
	 ADD `restrict_sched` varchar( 90 ) NOT NULL default '' AFTER `dont_use`,
	 ADD `_function` tinyint( 3 ) unsigned NOT NULL default '1' AFTER `lot_id`,
	 ADD `_race` tinyint( 3 ) unsigned NOT NULL default '1' AFTER `_function`,
	 ADD `_class` tinyint( 3 ) unsigned NOT NULL default '1' AFTER `_race`" );
	Sql_query( "ALTER TABLE `$oxes`
	 ADD `_function` tinyint( 3 ) unsigned NOT NULL default '1' AFTER `lot_id`,
	 ADD `_race` tinyint( 3 ) unsigned NOT NULL default '1' AFTER `_function`,
	 ADD `_class` tinyint( 3 ) unsigned NOT NULL default '1' AFTER `_race`" );
}

mysql_query( "SELECT i_date FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$cows`
	 ADD `i_date` date NOT NULL default '1991-12-31' AFTER `b_num`" );

mysql_query( "SELECT i_date FROM $oxes" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$oxes`
	 ADD `i_date` date NOT NULL default '1991-12-31' AFTER `b_num`" );

mysql_query( "SELECT chief_animal_technician FROM $globals" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$globals`
	 DROP `mainzoo`,
	 ADD `chief_animal_technician` varchar( 100 ) NOT NULL default '' AFTER `chief`" );

mysql_query( "SELECT halt_timeout FROM $globals" ); $sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$globals`
	 DROP `power`,
	 ADD `halt_timeout` varchar( 5 ) NOT NULL default '-2' AFTER `totaldevs`" );

mysql_query( "SELECT halt_timeout_def FROM $globals" ); $sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$globals`
	 ADD `halt_timeout_def` mediumint( 5 ) NOT NULL default '1200' AFTER `halt_timeout`" );

mysql_query( "SELECT rfid_mode FROM $globals" ); $sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$globals`
	 ADD `rfid_mode` tinyint( 1 ) NOT NULL default '1' AFTER `farm`" );

mysql_query( "SELECT owner FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr==0 )
	Sql_query( "ALTER TABLE `$cows`
	 DROP `owner`, DROP `b_place`" );
mysql_query( "SELECT owner_id FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$cows`
	 ADD `b_place_id` int( 10 ) unsigned NOT NULL default '1' AFTER `b_num`,
	 ADD `owner_id` int( 10 ) unsigned NOT NULL default '1' AFTER `i_date`" );

mysql_query( "SELECT owner FROM $oxes" );
$sqlerr=mysql_errno();
if ( $sqlerr==0 )
	Sql_query( "ALTER TABLE `$oxes`
	 DROP `owner`, DROP `b_place`" );
mysql_query( "SELECT owner_id FROM $oxes" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$oxes`
	 ADD `b_place_id` int( 10 ) unsigned NOT NULL default '1' AFTER `b_num`,
	 ADD `owner_id` int( 10 ) unsigned NOT NULL default '1' AFTER `i_date`" );

$db_rel=DbRelease( $globals, $db )*1;
if ( $db_rel<=20091120 ) {
	mysql_query( "SELECT * FROM 000000_o" );
	$sqlerr=mysql_errno();
	if ( $sqlerr==0 ) {
		mysql_query( "ALTER TABLE `000000_o`
		 DROP INDEX `day`, DROP INDEX `month`, DROP INDEX `year`,
		 DROP INDEX `cow_id`" );
		$sqlerr=mysql_errno();
		mysql_query( "ALTER TABLE `000000_o`
		 ADD INDEX (day), ADD INDEX (month), ADD INDEX (year),
		 ADD INDEX (cow_id)" );
	}
}

mysql_query( "SELECT total_date FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	mysql_query( "ALTER TABLE `$cows`
	 DROP `milk_total`, DROP `milk_q`, DROP `milk_max`, DROP `milk_min`,
	 DROP `lact_days`,
	 DROP `milkm_total`, DROP `milkm_q`, DROP `milkm_max`, DROP `milkm_min`" );
	mysql_query( "ALTER TABLE `$cows`
	 ADD `milk0_total` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milk0_q` mediumint( 7 ) unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milk0_max` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milk0_min` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `lact0_days` smallint( 4 ) NOT NULL default '-1' AFTER `now_s10`,
	 ADD `milkm0_total` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milkm0_q` mediumint( 7 ) unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milkm0_max` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milkm0_min` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `total0_date` date NOT NULL default '1981-12-01' AFTER `now_s10`,
	 ADD `milk_total` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milk_q` mediumint( 7 ) unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milk_max` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milk_min` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `lact_days` smallint( 4 ) NOT NULL default '-1' AFTER `now_s10`,
	 ADD `milkm_total` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milkm_q` mediumint( 7 ) unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milkm_max` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `milkm_min` double unsigned NOT NULL default '0' AFTER `now_s10`,
	 ADD `total_date` date NOT NULL default '1981-12-01' AFTER `now_s10`" );
}

mysql_query( "SELECT dep_id FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$cows`
	 ADD `dep_id` smallint( 5 ) unsigned NOT NULL default '1' AFTER `fth_id`" );

$res=mysql_query( "SELECT id FROM $operstyp WHERE id=8192" );
$row=mysql_fetch_row( $res );
if ( $row[0]*1!=8192 )
	if ( $lang=="uk" ) mysql_query( "INSERT INTO $operstyp
		 ( `id`, `descr`, `comments`,
		 `locked`, `modif_uid` )
		 VALUES
		 ( 8192, 'планування доїнь', '*планування доїнь',
		 '5230', 1 )" );
	else if ( $lang=="ru" ) mysql_query( "INSERT INTO $operstyp
		 ( `id`, `descr`, `comments`,
		 `locked`, `modif_uid` )
		 VALUES
		 ( 8192, 'план доений', '*план доений',
		 '5230', 1 )" );

mysql_query( "UPDATE $operstyp SET int_res='0'" );
for ( $i=0; $i<count( $operspriv ); $i++ ) {
	$j=$i+1;
	mysql_query( "UPDATE $operstyp SET int_res='$j' WHERE id='$operspriv[$i]'" );
}

mysql_query( "SELECT drmds_by_pit FROM $hardw" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$hardw`
	 DROP `men_by_pit`,
	 ADD `drmds_by_pit` tinyint( 1 ) unsigned NOT NULL default '1' AFTER `pits`" );
mysql_query( "SELECT drmd_bds FROM $hardw" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$hardw`
	 ADD `drmd_bds` tinyint( 1 ) unsigned NOT NULL default '1' AFTER `drmds_by_pit`" );
mysql_query( "SELECT man_bds FROM $hardw" );
$sqlerr=mysql_errno();
if ( $sqlerr==0 )
	Sql_query( "ALTER TABLE `$hardw`
	 DROP `man_bds`" );
mysql_query( "SELECT port_bps FROM $hardw" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$hardw`
	 ADD `port_bps` mediumint( 6 ) unsigned NOT NULL default '2400' AFTER `port_first`" );

mysql_query( "SELECT port_bps FROM $hardwj" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$hardwj`
	 ADD `port_bps` mediumint( 6 ) unsigned NOT NULL default '9600' AFTER `port_first`" );
mysql_query( "SELECT ignore_similar FROM $hardwj" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$hardwj`
	 ADD `ignore_similar` tinyint NOT NULL default '0' AFTER `ports`" );
mysql_query( "SELECT cmd_timeout FROM $hardwj" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$hardwj`
	 ADD `cmd_timeout` mediumint unsigned NOT NULL default '3000' AFTER `ports`" );

mysql_query( "SELECT port_bps FROM $hardwports" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$hardwports`
	 ADD `port_bps` mediumint( 6 ) unsigned NOT NULL default '2400' AFTER `port_name`" );

mysql_query( "SELECT ctrl_value_01 FROM $lots" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$lots`
	 ADD `ctrl_value_02` varchar( 5 ) NOT NULL default '-1' AFTER `locked`,
	 ADD `ctrl_value_01` varchar( 5 ) NOT NULL default '-1' AFTER `locked`" );
mysql_query( "SELECT ctrl_value_01 FROM $groups" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$groups`
	 ADD `ctrl_value_02` varchar( 5 ) NOT NULL default '-1' AFTER `locked`,
	 ADD `ctrl_value_01` varchar( 5 ) NOT NULL default '-1' AFTER `locked`" );
mysql_query( "SELECT ctrl_value_01 FROM $subgrs" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$subgrs`
	 ADD `ctrl_value_02` double NOT NULL default '-1' AFTER `locked`,
	 ADD `ctrl_value_01` double NOT NULL default '-1' AFTER `locked`" );

$db_rel=DbRelease( $globals, $db )*1;
if ( $db_rel!=20101130 ) {
	$res=mysql_query( "SHOW TABLES LIKE '%_m'" );
	$sqlerr=mysql_errno();
	$tables_1=0; $tables_=0;
	if ( $sqlerr==0 ) {
		while ( $row=mysql_fetch_row( $res )) {
			if ( $tables_1==0 ) $tables_1=$row[0];
			else $tables_1=$row[0].";".$tables_1;
			$tables_++;
		}
		if ( $tables_>0 ) {
			$tables=split( ";", trim( $tables_1 ));
			$tables_2=0; $tables_=0;
			for ( $i=0; $i<count( $tables ); $i++ ) {
//echo "+$tables[$i]!";
				$res=mysql_query( "SELECT gr_id FROM $tables[$i]", $db );
				$sqlerr=mysql_errno();
				if ( $sqlerr!=0 ) {
					if ( $tables_2==0 ) $tables_2=$tables[$i];
					else $tables_2=$tables[$i].";".$tables_2;
					$tables_++;
				}
			}
//echo "<br>";
			$tables=split( ";", trim( $tables_2 ));
			if ( $tables_>0 ) {
				for ( $i=0; $i<count( $tables ); $i++ ) {
//echo "+$tables[$i]!";
					$alter_query="ALTER TABLE `$tables[$i]`
					 ADD `lot_id` smallint( 5 ) unsigned NOT NULL default '1' AFTER `cow_id`,
					 ADD `gr_id` smallint( 5 ) unsigned NOT NULL default '1' AFTER `cow_id`,
					 ADD `subgr_id` smallint( 5 ) unsigned NOT NULL default '1' AFTER `cow_id`";
					Sql_query( $alter_query );
				}
			}
//echo "<br>";
			$db_ready=1;
			$tables=split( ";", trim( $tables_1 ));//LAST CHECK MUST BE DONE WITH FULL LIST!
			for ( $i=0; $i<count( $tables ); $i++ ) {
//echo "+$tables[$i]!";
				$res=mysql_query( "SELECT gr_id FROM $tables[$i]", $db );
				$sqlerr=mysql_errno();
				if ( $sqlerr!=0 ) $db_ready=-1;
			}
//echo "<br>";
			if ( $db_ready>0 ) $res=mysql_query( "UPDATE $globals SET db_rel='[2010:1130]'" );
		}
	}
}

mysql_query( "SELECT b_dates_res FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$cows`
	 ADD `b_dates_res` smallint( 3 ) unsigned NOT NULL default '1' AFTER `b_dates`" );
mysql_query( "SELECT c_dates_res FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$cows`
	 ADD `c_dates_res` smallint( 3 ) unsigned NOT NULL default '1' AFTER `c_dates`" );
mysql_query( "SELECT z_dates FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$cows`
	 ADD `z_dates` varchar( 10 ) NOT NULL default '' AFTER `c_dates_res`" );

$db_rel=DbRelease( $globals, $db )*1;
if ( $db_utf8==1 & $db_rel<20110201 ) {
	$db_ready=0;
	$dbt="000000_o";
	$res=mysql_query( "SHOW TABLE STATUS LIKE '$dbt'" );
	$sqlerr=mysql_errno();
	if ( $sqlerr==0 ) {
		$row=mysql_fetch_row( $res );
		if ( $row[14]!="utf8_general_ci" ) {
			mysql_query( "ALTER TABLE $dbt CHARACTER SET utf8 COLLATE utf8_general_ci" );
			mysql_query( "ALTER TABLE $dbt DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci" );
			mysql_query( "ALTER TABLE $dbt CONVERT TO CHARACTER SET utf8" );
			$sqlerr=mysql_errno();
			if ( $sqlerr==0 ) {
				$res=mysql_query( "SHOW TABLE STATUS LIKE '$dbt'" );
				$row=mysql_fetch_row( $res );
				if ( $row[14]=="utf8_general_ci" ) $db_ready=1;
			}
		} else {
			$db_ready=1;
		}
	}
	if ( $row[14]=="utf8_general_ci" ) {
		$db_ready=1;
		mysql_query( "UPDATE $globals SET db_rel='[2011:0201]'" );
		mysql_query( "ALTER DATABASE $db_name CHARACTER SET utf8 COLLATE utf8_general_ci" );
		mysql_query( "ALTER DATABASE $db_name DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci" );
	}
}

$db_rel=DbRelease( $globals, $db )*1;
if ( $db_rel<20110211 ) {
	$db_ready=1;
	$dbt="000000_o";
	mysql_query( "UPDATE $cows SET
	 a_dates='', b_dates='', b_dates_res, c_dates='', c_dates_res='', z_dates=''
	 modif_uid='1', modif_date='1991-01-01', modif_time='00:00:00'" );
	$a_upd_cnt=0;
	$res=mysql_query( "SELECT id, b_date, mth_id
	 FROM $cows WHERE mth_id<>1" );
	while ( $row=mysql_fetch_row( $res )) {
		$opdate=$row[1]; $mth_id=$row[2];
		if ( $a_mths_ready[$mth_id]==0 ) { $a_mths[$a_upd_cnt]=$mth_id; $a_mths_date[$mth_id]=$opdate; $a_upd_cnt++;}
		else if ( $opdate>$a_mths_date[$mth_id] ) { $a_mths_date[$mth_id]=$opdate;}
		$a_mths_ready[$mth_id]=1;
	}
	for ( $i=0; $i<$a_upd_cnt; $i++ ) {
		$mth_id=$a_mths[$i];
		mysql_query( "UPDATE $cows SET
		 c_dates='$a_mths_date[$mth_id]', c_dates_res='4',
		 modif_uid='1', modif_date='1991-12-31', modif_time='12:12:12'
		 WHERE id=$mth_id" );
	}
	$i_upd_cnt=0; $r_upd_cnt=0;//DONT RESET $a_upd_cnt!!!
	$res=mysql_query( "SELECT cow_id, day, month, year, int_7, oper_id
	 FROM $dbt
	 WHERE oper_id=128 OR oper_id=256 OR oper_id=512 OR oper_id=1024 OR oper_id=2048
	 ORDER BY $dbt.year*10000+$dbt.month*100+$dbt.day+$dbt.code/100000000" );
	$sqlerr=mysql_errno();
	if ( $sqlerr==0 ) {
		while ( $row=mysql_fetch_row( $res )) {
			$mth_id=$row[0]; $oper_id=$row[5]; $int_7=$row[4];
			$dd=$row[1]; $mm=$row[2]; $yyyy=$row[3];
			$opdate=$yyyy."-".$mm."-".$dd;
			if ( $oper_id==128 | $oper_id==256 ) {
				if ( $i_mths_ready[$mth_id]==0 ) {
					$i_mths[$i_upd_cnt]=$mth_id;
					$i_mths_date[$mth_id]=$opdate; $i_upd_cnt++;
				} else if ( $opdate>$i_mths_date[$mth_id] ) {
					$i_mths_date[$mth_id]=$opdate;
				}
				$i_mths_ready[$mth_id]=1;
			} elseif ( $oper_id==512 ) {
				if ( $r_mths_ready[$mth_id]==0 ) {
					$r_mths[$r_upd_cnt]=$mth_id;
					$r_mths_res[$mth_id]=$int_7;
					$r_mths_date[$mth_id]=$opdate; $r_upd_cnt++;
				} else if ( $opdate>=$r_mths_date[$mth_id] ) {
					$r_mths_res[$mth_id]=$int_7;
					$r_mths_date[$mth_id]=$opdate;
				}
				$r_mths_ready[$mth_id]=1;
			} elseif ( $oper_id==1024 | $oper_id==2048 ) {
				if ( $a_mths_ready[$mth_id]==0 ) {
					$a_mths[$a_upd_cnt]=$mth_id;
					$a_mths_date[$mth_id]=$opdate; $a_upd_cnt++;
				} else if ( $opdate>$a_mths_date[$mth_id] ) {
					$a_mths_date[$mth_id]=$opdate;
				}
				if ( $oper_id==1024 ) $a_mths_res[$mth_id]=2; else $a_mths_res[$mth_id]=4;
				$a_mths_ready[$mth_id]=1;
			}
		}
		for ( $i=0; $i<$i_upd_cnt; $i++ ) {
			$mth_id=$i_mths[$i];
			mysql_query( "UPDATE $cows SET
			 a_dates='$i_mths_date[$mth_id]',
			 modif_uid='1', modif_date='1991-12-31', modif_time='12:12:12'
			 WHERE id=$mth_id" );
		}
		for ( $i=0; $i<$r_upd_cnt; $i++ ) {
			$mth_id=$r_mths[$i];
			mysql_query( "UPDATE $cows SET
			 b_dates='$r_mths_date[$mth_id]', b_dates_res='$r_mths_res[$mth_id]',
			 modif_uid='1', modif_date='1991-12-31', modif_time='12:12:12'
			 WHERE id=$mth_id" );
		}
		for ( $i=0; $i<$a_upd_cnt; $i++ ) {
			$mth_id=$a_mths[$i];
			mysql_query( "UPDATE $cows SET
			 c_dates='$a_mths_date[$mth_id]', c_dates_res='$a_mths_res[$mth_id]',
			 modif_uid='1', modif_date='1991-12-31', modif_time='12:12:12'
			 WHERE id=$mth_id" );
		}
	}
	$s_upd_cnt=0;
	$res=mysql_query( "SELECT cow_id, day, month, year
	 FROM $dbt
	 WHERE oper_id=64 AND int_8=7
	 ORDER BY $dbt.year*10000+$dbt.month*100+$dbt.day+$dbt.code/100000000" );
	$sqlerr=mysql_errno();
	if ( $sqlerr==0 ) {
		while ( $row=mysql_fetch_row( $res )) {
			$mth_id=$row[0];
			$dd=$row[1]; $mm=$row[2]; $yyyy=$row[3];
			$opdate=$yyyy."-".$mm."-".$dd;
			if ( $s_mths_ready[$mth_id]==0 ) {
				$s_mths[$s_upd_cnt]=$mth_id;
				$s_mths_date[$mth_id]=$opdate; $s_upd_cnt++;
			} else if ( $opdate>=$s_mths_date[$mth_id] ) {
				$s_mths_date[$mth_id]=$opdate;
			}
			$s_mths_ready[$mth_id]=1;
		}
		for ( $i=0; $i<$s_upd_cnt; $i++ ) {
			$mth_id=$s_mths[$i];
			mysql_query( "UPDATE $cows SET
			 z_dates='$s_mths_date[$mth_id]',
			 modif_uid='1', modif_date='1991-12-31', modif_time='12:12:12'
			 WHERE id=$mth_id" );
			$sqlerr=mysql_errno();
		}
	}
	if ( $db_ready>0 ) mysql_query( "UPDATE $globals SET db_rel='[2011:0211]'" );
}

//NOT_TESTED!!! 28.03.2011
//mysql_query( "SELECT * FROM 000000_o" );
//$sqlerr=mysql_errno();
//if ( $sqlerr==0 ) {
//	mysql_query( "SELECT suboper_id FROM 000000_o" );
//	$sqlerr=mysql_errno();
//	if ( $sqlerr==0 ) {
//		mysql_query( "ALTER TABLE `000000_o`
//		 ADD `sub__oper_id` mediumint( 8 ) unsigned NOT NULL default '0' AFTER `suboper_id`" );
//		mysql_query( "ALTER TABLE `000000_o`
//		 ADD `sub__code` int( 10 ) unsigned NOT NULL default '0' AFTER `sub__oper_id`" );
//		mysql_query( "ALTER TABLE `000000_o`
//		 DROP `suboper_id`" );
//	}
//}

mysql_query( "SELECT id_cow_num FROM $parlor" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$parlor`
	 ADD `id_cow_num` varchar( 7 ) NOT NULL default '' AFTER `id_time`" );
mysql_query( "SELECT rep_cow_num FROM $parlor" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$parlor`
	 ADD `rep_cow_num` varchar( 7 ) NOT NULL default '' AFTER `rep_time`" );

mysql_query( "SELECT r_mult FROM $parlor" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$parlor`
	 ADD `r_mult` float NOT NULL default 1 AFTER `r`" );

//IMPORTANT! 13.02.2011
Sql_query( "UPDATE $cows SET
 mth_id='1', fth_id='1', breed_id='1', gr_id='1', subgr_id='1'
 WHERE mth_id='0' OR fth_id='0' OR breed_id='0'" );

mysql_query( "SELECT stall_num FROM $tags" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$tags`
	 ADD `stall_num` int( 5 ) unsigned NOT NULL default '0' AFTER `created_time`" );

mysql_query( "SELECT stall_num FROM $cows" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$cows`
	 ADD `stall_num` int( 5 ) unsigned NOT NULL default '0' AFTER `cow_num`" );
mysql_query( "SELECT dev_min FROM $budms" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 )
	Sql_query( "ALTER TABLE `$budms`
	 ADD `ready` tinyint( 1 ) unsigned NOT NULL default '0' AFTER `num`,
	 ADD `dev_max` tinyint( 2 ) unsigned NOT NULL default '0' AFTER `num`,
	 ADD `dev_min` tinyint( 2 ) unsigned NOT NULL default '0' AFTER `num`" );
mysql_query( "SELECT cowshed FROM $budms" );
$sqlerr=mysql_errno();
if ( $sqlerr==0 )
	Sql_query( "ALTER TABLE `$budms`
	 DROP `data_wire`,
	 DROP `cowshed`" );
mysql_query( "SELECT data_wire FROM $budms" );
$sqlerr=mysql_errno();
if ( $sqlerr!=0 ) {
	Sql_query( "ALTER TABLE `$budms`
	 ADD `data_wire` tinyint( 1 ) unsigned NOT NULL default '0' AFTER `num`,
	 ADD `cow_shed` tinyint( 1 ) unsigned NOT NULL default '0' AFTER `num`" );
}

ob_end_flush();
?>
