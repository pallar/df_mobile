//DF_2: dflib/f_first.js
//c: 17.07.2006
//m: 12.04.2017

function $$( id ) {
	return document.getElementById( id );
}

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
	eid=$$( "rtc_div" );
	if ( Trim( String( eid ))!="null" ) {
		now=new Date();
		hh=now.getHours(); mm=now.getMinutes(); ss=now.getSeconds();
		timeStr=(( hh<10)?"0":"" )+hh; timeStr+=(( mm<10)?":0":":" )+mm; timeStr+=(( ss<10)?":0":":" )+ss;
		d=now.getDate(); m=now.getMonth()+1;
		if ( navigator.appName!="Netscape" & navigator.appName!="Opera" )
			Y=now.getYear();
		else
			Y=now.getYear()+1900;
		dateStr=(( d<10 )?"0":"" )+d; dateStr+=(( m<10 )?"/0":"/" )+m; dateStr+="/"+Y;
		eid.innerHTML=dateStr+"&nbsp;&nbsp;"+timeStr;
	}
	eid=$$( "uname_div" );
	if ( Trim( String( eid ))!="null" ) {
		userStr=UserNick_Get();
		eid.innerHTML=userStr;
		Timer=setTimeout( "App_Login()", 1000 );
	}
}
