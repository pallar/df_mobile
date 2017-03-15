//DF_2: reports/fmcontxt.php
//c: 20.03.2006
//m: 13.03.2017

function context_menu(params,event) {
	el=document.getElementById("cm");
	o=event.srcElement;
	x=event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
	y=event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	el.innerHTML='';
	for (k in params) {
	//if params[k]=='space' then draw line (separator)
		if (params[k]=='space') { el.innerHTML+='<hr size=1>';
	//if menu item is disabled
		} else if (params[k]["disabled"]) { el.innerHTML+='<a class="cm_gray" href="" onclick="return false;" title="'+params[k]["title"]+'" onmouseover="window.status=this.title;return true;" onmouseout="window.status=&quot;&quot; ;return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]["value"]+"</a><br>";
	//if current window is not opened in frame
		} else if (params[k]["frame"]=="off") { if (window.frameElement=="[object HTMLFrameElement]") { el.innerHTML+='<a class="cm_black" href=""'+"onclick="+'window.open('+"'"+params[k]["href"]+"','','statusbar,menubar,location'); return false;"+'" title="'+params[k]["title"]+'" onmouseover="window.status=this.title;return true;" onmouseout="window.status=&quot;&quot; ;return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]["value"]+"</a><br>";} else { el.innerHTML+='<a class="cm_black" href=""'+"onclick="+'window.open('+"'"+params[k]["href"]+"','','statusbar,menubar,location');return false;"+'" title="'+params[k]["title"]+'" onmouseover="window.status=this.title;return true;" onmouseout="window.status=&quot;&quot; ;return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]["value"]+"</a><br>";}
	//if current window must be opened in frame
		} else if (params[k]["frame"]=="on") { el.innerHTML+='<a class="cm_black" href=""'+'onclick='+"parent"+params[k]["taget"]+".location.href='"+params[k]["href"]+"' return false;"+' title="'+params[k]["title"]+'" onmouseover="window.status=this.title;return true;" onmouseout="window.status=&quot;&quot; ;return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]["value"]+"</a><br>";}
	}
	el.style.visibility="visible";
	el.style.display="block";
	height=el.scrollHeight-20;
	if (window.opera) height+=30;//stupid opera...
	if (event.clientY+height>document.body.clientHeight) { y-=height+14 } else { y-=2 }
	el.style.left=x+"px";
	el.style.top=y+"px";
	el.style.visibility="hidden";
	el.style.display="none";
	el.style.visibility="visible";
	el.style.display="block";
	event.returnValue=false;
}

function cm(event) {
	var params=new Array();
	params[1]='space';
	params[2]=new Array();
	params[2]["disabled"]=false;
	params[2]["href"]="../forms/f__parl.php";
	params[2]["title"]="По залу";
	params[2]["value"]="По залу";
	params[2]["taget"]="";
	params[2]["frame"]="on";
	params[3]='space';
	params[4]=new Array();
	params[4]["disabled"]=false;
	params[4]["href"]="../forms/f__reps.php";
	params[4]["title"]="По стаду";
	params[4]["value"]="По стаду";
	params[4]["taget"]="";
	params[4]["frame"]="on";
	params[5]='space';
	params[6]=new Array();
	params[6]["disabled"]=false;
	params[6]["href"]="../forms/f__cards.php";
	params[6]["title"]="Картки";
	params[6]["value"]="Картки";
	params[6]["taget"]="";
	params[6]["frame"]="on";
	params[7]='space';
	params[8]=new Array();
	params[8]["disabled"]=false;
	params[8]["href"]="../forms/f__ops.php";
	params[8]["title"]="Операцiї";
	params[8]["value"]="Операцiї";
	params[8]["taget"]="";
	params[8]["frame"]="on";
	params[9]='space';
	params[10]=new Array();
	params[10]["disabled"]=false;
	params[10]["href"]="";
	params[10]["title"]="Version to print";
	params[10]["value"]="Version to print";
	params[10]["taget"]="";
	params[10]["frame"]="on";
	params[11]='space';
	context_menu(params,event);
}
 
function hide_cm() {
	el=document.getElementById("cm");
	el.style.visibility="hidden";
	el.style.display="none";
}

function cn(el,event) {
	if (event.button==3 || event.button==2) {
		cm(event);
		return false;
	}
}
