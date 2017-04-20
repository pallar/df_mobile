<?php
include("../f_lang.php");
include("../locales/$lang/f_chat._$lang");
header("Content-Type:text/html;charset=utf-8");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo $ged["chat_header"];?></title>
<meta content='text/html;charset=utf-8' http-equiv='content-type'>
<link href='css/f_chat.css' media='screen' rel='stylesheet' type='text/css'/>
<link href='css/f_chat1.css' media='screen' rel='stylesheet' type='text/css'/>
</head>

<script src='jquery.js' type='text/javascript'></script>
<script type='text/javascript'>
$(document).ready(function() {
	$("#pac_form").submit(Send);
	$("#pac_text").focus();
	setInterval("Load();", 2000);
});

function Send() {
	$.post("f_chat1.php", {
	 act:"send", name:$("#pac_name").val(),
	 text:$("#pac_text").val()
	 }, Load);
	$("#pac_text").val("");
	$("#pac_text").focus();
	return false;
}

var last_message_id=0;
var load_in_process=false;

function Load() {
	if(!load_in_process) {
		load_in_process=true;
		$.post("f_chat1.php", {
		 act: "load", last: last_message_id, rand: (new Date()).getTime()
		 }, function(result) {
		 eval(result);
		 $(".chat").scrollTop($(".chat").get(0).scrollHeight);
		 load_in_process=false;
		 });
	}
}
</script>

<body>
	<div style='padding:19px'>
		<h2><?php echo $ged["chat_header"];?></h2><br>
		<div class='chat r4'><div id='chat_area'></div></div><br>
		<form action='' id='pac_form' method='post'>
		<table style='width:100%'>
<?php
if($_COOKIE["userCoo"]!=9) {
?>
		<tr>
			<td><input class='r4' id='pac_name' placeholder='<?php echo "&nbsp;".$ged["chat_nick"];?>' type='text'></td>
			<td width='5px'></td>
			<td style='width:60%'><input class='r4' id='pac_text' maxlength='199' placeholder='<?php echo "&nbsp;".$ged["chat_message"];?>' type='text'></td>
			<td width='5px'></td>
			<td><input class='btn gradient_0f0' style='height:21px; width:99px;' type='submit' value='<?php echo $ged["chat_send"];?>'></td>
<?php
} else {
?>
			<td><h3><?php echo $ged["chat_info"];?></h3></td>
<?php
}
?>
		</tr>
		</table>
		</form>
	</div>
</body>
</html>
