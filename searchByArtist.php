<?php include 'pageHeader.php';?>

<?php
/* Displays user information and some useful messages */
require 'db.php';




// get artist id from page call
$artist = $_GET['id'];
//echo $artist;
$exists = $mysqli->query("SELECT id FROM songs WHERE artist='$artist'") or die($mysqli->error);
//print_r($exists);


print "<br>";

$a = $mysqli->escape_string($artist);




print "<br>";


$reslt = $mysqli->query("SELECT * FROM artists WHERE id='$a'") or die($mysqli->error);
$name = $reslt->fetch_assoc();
$artist_name = $name['artist_name'];
echo "Albums by artist : ";
echo $artist_name;

$reslt2 = $mysqli->query("SELECT * FROM albums WHERE album_artist='$a'") or die($mysqli->error);
$name2 = $reslt2->fetch_assoc();
$album_name = $name2['album_title'];


print "<br>";

/// print out links for all the songs found by the search
foreach($reslt2 as $key){

    $name =$key["album_id"];

    $n = $mysqli->escape_string($name);
    $reslt = $mysqli->query("SELECT * FROM albums WHERE album_id='$n'") or die($mysqli->error);
    $song = $reslt->fetch_assoc();
    $album_name = $song['album_title'];
    $title = $song['album_id'];
    $coverURL = $song['image_url'];

    ?>
    <br />
    <img src="<?php echo $coverURL; ?>" />
    <br />
    <?php


    echo "<a href='https://www.waylostreams.com/login-system/searchByAlbum.php?id=$title&user=$user_id'>Listen to: $album_name</a>";
    print "<br>";


}

print "<br>";

/// print out links for all the songs found by the search
///
$reslt = $mysqli->query("SELECT * FROM artists WHERE id='$a'") or die($mysqli->error);
$name = $reslt->fetch_assoc();
$artist_name = $name['artist_name'];
echo "Songs by artist : ";
echo $artist_name;
print "<br>";
print "<br>";
foreach($exists as $key){

    $name =$key["id"];

    $n = $mysqli->escape_string($name);
    $reslt = $mysqli->query("SELECT * FROM songs WHERE id='$n'") or die($mysqli->error);
    $song = $reslt->fetch_assoc();
    $song_name = $song['title'];
    $songCost = $song['stream_cost'];


    echo "<a href='https://www.waylostreams.com/login-system/playSong.php?id=$name&user=$user_id'>Listen to: $song_name</a>";
    echo " cost ";
    echo $songCost;
    echo " credits";
    print "<br>";


}

/// print out albums by artists

print "<br>";






// return to home page link
?>
<br />
<a href="https://www.waylostreams.com/login-system/profile.php">Go back to profile page </a>
<br />
