<?php
?>
<!-- DF_ajs: Opers Form -->
<!DOCTYPE html>
<html>
<head>
<?php
$title="Операції - Інтернет-Ферма";
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

<!--<div ng-controller="x"></div>-->
<div class="container wrapper" ng-controller="DbController">
<!--	<h1 class="text-center">Opers</h1>-->
	<nav class="navbar navbar-default">
		<div class="alert alert-default input-group search-box">
			<span class="input-group-btn"><input type="text" class="form-control" placeholder="Search In..." ng-model="search_query"></span>
		</div>
	</nav>
	<div class="clearfix"></div>
<!-- Cows List -->
	<div class="table-responsive" id="cws_list">
		<table class="table table-hover">
		<tr>
    		<th width='70px'>#</th>
			<th>Nick</th>
			<th width='100px'>Date of Birth</th>
			<th>Birth #</th>
		</tr>
		<tr ng-repeat="detail in details | filter:search_query">
			<td>{{detail.cow_num}}</td>
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
<script src="../js/f_ops.js"></script>

</body>
</html>