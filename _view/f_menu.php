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
	var eid=$$( String( i_ ));
	if ( null!=typeof( eid )) {
		eid.onkeypress=function( e ) {
			var keyCode=( window.event ) ? window.event.keyCode : e.which;
			if ( keyCode=='13' ) $$( String( ok_ )).click();//enter pressed
			return true;
		}
	}
}

function Shadow_Close() {
	eid=$$( "__shadow__" );
	eid.style.visibility="hidden";
	eid.style.display="none";
}

function Shadow_Show() {
	eid=$$( "__shadow__" );
	eid.style.visibility="visible";
	eid.style.display="block";
}

function Login_Close() {
	eid=$$( "login_div" );
	eid.style.visibility="hidden";
	eid.style.display="none";
	Shadow_Close();
}

function Login_Show() {
	Period_Close();
	JsHttpRequest.query( "../_view/f__logi_.php",
	 { init:"1" },
	 function( responseJS, responseText ) {
		Shadow_Show();
		eid=$$( "login_div" );
		eid.innerHTML=responseJS.text;
		eid.style.left="-5px";
		eid.style.top="35px";
		eid.style.visibility="visible";
		eid.style.display="block";
	 },	false );
}

function Login_OnOk() {
	var user=$$( "user" ).value;
	var passwd=$$( "pass" ).value;
	JsHttpRequest.query( "../_view/f__logi_.php",
	 { event:"login_checkpassw", user:user, passwd:passwd },
	 function( responseJS, responseText ) {
		if ( responseJS==null | responseJS=="");
		else {
			window.document.cookie="userCoo="+responseJS.user+";path=/";
			window.document.cookie="unickCoo="+encodeURI( responseJS.usernick )+";path=/";
			Login_Close();
		}
	 }, false );
}

function Login_OnCancel() {
	var user="not_changed";
	var passwd="not_required";
	JsHttpRequest.query( "../_view/f__logi_.php",
	 { event:"login_cancel", user:user, passwd:passwd },
	 function( responseJS, responseText ) {
		if ( responseJS==null | responseJS=="");
		else Login_Close();
	 }, false );
}

function Period_Close() {
	eid=$$( "period_div" );
	eid.style.visibility="hidden";
	eid.style.display="none";
	Shadow_Close();
}

function Period_Show() {
	Login_Close();
	JsHttpRequest.query( "../_view/f__pe_.php",
	 { init:"1" },
	 function( responseJS, responseText ) {
		Shadow_Show();
		eid=$$( "period_div" );
		eid.innerHTML=responseJS.text;
		eid.style.left=( document.body.scrollWidth-289 )+"px";
		eid.style.top="35px";
		eid.style.visibility="visible";
		eid.style.display="block";
	 }, false );
}

</script>
<script language='JavaScript' src='../dflib/f_date.js'></script>
<script language='JavaScript' src='../dflib/f_per.js'></script>
<script language='JavaScript' src='../dflib/f_input.js'></script>
</head>

<body onload='Is_CookiesOn(); App_Login(); App_OnStart();' onkeypress='App_HotKeys();' oncontextmenu='return false;'>

<div class='mk' id='login_div' style='border-color:#66a0a0 #66a0a0 #66a0a0 #66a0a0; border-style:solid; border-width:1px; display:none; font-size:12; height:126px; line-height:16px; position:absolute; text-align:center; visibility:hidden; width:270px; z-index:10;' onmouseover='in_menu=true;'>
</div>
<div class='mk' id='period_div' style='border-color:#66a0a0 #66a0a0 #66a0a0 #66a0a0; border-style:solid; border-width:1px; display:none; font-size:12; height:126px; line-height:16px; position:absolute; text-align:center; visibility:hidden; width:272px; z-index:10;' onmouseover='in_menu=true;'>
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
			".$app_tabs[8]."<a onclick='Period_Show(); return false;'><span>ПЕРІОД</span></a></li>
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