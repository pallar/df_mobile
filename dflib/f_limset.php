<?php
/* DF_2: dflib/f_limset.php
c: 30.11.2010
m: 24.03.2017 */

	$res=mysql_query( "SELECT limits FROM $limits" ); $sqlerr=mysql_errno();
	if ( $sqlerr==0 ) {
		$auto_prep_zapusk=0;
		$conductiv_vis=0;
		$jagg_attrs=0;
		$limits=mysql_fetch_row( $res ); $limits=$limits[0];
		$limits=split( ";", $limits );
		for ( $i=0; $i<=count( $limits ); $i++ ) {
			$limits1=split( ":", $limits[$i] );
			if ( $limits1[0]==$insem1st_varname ) $insem1st_days0=$limits1[1]*1;//before 1st insem. (after birthday)
			if ( $limits1[0]==$not_abort1st_varname ) $not_abort1st_days0=$limits1[1]*1;//before 1st not abort (after birthday)
			if ( $limits1[0]==$rectal_varname ) $rectal_days0=$limits1[1]*1;//before rectal (after insem.)
			if ( $limits1[0]==$insem_fault_rectal_varname ) $insem_days0_fault_rectal=$limits1[1]*1;//before insem. (after bad rectal)
			if ( $limits1[0]==$prep_zapusk_varname ) $prep_zapusk_days0=$limits1[1]*1;//before zapusk prep. (after insem.)
			if ( $limits1[0]==$zapusk_varname ) $zapusk_days0=$limits1[1]*1;//before zapusk (after insem.)
			if ( $limits1[0]==$late_zapusk_varname ) $late_zapusk_days0=$limits1[1]*1;//before late zapusk (after insem.)
			if ( $limits1[0]==$not_abort_varname ) $not_abort_days0=$limits1[1]*1;//before abort (after insem.)
			if ( $limits1[0]==$insem_varname ) $insem_days0=$limits1[1]*1;//before insem. (after not abort)
			if ( $limits1[0]==$insem_abort_varname ) $insem_days0_abort=$limits1[1]*1;//before insem. (after abort)
			if ( $limits1[0]==$auto_prep_zapusk_varname ) {
				$auto_prep_zapusk=1;
				$auto_prep_zapusk_content=$limits1[1];
			}
			if ( $limits1[0]=="conductivity" ) $conductiv_vis=1;
			if ( $limits1[0]=="jagg_attrs" ) $jagg_attrs=$limits1[1]*1;
		}
		if ( $prep_zapusk_days0==0 ) $prep_zapusk_days0=210;
		if ( $late_zapusk_days0==0 ) $late_zapusk_days0=259;
		if ( $ovul_durat_days0==0 ) $ovul_durat_days0=5;
		if ( $prep_ovul1_days0==0 ) $prep_ovul1_days0=18;
		if ( $prep_ovul2_days0==0 ) $prep_ovul2_days0=41;
		if ( $prep_ovul3_days0==0 ) $prep_ovul3_days0=64;
	} else {
		$auto_prep_zapusk=0;
		$insem1st_days0=480;//before 1st insem. (after birthday)
		$not_abort1st_days0=760;//before 1st not abort (after birthday)
		$rectal_days0=60;//before rectal (after insem.)
		$insem_days0_fault_rectal=21;//before insem. (after bad rectal)
		$prep_zapusk_days0=210;//before zapusk prep. (after insem.)
		$zapusk_days0=230;//before zapusk (after insem.)
		$late_zapusk_days0=259;//before late zapusk (after insem.)
		$not_abort_days0=280;//before not abort (after insem.)
		$insem_days0=30;//before insem. (after not abort)
		$insem_days0_abort=30;//before insem. (after abort)
		if ( $ovul_durat_days0==0 ) $ovul_durat_days0=5;
		if ( $prep_ovul1_days0==0 ) $prep_ovul1_days0=18;
		if ( $prep_ovul2_days0==0 ) $prep_ovul2_days0=41;
		if ( $prep_ovul3_days0==0 ) $prep_ovul3_days0=64;
	}
	$f=fopen( $f_limits_php, "w+" );
	fputs( $f, "<?php".chr( 10 ));
	fputs( $f, "$"."insem1st_days0=$insem1st_days0".";//from birthday to 1st insem.".chr( 10 ));
	fputs( $f, "$"."not_abort1st_days0=$not_abort1st_days0".";//from birthday to 1st not abort".chr( 10 ));
	fputs( $f, "$"."rectal_days0=$rectal_days0".";//from insem. to rectal ".chr( 10 ));
	fputs( $f, "$"."insem_days0_fault_rectal=$insem_days0_fault_rectal".";//from bad rectal to insem.".chr( 10 ));
	fputs( $f, "$"."prep_zapusk_days0=$prep_zapusk_days0".";//from insem. to zapusk' prep.".chr( 10 ));
	fputs( $f, "$"."zapusk_days0=$zapusk_days0".";//from insem. to zapusk".chr( 10 ));
	fputs( $f, "$"."late_zapusk_days0=$late_zapusk_days0".";//from insem. to late zapusk".chr( 10 ));
	fputs( $f, "$"."not_abort_days0=$not_abort_days0".";//from insem. to not abort".chr( 10 ));
	fputs( $f, "$"."ovul_durat_days0=$ovul_durat_days0".";//ovul.' duration".chr( 10 ));
	fputs( $f, "$"."prep_ovul1_days0=$prep_ovul1_days0".";//from not abort to ovul. 1".chr( 10 ));
	fputs( $f, "$"."prep_ovul2_days0=$prep_ovul2_days0".";//from not abort to ovul. 2".chr( 10 ));
	fputs( $f, "$"."prep_ovul3_days0=$prep_ovul3_days0".";//from not abort to ovul. 3".chr( 10 ));
	fputs( $f, "$"."insem_days0=$insem_days0".";//from not abort to insem.".chr( 10 ));
	fputs( $f, "$"."insem_days0_abort=$insem_days0_abort".";//from abort to insem.".chr( 10 ));
	if ( $conductiv_vis==1 ) fputs( $f, "$"."conductiv_vis=1;".chr( 10 ));
	if ( $jagg_attrs>0 ) fputs( $f, "$"."jagg_attrs=$jagg_attrs;".chr( 10 ));
	if ( $auto_prep_zapusk==1 ) {
		fputs( $f, "$"."auto_prep_zapusk=1;".chr( 10 ));
		fputs( $f, "$"."auto_prep_zapusk_content='".$auto_prep_zapusk_content."';".chr( 10 ));
	}
	fputs( $f, "?>".chr( 10 ));
	fclose( $f );
?>
