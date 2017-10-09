<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Configurator Form -->";
$HTML_TAG="<html ng-app='f_conf'>";

include( "../f_vars.php" );

$title="Конфігуратор - Інтернет-Ферма";
$curr_app_tab=6; include "f_menu.php";

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

<div ng-controller="DbController" style="height:0">

<form class="alert alert-warning" id="conf_form" name="conf" ng-submit="db_Conf_update(details);" style="margin:0; padding:0;">
	<!-- Form template -->
	<div <?php echo $_content_style;?>>
<?php
	include( "f__conf0.htm" );
?>
	</div>
	<div class="clearfix"></div>
</form>

</div>
<!-- Controller -->
<script src="../js/f_conf.js"></script>

</body>
</html>
