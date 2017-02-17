// DF_ajs: f_oxs module
var f_oxs = angular.module('f_oxs',[]);

f_oxs.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Oxs_get();

	// To enable 'Add' button
	$scope.show_form=true;

	function db_Oxs_get() {
		$http.post('../db_cmds/oxs_g.php').success(function(__data) {
			$scope.details=__data;
		});
	}

	$scope.db_Ox_delete=function(__info) {
		$http.post('../db_cmds/ox_d.php',{
		 'id':__info.id
		}).success(function(__data) {
			db_Oxs_get();
		});
	}

	$scope.db_Ox_insert=function(__info) {
		$http.post('../db_cmds/ox_i.php',{
		 'num':__info.num,
		 'b_date':__info.b_date,
		 'b_num':__info.b_num,
		 'nick':__info.nick
		}).success(function(__data) {
			if(__data==1) {
				$('#ox_add_form').css('display','none');
				db_Oxs_get();
			}
		});
	}

	$scope.cur_ox={};

	$scope.db_Ox_update=function(__info) {
		$http.post('../db_cmds/ox_u.php',{
		 'id':__info.id,
		 'num':__info.num,
		 'b_date':__info.b_date,
		 'b_num':__info.b_num,
		 'nick':__info.nick
		}).success(function(__data) {
			$scope.show_form=true;
			if(__data==1) db_Oxs_get();
		});
	}

	$scope.Ox_add_form_show=function() {
		$scope.new_ox={};
		$('#oxs_list').css('display','none');
		$('#ox_edit_form').css('display','none');
		$('#ox_add_form').slideToggle();
	}

	$scope.Ox_form_close=function(cancel,anchor) {
		$('#ox_add_form').css('display','none');
		$('#ox_edit_form').css('display','none');
		$('#oxs_list').css('display','');
		if(cancel=='cancel') db_Oxs_get();
		window.location.hash=anchor;
	}

	$scope.Ox_edit_form_show=function(__info) {
		$scope.cur_ox=__info;
		$('#oxs_list').css('display','none');
		$('#ox_add_form').css('display','none');
		$('#ox_edit_form').slideToggle();
	}	
}]);