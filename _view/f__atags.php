<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Tags Form -->";
$HTML_TAG="<html ng-app='f_atags'>";

include( "../f_vars.php" );

$title="Картотека - Інтернет-Ферма";
$curr_app_tab=4; include "f_menu.php";

if ( CookieGet( "_mobile" )*1==0 ) {
	$_list_height=CookieGet( "_height" )*1-230;
	$_content_style="style='height:".$_list_height."px'";
} else $_content_style="";

if ( CookieGet( "_mobile" )*1==0 ) $_card_content_style="style=\"height:".$_list_height."px; margin:0; padding:15px; overflow-y:auto;\"";
else $_card_content_style="style=\"margin:0; padding:15px;\"";
?>

<nav1>
	<div id='cssmenu1'>
		<ul>
			<li><a href='f__als.php'><span>Ферми</span></a></li>
			<li><a href='f__ags.php'><span>Секції</span></a></li>
			<li><a href='f__asgs.php'><span>Підгрупи</span></a></li>
			<li><a href='f__abs.php'><span>Породи</span></a></li>
			<li><a href='f__cws.php'><span>Корови</span></a></li>
			<li class='active'><a href='f__atags.php'><span>TAGs</span></a></li>
			<li class='last'><a href='f__oxs.php'><span>Бики</span></a></li>
		</ul>
	</div>
</nav1>

<script>
var nav=document.getElementsByTagName( 'nav' );
var nav1=document.getElementsByTagName( 'nav1' );
do_nav();

function do_nav() {
	get_window_prop();
	if ( width<=800 ) {
		childs=nav[0].children[0].children[0].childElementCount;
		childs1=nav1[0].children[0].children[0].childElementCount;
		nav[0].onclick=function( event ) {
			event=event || window.event;
//			var t=event.target || event.srcElement;
//			if (t!=this) return true;
			if ( event.clientY<=nav[0].offsetHeight ) {
				for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=nav[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
				for ( var i=0; i<childs1; i++ ) nav1[0].children[0].children[0].children[i].style.display=nav1[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
			}
		}
	}
}

window.onresize=function() {
	do_nav();
}
</script>

<!--<div ng-controller="x"></div>-->
<div ng-controller="DbController" style="height:0">
<!--	<h3 class="text-center">TAGs</h3>-->
	<div class="alert input-group search-box">
		<span class="input-group-btn"><input type="text" class="form-control" placeholder="Search In..." style="border-radius:0;" ng-model="search_query"></span>
	</div>
	<div class="clearfix"></div>
<!-- TAGs List -->
	<div class="table-responsive" id="atags_list" <?php echo $_content_style;?>>
	</div>
	<nav class="navbar navbar-default" ng-if="hasMoreData">
		<div class="alert alert-default navbar-brand">
			<a class="btn btn-primary" role="button" ng-click="paginateResultSet();">Load More</a>
		</div>
	</nav>
</div>
<!-- Controller -->
<script src="../js/f_atags.js"></script>

</body>
</html>
