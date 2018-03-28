<?php
/* DF_ajs: _view/f__pe_.php
form: set period
c: 01.02.2006
m: 16.03.2018 */

$skip_W3C_DOCTYPE=1;

$ANGULAR_IS_USED=1;

include( "../f_vars.php" );
include( "../locales/$lang/f_prep._$lang" );
include( "../locales/$lang/f_php._$lang" );
include( "../locales/$lang/f_09._$lang" );
include( "../locales/$lang/f_sel._$lang" );
include( "../dflib/f_func.php" );

require_once "../dflib/ajax/jshttprq.php";
$JsHttpRequest=new JsHttpRequest( $contentCharset );
$event=$_REQUEST["event"];

ob_start();

switch( $event ) {
	case "":
		$init=$_REQUEST["init"]*1;
		if ( $init==1 ) {
			ob_end_flush();
			$HUA="_".$_SERVER["HTTP_USER_AGENT"];
			echo "
<html>
<head>
<link href='".$hcss["f_0.css"]."' rel='stylesheet' type='text/css'>
<link href='../oper/f_opcss.css' rel='stylesheet' type='text/css'>";
			if ( strpos( $HUA, "Firefox" )!=0 ) echo "
<link href='".$hcss["f_1ff036.css"]."' rel='stylesheet' type='text/css'>";
			else if ( strpos( $HUA, "MSIE 6.0" )!=0 ) echo "
<link href='".$hcss["f_1ie060.css"]."' rel='stylesheet' type='text/css'>";
			else if ( strpos( $HUA, "Chrome" )!=0 ) echo "
<link href='".$hcss["f_1ch100.css"]."' rel='stylesheet' type='text/css'>";
			else if ( strpos( $HUA, "Opera" )!=0 ) echo "
<link href='".$hcss["f_1op110.css"]."' rel='stylesheet' type='text/css'>";
			else if ( strpos( $HUA, "Safari" )!=0 ) echo "
<link href='".$hcss["f_1ch100.css"]."' rel='stylesheet' type='text/css'>";
			echo "
</head>

<body>

<center>
<table width='90%'>
<tr>
	<td>
		<table width='100%'>
		<tr height='13px'><td></td></tr>
		<tr>
			<td style='color:#666666;'>
				<select class='sel sel_h0' id='per_d1' style='width:43px;' onchange='Per_d1();'><option value='1'>1</option></select>";
Date_MonthsList( "<select class='sel sel_h0' id='per_m1' style='width:140px;' onclick='Per_m1();' onchange='Per_m1(); Per_d1list();'>" );
Date_YearsList( "<select class='sel sel_h0' id='per_y1' style='width:60px;' onclick='Per_y1();' onchange='Per_y1(); Per_d1list();'>" );
			echo "
			</td>
		</tr>
		<tr height='3px'><td></td></tr>
		<tr>
			<td style='color:#666666'>
				<select class='sel sel_h0' id='per_d2' style='width:43px;' onchange='Per_d2();'><option value='1'>1</option></select>";
Date_MonthsList( "<select class='sel sel_h0' id='per_m2' style='width:140px;' onclick='Per_m2();' onchange='Per_m2(); Per_d2list();'>" );
Date_YearsList( "<select class='sel sel_h0' id='per_y2' style='width:60px;' onclick='Per_y2();' onchange='Per_y2(); Per_d2list();'>" );
			echo "
			</td>
		</tr>
		<tr height='13px'><td></td></tr>
		<tr>
			<td>
				<input class='btn gradient_0f0 btn_h0' style='width:159px;' type='button' value='".$php_mm["_com_accept_btn_"]."' onclick='Per_ToCoo(); Period_Close();'>
				<input class='btn gradient_f00 btn_h0' style='width:81px;' type='button' value='"."X"."' onclick='Period_Close();'><br>
			</td>
		</tr>
		</table>
	</td>
</table>
</center>

</body>
</html>";
			$row=ob_get_contents();
		} else {
			$row="!!!";
		}
		$_RESULT=array( "text"=>$row );
		break;
	case "period_set":
		break;
	case "period_cancel":
		break;
	}
?>
