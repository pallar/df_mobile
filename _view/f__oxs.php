<?php
?>
<!-- DF_ajs: Oxes Form -->
<!DOCTYPE html>
<html ng-app='f_oxs'>
<head>
<meta content='text/html;charset=utf-8' http-equiv='content-type'>
<meta name='generator' content='Dairy_Farm:php'>
<meta name='author' content='PALLAR LTD., 2008-2015'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>[2017:0214]&nbsp;Картотека - Інтернет-Ферма</title>
<link href='../css/f_0.css' rel='stylesheet' type='text/css'>
<link href='../css/f_1ch100.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_rgcl.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_rg2cls.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_list.css' rel='stylesheet' type='text/css'>
<link href='../_responsive/f_menu.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../css.lib/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/f_.css">
<script src="../js.lib/jquery/jquery.js"></script>
<script src="../js.lib/angular/angular.js"></script>
<script src="../js.lib/bootstrap/bootstrap.js"></script>
<script src="../js.lib/ngprogbar.js"></script>
<?php
$curr_app_tab=4; include "f_menu.php";
?>

<nav1>
	<div id='cssmenu'>
		<ul>
			<li><a href='f__als.php'><span>Ферми</span></a></li>
			<li><a href='f__ags.php'><span>Секції</span></a></li>
			<li><a href='f__asgs.php'><span>Підгрупи</span></a></li>
			<li><a href='f__abs.php'><span>Породи</span></a></li>
			<li><a href='f__cws.php'><span>Корови</span></a></li>
<!--			<li><a href='f__tags.php'><span>RFIDs</span></a></li>-->
			<li class='active last'><a href='f__oxs.php'><span>Бики</span></a></li>
		</ul>
	</div>
</nav1>

<script>
var nav=document.getElementsByTagName( 'nav' );
var nav1=document.getElementsByTagName( 'nav1' );
do_nav();

function do_nav() {
	var width=window.innerWidth || document.documentElement.clientWidth;
	window.document.cookie='_width='+width+';path=/';
	if ( width<=800 ) {
		childs=nav[0].children[0].children[0].childElementCount;
		childs1=nav1[0].children[0].children[0].childElementCount;
		nav[0].onclick=function( event ) {
			event=event || window.event;
			var t=event.target || event.srcElement;
//			if (t!=this) return true;
			for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=nav[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
			for ( var i=0; i<childs1; i++ ) nav1[0].children[0].children[0].children[i].style.display=nav1[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
		}
	}
}

window.onresize=function() {
	do_nav();
	var width=window.innerWidth || document.documentElement.clientWidth;
	childs=nav[0].children[0].children[0].childElementCount;
	childs1=nav1[0].children[0].children[0].childElementCount;
	if ( width>800 ) menu_li_style='inline-block'; else menu_li_style='none';
	for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=menu_li_style;
	for ( var i=0; i<childs1; i++ ) nav1[0].children[0].children[0].children[i].style.display=menu_li_style;
}
</script>

<!--<div ng-controller="x"></div>-->
<div class="container wrapper" ng-controller="DbController">
<!--	<h1 class="text-center">Oxes</h1>-->
	<nav class="navbar navbar-default">
		<div class="alert alert-default navbar-brand search-box">
			<button class="btn btn-primary" ng-show="show_form" ng-click="Ox_add_form_show()">Add&nbsp;&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
		</div>
		<div class="alert alert-default input-group search-box">
			<span class="input-group-btn"><input type="text" class="form-control" placeholder="Search In..." ng-model="search_query"></span>
		</div>
	</nav>
	<div class="col-md-6 col-md-offset-3">
<!-- Form template which is used to insert data -->
		<div ng-include src="'f__ox_a.htm'"></div>
<!-- Form template which is used to edit and update data -->
		<div ng-include src="'f__ox_e.htm'"></div>
	</div>
	<div class="clearfix"></div>
<!-- Oxes List -->
	<div class="table-responsive" id="oxs_list">
		<table class="table table-hover">
		<tr>
			<th width='60px'></th>
			<th width='60px'></th>
			<th width='70px'>#</th>
			<th>Nick</th>
			<th width='100px'>Date of Birth</th>
			<th>Birth #</th>
		</tr>
		<tr ng-repeat="detail in details | filter:search_query">
			<td><button class="btn btn-warning" title="Edit Ox" ng-click="Ox_edit_form_show(detail)"><span class="glyphicon glyphicon-edit"></span></button></td>
			<td><button class="btn btn-danger" title="Delete Ox" ng-disabled="detail.id==1" ng-click="db_Ox_delete(detail)"><span class="glyphicon glyphicon-trash"></span></button></td>
			<td>{{detail.num}}</td>
			<td>{{detail.nick}}</td>
			<td>{{detail.b_date}}</td>
			<td>{{detail.b_num}}</td>
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
<script src="../js/f_oxs.js"></script>

</body>
</html>