<?php
/* DF_2: oper/f_o_mov0.php
oper ---64 (107) [moving & death] <style>
c: 11.10.2017
m: 22.03.2018 */

$th[2]=$ged["Group"];
$th[3]=$ged["Number"];
$th[4]=$ged["Nick"];
$th[5]=$ged["Departm."];
$th[20]=$ged["Comment."];
$th[21]=$ged["Date"];
$tdw[2]="60px";
$tdw[3]="60px";
$tdw[4]="170px";
$tdw[5]="100px";
$tdw[20]="100px";
$tdw[21]="170px";

$_mod_rep_CSS=1;
$_mod_rep_CSS_content_not_mobile="
	/* Label the data */
	#rep_thead td, #rep_thead th, #rep_tbody td { height:29px; }
	#rep_thead th { text-align:center; }
	#rep_tbody td:nth-of-type(1) { padding-left:7px; width:".$tdw[2].";}
	#rep_tbody td:nth-of-type(2) { width:".$tdw[3].";}
	#rep_tbody td:nth-of-type(4) { width:".$tdw[5].";}
	#rep_tbody td:nth-of-type(5) { width:".$tdw[20].";}
	#rep_tbody td:nth-of-type(6) { width:".$tdw[21].";}";
if ( $div_hide!=1 ) $_mod_rep_CSS_content="
	#rep_thead_div { background:#8fbc8f; }
	/* Label the data */
	#rep_thead td, #rep_tbody td { height:29px; text-align:left; }
	#rep_thead td:nth-of-type(-n+3) { height:0; }
	#rep_thead td:nth-of-type(4):before { content:\"".$th[5]."\"; }
	#rep_thead td:nth-of-type(5):before { content:\"".$th[20]."\"; }
	#rep_thead td:nth-of-type(6):before { content:\"".$th[21]."\"; }
	#rep_tbody tr:nth-of-type(even) td:nth-of-type(-n+3) { height:0; }
	#rep_tbody tr:nth-of-type(odd) td:nth-of-type(-n+6) { margin-left:3px; padding-top:7px; }
	#rep_tbody tr:nth-of-type(odd) td:nth-of-type(-n+6):before { margin-left:-3px; }
	#rep_tbody tr:nth-of-type(odd) td:nth-of-type(1):before { content:\"".$th[2]."\"; }
	#rep_tbody tr:nth-of-type(odd) td:nth-of-type(2):before { content:\"".$th[3]."\"; }
	#rep_tbody tr:nth-of-type(odd) td:nth-of-type(3):before { content:\"".$th[4]."\"; }
	#rep_tbody td:nth-of-type(4):before { content:\"".$th[5]."\"; }
	#rep_tbody td:nth-of-type(5):before { content:\"".$th[20]."\"; }
	#rep_tbody td:nth-of-type(6):before { content:\"".$th[21]."\"; }";
else $_mod_rep_CSS_content="";//input in cow card (NOT_READY)
?>
