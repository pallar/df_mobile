//DF_2: dflib/f_per.js
//set period
//c: 01.02.2006
//m: 01.04.2015

//Correct d1
function Per_d1() {
	var _d1=El_( "per_d1" ); var _m1=El_( "per_m1" ); var _y1=El_( "per_y1" );
	var _d2=El_( "per_d2" ); var _m2=El_( "per_m2" ); var _y2=El_( "per_y2" );
	if (( Number( _m2.value )==Number( _m1.value )) && ( Number( _y2.value )==Number( _y1.value )))
	if ( Number( _d1.value )>Number( _d2.value )) _d2.value=_d1.value;
}

//Correct d2
function Per_d2() {
	var _d1=El_( "per_d1" ); var _m1=El_( "per_m1" ); var _y1=El_( "per_y1" );
	var _d2=El_( "per_d2" ); var _m2=El_( "per_m2" ); var _y2=El_( "per_y2" );
	if (( Number( _m2.value )==Number( _m1.value )) && ( Number( _y2.value )==Number( _y1.value )))
	if ( Number( _d1.value )>Number( _d2.value )) _d1.value=_d2.value;
}

//Correct m1
function Per_m1() {
	var _m1=El_( "per_m1" ); var _y1=El_( "per_y1" );
	var _m2=El_( "per_m2" ); var _y2=El_( "per_y2" );
	if (( Number( _m2.value )<Number( _m1.value )) && ( Number( _y2.value )==Number( _y1.value ))) {
		_m2.value=_m1.value; Per_d2list();
	}
	Per_d2();
}

//Correct m2
function Per_m2() {
	var _m1=El_( "per_m1" ); var _y1=El_( "per_y1" );
	var _m2=El_( "per_m2" ); var _y2=El_( "per_y2" );
	if (( Number( _m2.value )<Number( _m1.value )) && ( Number( _y2.value )==Number( _y1.value ))) {
		_m1.value=_m2.value; Per_d1list();
	}
	Per_d1();
}

//Correct y1
function Per_y1() {
	var _y1=El_( "per_y1" );
	var _y2=El_( "per_y2" );
	if ( _y1.value>_y2.value ) {
		_y2.value=_y1.value; Per_y2(); Per_d2list();
	}
	Per_m1();
}

//Correct y2
function Per_y2() {
	var _y1=El_( "per_y1" );
	var _y2=El_( "per_y2" );
	if ( _y2.value<_y1.value ) {
		_y1.value=_y2.value; Per_y1(); Per_d1list();
	}
	Per_m2();
}

//Get user's period from cookies
function Per_FromCoo() {
	Date_FromCoo( "per_d1", "per_m1", "per_y1", "_dt1" );
	Per_d1list();
	Date_FromCoo( "per_d2", "per_m2", "per_y2", "_dt2" );
	Per_d2list();
//TO SET CORRECT DAY DO THIS AGAIN
	Date_FromCoo( "per_d1", "per_m1", "per_y1", "_dt1" );
	Date_FromCoo( "per_d2", "per_m2", "per_y2", "_dt2" );
}

//Put user's period to cookies
function Per_ToCoo() {
	Date_ToCoo( "per_d1", "per_m1", "per_y1", "_dt1" );
	Date_ToCoo( "per_d2", "per_m2", "per_y2", "_dt2" );
}

//Correct d1 list
function Per_d1list() {
	Date_DaysList( "per_d1", "per_m1", "per_y1" );
}

//Correct d2 list
function Per_d2list() {
	Date_DaysList( "per_d2", "per_m2", "per_y2" );
}
