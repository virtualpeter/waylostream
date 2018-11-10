<?php



/**
 * album_title
 * album_artist
release_date
image_url
credits
artist_email
 */


require('db.php');


session_start();
$email = $_SESSION['email'];

/* Database connection settings */
$host = 'localhost';
$user = 'seanwayland';
$pass = 'Goberheim1$';
$db = 'sean';
$dbport = 3306;
$mysqli = new mysqli($host,$user,$pass,$db,$dbport) or die($mysqli->error);

$id=$_REQUEST['id'];
$result = $mysqli->query("SELECT * FROM albums WHERE album_title='$id'") or die($mysqli->error);

$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
    <p><a href="profile.php">Home page</a>

    <h1>Update Record</h1>
    <?php
    $status = "";
    if(isset($_POST['new']) && $_POST['new']==1)
    {
        $id=$_REQUEST['id'];

        $album_artist =$_REQUEST['album_artist'];
        $result = $mysqli->query("select * from artists where artist_name = '$album_artist'") or die($mysqli->error);

        $row = mysqli_fetch_assoc($result);
        $album_artist = $row['id'];
        $album_artist = intval($album_artist);

        //
        //echo $purchase_cost;
        $credits =$_REQUEST['credits'];
        //$credits = mysqli_escape_string($credits);

        //
        //echo $stream_cost;

        // $update="update songs set purchase_cost= 2 , stream_cost = 3 where title='$id'";
        $update="update albums set album_artist= '$album_artist' , credits= '$credits'  where album_title = '$id'";
        $mysqli->query($update) or die($mysqli->error);
        $status = "Record Updated Successfully. </br></br>
<a href='viewAlbumData.php'>View Updated Records</a>";
        echo '<p style="color:#FF0000;">'.$status.'</p>';

    }else {
    ?>
    <div>
        <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <input name="id" type="hidden" value="<?php echo $row['album_title'];?>" />
            Change album artist
            <br>
            <p><input type="text" name="album_artist" placeholder="Enter new artist name"
                      required value="<?php echo $row['album_artist'];?>" /></p>
            Change credits
            <br>
            <p><input type="text" name="credits" placeholder="Enter new credits"
                      required value="<?php echo $row['credits'];?>" /></p>
            <p><input name="submit" type="submit" value="Update" /></p>
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html>