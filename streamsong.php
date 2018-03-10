<? php

require 'db.php';
session_start();

// get song ID and user ID
// song ID should be passed when file is clicked on
$song_id = $_GET['id'};

// fetch the logged in users email
$email = $mysqli->escape_string($_SESSION['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
$user = $result->fetch_assoc();
$user_id = $user['id'];

// grab the song purchase cost from the songs table

$song_id = $mysqli->escape_string($song_id);
$result = $mysqli->query("SELECT * FROM songs WHERE id='$song_id'");
$song = $result->fetch_assoc();
$purchase_cost = $song['purchase_cost'];


// search database for a stream ID that matches up with song_id and user_id
// if one doesn't exist create it . purchase_cost is set. number_plays set to one. first_access_time and last_access_time set to system date.
//If one does exist increment the number_playscounter , last_access_time is grabbed from the current time

?>






