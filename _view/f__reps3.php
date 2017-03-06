<?php
?>
<!-- DF_ajs: Reports Tab 3 (Common) Form -->
<!DOCTYPE html>
<html>
<head>
<title>[2017:0303]&nbsp;Звіти - Інтернет-Ферма</title>
<?php
$curr_app_tab=3; include "f_menu.php";
?>

<nav1>
	<div id='cssmenu'>
		<ul>
			<li><a href='f__reps1.php'><span>Молоко</span></a></li>
			<li><a href='f__reps2.php'><span>Управління стадом</span></a></li>
			<li class='active'><a href='f__reps3.php'><span>Загальні</span></a></li>
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
	<div id='section group'>
		<div class='col span_1_of_3'>
		<div id='list'>
		<ul>
			<li class='caption'>ЗА СТАТУСОМ ТВАРИН</li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B5%D0%BB%D0%B8%D1%86%D1%96&sele_byState=A01' target='w1'>Телиці</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%9D%D0%B5%D1%82%D0%B5%D0%BB%D1%96&sele_byState=A02' target='w1'>Нетелі</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%9A%D0%BE%D1%80%D0%BE%D0%B2%D0%B8&sele_byState=A0' target='w1'>Корови</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8+%D0%B7+%D0%BD%D0%B5%D0%B2%D0%B8%D0%B7%D0%BD%D0%B0%D1%87%D0%B5%D0%BD%D0%B8%D0%BC+%D1%81%D1%82%D0%B0%D1%82%D1%83%D1%81%D0%BE%D0%BC&sele_byState=A**' target='w1'>Тварини з невизначеним статусом</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%9A%D0%BE%D1%80%D0%BE%D0%B2%D0%B8+%D0%B7%D0%B3%D1%96%D0%B4%D0%BD%D0%BE+%D0%B2%D1%96%D0%BA%D1%83%2C+%D0%B0%D0%BB%D0%B5+%D0%B1%D0%B5%D0%B7+%D0%BE%D1%82%D0%B5%D0%BB%D1%96%D0%B2&sele_byState=A0q' target='w1'>Корови згідно віку, але без отелів</a></li>
<!--			<li><a href='../reports/f_lcws3.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8%2C+%D1%8F%D0%BA%D0%B8%D1%85+%D0%BD%D0%B5+%D0%B7%D0%B0%D0%BA%D1%80i%D0%BF%D0%B8%D0%BB%D0%B8+%D0%B7%D0%B0+%D0%B2i%D0%B4%D0%B4i%D0%BB%D0%B5%D0%BD%D0%BD%D1%8F%D0%BC&sele_where=64&locate_where=64' target='w1'>Тварини, яких не закрiпили за вiддiленням</a></li>-->
			<li><a href='../reports/f_los.php?title=%D0%91%D0%B8%D0%BA%D0%B8' target='w1'>Бики</a></li>
			<li class='caption'>ЗА ВІКОМ ТВАРИН</li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B5%D0%BB%D0%B8%D1%86i+%D0%B4%D0%BE+7+%D0%B4%D0%BDi%D0%B2%2C+%D0%BD%D0%BE%D0%B2%D0%BE%D0%BD%D0%B0%D1%80%D0%BE%D0%B4%D0%B6%D0%B5%D0%BDi&sele_byAge=0:6' target='w1'>Телицi до 7 днiв, новонародженi</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B5%D0%BB%D0%B8%D1%86i+%D0%B4%D0%BE+14+%D0%B4%D0%BD%D1%96%D0%B2&sele_byAge=7:13' target='w1'>Телицi до 14 днів</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B5%D0%BB%D0%B8%D1%86i+%D0%B4%D0%BE+%D0%BFi%D0%B2%D1%80%D0%BE%D0%BA%D1%83+%28%D0%B4%D0%BE+183+%D0%B4%D0%BDi%D0%B2%29&sele_byAge=14:182' target='w1'>Телицi до пiвроку (до 183 днiв)</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B5%D0%BB%D0%B8%D1%86i+%D0%B4%D0%BE+%D1%80%D0%BE%D0%BA%D1%83+%28%D0%B4%D0%BE+365+%D0%B4%D0%BDi%D0%B2%29&sele_byAge=183:364' target='w1'>Телицi до року (до 365 днiв)</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8+%D0%B4%D0%BE+2%D1%85+%D1%80%D0%BE%D0%BAi%D0%B2+%28%D0%B4%D0%BE+730+%D0%B4%D0%BDi%D0%B2%29&sele_byAge=365:729' target='w1'>Тварини до 2х рокiв (до 730 днiв)</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8+%D0%B4%D0%BE+4%D1%85+%D1%80%D0%BE%D0%BAi%D0%B2+%28%D0%B4%D0%BE+1460+%D0%B4%D0%BDi%D0%B2%29&sele_byAge=730:1459' target='w1'>Тварини до 4х рокiв (до 1460 днiв)</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8+%D0%B4%D0%BE%D1%80%D0%BE%D1%81%D0%BB%D1%96&sele_byAge=1460:' target='w1'>Тварини дорослі</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%92%D1%81%D1%96+%D1%82%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8' target='w1'>Всі тварини</a></li>
		</ul>
		</div>
		</div>
		<div class='col span_2_of_3'>
		<div id='list'>
		<ul>
			<li class='caption'>ЗАГАЛОМ</li>
			<li><a href='../reports/f_lcws1.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8+%D1%82%D0%B0+%D1%97%D1%85+%D0%B2%D0%B8%D0%BCi%D1%80%D0%B8' target='w1'>Тварини та їх вимiри</a></li>
			<li><a href='../reports/f_lcws.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8%3A+%D0%BA%D0%B0%D1%80%D1%82%D0%BA%D0%B8' target='w1'>Тварини: картки</a></li>
			<li><a href='../reports/f_lcws9.php?title=%D0%A2%D0%B2%D0%B0%D1%80%D0%B8%D0%BD%D0%B8%3A+RFIDs' target='w1'>Тварини: RFIDs</a></li>
			<li><a href='../reports/f_ltgs.php?title=%D0%9D%D0%BE%D0%B2%D1%96+RFIDs' target='w1'>Нові RFIDs</a></li>
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