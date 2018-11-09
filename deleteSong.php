<?php

require('db.php');


session_start();
$email = $_SESSION['email'];

/* Database connection settings */
$host = 'localhost';
$user = 'seanwayland';
$pass = 'Goberheim1$';
$db = 'sean';
$dbport = 3306;
$mysqli = new mysqli($host,$user,$pass,$db,$dbport) or die($mysqli->error);


$id=$_REQUEST['id'];
$query = "DELETE FROM songs WHERE title= '$id' and artist_email='$email'";
$mysqli->query($query) or die($mysqli->error);
header("Location: viewSongData.php");
?>