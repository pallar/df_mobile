<?php
// --phpMyAdmin SQL Dump
// --version 2.6.1
// --http://www.phpmyadmin.net
// --
// --m: 14.11.2015
// --PHP: 5.2.4

//DON'T TOUCH THIS SCRIPT! IT'S NOT FOR MODIFICATION!
//IF THIS SCRIPT WILL BE MODIFIED, YOU CAN BREAK DATABASE!

if ( $skip_PASSW!=1 ) {
	$passw=$_GET["20095230"]; if ( $passw!="20095230" ) { echo "ACCESS DENIED!"; return; }
}

include_once( "../f_vars.php" );
include_once( "../dflib/f_func.php" );

mysql_query( "UPDATE $globals SET language='uk'" );

// ----------------------------------------------------------
mysql_query( "UPDATE $person SET
 nick='root', comments='сервіс' WHERE id=1" );
mysql_query( "UPDATE $person SET
 nick='admin', comments='адмін' WHERE id=2" );
mysql_query( "UPDATE $person SET
 nick='operator', comments='оператор' WHERE id=3" );
mysql_query( "UPDATE $person SET
 nick='anonymous', comments='гість' WHERE id=9" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xfuncs SET
 national_descr='00. -', nick='00. -', comments='*' WHERE id=1" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='01. селекц. ядро (СЯ)', nick='01. селекц. ядро (СЯ)', comments='СЯ' WHERE id=2" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='02. селекц. ядро 1 (СЯ1)', nick='02. селекц. ядро 1 (СЯ1)', comments='СЯ1' WHERE id=3" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='03. селекц. ядро 2 (СЯ2)', nick='03. селекц. ядро 2 (СЯ2)', comments='СЯ2' WHERE id=4" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='04. виробнича група (ВГ)', nick='04. виробнича група (ВГ)', comments='ВГ' WHERE id=5" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='05. вибракування, виранжування (Б)', nick='05. вибракування, виранжування (Б)', comments='Б' WHERE id=6" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='06. ремонтні телиці (РТ)', nick='06. ремонтні телиці (РТ)', comments='РТ' WHERE id=7" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='07. племінні бугайці (ПБ)', nick='07. племінні бугайці (ПБ)', comments='ПБ' WHERE id=8" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='08. телиці для реалізації (ТР)', nick='08. телиці для реалізації (ТР)', comments='ТР' WHERE id=9" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='09. бугайці та телиці для відгодівлі (В)', nick='09. бугайці та телиці для відгодівлі (В)', comments='В' WHERE id=10" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xraces SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xraces SET
 national_descr='чисто-породна (ЧП)', nick='чисто-породна (ЧП)', comments='ЧП' WHERE id=2" );
mysql_query( "UPDATE $xraces SET
 national_descr='1 (I)', nick='1 (I)', comments='1 (I)' WHERE id=3" );
mysql_query( "UPDATE $xraces SET
 national_descr='2 (II)', nick='2 (II)', comments='2 (II)' WHERE id=4" );
mysql_query( "UPDATE $xraces SET
 national_descr='3 (III)', nick='3 (III)', comments='3 (III)' WHERE id=5" );
mysql_query( "UPDATE $xraces SET
 national_descr='4 (IV)', nick='4 (IV)', comments='4 (IV)' WHERE id=6" );
mysql_query( "UPDATE $xraces SET
 national_descr='помісь (П)', nick='помісь (П)', comments='П' WHERE id=9" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xclasses SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xclasses SET
 national_descr='еліта-рекорд (ЕР)', nick='еліта-рекорд (ЕР)', comments='ЕР' WHERE id=2" );
mysql_query( "UPDATE $xclasses SET
 national_descr='еліта (Е)', nick='еліта (Е)', comments='Е' WHERE id=3" );
mysql_query( "UPDATE $xclasses SET
 national_descr='перший кл. (1КЛ)', nick='перший кл. (1КЛ)', comments='1КЛ' WHERE id=4" );
mysql_query( "UPDATE $xclasses SET
 national_descr='другий кл. (2КЛ)', nick='другий кл. (2КЛ)', comments='2КЛ' WHERE id=5" );
mysql_query( "UPDATE $xclasses SET
 national_descr='некласн. (НК)', nick='некласн. (НК)', comments='НК' WHERE id=6" );

// ----------------------------------------------------------
mysql_query( "UPDATE $breeds SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рДат', nick='датська чорно-ряба', comments='Ч-рДат' WHERE id=2" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рЛит', nick='литовська чорно-ряба', comments='Ч-рЛит' WHERE id=3" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рЕст', nick='естонська чорно-ряба', comments='Ч-рЕст' WHERE id=4" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рШвд', nick='шведська чорно-ряба', comments='Ч-рШвд' WHERE id=5" );
mysql_query( "UPDATE $breeds SET
 national_descr='Айр', nick='айрширська', comments='Айр' WHERE id=6" );
mysql_query( "UPDATE $breeds SET
 national_descr='Дже', nick='джерсейська', comments='Дже' WHERE id=7" );
mysql_query( "UPDATE $breeds SET
 national_descr='Г', nick='голштинська', comments='Г' WHERE id=8" );
mysql_query( "UPDATE $breeds SET
 national_descr='Аа', nick='ангус', comments='Аа' WHERE id=9" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гер', nick='герефордська', comments='Гер' WHERE id=10" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гро', nick='гронінгенська', comments='Гро' WHERE id=11" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуКар', nick='карпатська бура', comments='БуКар' WHERE id=12" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуЛат', nick='латвійська бура', comments='БуЛат' WHERE id=13" );
mysql_query( "UPDATE $breeds SET
 national_descr='АскМя', nick='асканійська м`ясна', comments='АскМя' WHERE id=14" );
mysql_query( "UPDATE $breeds SET
 national_descr='Анг', nick='англерська (ангельнська)', comments='Анг' WHERE id=15" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуМо', nick='молочна бура', comments='БуМо' WHERE id=16" );
mysql_query( "UPDATE $breeds SET
 national_descr='ВолМя', nick='волинська м`ясна', comments='ВолМя' WHERE id=17" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гол', nick='голландська', comments='Гол' WHERE id=18" );
mysql_query( "UPDATE $breeds SET
 national_descr='Анг*Г', nick='англерська голштинізована', comments='Анг*Г' WHERE id=19" );
mysql_query( "UPDATE $breeds SET
 national_descr='БгУкр', nick='українська білоголова', comments='БгУкр' WHERE id=20" );
mysql_query( "UPDATE $breeds SET
 national_descr='Б-ф', nick='британо-фризька', comments='Б-ф' WHERE id=21" );
mysql_query( "UPDATE $breeds SET
 national_descr='Знм', nick='знаменська', comments='Знм' WHERE id=22" );
mysql_query( "UPDATE $breeds SET
 national_descr='Кос', nick='костромська', comments='Кос' WHERE id=23" );
mysql_query( "UPDATE $breeds SET
 national_descr='Леб', nick='лебединська', comments='Леб' WHERE id=24" );
mysql_query( "UPDATE $breeds SET
 national_descr='Леб*Г', nick='лебединська голштинізована', comments='Леб*Г' WHERE id=25" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеДат', nick='датська червона', comments='ЧеДат' WHERE id=26" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеДат*Г', nick='датська червона голштинізована', comments='ЧеДат*Г' WHERE id=27" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеЛит', nick='литовська червона', comments='ЧеЛит' WHERE id=28" );
mysql_query( "UPDATE $breeds SET
 national_descr='Лім', nick='лімузинська', comments='Лім' WHERE id=29" );
mysql_query( "UPDATE $breeds SET
 national_descr='Кіа', nick='кіанська', comments='Кіа' WHERE id=30" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеПол', nick='польська червона', comments='ЧеПол' WHERE id=31" );
mysql_query( "UPDATE $breeds SET
 national_descr='Че-рНім', nick='німецька червоно-ряба', comments='Че-рНім' WHERE id=32" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеСтп', nick='степова червона', comments='ЧеСтп' WHERE id=33" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеСтп*Г', nick='степова червона голштинізована', comments='ЧеСтп*Г' WHERE id=34" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеЕст', nick='естонська червона', comments='ЧеЕст' WHERE id=35" );
mysql_query( "UPDATE $breeds SET
 national_descr='Мбл', nick='монбельярська', comments='Мбл' WHERE id=36" );
mysql_query( "UPDATE $breeds SET
 national_descr='П`е', nick='п`ємонтезька', comments='П`є' WHERE id=37" );
mysql_query( "UPDATE $breeds SET
 national_descr='М-а', nick='мен-анжу', comments='М-а' WHERE id=38" );
mysql_query( "UPDATE $breeds SET
 national_descr='РНім', nick='німецька ряба', comments='РНім' WHERE id=39" );
mysql_query( "UPDATE $breeds SET
 national_descr='ПлсМя', nick='поліський м`ясний тип', comments='ПлсМя' WHERE id=40" );
mysql_query( "UPDATE $breeds SET
 national_descr='МісП', nick='місцева поліпшена', comments='МісП' WHERE id=41" );
mysql_query( "UPDATE $breeds SET
 national_descr='Пц', nick='пінцгау', comments='Пц' WHERE id=42" );
mysql_query( "UPDATE $breeds SET
 national_descr='Сим', nick='симентальська', comments='Сим' WHERE id=43" );
mysql_query( "UPDATE $breeds SET
 national_descr='СвАкв', nick='світла аквітанська', comments='СвАкв' WHERE id=44" );
mysql_query( "UPDATE $breeds SET
 national_descr='С-г', nick='санта-гертруда', comments='С-г' WHERE id=45" );
mysql_query( "UPDATE $breeds SET
 national_descr='СимМя', nick='симентальська м`ясна', comments='СимМя' WHERE id=46" );
mysql_query( "UPDATE $breeds SET
 national_descr='СіУкр', nick='українська сіра', comments='СіУкр' WHERE id=47" );
mysql_query( "UPDATE $breeds SET
 national_descr='Хол', nick='холмогорська', comments='Хол' WHERE id=48" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рУкр', nick='українська чорно-ряба', comments='Ч-рУкр' WHERE id=49" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеМоУкр', nick='українська червона молочна', comments='ЧеМоУкр' WHERE id=50" );
mysql_query( "UPDATE $breeds SET
 national_descr='Че-рУкр', nick='українська червоно-ряба', comments='Че-рУкр' WHERE id=51" );
mysql_query( "UPDATE $breeds SET
 national_descr='УкрМя', nick='українська м`ясна', comments='УкрМя' WHERE id=52" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шві', nick='швіц', comments='Шві' WHERE id=53" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шві*Г', nick='швіц голштинізований', comments='Шві*Г' WHERE id=54" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шар', nick='шароле', comments='Шар' WHERE id=55" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шор', nick='шортгорн', comments='Шор' WHERE id=56" );

// ----------------------------------------------------------
mysql_query( "UPDATE $departs SET
 code='F0000', nick='-', comments='' WHERE id=1" );
mysql_query( "UPDATE $departs SET
 code='F00-1', nick='запліднена', comments='не відображається в переліку переведень, служб.' WHERE id=2" );
mysql_query( "UPDATE $departs SET
 code='F00-2', nick='тільна', comments='не відображається в переліку переведень, служб.' WHERE id=3" );
mysql_query( "UPDATE $departs SET
 code='F0001', nick='отелення', comments='' WHERE id=4" );
mysql_query( "UPDATE $departs SET
 code='F0002', nick='в лактації', comments='' WHERE id=5" );
mysql_query( "UPDATE $departs SET
 code='F0003', nick='сухостій', comments='' WHERE id=6" );
mysql_query( "UPDATE $departs SET
 code='F0004', nick='на забій', comments='' WHERE id=7" );

// ----------------------------------------------------------
mysql_query( "UPDATE $states SET
 descr='невизначений', comments='*невизначений' WHERE id=1" );
mysql_query( "UPDATE $states SET
 descr='незадовільний', comments='*незадовільний' WHERE id=2" );
mysql_query( "UPDATE $states SET
 descr='задовільний', comments='*задовільний' WHERE id=4" );
mysql_query( "UPDATE $states SET
 descr='добрий', comments='*добрий' WHERE id=8" );
mysql_query( "UPDATE $states SET
 descr='відмінний', comments='*відмінний' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $results SET
 descr='нічого не робити', comments='*нічого не робити' WHERE id=1" );
mysql_query( "UPDATE $results SET
 descr='рекомендується лікувати', comments='*рекомендується лікувати' WHERE id=2" );
mysql_query( "UPDATE $results SET
 descr='лікувати', comments='*лікувати' WHERE id=4" );
mysql_query( "UPDATE $results SET
 descr='рекомендується списати', comments='*рекомендується списати' WHERE id=8" );
mysql_query( "UPDATE $results SET
 descr='cписати', comments='*cписати' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $pregnant SET
 descr='невизначений', comments='*невизначений' WHERE id=1" );
mysql_query( "UPDATE $pregnant SET
 descr='НЕТІЛЬНА', comments='*НЕТІЛЬНА' WHERE id=2" );
mysql_query( "UPDATE $pregnant SET
 descr='тільна', comments='*тільна' WHERE id=4" );

// ----------------------------------------------------------
mysql_query( "UPDATE $cows SET
 nick='- без RFID' WHERE id=1" );

// ----------------------------------------------------------
// --
// --
mysql_query( "UPDATE $oxes SET
 num='0', b_num='б/н', national_descr='б/н' WHERE id=1 " );

// ----------------------------------------------------------
mysql_query( "UPDATE $operstyp SET
 descr='-', comments='*-' WHERE id=0" );
mysql_query( "UPDATE $operstyp SET
 descr='доїння', comments='*доїння' WHERE id=1" );
mysql_query( "UPDATE $operstyp SET
 descr='аналіз молока', comments='*аналіз молока' WHERE id=2" );
mysql_query( "UPDATE $operstyp SET
 descr='виміри', comments='*виміри' WHERE id=4" );
mysql_query( "UPDATE $operstyp SET
 descr='догляд', comments='*догляд' WHERE id=8" );
mysql_query( "UPDATE $operstyp SET
 descr='вакцинація', comments='*вакцинація' WHERE id=32" );
mysql_query( "UPDATE $operstyp SET
 descr='переведення / списання', comments='*переведення / списання' WHERE id=64" );
mysql_query( "UPDATE $operstyp SET
 descr='запл. штучне', comments='*запл. штучне' WHERE id=128" );
mysql_query( "UPDATE $operstyp SET
 descr='запл.', comments='*запл.' WHERE id=256" );
mysql_query( "UPDATE $operstyp SET
 descr='ректальні', comments='*ректальні' WHERE id=512" );
mysql_query( "UPDATE $operstyp SET
 descr='аборт', comments='*аборт' WHERE id=1024" );
mysql_query( "UPDATE $operstyp SET
 descr='отел', comments='*отел' WHERE id=2048" );
mysql_query( "UPDATE $operstyp SET
 descr='планування доїнь', comments='*планування доїнь' WHERE id=8192" );
//LOCKED OPERATIONS
//mysql_query( "UPDATE $operstyp SET
// descr='запуск', comments='*запуск' WHERE id=4096" );
//LOCKED OPERATIONS

// ----------------------------------------------------------
mysql_query( "UPDATE $sessions SET
 name='ранкове', b='03:00' WHERE id=10" );
mysql_query( "UPDATE $sessions SET
 name='2', b='00:00' WHERE id=11" );
mysql_query( "UPDATE $sessions SET
 name='денне', b='12:00' WHERE id=20" );
mysql_query( "UPDATE $sessions SET
 name='4', b='00:00' WHERE id=21" );
mysql_query( "UPDATE $sessions SET
 name='вечірнє', b='18:00' WHERE id=30" );
mysql_query( "UPDATE $sessions SET
 name='6', b='00:00' WHERE id=31" );

mysql_close( $db );
?>
