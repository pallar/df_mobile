// DF_ajs: f_sgs module
var f_sgs = angular.module('f_sgs',[]);

f_sgs.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Sgs_get();

	// To enable 'Add' button
	$scope.show_form=true;

	function db_Sgs_get() {
		$http.post('../db_cmds/asgs_g.php').success(function(__data) {
			$scope.details=__data;
		});
	}

	$scope.db_Sg_delete=function(__info) {
		$http.post('../db_cmds/asg_d.php',{
		 'id':__info.id
		}).success(function(__data) {
			db_Sgs_get();
		});
	}

	$scope.db_Sg_insert=function(__info) {
		$http.post('../db_cmds/asg_i.php',{
		 'num':__info.num,
		 'nick':__info.nick
		}).success(function(__data) {
			if(__data==1) {
				$('#sg_add_form').css('display','none');
				db_Sgs_get();
			}
		});
	}

	$scope.cur_sg={};

	$scope.db_Sg_update=function(__info) {
		$http.post('../db_cmds/asg_u.php',{
		 'id':__info.id,
		 'num':__info.num,
		 'nick':__info.nick
		}).success(function(__data) {
			$scope.show_form=true;
			if(__data==1) db_Sgs_get();
		});
	}

	$scope.Sg_add_form_show=function() {
		$scope.new_sg={};
		$('#sgs_list').css('display','none');
		$('#sg_edit_form').css('display','none');
		$('#sg_add_form').slideToggle();
	}

	$scope.Sg_form_close=function(cancel,anchor) {
		$('#sg_add_form').css('display','none');
		$('#sg_edit_form').css('display','none');
		$('#sgs_list').css('display','');
		if(cancel=='cancel') db_Sgs_get();
		window.location.hash=anchor;
	}

	$scope.Sg_edit_form_show=function(__info) {
		$scope.cur_sg=__info;
		$('#sgs_list').css('display','none');
		$('#sg_add_form').css('display','none');
		$('#sg_edit_form').slideToggle();
	}	
}]);