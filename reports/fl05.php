<?php
/* DF_2: reports/fl05.php
reports list: tab 05 [GRAPH] reports
c: 20.03.2006
m: 10.07.2015 */

$dia="graph=1";//to build diagram set this to "graph=1"

echo "
		<div id='list'>
		<ul>
			<li><a href='../reports/f_mlact.php?".$dia."&lact_restrict=1&filt_cowid=-1&title=".htmlentities( urlencode ( $ged["RR0340"] ))."' target='w1'>".$ged["RR0340"]."</a></li>
			<li><a href='../reports/f_mlact.php?".$dia."&lact_restrict=2&filt_cowid=-1&title=".htmlentities( urlencode ( $ged["RR0341"] ))."' target='w1'>".$ged["RR0341"]."</a></li>
			<li><a href='../reports/f_mlact.php?".$dia."&lact_restrict=3&filt_cowid=-1&title=".htmlentities( urlencode ( $ged["RR0342"] ))."' target='w1'>".$ged["RR0342"]."</a></li>
			<li><a href='../reports/f_mlact.php?".$dia."&lact_restrict=4&filt_cowid=-1&title=".htmlentities( urlencode ( $ged["RR0343"] ))."' target='w1'>".$ged["RR0343"]."</a></li>
			<li><a href='../reports/f_mlact.php?".$dia."&lact_restrict=5&filt_cowid=-1&title=".htmlentities( urlencode ( $ged["RR0344"] ))."' target='w1'>".$ged["RR0344"]."</a></li>
			<li><a href='../reports/f_mlact.php?".$dia."&lact_restrict=6&filt_cowid=-1&title=".htmlentities( urlencode ( $ged["RR0345"] ))."' target='w1'>".$ged["RR0345"]."</a></li>
		</ul>
		</div>";
?>
