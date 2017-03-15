<?php
/* DF_2: reports/fgraph1.php
diagram/chart report init for GD
c: 07.08.2007
m: 14.03.2017 */

if ( $lineplot_h==0 ) $lineplot_h=400;//default lineplot height
if ( $lineplot_h<200 ) $lineplot_h=200;//default lineplot height patch
$marg_h=1;
$axis_h=$lineplot_h-$marg_h;
$expansion=10;
$bg_color="#f2f2f2";
$maindot_color="red";
$expdot_color="blue";

echo "
<style>
.lineplot_all {background-color:".$bg_color."; height:".$lineplot_h."px; margin:0 auto; overflow:hidden; padding:0; }
.lineplot_axis {border-bottom:1px solid; border-left:1px solid; height:".$axis_h."px; margin:0 0 0 0; }
.lineplot_bar {height:100%; float:left; margin:0 2px; position:relative; width:6px; }
.lineplot_cont {bottom:0; margin:0 auto; position:absolute; width:6px; }
.lineplot_val { }
.lineplot_dot {background-color:".$maindot_color."; height:4px; width:4px; }
.lineplot_dot1 {background-color:".$expdot_color."; height:4px; width:4px; }
.lineplot_dot2 {background-color:".$bg_color."; height:4px; width:4px; }
.lineplot_col {}
</style>";

function Lineplot_Show( $dots, $lineplot_h, $expansion ) {
	$n=count( $dots );
	$dots[$n-1]=0;
	$max=max( $dots );
echo "
<div class='lineplot_all'>
	<div class='lineplot_axis'>";
	for ( $i=0; $i<$n-1; $i++ ) {
		if ( $dots[$i]!='' ) {
			$l_h=round(( $dots[$i]*( $lineplot_h-50 ))/$max, 0 );
			if ( $dots[$i+1]>$dots[$i] ) { $min="style='margin-bottom:-18px;'"; } else { $min=''; }
			echo "
		<div class='lineplot_bar'>
			<div class='lineplot_cont'>
				<div class='lineplot_val' $min>$dots[$i]</div>
				<div class='lineplot_dot'></div>
				<div class='lineplot_col' style='height:".$l_h."px'></div>
			</div>
		</div>"; 
			if ( $dots[$i+1]<>'' & $i+1<$n ) {
				$p=( round(( $dots[$i+1]*( $lineplot_h-50 ))/$max, 0 )-$l_h )/$expansion;
				$l_h1=$l_h+$p;
				for ( $j=0; $j<$expansion-1; $j++ ) {
					echo "
		<div class='lineplot_bar'>
			<div class='lineplot_cont'>
				<div class='lineplot_val'></div>
				<div class='lineplot_dot1'></div>
				<div class='lineplot_col' style='height:".$l_h1."px'></div>
			</div>
		</div>";
					$l_h1=$l_h1+$p;
				}
			}
		} else {
				for ( $j=0; $j<$expansion; $j++ ) {
					echo "
		<div class='lineplot_bar'>
			<div class='lineplot_cont'>
				<div class='lineplot_val'></div>
				<div class='lineplot_dot2'></div>
				<div class='lineplot_col'></div>
			</div>
		</div>";
					$l_h1=$l_h1+$p;
				}
				
			}

	}
echo "
	</div>
</div>";
}
?>
