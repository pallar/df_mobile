//DF_2: forms/f__first.js
//c: 17.07.2006
//m: 03.03.2017

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
