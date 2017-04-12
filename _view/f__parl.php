<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Parlor Report Form -->";
$HTML_TAG="<html ng-app='f_parl'>";

include( "../f_vars.php" );

$title="По залу - Інтернет-Ферма";
$curr_app_tab=2; include "f_menu.php";

if ( CookieGet( "_mobile" )*1==0 ) {
	$_list_height=CookieGet( "_height" )*1-100;
	$_content_style="style=\"height:".$_list_height."px; margin:0; padding:15px; overflow-y:auto;\"";
} else $_content_style="style=\"margin:0; padding:15px;\"";
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
//			var t=event.target || event.srcElement;
//			if (t!=this) return true;
			if ( event.clientY<=nav[0].offsetHeight ) {
				for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=nav[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
			}
		}
	}
}

window.onresize=function() {
	do_nav();
}
</script>

<?php
$graph=0;
//$f__jfilt__mode=0;
$btnToPrn=1;

//include( "../f__jfilt.php" );
echo "
	<div $_content_style>";
include( "../reports/f_m.php" );
?>

</div>

</body>
</html>