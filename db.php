<?php
/* Database connection settings */
$host = 'localhost';
$user = 'seanwayland';
// password hidden by me! 
$pass = '#######';
$db = 'sean';
// without the port number included it wouldn't connect properly ..
$dbport = 3306;
$mysqli = new mysqli($host,$user,$pass,$db,$dbport) or die($mysqli->error);
