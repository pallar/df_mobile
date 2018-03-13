<?php
/* DF_2: oper/f_o_insm0.php
oper --128/--256 (108/109) [insemination] <style>
c: 11.10.2017
m: 20.02.2018 */

$th[2]=$ged["Group"];
$th[3]=$ged["Number"];
$th[4]=$ged["Nick"];
$th[5]=$ged["Bull_Nick"];
$th[20]=$ged["Comment."];
$th[21]=$ged["Date"];
$_mod_rep_CSS=1;
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
