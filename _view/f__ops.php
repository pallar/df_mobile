<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Opers Form -->";
$HTML_TAG="<html ng-app='f_ops'>";

include( "../f_vars.php" );
include( "../locales/$lang/f_prep._$lang" );
include( "../locales/$lang/f_php._$lang" );
include( "../locales/$lang/f_sel._$lang" );
include( "../locales/$lang/f_cows._$lang" );
include( "../locales/$lang/f_06._$lang" );//for jquery operations
include( "../dflib/f_func.php" );
include( "../dflib/f_lib1.php" );
include( "../dflib/f_librep.php" );

$div_hide=$_GET["div_hide"];
$add_oper=$_POST["add_oper"];
if ( $add_oper!="" ) $body_onload_add="";
if ( $div_hide!=1 ) $body_onload_add="cal_nowdayslist(); cal_fromcoo(); fill_tdsDates();";

$op0_php=$_GET["include"];
if ( $op0_php."."!="." ) {
	$include_tag_style=1; $included_tag_style_php="../oper/fohead.php";
	$opertype=$_GET["opertype"]*1;
	if ( $opertype==1 ) $url_="mlk";
	else if ( $opertype==2 ) $url_="mlkt";
	else if ( $opertype==4 ) $url_="meas";
	else if ( $opertype==8 ) $url_="care";
	else if ( $opertype==16 ) $url_="cond";
	else if ( $opertype==32 ) $url_="vacc";
	else if ( $opertype==64 ) $url_="mov";
	else if ( $opertype==128 | $opertype==256 ) $url_="insm";
	else if ( $opertype==512 ) $url_="rect";
	else if ( $opertype==1024 ) $url_="abrt";
	else if ( $opertype==2048 ) $url_="abrt";
	else if ( $opertype==4096 ) $url_="abrt";
	else if ( $opertype==8192 ) $url_="jagg";
	$op0_php="../oper/f_o_".$url_."0.php";
	include( "$op0_php" );
}

$title="Операції - Інтернет-Ферма";
$curr_app_tab=5; include "f_menu.php";
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

<!--<div ng-controller="x"></div>-->
<div ng-controller='DbController' style='height:0;'>

<?php
include( "../oper/f_chcws.php" );
?>

</div>
<!-- Controller -->
<script src='../js/f_ops.js'></script>

</body>
</html>
