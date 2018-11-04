<?php
require 'db.php';

/* Database connection settings */
$host = 'localhost';
$user = 'seanwayland';
$pass = 'Goberheim1$';
$db = 'sean';
$dbport = 3306;
$mysqli = new mysqli($host,$user,$pass,$db,$dbport) or die($mysqli->error);

// Escape user inputs for security


$album_name =$_POST['album_name'];
$album_name = $mysqli->escape_string($album_name);
$artist_name =$_POST['artist_name'];
$artist_name = $mysqli->escape_string($artist_name);
$credits =$_POST['credits'];
$credits = $mysqli->escape_string($credits);


// search for artist name index

/*
$exists = $mysqli->query("SELECT id FROM artists WHERE artist_name LIKE'%$artist_name%'") or die($mysqli->error);
$name =$exists["id"];
echo $name;
*/



$result = $mysqli->query("SELECT * FROM artists WHERE artist_name='$artist_name'");
$art = $result->fetch_assoc();
$name = $art['id'];


// Attempt insert query execution
$sql = "INSERT INTO albums (album_title, album_artist, release_date, image_url, credits)" . " VALUES ('$album_name', '$name', now(), 'http://waylostreams.com/album-covers/step0001.jpg' , '$credits')";

/*
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


$sql = "INSERT INTO streams ( user_id, song_id, purchase_cost, number_plays, first_access_time, last_access_time) "
    . "VALUES ('$user_id','$id','$purchase_cost', $number_plays, now(), now())";
*/

$mysqli->query($sql) or die($mysqli->error);

echo "Album Added";

// Close connection
mysqli_close($link);

?>

<br />
<a href="http://www.waylostreams.com/login-system/createAlbum.php">Add another album </a>
<br />


<br />
<a href="http://www.waylostreams.com/login-system/profile.php">Go back to profile page </a>
<br />


