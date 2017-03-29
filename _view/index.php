<?php
ob_start();

$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Mnemo Form -->";
$HTML_TAG="<html ng-app='f_mnemo'>";

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

$title="Мнемосхема";
$curr_app_tab=1; include "f_menu.php";
?>

<script language='JavaScript' type='text/javascript'>
var nav=document.getElementsByTagName( 'nav' );
do_nav();

function do_nav() {
	get_window_prop();
	if ( width<=800 ) {
		childs=nav[0].children[0].children[0].childElementCount;
		nav[0].onclick=function( event ) {
			event=event || window.event;
			var t=event.target || event.srcElement;
			for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=nav[0].children[0].children[0].children[i].style.display==='none' ? 'block' : 'none';
			css_files=document.styleSheets.length;
//			alert( css_files );
			for ( css_file=1; css_file<css_files; css_file++ ) {
				css_href=document.styleSheets[css_file].href;
//				alert( css_href );
				if ( css_href!=null ) {
					if ( css_href.indexOf( "f_menu.css" )>0 ) {
						css_menu_rules=document.styleSheets[css_file].cssRules.length;
						for ( css_menu_rule=1; css_menu_rule<css_menu_rules; css_menu_rule++ ) {
							cur_rule=document.styleSheets[css_file].cssRules[css_menu_rule].cssText;
							if ( cur_rule.indexOf( "nav::before" )>0 ) {
								content_rule=cur_rule;
								alert( cur_rule );
//								document.styleSheets[css_file].deleteRule( css_menu_rule );
//								document.styleSheets[css_file].insertRule( 'nav:before { content:"||"; }' );
							}
						}
					}
				}
			}
		}
	}
}

window.onresize=function() {
	do_nav();
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

echo "
</body>
</html>";

ob_end_flush();
?>
