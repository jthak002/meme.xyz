<?php
    include 'db.php';
    if(isset($_POST['title'])){
        $title=$_POST['title'];
    }
    if(isset($_POST['tags'])){
        $tags=explode(" ",$_POST['tags']);
    }
    if(isset($_POST['submit'])){
        $target='./images/';    //The storage location for all of the images
        $filename=$_FILES['fileToUpload']['name'];
        $memeID=createID(); #creating meme ID
        $newFileName=$memeID.'.'.pathinfo($filename,PATHINFO_EXTENSION);    #new unique file name generated
        echo $newFileName;
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target.$newFileName);
    }
?>