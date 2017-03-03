//DF_2: forms/f__first.js
//c: 17.07.2006
//m: 14.11.2015

function Trim( s ) {
	if ( s.indexOf( " " )==-1 ) return s;
	var i=0;
	while ( i<s.length ) {
		if ( !(s.charAt( i )==" " )) break;
		i++;
	}
	var s1=s.substring( i, s.length );
	var i=s1.length-1;
	while ( i>0 ) {
		if ( !(s1.charAt( i )==" " )) break;
		i--;
	}
	var s2=s1.substring( 0, i+1 );
	return s2;
}

function CookieGet( cname ) {
	var c=window.document.cookie.split( ";" ); var clen=c.length;
	var i=0;
	var res="";
	while ( i<clen ) {
		var s=c[i].split( "=" );
		if ( Trim( s[0] )==cname ) var res=s[1];
		i++;
	}
	return res;
}

function CookieSet( cname, cvalue ) {
	window.document.cookie=cname+"="+cvalue+";path=/";
}

function User_Get() {
	return CookieGet( "userCoo" );
}

function UserNick_Get() {
	return decodeURI( CookieGet( "unickCoo" ));
}

function Url_Parl() {
	window.location="forms/f__parl.php";
}

function Url_Reps() {
	window.location="forms/f__reps.php";
}

function Url_Cards() {
	window.location="forms/f__cards.php";
}

function Url_Opers() {
	window.location="forms/f__ops.php";
}

//Application.OnStart
function App_OnStart() {
	var c=window.document.cookie.split( ";" );
	var i=0; var clen=c.length; var par=0;
	while ( i<clen ) {
		var s=c[i].split( "=" );
//		var j="  ";
//		alert( "-"+j+"-" );
//		var jj=Trim( j );
//		alert( "-"+jj+"-" );
		if ( Trim( s[0] )=="userCoo" ) var par=1;
		i++;
	}
	if ( par!=1 ) {
		window.document.cookie='userCoo=9;path=/';
		window.document.cookie='unickCoo=anonymous;path=/';
	}
}

//Application.Login+RTC
function App_Login() {
	el=document.getElementById( "rtc_div" );
	now=new Date();
	hh=now.getHours(); mm=now.getMinutes(); ss=now.getSeconds();
	timeStr=(( hh<10)?"0":"" )+hh;
	timeStr+=(( mm<10)?":0":":" )+mm;
	timeStr+=(( ss<10)?":0":":" )+ss;
	date=now.getDate();
	month=now.getMonth()+1;
	if ( navigator.appName!="Netscape" & navigator.appName!="Opera" )
		year=now.getYear();
	else
		year=now.getYear()+1900;
	dateStr=(( date<10 )?"0":"" )+date; dateStr+=(( month<10 )?"/0":"/" )+month; dateStr+="/"+year;
	if ( Trim( String( el ))!="null" ) {
		el.innerHTML=dateStr+"&nbsp;&nbsp;"+timeStr;
	}
	userStr=UserNick_Get();
	el=document.getElementById( "uname_div" );
	if ( Trim( String( el ))!="null" ) {
		el.innerHTML=userStr;
		Timer=setTimeout( "App_Login()", 1000 );
	}
}

//Application.HotKeys
function App_HotKeys() {
}

//Context Menu

function context_menu( params, event ) {
	el=document.getElementById( 'cm' );
	o=event.srcElement;
	x=event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
	y=event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	el.innerHTML='';
	for ( k in params ) {
		if ( params[k]=='space' ) {//menu: horiz line
			el.innerHTML+='<hr size=1>';
		} else if ( params[k]['disabled'] ) {//menu: disabled submenu
			el.innerHTML+='<a class="cm_gray" href="" onclick="return false;" title="'+params[k]['title']+'" onmouseover="window.status=this.title;return true;" onmouseout="window.status=&quot;&quot;; return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]['value']+'</a><br>';
		} else if ( params[k]['frame']=='off' ) {//menu: no frame
			if ( window.frameElement=='[object HTMLFrameElement]' ) {
				el.innerHTML+='<a class="cm_black" href="" onclick="window.open('+params[k]['href']+",'','statusbar,menubar,location'); return false;"+'" title="'+params[k]['title']+'" onmouseover="window.status=this.title; return true;" onmouseout="window.status=&quot;&quot;; return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]['value']+'</a><br>';
			} else {
				el.innerHTML+='<a class="cm_black" href="" onclick="window.open('+params[k]['href']+",'','statusbar,menubar,location'); return false;"+'" title="'+params[k]['title']+'" onmouseover="window.status=this.title; return true;" onmouseout="window.status=&quot;&quot;; return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]['value']+'</a><br>';
			}
		} else if ( params[k]['frame']=='on' ) {//menu: frame
			el.innerHTML+='<a class="cm_black" href="" onclick="'+'parent'+params[k]['taget']+".location.href='"+params[k]['href']+"' return false;"+' title="'+params[k]['title']+'" onmouseover="window.status=this.title; return true;" onmouseout="window.status=&quot;&quot;; return true;">&nbsp;&nbsp;&nbsp;&nbsp;'+params[k]['value']+'</a><br>';
		}
	}
	el.style.visibility='visible';
	el.style.display='block';
	height=el.scrollHeight-20;
	if ( window.opera ) height+=30;//opera browser
		if ( event.clientY+height>document.body.clientHeight ) y-=height+14;
		else y-=2;
		el.style.left=x+'px';
		el.style.top=y+'px';
		el.style.visibility='hidden';
		el.style.display='none';
		el.style.visibility='visible';
		el.style.display='block';
		event.returnValue=false;
	}

function cm( event ) {
	var params=new Array();
	params[1]='space';
	params[2]=new Array();
	params[2]['disabled']=false;
	params[2]['href']='../forms/f__parl.php';
	params[2]['title']='Detailed Report';
	params[2]['value']='Detailed Report';
	params[2]['taget']='';
	params[2]['frame']='on';
	params[3]='space';
	params[4]=new Array();
	params[4]['disabled']=false;
	params[4]['href']='../forms/f__reps.php';
	params[4]['title']='Reports';
	params[4]['value']='Reports';
	params[4]['taget']='';
	params[4]['frame']='on';
	params[5]='space';
	params[6]=new Array();
	params[6]['disabled']=false;
	params[6]['href']='../forms/f__cards.php';
	params[6]['title']='Cards';
	params[6]['value']='Cards';
	params[6]['taget']='';
	params[6]['frame']='on';
	params[7]='space';
	params[8]=new Array();
	params[8]['disabled']=false;
	params[8]['href']='../forms/f__ops.php';
	params[8]['title']='Opers';
	params[8]['value']='Opers';
	params[8]['taget']='';
	params[8]['frame']='on';
	params[9]='space';
	params[10]=new Array();
	params[10]['disabled']=false;
	params[10]['href']='';
	params[10]['title']='Print Version';
	params[10]['value']='Print Version';
	params[10]['taget']='';
	params[10]['frame']='off';
	context_menu( params, event );
}

function hide_cm() {
	el=document.getElementById( 'cm' );
	el.style.visibility='hidden';
	el.style.display='none';
}

function cn( el, event ) {
	if ( event.button==2 || event.button==3 ) {
		cm( event );
		return false;
	}
}
