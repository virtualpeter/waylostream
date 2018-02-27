<?php
    $id = $_GET['id'];
    
    if($id == 1){
        $filename = "http://www.waylostreams.com/mp3/cem.mp3";
        if(is_file($filename))
        {
            header('Content-Type: audio/mpeg');
            header('Content-Disposition: inline;filename="'.basename($filename).'"');
            header('Content-length: '.filesize($filename));
            header('Cache-Control: no-cache');
            header("Content-Transfer-Encoding: chunked");
            readfile($filename);
        }
        else {
            die("Error: File not found.");
        }
    
?>



