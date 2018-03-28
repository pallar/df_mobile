<?php
/* DF_2: oper/f_o_insm0.php
oper --128/--256 (108/109) [insemination] <style>
c: 11.10.2017
m: 14.03.2018 */

$th[2]=$ged["Group"];
$th[3]=$ged["Number"];
$th[4]=$ged["Nick"];
$th[5]=$ged["Bull_Nick"];
$th[20]=$ged["Comment."];
$th[21]=$ged["Date"];
$_mod_rep_CSS=1;
$_mod_rep_CSS_content_not_mobile="
	#rep_head_div { height:59px; }
	/* Label the data */
	#rep_tbody td:nth-of-type(1) { width:\"".$tdw[2]."\";}
	#rep_tbody td:nth-of-type(2) { width:\"".$tdw[3]."\";}
	#rep_tbody td:nth-of-type(3) { width:\"".$tdw[4]."\";}
	#rep_tbody td:nth-of-type(3) { width:\"".$tdw[5]."\";}
	#rep_tbody td:nth-of-type(5) { width:\"".$tdw[20]."\";}
	#rep_tbody td:nth-of-type(6) { width:\"".$tdw[21]."\";}";
if ( $div_hide!=1 ) $_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1) { background:#ddd; }
	#rep_tbody td:nth-of-type(1):before { content:\"".$th[2]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th[3]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th[4]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(4):before { content:\"".$th[5]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(5):before { content:\"".$th[20]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(6):before { content:\"".$th[21]."\"; text-align:left; top:0; }";
else $_mod_rep_CSS_content="
	/* Label the data */
	#rep_tbody td:nth-of-type(1):before { content:\"".$th[5]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(2):before { content:\"".$th[20]."\"; text-align:left; top:0; }
	#rep_tbody td:nth-of-type(3):before { content:\"".$th[21]."\"; text-align:left; top:0; }";
?>
