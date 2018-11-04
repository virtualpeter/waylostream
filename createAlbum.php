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
<form action="insertAlbum.php" method="post">
    <p>
        <label for="albumName">Album Name:</label>
        <input type="text" name="album_name" id="albumName">
    </p>
    <p>
        <label for="artistName">Artist Name:</label>
        <input type="text" name="artist_name" id="artistName">
    </p>

    <p>
        <label for="credits">Credits:</label>
        <input type="text" name="credits" id="credits">
    </p>

    <input type="submit" value="Submit">
</form>
</body>
</html>



