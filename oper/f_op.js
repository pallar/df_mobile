function oper_frm__hide(){
	$(".oper_frm,.shadow").fadeOut(300);
}

function oper_list__fill(){
	var lst=jsql("SELECT id,descr FROM f_ops WHERE int_res<>0 ORDER BY int_res ASC");
	if(lst!=null) for(i=0;i<lst.length;i++) $(".oper_list").append("<div class='oper_li' id='"+lst[i][0]+"'>"+lst[i][1]+"</div>");
}

function oper_list__show(){
	$(".oper_list").slideToggle(300);
}

function f_o__php__show(op_id,op_name){
	$(".oper_frm,.shadow").fadeIn(300);
	$(".oper_frm .left").html(op_name);
	var cow_id=$("#cow_id").val();
	$(".oper_frm .border").load("../forms/f__ops.php?opertype="+op_id+"&cow_id="+cow_id,function(){$("#add_oper").attr("alt",op_id).css({"bottom":"-16","position":"absolute","right":"0"});});
}

function mysql_oper__insert(op_id){
	$("#add_oper").die();
	var cow_id=$("#cow_id").val();
	var i=op_id*1,j=1; while(i>1){i=i/2;j++;}; var op_url_id=100+j;
	var i=new Date(),dY=i.getFullYear(),dm=i.getMonth()+1,dd=i.getDate(),dH=i.getHours(),di=i.getMinutes(),ds=i.getSeconds();
	if(dm<10)dm="0"+dm; if(dd<10)dd="0"+dd; if(dH<10)dH="0"+dH; if(di<10)di="0"+di; if(ds<10)ds="0"+ds;
	var jdata="add_oper=1&opertype="+op_id+"&cow_id="+cow_id+"&modif_Ymd="+dY+"-"+dm+"-"+dd+"&modif_His="+dH+":"+di+":"+ds;
	var fe=$("input[type=text],select,input[type=checkbox]");
	$("#oper_table ").find(fe).each(function(){
		if($(this).attr("name")){
			if($(this).attr("type")=="checkbox"){
				if($(this).attr("checked")){var vl="on";}else{var vl="off";}
				jdata+="&"+$(this).attr("name")+"="+vl;
			}else{
				jdata+="&"+$(this).attr("name")+"="+$(this).val();
			}
		}
	});
	$.post("../oper/f_o__"+op_url_id+".php",jdata,function(data){window.location.reload();});
}

$(function(){
	oper_list__fill();
	$(".oper_cont"||".oper_list").click(oper_list__show);
	$(".oper_li").click(function(){f_o__php__show($(this).attr("id"),$("#oper_button").val()+" '"+$(this).text()+"'")});
	$(".oper_frm .right").click(function(){oper_frm__hide()});
	$("#add_oper").live("click",function(){mysql_oper__insert($(this).attr("alt"));});
});
