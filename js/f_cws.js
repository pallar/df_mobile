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
		$http.post('../db_cmds/abs_g.php').success(function(__data) {
			$scope.breeds_details=__data;
		});
	}

	function db_Lots_get() {
		$http.post('../db_cmds/als_g.php').success(function(__data) {
			$scope.lots_details=__data;
		});
	}

	function db_Groups_get() {
		$http.post('../db_cmds/ags_g.php').success(function(__data) {
			$scope.grs_details=__data;
		});
	}

	function db_Subgrs_get() {
		$http.post('../db_cmds/asgs_g.php').success(function(__data) {
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
			$scope.cur_cw.mom_data=__data[0].cow_num+". | "+__data[0].nick;
		});
	}

	$scope.mom_is_changed=function() {
//		alert('MOM IS CHANGED!');
		$scope.cur_cw.mom_data=$scope.cur_cw.mom;
	}
	
	$scope.cws_list_fill=function($event,el_class) {
		var val=String($event.target.value); var dval=Number(val); var el=String("."+el_class);
		var sqlWHERE="";
		if(dval/1==dval) sqlWHERE="f_cows.cow_num>="+val+" ORDER BY f_cows.cow_num*1 LIMIT 100"; else sqlWHERE="f_cows.nick LIKE '%"+val+"%' ORDER BY f_cows.nick";
		if(val.length===0) { $(el).empty(); return; }
		var sqlQuery="SELECT f_cows.id,f_cows.cow_num,f_cows.nick,f__grs.nick FROM f_cows,f__grs WHERE f_cows.gr_id=f__grs.id AND "+sqlWHERE;
		var lst=jsql(sqlQuery);
		$(el).empty(); $(el).fadeOut(300);
		if(lst!==null) {
			$(el).append("<option></option>");
			for(i=0;i<lst.length;i++) $(el).append("<option value='"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"'>"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"&nbsp;|&nbsp;"+lst[i][3]+"</option>");
			$(el).slideToggle(300);
		}
	}
	
	function db_Dad_get(__id) {
		$http.post('../db_cmds/ox_g.php',{
		 'id':__id
		}).success(function(__data) {
			$scope.cur_cw.dad_data=__data[0].num+". | "+__data[0].nick;
		});
	}

	$scope.dad_is_changed=function() {
//		alert('DAD IS CHANGED!');
		$scope.cur_cw.dad_data=$scope.cur_cw_dad;
	}

	$scope.oxs_list_fill=function($event,el_class) {
		var val=String($event.target.value); var dval=Number(val); var el=String("."+el_class);
		var sqlWHERE="";
		if(dval/1==dval) sqlWHERE="f_oxes.num>="+val+" ORDER BY f_oxes.num*1 LIMIT 100"; else sqlWHERE="f_oxes.nick LIKE '%"+val+"%' ORDER BY f_oxes.nick";
		if(val.length===0) { $(el).empty(); return; }
		var sqlQuery="SELECT f_oxes.id,f_oxes.num,f_oxes.nick,f__grs.nick FROM f_oxes,f__grs WHERE f_oxes.gr_id=f__grs.id AND "+sqlWHERE;
		var lst=jsql(sqlQuery);
		$(el).empty(); $(el).fadeOut(300);
		if(lst!==null) {
			$(el).append("<option></option>");
			for(i=0;i<lst.length;i++) $(el).append("<option value='"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"'>"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"&nbsp;|&nbsp;"+lst[i][3]+"</option>");
			$(el).slideToggle(300);
		}
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
		 'nick':__info.nick,
		 'b_date':__info.b_date,
		 'b_num':__info.b_num
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
		 'b_date':__info.cur_cw_b_date,
		 'b_num':__info.cur_cw_b_num,
		 'national_descr':__info.cur_cw_n_descr,
		 'cow_num':__info.cur_cw_cow_num,
		 'nick':__info.cur_cw_nick,
		 'rfid_num':__info.cur_cw_rfid_num
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
			$scope.cur_cw.national_descr=__data[0].national_descr;
			$scope.cur_cw.rfid_num=__data[0].rfid_num;
			$scope.cur_cw.b_det=__data[0].breed_id;
			$scope.cur_cw.l_det=__data[0].lot_id;
			$scope.cur_cw.g_det=__data[0].gr_id;
			$scope.cur_cw.sg_det=__data[0].subgr_id;
			db_Mom_get(__data[0].mth_id);
			db_Dad_get(__data[0].fth_id);
			$scope.cur_cw.comments=__data[0].comments;
			$scope.cur_cw.defects=__data[0].defects;
		});
		$('#cws_list').css('display','none');
		$('#cw_add_form').css('display','none');
		$('#cw_edit_form').slideToggle();
	}
}]);