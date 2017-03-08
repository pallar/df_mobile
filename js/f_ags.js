// DF_ajs: f_gs module
var f_gs = angular.module('f_gs',[]);

f_gs.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Gs_get();

	// To enable 'Add' button
	$scope.show_form=true;

	function db_Gs_get() {
		$http.post('../db_cmds/ags_g.php').success(function(__data) {
			$scope.details=__data;
		});
	}

	$scope.db_G_delete=function(__info) {
		$http.post('../db_cmds/ag_d.php',{
		 'id':__info.id
		}).success(function(__data) {
			db_Gs_get();
		});
	}

	$scope.db_G_insert=function(__info) {
		$http.post('../db_cmds/ag_i.php',{
		 'num':__info.num,
		 'nick':__info.nick
		}).success(function(__data) {
			if(__data==1) {
				$('#g_add_form').css('display','none');
				db_Gs_get();
			}
		});
	}

	$scope.cur_g={};

	$scope.db_G_update=function(__info) {
		$http.post('../db_cmds/ag_u.php',{
		 'id':__info.id,
		 'num':__info.num,
		 'nick':__info.nick
		}).success(function(__data) {
			$scope.show_form=true;
			if(__data==1) db_Gs_get();
		});
	}

	$scope.G_add_form_show=function() {
		$scope.new_g={};
		$('#gs_list').css('display','none');
		$('#g_edit_form').css('display','none');
		$('#g_add_form').slideToggle();
	}

	$scope.G_form_close=function(cancel,anchor) {
		$('#g_add_form').css('display','none');
		$('#g_edit_form').css('display','none');
		$('#gs_list').css('display','');
		if(cancel=='cancel') db_Gs_get();
		window.location.hash=anchor;
	}

	$scope.G_edit_form_show=function(__info) {
		$scope.cur_g=__info;
		$('#gs_list').css('display','none');
		$('#g_add_form').css('display','none');
		$('#g_edit_form').slideToggle();
	}
}]);