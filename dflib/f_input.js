function mastitus_keyp( i ) {
	var min=0, max=4444, len=4;
	var el=document.getElementById( String( i ));
	if ( null!=typeof( el )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event )?window.event.keyCode:e.which;
			keyCode=keyCode*1;
			if ( keyCode==0 ) return true;//cursor moving
			if ( keyCode==8 );//BkSpace
			else if ( keyCode>=48 & keyCode<=52 ) {
	    			if ( el.value.length==len ) return false;
				var new_i=Number( el.value+String( keyCode-48 ));
				if ( new_i<min ) {
					alert( new_i+' < '+min+' !' ); return false;
				}
				if ( new_i>max ) {
					alert( new_i+' > '+max+' !' ); return false;
				}
			} else return false;
			el.style.background='#ffff00';
		}
	}
}

function time_keyp( i, j_ ) {
	var el=document.getElementById( String( i ));
	if ( null!=typeof( el )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event )?window.event.keyCode:e.which;
			keyCode=keyCode*1;
			if ( keyCode==0 ) return true;//cursor moving
			if ( keyCode==8 );//BkSpace
			else if ( keyCode==58 ) {//'.'
				if ( el.value.substr( el.value.length-1, 1 )==':' ) return false;
				if ( parseInt( el.value )!=el.value*1 ) return false;
			} else if ( keyCode>=48 & keyCode<=57 ) {//'0'..'9'
				var vallen=Number( el.value.length );
				if ( j_=="His" ) {
					vallenm=8; dg0=2; v1=23;
				} else if ( j_=="Hi" ) {
					vallenm=5; dg0=2; v1=23;
				} else if ( j_=="is" ) {
					vallenm=5; dg0=5; v1=59;
				}
				if ( vallen>=vallenm ) return false;
				if ( vallen==0 ) {
					if ( keyCode-48<=dg0 );
					else return false;
				} else if ( vallen==1 ) {
					if ( Number( el.value*10 )+keyCode-48<=v1 );
					else return false;
				} else if ( vallen==2 | ( vallen==5 & j_=="His" )) {
					if ( keyCode-48<=5 ) {
						if ( el.value.substr( el.value.length-1, 1 )!=':' ) el.value+=':';
					} else return false;
				} else if ( vallen==3 | vallen==6 ) {
					if ( keyCode-48<=5 );
					else return false;
				}
			} else return false;
			el.style.background='#ffff00';
		}
	}
}

function real_decs( i ) {
	var found=0, decs='';
	for ( j=0; j<=i.length; j++ ) {
		var ch=i.substr( j, 1 );
		if ( ch=='.' || ch==',' ) found=1;
		if ( found==1 ) found=2;
		else if ( found>1 ) decs=String( decs )+ch;
	}
	return decs.length;
}

function real_chg( i, min, max, len, decs ) {
	var el=document.getElementById( String( i ));
	var new_i=Number( el.value );
	if ( el.value.length==0 ) el.style.backgroundColor="yellow";
	else el.style.backgroundColor="white";
	if ( null!=typeof( el )) {
		if ( isNaN( el.value )) el.value=el.value.substr( 0, el.value.length-1 );
		if ( new_i<Number( min )) {
			alert( new_i+' < '+min+' !' );
			el.value=el.value.substr( 0, el.value.length-1 );
		}
		if ( new_i>Number( max )) {
			alert( new_i+' > '+max+' !' );
			el.value=el.value.substr( 0, el.value.length-1 );
		}
		if ( real_decs( el.value )>Number( decs )) el.value=el.value.substr( 0, el.value.length-1 );
	}
}

function mreal_keyp( i, min, max, len, decs ) {
	var len=Number( len ), decs=Number( decs );
	var trunclen=len-decs-1;
	var el=document.getElementById( String( i ));
	if ( null!=typeof( el )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event )?window.event.keyCode:e.which;
			keyCode=keyCode*1;
			if ( keyCode==0 ) return true;//cursor moving
			if ( keyCode==8 );//BkSpace
			else if ( keyCode==45 ) {//'-' sign
				if ( el.value.length==0 ); else return false;
			} else if ( keyCode==44 || keyCode==46 ) {//replace ',' with '.'
				if ( el.value.substr( el.value.length-1, 1 )=='.' ) return false;
				if ( parseInt( el.value )!=el.value*1 ) return false;
				el.value=el.value+'.';
			} else if ( keyCode>=48 & keyCode<=57 ) {//'0'..'9'
				if ( el.value.length==len ) return false;
				if ( keyCode==48 & el.value.length==0 ) {//'0'
					el.value='0.'; return false;
				} else {
					if ( real_decs( el.value )==decs ) return false;
					if ( el.value.length==trunclen )
						var new_i=Number( el.value+'.'+String( keyCode-48 ));
					else
						var new_i=Number( el.value+String( keyCode-48 ));
					if ( new_i<Number( min )) {
						alert( new_i+' < '+min+' !' ); return false;
					}
					if ( new_i>Number( max )) {//experimental
						el.value=el.value+'.'+String( keyCode-48 ); return false;
					}
					if ( el.value.length==trunclen & Number( el.value )>1 ) {
						if ( el.value.substr( el.value.length-1, 1 )!='.' ) el.value+='.';
					}
				}
			} else return false;
			el.style.background='#ffff00';
		}
	}
}

function real_keyp( i, min, max, len, decs ) {
	var len=Number( len ), decs=Number( decs );
	var trunclen=len-decs-1;
	var el=document.getElementById( String( i ));
	if ( null!=typeof( el )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event )?window.event.keyCode:e.which;
			keyCode=keyCode*1;
			if ( keyCode==0 ) return true;//cursor moving
			if ( keyCode==8 );//BkSpace
			else if ( keyCode==44 || keyCode==46 ) {//replace ',' with '.'
				if ( el.value.substr( el.value.length-1, 1 )=='.' ) return false;
				if ( parseInt( el.value )!=el.value*1 ) return false;
				el.value=el.value+'.';
			} else if ( keyCode>=48 & keyCode<=57 ) {//'0'..'9'
				if ( el.value.length==len ) return false;
				if ( keyCode==48 & el.value.length==0 ) {//'0'
					el.value='0.'; return false;
				} else {
					if ( real_decs( el.value )==decs ) return false;
					if ( el.value.length==trunclen )
						var new_i=Number( el.value+'.'+String( keyCode-48 ));
					else
						var new_i=Number( el.value+String( keyCode-48 ));
					if ( new_i<Number( min )) {
						alert( new_i+' < '+min+' !' ); return false;
					}
					if ( new_i>Number( max )) {//experimental
						el.value=el.value+'.'+String( keyCode-48 ); return false;
					}
					if ( el.value.length==trunclen & Number( el.value )>1 ) {
						if ( el.value.substr( el.value.length-1, 1 )!='.' ) el.value+='.';
					}
				}
			} else return false;
			el.style.background='#ffff00';
		}
	}
}

function int_keyp( i, min, max, len ) {
	var el=document.getElementById( String( i ));
	if ( null!=typeof( el )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event )?window.event.keyCode:e.which;
			keyCode=keyCode*1;
			if ( keyCode==0 ) return true;//cursor moving
			if ( keyCode==8 );//BkSpace
			else if ( keyCode>=48 & keyCode<=57 ) {//'0'..'9'
				if ( el.value.length==Number( len )) return false;
				var el_val=el.value, cur_i=Number( el_val );
				if ( cur_i==0 & el.value.length!=0 ) return false;
				var new_i=Number( el_val+String( keyCode-48 ));
				if ( new_i==cur_i & el.value.length!=0 ) return false;
				if ( new_i<Number( min )) {
					alert( new_i+' < '+min+' !' ); return false;
				}
				if ( new_i>Number( max )) {
					alert( new_i+' > '+max+' !' ); return false;
				}
			} else return false;
			el.style.background='#ffff00';
		}
	}
}
