


<?php
// this file updates the streams table in the database
// the user and song_id are passed in with say streamsong.php?id=1&user=13
// it checks to see if the user has already played the song if so it increments the counter
// if the user has never played the song it creates a new row in the DB linking the song to the user
// connection settings
//require '../login-system/db.php';
//session_start();
// do these need to be global  ?
/*
global $id;
global $sql;
global $mysqli;
global $result;
global $row;
global $filename;

 */
/* Database connection settings */
$host = 'localhost';
$user = 'seanwayland';
$pass = 'Goberheim1$';
$db = 'sean';
$dbport = 3306;
$mysqli = new mysqli($host,$user,$pass,$db,$dbport) or die($mysqli->error);

// get song id from page call
$id = $_GET['id'];
$user = $_GET['user'];
//echo "ID is ";
//echo $id;
//echo "  user is ";
//echo $user;
//echo " ";
$id = $mysqli->escape_string($id);
$user_id = $mysqli->escape_string($user);

//////////           UPDATE STREAMS AND CREDITS FROM DATABASE

// sean's user ID !!!
//$user_id = 13;
// get user ID
// fake purchase cost
$purchase_cost = 1;
$exists = $mysqli->query("SELECT stream_id FROM streams WHERE user_id='$user_id' AND song_id ='$id'") or die($mysqli->error);

$exists2 = $exists->fetch_assoc();
$streamid = $exists2['stream_id'];
//echo " stream id is ";
//echo $streamid;
//echo " ";
if ($exists2 !== null)
{
    // if song has been played before by user do nothing for now
    //echo "stream exists";
    // increment streams counter , take credits off user
    // get streams counter
    $counter = $mysqli->query("SELECT number_plays FROM streams WHERE user_id='$user_id' AND song_id ='$id'") or die($mysqli->error);
    $counter = $counter->fetch_assoc();
    $counter = $counter['number_plays'];
    $counter = $counter + 1;
    $counter = $mysqli->escape_string($counter);
    echo " number plays is ";
    echo $counter;
    echo " ";
    $date = date('Y-m-d');
    $date = $mysqli->escape_string($date);
    $sql = "UPDATE streams SET number_plays='$counter' WHERE user_id ='$user_id' AND song_id ='$id'";

    $mysqli->query($sql) or die($mysqli->error);
    $sql = "UPDATE streams SET last_access_time= '$date' WHERE user_id ='$user_id' AND song_id ='$id'";
    $mysqli->query($sql) or die($mysqli->error);

    $result = $mysqli->query("SELECT * FROM users WHERE id='$user_id'");
    $user = $result->fetch_assoc();
    $credits = $user['credits'];
    $credits--;
    $sql = "UPDATE users SET credits= '$credits' WHERE id ='$user_id'";
    $mysqli->query($sql) or die($mysqli->error);

    //echo $date;
    //echo " ";
    //echo $counter;
    //echo " ";
    //echo $id;
    //echo " ";

    //echo $counter;

}
else {
    //echo "stream doesn't exist";
    // create stream in table+

    $stream_id = $mysqli->escape_string('1');


    $purchase_cost = $mysqli->escape_string($purchase_cost);
    $number_plays = 1;
    $number_plays = $mysqli->escape_string($number_plays);
    // insert new stream into streams table fisrt time a song is played by a user
    $sql = "INSERT INTO streams ( user_id, song_id, purchase_cost, number_plays, first_access_time, last_access_time) "
        . "VALUES ('$user_id','$id','$purchase_cost', $number_plays, now(), now())";

    $mysqli->query($sql) or die($mysqli->error);
    //echo $counter;

}

//echo $counter;
//echo "<br>";





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

<a href="http://www.waylostreams.com/login-system/buycredits.php">BUY CREDITS</a>
<br />
<br />
<br />

<?php
echo "You have: ";
echo $credits;
echo " credits";
echo "<br>";
$id = $_GET['id'];
$user = $_GET['user'];
//echo "ID is ";
//echo $id;
//echo "  user is ";
//echo $user;
//echo " ";
$id = $mysqli->escape_string($id);
$user_id = $mysqli->escape_string($user);
$song_id = $id;

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
?>
<br />
<br />


CLICK PLAY TO PLAY SONG  <br />


<!-- play audio file but stop it from being downloadable -->
<audio controls autobuffer onplay="log_stream1()" controls List="nodownload noremoteplayback">
    <!-- get the source as a file from -->
    <source src="http://www.waylostreams.com/phptest/mp323.php?id=<?php echo $song_id;?>" type="audio/mpeg">
</audio>

<!--
<script>
    var isPaused = function () {
        $.ajax({
            url: "http://www.waylostreams.com/phptest/pauseSong.php?id=1&user=<?php echo $user_id;?>",
            method: "GET"
        }).done(function() {
            var update_text = "you have paused this ";
            $('#response2').empty().append(update_text);
        });
    };
</script>

-->
<br />
<span id="response2"></span>
<br />
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

<script>
    <script>
    var log_stream1 = function () {
        $.ajax({
            url: "http://www.waylostreams.com/phptest/streamsong.php?id=<?php echo $song_id;?>&user=<?php echo $user_id;?>",
            method: "GET"
        }).done(function(response) {
            var update_text = "you have played this " + response + " times";
            $('#response3').empty().append(update_text);
        });
    };
</script>


<span id="response3"></span>
<br />
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<a href="http://www.waylostreams.com/login-system/profile.php">Go back to profile page </a>


<br
<br />



