<?php
// m: 13.03.2018
include "../../f_vars0.php";
?>

<title>Интернет-Ферма. Инструкция. Доильный зал</title>
</head>
<?php
include "0_menuen.php";
?>
			<tr style='background:#f0ffff;' height='40'>
				<td colspan='6'>
					<div style='margin-left:7; margin-right:7;'><font size='+2'><b>Доильный зал</b></font></div>
				</td>
			</tr>
			</table>
		</div></div>
		<div id='content' style='background:#f0ffff; height:60%; overflow-y:auto;'><div style='margin-left:7; margin-right:7;'>
<p></p>
			<div style='float:left; margin:7;'><img border='0' src='files/301_00.jpg'></div>
<p>Доильный зал типа «Ёлочка» обеспечивает высокий уровень надёжности и стабильности, характеризуется комфортом для животных, а также безопасностью для оператора машинного доения. Широкая зона входа позволяет животным быстро и беспрепятственно входить в доильный зал. Входные ворота монтируются непосредственно за последним доильным местом и отвечают за хорошее позиционирование текущей группы животных в доильном зале. Остальные животные остаются в активной позиции ожидания.</p>
<b>Порядок работы:</b><br>
<p>Доение животных проводится партиями, величина которых отвечает количеству мест с одной стороны доильной ямы.</p>
			<div style='float:right; margin:7;'><img border='0' src='files/301_01.jpg'></div>
<p>Животные заходят на преддоильную площадку и ожидают пока оператор машинного доения откроет входные ворота. После их открытия система разпознавания начинает свою работу. Для каждого животного, проходящего через неё, считывается код транспондера и определяется его порядковый номер в очереди. После прохождения последнего животного входные ворота автоматически закрываются. В процессорный блок поступает информация о расположении животных в очереди. Через некоторое время на индикаторах доильных аппаратов этой стороны высвечиваются номера животных.</p>
<p>В это время оператор должен готовить животных к доению. Доение начинается с включения на аппарате режима доения. Сразу после этого на соски устанавливаются доильные стаканы. Некоторое время аппарат будет удерживать стаканы в поднятом состоянии, а затем опустит их вниз. Все дальнейшие действия доильный аппарат выволняет в автоматическом режиме. Далее оператор может приступать к подготовке следующего животного.</p>
<p>В процессе доения аппарат подсчитывает количество молока, а также анализирует интенсивность молокоотдачи. В зависимости от фазы доения и интенсивности молокотдачи доильный аппарат управляє алгоритмом работы пульсатора, клапаном `Массаж` и клапаном `Поддержка`. После завершения доения манипулятор автоматически снимает доильные стаканы, а доильный аппарат отправляет в процессорноый блок детальный отчёт с результатами доения.</p>
<p>После завершения доения всех животных данной стороны доильной ямы оператор открывает выходные ворота и выпускает животных, после чего закрывает выходные ворота, открывает входные ворота и впускает следующую партию животных.</p>
			<div style='float:right; margin:7;'><img border='0' src='files/301_02.jpg'></div>
<b>Нестандартные ситуации:</b><br>
<p><b>1. Неполная партия животных (меньше, чем количество доильных мест на данной стороне ямы)</b></p>
<p>В тех случаях, когда на одну сторону доильной ямы заходит неполная партия животных, система разпознавания в течение трёх минут ожидает следующее животное. При этом входные ворота остаются открытыми, а на индикаторах доильных аппаратов не появляются номера животных, уже стоящих на доильных местах. В это время оператор уже может начинать доение. В течение двух минут ещё можно загонять недостающих животных, однако в зоне трёх метров от входных ворот запрещено держать и не впускать животное. Через три минуты ожидания система распознавания закроет входные ворота, а в процессорный блок поступят коды транспондеров животных данной стороны доильной ямы.</p>
<p><b>2. Упал доильный аппарат или стакан</b></p>
<p>В этом случае оператор может принудительно остановить доильный аппарат, а затем снова запустить его и установить стаканы на соски. В случае, если эти действия оператор выполнит в течение 20 секунд с момента прерывания доения, процесс доения продолжается. В ином случае аппарат начнёт доение заново, а в процессорный блок будет отправлены результаты предыдущего доения.</p>
<p><b>3. Прерванное доение</b></p>
<p>Оператор может принудительно завершить доение, нажав на аппарате кнопку `Старт/Стоп`. В процессорный блок будут переданы результаты доения и сигнал, что доение было прервано.</p>
<b>Специальные индикаторы доильного аппарата:</b><br>
<p><b>1. Нет припуска</b></p>
<p>Если животное после начала доения в течение 30 секунд не дало ни одной порции молока, то доильный аппарат переводит цифровой индикатор в режим мигания (БД-05) или на аппарате мигает соответствующий светодиод (БД-06). Это означает, что животное тугодойное или больное, или плохо подготовлено к доению.</p>
<p><b>2. Низкий надой</b></p>
<p>Если надой животного упал более, чем на 20 % в сравнении с аналогичным (утренним, дневным, вечерним) за предыдущий день, то на доильном аппарате начинает мигать светодиод `Низкий надой`.</p>
<p><b>3. Доение запрещено</b></p>
<p>Если зоотехник в программе указал, что животное нельзя доить (например, у него мастит или животное лечат), а его загнали в доильный зал, то на доильном аппарате блокируется клавиатура и начинают мигать все светодиоды (БД-05) или светодиод `Запрещено доить` (БД-06).</p>
<p><b>4. Обследование на мастит</b></p>
<p>Если до начала доения персонал выполняет обследование на мастит, то на доильном аппарате можно внести результаты этого обследования по каждой четверти вымени отдельно с указанием степени мастита. Результаты обследования будут переданы в процессорный блок. Светодиод `Мастит` сигнализирует о проведённом обследовании или о том, что в программе животное уже помечено как маститное.</p>
<p><b>5. Травма</b></p>
<p>Если оператор машинного доения выявил травму животного, то он может сообщить об этом зоотехнику, нажав кнопку `Травма` во время доения. Этот сигнал будет записан в электронной карточке животного в процессорном блоке.</p>
<p><b>6. Охота</b></p>
<p>Если оператор машинного доения выявил соответствующее состояние животного, то он может сообщить об этом зоотехнику, нажав кнопку `Охота` во время доения. Этот сигнал будет записан в электронной карточке животного в процессорном блоке.</p>
		</div></div>
		<div id='page-clear'></div>
	</div>
	<div id='footer'><div style='margin-left:0; margin-right:0;'>
		<table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'>
		<tr background='files/menu.jpg'>
			<td></td>
		</tr>
		</table>
	</div></div>
</body>
</html>
