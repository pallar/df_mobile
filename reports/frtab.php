<?php
/* DF_2: reports/frtab.php
c: 20.03.2006
m: 13.03.2017 */

$reps_rep=CookieGet( $userCoo."_reps-rep" );

$local_id=CookieGet( "_id" );
$tab=$_GET["tab"];
$tab_db=Var_FromDb( $userCoo, $vars, $local_id.".reps-tab", "0" )*1;
if ( trim( $tab."." )!="." ) {
	$tab=$tab*1;
	Var_ToDb( $userCoo, $vars, "varchar", $local_id.".reps-tab", $tab );
} else $tab=$tab_db;

$tabs_t=array( $php_mm["_03_tab1_"], $php_mm["_03_tab2_"], $php_mm["_03_tab3_"], $php_mm["_03_tab4_"], $php_mm["_03_tab5_"], $php_mm["_03_tab6_"] );
$menuSub=1;
$efc_last="class='last'";
$efc_all_active="class='active'";
$efc_last_active="class='active last'";
for ( $i=0; $i<=5; $i++ ) $efc[$i]="";
$efc[5]=$efc_last;
if ( $tab==0 ) $efc[0]=$efc_all_active;
elseif ( $tab==1 ) $efc[1]=$efc_all_active;
elseif ( $tab==2 ) $efc[2]=$efc_all_active;
elseif ( $tab==3 ) $efc[3]=$efc_all_active;
elseif ( $tab==4 ) $efc[4]=$efc_all_active;
elseif ( $tab==5 ) $efc[5]=$efc_last_active;

$nav1="
<nav1>
<div id='cssmenu'>
<ul>";
for ( $i=0; $i<=5; $i++) $nav1.="
	<li ".$efc[$i]."><a href='../forms/f__reps.php?tab=".$i."'><span>".$tabs_t[$i]."</span></a></li>";
$nav1.="
</ul>
</div>
</nav1>";
?>
