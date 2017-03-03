<?php
/* DF_2: reports/f_o.php
report: operations other than extracting
c: 25.12.2005
m: 08.07.2015 */

$dbt_ext="_o";

$_GET[title]; $title_=$title;

if ( $cow_hist==0 ) {
	$outsele_=-1; $outsele_table=-1; $outsele_field=-1;
	$_GET[operkeys]; if ( $operkeys*1<=0 ) $operkeys=-1;
	$_GET[opertype]; if ( $opertype*1<=0 ) $opertype=-1;
	$outsele_=$opertype*1;
}

$rows_cnt=0; $cows_cnt=0;
$rdiv="&iquest;";

$dontuse_filt=1;//IMPORTANT!

include( "../reports/f_jfilt.php" );//$hDir['reps'] IS NOT READY FOR THIS SCRIPT!
if ( $cow_hist==0 ) include( "../reports/frhead.php" );

//TEMPORARY!!!
if ( $userCoo*1!=9 ) $operkeys=1;

if ( $cow_hist==0 ) {
	echo "
<table cellspacing='1' class='st2'>
<tr class='st_title2' style='height:28px'>
	<td $cjust width='5%'><b>".$ged['Date']."</b></td>
	<td $cjust width='5%'><b>".$ged['Modif._Time']."</b></td>";
	if ( $filt_cowid==-1 ) echo "
	<td $cjust width='55px'><b>".$ged['Number']."</b></td>
	<td $cjust><b>".$ged['Nick']."</b></td>";
	if ( $opertype*1==-1 ) echo "
	<td $cjust width='15%'><b>".$ged['What_Was_Done']."</b></td>";
	echo "
	<td $cjust width='35%'><b>".$ged['Detailed_Content']."</b></td>";
	if ( $dbt_ext=="_o" ) echo "
	<td $cjust width='30%'><b>".$ged['Comment.']."</b></td>";
	echo "
</tr>";
}

$query="SELECT descr, id FROM $pregnant"; $res=mysql_query( $query );
while ( $row=mysql_fetch_row( $res )) $pregnan[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT descr, id FROM $states"; $res=mysql_query( $query );
while ( $row=mysql_fetch_row( $res )) $stan[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT descr, id FROM $results"; $res=mysql_query( $query );
while ( $row=mysql_fetch_row( $res )) $result[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT nick, id FROM $departs"; $res=mysql_query( $query );
while ( $row=mysql_fetch_row( $res )) $dep[$row[1]]=$row[0];
mysql_free_result( $res );
$query="SELECT nick, id FROM $oxes"; $res=mysql_query( $query );
while ( $row=mysql_fetch_row( $res )) $ox[$row[1]]=$row[0];
mysql_free_result( $res );

$yf1=$yf*10000; $mf1=$mf*100;
$yl1=$yl*10000; $ml1=$ml*100;
$dbt="000000_o";
include( "../".$hDir['reps']."f_jselo.php" );
if ( $sqerr<1 ) { while ( $row=mysql_fetch_row( $res )) {
	$yc1=$row[3]*10000; $mc1=$row[2]*100;//when all operations are in one table
	$dc=$row[1]*1; $odt=$yc1+$mc1+$dc;
	if ( $odt>$yl1+$ml1+$dl );
	else if ( $odt<$yf1+$mf1+$df );
	else {
		$upd_date=$row[21]; $upd_time=$row[24];
		$cowid=$row[0]*1;
		if ( $dbt_ext=="_o" ) $oper_id=$row[18]*1; else $oper_id=1;
		if ( $cow[$cowid]<>1 ) { $cows_cnt++; $cow[$cowid]=1; }
		$operkey="$row[1].$row[2].$row[3]";
		include( "f_odecod.php" );
		if ( $userCoo!=9 ) $operkey="<a href='../oper/f_o_$url_.php?$params&opertype=$oper_id&key=$dbt:$row[22]:$row[0]&ret0=$ret0'>".$operkey."</a>";
		$cownick=$row[5];
		$cwnum=$cownum_div.$row[4].$cownum_div1;
		if ( $filt_cowid==-1 ) $cwnum="<a href='../".$hRep['o']."?filt_cowid=$cowid&title=".$ged['RHM000hist.'].":&nbsp;".$php_mm["_com_animal_cap"]."&nbsp;".$ged['No.']."&nbsp;$cwnum,&nbsp;".$ged['nick']."&nbsp;$cownick'>".$cwnum."</a>";
		$cowoperdes=$row[6];
//$a - array of table content
		$tmp=$odt.$rdiv."<td>".$operkey."</td><td>".Date_FromDb2Scr( $upd_date, "." )."<br>$upd_time"."</td>";
		if ( $filt_cowid==-1 ) {
			$tmp=$tmp."<td $rjust>".$cwnum."</td><td>".$cownick."</td>";
		}
		if ( $opertype*1==-1 ) { $tmp=$tmp."<td>".$cowoperdes."</td>"; }
		$comments=PhraseCarry1( $row[17], "<br>", 40, $contentCharset );
		$tmp=$tmp."<td>".$descr."</td><td>".$comments[1]."</td>";
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
			if ( $userCoo!=9 ) $operkey="<a href='../".$hFrm['0520']."?cow_id=$row[6]'>".$operkey."</a>";
			$cowoperdes=$ged['No.']."&nbsp;\"<b>".$row[1]."</b>\",&nbsp;".$ged['nick']."&nbsp;\"<b>".$row[2]."</b>\"";
			$comments=$row[3];
			$tmp=$odt.$rdiv."<td>".$operkey."</td><td>".Date_FromDb2Scr( $upd_date, "." )."<br>$upd_time"."</td>";
			if ( $filt_cowid==-1 ) { $tmp=$tmp."<td $rjust>".$cwnum."</td><td>".$cownick."</td>"; }
			else { $tmp=$tmp."<td><b>".$ged['abort-']."</b></td>"; }
			if ( $opertype*1==-1 ) { $tmp=$tmp."<td>".$ged['daughter']."&nbsp;".$cowoperdes."</td>"; }
			$comments=PhraseCarry1( $row[3], "<br>", 40, $contentCharset );
			$tmp=$tmp."<td>".$comments[1]."</td>";
			$a[$rows_cnt]=$tmp;
			$rows_cnt++;
		}
	}
}

if ( $a!="" ) sort( $a );

if ( $desc==0 )
	for ( $i=0; $i<=$rows_cnt-1; $i++ ) {
		RepTr1( $rownum, $cjust );
		$tr=split( $rdiv, $a[$i] );
		echo $tr[1];
	}
else
	for ( $i=$rows_cnt-1; $i>=0; $i-- ) {
		RepTr1( $rownum, $cjust );
		$tr=split( $rdiv, $a[$i] );
		echo $tr[1];
	}

echo "
</table><br>";
?>
