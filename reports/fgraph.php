<?php
/* DF_2: reports/fgraph.php
diagram/chart report init
c: 24.06.2011
m: 14.03.2017 */

if ( $chart_h==0 ) $chart_h=267;//default chart height
$text_h=13;
$axis_h=$chart_h-$text_h;
$chart_all_h=$chart_h+7;
$bar_color="#bbbbbb";

echo "
<style>
.chart_all { height:".$chart_all_h."px; margin:0 0 0 5px; overflow:hidden; padding:0; }
.chart_axis { height:".$axis_h."px; border-bottom:1px solid; border-left:1px solid; padding-left:2px; }
.chart_bar { height:100%; float:left; margin:0 2px; position:relative; width:32px; }
.chart_cont { bottom:-15px; margin:0 auto; width:32px; overflow:hidden; position:absolute; }
.chart_y_val { height:".$text_h."px; text-align:center; }
.chart_col { background-color:".$bar_color."; }
.chart_x_val { height:".$text_h."px; margin-top:3px; text-align:center; }
</style>";

//$dots - array of values
//$chart_h - chart height
function ChartBar_Show( $dots, $chart_h ) {
	$dt=date( 'Y-m-d' );
	$n=count( $dots );
	$dots[$n-1]=0;
	$max=max( $dots ); if ( $max==0 ) $max=1;
	echo "
	<div class='chart_all'><div class='chart_axis'>";
	for ( $i=$n-2; $i>=0; $i-- ) {
		$d=date( 'd/m', strtotime( '-'.$i.' day', strtotime( $dt )));
		$r_h=round(( $dots[$i]*( $chart_h-26 ))/$max, 0 );//relative height, 26 = $text_h*2
		if ( $r_h==0 ) $r_h=1;
		if ( $i % 2 ) $d='';
		echo "
		<div class='chart_bar'>
			<div class='chart_cont'>
				<div class='chart_y_val'>$dots[$i]</div>
				<div class='chart_col' style='height:".$r_h."px'></div>
				<div class='chart_x_val'>$d</div>
			</div>
		</div>";
	}
	echo "
	</div></div>";
}

//$dots - array of values
//$chart_h - chart height
//$colspan - colspan for <td>
function Chart_Show( $dots, $chart_h ) {
	ChartBar_Show( $dots, $chart_h );
}
?>
