<?php
include("../f_myadm.php");
$config=array("hostname"=>$db_host, "username"=>$db_user, "password"=>$db_password, "dbname"=>$db_name);

if(!mysql_connect($config["hostname"], $config["username"], $config["password"])) exit();
if(!mysql_select_db($config["dbname"])) exit();
mysql_query("SET NAMES 'utf8'");
header("Cache-Control: no-cache, must-revalidate");// reject caching
header("Pragma: no-cache");
header("Content-Type: text/javascript; charset=utf-8");
if(isset($_POST["act"])) {
	switch($_POST["act"]) {
		case "send": Send(); break;
		case "load": Load(); break;
		default: exit();
	}
}

function Send() {
	$name=mb_substr($_POST["name"], 0, 200, "utf-8");
	$name=htmlspecialchars($name);// hide dangerous tags <h1>, <br> etc.
	$name=mysql_escape_string($name);
	$name="<font color=#aaaaaa face=Courier>".date("d.m.y")." ".date("H:i:s")."</font> <b>".$name."</b>";
	$text=mb_substr($_POST["text"], 0, 200, "utf-8");
	$text=htmlspecialchars($text);
	$text=mysql_escape_string($text);
	mysql_query("INSERT INTO f_chat (name, text) VALUES ('".$name."', '".$text."')");
}

function Load() {
	$farm_id=$_POST["farm_id"];
	$last_message_id=intval($_POST["last"]);
	// query to get last 20 messages
	if($farm_id=="") $res=mysql_query("SELECT * FROM f_chat WHERE id>$last_message_id ORDER BY id DESC LIMIT 20");
	else $res=mysql_query("SELECT * FROM f_chat WHERE (id>$last_message_id AND farm_id='$farm_id') ORDER BY id DESC LIMIT 20");
	if(mysql_num_rows($res) > 0) {
		// create js to send
		$js="var chat=$(\"#chat_area\");";// get pointer to <div>
		// get messages
		$messages=array();
		while($row=mysql_fetch_array($res)) $messages[]=$row;
		// [0] - the last message in db
		$last_message_id=$messages[0]["id"];
		// reverse array
		$messages=array_reverse($messages);
		foreach($messages as $value) {// append to js to send
			$js.="chat.append(\"<span>".$value["name"].": ".$value["text"]."</span>\");";
		}
		$js.="last_message_id=$last_message_id;";
		// send js
		echo $js;
	}
}
?>
