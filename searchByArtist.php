<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 10/17/18
 * Time: 8:10 PM
 */

/// php program which creates a stream of links from items in the database
///
///
///
///  create an array of song id's that satisfy a condition
/// ie artist = ...
/// ie album = ...
/// ie album ids with artist
/// search "albums" search "artists" search "songs "https://stackoverflow.com/questions/12520146/php-for-loop-with-links
///
///
/// create an array of songs with artist equal to page
///
///then use the array to create some clickable song links
///
///https://stackoverflow.com/questions/12520146/php-for-loop-with-links
///
/// https://stackoverflow.com/questions/10057671/how-does-php-foreach-actually-work?rq=1
///
///
///
///



/* Displays user information and some useful messages */
require 'db.php';
session_start();


// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();
    $credits = $user['credits'];


}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>WAYLOSTREAM <?= $first_name.' '.$last_name?></title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">

          <h1>WAYLOSTREAM</h1>



          <p>
          <?php

          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];

              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }

          ?>
          </p>

          <?php

          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }

          ?>

          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>

          <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>
// load up more credits
<a href="http://www.waylostreams.com/login-system/buycredits.php">BUY CREDITS</a>
<br />
<br />
<br />

<?php

    echo "You have: ";
    echo $credits;
    echo " credits";
    echo "<br>";
    $song_id = 1;

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

// this code below a sticks up an html audio player and calls the source file
// from the database. It selects the URL of the source and then
// streams the file secretly
// THIS IS THE MAIN PAGE STUFF HERE ABOVE IS STANDARD CODE
?>
<br />
<br />

  <?php
// get artist id from page call
$artist = $_GET['artist'];
// search by artist
$exists = $mysqli->query("SELECT id FROM songs WHERE artist='$artist'") or die($mysqli->error);
// get numeric array out of result
$Songs = mysqli_fetch_array($exists, MYSQLI_NUM);


    foreach($Songs as $key){

  echo "<a href='http://www.waylostreams.com/login-system/playSong.php?id=$key&user=$user_id'>Listen</a>";
  print "<br>";

  }

?>
  <br />
  <br />



