<?php


require 'db.php';
session_start();

/* Database connection settings */
$host = 'localhost';
$user = 'seanwayland';
$pass = 'Goberheim1$';
$db = 'sean';
$dbport = 3306;
$mysqli = new mysqli($host,$user,$pass,$db,$dbport) or die($mysqli->error);




$albumName = $_GET['album'];
$title = $_GET['title'];
$target_dir = "http://waylostreams.com/mp3/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["title"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an mp3/wav - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an mp3/wav.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "mp3" && $imageFileType != "wav" ) {
    echo "Sorry, only mp3 and wav files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["title"]). " has been uploaded.";

        // add image url to album data
        $url = "http://waylostreams.com/mp3/";
        $url2 = $_FILES["fileToUpload"]["title"];
        $url3 = $url.$url2 ;
        //$url3 = "hello";



        $sql = "UPDATE songs SET URL = '$url3' WHERE album_title = '$albumName' and title = '$title'";
        $mysqli->query($sql) or die($mysqli->error);

        ?>

        <br />
        <a href="http://www.waylostreams.com/login-system/addSong.php">Add another song </a>
        <br />


        <br />
        <a href="http://www.waylostreams.com/login-system/profile.php">Go back to profile page </a>
        <br />


        <?php


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>