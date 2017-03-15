<?php
/* DF_2: reports/f_ofore[CAST]3.php
report: forecast for all cows (moving from group to group)
c: 24.09.2008
m: 15.03.2017 */

$dbt_ext="_o";

ob_start();//lock output to set cookies properly!

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

//$dontuse_period=4;//PERIOD_BEGIN=now(), PERIOD_END=now()
$dontuse_filt=1;//ONLY IN THIS REPORT

$cows_cnt=0;

include( "f_jfilt.php" );
include( "../dflib/f_filt1.php" );
include( "../locales/$lang/f_rl._$lang" );

$sself="../".$hRep['ofore3'];

$dontuse_period=$_GET["dontuse_period"]*1;

if ( $dontuse_period==4 ) {
	$du_p=0; $href_title_=$ged['r-td-Abort_Plan_From_To'];
} else {
	$du_p=4; $href_title_=$ged['r-td-Abort_Plan'];
}
$title_="<a href='".$sself."?dontuse_period=".$du_p."&title=".$href_title_."'>".$title_."</a>";

include( "frhead.php" );

$yf=1991; $mf=1; $df=1;
$yc=$yf; $mc=$mf; $dc=$df;

//current date
$y1z=Int2StrZ( $yl, 4 ); $m1z=Int2StrZ( $ml, 2 ); $d1z=Int2StrZ( $dl, 2 );
//previous date
$date0z=date( "Y-m-d", mktime( -24, 0, 0, $ml, $dl, $yl ));
$date0z=split( "-", $date0z );
$y0z=$date0z[0]; $m0z=$date0z[1]; $d0z=$date0z[2];

$db_id=0;

if ( $graph<1 ) {
	echo $ged['days_relative_to']."&nbsp;".$now_dmY."
<table cellspacing='1' class='st2'>
<tr $cjust class='st_title2' style='height:28px'>
	<td width='55px'><b>".$ged['Number']."</b></td>
	<td><b>".$ged['Nick']."</b></td>
	<td><b>".$ged['Group']."</b></td>
	<td title='".$ged['Days_Before_Abort']."' width='50px'><b>".$ged['Days_Before_Abort']."</b></td>
	<td title='".$ged['Abort_Date']."' width='70px'><b>".$ged['Abort_Date~']."</b></td>
	<td title='".$ged['Age_tip']."' width='30px'><b>".$ged['Age']."</b></td>
</tr>";
}

$xxs_c=0;
$res1=mysql_query( "SELECT id, nick, ctrl_value_01, ctrl_value_02 FROM $lots
 WHERE ctrl_value_01>0 AND ctrl_value_02>0
 ORDER BY ctrl_value_02*1", $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
//echo "$lots:<br>";
	while ( $row=mysql_fetch_row( $res1 )) {
		$id=$row[0]; $name=$row[1];
		$ctrl01=$row[2];
		$ctrl02=$row[3];
		$xxs_c++;
		$lls[$xxs_c]=$id; $lls_n[$xxs_c]=$name;
		$lls_c01[$xxs_c]=$ctrl01; $lls_c02[$xxs_c]=$ctrl02;
//echo "cnt=$xxs_c id=$lls[$xxs_c] name=$lls_n[$xxs_c] ctrl01=$lls_c01[$xxs_c] ctrl02=$lls_c02[$xxs_c]<br>";
	}
	mysql_free_result( $res1 );
}
$lls_c=$xxs_c;

$xxs_c=0;
$res1=mysql_query( "SELECT id, nick, ctrl_value_01, ctrl_value_02 FROM $groups
 WHERE ctrl_value_01>0 AND ctrl_value_02>0
 ORDER BY ctrl_value_02*1", $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
//echo "$groups:<br>";
	while ( $row=mysql_fetch_row( $res1 )) {
		$id=$row[0]; $name=$row[1];
		$ctrl01=$row[2];
		$ctrl02=$row[3];
		$xxs_c++;
		$ggs[$xxs_c]=$id; $ggs_n[$xxs_c]=$name;
		$ggs_c01[$xxs_c]=$ctrl01; $ggs_c02[$xxs_c]=$ctrl02;
//echo "cnt=$xxs_c id=$ggs[$xxs_c] name=$ggs_n[$xxs_c] ctrl01=$ggs_c01[$xxs_c] ctrl02=$ggs_c02[$xxs_c]<br>";
	}
	mysql_free_result( $res1 );
}
$ggs_c=$xxs_c;

$xxs_c=0;
$res1=mysql_query( "SELECT id, nick, ctrl_value_01, ctrl_value_02 FROM $subgrs
 WHERE ctrl_value_01>0 AND ctrl_value_02>0
 ORDER BY ctrl_value_02*1", $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) {
//echo "$subgrs:<br>";
	while ( $row=mysql_fetch_row( $res1 )) {
		$id=$row[0]; $name=$row[1];
		$ctrl01=$row[2];
		$ctrl02=$row[3];
		$xxs_c++;
		$sss[$xxs_c]=$id; $sss_n[$xxs_c]=$name;
		$sss_c01[$xxs_c]=$ctrl01; $sss_c02[$xxs_c]=$ctrl02;
//echo "cnt=$xxs_c id=$sss[$xxs_c] name=$sss_n[$xxs_c] ctrl01=$sss_c01[$xxs_c] ctrl02=$sss_c02[$xxs_c]<br>";
	}
	mysql_free_result( $res1 );
}
$sss_c=$xxs_c;

$query="SELECT
 $cows.id,
 $cows.cow_num, $cows.nick,
 $cows.b_date,
 $cows.a_dates, $cows.b_dates, $cows.b_dates_res, $cows.c_dates, $cows.c_dates_res,
 $lots.nick, $groups.nick, $subgrs.nick
 FROM $cows, $lots, $groups, $subgrs
 WHERE $lots.id=$cows.lot_id AND $groups.id=$cows.gr_id AND $subgrs.id=$cows.subgr_id AND
 $cows.id>1 AND z_dates=''";
if ( $filts1>0 ) $query=$query." AND $cows.gr_id=$filts1";
if ( $filts2>0 ) $query=$query." AND $cows.subgr_id=$filts2";
$query=$query." ORDER BY $cows.a_dates";
$res1=mysql_query( $query, $db );
$sqlerr=mysql_errno();
if ( $sqlerr==0 ) { while ( $row=mysql_fetch_row( $res1 )) {
	$r=$row[0]*1;
	$cows_cnt++;
	$cwnum=$cownum_div.$row[1].$cownum_div1; $cwnick=$row[2];
	$bth_date=$row[3];
	$bth_date_arr=split( "-", $bth_date );
	$age_days=DaysBetween( Date_FromDb2Scr( $bth_date, "." ), $end1 );
	$insem_plus_days=-1;//days after insemination
	$rectal_plus_days=-1;//days after rectal
	$prep_zapusk_plus_days=-1;//days after zapusk preparing
	$zapusk_plus_days=-1;//days after zapusk
	$abort_plus_days=-1;//days after abort
	$insem_days=-1;//days before insemination
	$rectal_days=-1;//days before rectal
	$prep_zapusk_days=-1;//days before zapusk preparing
	$zapusk_days=-1;//days before zapusk
	$not_abort_days=-1;//days before not abort
	$insem_dates=$row[4]; $insem_date=Date_FromDb2Scr( $insem_dates, "." );
	$insem_date_arr=split( "-", $insem_dates );
	$rectal_dates=$row[5]; $rectal_date=Date_FromDb2Scr( $rectal_dates, "." ); $rectal_dates_res=$row[6]*1;
	$rectal_date_arr=split( "-", $rectal_dates );
	$abort_dates=$row[7]; $abort_date=Date_FromDb2Scr( $abort_dates, "." ); $abort_dates_res=$row[8]*1;
	$abort_date_arr=split( "-", $abort_dates );
	$ltname=$row[9]; $grname=$row[10]; $sgname=$row[11];
//fix long rows [BEGIN]
	$orow[cwnick]=StrCutLen1( $cwnick, 34, $contentCharset ); if ( $orow[conick]==$cwnick ) $cwnick=="";
	$orow[ltname]=StrCutLen1( $ltname, 16, $contentCharset ); if ( $orow[ltname]==$ltname ) $ltname=="";
	$orow[grname]=StrCutLen1( $grname, 16, $contentCharset ); if ( $orow[grname]==$grname ) $grname=="";
	$orow[sgname]=StrCutLen1( $sgname, 16, $contentCharset ); if ( $orow[sgname]==$sgname ) $sgname=="";
//fix long rows [END]
//states [BEGIN]
//insem? - may be inseminated
//rectal? - rectal possible
//fault_insem - not pregnant
//pregnant - pregnant
//abort- - good
//abort+ - bad (aborted)
	$state="insem?"; $state_add=-1;
	$phis_style="";
	if ( $insem_dates>$abort_dates & $insem_dates>$rectal_dates & trim( $insem_dates."." )!="." ) $state="insem+";
	if ( $rectal_dates>$insem_dates & $rectal_dates>$abort_dates & trim( $rectal_dates."." )!="." ) {
		if ( $rectal_dates_res!=4 ) $state="fault_insem";
		if ( $rectal_dates_res==4 ) $state="pregnant";
	}
	if ( $abort_dates>$insem_dates & $abort_dates>$rectal_dates & trim( $abort_dates."." )!="." ) {
		if ( $abort_dates_res!=4 ) $state="abort+";
		if ( $abort_dates_res==4 ) $state="abort-";
		$full_lact_days=DaysBetween( $abort_date, $end1 );
	} else {
		$full_lact_days="";
	}
	if ( $state=="insem?" & $age_days<$insem1st_days0 ) {
		$state="young";
	} else {
		if ( trim( $insem_dates ).trim( $rectal_dates ).trim( $abort_dates )."."=="." ) {
			$insem_date_next=date( "d.m.Y", mktime( 24*$insem1st_days0, 0, 0, $bth_date_arr[1], $bth_date_arr[2], $bth_date_arr[0] ));
			$insem_days=DaysBetween( $end1, $insem_date_next )."&nbsp;<br>$insem_date_next";
		}
	}
//states [END]
	if ( $state=="insem+" ) {
		$insem_plus_days=DaysBetween( $end1, $insem_date );
		if ( strlen( $insem_date )>3 ) {
			$rectal_date_next=date( "d.m.Y", mktime( 24*$rectal_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$rectal_days=DaysBetween( $end1, $rectal_date_next )."&nbsp;<br>$rectal_date_next";
			$prep_zapusk_date_next=date( "d.m.Y", mktime( 24*$prep_zapusk_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$prep_zapusk_days=DaysBetween( $end1, $prep_zapusk_date_next )."&nbsp;<br>$prep_zapusk_date_next";
			$zapusk_date_next=date( "d.m.Y", mktime( 24*$zapusk_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$zapusk_days=DaysBetween( $end1, $zapusk_date_next )."&nbsp;<br>$zapusk_date_next";
			$not_abort_date_next=date( "d.m.Y", mktime( 24*$not_abort_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$not_abort_days=DaysBetween( $end1, $not_abort_date_next )."&nbsp;<br>$not_abort_date_next";
		}
	}
	if ( $state=="fault_insem" ) {
		$rectal_plus_days=DaysBetween( $end1, $rectal_date );
		if ( strlen( $rectal_date )>3 ) {
			$insem_date_next=date( "d.m.Y", mktime( 24*$insem_days0_fault_rectal, 0, 0, $rectal_date_arr[1], $rectal_date_arr[2], $rectal_date_arr[0] ));
			$insem_days=DaysBetween( $end1, $insem_date_next )."&nbsp;<br>$insem_date_next";
		}
		$phis_style="style='color:#ffaa55'";
	}
	if ( $state=="pregnant" ) {
		$rectal_plus_days=DaysBetween( $end1, $rectal_date );
		if ( strlen( $insem_date )>3 ) {
			$prep_zapusk_date_next=date( "d.m.Y", mktime( 24*$prep_zapusk_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$prep_zapusk_days=DaysBetween( $end1, $prep_zapusk_date_next )."&nbsp;<br>$prep_zapusk_date_next";
			$zapusk_date_next=date( "d.m.Y", mktime( 24*$zapusk_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$zapusk_days=DaysBetween( $end1, $zapusk_date_next )."&nbsp;<br>$zapusk_date_next";
			$not_abort_date_next=date( "d.m.Y", mktime( 24*$not_abort_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$not_abort_days=DaysBetween( $end1, $not_abort_date_next )."&nbsp;<br>$not_abort_date_next";
		}
	}
	if ( $state=="abort+" ) {
		$abort_plus_days=DaysBetween( $end1, $zapusk_date );
		if ( strlen( $insem_date )>3 ) {
			$insem_date_next=date( "d.m.Y", mktime( 24*($not_abort_days0+$insem_days0), 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
			$insem_days=DaysBetween( $end1, $insem_date_next )*1;
			if ( $insem_days<=-1 ) $state_add="insem?";
			$insem_days=$insem_days."&nbsp;<br>$insem_date_next";
		}
		if ( strlen( $abort_date )>3 ) {
			$insem_date_next=date( "d.m.Y", mktime( 24*$insem_days0, 0, 0, $abort_date_arr[1], $abort_date_arr[2], $abort_date_arr[0] ));
			$insem_days=DaysBetween( $end1, $insem_date_next )*1;
			if ( $insem_days<=-1 ) $state_add="insem?";
			$insem_days="???&nbsp;".$insem_days."&nbsp;<br>$insem_date_next";
			$phis_style="style='color:#ff0000'";
		}
	}
	if ( $state=="abort-" ) {
		$abort_plus_days=DaysBetween( $end1, $abort_date );
		if ( strlen( $zapusk_date )>3 ) {
			$insem_date_next=date( "d.m.Y", mktime( 24*$insem_days0, 0, 0, $abort_date_arr[1], $abort_date_arr[2], $abort_date_arr[0] ));
			$insem_days=DaysBetween( $end1, $insem_date_next )."&nbsp;<br>$insem_date_next";
		}
	}
	if ( $state=="pregnant" | ( $state=="$insem?" & $insem_dates!="" ) | $state=="insem+" ) {
		if ( $insem_days==-1 ) $insem_days="&nbsp;";
		if ( $rectal_days==-1 ) $rectal_days="&nbsp;";
		if ( $prep_zapusk_days==-1 ) $prep_zapusk_days="&nbsp;";
		if ( $zapusk_days==-1 ) $zapusk_days="&nbsp;";
		if ( $not_abort_days==-1 ) $not_abort_days="&nbsp;";
		$parturition_Ymd=date( "Y-m-d", mktime( 24*$not_abort_days0, 0, 0, $insem_date_arr[1], $insem_date_arr[2], $insem_date_arr[0] ));
		if (( $dontuse_period!=4 & $parturition_Ymd>=$beg & $parturition_Ymd<=$end ) | ( $dontuse_period==4 )) {
			$parturition_days=DaysBetween( $now_dmY, $not_abort_date_next );
			$parturition_date=$not_abort_date_next;
			RepTr( $rownum );
			if ( $state_add!=-1 ) $state=$ged[$state].",&nbsp;".$ged[$state_add]; else $state=$ged[$state];
			if ( $userCoo!=9 & $userCoo!=0 ) $parturition_days="<a href='../".$hFrm['0600']."' target='_blank'>".$parturition_days."</a>";
			echo "
	<td $rjust><b><a href='../".$hFrm['0520']."?cow_id=".$r."&ret0=-1' target='_blank'>".$cwnum."</a></b></td>
	<td title='$cwnick'><a href='../".$hFrm['0520']."?cow_id=".$r."&ret0=-1' target='_blank'>".$orow[cwnick]."</a>&nbsp;</td>
	<td title='$grname'>".$orow[grname]."&nbsp;</td>
	<td $rjust>$parturition_days&nbsp;</td>
	<td $rjust>$parturition_date&nbsp;</td>
	<td $rjust>$age_days&nbsp;</td>
</tr>";
		}
	} else $cows_cnt--;
	}
	mysql_free_result( $res1 );
}

if ( $graph<1 ) {
	if ( $mq==0 ) {
		$mt1="-";
	} else {
		$mt1=floor( $mtotal/$mq*10 )/10;
	}
	echo "
<tr $cjust class='st_title2' style='height:28px'>
	<td $cjust><b>".$ged['TOTAL'].":</b></td>
	<td $rjust><b>$cows_cnt&nbsp;</b></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table><br>";

} else {
	$dots_set=$dots[0];
	if ( $dots_cnt>300 ) $dots_cnt=300;//no more than 300 dots for JpGraph!
	for ( $i=1; $i<=$dots_cnt; $i++ )
		$dots_set=$dots_set.";".$dots[$i];
	if ( $dots_cnt>2 ) {//no chance to build graph from less than two dots
		echo "
<center><input type='image' src='fgraphgd.php?dots_cnt=$dots_cnt&dots_set=$dots_set'></center>";
	} else;
}

ob_end_flush();
?>
