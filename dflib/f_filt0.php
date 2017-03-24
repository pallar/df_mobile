<?php
/* DF_2: dflib/f_filt0.php
filter: filter for cows status (read)
c: 01.12.2011
m: 24.03.2017 */

$_filts0=CookieGet( "_filts0" )*1;
$filts0=$_filts0;
if (( $filts0&1 )==1 ) $filts0_1="checked"; else $filts0_1="";
if (( $filts0&2 )==2 ) $filts0_2="checked"; else $filts0_2="";
if (( $filts0&4 )==4 ) $filts0_3="checked"; else $filts0_3="";
if (( $filts0&8 )==8 ) $filts0_4="checked"; else $filts0_4="";
if (( $filts0&16 )==16 ) $filts0_5="checked"; else $filts0_5="";
if (( $filts0&32 )==32 ) $filts0_6="checked"; else $filts0_6="";

$_filts9=CookieGet( "_filts9" )*1;
$filts9=$_filts9;
if (( $filts9&1 )==1 ) $filts9_1="checked"; else $filts9_1="";
if (( $filts9&2 )==2 ) $filts9_2="checked"; else $filts9_2="";
if (( $filts9&4 )==4 ) $filts9_3="checked"; else $filts9_3="";
if (( $filts9&8 )==8 ) $filts9_4="checked"; else $filts9_4="";
if (( $filts9&16 )==16 ) $filts9_5="checked"; else $filts9_5="";
if (( $filts9&32 )==32 ) $filts9_6="checked"; else $filts9_6="";
?>
