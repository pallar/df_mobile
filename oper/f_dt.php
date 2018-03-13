<?php
/* DF_2: oper/f_dt.php
group operations table row calendar
c: 25.05.2006
m: 10.10.2017 */
?>

<script language='JavaScript' src='../dflib/f_date.js'></script>
<script language='JavaScript'>
function cal_fromcoo() {
	Date_FromCoo( 'd1', 'm1', 'y1', '_op_dt1' );
}

function cal_tocoo() {
	Date_ToCoo( 'd1', 'm1', 'y1', '_op_dt1' );
}

function cal_dayslist() {
	Date_DaysList( 'd1', 'm1', 'y1' );
}

function cal_nowdayslist() {
	Date_NowDaysList( 'd1' );
}

function fill_tdsDates() {
<?php
for ( $i=0; $i<count( $cows_arr )-1; $i++ ) {
?>
	el<?php echo $i;?>=document.getElementById( 'date1<?php echo $i;?>' );
	el_d=$$( 'd1' ); el_m=$$( 'm1' ); el_y=$$( 'y1' );
	d=Number( el_d.value ); if ( d<10 ) d='0'+d;
	m=Number( el_m.value ); if ( m<10 ) m='0'+m;
	el<?php echo $i;?>.value=d+'-'+m+'-'+el_y.value;
<?php
}
?>
}

function fill_tds( el_, j_ ) {
	el=document.getElementById( el_ );
<?php
for ( $i=0; $i<count( $cows_arr )-1; $i++ ) {
?>
	el0=j_+String( <?php echo $i;?> );
	el<?php echo $i;?>=document.getElementById( el0 );
	el<?php echo $i;?>.value=el.value;
<?php
}
?>

}
</script>
