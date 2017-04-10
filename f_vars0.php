<?php
/* DF_2: f_vars0.php
init: main vars
c: 14.10.2008
m: 07.04.2017 */

ob_start();

//WARNING! DONT TRANSLATE THIS TEXT BLOCK. MUST BE IN RUSSIAN (CP1251) [BEGIN]
$insem1st_varname="первое_осем.";//days before 1st insemination (after birthday)
$not_abort1st_varname="первый_отёл";//days before 1st abort (after birthday)
$rectal_varname="осем.-рект.";//days before rectal (after insemination)
$insem_fault_rectal_varname="рект._not_pregnant-осем.";//days before insemination (after bad rectal)
$prep_zapusk_varname="осем.-подготовка_к_запуску";//days before zapusk preparing (after insemination)
$zapusk_varname="осем.-запуск";//days before zapusk (after insemination)
$late_zapusk_varname="осем.-поздний_запуск";//days before late zapusk (after insemination)
$not_abort_varname="осем.-отёл";//days before abort (after insemination)
$insem_varname="отёл-осем.";//days before insemination (after abort)
$insem_abort_varname="аборт-осем.";//days before insemination (after abort)
$auto_prep_zapusk_varname="план_запуска";
//WARNING! DONT TRANSLATE THIS TEXT BLOCK. MUST BE IN RUSSIAN (CP1251) [END]

include( "f_ver.php" );
include( "f_lim.php" );
include( "f_myadm.php" );
if ( $grs_colors==1 ) include( "f_vars1.php" );

$devs_onmnemo=8;//devices on mnemo
$devs_onmnem1=32;//devices on normalization mnemo

$hDir['cache']="cache/";
$hDir['forms']="forms/";
$hDir['locales']="locales/";
$hDir['man']="help/";
$hDir['oper']="oper/";
$hDir['reps']="reports/";
$hDir['themes']="themes/";
$hDir['gd']="lib/jpgraph-1.21b/src/";

$hFrm['0000']="index.php";
$hFrm['0010']="f__mnem0.php";
$hFrm['9900']="index1.php";
$hFrm['9910']="f__mnem1.php";

$hFrm['0100']=$hDir['forms']."f__parl.php";
$hFrm['0200']=$hDir['forms']."f__todo.php";
$hFrm['0300']=$hDir['forms']."f__reps.php";
$hFrm['0310']=$hDir['forms']."f__rep.php";
$hFrm['0311']=$hDir['forms']."f__rep1.php";
$hFrm['0500']=$hDir['forms']."f__cards.php";
$hFrm['0600']=$hDir['forms']."f__ops.php";
$hFrm['0700']=$hDir['forms']."f__conf.php";

$hFrm['0011']=$hDir['forms']."f__login.php";
$hFrm['0012']=$hDir['forms']."f__per.php";

$hFrm['0013']=$hDir['forms']."f__dfexp.php";
$hFrm['0014']=$hDir['forms']."f__dfimp.php";

$hFrm['0610']=$hDir['oper']."f_chcws.php";

$hFrm['0510']=$hDir['forms']."f__ccw_l.php";
$hFrm['0520']=$hDir['forms']."f__ccw.php";
$hFrm['0521']=$hDir['forms']."f__ccw11.php";
$hFrm['0522']=$hDir['forms']."f__ccw12.php";
$hFrm['0530']=$hDir['forms']."f__cox.php";
$hFrm['0540']=$hDir['forms']."f__cusr.php";

$hRep['ccw1']=$hDir['reps']."f_ccw1.php";
$hRep['m']=$hDir['reps']."f_m.php";
$hRep['mcw_gs']=$hDir['reps']."f_mcw_gs.php";
$hRep['mcws0']=$hDir['reps']."f_mcws0.php";
$hRep['mcws1']=$hDir['reps']."f_mcws1.php";
$hRep['mcws1']=$hDir['reps']."f_mcws1.php";
$hRep['mlact']=$hDir['reps']."f_mlact.php";
$hRep['o']=$hDir['reps']."f_o.php";
$hRep['ofore2']=$hDir['reps']."f_ofore2.php";
$hRep['ofore3']=$hDir['reps']."f_ofore3.php";

$hcss["f_0.css"]="f_0.css";
$hcss["f_1ff036.css"]="f_1ff036.css";
$hcss["f_1ie060.css"]="f_1ie060.css";
$hcss["f_1ch100.css"]="f_1ch100.css";
$hcss["f_1op110.css"]="f_1op110.css";
$hcss["f_1ch100.css"]="f_1ch100.css";

if ( $ANGULAR_IS_USED!=0 ) {
	$hcss["f_0.css"]="../css/".$hcss["f_0.css"];
	$hcss["f_1ff036.css"]="../css/".$hcss["f_1ff036.css"];
	$hcss["f_1ie060.css"]="../css/".$hcss["f_1ie060.css"];
	$hcss["f_1ch100.css"]="../css/".$hcss["f_1ch100.css"];
	$hcss["f_1op110.css"]="../css/".$hcss["f_1op110.css"];
	$hDir["forms"]="_view/";
	$hFrm["0010"]=$hDir["forms"]."f__mnem0.php";
	$hFrm["0010_container"]="f__1_0.php";
	$hFrm["9910"]=$hDir["forms"]."f__mne_1.php";
	$hFrm["0011"]=$hDir["forms"]."f__logi_.php";
	$hFrm["0012"]=$hDir["forms"]."f__pe_.php";
} else {
	$hcss["f_0.css"]="../".$hcss["f_0.css"];
	$hcss["f_1ff036.css"]="../".$hcss["f_1ff036.css"];
	$hcss["f_1ie060.css"]="../".$hcss["f_1ie060.css"];
	$hcss["f_1ch100.css"]="../".$hcss["f_1ch100.css"];
	$hcss["f_1op110.css"]="../".$hcss["f_1op110.css"];
	$hFrm["0010_container"]="f__1st0.php";
}

//database tables
$sessions="f_sess";
$budms="f_budms";
$cows="f_cows";
$tags="f_tags";
$cowsdyna="f_cowsdy";
$cowsstat="f_cowsst";
$c_f2ml="f_c2ml";//cows: form 2-milk
$o_f2ml="f_o2ml";//oxes: form 2-milk
$departs="f_deps";
$oxes="f_oxes";
$xclasses="f__clses";//complex classes
$xraces="f__races";//races
$xfuncs="f__funcs";//functions
$breeds="f__brs";
$lots="f__lots";
$groups="f__grs";
$subgrs="f__sgrs";
$dfusers="f_users";
$person="f_person";
$dairymds="f_drmds";
$operstyp="f_ops";
$parlor="f_parlor";
$parlorstate="f_parlor_state";
$hardw="f_hardw";
$hardwj="f_hardwj";//jaggs
$hardwports="f_ports";
$globals="f_consts";
$states="f_states";
$pregnant="f_pregn";
$results="f_res";
$vars="f_vars";
$dbidx="f_dbidx";
$opers="000000_o";
$limits="f_limits";
$debug_log="_debug";

//f_o_mlk.php DISABLED FOR ALL USERS!
$operspriv=array( 64, 128, 256, 32, 4, 8, 512, 2048, 1024, 4096, 2, 8192, 1 );

$f_j="f_j.txt";

$cjust="align='center'"; $ljust="align='left'"; $rjust="align='right'";
$vcjust="valign='center'"; $vtjust="valign='top'"; $vbjust="valign='bottom'";

$rw_style="border:0; color:#003366; width:100%";
$rw_sty_0="border:0; color:#af33af; width:100%";
$rr_style="background:#f0f0f0; border:0; color:#003366; cursor:crosshair; width:100%";
$li_style="border:0; color:#003366; cursor:pointer; width:99%";

$view_class="class='cards_title'"; $edit_class="class='cards_title1'";

$cownum_div="&nbsp;"; $cownum_div1=".&nbsp;";

function Dbase_connect() {
	global $db, $db_host, $db_user, $db_password;
	$db=mysql_connect( $db_host, $db_user, $db_password );
}

function Dbase_disconnect() {
	global $db;
	mysql_close( $db );
}

function Dbase_select() {
	global $db, $db_name, $db_utf8, $connectionCharset, $connectionCharset1;
	if ( $connectionCharset!="cp1251" ) $connectionCharset="utf8";
//DONT TOUCH NEXT! CRITICAL FOR EXPORT!
	if ( $connectionCharset1=="cp1251" ) $connectionCharset="cp1251";
	mysql_select_db( $db_name, $db );
	if ( $db_utf8==1 ) {
		mysql_query( "SET CHARACTER SET ".$connectionCharset, $db );
		mysql_query( "SET NAMES ".$connectionCharset, $db );
	}
}

function CookieGet( $cname ) {
	global $HTTP_COOKIE_VARS, $_COOKIE;
//FOR PHP5 AND PHP4 COMPATIBILITY
	$res=$HTTP_COOKIE_VARS["$cname"];
	$res_php5=$_COOKIE["$cname"];
	if ( strlen( $res_php5 )>strlen( $res )) $res=$res_php5;
	return $res;
}

function CookieSet( $cname, $cvalue ) {
	setcookie( "$cname", "$cvalue", 0, "/" );
}

if ( $db_utf8==1 ) {
	$table_utf8="DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
	$dbCharset="utf8";
} else {
	$table_utf8="";
	$dbCharset="";
}

Dbase_connect(); Dbase_select();
$connect=new mysqli( $db_host, $db_user, $db_password, $db_name );
$connect->set_charset( $dbCharset );
//ERROR! WE CANT USE SUCH FUNC!
//if ( $connect->connect_error ) die( $connect->connect_error );

//CRITICAL! DONT TOUCH THIS!
$HUA="_".$_SERVER["HTTP_USER_AGENT"];
if ( strpos( $HUA, "Firefox" )!=0 ) $HUA="Firefox";
else if ( strpos( $HUA, "MSIE 6.0" )!=0 ) $HUA="MSIE";
else if ( strpos( $HUA, "Chrome" )!=0 ) $HUA="Chrome";
else if ( strpos( $HUA, "Opera" )!=0 ) $HUA="Opera";
else if ( strpos( $HUA, "Safari" )!=0 ) $HUA="Safari";
CookieSet( "_agent", $HUA  );
if ( $skip_W3C_DOCTYPE!=1 ) {
	$HUA="_".$_SERVER["HTTP_USER_AGENT"];
	echo "
<!DOCTYPE html>";
	if ( $ANGULAR_IS_USED>0 ) echo "
$HTML_COMMENT
$HTML_TAG";
	else echo "
<html>";
	echo "
<head>
<meta content='text/html;charset=".$contentCharset."' http-equiv='content-type'>
<meta name='generator' content='Dairy_Farm:php'>
<meta name='author' content='PALLAR LTD., 2008-2017'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
	if ( $skip_CSS!=1 ) echo "
<link href='".$hcss["f_0.css"]."' rel='stylesheet' type='text/css'>
<link href='../oper/f_opcss.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_rgcl.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_rg2cls.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_list.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_menu.css' rel='stylesheet' type='text/css'>";
	if ( $skip_CSS!=1 ) {
		if ( strpos( $HUA, "Firefox" )!=0 ) echo "
<link href='".$hcss["f_1ff036.css"]."' rel='stylesheet' type='text/css'>";
		else if ( strpos( $HUA, "MSIE 6.0" )!=0 ) echo "
<link href='".$hcss["f_1ie060.css"]."' rel='stylesheet' type='text/css'>";
		else if ( strpos( $HUA, "Chrome" )!=0 ) echo "
<link href='".$hcss["f_1ch100.css"]."' rel='stylesheet' type='text/css'>";
		else if ( strpos( $HUA, "Opera" )!=0 ) echo "
<link href='".$hcss["f_1op110.css"]."' rel='stylesheet' type='text/css'>";
		else if ( strpos( $HUA, "Safari" )!=0 ) echo "
<link href='".$hcss["f_1ch100.css"]."' rel='stylesheet' type='text/css'>";
	}
}

$lang=CookieGet( "_lang" );
if ( $lang=="" ) {
	$res=mysql_query( "SELECT `language` FROM `$globals`" ); $sqlerr=mysql_errno();
	if ( $sqlerr==0 ) {
		$lr=mysql_fetch_row( $res ); $lang=$lr[0];
	} else $lang="ru";
}
?>
