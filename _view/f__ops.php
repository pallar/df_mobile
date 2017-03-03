<?php
?>
<!-- DF_ajs: Parlor Report Form -->
<!DOCTYPE html>
<html>
<head>
<meta content='text/html; charset=utf-8' http-equiv='content-type'>
<meta name='generator' content='Dairy_Farm:php'>
<meta name='author' content='PALLAR LTD., 2008-2017'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>[2017:0214]&nbsp;Операції</title>
<link href='../css/f_0.css' rel='stylesheet' type='text/css'>
<link href='../css/f_1ch100.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_rgcl.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_rg2cls.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_list.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_menu.css' rel='stylesheet' type='text/css'>
<?php
$curr_app_tab=5; include "f_menu.php";
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

</body>
</html>