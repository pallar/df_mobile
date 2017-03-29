<?php
/* DF_2: oper/f_dt.php
group operations table row calendar
c: 25.05.2006
m: 29.03.2017 */
?>

<script language='JavaScript' src='../dflib/f_date.js'></script>
<script language='JavaScript'>
function cal_fromcoo() {
	Date_FromCoo( "d1", "m1", "y1", "_op_dt1" );
}

function cal_tocoo() {
	Date_ToCoo( "d1", "m1", "y1", "_op_dt1" );
}

function cal_dayslist() {
	Date_DaysList( "d1", "m1", "y1" );
}

function cal_nowdayslist() {
	Date_NowDaysList( "d1" );
}

function table_dates() {
<?php
for ( $i=0; $i<count( $cows_arr )-1; $i++ ) {
?>
	el<?php echo $i;?>=document.getElementById( 'date1<?php echo $i;?>' );
	el_d=$$( "d1" ); el_m=$$( "m1" ); el_y=$$( "y1" );
	d=Number( el_d.value ); if ( d<10 ) d='0'+d;
	m=Number( el_m.value ); if ( m<10 ) m='0'+m;
	el<?php echo $i;?>.value=d+'-'+m+'-'+el_y.value;
<?php
}
?>
}

function table_edits( el, jj ) {
	el_=document.getElementById( el );
<?php
for ( $i=0; $i<count( $cows_arr )-1; $i++ ) {
?>
	el0=jj+String( <?php echo $i;?> );
	el<?php echo $i;?>=document.getElementById( el0 );
	el<?php echo $i;?>.value=el_.value;
<?php
}
?>

}
</script>

<?php
echo "<select class='cards_title1' id='d1' name='d1' style='cursor:pointer; height:20px' onchange='cal_tocoo(); table_dates();'></select>";
Date_MonthsList( "<select class='cards_title1' id='m1' name='m1' style='cursor:pointer; height:20px' onchange='cal_dayslist(); table_dates();'>" );
Date_YearsList( "<select class='cards_title1' id='y1' name='y1' style='cursor:pointer; height:20px' onchange='cal_dayslist(); table_dates();'>" );
echo "<br><br>";
?>
