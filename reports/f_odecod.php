<?php
/* DF_2: reports/f_odecod.php
report: operations decoding
c: 25.12.2005
m: 15.03.2017 */
				switch ( $oper_id ) {
				case 1: $url_="mlk";
					$x="";
					$kg=$row[6];
					$_begin=$row[7];
					$_end=$row[8];
					$_time=$row[9];
					$id_time=$row[10];
					$rep_time=$row[11];
					$notag=$row[12]*1; if ( $notag==1 ) $x=$x.",&nbsp;<b>no_tag</b>";
					$retries=$row[13];
					$stopped=$row[14]*1; if ( $stopped==1 ) $x=$x.",&nbsp;<b>breaked</b>";
					$exhaust=$row[15]*1; if ( $exhaust==1 ) $x=$x.",&nbsp;<b>exhaust</b>";
					$mast=$row[16]*1; if ( $mast==1 ) $x=$x.",&nbsp;<b>mastitus</b>";
					$mast4=$row[17];
					$tr=$row[18]*1; if ( $tr==1 ) $x=$x.",&nbsp;<b>trauma</b>";
					$ov=$row[19]*1; if ( $ov==1 ) $x=$x.",&nbsp;<b>ovul.</b>";
					$created_date=$row[20];
					$modif_uid=$row[21];
					$modif_date=$row[22];
					$modif_time=$row[23];
					$code=$row[24];
					$bd=$row[25];
					$descr=$ged['milk,kg'].":&nbsp;<b>".$kg."</b>&nbsp".$x;
					break;
				case 2: $url_="mlkt";
					$somop=$ged['somo,%']."&nbsp;<b>".$row[8]."</b>";
					$somo1=$ged['somo,pieces']."&nbsp;<b>".$row[9]."</b>";
					$fatp=$ged['fat,%']."&nbsp;<b>".$row[10]."</b>";
					$albp=$ged['albumen,%']."&nbsp;<b>".$row[11]."</b>";
					$descr=$ged['milk_params'].":&nbsp;".$somop.",&nbsp;".$somo1.",&nbsp;".$fatp.",&nbsp;".$albp;
					$modif_time=$row[24];
					$params="row17=".$row[17]."&row7=".$row[7]."&row8=".$row[8]."&row9=".$row[9]."&row10=".$row[10]."&row11=".$row[11]."&row12=".$row[12]."&row13=".$row[13]."&row14=".$row[14];
					break;
				case 4: $url_="meas";
					$r[1]=$ged["height,mm"].":&nbsp;<b>".$row[10]."</b>;&nbsp;";
					$r[2]=$ged["chest,mm"].":&nbsp;<b>".$row[7]."</b>,&nbsp;<b>".$row[8]."</b>,&nbsp;<b>".$row[9]."</b>;"."<br>";
					$r[3]=$ged["other_meas.,mm"].":&nbsp;<b>".$row[11]."</b>,&nbsp;<b>".$row[12]."</b>,&nbsp;<b>".$row[13]."</b>;&nbsp;";
					$r[4]=$ged["brutto,kg"].":&nbsp;<b>".$row[14]."</b>";
					$descr="";
					for ( $k=4; $k>=1; $k-- ) {
						$descr=$r[$k]."&nbsp;".$descr;
					}
					$modif_time=$row[24];
					$params="row17=".$row[17]."&row7=".$row[7]."&row8=".$row[8]."&row9=".$row[9]."&row10=".$row[10]."&row11=".$row[11]."&row12=".$row[12]."&row13=".$row[13]."&row14=".$row[14];
					break;
				case 8: $url_="care";
					$v1_4=split( "@", $row[15] );
					$v5_8=split( "@", $row[16] );
					for ( $k=1; $k<=4; $k++ ) {
						if ( strlen( $v1_4[$k] )>=40 ) {
							$tttt=substr( $v1_4[$k], 0, 40 )."<br>".substr( $v1_4[$k], 40, 60 );
						} else
							$tttt=$v1_4[$k]."&nbsp;";
						if ( $v1_4[$k]<>'-' ) $v1_4[$k]="</b>,&nbsp;<b>".$tttt; else $v1_4[$k]="";
						if ( strlen( $v5_8[$k] )>=40 ) {
							$tttt=substr( $v5_8[$k], 0, 40 )."<br>".substr( $v5_8[$k], 40, 60 );
						} else
							$tttt=$v5_8[$k]."&nbsp;";
						if ( $v5_8[$k]<>'-' ) $v5_8[$k]="</b>,&nbsp;<b>".$tttt; else $v5_8[$k]="";
					}
					$r[1]=$ged['cond.,udder']."&nbsp;<b>".$stan[$row[7]].$v1_4[1]."</b>;";
					$r[2]=$ged['cond.,womb']."&nbsp;<b>".$stan[$row[8]].$v1_4[2]."</b>;";
					$r[3]=$ged['cond.,hornes']."&nbsp;<b>".$stan[$row[9]].$v1_4[3]."</b>;";
					$r[4]=$ged['cond.,hoof']."&nbsp;<b>".$stan[$row[10]].$v1_4[4]."</b>;";
					$r[5]=$ged['cond.,common']."&nbsp;<b>".$stan[$row[13]].$v5_8[3]."</b>;";
					$r[6]=$ged["conclusion_common"]."&nbsp;<b>".$result[$row[14]].$v5_8[4]."</b>";
					$descr="";
					for ( $k=6; $k>=1; $k-- ) {
						$descr=$r[$k]."&nbsp;".$descr;
					}
					$modif_time=$row[24];
					$params="row17=$row[17]&row7=$row[7]&row8=$row[8]&row9=$row[9]&row10=$row[10]&row13=$row[13]&row14=$row[14]";
					$params=$params."&row15=$row[15]&row16=$row[16]";
					break;
				case 16: $url_="care";
					$v1_4=split( "@", $row[15] );
					$v5_8=split( "@", $row[16] );
					for ( $k=1; $k<=4; $k++ ) {
						if ( strlen( $v1_4[$k] )>=40 ) {
							$tttt=substr( $v1_4[$k], 0, 40 )."<br>".substr( $v1_4[$k], 40, 60 );
						} else
							$tttt=$v1_4[$k]."&nbsp;";
						if ( $v1_4[$k]<>'-' ) $v1_4[$k]="</b>,&nbsp;<b>".$tttt; else $v1_4[$k]="";
						if ( strlen( $v5_8[$k] )>=40 ) {
							$tttt=substr( $v5_8[$k], 0, 40 )."<br>".substr( $v5_8[$k], 40, 60 );
						} else
							$tttt=$v5_8[$k]."&nbsp;";
						if ( $v5_8[$k]<>'-' ) $v5_8[$k]="</b>,&nbsp;<b>".$tttt; else $v5_8[$k]="";
					}
					$r[1]=$ged['cond.,udder']."&nbsp;<b>".$stan[$row[7]].$v1_4[1]."</b>;";
					$r[2]=$ged['cond.,womb']."&nbsp;<b>".$stan[$row[8]].$v1_4[2]."</b>;";
					$r[3]=$ged['cond.,hornes']."&nbsp;<b>".$stan[$row[9]].$v1_4[3]."</b>;";
					$r[4]=$ged['cond.,hoof']."&nbsp;<b>".$stan[$row[10]].$v1_4[4]."</b>;";
					$r[5]=$ged['cond.,common']."&nbsp;<b>".$stan[$row[13]].$v5_8[3]."</b>;";
					$r[6]=$ged["conclusion_common"]."&nbsp;<b>".$result[$row[14]].$v5_8[4]."</b>";
					$descr="";
					for ( $k=6; $k>=1; $k-- ) {
						$descr=$r[$k]."&nbsp;".$descr;
					}
					$modif_time=$row[24];
					$params="row17=$row[17]&row7=$row[7]&row8=$row[8]&row9=$row[9]&row10=$row[10]&row13=$row[13]&row14=$row[14]";
					$params=$params."&row15=$row[15]&row16=$row[16]";
					break;
				case 32: $url_="vacc";
					$descr="";
					$params="row17=$row[17]";
					break;
				case 64: $url_="mov";
					$depid=$row[14];
					$descr=$ged['to_departm.'].":&nbsp;<b>$dep[$depid]</b>";
					$modif_time=$row[24];
					$params="row14=$depid&row17=$row[17]";
					break;
				case 128: $url_="insm";//not_by_live_ox
					$ox_id=$row[14];
					$descr=$ged['bull'].":&nbsp;<b>$ox[$ox_id]</b>";
					$modif_time=$row[24];
					$params="row14=$ox_id&row17=$row[17]";
					break;
				case 256: $url_="insm";
					$ox_id=$row[14];
					$descr=$ged['bull'].":&nbsp;<b>$ox[$ox_id]</b>";
					$modif_time=$row[24];
					$params="row14=$ox_id&row17=$row[17]";
					break;
				case 512: $url_="rect";
					$v5_8=split( "@", $row[16] );
					for ( $k=1; $k<=4; $k++ ) {
						if ( $v5_8[$k]<>'-' ) $v5_8[$k]="</b>, <b>".$v5_8[$k]; else $v5_8[$k]="";
					}
					$r5_8="<b>".$pregnan[$row[13]]."</b>,&nbsp;".$ged['cond.']."&nbsp;<b>".$stan[$row[14]].$v5_8[3]."</b>";
					$descr=$r5_8;
					$modif_time=$row[24];
					$params="row17=$row[17]&row13=$row[13]&row14=$row[14]";
					$params=$params."&row16=$row[16]";
					break;
				case 1024: $url_="abrt";//abort
					$descr="";
					$modif_time=$row[24];
					$params="row17=$row[17]";
					break;
				case 2048: $url_="abrt";//parturition
					$descr="";
					$modif_time=$row[24];
					$params="row17=$row[17]";
					break;
				case 8192: $url_="jagg";//jagg/separation
					$descr="";
					$modif_time=$row[24];
					$params="row17=$row[17]";
					break;
				}
				if ( $oper_id>=8192 ) {
					$v1_4=split( "@", $row[15] );
					$v5_8=split( "@", $row[16] );
					for ( $k=1; $k<=4; $k++ ) {
						if ( $v1_4[$k]<>'-' ) $v1_4[$k]="</b>,&nbsp;<b>".$v1_4[$k]; else $v1_4[$k]="";
						if ( $v5_8[$k]<>'-' ) $v5_8[$k]="</b>,&nbsp;<b>".$v5_8[$k]; else $v5_8[$k]="";
					}
					$descr=" : ".$v1_4[1].$v1_4[2].$v1_4[3].$v1_4[4];
					$descr=$descr.$v5_8[1].$v5_8[2].$v5_8[3].$v5_8[4];
					$modif_time=$row[24];
				}
				$params=$params."&row_date=$row[1]-$row[2]-$row[3]";
?>
