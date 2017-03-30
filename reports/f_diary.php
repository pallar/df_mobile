<?php
/* DF_2: reports/f_diary.php
report: todo_diary
c: 22.11.2007
m: 30.03.2017 */
?>

<script language='JavaScript'>
function do_setdiarycoo( ii ) {
	var c=window.document.cookie.split( ";" ); var clen=c.length;
	var ex=0, i=0, diary_sel=0;
	while ( i<clen ) {
		var s=c[i].split( "=" );
		if ( Trim( s[0] )=="diary-sel" ) {
			var diary_sel=Number( s[1] );
			var ex=1;
		}
		i++;
	}
	for ( k=10; k<=ii; k++ ) {
		if ( k==10 ) var jj=1; else var jj=jj*2;
	}
	el='cb'+String( ii );
	if ( Number( Boolean( document.getElementById( el ).checked ))==1 ) jj=-jj;
	diary_sel=diary_sel+jj;
	window.document.cookie="diary-sel="+diary_sel+";path=/";
}
</script>

<?php
function CowRow_Draw( $lactm ) {
	global $hFrm;
	global $j, $rs, $row, $days, $birthday, $op, $days_frombirth, $lact, $now_dmY, $cowst, $cowst512, $cowid, $cb_;
	global $cjust, $ljust, $rjust;
	if ( $cb_[$op]==0 ) echo "
<tr ".RepTrCol().">";
	$date="";
//may be inseminated
	if ( $op==11 & $cowst[$cowid]==0 ) {
		$birthtime=strtotime( DateDdMmmYyyy( $birthday ));
		$dd=date( "d", $birthtime ); $mm=date( "m", $birthtime ); $yyyy=date( "Y", $birthtime );
		$dateint=mktime( 0, 0, 0, $mm, $dd+100, $yyyy );
		$date=date( "d.m.Y", $dateint );
	}
//needed insemination ERROR
//	if ( $op==11 & $cowst[$cowid]==512 & $cowst512[$cowid]<>1 ) {
//		$date=$now_dmY;
//	}
//without rectal
	if ( $op==13 & ( $cowst[$cowid]==128 | $cowst[$cowid]==256 ) & $days>=91 ) {
		$today=strtotime( DateDdMmmYyyy( $now_dmY ));
		$dd=date( "d", $today ); $mm=date( "m", $today ); $yyyy=date( "Y", $today );
		$dateint=mktime( 0, 0, 0, $mm, $dd-$days+91, $yyyy );
		$date=date( "d.m.Y", $dateint );
	}
//do zapusku
	if ( $op==19 & $cowst[$cowid]==2048 & $days>=305+45 ) {
		$today=strtotime( DateDdMmmYyyy( $now_dmY ));
		$dd=date( "d", $today ); $mm=date( "m", $today ); $yyyy=date( "Y", $today );
		$dateint=mktime( 0, 0, 0, $mm, $dd-$days+91, $yyyy );
		$date=date( "d.m.Y", $dateint );
	}
	if ( $cb_[$op]==0 ) {
		$milk_tot=$row[18]*1; if ( $milk_tot==0 ) $milk_tot="0";
		$milk_q=$row[19]*1;
		if ( $milk_q>0 ) $milk_aver=floor( $milk_tot/$milk_q*100 )/100; else $milk_aver=0;
		$milk_max=$row[20]*1; if ( $milk_max==0 ) $milk_max=0;
		$milk_min=$row[21]*1; if ( $milk_min==0 ) $milk_min=0;
		$milkm_tota=$row[22]*1; if ( $milkm_tota==0 ) $milkm_tota=0;
		$milkm_qa=$row[23]*1;
		if ( $milkm_qa>0 ) $milkm_avera=floor( $milkm_tota/$milkm_qa*100 )/100; else $milkm_avera=0;
		$milkm_maxa=$row[24]*1; if ( $milkm_maxa==0 ) $milkm_maxa=0;
		$milkm_mina=$row[25]*1; if ( $milkm_mina==0 ) $milkm_mina=0;
		$lact_days=$row[26]*1; if ( $lact_days==0 ) $lact_days=0;
		echo "
	<td width='6%'>$date&nbsp;</td>
	<td $rjust onclick='' onmouseover='style.cursor=\"pointer\"' title=''><img src='' height='0' width='0'><b><a href='../".$hFrm['0520']."?cow_id=".$row[17]."&return_url=../".$hFrm['0200']."'>:$row[0].&nbsp;</b></td>
	<td>$row[1]&nbsp;</td>
	<td>$row[2]&nbsp;</td>
	<td>$row[3]&nbsp;</td>
	<td>$birthday&nbsp;</td>
	<td $rjust>$days_frombirth&nbsp;</td>
<!--
	<td $rjust>$lactm&nbsp;</td>
	<td $rjust>&nbsp;</td>
-->
	<td $rjust>$lact&nbsp;</td>
	<td $rjust>$milk_tot&nbsp;</td>
	<td $rjust>$milk_max&nbsp;</td>
	<td $rjust>$milkm_mina&nbsp;</td>
	<td $rjust>$milkm_avera&nbsp;</td>
	<td $rjust>$milkm_maxa&nbsp;</td>
</tr>";
	} else echo "<b>$row[0].&nbsp;</b>";
	$j=$j+1;
}

ob_start();//lock output to set cookies properly!

//detailed mode [BEGIN]
$cbbool[0]="checked class='z_chk' style='height:14px' type='checkbox'";
$cbbool[1]="class='chkbox' type='checkbox' style='height:14'";
$diary_sel=CookieGet( "diary-sel" )*1;
for ( $i=10; $i<=20; $i++ ) $cb_[$i]=0;
if ( $diary_sel>0 ) {
	$j=1;
	for ( $i=10; $i<=20; $i++ ) {
		$cb_[$i]=( $diary_sel & $j )/$j;
		$j=$j*2;
		if ( $cb_[$i]>0 ) $cb_[$i]=1;
	}
}
for ( $i=10; $i<=20; $i++ ) {
	$_onclick[$i] =" onclick='do_setdiarycoo( $i ); do_reload()'";
	$cb__[$i]=$cbbool[$cb_[$i]].$_onclick[$i]." id='cb".$i."'";
}
//detailed mode [END]

$cows_order_=$order_by=$_GET["order_by"];
if ( $cows_order_=="" ) $cows_order_="$cows.cow_num*1";

include( "f_tdprep.php" );
include( "../locales/$lang/f_02._$lang" );
include( "../locales/$lang/f_13._$lang" );

if ( $_GET["hide_menu"]*1==0 ) echo "
<div class='mk' id='rep_div' style='border-width:1px; height:61%; line-height:1px; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; overflow-x:hidden; overflow-y:scroll'>";

for ( $op=10; $op<=20; $op++ ) {
	echo "
<table cellspacing='1' class='st2' style='width:100%'>
<tr class='st_title'>
	<td width='90%'><b>".$_02_h_[$op]."</b></td>
	<td $cjust><input $cb__[$op]>".$_02_cb_."</td>
</tr>
</table>";
	include( "f_tdiary.php" );
}

echo "
</div>";

ob_end_flush();
?>
