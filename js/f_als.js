// DF_ajs: f_ls module
var f_ls=angular.module('f_ls',[]);

f_ls.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Ls_get();

	// To enable 'Add' button
	$scope.show_form=true;

	function db_Ls_get() {
		$http.post('../db_cmds/als_g.php').success(function(__data) {
			$scope.details=__data;
		});
	}

	$scope.db_L_delete=function(__info) {
		$http.post('../db_cmds/al_d.php',{
		 'id':__info.id
		}).success(function(__data) {
			db_Ls_get();
		});
	};

	$scope.db_L_insert=function(__info) {
		$http.post('../db_cmds/al_i.php',{
		 'num':__info.num,
		 'nick':__info.nick,
		 'national_descr':__info.national_descr,
		 'comments':__info.comments
		}).success(function(__data) {
			if(__data==1) {
				$('#l_add_form').css('display','none');
				db_Ls_get();
			}
		});
	};

	$scope.cur_l={};

	$scope.db_L_update=function(__info) {
		$http.post('../db_cmds/al_u.php',{
		 'id':__info.id,
		 'num':__info.num,
		 'nick':__info.nick,
		 'national_descr':__info.national_descr,
		 'comments':__info.comments
		}).success(function(__data) {
			db_Ls_get();
		});
	};

	$scope.L_add_form_show=function() {
		$scope.new_l={};
		$('#ls_list').css('display','none');
		$('#l_edit_form').css('display','none');
		$('#l_add_form').slideToggle();
	};

	$scope.L_edit_form_show=function(__info) {
		$scope.cur_l=__info;
		$('#ls_list').css('display','none');
		$('#l_add_form').css('display','none');
		$('#l_edit_form').slideToggle();
	};

	$scope.Ls_form_close=function(cancel,anchor) {
		$('#l_add_form').css('display','none');
		$('#l_edit_form').css('display','none');
		$('#ls_list').css('display','');
		if(cancel=='cancel') db_Ls_get();
		window.location.hash=anchor;
	};
}]);
