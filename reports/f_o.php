<?php
/* DF_2: reports/f_o.php
report: operations other than extracting
c: 25.12.2005
m: 23.03.2017 */

$dbt_ext="_o";

ob_start();//lock output to set cookies properly!
$noCSS=$_GET["noCSS"]*1;

$title_=$title=$_GET["title"];

if ( $cow_hist==0 ) {
	$outsele_=-1; $outsele_table=-1; $outsele_field=-1;
	$operkeys=$_GET["operkeys"]*1; if ( $operkeys<1 ) $operkeys=-1;
	$opertype=$_GET["opertype"]*1; if ( $opertype<1 ) $opertype=-1;
	$outsele_=$opertype*1;
}

$rows_cnt=0; $cows_cnt=0;
$rdiv="&iquest;";

$dontuse_filt=1;//IMPORTANT!

include( "f_jfilt.php" );

$th1=$ged["Date"];
$th2=$ged["Modif._Time"];
$th3=$ged["Number"];
$th4=$ged["Nick"];
$th5=$ged["What_Was_Done"];
$th6=$ged["Detailed_Content"];
$th7=$ged["Comment."];

$th_cnt=2; $th[1]=$th1; $th[2]=$th2;
if ( $filt_cowid==-1 ) { $th_cnt=4; $th[3]=$th3; $th[4]=$th4; }
if ( $opertype*1==-1 ) { $th_cnt++; $th[$th_cnt]=$th5; }
$th_cnt++; $th[$th_cnt]=$th6;
if ( $dbt_ext=="_o" ) { $th_cnt++; $th[$th_cnt]=$th7; }

$_mod_rep_CSS=1;
$_mod_rep_CSS_content="
	/* Label the data */";
for ( $i=1; $i<=$th_cnt; $i++ ) $_mod_rep_CSS_content=$_mod_rep_CSS_content."
	#rep_tbody td:nth-of-type(".$i."):before { content:\"".$th[$i]."\"; text-align:left; top:0; }";

if ( $cow_hist==0 ) include( "../reports/frhead.php" );

//TEMPORARY!!!
if ( $userCoo*1!=9 ) $operkeys=1;

if ( $cow_hist==0 ) {
	echo "
<table>
<thead id='rep_thead'>
<tr $cjust style='height:28px'>
	<th width='5%'><b>".$th1."</b></th>
	<th width='5%'><b>".$th2."</b></th>";
	if ( $filt_cowid==-1 ) echo "
	<th width='55px'><b>".$th3."</b></th>
	<th><b>".$th4."</b></th>";
	if ( $opertype*1==-1 ) echo "
	<th width='15%'><b>".$th5."</b></th>";
	echo "
	<th width='35%'><b>".$th6."</b></th>";
	if ( $dbt_ext=="_o" ) echo "
	<th width='30%'><b>".$th7."</b></th>";
	echo "
</tr>
</thead>
<tbody id='rep_tbody'>";
}

$query="SELECT descr, id FROM $pregnant"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $pregnan[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT descr, id FROM $states"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $stan[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT descr, id FROM $results"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $result[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT nick, id FROM $departs"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $dep[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT nick, id FROM $oxes"; $res=mysql_query( $query, $db );
while ( $row=mysql_fetch_row( $res )) $ox[$row[1]]=$row[0];
mysql_free_result( $res );

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;
$dbt="000000_o";
include( "f_jselo.php" );

if ( $error==0 ) { while ( $row=mysql_fetch_row( $res )) {
	$yc1=$row[3]*10000; $mc1=$row[2]*100;//when all operations are in one table
	$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;
	if ( $odt>$yl1+$ml1+$dl );
	else if ( $odt<$yf1+$mf1+$df );
	else {
		$upd_date=$row[21]; $upd_time=$row[24];
		$cowid=$row[0]*1;
		if ( $dbt_ext=="_o" ) $oper_id=$row[18]*1; else $oper_id=1;
		if ( $cow[$cowid]!=1 ) {
			$cows_cnt++; $cow[$cowid]=1;
		}
		$operkey=$row[1].".".$row[2].".".$row[3];
		include( "f_odecod.php" );
		if ( $userCoo!=9 ) $operkey="<a href='../oper/f_o_".$url_.".php?".$params."&opertype=".$oper_id."&key=".$dbt.":".$row[22].":".$row[0]."&ret0=".$ret0."'>".$operkey."</a>";
		$cownick=$row[5];
		$cownum=$cownum_div.$row[4].$cownum_div1;
		if ( $filt_cowid==-1 ) $cownum="<a href='../".$hRep['o']."?filt_cowid=$cowid&title=".$ged['RHM000hist.'].":&nbsp;".$php_mm["_com_animal_"]."&nbsp;".$ged['No.']."&nbsp;$cownum,&nbsp;".$ged['nick']."&nbsp;$cownick'><b>".$cownum."</b></a>";
		$cowoperdes=$row[6];
//$a - array of table content
		$tmp=$odt.$rdiv."<td>".$operkey."</td><td>".Date_FromDb2Scr( $upd_date, "." )."<br>$upd_time"."</td>";
		if ( $filt_cowid==-1 ) {
			$tmp=$tmp."<td $rjust>".$cownum."</td><td>".$cownick."&nbsp;</td>";
		}
		if ( $opertype*1==-1 ) {
			$tmp=$tmp."<td>".$cowoperdes."&nbsp;</td>";
		}
		$comments=PhraseCarry1( $row[17], "<br>", 40, $contentCharset );
		$tmp=$tmp."<td>".$descr."&nbsp;</td><td>".$comments[1]."&nbsp;</td>";
		$a[$rows_cnt]=$tmp;
		$rows_cnt++;
	}
} mysql_free_result( $res ); }

if ( $filt_cowid>0 & (( $outsele_!=-1 & $outsele_==2048 ) | ( $outsele_==-1 ))) {
	$res=mysql_query( "SELECT b_date, cow_num, nick, comments, modif_date, modif_time, id
	 FROM $cows WHERE mth_id=$filt_cowid", $db );
	while ( $row=mysql_fetch_row( $res )) {
			$tmp=split( "-", $row[0] ); $odt="";
			for ( $i=0; $i<=2; $i++ ) $odt=$odt.$tmp[$i];
			if ( $odt>$yl1+$ml1+$dl );
			else if ( $odt<$yf1+$mf1+$df );
			else {
				$upd_date=$row[4]; $upd_time=$row[5];
				$operkey=Date_FromDb2Scr( $row[0], "." );
				if ( $userCoo!=9 ) $operkey="<a href='../".$hFrm["0520"]."?cow_id=".$row[6]."'>".$operkey."</a>";
				$cowoperdes=$ged["No."]."&nbsp;\"<b>".$row[1]."</b>\",&nbsp;".$ged["nick"]."&nbsp;\"<b>".$row[2]."</b>\"";
				$comments=$row[3];
				$tmp=$odt.$rdiv."<td>".$operkey."</td><td>".Date_FromDb2Scr( $upd_date, "." )."<br>$upd_time"."</td>";
				if ( $filt_cowid==-1 ) {
					$tmp=$tmp."<td $rjust>".$cownum."</td><td>".$cownick."</td>";
				} else {
					$tmp=$tmp."<td><b>".$ged["abort-"]."</b></td>";
				}
				if ( $opertype*1==-1 ) {
					$tmp=$tmp."<td>".$ged["daughter"]."&nbsp;".$cowoperdes."&nsbp;</td>";
				}
				$comments=PhraseCarry1( $row[3], "<br>", 40, $contentCharset );
				$tmp=$tmp."<td>".$comments[1]."&nbsp;</td>";
				$a[$rows_cnt]=$tmp;
				$rows_cnt++;
			}
	}
}

if ( $a!="" ) sort( $a );

if ( $desc==0 )
	for ( $i=0; $i<=$rows_cnt-1; $i++ ) {
		$tr=split( $rdiv, $a[$i] ); echo "<tr>".$tr[1]."</tr>";
	}
else
	for ( $i=$rows_cnt-1; $i>=0; $i-- ) {
		$tr=split( $rdiv, $a[$i] ); echo "<tr>".$tr[1]."</tr>";

	}

echo "
</tbody>
</table><br>";

include( "frfoot.php" );

ob_end_flush();
?>
