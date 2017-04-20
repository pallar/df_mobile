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
	$passw=$_GET[20095230]; if ( $passw!="20095230" ) { echo "ACCESS DENIED!"; return; }
}

include_once( "../f_vars.php" );
include_once( "../dflib/f_func.php" );

mysql_query( "UPDATE $globals SET language='ru'" );

// ----------------------------------------------------------
mysql_query( "UPDATE $person SET
 nick='root', comments='сервис' WHERE id=1" );
mysql_query( "UPDATE $person SET
 nick='admin', comments='админ' WHERE id=2" );
mysql_query( "UPDATE $person SET
 nick='operator', comments='оператор' WHERE id=3" );
mysql_query( "UPDATE $person SET
 nick='anonymous', comments='гость' WHERE id=9" );

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
 national_descr='04. производств. группа (ПГ)', nick='04. производств. группа (ПГ)', comments='ПГ' WHERE id=5" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='05. выбраковка / выранжировка (Б)', nick='05. выбраковка / выранжировка (Б)', comments='Б' WHERE id=6" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='06. ремонтные тёлки (РТ)', nick='06. ремонтные тёлки (РТ)', comments='РТ' WHERE id=7" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='07. племенные бугаи (ПБ)', nick='07. племенные бугаи (ПБ)', comments='ПБ' WHERE id=8" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='08. тёлки на реализацию (ТР)', nick='08. тёлки на реализацию (ТР)', comments='ТР' WHERE id=9" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='09. бугаи и тёлки на откорм (О)', nick='09. бугаи и тёлки на откорм (О)', comments='О' WHERE id=10" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xraces SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xraces SET
 national_descr='чисто-породная (ЧП)', nick='чисто-породная (ЧП)', comments='ЧП' WHERE id=2" );
mysql_query( "UPDATE $xraces SET
 national_descr='1 (I)', nick='1 (I)', comments='1 (I)' WHERE id=3" );
mysql_query( "UPDATE $xraces SET
 national_descr='2 (II)', nick='2 (II)', comments='2 (II)' WHERE id=4" );
mysql_query( "UPDATE $xraces SET
 national_descr='3 (III)', nick='3 (III)', comments='3 (III)' WHERE id=5" );
mysql_query( "UPDATE $xraces SET
 national_descr='4 (IV)', nick='4 (IV)', comments='4 (IV)' WHERE id=6" );
mysql_query( "UPDATE $xraces SET
 national_descr='помесь (П)', nick='помесь (П)', comments='П' WHERE id=9" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xclasses SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xclasses SET
 national_descr='элита-рекорд (ЭР)', nick='элита-рекорд (ЭР)', comments='ЭР' WHERE id=2" );
mysql_query( "UPDATE $xclasses SET
 national_descr='элита (Э)', nick='элита (Э)', comments='Э' WHERE id=3" );
mysql_query( "UPDATE $xclasses SET
 national_descr='первый кл. (1КЛ)', nick='первый кл. (1КЛ)', comments='1КЛ' WHERE id=4" );
mysql_query( "UPDATE $xclasses SET
 national_descr='второй кл. (2КЛ)', nick='второй кл. (2КЛ)', comments='2КЛ' WHERE id=5" );
mysql_query( "UPDATE $xclasses SET
 national_descr='неклассн. (НК)', nick='неклассн. (НК)', comments='НК' WHERE id=6" );

// ----------------------------------------------------------
mysql_query( "UPDATE $breeds SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-пДат', nick='датская чёрно-пёстрая', comments='Ч-пДат' WHERE id=2" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-пЛит', nick='литовская чёрно-пёстрая', comments='Ч-пЛит' WHERE id=3" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-пЭст', nick='эстонская чёрно-пёстрая', comments='Ч-пЭст' WHERE id=4" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-пШвд', nick='шведская чёрно-пёстрая', comments='Ч-пШвд' WHERE id=5" );
mysql_query( "UPDATE $breeds SET
 national_descr='Айр', nick='айрширская', comments='Айр' WHERE id=6" );
mysql_query( "UPDATE $breeds SET
 national_descr='Дже', nick='джерсейская', comments='Дже' WHERE id=7" );
mysql_query( "UPDATE $breeds SET
 national_descr='Г', nick='голштинская', comments='Г' WHERE id=8" );
mysql_query( "UPDATE $breeds SET
 national_descr='Аа', nick='ангус', comments='Аа' WHERE id=9" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гер', nick='герефордская', comments='Гер' WHERE id=10" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гро', nick='гронингенская', comments='Гро' WHERE id=11" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуКар', nick='карпатская бурая', comments='БуКар' WHERE id=12" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуЛат', nick='латвийская бурая', comments='БуЛат' WHERE id=13" );
mysql_query( "UPDATE $breeds SET
 national_descr='АскМя', nick='асканийская мясная', comments='АскМя' WHERE id=14" );
mysql_query( "UPDATE $breeds SET
 national_descr='Анг', nick='англерская (ангельнская)', comments='Анг' WHERE id=15" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуМо', nick='молочная бурая', comments='БуМо' WHERE id=16" );
mysql_query( "UPDATE $breeds SET
 national_descr='ВолМя', nick='волынская мясная', comments='ВолМя' WHERE id=17" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гол', nick='голландская', comments='Гол' WHERE id=18" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ан*Г', nick='англерская голштинизованная', comments='Ан*Г' WHERE id=19" );
mysql_query( "UPDATE $breeds SET
 national_descr='БгУкр', nick='украинская белоголовая', comments='БгУкр' WHERE id=20" );
mysql_query( "UPDATE $breeds SET
 national_descr='Б-ф', nick='британо-фризская', comments='Б-ф' WHERE id=21" );
mysql_query( "UPDATE $breeds SET
 national_descr='Знм', nick='знаменская', comments='Знм' WHERE id=22" );
mysql_query( "UPDATE $breeds SET
 national_descr='Кос', nick='костромская', comments='Кос' WHERE id=23" );
mysql_query( "UPDATE $breeds SET
 national_descr='Леб', nick='лебединская', comments='Леб' WHERE id=24" );
mysql_query( "UPDATE $breeds SET
 national_descr='Леб*Г', nick='лебединская голштинизованная', comments='Леб*Г' WHERE id=25" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрДат', nick='датская красная', comments='КрДат' WHERE id=26" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрДат*Г', nick='датская красная голштинизованная', comments='КрДат*Г' WHERE id=27" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрЛит', nick='литовская красная', comments='КрЛит' WHERE id=28" );
mysql_query( "UPDATE $breeds SET
 national_descr='Лим', nick='лимузинская', comments='Лим' WHERE id=29" );
mysql_query( "UPDATE $breeds SET
 national_descr='Киа', nick='кианская', comments='Киа' WHERE id=30" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрПол', nick='польская красная', comments='КрПол' WHERE id=31" );
mysql_query( "UPDATE $breeds SET
 national_descr='Кр-пНем', nick='немецкая красно-пёстрая', comments='Кр-пНем' WHERE id=32" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрСтп', nick='степная красная', comments='КрСтп' WHERE id=33" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрСтп*Г', nick='степная красная голштинизованная', comments='КрСтп*Г' WHERE id=34" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрЭст', nick='эстонская красная', comments='КрЭст' WHERE id=35" );
mysql_query( "UPDATE $breeds SET
 national_descr='Мбл', nick='монбельярская', comments='Мбл' WHERE id=36" );
mysql_query( "UPDATE $breeds SET
 national_descr='Пье', nick='пьемонтская', comments='Пье' WHERE id=37" );
mysql_query( "UPDATE $breeds SET
 national_descr='М-а', nick='мен-анжу', comments='М-а' WHERE id=38" );
mysql_query( "UPDATE $breeds SET
 national_descr='ПНем', nick='немецкая пёстрая', comments='ПНем' WHERE id=39" );
mysql_query( "UPDATE $breeds SET
 national_descr='ПлсМя', nick='полесский мясной тип', comments='ПлсМя' WHERE id=40" );
mysql_query( "UPDATE $breeds SET
 national_descr='МесУ', nick='местная улучшенная', comments='МесУ' WHERE id=41" );
mysql_query( "UPDATE $breeds SET
 national_descr='Пц', nick='пинцгау', comments='Пц' WHERE id=42" );
mysql_query( "UPDATE $breeds SET
 national_descr='Сим', nick='симментальская', comments='Сим' WHERE id=43" );
mysql_query( "UPDATE $breeds SET
 national_descr='СвАкв', nick='светлая аквитанская', comments='СвАкв' WHERE id=44" );
mysql_query( "UPDATE $breeds SET
 national_descr='С-г', nick='санта-гертруда', comments='С-г' WHERE id=45" );
mysql_query( "UPDATE $breeds SET
 national_descr='СимМя', nick='симментальская мясная', comments='СимМя' WHERE id=46" );
mysql_query( "UPDATE $breeds SET
 national_descr='СеУкр', nick='украинская серая', comments='СеУкр' WHERE id=47" );
mysql_query( "UPDATE $breeds SET
 national_descr='Хол', nick='холмогорская', comments='Хол' WHERE id=48" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-пУкр', nick='украинская чёрно-пёстрая', comments='Ч-пУкр' WHERE id=49" );
mysql_query( "UPDATE $breeds SET
 national_descr='КрМоУкр', nick='украинская красная молочная', comments='КрМоУкр' WHERE id=50" );
mysql_query( "UPDATE $breeds SET
 national_descr='Кр-пУкр', nick='украинская красно-пёстрая', comments='Кр-пУкр' WHERE id=51" );
mysql_query( "UPDATE $breeds SET
 national_descr='УкрМя', nick='украинская мясная', comments='УкрМя' WHERE id=52" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шви', nick='швиц', comments='Шви' WHERE id=53" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шви*Г', nick='швиц голштинизованный', comments='Шви*Г' WHERE id=54" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шар', nick='шароле', comments='Шар' WHERE id=55" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шор', nick='шортгорн', comments='Шор' WHERE id=56" );

// ----------------------------------------------------------
mysql_query( "UPDATE $departs SET
 code='F0000', nick='-', comments='' WHERE id=1" );
mysql_query( "UPDATE $departs SET
 code='F00-1', nick='осеменённая', comments='не отображается в списке переводов, служебн.' WHERE id=2" );
mysql_query( "UPDATE $departs SET
 code='F00-2', nick='стельная', comments='не отображается в списке переводов, служебн.' WHERE id=3" );
mysql_query( "UPDATE $departs SET
 code='F0001', nick='отд. отёл', comments='' WHERE id=4" );
mysql_query( "UPDATE $departs SET
 code='F0002', nick='отд. в лактации', comments='' WHERE id=5" );
mysql_query( "UPDATE $departs SET
 code='F0003', nick='отд. сухостой', comments='' WHERE id=6" );
mysql_query( "UPDATE $departs SET
 code='F0004', nick='отд. на забой', comments='' WHERE id=7" );

// ----------------------------------------------------------
mysql_query( "UPDATE $states SET
 descr='неопред.', comments='*неопред.' WHERE id=1" );
mysql_query( "UPDATE $states SET
 descr='неудовлетв.', comments='*неудовлетв.' WHERE id=2" );
mysql_query( "UPDATE $states SET
 descr='удовлетв.', comments='*удовлетв.' WHERE id=4" );
mysql_query( "UPDATE $states SET
 descr='хорошее', comments='*хорошее' WHERE id=8" );
mysql_query( "UPDATE $states SET
 descr='отличное', comments='*отличное' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $results SET
 descr='ничего не делать', comments='*ничего не делать' WHERE id=1" );
mysql_query( "UPDATE $results SET
 descr='рекомендуется лечить', comments='*рекомендуется лечить' WHERE id=2" );
mysql_query( "UPDATE $results SET
 descr='лечить', comments='*лечить' WHERE id=4" );
mysql_query( "UPDATE $results SET
 descr='рекомендуется списать', comments='*рекомендуется списать' WHERE id=8" );
mysql_query( "UPDATE $results SET
 descr='cписать', comments='*cписать' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $pregnant SET
 descr='неопред.', comments='*неопред.' WHERE id=1" );
mysql_query( "UPDATE $pregnant SET
 descr='НЕСТЕЛЬНАЯ', comments='*НЕСТЕЛЬНАЯ' WHERE id=2" );
mysql_query( "UPDATE $pregnant SET
 descr='стельная', comments='*стельная' WHERE id=4" );

// ----------------------------------------------------------
mysql_query( "UPDATE $cows SET
 nick='- без RFID' WHERE id=1" );

// ----------------------------------------------------------
mysql_query( "UPDATE $oxes SET
 num='0', b_num='б/н', national_descr='б/н' WHERE id=1 " );

// ----------------------------------------------------------
mysql_query( "UPDATE $operstyp SET
 descr='-', comments='*-' WHERE id=0" );
mysql_query( "UPDATE $operstyp SET
 descr='доение', comments='*доение' WHERE id=1" );
mysql_query( "UPDATE $operstyp SET
 descr='анализ молока', comments='*анализ молока' WHERE id=2" );
mysql_query( "UPDATE $operstyp SET
 descr='измерения', comments='*измерения' WHERE id=4" );
mysql_query( "UPDATE $operstyp SET
 descr='осмотр', comments='*осмотр' WHERE id=8" );
mysql_query( "UPDATE $operstyp SET
 descr='вакцинация', comments='*вакцинация' WHERE id=32" );
mysql_query( "UPDATE $operstyp SET
 descr='перевод / списание', comments='*перевод / списание' WHERE id=64" );
mysql_query( "UPDATE $operstyp SET
 descr='осем. искусств.', comments='*осем. искусств.' WHERE id=128" );
mysql_query( "UPDATE $operstyp SET
 descr='осем.', comments='*осем.' WHERE id=256" );
mysql_query( "UPDATE $operstyp SET
 descr='ректальные', comments='*ректальные' WHERE id=512" );
mysql_query( "UPDATE $operstyp SET
 descr='аборт', comments='*аборт' WHERE id=1024" );
mysql_query( "UPDATE $operstyp SET
 descr='отёл', comments='*отёл' WHERE id=2048" );
mysql_query( "UPDATE $operstyp SET
 descr='план доений', comments='*план доений' WHERE id=8192" );
//LOCKED OPERATIONS
//mysql_query( "UPDATE $operstyp SET
// descr='запуск', comments='*запуск' WHERE id=4096" );
//LOCKED OPERATIONS

// ----------------------------------------------------------
mysql_query( "UPDATE $sessions SET
 name='утреннее', b='03:00' WHERE id=10" );
mysql_query( "UPDATE $sessions SET
 name='2', b='00:00' WHERE id=11" );
mysql_query( "UPDATE $sessions SET
 name='дневное', b='12:00' WHERE id=20" );
mysql_query( "UPDATE $sessions SET
 name='4', b='00:00' WHERE id=21" );
mysql_query( "UPDATE $sessions SET
 name='вечернее', b='18:00' WHERE id=30" );
mysql_query( "UPDATE $sessions SET
 name='6', b='00:00' WHERE id=31" );

mysql_close( $db );
?>
