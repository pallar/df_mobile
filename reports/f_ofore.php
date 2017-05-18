<?php
/* DF_2: reports/f_ofore[CAST]1.php
report: forecast for all cows (moving from group to group)
c: 24.09.2008
m: 17.05.2017 */

$dbt_ext="_o";

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$graph=$_GET["graph"]*1; $title_=$title=$_GET["title"];

$outsele_=-1; $outsele_table=-1; $outsele_field=-1;

$cows_cnt=0;

$dontuse_period=2;//ONLY IN THIS REPORT, PERIOD_BEGIN=PERIOD_END MINUS 7 DAYS

include( "f_mt1c.php" );

$th1=$ged["Number"];
$th2=$ged["Nick"];
$th3=$ged["Age_tip"]; $th3_=$ged["Age"];
$th4=$ged["Lot"];
$th5=$ged["Group"];
$th6=$ged["Subgroup"];
$th7=$ged["Days_Before_Insem"]." / ".$ged["Insem_Date"]; $th7_=$ged["Insem_Date~"];
$th8=$ged["Days_Before_Rectal"]." / ".$ged["Rectal_Date"]; $th8_=$ged["Rectal_Date~"];
$th9=$ged["Days_Before_Prep_Zapusk"]." / ".$ged["Prep_Zapusk_Date"]; $th9_=$ged["Prep_Zapusk_Date~"];
$tha=$ged["Days_Before_Zapusk"]." / ".$ged["Zapusk_Date"]; $tha_=$ged["Zapusk_Date~"];
$thb=$ged["Days_Before_Abort"]." / ".$ged["Abort_Date"]; $thb_=$ged["Abort_Date~"];
$thc=$ged["Phis._State"]; $thc_=$ged["Last_Data"];
$thd=$ged["Yesterday_Milk"]; $thd_=$ged["Yesterday_Milk~"];
$the=$ged["Today_Milk"]; $the_=$ged["Today_Milk~"];
$thf=$ged["Average_7"]; $thf_=$ged["Average_7~"];
$thg=$ged["Lact_Days"]; $thg_=$ged["Lact_Days~"];

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1) { background:#ddd; }
	#rep_tbody td:nth-of-type(1):before { content:".$th1."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:".$th2."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:".$th3."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(4):before { content:".$th4."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(5):before { content:".$th5."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(6):before { content:".$th6."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(7):before { content:".$th7."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(8):before { content:".$th8."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(9):before { content:".$th9."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(10):before { content:".$tha."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(11):before { content:".$thb."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(12):before { content:".$thc."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(13):before { content:".$thd."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(14):before { content:".$the."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(15):before { content:".$thf."; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(16):before { content:".$thg."; text-align:left; top:0; }";

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
	echo $ged["days_relative_to"]."&nbsp;".$end1."
<table>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th width='55px'><b>".$th1."</b></td>
	<th><b>".$th2."</b></td>
	<th title='".$th3."' width='30px'><b>".$th3_."</b></td>
	<th width='70px'><b>".$th4."</b></td>
	<th width='70px'><b>".$th5."</b></td>
	<th width='70px'><b>".$th6."</b></td>
	<th title='".$th7."' width='70px'><b>".$th7_."</b></td>
	<th title='".$th8."' width='70px'><b>".$th8_."</b></td>
	<th title='".$th9."' width='70px'><b>".$th9_."</b></td>
	<th title='".$tha."' width='70px'><b>".$tha_."</b></td>
	<th title='".$thb."' width='70px'><b>".$thb_."</b></td>
	<th title='".$thc."' width='200px'><b>".$thc_."</b></td>
	<th title='".$thd."' width='40px'><b>".$thd_."</b></td>
	<th title='".$the."' width='40px'><b>".$the_."</b></td>
	<th title='".$thf."' width='40px'><b>".$thf_."</b></td>
	<th title='".$thg."' width='40px'><b>".$thg_."</b></td>
</tr>
</thead>
<tbody id='rep_tbody'>";
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

$res1=mysql_query( "SELECT
 $cows.id,
 $cows.cow_num, $cows.nick,
 $cows.b_date,
 $cows.a_dates, $cows.b_dates, $cows.b_dates_res, $cows.c_dates, $cows.c_dates_res,
 $lots.nick, $groups.nick, $subgrs.nick
 FROM $cows, $lots, $groups, $subgrs
 WHERE $lots.id=$cows.lot_id AND $groups.id=$cows.gr_id AND $subgrs.id=$cows.subgr_id AND
 $cows.id>1 AND z_dates=''
 ORDER BY $cows.cow_num*1", $db );
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
	$orow[cwnick]=StrCutLen1( $cwnick, 34, $contentCharset ); if ( $orow[cwnick]==$cwnick ) $cwnick=="";
	$orow[ltname]=StrCutLen1( $ltname, 14, $contentCharset ); if ( $orow[ltname]==$ltname ) $ltname=="";
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
	if ( $insem_days==-1 ) $insem_days="&nbsp;";
	if ( $rectal_days==-1 ) $rectal_days="&nbsp;";
	if ( $prep_zapusk_days==-1 ) $prep_zapusk_days="&nbsp;";
	if ( $zapusk_days==-1 ) $zapusk_days="&nbsp;";
	if ( $not_abort_days==-1 ) $not_abort_days="&nbsp;";
	if ( $state_add!=-1 ) $state=$ged[$state].",&nbsp;".$ged[$state_add]; else $state=$ged[$state];
	$idx="$m0z-$d0z"; $sess=0; $mrow0z=$mrowt[$r][$idx.$sess];
	$idx="$m1z-$d1z"; $sess=0; $mrow1z=$mrowt[$r][$idx.$sess];
	if ( $mrowtq[$r][0]==0 ) {
		$mrow1=""; $mrowtq[$r][0]="";
	} else {
		$mrow1=floor( $mrowt[$r][0]/7*10 )/10;
	}
	echo "
<tr>
	<td $rjust><b><a href='../".$hFrm["0520"]."?cow_id=".$r."&ret0=-1'>".$cwnum."</a></b></td>
	<td title='$cwnick'><a href='../".$hFrm["0520"]."?cow_id=".$r."&ret0=-1'>".$orow["cwnick"]."</a>&nbsp;</td>
	<td $rjust>$age_days&nbsp;</td>
	<td title='$ltname'>".$orow["ltname"]."&nbsp;</td>
	<td title='$grname'>".$orow["grname"]."&nbsp;</td>
	<td title='$sgname'>".$orow["sgname"]."&nbsp;</td>
	<td $rjust>$insem_days&nbsp;</td>
	<td $rjust>$rectal_days&nbsp;</td>
	<td $rjust>$prep_zapusk_days&nbsp;</td>
	<td $rjust>$zapusk_days&nbsp;</td>
	<td $rjust>$not_abort_days&nbsp;</td>
	<td $ljust $phis_style>$insem_date; $rectal_date; $abort_date;<br><u>$state</u>&nbsp;</td>
	<td $rjust>$mrow0z&nbsp;</td>
	<td $rjust>$mrow1z&nbsp;</td>
	<td $rjust>$mrow1&nbsp;</td>
	<td $rjust>$full_lact_days&nbsp;</td>
</tr>";
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
</tbody>
<tfoot id='rep_tfoot'>
<tr style='height:28px'>
	<td $cjust><b>".$ged['TOTAL'].":</b></td>
	<td $rjust><b>$cows_cnt&nbsp;</b></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</tfoot>
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

include( "frfoot.php" );
?>
