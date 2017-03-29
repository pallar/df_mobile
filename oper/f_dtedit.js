<script language='JavaScript'>
d=new Date();
dtedit_dd=d.getDate();
dtedit_mm=d.getMonth()+1;
dtedit_yyyy=d.getFullYear();
if ( dtedit_dd<10 ) dtedit_dd='0'+dtedit_dd;
if ( dtedit_mm<10 ) dtedit_mm='0'+dtedit_mm;

function date_keyp( i_ ) {
	var k='date1'+i_;
	var el=document.getElementById( String( k ));
	if ( null!=typeof( obj )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event ) ?window.event.keyCode:e.which;
			if ( keyCode=='48' || keyCode=='49' || keyCode=='50' || keyCode=='51' || keyCode=='52' || keyCode=='53' || keyCode=='54' || keyCode=='55' || keyCode=='56' || keyCode=='57' || keyCode=='8' || keyCode=='0' ) {
				if ( obj.value.length==2 ) {
					obj.value+='-';
					var o=obj.value.split( '-' );
					if ( number( o[0] )>31 ) {
						alert( 'DAY>31!' );
						obj.value=dtedit_dd; return false;
					} else if ( number( o[0] )<1 ) {
						alert( 'DAY<1!' );
						obj.value='01'; return false;
					}
				} else if ( obj.value.length==5 ) {
					obj.value+='-';
					var o=obj.value.split( '-' );
					if ( number( o[1] )>12 ) {
						alert( 'MONTH>12!');
						obj.value=o[0]+'-'+dtedit_mm;
						return false;
					} else if ( number( o[1] )<1 ) {
						alert( 'MONTH<1!' );
						obj.value=o[0]+'-'+dtedit_mm;
						return false;
					}
				} else if ( obj.value.length==10 ) {
					obj.value+='-';
					var o=obj.value.split( '-' );
					if ( number( o[2] )>2099 ) {
						alert( 'YEAR>2099!' );
						obj.value=o[0]+'-'+o[1]+'-'+dtedit_yyyy;
						return false;
					} else if ( number( o[2] )<1991 ) {
						alert( 'YEAR<1991!' );
						obj.value=o[0]+'-'+o[1]+'-'+dtedit_yyyy;
						return false;
					}
				}
				return true;
			} else return false;
		}
		var o=obj.value.split( '-' );
		if ( obj.value.length==10 ) {
			obj.value+='-';
			var o=obj.value.split( '-' );
			if ( number( o[2] )>2099 ) {
				alert( 'YEAR>2099!' );
				obj.value=o[0]+'-'+o[1]+'-'+dtedit_yyyy;
				return false;
			} else if ( number( o[2] )<1991 ) {
				alert( 'YEAR<1992!' );
				obj.value=o[0]+'-'+o[1]+'-'+dtedit_yyyy;
				return false;
			}
			timeA=new Date(number(o[2]),number(o[1]),1);
			timeDifference=timeA-86400000;
			obj.value+='-';
			timeB=new Date( timeDifference );
			var daysInMonth=timeB.getDate();
			if ( number( o[0] )>daysInMonth ) {
				alert( 'DAY>'+daysInMonth+'!');
				obj.value='01'+'-'+o[1]+'-'+o[2];
			}
		}
	}
}
</script>
