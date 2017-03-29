//DF_2: dflib/f_date.js
//common dates functions
//c: 18.09.2007
//m: 15.03.2017

//Fill mydate.days_in_month list
function Date_DaysList( d_, m_, y_ ) {
	var _d=$$( d_ ); var _m=$$( m_ ); var _y=$$( y_ );
	var day_old=_d.value; _d_len=_d.length;
	for ( var i=0; i<_d_len; i++ ) _d.options[0]=null;
	var daysInMonth=32-new Date( _y.value, _m.value-1, 32 ).getDate();
	for ( var i=0; i<daysInMonth; i++ )
		_d.innerHTML+="<option value='"+( i+1 )+"'>"+( i+1 )+"</option>";
	if ( daysInMonth<day_old ) _d.value=daysInMonth; else _d.value=day_old;
}

//Fill mydate.days_in_month list as for today
function Date_NowDaysList( d_ ) {
	var _d=$$( d_ );
	var date_=new Date();
	var daysInMonth=32-new Date( date_.getFullYear(), date_.getMonth(), 32 ).getDate();
	for ( var i=0; i<daysInMonth; i++ ) {
		_d.innerHTML+="<option value='"+( i+1 )+"'>"+( i+1 )+"</option>";
	}
}

//Get mydate from cookies
function Date_FromCoo( d_, m_, y_, dt__ ) {
	var _d=$$( d_ ); var _m=$$( m_ ); var _y=$$( y_ );
	var date_=new Date();
	var date_d=date_.getDate(); var date_m=date_.getMonth()+1; var date_y=date_.getFullYear();
	var c=window.document.cookie.split( ";" ); var clen=c.length;
	var ex=0; var i=0;
	while ( i<clen ) {
		var s=c[i].split( "=" );
		if ( Trim( s[0] )==dt__ ) {
			_y.value=Number( s[1].substring( 0, 4 ));
			_m.value=Number( s[1].substring( 5, 7 ));
			_d.value=Number( s[1].substring( 8, 10 ));
			var ex=1;
		}
		i++;
	}
	if ( ex!=1 ) {
		_y.value=date_y; _m.value=date_m; _d.value=date_d;
	}
	return ex;
}

//Put mydate to cookies
function Date_ToCoo( d_, m_, y_, dt__ ) {
	var _d=$$( d_ ).value; var _m=$$( m_ ).value; var _y=$$( y_ ).value;
	if ( _d <=9 ) _d='0'+_d;
	if ( _m <=9 ) _m='0'+_m;
	window.document.cookie=dt__+"="+_y+"-"+_m+"-"+_d+";path=/";
}
