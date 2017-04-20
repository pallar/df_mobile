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

mysql_query( "UPDATE $globals SET language='tr'" );

// ----------------------------------------------------------
mysql_query( "UPDATE $person SET
 nick='root', comments='servis' WHERE id=1" );
mysql_query( "UPDATE $person SET
 nick='admin', comments='admin' WHERE id=2" );
mysql_query( "UPDATE $person SET
 nick='operator', comments='operator' WHERE id=3" );
mysql_query( "UPDATE $person SET
 nick='anonymous', comments='misafir' WHERE id=9" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xfuncs SET
 national_descr='00. -', nick='00. -', comments='*' WHERE id=1" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='01. Nuve. seçim (NS)', nick='01. Nuve. seçim (NS)', comments='NC' WHERE id=2" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='02. Nuve. seçim 1 (NS1)', nick='02. Nuve. seçim 1 (NS1)', comments='NC1' WHERE id=3" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='03. Nuve. seçim 2 (NS2)', nick='03. Nuve. seçim 2 (NS2)', comments='NC2' WHERE id=4" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='04. Üretim. grup (ÜG)', nick='04. Üretim. grup (ÜG)', comments='ÜG' WHERE id=5" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='05. İtlaf (İ)', nick='05. İtlaf (İ)', comments='İ' WHERE id=6" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='06. Rekonstrüksiyon düveler (RD)', nick='06. Rekonstrüksiyon düveler (RD)', comments='RD' WHERE id=7" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='07. Damızlık boğalar (DB)', nick='07. Damızlık boğalar (DB)', comments='DB' WHERE id=8" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='08. Realize düveler (RD)', nick='08. Realize düveler (RD)', comments='RD' WHERE id=9" );
mysql_query( "UPDATE $xfuncs SET
 national_descr='09. Boğa ve düve besi için (B)', nick='09. Boğa ve düve besi için (B)', comments='B' WHERE id=10" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xraces SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xraces SET
 national_descr='saf cins (SC)', nick='saf cins (SC)', comments='SC' WHERE id=2" );
mysql_query( "UPDATE $xraces SET
 national_descr='1 (I)', nick='1 (I)', comments='1 (I)' WHERE id=3" );
mysql_query( "UPDATE $xraces SET
 national_descr='2 (II)', nick='2 (II)', comments='2 (II)' WHERE id=4" );
mysql_query( "UPDATE $xraces SET
 national_descr='3 (III)', nick='3 (III)', comments='3 (III)' WHERE id=5" );
mysql_query( "UPDATE $xraces SET
 national_descr='4 (IV)', nick='4 (IV)', comments='4 (IV)' WHERE id=6" );
mysql_query( "UPDATE $xraces SET
 national_descr='metis (M)', nick='metis (M)', comments='M' WHERE id=9" );

// ----------------------------------------------------------
mysql_query( "UPDATE $xclasses SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $xclasses SET
 national_descr='elit-rekord (ER)', nick='elit-rekord (ER)', comments='ER' WHERE id=2" );
mysql_query( "UPDATE $xclasses SET
 national_descr='elita (E)', nick='elita (E)', comments='E' WHERE id=3" );
mysql_query( "UPDATE $xclasses SET
 national_descr='1 tür. (1T)', nick='1 tür. (1T)', comments='1T' WHERE id=4" );
mysql_query( "UPDATE $xclasses SET
 national_descr='2 tür. (2T)', nick='2 tür. (2T)', comments='2T' WHERE id=5" );
mysql_query( "UPDATE $xclasses SET
 national_descr='türsüz. (TS)', nick='türsüz. (TS)', comments='TS' WHERE id=6" );

// ----------------------------------------------------------
mysql_query( "UPDATE $breeds SET
 national_descr='-', nick='-', comments='-' WHERE id=1" );
mysql_query( "UPDATE $breeds SET
 national_descr='DS-al', nick='danimarka siyah alacalı', comments='DS-al' WHERE id=2" );
mysql_query( "UPDATE $breeds SET
 national_descr='LS-al', nick='litvanyalı siyah alacalı', comments='LS-al' WHERE id=3" );
mysql_query( "UPDATE $breeds SET
 national_descr='ES-al', nick='estonya siyah alacalı', comments='ES-al' WHERE id=4" );
mysql_query( "UPDATE $breeds SET
 national_descr='İS-al', nick='isveçli siyah alacalı', comments='İS-al' WHERE id=5" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ayr', nick='ayrşire', comments='Ayr' WHERE id=6" );
mysql_query( "UPDATE $breeds SET
 national_descr='Cer', nick='cersiye', comments='Cer' WHERE id=7" );
mysql_query( "UPDATE $breeds SET
 national_descr='H', nick='holstein', comments='H' WHERE id=8" );
mysql_query( "UPDATE $breeds SET
 national_descr='Aa', nick='angus', comments='Aa' WHERE id=9" );
mysql_query( "UPDATE $breeds SET
 national_descr='Her', nick='hereford', comments='Her' WHERE id=10" );
mysql_query( "UPDATE $breeds SET
 national_descr='Gor', nick='gorningen', comments='Gor' WHERE id=11" );
mysql_query( "UPDATE $breeds SET
 national_descr='KKa', nick='karpat kahverengi', comments='KKa' WHERE id=12" );
mysql_query( "UPDATE $breeds SET
 national_descr='LKa', nick='letonyalı kahverengi', comments='LKa' WHERE id=13" );
mysql_query( "UPDATE $breeds SET
 national_descr='AskEt', nick='askanian etli', comments='AskEt' WHERE id=14" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ang', nick='angler', comments='Ang' WHERE id=15" );
mysql_query( "UPDATE $breeds SET
 national_descr='SüKa', nick='sütlü kahveyi', comments='SüKa' WHERE id=16" );
mysql_query( "UPDATE $breeds SET
 national_descr='VolEt', nick='volin etli', comments='VolEt' WHERE id=17" );
mysql_query( "UPDATE $breeds SET
 national_descr='Holl', nick='hollandalı', comments='Holl' WHERE id=18" );
mysql_query( "UPDATE $breeds SET
 national_descr='Ang*G', nick='angler golştinli', comments='Ang*G' WHERE id=19" );
mysql_query( "UPDATE $breeds SET
 national_descr='UkrBb', nick='ukraynalı beyazbaş', comments='UkrBb' WHERE id=20" );
mysql_query( "UPDATE $breeds SET
 national_descr='B-F', nick='britano-frizce', comments='B-F' WHERE id=21" );
mysql_query( "UPDATE $breeds SET
 national_descr='Znm', nick='znamenli', comments='Znm' WHERE id=22" );
mysql_query( "UPDATE $breeds SET
 national_descr='Kos', nick='kostromlı', comments='Kos' WHERE id=23" );
mysql_query( "UPDATE $breeds SET
 national_descr='Leb', nick='lebedli', comments='Leb' WHERE id=24" );
mysql_query( "UPDATE $breeds SET
 national_descr='Leb*G', nick='lebedli golştinli', comments='Leb*G' WHERE id=25" );
mysql_query( "UPDATE $breeds SET
 national_descr='DanKı', nick='danimarka kırmızı', comments='DanKı' WHERE id=26" );
mysql_query( "UPDATE $breeds SET
 national_descr='DanKı*G', nick='danimarka kırmızı golştinli', comments='DanKı*G' WHERE id=27" );
mysql_query( "UPDATE $breeds SET
 national_descr='LitKı', nick='litvanyalı kırmızı', comments='LitKı' WHERE id=28" );
mysql_query( "UPDATE $breeds SET
 national_descr='Lim', nick='limusin', comments='Lim' WHERE id=29" );
mysql_query( "UPDATE $breeds SET
 national_descr='Kia', nick='kianalı', comments='Kia' WHERE id=30" );
mysql_query( "UPDATE $breeds SET
 national_descr='LehKı', nick='lehçe kırmızı', comments='LehKı' WHERE id=31" );
mysql_query( "UPDATE $breeds SET
 national_descr='AlmKı-al', nick='alman kırmızı alacalı', comments='AlmKı-al' WHERE id=32" );
mysql_query( "UPDATE $breeds SET
 national_descr='BozKı', nick='bozkır kırmızı', comments='BozKı' WHERE id=33" );
mysql_query( "UPDATE $breeds SET
 national_descr='BozKı*G', nick='bozkir kırmızı golştinli', comments='BozKı*G' WHERE id=34" );
mysql_query( "UPDATE $breeds SET
 national_descr='EstKı', nick='estonya kırmızı', comments='EstKı' WHERE id=35" );
mysql_query( "UPDATE $breeds SET
 national_descr='Mbl', nick='monbelrli', comments='Mbl' WHERE id=36" );
mysql_query( "UPDATE $breeds SET
 national_descr='Pie', nick='piemonte', comments='Pie' WHERE id=37" );
mysql_query( "UPDATE $breeds SET
 national_descr='M-a', nick='men-anju', comments='M-a' WHERE id=38" );
mysql_query( "UPDATE $breeds SET
 national_descr='AlmR', nick='almanca rengarenk', comments='AlmR' WHERE id=39" );
mysql_query( "UPDATE $breeds SET
 national_descr='PolEtT', nick='polesie et türü', comments='PolEtT' WHERE id=40" );
mysql_query( "UPDATE $breeds SET
 national_descr='Yerİ', nick='yerli iyili', comments='Yer.İ' WHERE id=41" );
mysql_query( "UPDATE $breeds SET
 national_descr='Pg', nick='pinsgau', comments='Pg' WHERE id=42" );
mysql_query( "UPDATE $breeds SET
 national_descr='Sim', nick='simmental', comments='Sim' WHERE id=43" );
mysql_query( "UPDATE $breeds SET
 national_descr='ParAkit', nick='parlak akitanya', comments='ParAkit' WHERE id=44" );
mysql_query( "UPDATE $breeds SET
 national_descr='S-G', nick='santa gertrudis', comments='S-G' WHERE id=45" );
mysql_query( "UPDATE $breeds SET
 national_descr='SimEt', nick='simmental et', comments='SimEt' WHERE id=46" );
mysql_query( "UPDATE $breeds SET
 national_descr='UkrGri', nick='ukraynalı grisi', comments='UkrGri' WHERE id=47" );
mysql_query( "UPDATE $breeds SET
 national_descr='Xol', nick='xolmolu', comments='Xol' WHERE id=48" );
mysql_query( "UPDATE $breeds SET
 national_descr='UkrS-al', nick='ukrayna siyah alacalı', comments='UkrS-al' WHERE id=49" );
mysql_query( "UPDATE $breeds SET
 national_descr='UkrKıSü', nick='ukraynalı kırmızı sütü', comments='UkrKıSü' WHERE id=50" );
mysql_query( "UPDATE $breeds SET
 national_descr='UkrKı-al', nick='ukraynalı kırmızı alacalı', comments='UkrKı-al' WHERE id=51" );
mysql_query( "UPDATE $breeds SET
 national_descr='UkrEt', nick='ukraynalı etli', comments='UkrEt' WHERE id=52" );
mysql_query( "UPDATE $breeds SET
 national_descr='Şvi', nick='şvis', comments='Şvi' WHERE id=53" );
mysql_query( "UPDATE $breeds SET
 national_descr='Şvi*G', nick='şvis golştinli', comments='Şvi*G' WHERE id=54" );
mysql_query( "UPDATE $breeds SET
 national_descr='Şar', nick='şarol', comments='Şar' WHERE id=55" );
mysql_query( "UPDATE $breeds SET
 national_descr='Şor', nick='şorhorn', comments='Şor' WHERE id=56" );

// ----------------------------------------------------------
mysql_query( "UPDATE $departs SET
 code='F0000', nick='-', comments='' WHERE id=1" );
mysql_query( "UPDATE $departs SET
 code='F00-1', nick='tohumlama', comments='transferi listesinde görünmüyor' WHERE id=2" );
mysql_query( "UPDATE $departs SET
 code='F00-2', nick='dana', comments='transferi listesinde görünmüyor' WHERE id=3" );
mysql_query( "UPDATE $departs SET
 code='F0001', nick='buzağılama.', comments='' WHERE id=4" );
mysql_query( "UPDATE $departs SET
 code='F0002', nick='laktasyon', comments='' WHERE id=5" );
mysql_query( "UPDATE $departs SET
 code='F0003', nick='yararsız', comments='' WHERE id=6" );
mysql_query( "UPDATE $departs SET
 code='F0004', nick='et kesimi', comments='' WHERE id=7" );

// ----------------------------------------------------------
mysql_query( "UPDATE $states SET
 descr='tanımsız.', comments='*tanımsız.' WHERE id=1" );
mysql_query( "UPDATE $states SET
 descr='yetersiz.', comments='*yetersiz.' WHERE id=2" );
mysql_query( "UPDATE $states SET
 descr='yeterli.', comments='*yeterli.' WHERE id=4" );
mysql_query( "UPDATE $states SET
 descr='İyi', comments='*iyi' WHERE id=8" );
mysql_query( "UPDATE $states SET
 descr='mükemmel', comments='*mükemmel' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $results SET
 descr='hiçbir şey yapmamak', comments='*hiçbir şey yapmamak' WHERE id=1" );
mysql_query( "UPDATE $results SET
 descr='tedavi etmek için tavsiye edilir', comments='*tedavi etmek için tavsiye edilir' WHERE id=2" );
mysql_query( "UPDATE $results SET
 descr='tedavi', comments='*tedaviь' WHERE id=4" );
mysql_query( "UPDATE $results SET
 descr='silmeyi tavsiye edilir', comments='*silmeyi tavsiye edilir' WHERE id=8" );
mysql_query( "UPDATE $results SET
 descr='silnme', comments='*silinme' WHERE id=16" );

// ----------------------------------------------------------
mysql_query( "UPDATE $pregnant SET
 descr='tanımsız.', comments='*tanımsız.' WHERE id=1" );
mysql_query( "UPDATE $pregnant SET
 descr='GEBE OLMAYAN', comments='*GEBE OLMAYAN' WHERE id=2" );
mysql_query( "UPDATE $pregnant SET
 descr='buzağı inek', comments='*buzağı inek' WHERE id=4" );

// ----------------------------------------------------------
mysql_query( "UPDATE $cows SET
 nick='- kartsız-radioident.' WHERE id=1" );

// ----------------------------------------------------------
mysql_query( "UPDATE $oxes SET
 num='0', b_num='-', national_descr='-' WHERE id=1 " );

// ----------------------------------------------------------
mysql_query( "UPDATE $operstyp SET
 descr='-', comments='*-' WHERE id=0" );
mysql_query( "UPDATE $operstyp SET
 descr='sağım', comments='*sağım' WHERE id=1" );
mysql_query( "UPDATE $operstyp SET
 descr='süt analizi', comments='*süt analizi' WHERE id=2" );
mysql_query( "UPDATE $operstyp SET
 descr='ölçme', comments='*ölçme' WHERE id=4" );
mysql_query( "UPDATE $operstyp SET
 descr='müayine', comments='*müayine' WHERE id=8" );
mysql_query( "UPDATE $operstyp SET
 descr='vaksinasyon', comments='*vaksinasyon' WHERE id=32" );
mysql_query( "UPDATE $operstyp SET
 descr='köçme / silme', comments='*köçme / silme' WHERE id=64" );
mysql_query( "UPDATE $operstyp SET
 descr='tohum. yapay.', comments='*tohum. yapay.' WHERE id=128" );
mysql_query( "UPDATE $operstyp SET
 descr='tohum.', comments='*tohum.' WHERE id=256" );
mysql_query( "UPDATE $operstyp SET
 descr='rektal', comments='*rektal' WHERE id=512" );
mysql_query( "UPDATE $operstyp SET
 descr='abort', comments='*abort' WHERE id=1024" );
mysql_query( "UPDATE $operstyp SET
 descr='buzağılama', comments='*buzağılama' WHERE id=2048" );
mysql_query( "UPDATE $operstyp SET
 descr='sağım planı', comments='*sağım planı' WHERE id=8192" );
//LOCKED OPERATIONS
//mysql_query( "UPDATE $operstyp SET
// descr='start', comments='*start' WHERE id=4096" );
//LOCKED OPERATIONS

// ----------------------------------------------------------
mysql_query( "UPDATE $sessions SET
 name='sabah', b='03:00' WHERE id=10" );
mysql_query( "UPDATE $sessions SET
 name='2', b='00:00' WHERE id=11" );
mysql_query( "UPDATE $sessions SET
 name='gün', b='12:00' WHERE id=20" );
mysql_query( "UPDATE $sessions SET
 name='4', b='00:00' WHERE id=21" );
mysql_query( "UPDATE $sessions SET
 name='akşam', b='18:00' WHERE id=30" );
mysql_query( "UPDATE $sessions SET
 name='6', b='00:00' WHERE id=31" );

mysql_close( $db );
?>
