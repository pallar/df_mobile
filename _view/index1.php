<?php
/* DF_2 | df_ajs : forms/index1.php | _view/index1.php
c: 25.12.2005
m: 24.03.2017 */

ob_start();

$admin_blocked=1;//for users other than admin

include( "../f_vars.php" );
include( "../dflib/f_func.php" );

//conductivity normalization
if ( CookieGet( "normalize" )*1==1 ) {
	CookieSet( "normalize", "" );
	for ( $c_dev=1; $c_dev<=96; $c_dev++ ) {
		$res=mysql_query( "SELECT r, r_mult FROM $parlor WHERE bd_num*1=$c_dev" );
		$row=mysql_fetch_row( $res );
		$r=$row[0]*1; $r_mult=$row[1]*1;
		if ( $r_mult<=0 ) {
			$r_mult=1000/$r;
			mysql_query( "UPDATE $parlor SET
			 r_mult='$r_mult'
			 WHERE bd_num*1=$c_dev" );
		}
	}
}

include( "index0.php" );

include( "../locales/$lang/f_php._$lang" );
include( "../locales/$lang/f_00._$lang" );

$dev_b=$dev_1st; $dev_e=$dev_b+$devs_onmnem1-1;

MainMenu( $php_mm["_com_app_"].":&nbsp;".$_07_, "conf", "" );

include( $hFrm["9910"] );

echo $conduct_msg;

echo "
</body>
</html>";

ob_end_flush();
?>
