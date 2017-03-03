<?php
// jsql.php
// return json_encoded query results
$skip_W3C_DOCTYPE=1;
include("../../f_vars0.php");
$query=$_GET[query].$_POST[query];
$table_cols=$_GET[table_cols].$_POST[table_cols];
$res1=mysql_query($query,$db);
if($table_cols==0){
	if(mysql_errno()==0) $res=mysql_insert_id(); else $res=mysql_errno();
}else{
	$rows=0; while($row=mysql_fetch_row($res1)){$res[$rows]=$row;$rows++;}
}
echo json_encode($res);
?>
