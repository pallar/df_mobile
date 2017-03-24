<?php
/* DF_2: reports/f__jfilt.php
report: set input filter for any report
c: 24.10.2007
m: 10.07.2015 */

include_once( "../locales/$lang/f_11._$lang" );

if ( $f__jfilt__mode!=0 ) {
	$li_before="<li class='caption'>"; $li_after="</li>";
	$cb_before="<label><li class='li'>"; $cb_after="</li></label>";
} else {
	$li_before="&nbsp;"; $li_after="";
	$cb_before="<label>&nbsp;"; $cb_after="</label>";
}

$j=1;
for ( $i=1; $i<16; $i++ ) {
	$_onclick[$i]=" onclick='do_setmilkfiltcoo( $j )'";
	$j=$j*2;
}

$boolean[0]="checked class='z_chk' type='checkbox'";
$boolean[1]="class='z_chk' type='checkbox'";

$_10=$boolean[$_10_restrict].$_onclick[1];
$_11=$boolean[$_11_restrict].$_onclick[2];
$_20=$boolean[$_20_restrict].$_onclick[3];
$_21=$boolean[$_21_restrict].$_onclick[4];
$_30=$boolean[$_30_restrict].$_onclick[5];
$_31=$boolean[$_31_restrict].$_onclick[6];

$_knowntag=$boolean[$_knowntag_restrict].$_onclick[7];
$_unknowntag=$boolean[$_unknowntag_restrict].$_onclick[8];
$_notag=$boolean[$_notag_restrict].$_onclick[9];

$_mast=$boolean[$_mast_restrict].$_onclick[10];
$_nomast=$boolean[$_nomast_restrict].$_onclick[11];
$_trau=$boolean[$_trau_restrict].$_onclick[12];
$_notrau=$boolean[$_notrau_restrict].$_onclick[13];
$_ovul=$boolean[$_ovul_restrict].$_onclick[14];
$_noovul=$boolean[$_noovul_restrict].$_onclick[15];

echo $li_before.$php_mm["_11_"].$li_after;
if ( $btnToPrn ) echo "&nbsp;<input class='btn gradient_0f0' id='refresh' style='width:121px' type='submit' value='".$php_mm["_com_accept_btn_"]."' onclick='do_reload();'>";
if ( $f__jfilt__mode==0 ) echo "<br>";
echo "
$li_before<font color='#009955'>".$php_mm["_11_gr1_"]."</font>$li_after";
echo "
$cb_before<input $_10 id='_10'>".$php_mm["_com_s10_"]."$cb_after
$cb_before<input $_11 id='_11'>".$php_mm["_com_s11_"].$cb_after;
if ( $f__jfilt__mode!=0 ) echo "<br>";
echo "
$cb_before<input $_20 id='_20'>".$php_mm["_com_s20_"]."$cb_after
$cb_before<input $_21 id='_21'>".$php_mm["_com_s21_"].$cb_after;
if ( $f__jfilt__mode!=0 ) echo "<br>";
echo "
$cb_before<input $_30 id='_30'>".$php_mm["_com_s30_"]."$cb_after
$cb_before<input $_31 id='_31'>".$php_mm["_com_s31_"].$cb_after;
if ( $f__jfilt__mode==0 ) echo "<br>";
echo "
$li_before<font color='#009955'>".$php_mm["_11_gr2_"]."</font>$li_after";
echo "
$cb_before<input $_knowntag id='_knowntag'>".$php_mm["_com_known_tag_"].$cb_after;
if ( $f__jfilt__mode!=0 ) echo "<br>";
echo "
$cb_before<input $_unknowntag id='_unknowntag'>".$php_mm["_com_unknown_tag_"].$cb_after;
if ( $f__jfilt__mode!=0 ) echo "<br>";
echo "
$cb_before<input $_notag id='_notag'>".$php_mm["_com_wo_tag_"].$cb_after;
if ( $f__jfilt__mode==0 ) echo "<br>";
echo "
$li_before<font color='#009955'>".$php_mm["_11_gr3_"]."</font>$li_after";
echo "
$cb_before<input $_mast id='_mast'>".$php_mm["_com_with_mastitus_"]."$cb_after
$cb_before<input $_nomast id='_nomast'>".$php_mm["_com_wo_mastitus_"].$cb_after;
if ( $f__jfilt__mode!=0 ) echo "<br>";
echo "
$cb_before<input $_trau id='_trau'>".$php_mm["_com_with_trauma_"]."$cb_after
$cb_before<input $_notrau id='_notrau'>".$php_mm["_com_wo_trauma_"].$cb_after;
if ( $f__jfilt__mode!=0 ) echo "<br>";
echo "
$cb_before<input $_ovul id='_ovul'>".$php_mm["_com_wanted_ox_"]."$cb_after
$cb_before<input $_noovul id='_noovul'>".$php_mm["_com_not_wanted_ox_"].$cb_after;
if ( $f__jfilt__mode==0 ) echo "<br>";
echo "
$li_before<font color='#009955'>".$php_mm["_11_gr4_"]."</font>$li_after";
$_filtsXmode="r";
if ( $f__jfilt__mode!=0 ) echo "$cb_before";
include( "../dflib/f_filt1a.php" );
if ( $f__jfilt__mode!=0 ) echo "$cb_after";
echo "
$li_before<font color='#009955'>".$php_mm["_11_gr5_"]."</font>$li_after";
echo "
$cb_before&nbsp;".$php_mm["_11_from"]."<input class='txt' id='_bd_first' maxlength='2' style='background:#cacaca; margin-left:4px; width:30px' type='text' value='$bd_first' onkeyup='do_setmilkfiltXcoo( \"_filts_devf\", this.value )'>$cb_after
$cb_before&nbsp;".$php_mm["_11_to"]."<input class='txt' id='_bd_last' maxlength='2' style='background:#cacaca; margin-left:4px; width:30px' type='text' value='$bd_last' onkeyup='do_setmilkfiltXcoo( \"_filts_devl\", this.value )'>$cb_after";
?>

<script language='JavaScript'>
function do_setmilkfiltcoo( ii ) {
	var c=window.document.cookie.split( ";" ); var clen=c.length;
	var ex=0; var i=0; var rep_filt=0;
	while ( i<clen ) {
		var s=c[i].split( "=" );
		if ( Trim( s[0] )=="rep-filt" ) {
			var rep_filt=Number( s[1] );
			var ex=1;
		}
		i++;
	}
	if (( rep_filt&ii )*1==ii ) ii=-ii;
	var rep_filt=rep_filt+ii;
	window.document.cookie="rep-filt="+rep_filt+";path=/";
}

function do_setmilkfiltXcoo( cname, cvalue ) {
	if ( cvalue.length<2 ) cvalue="0"+cvalue;
	window.document.cookie=cname+"="+cvalue+";path=/";
}
</script>
