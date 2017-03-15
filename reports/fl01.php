<?php
/* DF_2: reports/fl01.php
reports list: tab 01 [MILK] reports
c: 20.03.2006
m: 10.07.2015 */

echo "
	<div class='section group'>
		<div class='col span_1_of_3'>
		<div id='list'>
		<ul>
			<li><a href='../reports/f_mcws.php?title=".htmlentities( urlencode ( $ged["RR0301"] ))."&select_table=".$cows."&select_field=c.id' target='w1'>".$ged["RR0301"]."</a></li>
			<li><a href='../reports/f_mcws1.php?title=".htmlentities( urlencode ( $ged["RR0301.02"] ))."' target='w1'>".$ged["RR0301.02"]."</a></li>
			<li><a href='../reports/f_mcws2.php?title=".htmlentities( urlencode ( $ged["RR0301.02"] ))." [".$ged["r-td-conductivity"]."]' target='w1'> ".$ged["RR0301.02"]." [".$ged["r-td-conductivity"]."]</a></li>
			<li><a href='../reports/f_mcws3.php?filt_percent=0&title=".htmlentities( urlencode ( $ged["RR0301.03"] ))."' target='w1'>".$ged["RR0301.03"]."</a></li>
			<li><a href='../reports/f_mcws3.php?filt_percent=1&min_percent=-10&title=".htmlentities( urlencode ( $ged["RR0301.04"] ))."' target='w1'>".$ged["RR0301.04"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0306"] ))."&select_table=".$breeds."&select_field=c.breed_id' target='w1'> ".$ged["RR0306"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0307"] ))."&select_table=".$lots."&select_field=d.lot_id' target='w1'> ".$ged["RR0307"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0308"] ))."&select_table=".$groups."&select_field=d.gr_id' target='w1'> ".$ged["RR0308"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0309"] ))."&select_table=".$subgrs."&select_field=d.subgr_id' target='w1'> ".$ged["RR0309"]."</a></li>
			<li><a href='../reports/f_m.php?title=".htmlentities( urlencode ( $ged["RR0310"] ))."' target='w1'>".$ged["RR0310"]."</a></li>
		</ul>
		<ul>
			<li class='caption'>".$ged['RR0349']."</li>
			<li><a href='../reports/f_mcws.php?title=".htmlentities( urlencode ( $ged["RR0350"] ))."&select_table=".$cows."&select_field=c.id&filt_dev=00-00' target='w1'>".$ged["RR0350"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0351"] ))."&select_table=".$breeds."&select_field=c.breed_id&filt_dev=00-00' target='w1'>".$ged["RR0351"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0352"] ))."&select_table=".$lots."&select_field=d.lot_id&filt_dev=00-00' target='w1'>".$ged["RR0352"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0353"] ))."&select_table=".$groups."&select_field=d.gr_id&filt_dev=00-00' target='w1'>".$ged["RR0353"]."</a></li>
			<li><a href='../reports/f_mcw_gs.php?title=".htmlentities( urlencode ( $ged["RR0354"] ))."&select_table=".$subgrs."&select_field=d.subgr_id&filt_dev=00-00' target='w1'>".$ged["RR0354"]."</a></li>
			<li><a href='../reports/f_m.php?title=".htmlentities( urlencode ( $ged["RR0355"] ))."&filt_dev=00-00' target='w1'>".$ged["RR0355"]."</a></li>
		</ul>
		</div>
		</div>
		<div class='col span_2_of_3'>
		<div id='list'>
		<ul>
			<li><a href='f_mlact.php?title=".htmlentities( urlencode ( $ged["RR0340"] ))."&lact_restrict=1&filt_cowid=-1' target='w1'>".$ged["RR0340"]."</a></li>
			<li><a href='f_mlact.php?title=".htmlentities( urlencode ( $ged["RR0341"] ))."&lact_restrict=2&filt_cowid=-1' target='w1'>".$ged["RR0341"]."</a></li>
			<li><a href='f_mlact.php?title=".htmlentities( urlencode ( $ged["RR0342"] ))."&lact_restrict=3&filt_cowid=-1' target='w1'>".$ged["RR0342"]."</a></li>
			<li><a href='f_mlact.php?title=".htmlentities( urlencode ( $ged["RR0343"] ))."&lact_restrict=4&filt_cowid=-1' target='w1'>".$ged["RR0343"]."</a></li>
			<li><a href='f_mlact.php?title=".htmlentities( urlencode ( $ged["RR0344"] ))."&lact_restrict=5&filt_cowid=-1' target='w1'>".$ged["RR0344"]."</a></li>
			<li><a href='f_mlact.php?title=".htmlentities( urlencode ( $ged["RR0345"] ))."&lact_restrict=6&filt_cowid=-1' target='w1'>".$ged["RR0345"]."</a></li>
			<li><a href='f_mlact.php?title=".htmlentities( urlencode ( $ged["RR0346"] ))."&lact_restrict=7&filt_cowid=-1' target='w1'>".$ged["RR0346"]."</a></li>
		</ul>
		</div>
		</div>
	</div>";
?>
