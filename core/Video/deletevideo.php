<?php  
    session_start();
    include '../config.php';


    $id=$_GET['id'];
    deleteVideo('videos',$id);

    function deleteVideo($tablename,$id){
        global $conn;
        $prev="http://localhost/unobi/admin/managevideo.php";
        $query="Delete from $tablename where id='$id'";
        $result=mysqli_query($conn,$query);
        if($result){
            $_SESSION['success']='Deleted Successfully';
            echo "<script>location.href=`$prev`;</script>";
        }else{
            $error = "Failed Reason: " . mysqli_error($conn);
            $_SESSION['error']=$error;
            echo "<script>location.href=`$prev`;</script>";
        }
    }

?>