<?php
/* DF_2: dflib/f_tgs.php
groups list
c: 10.12.2005
m: 15.11.2015 */

function CardsMode_GroupsSubmode_Tabs( $l_c, $g_c, $s_c, $t_c ) {
	global $php_mm, $hDir, $hFrm;
	echo "
		<table width='516px'>
		<tr>
			<td>
				<div class='b_h'>
					<a href='../".$hFrm['0500']."?cards_groups_tab=bs' class='$t_c'><div class='p_100'></div>&nbsp;&nbsp;".$php_mm["_05_bs_lnk_"]."&nbsp;&nbsp;</a>
					<a href='../".$hFrm['0500']."?cards_groups_tab=ss' class='$s_c'><div class='p_100'></div>&nbsp;&nbsp;".$php_mm["_05_ss_lnk_"]."&nbsp;&nbsp;</a>
					<a href='../".$hFrm['0500']."?cards_groups_tab=gs' class='$g_c'><div class='p_100'></div>&nbsp;&nbsp;".$php_mm["_05_gs_lnk_"]."&nbsp;&nbsp;</a>
					<a href='../".$hFrm['0500']."?cards_groups_tab=ls' class='$l_c'><div class='p_100'></div>&nbsp;&nbsp;".$php_mm["_05_ls_lnk_"]."&nbsp;&nbsp;</a>
				</div>
			</td>
		</tr>
		</table>";
}

function CardsGroupsHead( $js_group_type, $i, $ii, $all_checked ) {
	global $userCoo, $lots, $groups, $subgrs, $breeds, $cjust, $ged, $php_mm;
	if ( $all_checked==1 ) $all_checkedstr="checked"; else $all_checkedstr="";
	echo "
		<div style='height:38px; overflow-x:hidden; overflow-y:scroll'>
		<table cellspacing='1' class='st2' style='width:495px'>
		<tr $cjust class='st_title2' style='height:28px'>
			<td width='20px'></td>
			<td width='100px'>".$ged['Number']."</td>
			<td>".$ged['Name']."</td>
		</tr>
		</table>
		</div>";
}

function CardsGroupsModifyCtrls( $group_type, $jj ) {
	global $php_mm;
/*	echo "
	<a href='"."$PHP_SELF?$group_type"."_find=$jj'><u>".$php_mm["_com_LOCA_lnk_"]."</u></a>
	<a href='"."$PHP_SELF?$group_type"."_edit=$jj'><u>".$php_mm["_com_UPDA_lnk_"]."</u></a>
	<a href='"."$PHP_SELF?$group_type"."_del=$jj'><u>".$php_mm["_com_DELE_lnk_"]."</u></a>";*/
	echo "
	<a href='"."$PHP_SELF?$group_type"."_add=$jj'><u>".$php_mm["_com_INSE_lnk_"]."</u></a>";
}

function CardsGroupsList( $i, $groups_db, $group_type, $cb_array ) {
	global $db, $userCoo, $cjust, $rjust, $PHP_SELF, $hDir, $hFrm;
	if ( $group_type=="cw_l" ) $js_group_type=1;
	if ( $group_type=="cw_g" ) $js_group_type=2;
	if ( $group_type=="cw_s" ) $js_group_type=3;
	if ( $group_type=="cw_b" ) $js_group_type=4;
	CardsGroupsHead( $js_group_type, 0, 0, $all_checked );
	echo "
		<div style='height:313px; overflow-x:hidden; overflow-y:scroll'>
		<table cellspacing='1' class='st2' style='width:495px'>";
	$res=mysql_query( "SELECT id FROM $groups_db", $db ) or die( mysql_error());
	$all_checked=1;
	while ( $row=mysql_fetch_row( $res )) {
		if ( $cb_array[$row[0]*1]*1==0 ) $all_checked=0;
	}
	mysql_free_result( $res );
	CookieSet( $userCoo."_gscbs", $all_checked );
	$res=mysql_query( "SELECT
	 id,
	 num, nick,
	 national_descr,
	 comments, locked
	 FROM $groups_db
	 ORDER BY ORD( $groups_db.nick )", $db );
	$k=0;
	while ( $row=mysql_fetch_row( $res )) {
		GrTr();
		$kk=$k+1;
		if ( $cb_array[$row[0]*1]==1 ) $checked_str="checked";
		else $checked_str="";
		if ( trim( $row[1]."." )=="." ) $row[1]="<font color='#ff0000'>?</font>";
		if ( $row[0]*1>1 & trim( $row[2]."." )=="." ) $row[2]="<font color='#ff0000'>?</font>";
		echo "
			<td height='23px' width='20px' $cjust></td>
			<td height='23px' $rjust width='100px'><b><a href='../".$hFrm['0510']."?locked=".$row[5]."&url_mode=".$group_type."&url_id=".$row[0]."'>".$row[1]."&nbsp;</b></td>
			<td><a href='../".$hFrm['0510']."?locked=".$row[5]."&url_mode=".$group_type."&url_id=".$row[0]."'>".$row[2]."&nbsp;</td>
		</tr>";
		$k++;
	}
	mysql_free_result( $res );
	echo "
		</table>
		</div>";
}

include( "../dflib/f_tfunc.php" );

$grs_list=trim( CookieGet( $userCoo."_".$onegroup_name ));
if ( $grs_list!="" )
	if ( $grs_list*1==-1 ) {
		$group_state=trim( CookieGet( $userCoo."_gscbs" ));
		Cbs_ToDb( $groups_dbt, $onegroup_name, $group_state );
	} else {
		Cb_ToDb( $onegroup_name, $grs_list, trim( CookieGet( $userCoo."_".$onegroup_name."state" )));
	}
$x=Cbs_FromDb( "$onegroup_name" );
for ( $i=0; $i<count( $x ); $i++ ) $cb_array[$x[$i]*1]=1;

echo "
<form name='df2__$onegroup_name' method='post' action='$PHP_SELF'>";
if ( $cards_tab_==0 ) {
	echo "
<div style='height:70%; visibility:$c_gdiv_vis; $c_gdiv_disp'>
<table>
<tr>
	<td style='padding-top:3px' valign='top'>";
	switch( $onegroup_name ) {
	case 'cw_b':
		CardsMode_GroupsSubmode_Tabs( "rCG", "rCG", "rCG", "rC" );
		$_find=$_GET[cw_b_find];
		$_edit=$_GET[cw_b_edit];
		$_del=$_GET[cw_b_del];
		$_add=$_GET[cw_b_add];
		break;
	case 'cw_g':
		CardsMode_GroupsSubmode_Tabs( "rCG", "rC", "rCG", "rCG" );
		$_find=$_GET[cw_g_find];
		$_edit=$_GET[cw_g_edit];
		$_del=$_GET[cw_g_del];
		$_add=$_GET[cw_g_add];
		break;
	case 'cw_l':
		CardsMode_GroupsSubmode_Tabs( "rC", "rCG", "rCG", "rCG" );
		$_find=$_GET[cw_l_find];
		$_edit=$_GET[cw_l_edit];
		$_del=$_GET[cw_l_del];
		$_add=$_GET[cw_l_add];
		break;
	case 'cw_s':
		CardsMode_GroupsSubmode_Tabs( "rCG", "rCG", "rC", "rCG" );
		$_find=$_GET[cw_s_find];
		$_edit=$_GET[cw_s_edit];
		$_del=$_GET[cw_s_del];
		$_add=$_GET[cw_s_add];
		break;
	}
	$i=0; $jj=0;
	$res=mysql_query( "SELECT id FROM $groups_dbt", $db );
	while ( $row=mysql_fetch_row( $res )) $jj=$jj+1;
	mysql_free_result( $res );
	if ( $_add==$jj ) {
		$num=$num_prefix."$jj";
		$nick="???:".$num_prefix."$jj";
		mysql_query( "INSERT INTO $groups_dbt (
		 `created_date`, `created_time`,
		 `modif_date`, `modif_time`,
		 `num`, `nick` )
		 VALUES (
		 '$now_Ymd', '$now_His',
		 '$noy_Ymd', '$now_His',
		 '$num', '$nick' )" ) or die( mysql_error());
		$jj=$jj+1;
	}
	echo "
		<table>
		<tr>
			<td style='height:39px; padding:5px'>";
	if ( $userCoo*1!=9 ) {
/*		echo "
	<a href='"."$PHP_SELF?$onegroup_name"."_find=$jj'><u>".$php_mm["_com_LOCA_lnk_"]."</u></a>
	<a href='"."$PHP_SELF?$onegroup_name"."_edit=$jj'><u>".$php_mm["_com_UPDA_lnk_"]."</u></a>
	<a href='"."$PHP_SELF?$onegroup_name"."_del=$jj'><u>".$php_mm["_com_DELE_lnk_"]."</u></a>";*/
		echo "
	<a href='"."$PHP_SELF?$onegroup_name"."_add=$jj'><u>".$php_mm["_com_INSE_lnk_"]."</u></a>";
	}
	echo "
			</td>
		</tr>
		<tr>
			<td>";
	CardsGroupsList( $i, "$groups_dbt", "$onegroup_name", $cb_array );
	echo "
			</td>
		</tr>
		</table>
	</td>
	<td width='3px'></td>
	<td height='270px' valign='top' width='487px'>
		<iframe height='100%' width='100%' src='../".$hDir['forms']."f_i".$onegroup_name."s.htm' frameborder='0' scrolling='no'></iframe>
	</td>
</tr>
</table>";
} else {
	if ( $cards_tab_==1 ) include( "f_tcws.php" );
	elseif ( $cards_tab_==3 ) include( "f_ttgs.php" );
	else include( "f_tos.php" );
	echo "
<input id='reload_' style='visibility:hidden' type='submit' value='refresh'>";
echo "
</form>";
}
?>
