<?php
$ANGULAR_IS_USED=1;
$HTML_COMMENT="<!-- DF_ajs: Reports Tab 5 (Diagrams) Form -->";
$HTML_TAG="<html ng-app='f_reps'>";

include( "../f_vars.php" );

$title="Звіти - Інтернет-Ферма";
$curr_app_tab=3; include "f_menu.php";
?>

<nav1>
	<div id='cssmenu'>
		<ul>
			<li><a href='f__reps1.php'><span>Молоко</span></a></li>
			<li><a href='f__reps2.php'><span>Управління стадом</span></a></li>
			<li><a href='f__reps3.php'><span>Загальні</span></a></li>
			<li><a href='f__reps4.php'><span>Здоров'я</span></a></li>
			<li class='active'><a href='f__reps5.php'><span>Графіки</span></a></li>
			<li class='last'><a href='f__reps6.php'><span>Експорт</span></a></li>
		</ul>
	</div>
</nav1>

<script>
var nav=document.getElementsByTagName( 'nav' );
var nav1=document.getElementsByTagName( 'nav1' );
do_nav();

function do_nav() {
	get_window_prop();
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
	childs=nav[0].children[0].children[0].childElementCount;
	childs1=nav1[0].children[0].children[0].childElementCount;
	if ( width>800 ) menu_li_style='inline-block'; else menu_li_style='none';
	for ( var i=0; i<childs; i++ ) nav[0].children[0].children[0].children[i].style.display=menu_li_style;
	for ( var i=0; i<childs1; i++ ) nav1[0].children[0].children[0].children[i].style.display=menu_li_style;
}
</script>
<div class='section group'>
	<div class='col span_1_of_2'>
		<div id='list'>
		<ul>
			<li><a href='../reports/f_mlact.php?graph=1&lact_restrict=1&filt_cowid=-1&title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+1' target='w1'>Лактацiя 1</a></li>
			<li><a href='../reports/f_mlact.php?graph=1&lact_restrict=2&filt_cowid=-1&title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+2' target='w1'>Лактацiя 2</a></li>
			<li><a href='../reports/f_mlact.php?graph=1&lact_restrict=3&filt_cowid=-1&title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+3' target='w1'>Лактацiя 3</a></li>
			<li><a href='../reports/f_mlact.php?graph=1&lact_restrict=4&filt_cowid=-1&title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+4' target='w1'>Лактацiя 4</a></li>
			<li><a href='../reports/f_mlact.php?graph=1&lact_restrict=5&filt_cowid=-1&title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+5' target='w1'>Лактацiя 5</a></li>
			<li><a href='../reports/f_mlact.php?graph=1&lact_restrict=6&filt_cowid=-1&title=%D0%9B%D0%B0%D0%BA%D1%82%D0%B0%D1%86i%D1%8F+6' target='w1'>Лактацiя 6</a></li>
		</ul>
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
