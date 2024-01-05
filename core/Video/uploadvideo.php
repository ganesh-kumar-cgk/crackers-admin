<?php 
    session_start();

    include '../config.php';

    function uploadVideo($tablename,$url){
        $prev="http://localhost/unobi/admin/managevideo.php";
        global $conn;
        $query="Insert into $tablename(url) Values('$url')";
        $result=mysqli_query($conn,$query);
        if($result){
            $_SESSION['success']='Video Added Successfully';
            echo "<script>location.href=`$prev`;</script>";
        }else{
            $error = "Failed Reason: " . mysqli_error($conn);
            $_SESSION['error']=$error;
            echo "<script>location.href=`$prev`;</script>";
        }
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $url=$_POST['url'];
        uploadVideo('videos',$url);
    }

?>