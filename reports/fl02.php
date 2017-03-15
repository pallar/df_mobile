<?php
/* DF_2: reports/fl02.php
reports list: tab 02 reports
c: 20.03.2006
m: 10.07.2015 */

echo "
		<div id='list'>
		<ul>
			<li><a href='../reports/f_ofore.php?title=".htmlentities( urlencode ( $ged["r-td-Fore"] ))."' target='w1'>".$ged["r-td-Fore"]."</a></li>
			<li><a href='../reports/f_oratio.php?title=".htmlentities( urlencode ( $ged["r-td-Insem_Analysis"] ))."' target='w1'>".$ged["r-td-Insem_Analysis"]."</a></li>
			<li><a href='../reports/f_ofore1.php?title=".htmlentities( urlencode ( $ged["r-td-Insem_Plan"] ))."' target='w1'>".$ged["r-td-Insem_Plan"]."</a></li>
			<li><a href='../reports/f_ofore2.php?dontuse_period=1&title=".htmlentities( urlencode ( $ged["r-td-Prep_Zapusk_Plan"] ))."' target='w1'>".$ged["r-td-Prep_Zapusk_Plan"]."</a></li>
			<li><a href='../reports/f_ofore2.php?dontuse_period=4&title=".htmlentities( urlencode ( $ged["r-td-Zapusk_Plan"] ))."' target='w1'>".$ged["r-td-Zapusk_Plan"]."</a></li>
			<li><a href='../reports/f_ofore2.php?title=".htmlentities( urlencode ( $ged["r-td-Zapusk_Plan_From_To"] ))."' target='w1'>".$ged["r-td-Zapusk_Plan_From_To"]."</a></li>
			<li><a href='../reports/f_ofore3.php?dontuse_period=4&title=".htmlentities( urlencode ( $ged["r-td-Abort_Plan"] ))."' target='w1'>".$ged["r-td-Abort_Plan"]."</a></li>
			<li><a href='../reports/f_ofore3.php?title=".htmlentities( urlencode ( $ged["r-td-Abort_Plan_From_To"] ))."' target='w1'>".$ged["r-td-Abort_Plan_From_To"]."</a></li>
			<li><a href='../reports/f_ofore4.php?title=".htmlentities( urlencode ( $ged["r-td-Plan_20110516"] ))."' target='w1'>".$ged["r-td-Plan_20110516"]."</a></li>
		</ul>
		</div>";
?>
