<?php
/* DF_2: oper/f_dtdiv.php
group operations table row's date
c: 25.05.2006
m: 10.10.2017 */

echo "
<!-- date div for table row -->
<script language='JavaScript' src='../dflib/f_date.js'></script>
<script language='JavaScript'>
function cal_u1( event_, dx_, dy_ ) {
	el=document.getElementById( 'div_cal' );
	o=event_.srcElement;
	x=event_.clientX+document.documentElement.scrollLeft+document.body.scrollLeft-300+dx_;
	y=event_.clientY+document.documentElement.scrollTop+document.body.scrollTop-100+dy_;
//	el.style.visibility='visible'; el.style.display='block';
	height=el.scrollHeight-20;
	if( window.opera ) height+=30;//stupid opera...
	if( event_.clientY+height>document.body.clientHeight ) y-=height+14; else y-=2;
	if( x<0 ) x=20;
	el.style.left=x+'px';
	el.style.top=y+'px';
	el.style.visibility='hidden'; el.style.display='none';
	el.style.visibility='visible'; el.style.display='block';
	event.returnValue=false;
}

function cal_hide1() {
	el=document.getElementById( 'div_cal' );
	el.style.visibility='hidden'; el.style.display='none';
}

function cn( el, event ) {
	if( event.button==1 ) {
		cm( event );
		return false;
	}
}

function cal_load1( sender_ ) {
	el='date1'+sender_; el=document.getElementById( String( el ));
	el_value=el.value;
	__date=el_value.split( '-' ); d=Number( __date[0] ); m=Number( __date[1] ); y=Number( __date[2] );
	el_d=document.getElementById( 'd11' );
	el_m=document.getElementById( 'm11' );
	el_y=document.getElementById( 'y11' );
	el_y.value=y; el_m.value=m; Date_DaysList( 'd11', 'm11', 'y11' );
	el_d.value=d;
}

function in_forms( sender_ ) {
	el='date1'+sender_; el=document.getElementById( el );
	el_d=document.getElementById( 'd11' );
	el_m=document.getElementById( 'm11' );
	el_y=document.getElementById( 'y11' );
	y=Number( el_y.value);
	m=Number( el_m.value); if( m<10 ) m='0'+m;
	d=Number( el_d.value ); if( d<10 ) d='0'+d;
	el.value=d+'-'+m+'-'+y;
}

function sele_to_dele( recipient_, tip_ ) {
	el=document.getElementById( String( recipient_ ));
	el.style.color='#ff0000';
	el.value='523041';
	el=document.getElementById( 'date10' );
	el.style.color='#ff0000';
	el=document.getElementById( 'OPER_TABLE' );
	el.style.background='#ff0000';
	el=document.getElementById( 'add_oper' );
	el.title=tip_;
}
</script>

<div class='mk' id='div_cal' style='display:none; font-size:12; border-color:#9d9da1 #0 #0 #9d9da1; border-style:solid; border-width:1px; line-height:16px; position:absolute; text-align:center; visibility:hidden; width:300px; z-index:100;' onmouseover='in_menu=true;'>
<center><br>
<select class='sel sel_h0' id='d11' style='width:40px;'></select>";
Date_MonthsList( "<select class='sel sel_h0' id='m11' style='width:170px' onchange='Date_DaysList( \"d11\", \"m11\", \"y11\" )'>" );
Date_YearsList( "<select class='sel sel_h0' id='y11' style='width:60px' onchange='Date_DaysList( \"d11\", \"m11\", \"y11\" )'>" );
echo "<br><br>
<input class='btn gradient_0f0 btn_h0' style='width:151px;' type='button' value='".$php_mm["_com_accept_btn_"]."' onclick='cal_hide1(); in_forms( sender_ )'>
<input class='btn gradient_f00 btn_h0' style='width:35px;' type='button' value='X' onclick='cal_hide1()'><br><br>
</center>
</div>";
?>
