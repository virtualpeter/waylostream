<?php
/* Database connection settings */
$host = 'localhost';
$user = 'abletapm_waylost';
$pass = 'genericpass#1';
$db = 'abletapm_waylostream';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
