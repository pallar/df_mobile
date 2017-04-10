<?php
for($app_tab=1; $app_tab<=8; $app_tab++) {
	$app_tabs[$app_tab]="<li";
}
$tmp=$app_tabs[$curr_app_tab]; $app_tabs[$curr_app_tab]=$tmp." class='active";
for($app_tab=1; $app_tab<=7; $app_tab++) {
	if($app_tab!=$curr_app_tab) {
		$tmp=$app_tabs[$app_tab]; $app_tabs[$app_tab]=$tmp.">";
	} else {
		$tmp=$app_tabs[$app_tab]; $app_tabs[$app_tab]=$tmp."'>";
	}
}
if($curr_app_tab!=8) {
	$tmp=$app_tabs[8]; $app_tabs[$app_tab]=$tmp." class='last'>";
} else {
	$tmp=$app_tabs[8]; $app_tabs[$app_tab]=$tmp." last'>";
}
$title=$app_rel."&nbsp;".$title;
echo "
<title>$title</title>";
?>

<link href='../css/f_.css' rel='stylesheet' type='text/css'>
<link href='../css.lib/bootstrap.css' rel='stylesheet' type='text/css'>
<script language='JavaScript' src='../js.lib/angular/angular.js'></script>
<script language='JavaScript' src='../js.lib/jquery/jquery.js'></script>
<script language='JavaScript' src='../js.lib/bootstrap/bootstrap.js'></script>
<script language='JavaScript' src='../js.lib/ngprogbar.js'></script>
<script language='JavaScript' src='../dflib/f_first.js'></script>
<script language='JavaScript' type='text/javascript'>
function Is_CookiesOn() {
	if ( navigator.cookieEnabled==false ) alert( 'SWITCH ON COOKIES!' );
}
</script>

<script language='JavaScript' src='../dflib/ajax/jshttprq.js'></script>
<script language='JavaScript' type='text/javascript'>
function $$( id ) {
	return document.getElementById( id );
}

function ok_keyp( i_, ok_ ) {
	var el=$$( String( i_ ));
	if ( null!=typeof( el )) {
		el.onkeypress=function( e ) {
			var keyCode=( window.event ) ?window.event.keyCode:e.which;
			if ( keyCode=='13' ) $$( String( ok_ )).click();//enter pressed
			return true;
		}
	}
}

function Login_Show() {
	Period_Close();
	JsHttpRequest.query( '../_view/f__logi_.php',
		{ buttn:'1' },
		function( responseJS, responseText ) {
			el=$$( '__shadow__' );
			el.style.visibility='visible';
			el.style.display='block';
			el=$$( 'login_div' );
			el.innerHTML=responseJS.text;
			el.style.left='-5px';
			el.style.top='35px';
			el.style.visibility='visible';
			el.style.display='block';
		},
		false );
}

function Login_OnOk() {
	var user=$$( 'user' ).value;
	var passwd=$$( 'pass' ).value;
	JsHttpRequest.query( '../_view/f__logi_.php',
		{ event:'login_checkpassw', user:user, passwd:passwd },
		function( responseJS, responseText ) {
			if ( responseJS==null | responseJS=='' ) {
			} else {
				window.document.cookie='userCoo='+responseJS.user+';path=/';
				window.document.cookie='unickCoo='+encodeURI( responseJS.usernick )+';path=/';
				el=document.getElementById( 'login_div' );
				el.style.visibility='hidden';
				el.style.display='none';
				window.location.href='';
			}
		},
		false );
}

function Login_OnCancel() {
	var user='not_changed';
	var passwd='not_required';
	JsHttpRequest.query( '../_view/f__logi_.php',
		{ event:'login_cancel', user:user, passwd:passwd },
		function( responseJS, responseText ) {
			if ( responseJS==null | responseJS=='' ) {
			} else {
				el=document.getElementById( 'login_div' );
				el.style.visibility='hidden';
				el.style.display='none';
				window.location.href='';
			}
		},
		false );
}

function Period_Show() {
	el=$$( 'login_div' );
	el.style.visibility='hidden';
	el.style.display='none';
	el=$$( 'filt_div' );
	el.style.visibility='hidden';
	el.style.display='none';
	el=$$( '__shadow__' );
	el.style.visibility='visible';
	el.style.display='block';
	el=$$( 'period_div' );
	el.style.left=( document.body.scrollWidth-287 )+'px';
	el.style.top='35px';
	el.style.visibility='visible';
	el.style.display='block';
}

function Period_Close() {
	el=$$( 'period_div' );
	el.style.visibility='hidden';
	el.style.display='none';
	el=$$( '__shadow__' );
	el.style.visibility='hidden';
	el.style.display='none';
}
</script>
<script language='JavaScript' src='../dflib/f_date.js'></script>
<script language='JavaScript' src='../dflib/f_per.js'></script>
<script language='JavaScript' src='../dflib/f_input.js'></script>
</head>

<body onload='Is_CookiesOn(); App_Login(); App_OnStart();' onkeypress='App_HotKeys();' oncontextmenu='return false;'>
	
<div class='mk' id='login_div' style='border-color:#66a0a0 #66a0a0 #66a0a0 #66a0a0; border-style:solid; border-width:1px; display:none; font-size:12; height:126px; line-height:16px; position:absolute; text-align:center; visibility:hidden; width:270px; z-index:10;' onmouseover='in_menu=true;'>
</div>
<div class='mk' id='period_div' style='border-color:#66a0a0 #66a0a0 #66a0a0 #66a0a0; border-style:solid; border-width:1px; display:none; font-size:12; height:126px; line-height:16px; position:absolute; text-align:center; visibility:hidden; width:270px; z-index:10;' onmouseover='in_menu=true;'>
</div>
<div class='shadow' id='__shadow__' name='__shadow__'></div>
<?php
echo"
<nav>
	<div id='cssmenu'>
		<ul>
			<li class='client_rtc'><span id='rtc_div'></span></li>
			<li style='min-width:120px;'><a style='color:#33ffff;' onclick='Login_Show(); return false;'><span id='uname_div'>&nbsp;</span></a></li>
			".$app_tabs[1]."<a href='../index.php'><span>МНЕМОСХЕМА</span></a></li>
			".$app_tabs[2]."<a href='../_view/f__parl.php'><span>ПО ЗАЛУ</span></a></li>
			".$app_tabs[3]."<a href='../_view/f__reps.php'><span>ЗВІТИ</span></a></li>
			".$app_tabs[4]."<a href='../_view/f__cards.php'><span>КАРТОТЕКА</span></a></li>
			".$app_tabs[5]."<a href='../_view/f__ops.php'><span>ОПЕРАЦІЇ</span></a></li>
			".$app_tabs[6]."<a href='../_view/f__conf.php'><span>НАЛАШТУВАННЯ</span></a></li>
			".$app_tabs[7]."<a href='../man/?lang=uk' target='w1'><span>?</span></a></li>
			".$app_tabs[8]."<a onclick='Per_FromCoo(); Period_Show(); return false;'><span>ПЕРІОД</span></a></li>
		</ul>
	</div>
</nav>";
?>

<script language='JavaScript' type='text/javascript'>
function get_window_prop() {
	window.width=window.innerWidth || document.documentElement.clientWidth;
	window.height=window.innerHeight;
	window.document.cookie='_width='+width+';path=/';
	window.document.cookie='_height='+height+';path=/';
	if ( window.width<=800 ) window.document.cookie='_mobile=1;path=/';
	else window.document.cookie='_mobile=0;path=/';
}
</script>
