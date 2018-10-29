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
  $reslt = $mysqli->query("SELECT * FROM artists WHERE id='$a'") or die($mysqli->error);
  $name = $reslt->fetch_assoc();
  $artist_name = $name['artist_name'];
  echo "Songs by artist : ";
  echo $artist_name;

  print "<br>";

/// print out links for all the songs found by the search
foreach($exists as $key){

    $name =$key["id"];

    $n = $mysqli->escape_string($name);
    $reslt = $mysqli->query("SELECT * FROM songs WHERE id='$n'") or die($mysqli->error);
    $song = $reslt->fetch_assoc();
    $song_name = $song['title'];
    $songCost = $song['purchase_cost'];


    echo "<a href='http://www.waylostreams.com/login-system/playSong.php?id=$name&user=$user_id'>Listen to: $song_name</a>";
    echo " song cost: ";
    echo $songCost;
  print "<br>";


  }

  // return to home page link
?>
  <br />
  <a href="http://www.waylostreams.com/login-system/profile.php">Go back to profile page </a>
  <br />



