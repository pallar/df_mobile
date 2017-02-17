// DF_ajs: f_cws module
var f_cws=angular.module('f_cws',['ngProgress']);

//var x=function($scope,$timeout,ngProgressFactory) {
//	$scope.progressbar=ngProgressFactory.createInstance();
//	alert('1111');
//}

f_cws.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Cws_get();

	
//	$scope.progressbar=ngProgressFactory.createInstance();
//	$scope.progressbar.start();

	// To enable 'Add' button
	$scope.show_form=true;

	function db_Breeds_get() {
		$http.post('../db_cmds/abrs_g.php').success(function(__data) {
			$scope.breeds_details=__data;
		});
	}

	function db_Lots_get() {
		$http.post('../db_cmds/alots_g.php').success(function(__data) {
			$scope.lots_details=__data;
		});
	}

	function db_Groups_get() {
		$http.post('../db_cmds/agrs_g.php').success(function(__data) {
			$scope.grs_details=__data;
		});
	}

	function db_Subgrs_get() {
		$http.post('../db_cmds/asgrs_g.php').success(function(__data) {
			$scope.subgrs_details=__data;
		});
	}

	function db_Cws_get() {
		$http.post('../db_cmds/cws_g.php').success(function(__data) {
			$scope.details=__data;
		});
	}

	function db_Mom_get(__id) {
		$http.post('../db_cmds/cw_g.php',{
		 'id':__id
		}).success(function(__data) {
			$scope.cur_cw_mom_data=__data[0].nick+" (#"+__data[0].cow_num+")";
		});
	}

	function db_Moms_get(__id) {
		$http.post('../db_cmds/cws_g.php',{
		 '__id':__id
		}).success(function(__data) {
			$scope.moms_details=__data;
		});
	}

	function db_Dad_get(__id) {
		$http.post('../db_cmds/ox_g.php',{
		 'id':__id
		}).success(function(__data) {
			$scope.cur_cw_dad_data=__data[0].nick+" (#"+__data[0].num+")";
		});
	}

	$scope.db_Cw_delete=function(__info) {
		$http.post('../db_cmds/cw_d.php',{
		 'id':__info.id
		}).success(function(__data) {
			db_Cws_get();
		});
	}

	$scope.db_Cw_insert=function(__info) {
		$http.post('../db_cmds/cw_i.php',{
		 'cow_num':__info.cow_num,
		 'b_date':__info.b_date,
		 'b_num':__info.b_num,
		 'nick':__info.nick
		}).success(function(__data) {
			if(__data==1) {
				$('#cw_add_form').css('display','none');
				db_Cws_get();
			}
		});
	}

	$scope.cur_cw={};

	$scope.db_Cw_update=function(__info) {
		$http.post('../db_cmds/cw_u.php',{
		 'id':__info.id,
		 'cow_num':__info.cow_num,
		 'b_date':__info.b_date,
		 'b_num':__info.b_num,
		 'nick':__info.nick
		}).success(function(__data) {
			$scope.show_form=true;
			if(__data==1) db_Cws_get();
		});
	}

	$scope.Cw_add_form_show=function() {
		$scope.new_cw={};
		$('#cws_list').css('display','none');
		$('#cw_edit_form').css('display','none');
		$('#cw_add_form').slideToggle();
	}

	$scope.Cw_form_close=function(cancel,anchor) {
		$('#cw_add_form').css('display','none');
		$('#cw_edit_form').css('display','none');
		$('#cws_list').css('display','');
		if(cancel=='cancel') db_Cws_get();
		window.location.hash=anchor;
	}

	$scope.Cw_edit_form_show=function(__info) {
		db_Breeds_get();
		db_Lots_get();
		db_Groups_get();
		db_Subgrs_get();
		$scope.cur_cw=__info;
		$http.post('../db_cmds/cw_g.php',{
		 'id':__info.id
		}).success(function(__data) {
			$scope.cur_cw_national_descr=__data[0].national_descr;
			$scope.cur_cw_rfid_num=__data[0].rfid_num;
			$scope.br_det=__data[0].breed_id;
			$scope.lot_det=__data[0].lot_id;
			$scope.gr_det=__data[0].gr_id;
			$scope.subgr_det=__data[0].subgr_id;
			db_Mom_get(__data[0].mth_id);
			db_Dad_get(__data[0].fth_id);
		});
		$('#cws_list').css('display','none');
		$('#cw_add_form').css('display','none');
		$('#cw_edit_form').slideToggle();
	}	
}]);