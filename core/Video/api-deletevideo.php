<?php  
    include '../config.php';

    $id=$_GET['id'];
    deleteVideo('videos',$id);

    function deleteVideo($tablename,$id){
        global $conn;
        $query="Delete from $tablename where id='$id'";
        $result=mysqli_query($conn,$query);
        if($result){
            echo true;
        }else{
            echo false;
        }
    }

?>