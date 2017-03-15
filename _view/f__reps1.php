<?php
?>
<!-- DF_ajs: Reports Tab 1 (Milk) Form -->
<!DOCTYPE html>
<html ng-app='f_reps'>
<head>
<?php
$title="Звіти - Інтернет-Ферма";
$curr_app_tab=3; include "f_menu.php";
?>

<nav1>
	<div id='cssmenu'>
		<ul>
			<li class='active'><a href='f__reps1.php'><span>Молоко</span></a></li>
			<li><a href='f__reps2.php'><span>Управління стадом</span></a></li>
			<li><a href='f__reps3.php'><span>Загальні</span></a></li>
			<li><a href='f__reps4.php'><span>Здоров'я</span></a></li>
			<li><a href='f__reps5.php'><span>Графіки</span></a></li>
			<li class='last'><a href='f__reps6.php'><span>Експорт</span></a></li>
		</ul>
	</div>
</nav1>

<script>
var nav=document.getElementsByTagName( 'nav' );
var nav1=document.getElementsByTagName( 'nav1' );
do_nav();

function do_nav() {
	var width=window.innerWidth || document.documentElement.clientWidth;
	window.document.cookie='_width='+width+';path=/';
	if ( width<=800 ) {
		childs=nav[0].children[0].children[0].childElementCount;
		childs1=nav1[0].children[0].children[0].childElementCount;
		nav[0].onclick=function( event ) {
			event=event || window.event;
			var t=event.target || event.srcElement;
//			if (t!=this) return true;
			for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=nav[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
			for ( var i=0; i<childs1; i++ ) nav1[0].children[0].children[0].children[i].style.display=nav1[0].children[0].children[0].children[i].style.display==='none'?'block':'none';
		}
	}
}

window.onresize=function() {
	do_nav();
	var width=window.innerWidth || document.documentElement.clientWidth;
	childs=nav[0].children[0].children[0].childElementCount;
	childs1=nav1[0].children[0].children[0].childElementCount;
	if ( width>800 ) menu_li_style='inline-block'; else menu_li_style='none';
	for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=menu_li_style;
	for ( var i=0; i<childs1; i++ ) nav1[0].children[0].children[0].children[i].style.display=menu_li_style;
}
</script>
<div class='section group'>
	<div class='col span_1_of_2'>
		<div class='section group'>
			<div class='col span_1_of_3'>
				<div id='list'>
					<ul>
						<li><a href='../reports/f_mcws.php?title=%D0%9F%D0%BE+%D1%82%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B0%D1%85&select_table=f_cows&select_field=c.id' target='w1'>По тваринах</a></li>
						<li><a href='../reports/f_mcws1.php?title=%D0%9F%D0%BE+%D1%82%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B0%D1%85%2C+%D0%B2%D0%B0%D0%BB%D0%BE%D0%B2%D0%B8%D0%B9' target='w1'>По тваринах, валовий</a></li>
						<li><a href='../reports/f_mcws2.php?title=%D0%9F%D0%BE+%D1%82%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B0%D1%85%2C+%D0%B2%D0%B0%D0%BB%D0%BE%D0%B2%D0%B8%D0%B9 [провідність]' target='w1'> По тваринах, валовий [провідність]</a></li>
						<li><a href='../reports/f_mcws3.php?filt_percent=0&title=%D0%9F%D0%BE+%D1%82%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B0%D1%85%2C+%D0%B4%D0%B8%D0%BD%D0%B0%D0%BC%D1%96%D0%BA%D0%B0+%28%25%29' target='w1'>По тваринах, динаміка (%)</a></li>
						<li><a href='../reports/f_mcws3.php?filt_percent=1&min_percent=-10&title=%D0%9F%D0%BE+%D1%82%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B0%D1%85%2C+%D0%BD%D0%B5%D0%B3%D0%B0%D1%82%D0%B8%D0%B2%D0%BD%D0%B0+%D0%B4%D0%B8%D0%BD%D0%B0%D0%BC%D1%96%D0%BA%D0%B0+%28%25%29' target='w1'>По тваринах, негативна динаміка (%)</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D0%BF%D0%BE%D1%80%D0%BE%D0%B4%D0%B0%D1%85&select_table=f__brs&select_field=c.breed_id' target='w1'> По породах</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D1%84%D0%B5%D1%80%D0%BC%D0%B0%D1%85&select_table=f__lots&select_field=d.lot_id' target='w1'> По фермах</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D1%81%D0%B5%D0%BA%D1%86%D1%96%D1%8F%D1%85&select_table=f__grs&select_field=d.gr_id' target='w1'> По секціях</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D0%BFi%D0%B4%D0%B3%D1%80%D1%83%D0%BF%D0%B0%D1%85&select_table=f__sgrs&select_field=d.subgr_id' target='w1'> По пiдгрупах</a></li>
						<li><a href='../reports/f_m.php?title=%D0%94%D0%B5%D1%82%D0%B0%D0%BB%D1%8C%D0%BD%D0%B8%D0%B9' target='w1'>Детальний</a></li>
					</ul>
					<ul>
						<li class='caption'>КОНТРОЛЬНI ДАНI</li>
						<li><a href='../reports/f_mcws.php?title=%D0%9F%D0%BE+%D1%82%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B0%D1%85%2C+%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BDi&select_table=f_cows&select_field=c.id&filt_dev=00-00' target='w1'>По тваринах, контрольнi</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D0%BF%D0%BE%D1%80%D0%BE%D0%B4%D0%B0%D1%85%2C+%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BDi&select_table=f__brs&select_field=c.breed_id&filt_dev=00-00' target='w1'>По породах, контрольнi</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D1%84%D0%B5%D1%80%D0%BC%D0%B0%D1%85%2C+%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BDi&select_table=f__lots&select_field=d.lot_id&filt_dev=00-00' target='w1'>По фермах, контрольнi</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D1%81%D0%B5%D0%BA%D1%86%D1%96%D1%8F%D1%85%2C+%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BDi&select_table=f__grs&select_field=d.gr_id&filt_dev=00-00' target='w1'>По секціях, контрольнi</a></li>
						<li><a href='../reports/f_mcw_gs.php?title=%D0%9F%D0%BE+%D0%BFi%D0%B4%D0%B3%D1%80%D1%83%D0%BF%D0%B0%D1%85%2C+%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BDi&select_table=f__sgrs&select_field=d.subgr_id&filt_dev=00-00' target='w1'>По пiдгрупах, контрольнi</a></li>
						<li><a href='../reports/f_m.php?title=%D0%94%D0%B5%D1%82%D0%B0%D0%BB%D1%8C%D0%BD%D0%B8%D0%B9%2C+%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BDi&filt_dev=00-00' target='w1'>Детальний, контрольнi</a></li>
					</ul>
				</div>
			</div>
			<div class='col span_2_of_3'>
				<div id='list'>
					<ul>
						<li><a href='../reports/f_mlact.php?title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+1&lact_restrict=1&filt_cowid=-1' target='w1'>Лактацiя 1</a></li>
						<li><a href='../reports/f_mlact.php?title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+2&lact_restrict=2&filt_cowid=-1' target='w1'>Лактацiя 2</a></li>
						<li><a href='../reports/f_mlact.php?title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+3&lact_restrict=3&filt_cowid=-1' target='w1'>Лактацiя 3</a></li>
						<li><a href='../reports/f_mlact.php?title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+4&lact_restrict=4&filt_cowid=-1' target='w1'>Лактацiя 4</a></li>
						<li><a href='../reports/f_mlact.php?title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+5&lact_restrict=5&filt_cowid=-1' target='w1'>Лактацiя 5</a></li>
						<li><a href='../reports/f_mlact.php?title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+6&lact_restrict=6&filt_cowid=-1' target='w1'>Лактацiя 6</a></li>
						<li><a href='../reports/f_mlact.php?title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+7&lact_restrict=7&filt_cowid=-1' target='w1'>Лактацiя 7</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class='col span_2_of_2'>
		<div id='list'>
			<ul>
				<li class='caption'>Фільтри звіту:</li>
				<li class='caption'><font color='#009955'>за часом доїння:</font></li>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 1 )' id='_10'>ранкове</li></label>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 2 )' id='_11'>2</li></label><br>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 4 )' id='_20'>денне</li></label>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 8 )' id='_21'>4</li></label><br>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 16 )' id='_30'>вечiрне</li></label>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 32 )' id='_31'>6</li></label>
				<li class='caption'><font color='#009955'>за розпізнаванням тварин:</font></li>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 64 )' id='_knowntag'>з зареєстр. RFID</li></label><br>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 128 )' id='_unknowntag'>з невiдомим RFID</li></label><br>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 256 )' id='_notag'>без RFID або збій</li></label>
				<li class='caption'><font color='#009955'>за станом тварин:</font></li>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 512 )' id='_mast'>з маститом</li></label>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 1024 )' id='_nomast'>без маститу</li></label><br>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 2048 )' id='_trau'>травмовані</li></label>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 4096 )' id='_notrau'>нетравмовані</li></label><br>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 8192 )' id='_ovul'>"в охоті"</li></label>
				<label><li class='li'><input checked class='z_chk' type='checkbox' onclick='do_setmilkfiltcoo( 16384 )' id='_noovul'>не "в охоті"</li></label>
				<li class='caption'><font color='#009955'>за перелiком тварин:</font></li>
				<label>
					<li class='li'>
						<select class='sel' style='background:#cacaca; margin-left:4px; width:100px' onclick='CookieSet( "r_filts1", this.value )'>
							<option value='-1%-1%-1%-1' selected >* ПОВНИЙ *</option>
							<option value='1%-1%-1%-1' >-</option>
							<option value='' disabled>* * * * * * * *</option>
							<option value='-1%1%-1%-1' >-</option>
						</select>
					</li>
				</label>
				<li class='caption'><font color='#009955'>за блоком доїння:</font></li>
				<label><li class='li'>&nbsp;від:<input class='txt' id='_bd_first' maxlength='2' style='background:#cacaca; margin-left:4px; width:30px' type='text' value='' onkeyup='do_setmilkfiltXcoo( "_filts_devf", this.value )'></li></label>
				<label><li class='li'>&nbsp;до:<input class='txt' id='_bd_last' maxlength='2' style='background:#cacaca; margin-left:4px; width:30px' type='text' value='' onkeyup='do_setmilkfiltXcoo( "_filts_devl", this.value )'></li></label>
			</ul>
		</div>
	</div>
</div>

</body>
</html>