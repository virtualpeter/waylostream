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
<form action="insertArtist.php" method="post">
    <p>
        <label for="artistName">Artist Name:</label>
        <input type="text" name="artist_name" id="albumName">
    </p>
    <p>
        <label for="artistSex">Artist sex:</label>
        <input type="text" name="artist_sex" id="artistName">
    </p>

    <p>
        <label for="artistCountry">Artist birth country:</label>
        <input type="text" name="artist_country" id="artistName">
    </p>

    <p>
        <label for="artistLocation">Artist location city:</label>
        <input type="text" name="artist_location" id="artistName">
    </p>


    <p>
        <label for="artistBio">Artist Bio:</label>
        <input type="text" name="artist_bio" id="credits">
    </p>

    <p>
        <label for="artistBirthday">Artist Birthday:</label>
        <input type="date" name="bday">
    </p>

    <input type="submit" value="Submit">
</form>

</body>
</html>



