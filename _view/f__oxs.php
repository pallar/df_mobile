<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Oxes Form -->";
$HTML_TAG="<html ng-app='f_oxs'>";

include( "../f_vars.php" );

$title="Картотека - Інтернет-Ферма";
$curr_app_tab=4; include "f_menu.php";

if ( CookieGet( "_mobile" )*1==0 ) {
	$_list_height=CookieGet( "_height" )*1-230;
	$_content_style="style='height:".$_list_height."px'";
} else $_content_style="";

if ( CookieGet( "_mobile" )*1==0 ) $_card_content_style="style=\"border-radius:0; height:".$_list_height."px; margin:0; padding:15px; overflow-y:auto;\"";
else $_card_content_style="style=\"border-radius:0; margin:0; padding:15px;\"";
?>

<nav1>
	<div id='cssmenu1'>
		<ul>
			<li><a href='f__als.php'><span>Ферми</span></a></li>
			<li><a href='f__ags.php'><span>Секції</span></a></li>
			<li><a href='f__asgs.php'><span>Підгрупи</span></a></li>
			<li><a href='f__abs.php'><span>Породи</span></a></li>
			<li><a href='f__cws.php'><span>Корови</span></a></li>
			<li><a href='f__atags.php'><span>TAGs</span></a></li>
			<li class='active last'><a href='f__oxs.php'><span>Бики</span></a></li>
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
<div ng-controller="DbController" style="height:0;">
<!--	<h3 class="text-center">Oxes</h3>-->
	<div class="alert navbar-brand">
		<button class="btn btn-primary" style="border-radius:0;" ng-show="show_form" ng-click="Ox_add_form_show();">Додати&nbsp;&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
	</div>
	<div class="alert input-group search-box">
		<span class="input-group-btn"><input type="text" class="form-control" placeholder="Search In..." style="border-radius:0;" ng-model="search_query"></span>
	</div>
<!-- Form template which is used to insert data -->
	<form class="alert alert-warning" id="ox_add_form" name="ox_add" <?php echo $_form_content_style;?> hidden>
		<div <?php echo $_card_content_style;?>>
<?php
include( "f__ox_a.htm" );
?>
		</div>
	</form>
<!-- Form template which is used to edit and update data -->
	<form class="alert alert-warning" id="ox_edit_form" name="ox_edit" <?php echo $_form_content_style;?> hidden>
		<div <?php echo $_card_content_style;?>>
<?php
include( "f__ox_e.htm" );
?>
		</div>
	</form>
	<div class="clearfix"></div>
<!-- Oxes List -->
	<div class="table-responsive" id="oxs_list" <?php echo $_content_style;?>>
		<table class="table table-hover">
		<tr>
			<th width="80px"></th>
			<th width="80px"></th>
			<th width="80px">Num.</th>
			<th>Nick</th>
			<th width="100px">Date of Birth</th>
			<th>Birth Num.</th>
		</tr>
		<tr ng-repeat="detail in details | filter:search_query">
			<td style="padding-left:16px;"><button class="btn btn-warning" style="border-radius:0; padding-left:10px; padding-right:10px;" title="Edit" ng-click="Ox_edit_form_show(detail);"><span class="glyphicon glyphicon-edit"></span></button></td>
			<td><button class="btn btn-danger" style="border-radius:0; padding-left:10px; padding-right:10px;" title="Delete" ng-disabled="detail.id==1 || detail.locked.length>0" ng-click="db_Ox_delete(detail);"><span class="glyphicon glyphicon-trash"></span></button></td>
			<td>{{detail.num}}</td>
			<td>{{detail.nick}}</td>
			<td>{{detail.b_date}}</td>
			<td>{{detail.b_num}}</td>
		</tr>
		</table>
	</div>
	<nav class="navbar navbar-default" ng-if="hasMoreData">
		<div class="alert alert-default navbar-brand">
			<a class="btn btn-primary" role="button" ng-click="paginateResultSet();">Load More</a>
		</div>
	</nav>
</div>
<!-- Controller -->
<script src="../js/f_oxs.js"></script>

</body>
</html>
