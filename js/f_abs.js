// DF_ajs: f_bs module
var f_bs=angular.module('f_bs',[]);

f_bs.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Bs_get();

	// To enable 'Add' button
	$scope.show_form=true;

	function db_Bs_get() {
		$http.post('../db_cmds/abs_g.php').success(function(__data) {
			$scope.details=__data;
		});
	}

	$scope.db_B_delete=function(__info) {
		$http.post('../db_cmds/ab_d.php',{
		 'id':__info.id
		}).success(function(__data) {
			db_Bs_get();
		});
	};

	$scope.db_B_insert=function(__info) {
		$http.post('../db_cmds/ab_i.php',{
		 'num':__info.num,
		 'nick':__info.nick,
		 'national_descr':__info.national_descr,
		 'comments':__info.comments
		}).success(function(__data) {
			if(__data==1) {
				$('#b_add_form').css('display','none');
				db_Bs_get();
			}
		});
	};

	$scope.cur_b={};

	$scope.db_B_update=function(__info) {
		$http.post('../db_cmds/ab_u.php',{
		 'id':__info.id,
		 'num':__info.num,
		 'nick':__info.nick,
		 'national_descr':__info.national_descr,
		 'comments':__info.comments
		}).success(function(__data) {
			db_Bs_get();
		});
	};

	$scope.B_add_form_show=function() {
		$scope.new_b={};
		$('#bs_list').css('display','none');
		$('#b_edit_form').css('display','none');
		$('#b_add_form').slideToggle();
	};

	$scope.B_edit_form_show=function(__info) {
		$scope.cur_b=__info;
		$('#bs_list').css('display','none');
		$('#b_add_form').css('display','none');
		$('#b_edit_form').slideToggle();
	};

	$scope.Bs_form_close=function(cancel,anchor) {
		$('#b_add_form').css('display','none');
		$('#b_edit_form').css('display','none');
		$('#bs_list').css('display','');
		if(cancel=='cancel') db_Bs_get();
		window.location.hash=anchor;
	};
}]);
