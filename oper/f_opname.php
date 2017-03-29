<?php
/* DF_2: oper/f_opname.php
cows operations: operations names & privileges ([OP]erations [NAME]s)
c: 09.01.2006
m: 01.04.2015 */

$oper=mysql_query( "SELECT id, descr FROM $operstyp", $db );
while ( $operrow=mysql_fetch_row( $oper )) $opername[$operrow[0]*1]=$operrow[1];
$inserted_opername="'".$opername[$opertype*1]."'";
?>
