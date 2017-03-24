<?php
ob_start();

$skip_W3C_DOCTYPE=1;

$ANGULAR_IS_USED=1;

include( "../f_vars.php" );
include( "../dflib/f_func.php" );
$res=mysql_query( "SELECT usid FROM $globals", $db ); $sqlerr=mysql_errno()*1;
if ( $sqlerr==0 ) {
	$usid=mysql_fetch_row( $res ); $farm_id=$usid[0];
} else $farm_id="UNDEFINED";

include( "index0.php" );

include( "../locales/$lang/f_php._$lang" );
include( "../locales/$lang/f_00._$lang" );

$dev_b=$dev_1st; $dev_e=$dev_b+$devs_onmnemo-1;
?>
<!-- DF_ajs: Mnemo Form -->
<!DOCTYPE html>
<html ng-app='f_mnemo'>
<head>
<?php
$title="Мнемосхема";
$curr_app_tab=1; include "f_menu.php";
?>

<script language='JavaScript' type='text/javascript'>
var nav=document.getElementsByTagName( 'nav' );
do_nav();

function do_nav() {
	var width=window.innerWidth || document.documentElement.clientWidth;
	window.document.cookie='_width='+width+';path=/';
	if ( width<=800 ) {
		childs=nav[0].children[0].children[0].childElementCount;
		nav[0].onclick=function( event ) {
			event=event || window.event;
			var t=event.target || event.srcElement;
//			if (t!=this) return true;
			for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=nav[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
		}
	}
}

window.onresize=function() {
	do_nav();
	var width=window.innerWidth || document.documentElement.clientWidth;
	childs=nav[0].children[0].children[0].childElementCount;
	if ( width>800 ) menu_li_style='inline-block'; else menu_li_style='none';
	for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=menu_li_style;
}
</script>

<?php
include( "../".$hFrm["0010"] );

if ( $LOCAL_CHAT ) echo "<center><a href='../chat/'>".$php_mm["Chat"]."</a></center>";
else {
	ini_set( "user_agent", "Mozilla/5.0" );// to unlock .htaccess rules
	$c="";
	if ( $fp=fopen( "http://pallar.com.ua/fchat/announcements.php?lang=$lang&farm_id=$farm_id&user=$userCoo&app_rel=$app_rel", "r" )) {
		while ( $l=fread( $fp, 1024 )) $c.=$l;
		fclose( $fp );
	}
	echo "$c";
}

include( "../locales/$lang/f_admmsg._$lang" );

ob_end_flush();
?>

</body>
</html>