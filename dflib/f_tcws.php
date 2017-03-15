<?php
/* DF_2: dflib/f_tcws.php
cows list
c: 10.12.2005
m: 15.03.2017 */
?>

<script type='text/javascript' src='../dflib/f_tcws_u.js'></script>
<script language='JavaScript'>
function CowDontuse_ToCoo( cowid, sesss ) {
	var el_arr=new Array(), el_int=0, el_int1=0, j=32768;
	var cowid=String( cowid );
//ovul.
	var el=El_( "co_"+String( cowid ));
	if ( el!=null ) var el_bool=el.checked; else el_bool=false;
	if ( el_bool==true ) el_int1=el_int1+2;
//trauma
	var el=El_( "ct_"+String( cowid ));
	if ( el!=null ) var el_bool=el.checked; else el_bool=false;
	if ( el_bool==true ) el_int1=el_int1+4;
//mast.
	var el=El_( "cm_"+String( cowid ));
	if ( el!=null ) var el_bool=el.checked; else el_bool=false;
	if ( el_bool==true ) el_int1=el_int1+8;
//other
	for ( i=0; i<=sesss; i++ ) {
		var el=El_( "c"+String( i )+"_"+String( cowid ));
		if ( el!=null ) var el_bool=el.checked; else el_bool=false;
		if ( el_bool==true ) el_int=el_int+j;
		if ( j==32768 ) j=1; else j=j*2;//jagg
		if ( j==8 ) j=16;//dont_use additional starts from 16, not 8
		el_arr.push( el_bool );
		El_( "hilight"+"_"+cowid ).style.background="#ffff00";
	}
	var var_names="dont_use;bd_leds";
	var var_values=el_int+";"+el_int1;
	Tcws__var__Update( cowid, var_names, var_values );
}

function Checkboxes_ToCoo( cookiename, ename, ea, ez ) {
	var elsv=0, j=32768;
	for ( i=ea; i<=ez; i++ ) {
		el=String( ename )+i;
		var elv=El_( el ).checked;
		if ( j==32768 ) j=1; else j=j*2;
		var elsv=elsv*1+j*elv;
	}
	window.document.cookie=cookiename+"="+elsv+";path=/";
}
</script>

<?php
$cows_order=$_GET["cows_order"]; if ( strlen( $cows_order )<=0 ) $cows_order="$cows.cow_num*1";
if ( $cows_order=="binary($cows.nick)" ) {
	$nick_order="&nabla;";
	$num_order="";
	$tag_order="";
	$comm_order="";
} elseif ( $cows_order=="$cows.cow_num*1" ) {
	$nick_order="";
	$num_order="&nabla;";
	$tag_order="";
	$comm_order="";
} elseif ( $cows_order=="rfid_native" ) {
	$num_order="";
	$nick_order="";
	$tag_order="&nabla;";
	$comm_order="";
} elseif ( $cows_order=="comments" ) {
	$num_order="";
	$nick_order="";
	$tag_order="";
	$comm_order="&nabla;";
}

$filts0=CookieGet( "_filts0" )*1;
if (( $filts0&1 )==1 ) $filts0_1="checked"; else $filts0_1="";
if (( $filts0&2 )==2 ) $filts0_2="checked"; else $filts0_2="";
if (( $filts0&4 )==4 ) $filts0_3="checked"; else $filts0_3="";
if (( $filts0&8 )==8 ) $filts0_4="checked"; else $filts0_4="";
if (( $filts0&16 )==16 ) $filts0_5="checked"; else $filts0_5="";
if (( $filts0&32 )==32 ) $filts0_6="checked"; else $filts0_6="";

$filts9=CookieGet( "_filts9" )*1;
if (( $filts9&1 )==1 ) $filts9_1="checked"; else $filts9_1="";
if (( $filts9&2 )==2 ) $filts9_2="checked"; else $filts9_2="";
if (( $filts9&4 )==4 ) $filts9_3="checked"; else $filts9_3="";
if (( $filts9&8 )==8 ) $filts9_4="checked"; else $filts9_4="";
if (( $filts9&16 )==16 ) $filts9_5="checked"; else $filts9_5="";
if (( $filts9&32 )==32 ) $filts9_6="checked"; else $filts9_6="";

//jagg additional attributes
$ao0_=''; $at0_=''; $am0_='';
if ( $jagg_attrs>0 ) {
	$bdleds=$jagg_attrs;
	if (( $bdleds & 2 )*1==2 ) $ao0_='o+';
	if (( $bdleds & 4 )*1==4 ) $at0_='t+';
	if (( $bdleds & 8 )*1==8 ) $am0_='m+';
}

function CardsSched_Decode( $restrict_sched ) {
	global $ged;
	$restrict_sched_decoded="";
	$r_arr=split( ";", $restrict_sched );
	for ( $j=0; $j<count( $r_arr )-1; $j++ ) {
		$d_arr=split( ":", $r_arr[$j] );
		$c_halt=substr( $d_arr[1], 1, 5 );
		$mybit1=substr( $d_arr[1], 0, 1 )*1;
		if ( $mybit1==1 ) $rsch=" <b>".$ged['s_2d']."</b>"; else $rsch="";
		$d0_=substr( $d_arr[0], 8, 2 ).".".substr( $d_arr[0], 5, 2 ).".".substr( $d_arr[0], 2, 2 ).":";
		if (( $c_halt & 1 )*1==1 ) $rsch=$rsch." <b>".$ged['s1']."</b>";
		if (( $c_halt & 2 )*1==2 ) $rsch=$rsch." <b>".$ged['s2']."</b>";
		if (( $c_halt & 4 )*1==4 ) $rsch=$rsch." <b>".$ged['s3']."</b>";
		$restrict_sched_decoded=$restrict_sched_decoded."&nbsp;"."&nbsp;".$d0_.$rsch;
	}
	return $restrict_sched_decoded;
}

$send_buf=$_POST["send_buf"];
if ( $send_buf!="" ) {
	if (( $filts0&4 )==4 ) {
		include( "../locales/$lang/f_cows._$lang" );
		Res_Draw( 2, "../".$hFrm['0500'], "", $ged["filts0_3!"], $php_mm_tip[0] );
	} else {
		Res_Draw( 2, "../".$hFrm['0500'], "", "", $php_mm_tip[0] );
	}

} else {
	if ( $logindiv__hide==1 ) {
		include( "../locales/$lang/f_cows._$lang" );
		echo "
<table width='100%'>
<tr>
	<td $ljust>";
		if ( $filts9_1=="" ) echo "*".$ged["filts9_1~"]."&nbsp;";
		if ( $filts9_2=="" ) echo "*".$ged["filts9_2~"]."&nbsp;";
		if ( $filts9_3=="" ) echo "*".$ged["filts9_3~"]."&nbsp;";
		if ( $filts9_4=="" ) echo "*".$ged["filts9_4~"]."&nbsp;";
		if ( $filts9_5=="" ) echo "*".$ged["filts9_5~"]."&nbsp;";
		if ( $filts9_6=="" ) echo "*".$ged["filts9_6~"]."&nbsp;";
		if ( $filts0_1=="" ) echo "*".$ged["filts0_1~"]."&nbsp;";
		if ( $filts0_2=="" ) echo "*".$ged["filts0_2~"]."&nbsp;";
		if ( $filts0_3=="" ) echo "*".$ged["filts0_3~"]."&nbsp;";
		if ( $filts0_4=="" ) echo "*".$ged["filts0_4~"]."&nbsp;";
		if ( $filts0_5=="" ) echo "*".$ged["filts0_5~"]."&nbsp;";
		if ( $filts0_6=="" ) echo "*".$ged["filts0_6~"]."&nbsp;";
		echo "
	</td>
</tr>
</table>";
	}
	$i=0;//generate next cow index
	$res=mysql_query( "SELECT sessions FROM $globals", $db );
	$row=mysql_fetch_row( $res ); $sesss=$row[0]*1;
	$res=mysql_query( "SELECT id FROM $cows", $db );
	while ( $row=mysql_fetch_row( $res )) $i++; mysql_free_result( $res );
	if ( $nocardsfilt!=1 ) {//dont show when in reports mode
		echo "
<table width='100%'>
<tr height='20px'>
	<td rowspan='2' style='padding:5px' width='150px'>";
		if ( $userCoo!=9 ) {
			srand(( double ) microtime()*1000000 );
			$random_key=rand( 1000000, 2000000 );
			echo "
		<a href='../".$hFrm['0520']."?cow_id=-2&ret0=05&random_key=$random_key'><u>".$php_mm["_com_INSE_lnk_"]."</u></a>";
		}
		echo "
	</td>
	<td rowspan='2'><input class='btn gradient_0f0' name='send_buf' style='width:140px' type='submit' value='".$php_mm["_com_accept_btn_"]."'></td>
	<td rowspan='2'></td>
	<td rowspan='2' width='111px'>";
		$_filtsXmode="c";
		include( "f_filt1a.php" );
		echo "
	</td>
	<td rowspan='2' width='7px'></td>
	<td width='31px' title='".$ged["filts9_1"]."'><label><input class='z_chk' type='checkbox' $filts9_1 id='e1' onclick='Checkboxes_ToCoo( \"_filts9\", \"e\", 1, 6 )'>".$ged["filts9_1~"]."</label></td>
	<td width='31px' title='".$ged["filts9_2"]."'><label><input class='z_chk' type='checkbox' $filts9_2 id='e2' onclick='Checkboxes_ToCoo( \"_filts9\", \"e\", 1, 6 )'>".$ged["filts9_2~"]."</label></td>
	<td width='31px' title='".$ged["filts9_3"]."'><label><input class='z_chk' type='checkbox' $filts9_3 id='e3' onclick='Checkboxes_ToCoo( \"_filts9\", \"e\", 1, 6 )'>".$ged["filts9_3~"]."</label></td>
	<td width='31px' title='".$ged["filts0_1"]."'><label><input class='z_chk' type='checkbox' $filts0_1 id='f1' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_1~"]."</label></td>
	<td width='31px' title='".$ged["filts0_2"]."'><label><input class='z_chk' type='checkbox' $filts0_2 id='f2' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_2~"]."</label></td>
	<td width='31px' title='".$ged["filts0_3"]."'><label><input class='z_chk' type='checkbox' $filts0_3 id='f3' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_3~"]."</label></td>
</tr>
<tr height='20px'>
	<td width='31px' title='".$ged["filts9_4"]."'><label><input class='z_chk' type='checkbox' $filts9_4 id='e4' onclick='Checkboxes_ToCoo( \"_filts9\", \"e\", 1, 6 )'>".$ged["filts9_4~"]."</label></td>
	<td width='31px' title='".$ged["filts9_5"]."'><label><input class='z_chk' type='checkbox' $filts9_5 id='e5' onclick='Checkboxes_ToCoo( \"_filts9\", \"e\", 1, 6 )'>".$ged["filts9_5~"]."</label></td>
	<td width='31px' title='".$ged["filts9_6"]."'><label><input class='z_chk' type='checkbox' $filts9_6 id='e6' onclick='Checkboxes_ToCoo( \"_filts9\", \"e\", 1, 6 )'>".$ged["filts9_6~"]."</label></td>
	<td width='31px' title='".$ged["filts0_4"]."'><label><input class='z_chk' type='checkbox' $filts0_4 id='f4' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_4~"]."</label></td>
	<td width='31px' title='".$ged["filts0_5"]."'><label><input class='z_chk' type='checkbox' $filts0_5 id='f5' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_5~"]."</label></td>
	<td width='31px' title='".$ged["filts0_6"]."'><label><input class='z_chk' type='checkbox' $filts0_6 id='f6' onclick='Checkboxes_ToCoo( \"_filts0\", \"f\", 1, 6 )'>".$ged["filts0_6~"]."</label></td>
</tr>";
		echo "
</tr>
</table>";
	}
	$now_dmY=date( "d.m.Y" ); $now_His=date( "H:i:s" );
	$cow_add=$_GET["cow_add"];
	$cow_del=$_GET["cow_del"];
	$cow_edit=$_GET["cow_edit"];
	$cow_find=$_GET["cow_find"];
	$j_jagg=0; $j_du=0; $j=0;
	$t_h_w=$disp_res[0]-29;
	$t_w=$disp_res[0]-10;
	if ( $nocardsfilt!=1 ) echo "
<div style='height:38px; width:100%; overflow-y:scroll'>";
	echo "
<table width='100%'>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th title='".$ged["To_Jagg_tip"]."' width='20px'>".$ged["To_Jagg"]."</th>
	<th title='".$_05_TOM_tip."' width='64px'>".$_05_TOM_."</th>
	<th title='".$ged["To_Restrict_tip"]."' width='180px'>".$ged["To_Restrict"]."</th>";
	if ( $nocardsfilt!=1 ) echo "
	<th title='".$ged["No.__ANIMALS_ORDER_BY_tip"]."' width='60px'><a href='../".$hFrm["0500"]."'>".$ged["Number"].$num_order."</th>
	<th title='".$ged["Nick__ANIMALS_ORDER_BY_tip"]."' width='101px'><a href='../".$hFrm["0500"]."?cows_order=binary(".$cows.".nick)'>".$ged["Nick"].$nick_order."</th>";
	else echo "
	<th width='60px'>".$ged["Number"].$num_order."</th>
	<th width='101px'>".$ged["Nick"].$nick_order."</th>";
	echo "
	<th width='50px'>".$ged["Lot"]."</th>
	<th width='50px'>".$ged["Group"]."</th>
	<th width='65px'>".$ged["Birthday"]."</th>";
	if ( $nocardsfilt!=1 ) echo "
	<th width='50px'><a href='../".$hFrm["0500"]."?cows_order=rfid_native'>".$ged["TAG"].$tag_order."</th>
	<th width='30px'><a href='../".$hFrm["0500"]."?cows_order=comments'>!".$comm_order."</th>";
	else echo "
	<th>".$ged["TAG"].$tag_order."</th>
	<th>".$ged["Comment."].$comm_order."</th>";
	echo "
</tr>
</thead>";
	if ( $nocardsfilt!=1 ) echo "
</table>
</div>
<div style='height:60%; width:100%; overflow-y:scroll'>
<table width='100%'>";
	else echo "
<tbody id='rep_tbody'>";
	$res=mysql_query( "SELECT descr FROM $operstyp WHERE id=8192", $db );
	$row=mysql_fetch_row( $res );
	$op8192=$row[0];
	$query="SELECT
	 $cows.cow_num, $cows.nick,
	 $cows.national_descr,
	 $cows.b_num, $cows.b_date,
	 mother.nick, $oxes.nick,
	 $breeds.nick,
	 $groups.nick,
	 $subgrs.nick,
	 $lots.nick,
	 $cows.defects,
	 $cows.rfid_native, $cows.rfid_num, $cows.rfid_date, $cows.rfid_time,
	 $cows.comments,
	 $cows.a_dates, $cows.b_dates, $cows.c_dates,
	 $cows.mth_id, $cows.fth_id,
	 $cows.breed_id,
	 $cows.gr_id,
	 $cows.subgr_id,
	 $cows.lot_id,
	 $cows.created_date, $cows.created_time,
	 $cows.locked,
	 $cows.modif_uid, $cows.modif_date, $cows.modif_time,
	 $cows.id,
	 $cows.dont_use,
	 $cows.milk_total,
	 $cows.restrict_sched, $cows.bd_leds,
	 $cows.z_dates
	 FROM $cows, $oxes, $cows mother, $breeds, $groups, $lots, $subgrs
	 WHERE $oxes.id=$cows.fth_id AND
	 mother.id=$cows.mth_id AND
	 $breeds.id=$cows.breed_id AND
	 $groups.id=$cows.gr_id AND
	 $lots.id=$cows.lot_id AND
	 $subgrs.id=$cows.subgr_id";
	if ( $filts1*1!=-1 )
		$query=$query." AND $cows.gr_id=$filts1";
	elseif ( $filts2*1!=-1 )
		$query=$query." AND $cows.lot_id=$filts2";
	if (( $filts0_1=="" & $filts0_4=="" ) | ( $filts0_2=="" & $filts0_5=="" ) | ( $filts0_3=="" & $filts0_6=="" ))
		$query=$query." AND 1=0";
	if ( $jagg_attrs<=0 ) if ( $filts0_1=="checked" & $filts0_4=="" )
		$query=$query." AND $cows.dont_use>=32768";
	if ( $filts0_1=="" & $filts0_4=="checked" )
		$query=$query." AND $cows.dont_use<32768";
	if ( $filts0_3=="checked" & $filts0_6=="" )
		$query=$query." AND $cows.z_dates<>''";
	if ( $filts0_3=="" & $filts0_6=="checked" )
		$query=$query." AND $cows.z_dates=''";
	$query=$query."
	 ORDER BY ".$cows_order;
	$res=mysql_query( $query, $db );
	while ( $row=mysql_fetch_row( $res )) {
		$cowrow_vis1=0;
		$cownum=$cownum_div.$row[0].$cownum_div1;
//DUBLICATED NUMBERS
		if ( $cownum==$cownumprev ) $cownum=$cownum."!!!";
		$cownumprev=$cownum;
//DUBLICATED NUMBERS
		$birthday=substr( $row[4], 8, 2 ).".".substr( $row[4], 5, 2 ).".".substr( $row[4], 0, 4 );
		$days=DaysBetween( $birthday, $now_dmY );
		$zapl_dates=strlen( $row[17] ); $otel_dates=strlen( $row[19] );
		if ( strlen( $sele_byState )<=1 ) {
			if ( $sele_byAge_from==0 & $sele_byAge_to==0 ) $cowrow_vis1=1;//select all cows
			else if ( $sele_byAge_from>=0 & $sele_byAge_to>0 )//select cows which age in []
				if ( $days>=$sele_byAge_from & $days<=$sele_byAge_to ) $cowrow_vis1=1;
			else if ( $sele_byAge_from>=0 & $sele_byAge_to==0 )//select cows which age more...
				if ( $days>=$sele_byAge_from ) $cowrow_vis1=1;
		} else {
			if ( $days<$insem1st_days0 ) $ss='A01';
			else if ( $otel_dates<=8 & $zapl_dates==8 & $days<$not_abort1st_days0 ) $ss='A02';
			else if ( $otel_dates<8 & $days>$not_abort1st_days0 ) $ss='A0q';
			else $ss='A**';
			if ( $otel_dates>=8 & $days>=$not_abort1st_days0 ) $ss='A0';
			if ( $sele_byState==$ss ) $cowrow_vis1=1;
		}
		if ( $sele_byState=="" & $sele_byAge=="" ) $cowrow_vis=1;
		$bdleds=$row[36]*1;
		$ao1c=""; $at1c=""; $am1c="";
		$ao1_=""; $at1_=""; $am1_="";
		$aj1_="";
		if (( $bdleds & 2 )*1==2 ) { $ao1c="checked"; $ao1_="o+";}
		if (( $bdleds & 4 )*1==4 ) { $at1c="checked"; $at1_="t+";}
		if (( $bdleds & 8 )*1==8 ) { $am1c="checked"; $am1_="m+";}
		if ( $ao1_=="o+" & $ao0_=="o+" ) $aj1_="+";
		if ( $at1_=="t+" & $at0_=="t+" ) $aj1_="+";
		if ( $am1_=="m+" & $am0_=="m+" ) $aj1_="+";
//jagg & dont_use
		$du=$row[33]*1;
		$jagg1='';
		$ja1_=''; $du1_='';
		if ( $du!=32768 & $du!=0 ) { $du1_="+";}
		if (( $du & 32768 )*1==32768 ) { $jagg1='checked'; $ja1_='+';}
		if ( $filts0_1!="" & $filts0_4=="" ) {
			if ( $aj1_!="" | $jagg1!="" ) $cowrow_vis=1;
			if ( $aj1_=="" & $jagg1=="" ) $cowrow_vis=0;
		}
		if ( $filts0_1=="" & $filts0_4!="" ) {
			if ( $aj1_=="" | $jagg1=="" ) $cowrow_vis=1;
			if ( $aj1_!="" | $jagg1!="" ) $cowrow_vis=0;
		}
		if ( $filts0_1=="" & $filts0_4=="" ) $cowrow_vis=0;
		if ( $filts0_1!="" & $filts0_4!="" ) $cowrow_vis=1;
		if ( $filts9_1=="" & $am1c=="checked" ) $cowrow_vis=0;
		if ( $filts9_2=="" & $at1c=="checked" ) $cowrow_vis=0;
		if ( $filts9_3=="" & $ao1c=="checked" ) $cowrow_vis=0;
		if ( $filts9_4=="" & $am1c=="" ) $cowrow_vis=0;
		if ( $filts9_5=="" & $at1c=="" ) $cowrow_vis=0;
		if ( $filts9_6=="" & $ao1c=="" ) $cowrow_vis=0;
		if ( $cowrow_vis==1 & $cowrow_vis1==1 ) {
			$chk1=''; $chk2=''; $chk3=''; $chk4=''; $chk5=''; $chk6='';
			$ck1_=''; $ck2_=''; $ck3_=''; $ck4_=''; $ck5_=''; $ck6_='';
			if (( $du & 1 )*1==1 ) { $chk1='checked'; $ck1_='1';}
			if (( $du & 2 )*1==2 ) { $chk2='checked'; $ck2_='2';}
			if (( $du & 4 )*1==4 ) { $chk3='checked'; $ck3_='4';}
			if (( $du & 16 )*1==16 ) { $chk4='checked'; $ck4_='16';}
			if (( $du & 32 )*1==32 ) { $chk5='checked'; $ck5_='32';}
			if (( $du & 64 )*1==64 ) { $chk6='checked'; $ck6_='64';}
			$rfid_num=trim( PhraseCarry( $row[13], " ", 2 ));
			$tot_milk=$row[34]*1; if ( $tot_milk==0 ) $tot_milk="";
			if ( $row[0]=="1913" ) $deff="default"; else $deff="";
			if ( strlen( $row[35] )!=0 ) {
//				$row35="<a href='../oper/f_o_jagg.php?key=-1&opertype=8192&cow_id=".$row[32]."'>".CardsSched_Decode( $row[35] );
				$row35=CardsSched_Decode( $row[35] );
				if ( $du!=32768 & $du!=0 );
				else if ( strlen( $row35 )>2 ) { $du1_="+";}
				$row35_=$row35;
			} else {
				if ( $userCoo!=9 & $nocardsctrls!=1 ) {
					$row35="
		<label><input class='y_chk' $chk1 id='c1_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>
		<label><input class='y_chk' $chk2 id='c2_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>
		<label><input class='y_chk' $chk3 id='c3_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>";
					if ( $sesss!=3 ) $row35=$row35."
		<label><input class='y_chk' $chk4 id='c4_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>
		<label><input class='y_chk' $chk5 id='c5_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>
		<label><input class='y_chk' $chk6 id='c6_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>";
//					$row35=$row35."&nbsp;<a href='../oper/f_o_jagg.php?key=-1&opertype=8192&cow_id=".$row[32]."'>".$op8192;
					$row35=$row35."&nbsp;";
				} else {
					$row35=$ck1_."&nbsp;".$ck2_."&nbsp;".$ck3_;
					if ( $sesss!=3 ) $row35=$row35."&nbsp;".$ck4_."&nbsp;".$ck5_."&nbsp;".$ck6_;
				}
				$row35_=$row35;
			}
			if (( $du1_!="+" & $filts0_2=="checked" ) | ( $du1_=="+" & $filts0_5=="checked" )) {
				if ( $ja1_=="+" | $aj1_=="+" ) $j_jagg++;
				if ( $du1_=="+" ) $j_du++;
				if ( $userCoo!=9 & $nocardsctrls!=1 ) {
					echo "
<tr>
	<td $cjust height='28px' width='20px'><label><input class='y_chk' $jagg1 id='c0_$row[32]' $deff type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'>$aj1_</label></td>";
					echo "
	<td $cjust width='64px'>
		<label><input class='y_chk' $at1c id='ct_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>
		<label><input class='y_chk' $ao1c id='co_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>
		<label><input class='y_chk' $am1c id='cm_$row[32]' type='checkbox' onclick='CowDontuse_ToCoo( $row[32], $sesss )'></label>
	</td>
	<td $cjust title='".$ged["s1"]."&nbsp;".$ged["s2"]."&nbsp;".$ged["s3"]."&nbsp;".$ged["s1"]."&nbsp;".$ged["s2"]."&nbsp;".$ged["s3"]."&nbsp;"."' width='180px'>$row35_</td>";
				} else {
					if ( strlen( $aj1_ )>strlen( $ja1_ )) $ja1_=$aj1_;
					echo "
<tr>
	<td $cjust width='20px'>&nbsp;$ja1_</td>
	<td $cjust width='64px'>&nbsp;$at1_ $ao1_ $am1_</td>
	<td $cjust title='".$ged["s1"]."&nbsp;".$ged["s2"]."&nbsp;".$ged["s3"]."&nbsp;".$ged["s1"]."&nbsp;".$ged["s2"]."&nbsp;".$ged["s3"]."&nbsp;"."' width='180px'>$row35_&nbsp;</td>";				}
				for ( $row_i=8; $row_i<=10; $row_i++ ) {
echo "1111";
					$orow[$row_i]=StrCutLen1( $row[$row_i], 6, $contentCharset );
					if ( strlen( $row[$row_i] )<=6 ) $row[$row_i]="";
				}
				if ( $birthday=="31.12.1991" ) $birthday_color="#cccccc"; else $birthday_color="#000000";
				echo "
	<td $rjust id='hilight_$row[32]' title='".$ged['Nick__OPEN_CARD_tip']."' width='60px' onmouseover='style.cursor=\"pointer\"'><a href='../".$hFrm['0520']."?cow_id=".$row[32]."&ret0=05'><b>".$cownum."</b>&nbsp;</td>";
//	<a href='../".$hRep['ccw1']."?cow_id=".$row[32]."&ret0=05'>
	if ( strlen( $row[37] )>0 ) $birthday_color="red'";
	if ( $nocardsfilt!=1 ) echo "
	<td title='$row[1] ".$ged['Nat._Id.'].":"."$row[2]' width='101px'><input readonly style='border:0; font-size:12; height:100%; width:99%' type='text' value='$row[1]'/></td>";
	else echo "
	<td width='101px'>&nbsp;$row[1]</td>";
	echo "
	<td title='$row[10]' width='50px'>&nbsp;$orow[10]</td>
	<td title='$row[8]' width='50px'>&nbsp;$orow[8]</td>
	<td $cjust style='color:$birthday_color' width='65px'>&nbsp;$birthday</td>";
				if ( $nocardsfilt!=1 ) echo "
	<td width='50px'><input readonly style='border:0; font-size:11; height:100%; width:99%' type='text' value='$row[12]'/></td>
	<td width='30px'><input readonly style='border:0; font-size:11; height:100%; width:99%' type='text' value='$row[16]'/></td>";
				else echo "
	<td>&nbsp;$row[12]</td>
	<td>&nbsp;$row[16]</td>";
				echo "
</tr>";
				$j++;
			}
		}
	}
	echo "
</tbody>
<tfoot id='rep_tfoot'>
<tr $rjust style='height:28px'>
	<td>".$j_jagg."&nbsp;</td>
	<td>&nbsp;</td>
	<td>".$j_du."&nbsp;</td>
	<td>".$j."&nbsp;</td>";
	if ( $nocardsfilt!=1 ) echo "
	<td>&nbsp;</td>";
	else echo "
	<td>&nbsp;</td>";
	echo "
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>";
	if ( $nocardsfilt!=1 ) echo "
	<td>&nbsp;</td>
	<td>&nbsp;</td>";
	else echo "
	<td>&nbsp;</td>
	<td>&nbsp;</td>";
	echo "
</tr>
</tfoot>
</table>";
	if ( $nocardsfilt!=1 ) echo "
</div>";
	else echo "
<br>";
}
?>
