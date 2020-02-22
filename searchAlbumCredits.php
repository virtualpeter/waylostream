
<?php include 'pageHeader.php';?>



<?php


$album =$_POST['name'];
$album = $mysqli->escape_string($album);

//echo $artist;
$exists = $mysqli->query("SELECT album_id FROM albums WHERE credits LIKE'%$album%'") or die($mysqli->error);
// print_r($exists);

print "<br>";

echo "RESULTS: ";
print "<br>";

/// print out links for all the songs found by the search
foreach($exists as $key){

    $name =$key["album_id"];

    $n = $mysqli->escape_string($name);
    $reslt = $mysqli->query("SELECT * FROM albums WHERE album_id='$n'") or die($mysqli->error);
    $name = $reslt->fetch_assoc();
    $name = $name['album_title'];


    echo "<a href='/login-system/searchByAlbum.php?id=$n&user=$user_id'>listen to $name</a>";

    print "<br>";
    print "<br>";

}

// return to home page link
?>
<br />
<a href="/login-system/profile.php">Go back to profile page </a>
<br />

