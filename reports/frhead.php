<?php
/* DF_2: reports/frhead.php
report head
c: 08.08.2007
m: 20.07.2015 */

$_filtsXmode="r";
include( "ffilt1.php" );
echo "
<title>".$title."</title>
<!--
<script language='JavaScript' src='fmcontxt.js'></script>
-->
<style>
html, body { background:#ffffff; font:8pt Tahoma,sans-serif; height:100%; margin:0; padding:0; }
body { margin:0 5px 0 5px; }
table { border-collapse:collapse; width:100%; }
td { border:1px solid #ddd; }
.no_border td { border:0; }
#rep_thead th { border:1px solid #ddd; background:#e4efdb; }
#rep_tbody tr:nth-of-type( odd ) { background:#f9fdf9; };
.rep_tfooter { border:1px solid #ddd; background:#e4efdb; }
a { color:#003366; text-decoration:none; }
a:hover { text-decoration:none; }

@media only screen and (max-width:800px), (min-device-width:768px) and (max-device-width: 1024px) {
  /* Force table to be not like table anymore */
  table, thead, tbody, th, td, tr { display:block; }
  /* Hide table headers (but not display: none; for accessibility) */
  thead tr { left:-9999px; position:absolute; top:-9999px; }
  #rep_tbody tr { border:1px solid #eee; }
  #rep_tfoot tr { border:1px solid #eee; }
  /* Behave like a 'row' */
  #rep_tbody td { border:none; border-bottom:1px solid #eee; padding-left:50%; position:relative; text-align:right; }
  #rep_tfoot td { border:none; border-bottom:1px solid #eee; position:relative; }
  /* Now like a table header */
  #rep_tbody td:before { left:6px; padding-right:10px; position:absolute; top:6px; white-space:nowrap; width:45%; }";
if ( $_mod_rep_CSS==1 ) echo $_mod_rep_CSS_content;
echo "
}
</style>
</head><br>";

$logindiv__hide=1;//ONLY IN THIS SCRIPT!
echo "

<table class='no_border' width='100%'>
<tr>";
if ( $btnToPrn+$noCSS<1 ) echo "
	<td $ljust width='200px'>
		<a href='../index.php' id='href_mnemo'><b>".$php_mm["_00_mnemo_btn_cap"]."</b></a>
		<a href='print' onclick='window.document.getElementById(\"print_me\").style.visibility=\"hidden\"; window.document.getElementById(\"href_mnemo\").style.visibility=\"hidden\"; print(); return false' id='print_me'><b>".$php_mm["_com_output_to_print_lnk_cap"]."</b></a>
	</td>
	<td $cjust class='zag3'>$title__</td>";
else echo "
	<td $cjust class='zag3' colspan='2'>$title__</td>";
include( "f_jper.php" );
echo "
</tr>";
if ( $repfilt__hide<1 )
	if ( $dontuse_filt<1 & $WHEREADV_txt!=":<br>" )
		echo "
<tr>
	<td $ljust colspan='3'>".$php_mm["_com_rephd1_cap"].$WHEREADV_txt."</td>
</tr>";
echo "
</table><br>";
?>
