<?php
/* DF_2: oper/f_o__zzz.php
c: 06.08.2014
m: 10.11.2015 */
		$key=$_GET["key"].$_POST["key"];
		if ( strlen( $key )>8 ) {
			$delkeys=split( ':', $key );
			if ( $co*1==523041 ) mysql_query( "DELETE FROM $delkeys[0] WHERE code='$delkeys[1]'" );
			else {
				if ( $old_dmY!=$dates_[0] ) mysql_query( "DELETE FROM $delkeys[0] WHERE code='$delkeys[1]'" );
			}
		}
		if ( $co*1==523041 ) {
			$co1="<font color=red size=7>".$php_mm["_06_oper_deleted_"]."!</font>";
			$coo=-1;
		} else $co1=$co;
?>
