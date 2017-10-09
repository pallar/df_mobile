// DF_ajs: f_conf module
var f_conf = angular.module('f_conf',[]);

f_conf.controller('DbController',['$scope','$http',function($scope,$http) {
	db_Conf_get();

	function db_Conf_get() {
		$http.post('../db_cmds/conf_g.php').success(function(__data) {
			$scope.details = __data;
		});
	}

	$scope.show_form = true;
	
	$scope.db_Conf_update = function(__data) {
//		alert(__data[0].state); alert(__data[0].region); alert(__data[0].subregion);
//		alert(__data[0].enterprise); alert(__data[0].phone);
//		alert(__data[0].chief); alert(__data[0].chief_animal_technician);
//		alert(__data[0].farm);
//		alert(__data[1].pits); alert(__data[1].devs_by_pit); alert(__data[1].data_wires_by_pit);
//		alert(__data[1].ports_type); alert(__data[1].port_first);
//		alert(__data[1].waitstate_between_devs);
		$http.post('../db_cmds/conf_u.php',{
		 "state":__data[0].state,
		 "region":__data[0].region,
		 "subregion":__data[0].subregion,
		 "enterprise":__data[0].enterprise,
		 "farm":__data[0].farm,
		 "address":__data[0].address,
		 "phone":__data[0].phone,
		 "chief":__data[0].chief,
		 "chief_animal_technician":__data[0].chief_animal_technician,
		 "pits":__data[1].pits,
		 "devs_by_pit":__data[1].devs_by_pit,
		 "data_wires_by_pit":__data[1].data_wires_by_pit,
		 "ports_type":__data[1].ports_type,
		 "port_first":__data[1].port_first,
		 "waitstate_between_devs":__data[1].waitstate_between_devs
		}).success(function(__data) {
//    		alert(__data);
			$scope.show_form = true;
			if (__data == true) db_Conf_get();
		});
	}

	$scope.msg_Update = function() {
	}
}]);
