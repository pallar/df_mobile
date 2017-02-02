<?php
/* DF_2: db_cmds/conf_u.php
Update Config (Dairy Farm [CONF]igurator)
c: 13.06.2006
m: 16.09.2016 */

$modif_Ymd=date( "Y-m-d" ); $modif_His=date( "H:i:s" );

$err_fnt="style='color:#ff0000'";
$rfidModes=3;//!!!TEMPORARY (HARDWARE PART OF $rfidModes[4] IS NOT COMPLETED)
$langs=count( $_07_langs );
$langs_dis[be]="disabled"; $langs_dis[en]="disabled"; $langs_dis[tr]="disabled";//!!!TEMPORARY

//CONSTANTS
$pits_MIN=1; $pits_MAX=4;
$devsByPit_MIN=0; $devsByPit_MAX=48;
$dataWiresByPit_MIN=1; $dataWiresByPit_MAX=2;
$waitBetwDevs_MIN=1; $waitBetwDevs_MAX=400;

$drvDir="/_df2drv"; $drvFname="httpbd06";
$prt_MIN=1; $prt_MAX=6;

$jaggs_MIN=0; $jaggs_MAX=4;
$jignSimilar=0;
$jcmdT_MIN=3000; $jcmdT_MAX=3600000;

$jdrvDir="/_df2drv"; $jdrvFname="httpsep";
$jprt_MIN=2; $jprt_MAX=12;

$errnum=0;
$errnum_524288=0;//special error for jaggs under DF_1
$errnum1048576=0;//special error for budms

//to prevent locking when moving from $rfidMode==3 to other
$res=mysql_query( "SELECT
 rfid_mode
 FROM $globals" );
$r=mysql_fetch_row( $res ); mysql_free_result( $res );
$rfidModeDb=$r[0]*1;

$btn_ok=$_POST["btn_ok"]; $do_js=$_GET["do_js"]; $send_js_to_php=$_POST["send_js_to_php"];

if ( $send_js_to_php!="" ) echo "
<script>location.href='".$sself."?do_js=1&OnLoad_Temp_Func=sessvars.$.clearMem();&sessvars='+sessvars.confparam._00</script>";
else if ( $do_js!="" ) {
	$sessvars=$_GET["sessvars"]; $updateslist=split( ";", $sessvars );
	for ( $ii=0; $ii<=count( $updateslist ); $ii++ ) {
		if ( strlen( $updateslist[$ii] )>1 ) {
			$updlist=split( ":", $updateslist[$ii] );
			$updlist[0]=trim( $updlist[0] ); $updlist[1]=trim( $updlist[1] );
//echo "$updateslist[$i]: $updlist[0] $updlist[1] $updlist[2]<br>";
			$cowSheds=0;
			for ( $i=1; $i<=5; $i++ ) for ( $j=1; $j<=3; $j++ ) {
				$cowSheds++; $cowShedNum=$cowSheds; if ( $cowShedNum<10 ) $cowShedNum="0".$cowShedNum;
				$x="ws".$cowShedNum; if ( $updlist[0]==$x ) $cowshed[$x]=$updlist[1];
//devsAtCsR - dev(ice)sA(t)C(ow)s(hedNumber)R(ow)
//lstallAtCsR - l(ast)stallAtC(ow)s(hedNumber)R(ow)
				for ( $csR=1; $csR<=4; $csR++ ) {
					$k=$cowShedNum*10+$csR; if ( $k<100 ) $k="0".$k;
					$x="dd".$k; if ( $updlist[0]==$x ) $cowshed[$x]=$updlist[1];
					$y="ls".$k; if ( $updlist[0]==$y ) $cowshed[$y]=$updlist[1];
				}
			}
			if ( $updlist[0]=='lang' ) $lang=$updlist[1];
			if ( $updlist[0]=='state' ) $state=$updlist[1];
			if ( $updlist[0]=='region' ) $region=$updlist[1];
			if ( $updlist[0]=='subregion' ) $subregion=$updlist[1];
			if ( $updlist[0]=='org' ) $org=$updlist[1];
			if ( $updlist[0]=='farm' ) $farm=$updlist[1];
			if ( $updlist[0]=='addr' ) $addr=$updlist[1];
			if ( $updlist[0]=='tel' ) $tel=$updlist[1];
			if ( $updlist[0]=='chief' ) $chief=$updlist[1];
			if ( $updlist[0]=='chiefAnimalTech' ) $chiefAnimalTech=$updlist[1];
			if ( $updlist[0]=='pits' ) $pits=$updlist[1]*1;
			if ( $updlist[0]=='devsByPit' ) $devsByPit=$updlist[1]*1;
			if ( $updlist[0]=='dataWiresByPit' ) $dataWiresByPit=$updlist[1]*1;
			if ( $updlist[0]=='devsQ' ) $devsQ=$updlist[1]*1;
			if ( $updlist[0]=='prtsTyp' ) $prtsTyp=$updlist[1];
			if ( $updlist[0]=='prt1' ) $prt1=$updlist[1]*1;
			if ( $updlist[0]=='waitBetwDevs' ) $waitBetwDevs=$updlist[1]*1;
			if ( $updlist[0]=='rfidMode' ) $rfidMode=$updlist[1]*1;
			if ( $updlist[0]=='drmdsByPit' ) $drmdsByPit=$updlist[1]*1;
			if ( $updlist[0]=='drmdBdsMode' ) $drmdBdsMode=$updlist[1]*1;
			if ( $updlist[0]=='jaggs' ) $jaggs=$updlist[1]*1;
			if ( $updlist[0]=='jprtsTyp' ) $jprtsTyp=$updlist[1];
			if ( $updlist[0]=='jprt1' ) $jprt1=$updlist[1]*1;
			if ( $updlist[0]=='jcmdT' ) $jcmdT=$updlist[1]*1;
			if ( $updlist[0]=='jignSimilar' ) $jignSimilar=$updlist[1]=="true"|0;
			if ( $updlist[0]=='_1b' ) {
				if ( strlen( $updlist[1] )<1 ) {
					if (( $errnum & 4194304 )*1!==4194304 ) $errnum=+4194304;
					$_07_fnt_sched=$err_fnt;
				}
				while ( strlen( trim( $updlist[1] ))<2 ) $updlist[1]="0".$updlist[1];
				$_1b=trim( $updlist[1].":".$updlist[2] );
				while ( strlen( $_1b )<5 ) $_1b=$_1b."0";
			}
			if ( $updlist[0]=='_2b' ) {
				if ( strlen( $updlist[1] )<1 ) {
					if (( $errnum & 4194304 )*1!==4194304 ) $errnum=+4194304;
					$_07_fnt_sched=$err_fnt;
				}
				while ( strlen( trim( $updlist[1] ))<2 ) $updlist[1]="0".$updlist[1];
				$_2b=trim( $updlist[1].":".$updlist[2] );
				while ( strlen( $_2b )<5 ) $_2b=$_2b."0";
			}
			if ( $updlist[0]=='_3b' ) {
				if ( strlen( $updlist[1] )<1 ) {
					if (( $errnum & 4194304 )*1!==4194304 ) $errnum=+4194304;
					$_07_fnt_sched=$err_fnt;
				}
				while ( strlen( trim( $updlist[1] ))<2 ) $updlist[1]="0".$updlist[1];
				$_3b=trim( $updlist[1].":".$updlist[2] );
				while ( strlen( $_3b )<5 ) $_3b=$_3b."0";
			}
		}
	}
	SectOrg_Chk();
	SectSched_Chk();
	if ( $rfidMode==3 && $rfidModeDb==3 ) {
		Sql_query( "TRUNCATE $budms" );
		$errnum1048576=1;
		$cowSheds=0; $_budms=0; $devsQ=0; $stallMax=0; 
		for ( $i=1; $i<=5; $i++ ) for ( $j=1; $j<=3; $j++ ) {
			$cowSheds++; $cowShedNum=$cowSheds; if ( $cowShedNum<10 ) $cowShedNum="0".$cowShedNum;
//devsAtCsR - dev(ice)sA(t)C(ow)s(hedNumber)R(ow)
//lstallAtCsR - l(ast)stallAtC(ow)s(hedNumber)R(ow)
			for ( $csR=1; $csR<=4; $csR++ ) {
				$k=$cowShedNum*10+$csR; if ( $k<100 ) $k="0".$k;
				$x="dd".$k;
				$y="ls".$k;
				if ( $cowshed[$y]>0 && ( $cowshed[$y]>$stallMax )) {
					$devMin=0;
					$errnum1048576=0;
					$devMax=$cowshed[$x]; if ( $cowshed[$x]>0 ) $devMin=1; $devsQ+=$cowshed[$x];
					if ( $stallMax==0 ) $stallMin=1; else $stallMin=$stallMax+1;
					$stallMax=$cowshed[$y];
					$_budms++; $budmNum=$_budms; if ( $budmNum<10 ) $budmNum="0".$budmNum;
					$dataWireNum=substr( $k, 2, 1 )*1;
					$cowShedNum=substr( $k, 0, 2 )*1;
//echo "$k $budmNum $cowShedNum $dataWireNum $stallMin $stallMax<br>";
					Sql_query( "INSERT INTO $budms (
					 `num`, `cowshed`, `data_wire`, `dev_min`, `dev_max` , `stall_min`, `stall_max`,
					 `modif_date`, `modif_time`, `modif_uid` )
					 VALUES (
					 '$budmNum', '$cowShedNum', '$dataWireNum', '$devMin', '$devMax', '$stallMin', '$stallMax',
					 '$modif_Ymd', '$modif_His', 1 )" );
				} else if ( $cowshed[$x]>0 ) {
					$cowshed[$x]="";
				}
			}
		}
		if ( $errnum1048576==1 )
			Sql_query( "INSERT INTO $budms (
			 `num`, `cowshed`, `data_wire`, `stall_min`, `stall_max`,
			 `modif_date`, `modif_time`, `modif_uid` )
			 VALUES (
			 '01', '1', '1', '1', '60',
			 '$modif_Ymd', '$modif_His', 1 )" );
	} elseif ( $rfidModeDb!=3 ) {
		if ( $devsByPit<$devsByPit_MIN || $devsByPit>$devsByPit_MAX ) {
			if (( $errnum & 1024 )*1!=1024 ) $errnum=+1024;
			$_07_fnt_devsByPit=$err_fnt;
		} else {
			if ( round( $devsByPit/2 )*2!=$devsByPit ) {
				if (( $errnum & 1024 )*1!=1024 ) $errnum=+1024;
				$_07_fnt_devsByPit=$err_fnt;
				$devsByPit=16;
			}
		}
		$devsQ=$pits*$devsByPit;
		if ( $dataWiresByPit<$dataWiresByPit_MIN || $dataWiresByPit>$dataWiresByPit_MAX || ( $dataWiresByPit>$devsByPit/2 && $devsByPit!=0 )) {
			$errnum=+2048;
			$_07_fnt_dataWiresByPit=$err_fnt;
			if ( $dataWiresByPit==1 && $devsByPit<=1 ) { $errnum=-2048; $_07_fnt_dataWiresByPit="";}
		}
//$jaggs and $jprts must be 0 if local rfid readers are used
		if ( $rfidMode==1 || $rfidMode==3 && ( $jaggs>0 || $jprts>0 )) {
			if ( $errnum_524288==0 ) $errnum_524288=524288;
			$jaggs=0; $jprts=0;
			Sql_query( "UPDATE $hardwj SET jaggs='$jaggs', ports='$jprts'" );
		}
//jaggs first port checking
		$jprt1x=$prt1+$pits*$dataWiresByPit;
		if ( $jprtsTyp==$prtsTyp && $jprt1<$jprt1x && $jaggs>0 ) {
			$jaggs=0;
			$jprt1=$jprt1x;
			if (( $errnum & 2097152 )*1!=2097152 ) $errnum=+2097152;
			$_07_fnt_jaggs=$err_fnt;
			$_07_fnt_jprt1=$err_fnt;
		}
	}
	if ( $waitBetwDevs<$waitBetwDevs_MIN || $waitBetwDevs>$waitBetwDevs_MAX ) {
		$errnum=+32768;
		$_07_fnt_waitBetwDevs=$err_fnt;
	}
//BEG: IMPORTANT FIXES
	if ( $pits<1 ) $pits=1;
	if ( $dataWiresByPit<1 ) $dataWiresByPit=1;
	if ( $waitBetwDevs<50 ) $waitBetwDevs=50;
	if ( $jcmdT<$jcmdT_MIN ) $jcmdT=$jcmdT_MIN;
	if ( $jignSimilar==1 ) $jignSimilar_checked="checked"; else $jignSimilar_checked="";
//END: IMPORTANT FIXES
	if ( $errnum==0 ) {
		Sql_query( "UPDATE $globals SET
		 state='$state', region='$region', subregion='$subregion',
		 language='$lang',
		 enterprise='$org', farm='$farm',
		 address='$addr', phone='$tel',
		 chief='$chief', chief_animal_technician='$chiefAnimalTech',
		 totaldevs='$devsQ',
		 rfid_mode='$rfidMode'" );
		Sql_query( "DELETE FROM $hardwports" );
		Sql_query( "INSERT INTO $hardwports (
		 `port_name`, `waitstate_between_devs`, `port_idx` )
		 VALUES (
		 'DO_RECONF', '9999', '0' )" );
//schedule
		Sql_query( "UPDATE $sessions SET b='$_1b', modif_date='$modif_Ymd', modif_time='$modif_His' WHERE id='10'" );
		Sql_query( "UPDATE $sessions SET b='$_2b', modif_date='$modif_Ymd', modif_time='$modif_His' WHERE id='20'" );
		Sql_query( "UPDATE $sessions SET b='$_3b', modif_date='$modif_Ymd', modif_time='$modif_His' WHERE id='30'" );
	}
	if ( $errnum==0 && $rfidMode==3 ) {
//cowsheds
		$prt_idx=$rfidMode;
		$prtnum_n=$prt1; $prt_n=$prtsTyp.$prtnum_n;
		$res=mysql_query( "SELECT
		 num, cowshed, data_wire, dev_min, dev_max, stall_min, stall_max
		 FROM $budms" );
		while ( $r=mysql_fetch_row( $res )) {
			if ( $r[3]!=0 ) {
				Sql_query( "INSERT INTO $hardwports (
				 `port_name`, `port_bps`,
				 `dev_first`, `dev_last`, `waitstate_between_devs`, `port_idx` )
				 VALUES (
				 '$prt_n', '2400',
				 '$r[3]', '$r[4]', '$waitBetwDevs', '$prt_idx' )" );
				$prtnum_n++; $prt_n=$prtsTyp.$prtnum_n;
			}
		}
	}
	if ( $errnum==0 && $rfidMode!=3 ) {
		Sql_query( "UPDATE $hardw SET
		 pits='$pits',
		 drmds_by_pit='$drmdsByPit',
		 drmd_bds='$drmdBdsMode',
		 data_wires_by_pit='$dataWiresByPit',
		 devs_by_pit='$devsByPit',
		 waitstate_between_devs='$waitBetwDevs',
		 ports_type='$prtsTyp', port_first='$prt1',
		 driver_dir='$drvDir', driver_fname='$drvFname'" );
		Sql_query( "DELETE FROM $dairymds" );
		if ( $devsQ!=0 ) {
			for ( $i=1; $i<=$pits; $i++ ) for ( $j=1; $j<=$devsByPit; $j++ ) {
				$devcur=$j+$devsByPit*($i-1); if ( $devcur<=9 ) $devcur="#0".$devcur; else $devcur="#".$devcur;
				$pit_devs[$i]=$pit_devs[$i].$devcur;
			}
//for ( $i=1; $i<=$pits; $i++ ) echo $pit_devs[$i]."<br>";
			$devsByDrmd=$devsByPit/$drmdsByPit;
			for ( $i=1; $i<=$pits; $i++ ) {
				$f_dev=0;
				for ( $j=1; $j<=$drmdsByPit; $j++ ) {
					$d_i=$i*100+$j;
					$drmd_devs[$d_i]=$drmd_devs[$d_i].substr( $pit_devs[$i], $f_dev, 3*$devsByDrmd );
					$drmd_devs1[$d_i]=$drmd_devs[$d_i];
					$f_dev=$f_dev+3*$devsByDrmd;
				}
			}
			if ( $drmdBdsMode==2 ) {
				if ( $drmdsByPit==2 ) {
					for ( $i=1; $i<=$pits; $i++ ) {
						$d_i1=$i*100+1;
						$d_i2=$i*100+2;
						$d_i3=$i*100+3;
						$d_i4=$i*100+4;
						$drmd_devs[$d_i1]=substr( $drmd_devs1[$d_i1], 0, $devsByDrmd/2*3 ).substr( $drmd_devs1[$d_i2], 0, $devsByDrmd/2*3 );
						$drmd_devs[$d_i2]=substr( $drmd_devs1[$d_i1], $devsByDrmd/2*3, $devsByDrmd/2*3 ).substr( $drmd_devs1[$d_i2], $devsByDrmd/2*3, $devsByDrmd/2*3 );
					}
				}
				if ( $drmdsByPit==4 ) {
					for ( $i=1; $i<=$pits; $i++ ) {
						$d_i1=$i*100+1;
						$d_i2=$i*100+2;
						$d_i3=$i*100+3;
						$d_i4=$i*100+4;
						$drmd_devs[$d_i1]=substr( $drmd_devs1[$d_i1], 0, $devsByDrmd/2*3 ).substr( $drmd_devs1[$d_i3], 0, $devsByDrmd/2*3 );
						$drmd_devs[$d_i2]=substr( $drmd_devs1[$d_i1], $devsByDrmd/2*3, $devsByDrmd/2*3 ).substr( $drmd_devs1[$d_i3], $devsByDrmd/2*3, $devsByDrmd/2*3 );
						$drmd_devs[$d_i3]=substr( $drmd_devs1[$d_i2], 0, $devsByDrmd/2*3 ).substr( $drmd_devs1[$d_i4], 0, $devsByDrmd/2*3 );
						$drmd_devs[$d_i4]=substr( $drmd_devs1[$d_i2], $devsByDrmd/2*3, $devsByDrmd/2*3 ).substr( $drmd_devs1[$d_i4], $devsByDrmd/2*3, $devsByDrmd/2*3 );
					}
				}
			}
			for ( $i=1; $i<=$pits; $i++ ) for ( $j=1; $j<=$drmdsByPit; $j++ ) {
				$d_i=$i*100+$j;
//echo "pit".$i." "."drmd".$j." ".$drmd_devs[$d_i]."<br>";
				Sql_query( "INSERT INTO $dairymds (
				 `dairymd_devs`, `dairymd_idx` )
				 VALUES (
				 '$drmd_devs[$d_i]', '$d_i' )" );
			}
		}
		if ( $jcmdT<jcmdT_MIN ) $jcmdT=$jcmdT_MIN;
		Sql_query( "UPDATE $hardwj SET
		 jaggs='$jaggs',
		 ignore_similar='$jignSimilar',
		 cmd_timeout='$jcmdT',
		 ports_type='$jprtsTyp', port_first='$jprt1',
		 driver_dir='$jdrvDir', driver_fname='$jdrvFname'" );
//parlor
		$prt_idx=$rfidMode;
		$prtnum_n=$prt1; $prt_n=$prtsTyp.$prtnum_n;
		$devf_n=1;
		if ( $dataWiresByPit==1 ) $devl_n=$devsByPit; else $devl_n=$devsByPit/2;
		for ( $i=1; $i<=$pits; $i++ ) {
			for ( $j=1; $j<=$dataWiresByPit; $j++ ) {
				Sql_query( "INSERT INTO $hardwports (
				 `port_name`, `port_bps`,
				 `dev_first`, `dev_last`, `waitstate_between_devs`, `port_idx` )
				 VALUES (
				 '$prt_n', '2400',
				 '$devf_n', '$devl_n', '$waitBetwDevs', '$prt_idx' )" );
				$prtnum_n++; $prt_n=$prtsTyp.$prtnum_n;
				if ( $dataWiresByPit==1 ) {
					$devf_n=$devf_n+$devsByPit; $devl_n=$devf_n+$devsByPit-1;
				} else {
					$devf_n=$devf_n+$devsByPit/2; $devl_n=$devf_n+$devsByPit/2-1;
				}
			}
		}
		for ( $i=$prt_MIN; $i<=$prt_MAX; $i++ ) $prt_sel[$i]=""; $prt_sel[$prt1]="selected";
		$prtsTyp_sel[COM]=""; $prtsTyp_sel[USBCOM]=""; $prtsTyp_sel[USB]=""; $prtsTyp_sel[$prtsTyp]="selected";
		for ( $i=1; $i<=6; $i++ ) $drmdsByPit_sel[$i]=""; $drmdsByPit_sel[$drmdsByPit]="selected";
		for ( $i=1; $i<=2; $i++ ) $drmdBdsMode_sel[$i]=""; $drmdBdsMode_sel[$drmdBdsMode]="selected";
//jaggs
		$jprtnum_n=$jprt1; $jprt_n=$jprtsTyp.$jprtnum_n;
		for ( $i=1; $i<=$jaggs; $i++ ) {
			Sql_query( "INSERT INTO $hardwports (
			 `port_name`, `port_bps`,
			 `dev_first`, `dev_last`, `waitstate_between_devs`, `port_idx` )
			 VALUES (
			 '$jprt_n', '9600',
			 '0', '0', '0', '8' )" );
			$jprtnum_n++; $jprt_n=$jprtsTyp.$jprtnum_n;
		}
		for ( $i=$jprt_MIN; $i<=$jprt_MAX; $i++ ) $jprt_sel[$i]=""; $jprt_sel[$jprt1]="selected";
		$jprtsTyp_sel[COM]=""; $jprtsTyp_sel[USB]=""; $jprtsTyp_sel[USBCOM]=""; $jprtsTyp_sel[$jprtsTyp]="selected";
	}
}

//sessions from db
$res=mysql_query( "SELECT
 id, b
 FROM $sessions ORDER BY id" );
while ( $r=mysql_fetch_row( $res )) {
	if ( $r[0]*1==10 ) $_1b=trim( $r[1] );
	if ( $r[0]*1==20 ) $_2b=trim( $r[1] );
	if ( $r[0]*1==30 ) $_3b=trim( $r[1] );
}
mysql_free_result( $res );
//org. from db
$res=mysql_query( "SELECT
 state, region, subregion,
 enterprise, farm, address, phone,
 chief, chief_animal_technician,
 totaldevs,
 sessions,
 language,
 os, suex_dir, suex_ver, suex_passw, rfid_mode
 FROM $globals" );
$r=mysql_fetch_row( $res ); mysql_free_result( $res );
$state=trim( $r[0] ); $region=trim( $r[1] ); $subregion=trim( $r[2] );
$org=trim( $r[3] ); $farm=trim( $r[4] );
$addr=trim( $r[5] ); $tel=trim( $r[6] );
$chief=trim( $r[7] ); $chiefAnimalTech=trim( $r[8] );
$devsQ=$r[9]*1;
$sesss=$r[10]*1;
$lang=trim( $r[11] );
if ( strlen( $state )==0 ) $state=$state_ukr; if ( $state=="Ukraine" ) $state=$state_ukr;
$rfidMode=$r[16]*1;
for ( $i=1; $i<=$rfidModes; $i++ ) $rfidModes_sel[$i]=""; $rfidModes_sel[$rfidMode]="selected";
for ( $i=1; $i<=$langs; $i++ ) { $j=$langs_val[$i]; $langs_sel[$j]=$langs_dis[$j];} $langs_sel[$lang]=$langs_sel[$lang]." selected";
$os=trim( $r[12] );
$suex_dir=trim( $r[13] ); $suex_ver=trim( $r[14] ); $suex_passw=trim( $r[15] );
//parlor from db
$res=mysql_query( "SELECT
 pits,
 drmds_by_pit,
 drmd_bds,
 devs_by_pit,
 data_wires_by_pit,
 waitstate_between_devs,
 ports, ports_type, port_first,
 driver_dir, driver_fname
 FROM $hardw" );
$r=mysql_fetch_row( $res ); mysql_free_result( $res );
$pits=$r[0]*1;
if ( $pits<1 ) { $pits=1; Sql_query( "UPDATE $hardw SET pits='$pits'" );}
$drmdsByPit=$r[1]*1;
for ( $i=1; $i<=6; $i++ ) $drmdsByPit_sel[$i]=""; $drmdsByPit_sel[$drmdsByPit]="selected";
$drmdBdsMode=$r[2]*1;
for ( $i=1; $i<=2; $i++ ) $drmdBdsMode_sel[$i]=""; $drmdBdsMode_sel[$drmdBdsMode]="selected";
$devsByPit=$r[3]*1;
$dataWiresByPit=$r[4]*1;
if ( $dataWiresByPit>$devsByPit/2 || $dataWiresByPit<1 ) { $dataWiresByPit=1; Sql_query( "UPDATE $hardw SET data_wires_by_pit='$dataWiresByPit'" );}
$waitBetwDevs=$r[5]*1;
if ( $waitBetwDevs<50 ) { $waitBetwDevs=50; Sql_query( "UPDATE $hardw SET waitstate_between_devs='$waitBetwDevs'" );}
$prts=$r[6]*1;
$prtsTyp=trim( $r[7] );
$prtsTyp_sel[COM]=""; $prtsTyp_sel[USB]=""; $prtsTyp_sel[USBCOM]=""; $prtsTyp_sel[$prtsTyp]="selected";
$prt1=$r[8]*1;
for ( $i=$prt_MIN; $i<=$prt_MAX; $i++ ) $prt_sel[$i]=""; $prt_sel[$prt1]="selected";
$devsQ=$pits*$devsByPit;
//jaggs from db
$res=mysql_query( "SELECT
 jaggs,
 ports, ports_type, port_first,
 driver_dir, driver_fname, cmd_timeout, ignore_similar
 FROM $hardwj" );
$r=mysql_fetch_row( $res ); mysql_free_result( $res );
$jaggs=$r[0]*1;
$jprts=$r[1]*1;
$jprtsTyp=$r[2];
$jprtsTyp_sel[COM]=""; $jprtsTyp_sel[USB]=""; $jprtsTyp_sel[USBCOM]=""; $jprtsTyp_sel[$jprtsTyp]="selected";
$jprt1=$r[3]*1;
for ( $i=$jprt_MIN; $i<=$jprt_MAX; $i++ ) $jprt_sel[$i]=""; $jprt_sel[$jprt1]="selected";
$jcmdT=$r[6]*1;
if ( $jcmdT<$jcmdT_MIN ) { $jcmdT=$jcmdT_MIN; Sql_query( "UPDATE $hardwj SET cmd_timeout='$jcmdT'" );}
$jignSimilar=$r[7]*1;
if ( $jignSimilar==1 ) $jignSimilar_checked="checked";
//$jaggs and $jprts must be 0 if local rfid readers are used
if ( $rfidMode==1 || $rfidMode==3 && ( $jaggs>0 || $jprts>0 )) {
	if ( $errnum_524288==0 ) $errnum_524288=524288;
	$jaggs=0; $jprts=0;
	Sql_query( "UPDATE $hardwj SET jaggs='$jaggs', ports='$jprts'" );
}

//budms
if ( $rfidMode==3 ) {
	$devsQ=0; $cowSheds=0; $dataWires=0;
	$res=mysql_query( "SELECT
	 num, cowshed, data_wire, dev_min, dev_max, stall_min, stall_max
	 FROM $budms" );
	while ( $r=mysql_fetch_row( $res )) {
		$dataWires++;
		if ( $r[1]==0 ) {
			if ( $dataWires==1 ) $cowSheds++;
			Sql_query( "UPDATE $budms SET cowshed='$cowSheds', data_wire='$dataWires' WHERE num='$r[0]'" );
			$r[1]=$cowSheds; $r[2]=$dataWires;
		}
		$k=$r[1]*10+$r[2]; if ( $k<100 ) $k="0".$k;
		if ( $r[4]*1==0 ) { $r[3]=""; $r[4]="";}
		$cowshed["$k"]["dev_min"]=$r[3];
		$cowshed["$k"]["dev_max"]=$r[4];
		$cowshed["$k"]["stall_min"]=$r[5];
		$cowshed["$k"]["stall_max"]=$r[6];
		$devsQ+=$r[4];
	}
}

//reserved to restore
$lang_=$lang;
$os_=$os;
$suex_dir_=$suex_dir; $suex_ver_=$suex_ver; $suex_passw_=$suex_passw;
$state_=$state; $region_=$region; $subregion_=$subregion;
$org_=$org; $farm_=$farm;
$addr_=$addr; $tel_=$tel;
$chief_=$chief; $chiefAnimalTech_=$chiefAnimalTech;
$rfidMode_=$rfidMode;
$pits_=$pits;
$devsByPit_=$devsByPit;
$dataWiresByPit_=$dataWiresByPit;
$waitBetwDevs_=$waitBetwDevs;
$prts_=$prts;
$prtsTyp_=$prtsTyp;
$prt1_=$prt1;
$drmdsByPit_=$drmdsByPit;
$drmdBdsMode_=$drmdBdsMode;
$jaggs_=$jaggs;
$jprts_=$jprts;
$jprtsTyp_=$jprtsTyp;
$jprt1_=$jprt1;
$jignSimilar_=$jignSimilar;
?>
