<?php
/* DF_ajs: _view/f__logi_.php
form: login ([LOGI]n)
c: 15.05.2006
m: 12.04.2017 */

$skip_W3C_DOCTYPE=1;

$ANGULAR_IS_USED=1;

include( "../f_vars.php" );
include( "../locales/$lang/f_prep._$lang" );
include( "../locales/$lang/f_php._$lang" );
include( "../locales/$lang/f_09._$lang" );
include( "../locales/$lang/f_sel._$lang" );
include( "../dflib/f_func.php" );

require_once "../dflib/ajax/jshttprq.php";
$JsHttpRequest=& new JsHttpRequest( $contentCharset );
$event=$_REQUEST["event"];

ob_start();

switch ( $event ) {
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
		<tr height='13px'><td colspan='2'></td></tr>
		<tr>
			<td style='border:100px; color:#666666; width:93px'>".$php_mm["_09_user_"]."&nbsp;</td>
			<td style='width:145px'>
				<select class='sel sel_h0' id='user' name='user' style='width:145px'>";
			$res=mysql_query( "SELECT id, nick, comments FROM $person ORDER BY id DESC" );
			$sqlerr=mysql_errno();
			if ( $sqlerr!=0 ) echo "
					<option value='ERROR'>ERROR&nbsp;</option>";
			else while ( $row=mysql_fetch_row( $res )) {
				$id=$row[0]; $nick=$row[1]; $comments=$row[2];
				echo "
					<option value='".$row[0]."'>$comments&nbsp;</option>";
			}
			mysql_free_result( $res );
			echo "
				</select>
			</td>
		</tr>
		<tr height='3px'><td colspan='2'></td></tr>
		<tr>
			<td style='color:#666666; width:93px'>".$php_mm["_09_passw_"]."&nbsp;</td>
			<td style='width:145px'>
				<input class='txt txt_h0' id='pass' maxlength='100' name='pass' style='width:145px' type='password' onkeydown='ok_keyp( \"pass\", \"login_button\" )'>
			</td>
		</tr>
		<tr height='13px'><td colspan='2'></td></tr>
		<tr>
			<td colspan='2'>
				<input class='btn gradient_0f0 btn_h0' id='login_button' style='width:159px' type='button' value='".$php_mm["_com_reg_btn_"]."' onclick='Login_OnOk()'>
				<input class='btn gradient_f00 btn_h0' id='cancel_button' style='width:79px' type='button' value='"."X"."' onclick='Login_OnCancel()'>
			</td>
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
	case "login_checkpassw":
		$uuid=$_REQUEST["user"]*1; $uupass=trim( $_REQUEST["passwd"] );
		$res=mysql_query( "SELECT id, passw, comments FROM $person WHERE id=$uuid" );
		$row=mysql_fetch_row( $res ); mysql_free_result( $res );
		$uid=$row[0]*1; $upassw=trim( $row[1] ); $unick=trim( $row[2] );
		if ( $uid==9 | ( $upassw==$uupass & $uid==$uuid*1 )) {
			$uunick=$unick; $userCoo=$uid; Period_FromDb( $userCoo, $vars );//TO SET PERIOD
			$_RESULT=array( "user"=>$uuid, "usernick"=>$uunick );
		}
		if ( $uuid==9 ) {
			if ( $upassw==$uupass ) CookieSet( "_intranet", "1" );
			else CookieSet( "_intranet", "0" );
		}
		break;
	case "login_cancel":
		$uunick=$unickCoo; $uuid=$userCoo;
		$_RESULT=array( "user"=>$uuid, "usernick"=>$uunick);
		break;
	}
?>
