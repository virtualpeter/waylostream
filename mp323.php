<?php
    
   // do these need to be global  ?
    global $id;
    global $sql;
    global $mysqli;
    global $result;
    global $row;
    global $filename;
    
    /* Database connection settings */
    $host = 'localhost';
    $user = 'seanwayland';
    $pass = 'Goberheim1$';
    $db = 'sean';
    $dbport = 3306;
    $mysqli = new mysqli($host,$user,$pass,$db,$dbport) or die($mysqli->error);
    
    // get ID variable passed from dbtest23
    // I think this variable is being set to NULL don't know why
    $id = $_GET['id'];
    //echo $id;

    $sql = ('SELECT URL FROM songs WHERE id='.$id.'');
    // get the result object.
    $result = $mysqli->query($sql);
    // Associative array
    //echo $result;
    $row=mysqli_fetch_assoc($result);
    // get the URL from the array result
    //echo $row;
    $filename = ($row['URL']);
    //echo $filename;
    //$filename = "\"".$filename."\"";

    // stream a filename back to dbtest23
    if(is_file($filename))
    {
        header('Content-Type: audio/mpeg');
        header('Content-Disposition: inline;filename="'.basename($filename).'"');
        header('Content-length: '.filesize($filename));
        header('Cache-Control: no-cache');
        header("Content-Transfer-Encoding: chunked");
        readfile($filename);
        //echo "Great: it's a file!";
    }
    else {
        die("Error: File not found.");}
    
?>
