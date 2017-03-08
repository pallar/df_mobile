// DF_ajs: f_ops module
var f_ops=angular.module('f_ops',['ngProgress']);

//var x=function($scope,$timeout,ngProgressFactory) {
//	$scope.progressbar=ngProgressFactory.createInstance();
//	alert('1111');
//}

f_ops.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Cws_get();

	
//	$scope.progressbar=ngProgressFactory.createInstance();
//	$scope.progressbar.start();

	// To enable 'Add' button
	$scope.show_form=true;

	function db_Cws_get() {
		$http.post('../db_cmds/cws_g.php').success(function(__data) {
			$scope.details=__data;
		});
	}

	$scope.cur_cw={};

}]);