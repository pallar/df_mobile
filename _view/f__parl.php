<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Parlor Report Form -->";
$HTML_TAG="<html ng-app='f_parl'>";

include( "../f_vars.php" );

$title="По залу - Інтернет-Ферма";
$curr_app_tab=2; include "f_menu.php";
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
//			if (t!=this) return true;
			for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=nav[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
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
$graph=0;
//$f__jfilt__mode=0;
$btnToPrn=1;

//include( "../f__jfilt.php" );
include( "../reports/f_m.php" );
?>

</body>
</html>
