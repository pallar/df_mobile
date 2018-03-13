// TO_TRANSLATE
// DF_ajs: f_cws module
var f_cws=angular.module('f_cws',[]);

//var x=function($scope,$timeout,ngProgressFactory) {
//	$scope.progressbar=ngProgressFactory.createInstance();
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
			$scope.cur_cw.momid=__data[0].id;
			$scope.cur_cw.mom_data=__data[0].cow_num+". | "+__data[0].nick;
		});
	}

	$scope.mom_is_changed=function() {
		val=$scope.cur_cw.mom;
		datapos=val.indexOf("///");
		$scope.cur_cw.momid=val.substr(0,datapos);
		$scope.cur_cw.mom_data=val.substr(datapos+3);
	};
	
	$scope.cws_list_fill=function(event,el_class) {
		val=String(event.target.value); el=String("."+el_class);
		if(Number(val)==val) sqlWHERE="f_cows.cow_num*1>="+val+" ORDER BY f_cows.cow_num*1 LIMIT 100"; else sqlWHERE="f_cows.nick LIKE '%"+val+"%' ORDER BY f_cows.nick";
		$(el).empty(); if(val.length===0) return;
		sqlQuery="SELECT f_cows.id,f_cows.cow_num,f_cows.nick,f__grs.nick FROM f_cows,f__grs WHERE f_cows.gr_id=f__grs.id AND "+sqlWHERE;
		lst=jsql(sqlQuery);
		$(el).fadeOut(300);
		if(lst!==null) {
			$(el).append("<option>Choose New Mom</option>");
			for(i=0;i<lst.length;i++) $(el).append("<option value='"+lst[i][0]+"///"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"'>"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"&nbsp;|&nbsp;"+lst[i][3]+"</option>");
			$(el).slideToggle(300);
		}
		x=$(el).css("background-color");
		if(x=="rgb(255, 255, 255)") {
			$(el).css("background-color", "rgb(200, 255, 255)");
			$(event.target).css("background-color", "rgb(200, 255, 255)");
		} else {
			$(el).css("background-color", "rgb(255, 255, 255)");
			$(event.target).css("background-color", "rgb(255, 255, 255)");
		}
	};
	
	function db_Dad_get(__id) {
		$http.post('../db_cmds/ox_g.php',{
		 'id':__id
		}).success(function(__data) {
			$scope.cur_cw.dadid=__data[0].id;
			$scope.cur_cw.dad_data=__data[0].num+". | "+__data[0].nick;
		});
	}

	$scope.dad_is_changed=function() {
		val=$scope.cur_cw.dad;
		datapos=val.indexOf("///");
		$scope.cur_cw.dadid=val.substr(0,datapos);
		$scope.cur_cw.dad_data=val.substr(datapos+3);
	};

	$scope.oxs_list_fill=function(event,el_class) {
		val=String(event.target.value); el=String("."+el_class);
		if(Number(val)==val) sqlWHERE="f_oxes.num*1>="+val+" ORDER BY f_oxes.num*1 LIMIT 100"; else sqlWHERE="f_oxes.nick LIKE '%"+val+"%' ORDER BY f_oxes.nick";
		$(el).empty(); if(val.length===0) return;
		sqlQuery="SELECT f_oxes.id,f_oxes.num,f_oxes.nick,f__grs.nick FROM f_oxes,f__grs WHERE f_oxes.gr_id=f__grs.id AND "+sqlWHERE;
		lst=jsql(sqlQuery);
		$(el).fadeOut(300);
		if(lst!==null) {
			$(el).append("<option>Choose New Dad</option>");
			for(i=0;i<lst.length;i++) $(el).append("<option value='"+lst[i][0]+"///"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"'>"+lst[i][1]+".&nbsp;|&nbsp;"+lst[i][2]+"&nbsp;|&nbsp;"+lst[i][3]+"</option>");
			$(el).slideToggle(300);
		}
		x=$(el).css("background-color");
		if(x=="rgb(255, 255, 255)") {
			$(el).css("background-color", "rgb(200, 255, 255)");
			$(event.target).css("background-color", "rgb(200, 255, 255)");
		} else {
			$(el).css("background-color", "rgb(255, 255, 255)");
			$(event.target).css("background-color", "rgb(255, 255, 255)");
		}
	};

	$scope.db_Cw_delete=function(__info) {
		$http.post('../db_cmds/cw_d.php',{
		 'id':__info.id
		}).success(function(__data) {
			db_Cws_get();
		});
	};

	$scope.db_Cw_insert=function(__info) {
		$http.post('../db_cmds/cw_i.php',{
		 'cow_num':__info.cow_num,
		 'b_date':__info.b_date,
		 'b_num':__info.b_num,
		 'nick':__info.nick,
		 'n_descr':__info.n_descr
		}).success(function(__data) {
			if(__data==1) {
				$('#cw_add_form').css('display','none');
				db_Cws_get();
			}
		});
	};

	$scope.cur_cw={};

	$scope.db_Cw_update=function(__info,__alert) {
		$http.post('../db_cmds/cw_u.php',{
		 'id':__info.id,
		 'cow_num':__info.cow_num,
		 'b_date':__info.b_date,
		 'b_num':__info.b_num,
		 'nick':__info.nick,
		 'n_descr':__info.n_descr,
		 'tag_num':__info.tag_num,
		 'bid':__info.bid,
		 'lid':__info.lid,
		 'gid':__info.gid,
		 'sgid':__info.sgid,
		 'momid':__info.momid,
		 'dadid':__info.dadid,
		 'comments':__info.comments,
		 'defects':__info.defects
		}).success(function(__data) {
			db_Cws_get();
		});
		if(__alert) alert('Cow is update');
	};

	$scope.Cw_add_form_show=function() {
		$scope.new_cw={};
		$('#cws_list').css('display','none');
		$('#cw_edit_form').css('display','none');
		$('#cw_add_form').slideToggle();
	};

	$scope.Cw_edit_form_show=function(__info) {
		db_Breeds_get();
		db_Lots_get();
		db_Groups_get();
		db_Subgrs_get();
		$scope.cur_cw=__info;
		$http.post('../db_cmds/cw_g.php',{
		 'id':__info.id
		}).success(function(__data) {
			$scope.cur_cw.cow_num=__data[0].cow_num;
			$scope.cur_cw.b_date=__data[0].b_date;
			$scope.cur_cw.b_num=__data[0].b_num;
			$scope.cur_cw.nick=__data[0].nick;
			$scope.cur_cw.n_descr=__data[0].national_descr;
			$scope.cur_cw.tag_num=__data[0].rfid_num;
			$scope.cur_cw.bid=__data[0].breed_id;
			$scope.cur_cw.lid=__data[0].lot_id;
			$scope.cur_cw.gid=__data[0].gr_id;
			$scope.cur_cw.sgid=__data[0].subgr_id;
			db_Mom_get(__data[0].mth_id);
			db_Dad_get(__data[0].fth_id);
			$scope.cur_cw.comments=__data[0].comments;
			$scope.cur_cw.defects=__data[0].defects;
		});
		$('#cws_list').css('display','none');
		$('#cw_add_form').css('display','none');
		$('#cw_edit_form').slideToggle();
	};

	$scope.Cws_form_close=function(cancel,anchor) {
		$('#cw_add_form').css('display','none');
		$('#cw_edit_form').css('display','none');
		$('#cws_list').css('display','');
		if(cancel=='cancel') db_Cws_get();
		window.location.hash=anchor;
	};
}]);
