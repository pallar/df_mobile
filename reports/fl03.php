<?php
/* DF_2: reports/fl03.php
reports list: tab 03 [COMMON] reports
c: 20.03.2006
m: 14.03.2017 */

echo "
	<div id='section group'>
		<div class='col span_1_of_3'>
		<div id='list'>
		<ul>
			<li class='caption'>".$ged["r-th-BY_ANIMALS_STATES"]."</li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode ( $ged["RR2201"] ))."&sele_byState=A01' target='w1'>".$ged["RR2201"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode ( $ged["RR2202"] ))."&sele_byState=A02' target='w1'>".$ged["RR2202"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode ( $ged["RR2203"] ))."&sele_byState=A0' target='w1'>".$ged["RR2203"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode ( $ged["RR2206"] ))."&sele_byState=A**' target='w1'>".$ged["RR2206"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode ( $ged["RR2207"] ))."&sele_byState=A0q' target='w1'>".$ged["RR2207"]."</a></li>
			<li><a href='../reports/f_los.php?title=".htmlentities( urlencode ( $ged["RR2204"] ))."' target='w1'>".$ged["RR2204"]."</a></li>
			<li class='caption'>".$ged["r-th-BY_ANIMALS_AGES"]."</li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0116"] ))."&sele_byAge=0:6' target='w1'>".$ged["RR0116"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0117"] ))."&sele_byAge=7:13' target='w1'>".$ged["RR0117"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0118"] ))."&sele_byAge=14:182' target='w1'>".$ged["RR0118"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0119"] ))."&sele_byAge=183:364' target='w1'>".$ged["RR0119"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0120"] ))."&sele_byAge=365:729' target='w1'>".$ged["RR0120"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0121"] ))."&sele_byAge=730:1459' target='w1'>".$ged["RR0121"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0122"] ))."&sele_byAge=1460:' target='w1'>".$ged["RR0122"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0123"] ))."' target='w1'>".$ged["RR0123"]."</a></li>
		</ul>
		</div>
		</div>
		<div class='col span_2_of_3'>
		<div id='list'>
		<ul>
			<li class='caption'>".$ged["r-th-ALL_ANIMALS"]."</li>
			<li><a href='../reports/f_lcws1.php?title=".htmlentities( urlencode( $ged["RR0127"] ))."' target='w1'>".$ged["RR0127"]."</a></li>
			<li><a href='../reports/f_lcws.php?title=".htmlentities( urlencode( $ged["RR0132"] ))."' target='w1'>".$ged["RR0132"]."</a></li>
			<li><a href='../reports/f_lcws9.php?title=".htmlentities( urlencode( $ged["RR0139"] ))."' target='w1'>".$ged["RR0139"]."</a></li>
			<li><a href='../reports/f_ltgs.php?title=".htmlentities( urlencode( $ged["RR0140"] ))."' target='w1'>".$ged["RR0140"]."</a></li>
		</ul>
		</div>
		</div>
	</div>";
?>
