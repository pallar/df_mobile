<?php
/* DF_2: oper/fohead.php
operations head
c: 11.10.2017
m: 11.10.2017 */

echo "
<style>
@media only screen and (min-width:801px), (min-device-width:769px) {";
if ( $_mod_rep_CSS==1 ) echo $_mod_rep_CSS_content_not_mobile;
echo "
}
@media only screen and (max-width:800px), (min-device-width:768px) and (max-device-width: 1024px) {
	/* Force table to be not like table anymore */
	table, thead, tbody, tfoot, th, td, tr { display:block; }
	/* Hide table headers (but not display: none; for accessibility) */
	thead tr { left:-9999px; position:absolute; top:-9999px; }
	/* Behave like a row */
	#rep_tbody td { padding-left:50%; padding-right:3px; position:relative; text-align:right; }
	/* Now like a table header */
	#rep_tbody td:before { left:5px; padding-right:10px; position:absolute; top:6px; white-space:nowrap; width:45%; }";
if ( $_mod_rep_CSS==1 ) echo $_mod_rep_CSS_content;
echo "
}
</style>";
?>
