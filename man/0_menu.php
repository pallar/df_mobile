<?php
// m: 30.03.2017
echo "
<script type='text/javascript'>
function menudiv_show() {
	document.getElementById( 'menudiv' ).style.visibility='visible';
}

function menudiv_hide() {
	document.getElementById( 'menudiv' ).style.visibility='hidden';
}
</script>

<style type='text/css'>
html, body {
	height:100%;
	margin:0;
	padding:0;
}

#page {
	background:#eee;
	margin:0;
	min-height:100%; /* full screen on */
}

*html #page {
	height:100%; /* for ie6 and lower */
}

#header {
	background:#ccc;
	height:100px; /* header's height */
}

#page-clear {
	clear:both;
	height:100px; /* >= footer's height */
}

#footer {
	background:#999;
	height:100px; /* footer's height */
	margin-top:-100px; /* = footer's height */
}

#b {
	background-image:url( 'files/b002.jpg' );
	background-position:center;
	background-repeat:no-repeat;
	font-family:Arial,Helvetica,sans-serif;
	font-size:12px;
	text-align:center;
	vertical-align:middle;
}

#b:hover {
	background-image:url( 'files/b001.jpg' );
	background-position:center;
	background-repeat:no-repeat;
	font-family:Arial,Helvetica,sans-serif;
	font-size:12px;
	text-align:center;
	vertical-align:middle;
}

#b a {
	color:#228b22;
	cursor:default;
	font-weight:bold;
	text-decoration:none;
}

#pagecontentdiv {
	z-index:1;
}

#menudiv {
	background:lightgray;
	height:60px;
	visibility:hidden;
}

#menuctrldiv {
	height:60px;
	left:0;
	position:absolute;
	top:0;
	width:100%;
	z-index:2;
}
</style>";
?>
