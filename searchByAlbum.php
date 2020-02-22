<?php include 'pageHeader.php';?>

<?php
/* Displays user information and some useful messages */
require 'db.php';




// get artist id from page call
$album = $_GET['id'];
//echo $album;

// search for all songs by artist given

$exists = $mysqli->query("SELECT id FROM songs WHERE album='$album'") or die($mysqli->error);
//print_r($exists);

print "<br>";

$a = $mysqli->escape_string($album);
$reslt = $mysqli->query("SELECT * FROM albums WHERE album_id='$album'") or die($mysqli->error);
$name = $reslt->fetch_assoc();
$album_name = $name['album_title'];


$coverURL = $name['image_url'];

?>
<br />
<img src="<?php echo $coverURL; ?>" />
<br />
<?php

echo "Listen to Album: ";
echo $album_name;
print "<br>";

// print out links for all the songs found

foreach($exists as $key){

    $name =$key["id"];

    $n = $mysqli->escape_string($name);
    $reslt = $mysqli->query("SELECT * FROM songs WHERE id='$n'") or die($mysqli->error);
    $song = $reslt->fetch_assoc();
    $song_name = $song['title'];
    $songCost = $song['stream_cost'];



    echo "<a href='/login-system/playSong.php?id=$name&user=$user_id'>  Listen to: $song_name</a>";
    echo " :song cost ";
    echo $songCost;
    echo " credits";
    print "<br>";


}

// return to home page link
?>
<br />
<a href="/login-system/profile.php">Go back to profile page </a>
<br />


