
<?php include 'pageHeader.php';?>



  <?php


  /// SEARCH ALBUMS BY ARTIST


   //// PRINT OUT LIST OF SONGS BY ARTIST AS LINKS
  $artist =$_POST['name'];
  $artist = $mysqli->escape_string($artist);

  //echo $artist;
  $exists = $mysqli->query("SELECT id FROM artists WHERE artist_name LIKE'%$artist%'") or die($mysqli->error);
 // print_r($exists);

  print "<br>";

  echo "RESULTS: ";
  print "<br>";

  /// print out links for all the songs found by the search
  foreach($exists as $key){

      $name =$key["id"];

      $n = $mysqli->escape_string($name);
      $reslt = $mysqli->query("SELECT * FROM artists WHERE id='$n'") or die($mysqli->error);
      $name = $reslt->fetch_assoc();
      $name = $name['artist_name'];


      echo "<a href='http://www.waylostreams.com/login-system/searchByArtist.php?id=$n&user=$user_id'>listen to $name</a>";

      print "<br>";
      print "<br>";

  }






  // return to home page link
  ?>
<br />
<a href="http://www.waylostreams.com/login-system/profile.php">Go back to profile page </a>
<br />



