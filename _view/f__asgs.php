<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Subgroups Form -->";
$HTML_TAG="<html ng-app='f_sgs'>";

include( "../f_vars.php" );

$title="Картотека - Інтернет-Ферма";
$curr_app_tab=4; include "f_menu.php";

if ( CookieGet( "_mobile" )*1==0 ) {
	$_list_height=CookieGet( "_height" )*1-230;
	$_content_style="style='height:".$_list_height."px'";
} else $_content_style="";
?>

<nav1>
	<div id='cssmenu1'>
		<ul>
			<li><a href='f__als.php'><span>Ферми</span></a></li>
			<li><a href='f__ags.php'><span>Секції</span></a></li>
			<li class='active'><a href='f__asgs.php'><span>Підгрупи</span></a></li>
			<li><a href='f__abs.php'><span>Породи</span></a></li>
			<li><a href='f__cws.php'><span>Корови</span></a></li>
			<li><a href='f__atags.php'><span>TAGs</span></a></li>
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
<!--	<h3 class="text-center">Subgroups</h3>-->
	<div class="alert navbar-brand">
		<button class="btn btn-primary" ng-show="show_form" ng-click="Sg_add_form_show()">Add&nbsp;&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
	</div>
	<div class="alert input-group search-box">
		<span class="input-group-btn"><input type="text" class="form-control" placeholder="Search In..." ng-model="search_query"></span>
	</div>
	<div class="col-md-6 col-md-offset-3">
<!-- Form template which is used to insert data -->
		<div ng-include src="'f__asg_a.htm'"></div>
<!-- Form template which is used to edit and update data -->
		<div ng-include src="'f__asg_e.htm'"></div>
	</div>
	<div class="clearfix"></div>
<!-- Subgroups List -->
	<div class="table-responsive" id="sgs_list" <?php echo $_content_style;?>>
		<table class="table table-hover">
		<tr>
			<th width="80px"></th>
			<th width="80px"></th>
			<th>Nick</th>
			<th width="80px">#</th>
		</tr>
		<tr ng-repeat="detail in details | filter:search_query">
			<td><button class="btn btn-warning" title="Edit Subgroup" ng-click="Sg_edit_form_show(detail)"><span class="glyphicon glyphicon-edit"></span></button></td>
			<td><button class="btn btn-danger" title="Delete Subgroup" ng-disabled="detail.id==1" ng-click="db_Sg_delete(detail)"><span class="glyphicon glyphicon-trash"></span></button></td>
			<td>{{detail.nick}}</td>
			<td>{{detail.num}}</td>
		</tr>
		</table>
	</div>
	<nav class="navbar navbar-default" ng-if="hasMoreData">
		<div class="navbar-header">
			<div class="alert alert-default navbar-brand">
				<a class="btn btn-primary" role="button" ng-click="paginateResultSet()">Load More</a>
			</div>
		</div>
	</nav>
</div>
<!-- Controller -->
<script src="../js/f_asgs.js"></script>

</body>
</html>