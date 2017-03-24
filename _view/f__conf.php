<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Configurator Form -->";
$HTML_TAG="<html ng-app='f_conf'>";

include( "../f_vars.php" );

$title="Конфігуратор - Інтернет-Ферма";
$curr_app_tab=6; include "f_menu.php";
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

<div class="container wrapper" ng-controller="DbController">
	<div class="col-md-6 col-md-offset-3">
<!-- Form template -->
		<div ng-include src="'f__conf0.htm'"></div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- Controller -->
<script src="../js/f_conf.js"></script>

</body>
</html>