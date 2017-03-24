<?php
$ipcam_imagefile=$_GET["ipcam_imagefile"];
$mime_type='';
header( "Content-Type: ".$mime_type );
header( "Content-Transfer-Encoding: binary\n" );
@readfile( $ipcam_imagefile );
?>
