<?php 
    session_start();
    include '../config.php' ;

    function deleteBanner($tablename,$id){
        global $conn;
        global $siteurl;
        $prev=$siteurl."managebanners.php";
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

    $id=$_GET['id'];
    deleteBanner('banners',$id);

?>