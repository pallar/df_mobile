// DF_ajs: f_ops module
var f_ops=angular.module('f_ops',[]);

//var x=function($scope,$timeout,ngProgressFactory) {
//	$scope.progressbar=ngProgressFactory.createInstance();
//}

f_ops.controller('DbController',['$scope','$http',function($scope,$http) {

//	$scope.progressbar=ngProgressFactory.createInstance();
//	$scope.progressbar.start();

	// To enable 'Add' button
	$scope.show_form=true;

}]);
