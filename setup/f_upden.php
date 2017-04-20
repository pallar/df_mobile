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
	$passw=$_GET["20095230"]; if ( $passw!=="20095230" ) { echo "ACCESS DENIED!"; return; }
}

include_once( "../f_vars.php" );
include_once( "../dflib/f_func.php" );

mysql_query( "UPDATE $globals SET language='en'" );

// ----------------------------------------------------------
mysql_query( "UPDATE $person SET
 nick='root', comments='service' WHERE id=1" );
mysql_query( "UPDATE $person SET
 nick='admin', comments='admin' WHERE id=2" );
mysql_query( "UPDATE $person SET
 nick='operator', comments='operator' WHERE id=3" );
mysql_query( "UPDATE $person SET
 nick='anonymous', comments='anonymous' WHERE id=9" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xfuncs SET
 national_descr='00. -', nick='00. -', comments='*' WHERE id=1" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='01. breeding core (BC)', nick='01. breeding core (BC)', comments='BC' WHERE id=2" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='02. breeding core 1 (BC1)', nick='02. breeding core 1 (BC1)', comments='BC1' WHERE id=3" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='03. breeding core 2 (BC2)', nick='03. breeding core 2 (BC2)', comments='BC2' WHERE id=4" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='04. production group (PD)', nick='04. production group (PD)', comments='PD' WHERE id=5" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='05. culling, ranking (R)', nick='05. culling, ranking (R)', comments='R' WHERE id=6" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='06. repair heifers (RH)', nick='06. repair heifers (RH)', comments='RH' WHERE id=7" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='07. breeding bulls (BB)', nick='07. breeding bulls (BB)', comments='BB' WHERE id=8" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='08. heifers for sale (HfS)', nick='08. heifers for sale (HfS)', comments='HfS' WHERE id=9" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='09. bulls & heifers for fattening (BHfF)', nick='09. bulls & heifers for fattening (BHfF)', comments='BHfF' WHERE id=10" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xraces SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xraces SET
 national_descr='pure breed (PB)', nick='pure breed (PB)', comments='PB' WHERE id=2" );
mysql_query( "UPDATE $xraces SET
 national_descr='1 (I)', nick='1 (I)', comments='1 (I)' WHERE id=3" );
mysql_query( "UPDATE $xraces SET
 national_descr='2 (II)', nick='2 (II)', comments='2 (II)' WHERE id=4" );
mysql_query( "UPDATE $xraces SET
 national_descr='3 (III)', nick='3 (III)', comments='3 (III)' WHERE id=5" );
mysql_query( "UPDATE $xraces SET
 national_descr='4 (IV)', nick='4 (IV)', comments='4 (IV)' WHERE id=6" );
mysql_query( "UPDATE $xraces SET
 national_descr='crossbreed (CB)', nick='crossbreed (CB)', comments='CB' WHERE id=9" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xclasses SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xclasses SET
 national_descr='top elite (TE)', nick='top elite (TE)', comments='TE' WHERE id=2" );
mysql_query( "UPDATE $xclasses SET
 national_descr='elite (E)', nick='elite (E)', comments='E' WHERE id=3" );
mysql_query( "UPDATE $xclasses SET
 national_descr='first cl. (1CL)', nick='first cl. (1CL)', comments='1CL' WHERE id=4" );
mysql_query( "UPDATE $xclasses SET
 national_descr='second cl. (2CL)', nick='second cl. (2CL)', comments='2CL' WHERE id=5" );
mysql_query( "UPDATE $xclasses SET
 national_descr='out-of-class (o-CL)', nick='out-of-class (o-CL)', comments='o-CL' WHERE id=6" );

// ----------------------------------------------------------
mysql_query( "UPDATE $breeds SET
 national_descr='*0', nick='-', comments='*' WHERE id=1" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-пДат', nick='danish black-spotted', comments='Ч-пДат' WHERE id=2" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рЛит', nick='lituanian black-spotted', comments='Ч-рЛит' WHERE id=3" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рЕст', nick='estonian black-spotted', comments='Ч-рЕст' WHERE id=4" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рШвд', nick='swedish black-spotted', comments='Ч-рШвд' WHERE id=5" );
mysql_query( "UPDATE $breeds SET
 national_descr='Айр', nick='ayrshire', comments='Айр' WHERE id=6" );
mysql_query( "UPDATE $breeds SET
 national_descr='Дже', nick='jersey', comments='Дже' WHERE id=7" );
mysql_query( "UPDATE $breeds SET
 national_descr='Г', nick='holstein', comments='Г' WHERE id=8" );
mysql_query( "UPDATE $breeds SET
 national_descr='Аа', nick='angus', comments='Аа' WHERE id=9" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гер', nick='hereford', comments='Гер' WHERE id=10" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гро', nick='groningen', comments='Гро' WHERE id=11" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуКар', nick='carpatian brown', comments='БуКар' WHERE id=12" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуЛат', nick='latvian brown', comments='БуЛат' WHERE id=13" );
mysql_query( "UPDATE $breeds SET
 national_descr='АскМя', nick='askanian meaty', comments='АскМя' WHERE id=14" );
mysql_query( "UPDATE $breeds SET
 national_descr='Анг', nick='angelner', comments='Анг' WHERE id=15" );
mysql_query( "UPDATE $breeds SET
 national_descr='БуМо', nick='milky brown', comments='БуМо' WHERE id=16" );
mysql_query( "UPDATE $breeds SET
 national_descr='ВолМя', nick='volyn meaty', comments='ВолМя' WHERE id=17" );
mysql_query( "UPDATE $breeds SET
 national_descr='Гол', nick='dutch', comments='Гол' WHERE id=18" );
mysql_query( "UPDATE $breeds SET
 national_descr='Анг*Г', nick='angelner holstiened', comments='Анг*Г' WHERE id=19" );
mysql_query( "UPDATE $breeds SET
 national_descr='БгУкр', nick='ukrainian whitehead', comments='БгУкр' WHERE id=20" );
mysql_query( "UPDATE $breeds SET
 national_descr='Б-ф', nick='british-frisian', comments='Б-ф' WHERE id=21" );
mysql_query( "UPDATE $breeds SET
 national_descr='Знм', nick='znamenska', comments='Знм' WHERE id=22" );
mysql_query( "UPDATE $breeds SET
 national_descr='Кос', nick='kostromska', comments='Кос' WHERE id=23" );
mysql_query( "UPDATE $breeds SET
 national_descr='Леб', nick='lebebynska', comments='Леб' WHERE id=24" );
mysql_query( "UPDATE $breeds SET
 national_descr='Леб*Г', nick='lebedynska hosteined', comments='Леб*Г' WHERE id=25" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеДат', nick='dutch red', comments='ЧеДат' WHERE id=26" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеДат*Г', nick='dutch red holsteined', comments='ЧеДат*Г' WHERE id=27" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеЛит', nick='lituanian red', comments='ЧеЛит' WHERE id=28" );
mysql_query( "UPDATE $breeds SET
 national_descr='Лім', nick='limousin', comments='Лім' WHERE id=29" );
mysql_query( "UPDATE $breeds SET
 national_descr='Кіа', nick='kianska', comments='Кіа' WHERE id=30" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеПол', nick='polish red', comments='ЧеПол' WHERE id=31" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рНім', nick='german red-spotted', comments='Ч-рНім' WHERE id=32" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеСтп', nick='red steppe', comments='ЧеСтп' WHERE id=33" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеСтп*Г', nick='red steppe holsteined', comments='ЧеСтп*Г' WHERE id=34" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеЕст', nick='estonian red', comments='ЧеЕст' WHERE id=35" );
mysql_query( "UPDATE $breeds SET
 national_descr='Мбл', nick='montbéliard', comments='Мбл' WHERE id=36" );
mysql_query( "UPDATE $breeds SET
 national_descr='П`є', nick='piemonte', comments='П`є' WHERE id=37" );
mysql_query( "UPDATE $breeds SET
 national_descr='М-а', nick='maine-anjou', comments='М-а' WHERE id=38" );
mysql_query( "UPDATE $breeds SET
 national_descr='РНім', nick='german ripple', comments='РНім' WHERE id=39" );
mysql_query( "UPDATE $breeds SET
 national_descr='ПлсМя', nick='polish meaty type', comments='ПлсМя' WHERE id=40" );
mysql_query( "UPDATE $breeds SET
 national_descr='МісП', nick='improved local', comments='МісП' WHERE id=41" );
mysql_query( "UPDATE $breeds SET
 national_descr='Пц', nick='pintshau', comments='Пц' WHERE id=42" );
mysql_query( "UPDATE $breeds SET
 national_descr='Сим', nick='simental', comments='Сим' WHERE id=43" );
mysql_query( "UPDATE $breeds SET
 national_descr='СвАкв', nick='light aquitaine', comments='СвАкв' WHERE id=44" );
mysql_query( "UPDATE $breeds SET
 national_descr='С-г', nick='santa-gertrude', comments='С-г' WHERE id=45" );
mysql_query( "UPDATE $breeds SET
 national_descr='СимМя', nick='simmental meaty', comments='СимМя' WHERE id=46" );
mysql_query( "UPDATE $breeds SET
 national_descr='СіУкр', nick='ukrainian gray', comments='СіУкр' WHERE id=47" );
mysql_query( "UPDATE $breeds SET
 national_descr='Хол', nick='holmohorska', comments='Хол' WHERE id=48" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рУкр', nick='ukrainian black-spotted', comments='Ч-рУкр' WHERE id=49" );
mysql_query( "UPDATE $breeds SET
 national_descr='ЧеМоУкр', nick='ukrainian red milky', comments='ЧеМоУкр' WHERE id=50" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ч-рУкр', nick='ukrainian red-spotted', comments='Ч-рУкр' WHERE id=51" );
mysql_query( "UPDATE $breeds SET
 national_descr='УкрМя', nick='ukrainian meaty', comments='УкрМя' WHERE id=52" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шві', nick='schwyz', comments='Шві' WHERE id=53" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шві*Г', nick='schwyz holsteined', comments='Шві*Г' WHERE id=54" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шар', nick='charolais', comments='Шар' WHERE id=55" );
mysql_query( "UPDATE $breeds SET
 national_descr='Шор', nick='shorthorn', comments='Шор' WHERE id=56" );

// ----------------------------------------------------------
mysql_query( "UPDATE $departs SET
 code='F0000', nick='-', comments='' WHERE id=1" );
mysql_query( "UPDATE $departs SET
 code='F00-1', nick='fertilized', comments='not shown in transferring lists' WHERE id=2" );
mysql_query( "UPDATE $departs SET
 code='F00-2', nick='pregnant', comments='not shown in transferring lists' WHERE id=3" );
mysql_query( "UPDATE $departs SET
 code='F0001', nick='calving', comments='' WHERE id=4" );
mysql_query( "UPDATE $departs SET
 code='F0002', nick='at lactation', comments='' WHERE id=5" );
mysql_query( "UPDATE $departs SET
 code='F0003', nick='dry', comments='' WHERE id=6" );
mysql_query( "UPDATE $departs SET
 code='F0004', nick='to remove', comments='' WHERE id=7" );

// ----------------------------------------------------------
mysql_query( "UPDATE $states SET
 descr='undefined', comments='*undefined' WHERE id=1" );
mysql_query( "UPDATE $states SET
 descr='bad', comments='*bad' WHERE id=2" );
mysql_query( "UPDATE $states SET
 descr='satisfactorily', comments='*satisfactorily' WHERE id=4" );
mysql_query( "UPDATE $states SET
 descr='good', comments='*good' WHERE id=8" );
mysql_query( "UPDATE $states SET
 descr='excellent', comments='*excellent' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $results SET
 descr='nothing to do', comments='*nothing to do' WHERE id=1" );
mysql_query( "UPDATE $results SET
 descr='recommended to treat', comments='*recommended to treat' WHERE id=2" );
mysql_query( "UPDATE $results SET
 descr='to treat', comments='*to treat' WHERE id=4" );
mysql_query( "UPDATE $results SET
 descr='recommended to remove', comments='*recommended to remove' WHERE id=8" );
mysql_query( "UPDATE $results SET
 descr='to remove', comments='*to remove' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $pregnant SET
 descr='undefined', comments='*undefined' WHERE id=1" );
mysql_query( "UPDATE $pregnant SET
 descr='not PREGNANT', comments='*not PREGNANT' WHERE id=2" );
mysql_query( "UPDATE $pregnant SET
 descr='pregnant', comments='*pregnant' WHERE id=4" );

// ----------------------------------------------------------
mysql_query( "UPDATE $cows SET
 nick='- w/o RFID' WHERE id=1" );

// ----------------------------------------------------------
mysql_query( "UPDATE $oxes SET
 num='0', b_num='-', national_descr='-' WHERE id=1 " );

// ----------------------------------------------------------
mysql_query( "UPDATE $operstyp SET
 descr='-', comments='*-' WHERE id=0" );
mysql_query( "UPDATE $operstyp SET
 descr='milking', comments='*milking' WHERE id=1" );
mysql_query( "UPDATE $operstyp SET
 descr='milk analisys', comments='*milk analisys' WHERE id=2" );
mysql_query( "UPDATE $operstyp SET
 descr='measurements', comments='*measurements' WHERE id=4" );
mysql_query( "UPDATE $operstyp SET
 descr='care', comments='*care' WHERE id=8" );
mysql_query( "UPDATE $operstyp SET
 descr='vaccination', comments='*vaccination' WHERE id=32" );
mysql_query( "UPDATE $operstyp SET
 descr='transferring / removing', comments='*transferring / removing' WHERE id=64" );
mysql_query( "UPDATE $operstyp SET
 descr='impregnation. artificial', comments='*impregnation. artificial' WHERE id=128" );
mysql_query( "UPDATE $operstyp SET
 descr='impregnation.', comments='*impregnation.' WHERE id=256" );
mysql_query( "UPDATE $operstyp SET
 descr='rectal', comments='*rectal' WHERE id=512" );
mysql_query( "UPDATE $operstyp SET
 descr='abort', comments='*abort' WHERE id=1024" );
mysql_query( "UPDATE $operstyp SET
 descr='calving', comments='*calving' WHERE id=2048" );
mysql_query( "UPDATE $operstyp SET
 descr='milking planning', comments='*milking planning' WHERE id=8192" );
//LOCKED OPERATIONS
//mysql_query( "UPDATE $operstyp SET
// descr='запуск', comments='*запуск' WHERE id=4096" );
//LOCKED OPERATIONS

// ----------------------------------------------------------
mysql_query( "UPDATE $sessions SET
 name='morning', b='03:00' WHERE id=10" );
mysql_query( "UPDATE $sessions SET
 name='2', b='00:00' WHERE id=11" );
mysql_query( "UPDATE $sessions SET
 name='day', b='12:00' WHERE id=20" );
mysql_query( "UPDATE $sessions SET
 name='4', b='00:00' WHERE id=21" );
mysql_query( "UPDATE $sessions SET
 name='evening', b='18:00' WHERE id=30" );
mysql_query( "UPDATE $sessions SET
 name='6', b='00:00' WHERE id=31" );

mysql_close( $db );
?>
