<?php 
    session_start();

    include '../config.php';

    function uploadVideo($tablename,$url){
        $prev="http://localhost/unobi/admin/managevideo.php";
        global $conn;
        $query="Insert into $tablename(url) Values('$url')";
        $result=mysqli_query($conn,$query);
        if($result){
            echo true;
        }else{
            echo false;
        }
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $url=$_POST['url'];
        uploadVideo('videos',$url);
    }

?>