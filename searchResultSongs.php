
<?php include 'pageHeader.php';?>



<?php


$song =$_POST['name'];
$song = $mysqli->escape_string($song);

//echo $artist;
$exists = $mysqli->query("SELECT id FROM songs WHERE title LIKE'$song'") or die($mysqli->error);
// print_r($exists);

print "<br>";

echo "RESULTS: ";
print "<br>";

/// print out links for all the songs found by the search
foreach($exists as $key){

    $name =$key["id"];

    $n = $mysqli->escape_string($name);
    $reslt = $mysqli->query("SELECT * FROM songs WHERE id='$n'") or die($mysqli->error);
    $name = $reslt->fetch_assoc();
    $name = $name['title'];


    echo "<a href='http://www.waylostreams.com/login-system/playSong.php?id=$n&user=$user_id'>  Listen to: $name</a>";
    print "<br>";

}

// return to home page link
?>
<br />
<a href="http://www.waylostreams.com/login-system/profile.php">Go back to profile page </a>
<br />
