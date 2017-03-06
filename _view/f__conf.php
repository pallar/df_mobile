<?php
?>
<!-- DF_ajs: Configurator Form -->
<!DOCTYPE html>
<html ng-app="f_conf">
<head>
<title>[2017:0303]&nbsp;Конфігуратор - Інтернет-Ферма</title>
<?php
$curr_app_tab=6; include "f_menu.php";
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

<div class="container wrapper" ng-controller="DbController">
<!---	<h1 class="text-center">Configurator</h1>-->
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