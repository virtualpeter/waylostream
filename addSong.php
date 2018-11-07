<?php


require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Album Form</title>
</head>
<body>
<form action="insertSong.php" method="post">
    <p>
        <label for="albumName">Album Name:</label>
        <input type="text" name="album_name" id="albumName">
    </p>
    <p>
        <label for="artistName">Artist Name:</label>
        <input type="text" name="artist_name" id="artistName">
    </p>

    <p>
        <label for="title">Song Name:</label>
        <input type="text" name="title" id="title">
    </p>

    <p>
        <label for="purchaseCost">Purchase cost ( credits ):</label>
        <input type="text" name="purchase_cost" id="purchaseCost">
    </p>
    <p>
        <label for="streamCost">Stream Cost (credits ):</label>
        <input type="text" name="stream_cost" id="streamCost">
    </p>



    <input type="submit" value="Submit">
</form>


</body>
</html>



